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
                $valuesArray["capacity"] = $cinema->getCapacity();
                $valuesArray["adress"] = $cinema->getAdress();
                $valuesArray["value"] = $cinema->getValue();

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

                    $cinema = new Cinema($valuesArray["name"], $valuesArray["capacity"], $valuesArray["adress"], $valuesArray["value"]);

                    array_push($this->cinemaList, $cinema);

                }
            }
        }
        public function Add($value){
            $this->RetrieveData();
            $flag = false;
            if($this->GetCinema($value->getName()) == null) {
                array_push($this->cinemaList, $value);
                $flag = true;
            }
            $this->SaveData();
            return $flag;
        }
        public function GetAll(){
            $this->RetrieveData();

            return $this->cinemaList;
        }
        public function GetCinema($cinemaName){
            $this->RetrieveData();
            $cinema = null;
            foreach($this->cinemaList as $cinemas) {
                if($cinemaName == $cinemas->getName()) {
                    $cinema = $cinemas;
                    break;
                }
            }

            return $cinema;
        }
        public function Delete($value){
            $this->RetrieveData();
            foreach($this->cinemaList as $key => $cinema){
                if($cinema->getName() == $value){
                    unset($this->cinemaList[$key]);
                }
            }
            $this->SaveData(); 

        }
    }
?>
