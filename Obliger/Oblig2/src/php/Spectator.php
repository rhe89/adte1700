<?php

class Spectator extends Person {
  private $ticketType;

  function __construct($firstName, $surName, $address, $postalNr, $city, $phoneNr, $ticketType)
  {
    parent::__construct($firstName, $surName, $address, $postalNr, $city, $phoneNr);
    $this->ticketType = $ticketType;
  }

  public function getTicketType()
  {
    return $this->ticketType;
  }
}