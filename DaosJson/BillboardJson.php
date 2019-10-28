<?php namespace DaosJson;

    use Models\Billboard as Billboard;

    class BillboardJson
    {
        private $billboardList = array();

        private function SaveData() {
            $arrayToEncode = array();

            foreach($this->billboardList as $billboard)
            {
                $valuesArray["day"] = $billboard->getDay();
                $valuesArray["hour"] = $billboard->getHour();
                $valuesArray["idMovie"] = $billboard->getMovie();
                $valuesArray["cinema"] = $billboard->getCinema();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents('data/billboards.json', $jsonContent);
        }

        private function RetrieveData() {
            $this->billboardList = array();

            if(file_exists('data/billboards.json'))
            {
                $jsonContent = file_get_contents('data/billboards.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {

                    $billboard = new Billboard($valuesArray["day"], $valuesArray["hour"], $valuesArray["idMovie"], $valuesArray["cinema"]);

                    array_push($this->billboardList, $billboard);

                }
            }
        }
        public function Add($value){
            $this->RetrieveData();
            $flag = false;
            if($this->GetBillboard($value->getCinema(), $value->getMovie()) == null) {
                array_push($this->billboardList, $value);
                $flag = true;
            }
            $this->SaveData();
            return $flag;
        }
        public function GetAll(){
            $this->RetrieveData();

            return $this->billboardList;
        }
        public function GetBillboard($cinema, $idMovie){
            $this->RetrieveData();
            $billboard = null;
            foreach($this->billboardList as $billboards) {
                if($cinema == $billboards->getCinema()
                && $idMovie == $billboards->getMovie()) {
                    $billboard = $billboards;
                    break;
                }
            }

            return $billboard;
        }
        public function Delete($cinema, $idMovie){
            $this->RetrieveData();
            foreach($this->billboardList as $key => $billboard){
                if($billboard->getCinema() == $cinema
                    && $billboard->getMovie() == $idMovie){
                    unset($this->billboardList[$key]);
                }
            }
            $this->SaveData();

        }
    }
?>
