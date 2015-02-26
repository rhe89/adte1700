<?php
/**
 * Created by IntelliJ IDEA.
 * User: Roar
 * Date: 26.02.15
 * Time: 09.01
 */

class Person {
  protected $persNr, $firstName, $lastName, $address, $postalNr, $city, $phoneNr;

  function __construct($persNr, $firstName, $lastName, $address, $postalNr, $city, $phoneNr)
  {
    $this->persNr = $persNr;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->address = $address;
    $this->postalNr = $postalNr;
    $this->city = $city;
    $this->phoneNr = $phoneNr;
  }

  public function getFirstName()
  {
    return $this->firstName;
  }


  public function getSurName()
  {
    return $this->lastName;
  }


  public function getAddress()
  {
    return $this->address;
  }


  public function getPostalNr()
  {
    return $this->postalNr;
  }


  public function getCity()
  {
    return $this->city;
  }


  public function getPhoneNr()
  {
    return $this->phoneNr;
  }

}