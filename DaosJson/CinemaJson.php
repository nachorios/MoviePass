<?php namespace DaosJson;

    use Models\Cinema as Cinema;

    class CinemaJson
    {
        private $cinemaList = array();

        private function SaveData() {
            $arrayToEncode = array();

            foreach($this->cinemaList as $cinema)
            {
                $valuesArray["name"] = $user->getName();
                $valuesArray["capacity"] = $user->getCapacity();
                $valuesArray["adress"] = $user->getAdress();
                $valuesArray["value"] = $user->getValue();

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
            array_push($this->cinemaList, $value);
            $this->SaveData();
        }
        public function GetAll(){
            $this->RetrieveData();
    
            return $this->cinemaList;
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