<?php namespace DaosJson;

    use Models\Cinema as Cinema;

    class CinemaJson
    {
        private $cinemaList = array();

        private function SaveData() {
            $arrayToEncode = array();

            foreach($this->cinemaList as $cinema)
            {
                $valuesArray["name"] = $cinema->getName();
                $valuesArray["adress"] = $cinema->getAdress();
                //$valuesArray["saloon"] = $cinema->getSaloon();
                $valuesArray["id_cinema"] = $cinema->getIdCinema();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents('data/cinemas.json', $jsonContent);
        }

        private function RetrieveData() {
            $this->cinemaList = array();

            if(file_exists('data/cinemas.json'))
            {
                $jsonContent = file_get_contents('data/cinemas.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {

                    $cinema = new Cinema($valuesArray["name"], $valuesArray["adress"], $valuesArray["id_cinema"]);

                    array_push($this->cinemaList, $cinema);

                }
            }
        }

        public function Add($value){
            $this->RetrieveData();

            $flag = false;

            $value->setIdCinema($this->GetNextId());

            if($this->GetCinema($value->getName(), $value->getAdress()) == null) {
                array_push($this->cinemaList, $value);
                $flag = true;
            }

            $this->SaveData();
            return $flag;
        }

        public function GetCinema($name, $address){ //lo hago por el name porque si el id es unico
            $this->RetrieveData();

            $cinema = null;
            foreach($this->cinemaList as $cinemas) {
                if($name == $cinemas->getName() || $address == $cinemas->getAdress()) {
                    $cinema = $cinemas;
                    //break;
                }
            }

            return $cinema;
        }

        public function GetAll(){
            $this->RetrieveData();

            return $this->cinemaList;
        }

        public function Delete($value){
            $this->RetrieveData();
            foreach($this->cinemaList as $key => $cinema){
                if($cinema->getIdCinema() == $value){
                    unset($this->cinemaList[$key]);
                }
            }
            $this->SaveData();

        }

        public function Update($newCinema, $id_cinema)
        {

          $flag = false;
          $this->RetrieveData();

            foreach($this->cinemaList as $key => $cinema)
            {
                if($cinema->getIdCinema() == $id_cinema)
                {
                  $cinema->setName($newCinema->getName());
                  $cinema->setAdress($newCinema->getAdress());
                  $flag = true;
                }
            }

            $this->SaveData();
            return $flag;
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->cinemaList as $cinema)
            {
                $id = ($cinema->getIdCinema() > $id) ? $cinema->getIdCinema() : $id;
            }

            return $id + 1;
        }
    }
?>
