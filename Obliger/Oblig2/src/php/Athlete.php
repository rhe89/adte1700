<?php

class Athlete extends Person {
  private $nationality;

  function __construct($firstName, $surName, $address, $postalNr, $city, $phoneNr, $nationality)
  {

    parent::__construct($firstName, $surName, $address, $postalNr, $city, $phoneNr);
    $this->nationality = $nationality;
  }

  public function getNationality()
  {
    return $this->nationality;
  }

}