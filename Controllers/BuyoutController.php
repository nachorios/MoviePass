<?php namespace Controllers;


    use Daos\BillboardDAO as BillboardDAO;
    use Daos\BuyoutDAO as BuyoutDAO;
    use Daos\CinemaDAO as CinemaDAO;
    use Daos\MovieDAO as MovieDAO;
    use Daos\UserDAO as UserDAO;

    use Models\Billboard as Billboard;
    use Models\Buyout as Buyout;
    use Models\Cinema as Cinema;
    use Models\TicketInfo as TicketInfo;
    use Models\Movie as Movie;
    use Models\User as User;
    use Models\Mail as Mail;
    use Models\Qr as Qr;

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
                $email = new Mail();

                $idBuy = $this->buyoutDAO->GetId($date);
                $qr = new Qr();
              
                if($cant > 1){    
                    for($i = 0; $i < $cant; $i ++){
                        $qr->text($idBuy);
                        $qr->qrCode(350, ROOT.'temp/qr'. $i .'.png');
                    }
                }else{
                    $qr->text($idBuy);
               $qr->qrCode(350, ROOT.'temp/qr.png');
                }
                $email->sendMail($mail, $buy);

                $dir = ROOT.'temp/';
                foreach(glob($dir.'*.*') as $v){
                     unlink($v);
                }

              
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
            if(!empty($newBillboardList))
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
                $date = strtotime($ticket->getFunction()->getDate());
                //echo date('d/M/Y', $dateGET) .' - '. date('d/M/Y', $date);
                if(date('d/M/Y', $dateGET) == date('d/M/Y', $date)) {
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
        $billboardList = $this->billboardDAO->getAll();
        if(!is_array($billboardList))
            $billboardList = array($billboardList);
        $userBuyouts = $this->buyoutDAO->getAll();
        if(!is_array($userBuyouts))
            $userBuyouts = array($userBuyouts);

        $buysDAO = $this->buyoutDAO;
        if(isset($_GET['date-start']) && isset($_GET['date-end'])) {
            $startDate = $_GET['date-start'];
            $endDate = $_GET['date-end'];
        } else {
            $startDate = null;
            $endDate = null;
        }

        $movieTicketList = $this->getMovieTicketList($billboardList, $userBuyouts, $buysDAO);
        $cinemaTicketList = $this->getCinemaTicketList($billboardList, $userBuyouts, $buysDAO);
        require_once(VIEWS_PATH . 'navbar.php');
        require_once(VIEWS_PATH . "admin-tickets-list.php");
    }

    //le paso date porque es el dato a travez del cual accedo a buyout y a travez de el obtengo el id
    public function DeleteTicket($date)
    {
        $idToDelete = $this->buyoutDAO->GetId($date);

        echo $idToDelete;

        $flag = $this->buyoutDAO->Delete($idToDelete);

        if($flag = true)
        {
          echo "se borro el dato correctamente";
          //<script> alert("Hello! I am an alert box!"); </script>
        }
    }

    public function getMovieTicketList($billboardList, $userBuyouts, $buysDAO) {

        $movieTicketList = array();
        foreach($billboardList as $bill) {
            $movie = $bill->getMovie();
            $buyout = null;
            foreach($userBuyouts as $buy){
                if($buy->getMovie()->getId() == $movie->getId()){
                    $functions = $bill->getFunctions();
                    if(!is_array($functions))
                        $functions = array($functions);
                    foreach($functions as $function) {
                        if($buy->getFunction()->getId() == $function->getId())
                        $buyout = $buy;
                    }
                }
            }
            $ticketsSold = 0;
            $ticketsTotal = 0;
            $ticketsRemaining = 0;
            if($buyout != null) {
                $ticketsSold = $buysDAO->GetCountMovieTickets($buyout->getMovie()->getId());
                $functions = $bill->getFunctions();
                if(!is_array($functions))
                    $functions = array($functions);
                foreach($functions as $function) {
                        $ticketsTotal += $function->getSaloon()->getCapacity();
                }
            } else {
                $functions = $bill->getFunctions();
                if(!is_array($functions))
                    $functions = array($functions);
                foreach($functions as $function) {
                    $ticketsTotal += $function->getSaloon()->getCapacity();
                }
            }
            $ticketsRemaining = $ticketsTotal - $ticketsSold;

            $exists = false;
            $movie = $bill->getMovie()->getTitle();
            foreach($movieTicketList as $movieTicket) {
                if($movie == $movieTicket->getName()) {
                    $movieTicket->setTicketsSold($movieTicket->getTicketsSold() + $ticketsSold);
                    $movieTicket->setTicketsTotal($movieTicket->getTicketsTotal() + $ticketsTotal);
                    $movieTicket->setTicketsRemaining($movieTicket->getTicketsRemaining() + $ticketsRemaining);
                    $exists = true;
                    break;
                }
            }
            if(!$exists)
                array_push($movieTicketList, new TicketInfo($movie, $ticketsSold, $ticketsTotal, $ticketsRemaining));
        }
        return $movieTicketList;
    }

    public function getCinemaTicketList($billboardList, $userBuyouts, $buysDAO) {

        $cinemaTicketList = array();
        foreach($billboardList as $bill) {
            $cinema = $bill->getCinema();
            $buyout = null;
            foreach($userBuyouts as $buy){
                if($buy->getCinema()->getIdCinema() == $cinema->getIdCinema()){
                    $functions = $bill->getFunctions();
                    if(!is_array($functions))
                        $functions = array($functions);
                    foreach($functions as $function) {
                        if($buy->getFunction()->getId() == $function->getId())
                        $buyout = $buy;
                    }
                }
            }
            $ticketsSold = 0;
            $ticketsTotal = 0;
            $ticketsRemaining = 0;
            if($buyout != null) {
                $ticketsSold = $buysDAO->GetCountCinemaTickets($buyout->getCinema()->getIdCinema());
                $functions = $bill->getFunctions();
                if(!is_array($functions))
                    $functions = array($functions);
                foreach($functions as $function) {
                    $ticketsTotal += $function->getSaloon()->getCapacity();
                }
            } else {
                $functions = $bill->getFunctions();
                if(!is_array($functions))
                    $functions = array($functions);
                foreach($functions as $function) {
                    $ticketsTotal += $function->getSaloon()->getCapacity();
                }
            }
            $ticketsRemaining = $ticketsTotal - $ticketsSold;

            $exists = false;
            $cinema = $bill->getCinema()->getName();
            foreach($cinemaTicketList as $cinemaTicket) {
                if($cinema == $cinemaTicket->getName()) {
                    $cinemaTicket->setTicketsSold($cinemaTicket->getTicketsSold() + $ticketsSold);
                    $cinemaTicket->setTicketsTotal($cinemaTicket->getTicketsTotal() + $ticketsTotal);
                    $cinemaTicket->setTicketsRemaining($cinemaTicket->getTicketsRemaining() + $ticketsRemaining);
                    $exists = true;
                    break;
                }
            }
            if(!$exists)
                array_push($cinemaTicketList, new TicketInfo($cinema, $ticketsSold, $ticketsTotal, $ticketsRemaining));
        }
        return $cinemaTicketList;
    }

}
