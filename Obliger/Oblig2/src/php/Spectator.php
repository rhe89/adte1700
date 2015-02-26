<?php

class Spectator extends Person {
  private $ticketType;

  function __construct($persNr, $firstName, $surName, $address, $postalNr, $city, $phoneNr, $ticketType)
  {
    parent::__construct($persNr, $firstName, $surName, $address, $postalNr, $city, $phoneNr);
    $this->ticketType = $ticketType;
  }

  public function getTicketType()
  {
    return $this->ticketType;
  }
}