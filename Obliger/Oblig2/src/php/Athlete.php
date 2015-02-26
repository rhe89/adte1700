<?php

class Athlete extends Person {
  private $nationality;

  function __construct($persNr, $firstName, $surName, $address, $postalNr, $city, $phoneNr, $nationality)
  {

    parent::__construct($persNr, $firstName, $surName, $address, $postalNr, $city, $phoneNr);
    $this->nationality = $nationality;
  }

  public function getNationality()
  {
    return $this->nationality;
  }

}