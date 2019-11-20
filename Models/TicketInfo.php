<?php namespace Models;

class TicketInfo{
    private $name;
    private $ticketsSold;
    private $ticketsTotal;
    private $ticketsRemaining;

      public function  __construct($name, $ticketsSold = 0, $ticketsTotal = 0, $ticketsRemaining = 0){
        $this->name = $name;
        $this->ticketsSold = $ticketsSold;
        $this->ticketsTotal = $ticketsTotal;
        $this->ticketsRemaining = $ticketsRemaining;
    }

    public function getName(){
        return $this->name;
    }
    public function getTicketsSold(){
        return $this->ticketsSold;
    }
    public function getTicketsTotal(){
        return $this->ticketsTotal;
    }

    public function getTicketsRemaining(){
        return $this->ticketsRemaining;
    }

    public function setTicketsSold($ticketsSold){
        $this->ticketsSold=$ticketsSold;
    }
    public function setTicketsTotal($ticketsTotal){
        $this->ticketsTotal=$ticketsTotal;
    }
    public function setName($name){
        $this->name=$name;
    }

    public function setTicketsRemaining($ticketsRemaining){
        $this->ticketsRemaining=$ticketsRemaining;
    }

}
