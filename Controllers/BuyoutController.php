<?php namespace Controllers;

    use Daos\BillboardDAO as BillboardDAO;
    use Daos\BuyoutDAO as BuyoutDAO;
    use Daos\CinemaDAO as CinemaDAO;
    use Daos\MovieDAO as MovieDAO;
    use Daos\UserDAO as UserDAO;
    
    use Models\Billboard as Billboard;
    use Models\Buyout as Buyout;
    use Models\Cinema as Cinema;
    use Models\Movie as Movie;
    use Models\User as User;

    class BuyoutController{
        private $buyOutDAO;
        private $movieDAO;
        private $cinemaDAO;
        private $billboardDAO;

        public function __construct(){
            $this->buyOutDAO = new BuyoutDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->movieDAO = new MovieDAO();
            $this->billboardDAO = new BillboardDAO();
        }
        public function Add($id_function, $cant, $total, $id_cinema, $id_movie, $credit_number){
            $date = date("Y-m-d H:i:s");
            $buy = new Buyout($cant, $total, $id_movie, $id_cinema, $id_function, $date);
            
            $mail = $_SESSION['loggedUser']->getMail();

            $this->buyOutDAO->Add($buy, $mail, $credit_number);
            require_once(VIEWS_PATH . 'header.php');
            require_once(VIEWS_PATH . 'navbar.php');
        }

        public function ShowView() {
            $idMovie = null;
            $idCinema = null;
            if(isset($_GET)) {
                if(isset($_GET['movie'])) {
                    $idMovie = $_GET['movie'];
                }
                if(isset($_GET['cinema'])) {
                    $idCinema = $_GET['cinema'];
                }
            }

            $billboardList = $this->billboardDAO->GetAllWithThisMovie($idMovie);

            if(!is_array($billboardList))
                $billboardList = array($billboardList);
            $movie = $this->movieDAO->getById($idMovie);

            $newBillboardList = array();
            foreach($billboardList as $billboard) {
                $emptySaloons = 0;
                if($billboard->getFunctions() != null) {
                    $functions = $billboard->getFunctions();
                    if(!is_array($functions))
                        $functions = array($functions);
                    foreach($functions as $func) {
                        $saloons = $func->getSaloon();
                        if(!is_array($saloons))
                            $saloons = array($saloons);
                            foreach($saloons as $saloon) {
                            
                            if($saloon->getCapacity() > 0) {
                                $emptySaloons++;
                            }
                        }
                    }
                }
                if($emptySaloons>0) {
                    array_push($newBillboardList, $billboard);
                }
            }
            $billboardList = $newBillboardList;

            require_once(VIEWS_PATH . 'navbar.php');
            require_once(VIEWS_PATH . 'buy-ticket.php');

        }

    }
        /*
    if(!is_array($billboardList))
                $billboardList = array($billboardList);
            $movie = $this->movieDAO->getById($idMovie);

            foreach($billboardList as $billboard) {
                $newSaloons = array();
                if($billboard->getCinema()->getSaloon() != null) {

                    $saloons = $billboard->getCinema()->getSaloon();
                    if(!is_array($saloons))
                        $saloons = array($saloons);

                    foreach($saloons as $saloon) {
                        $functionSaloons = $billboard->getCinema()->getSaloon();
                        if(!is_array($functionSaloons))
                            $functionSaloons = array($functionSaloons);

                        foreach($functionSaloons as $fSaloon) {
                            echo $fSaloon->getId() . ' / '. $saloon->getId() . ' / '. $saloon->getCapacity() . ' / '. $saloon->getName() . '<br>';
                            if($fSaloon->getId() == $saloon->getId() && $saloon->getCapacity() > 0) {
                                array_push($newSaloons, $saloon);
                            }
                        }
                    }
                }
                if(!empty($newSaloons)) {
                    $billboard->getCinema()->setSaloon($newSaloons);
                }
    */