<?php namespace DaosJson;

    use Models\User as User;

    class UserJson
    {
        private $usersList = array();

        private function SaveData() {
            $arrayToEncode = array();

            foreach($this->usersList as $user)
            {
                $valuesArray["name"] = $user->getName();
                $valuesArray["lastName"] = $user->getLastName();
                $valuesArray["dni"] = $user->getDni();
                $valuesArray["mail"] = $user->getMail();
                $valuesArray["pass"] = $user->getPass();
                $valuesArray["role"] = $user->getRole();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('data/users.json', $jsonContent);
        }

        private function RetrieveData() {
            $this->usersList = array();

            if(file_exists('data/users.json'))
            {
                $jsonContent = file_get_contents('data/users.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {

                    $user = new User($valuesArray["name"], $valuesArray["lastName"], $valuesArray["dni"], $valuesArray["mail"], $valuesArray["pass"], $valuesArray["role"]);

                    array_push($this->usersList, $user);

                }
            }
        }
        public function Add($value){
            $this->RetrieveData();
            $registered = true;
            foreach($this->usersList as $user) {
                if ($value->getMail() == $user->getMail()) {
                    $registered = false;
                    break;
                }
            }
            if($registered) {
                array_push($this->usersList, $value);
                $this->SaveData();
            }
            return $registered;
        }
        public function GetAll(){
            $this->RetrieveData();
    
            return $this->usersList;
        }
        public function Delete($value){
            $this->RetrieveData();
            foreach($this->usersList as $key => $user){
                if($user->getMail() == $value){ 
                    unset($this->usersList[$key]);      
                }
            }
            $this->SaveData();

        }
    }
?>