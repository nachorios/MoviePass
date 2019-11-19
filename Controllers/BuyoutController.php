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
        private $buyoutDAO;
        private $movieDAO;
        private $cinemaDAO;
        private $billboardDAO;

        public function __construct(){
            $this->buyoutDAO = new BuyoutDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->movieDAO = new MovieDAO();
            $this->billboardDAO = new BillboardDAO();
        }

        public function Add($id_function, $cant, $total, $id_cinema, $id_movie, $credit_number){
            $date = date("Y-m-d H:i:s");
            $buy = new Buyout($cant, $total, $id_movie, $id_cinema, $id_function, $date);

            $mail = $_SESSION['loggedUser']->getMail();

            if($cant > 0) {
                $buyComplete = $this->buyoutDAO->Add($buy, $mail, $credit_number);
            } else {
                $buyComplete = false;
            }

            require_once(VIEWS_PATH . 'navbar.php');
            include(MODALS_PATH . 'buyout-modals.php');
            require_once(VIEWS_PATH . 'home.php');
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
            $buysDAO = $this->buyoutDAO;

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

                            if($saloon->getCapacity() - $buysDAO->GetCountSaloonTickets($func->getSaloon()->getId()) == 0) {
                                $emptySaloons++;
                            }
                        }
                    }
                }
                $saloons = $billboard->getCinema()->getSaloon();
                if(!is_array($saloons))
                    $saloons = array($saloons);
                if($emptySaloons < count($saloons)) {
                    array_push($newBillboardList, $billboard);
                }
            }
            $billboardList = $newBillboardList;

            require_once(VIEWS_PATH . 'navbar.php');
            require_once(VIEWS_PATH . 'buy-ticket.php');

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

    public function TicketList() {
        $user = $_SESSION['loggedUser'];
        $userTickets = $this->buyoutDAO->GetTicketsByUserMail($user->getMail());
        if(!is_array($userTickets))
            $userTickets = array($userTickets);
        $newUserTickets = array();
        if(isset($_GET['date']) && !empty($_GET['date'])) {
            foreach ($userTickets as $ticket/* -> buyout */) {
                $dateGET = strtotime($_GET['date']);
                $date = strtotime($ticket->getDate());
                if(date('d/M/Y', $date) == date('d/M/Y', $date)) {
                    array_push($newUserTickets, $ticket);
                }
            }
            $userTickets = $newUserTickets;
        }
        if(isset($_GET['movie']) && !empty($_GET['movie'])) {
            foreach ($userTickets as $ticket/* -> buyout */) {
                if(strpos($ticket->getMovie()->getTitle(), $_GET['movie']) !== false) {
                    array_push($newUserTickets, $ticket);
                }
            }
            $userTickets = $newUserTickets;
        }

        require_once(VIEWS_PATH . 'navbar.php');
        require_once(VIEWS_PATH . "profile-tickets-list.php");
    }

    public function AdminTicketList() {
        $user = $_SESSION['loggedUser'];
        $userBouyouts = $this->buyoutDAO->getAll($user->getMail());
        if(!is_array($userBouyouts))
            $userBouyouts = array($userBouyouts);


        $buysDAO = $this->buyoutDAO;
        if(isset($_GET['date-start']) && isset($_GET['date-end'])) {
            $startDate = $_GET['date-start'];
            $endDate = $_GET['date-end'];
        } else {
            $startDate = null;
            $endDate = null;
        }

        require_once(VIEWS_PATH . 'navbar.php');
        require_once(VIEWS_PATH . "admin-tickets-list.php");
    }

}
