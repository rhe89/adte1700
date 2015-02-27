<?php
/**
 * Created by IntelliJ IDEA.
 * User: Roar
 * Date: 26.02.15
 * Time: 09.01
 */

class Person {
  protected $id, $firstName, $lastName, $address, $postalNr, $city, $phoneNr;

  function __construct($firstName, $lastName, $address, $postalNr, $city, $phoneNr)
  {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->address = $address;
    $this->postalNr = $postalNr;
    $this->city = $city;
    $this->phoneNr = $phoneNr;
  }

  public function getID() {
    return $this->id;
  }

  public function setID($id) {
    $this->id = $id;
  }

  public function getFirstName()
  {
    return $this->firstName;
  }


  public function getLastName()
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