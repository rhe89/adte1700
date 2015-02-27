<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
/*
 * I dette systemet vil deltagere og publikum først registrere seg som hhv deltagere og publikum,
 * før de deretter kan registrere seg på de ulike øvelsene i mesterskapet. Primærnøkler for øvelser
 * er øvelsestypen, mens primærnøkler for personer (dvs. uttøvere og publikum) er telefonnr. Jeg vurderte
 * å bruke autogenerete nøkler fra MySQL, men dette ville ført til problemer ved at deltagere og publikum
 * kunne legges til i DB'en flere ganger, da det ved opprettelse av objektene og input i databasen ikke er
 * kjent hvilken unik ID de har.
 */
class SkiWorldCup {

  private $eventList, $athletes, $spectators;

  public function __construct() {
    $this->eventList = array();
    $this->athletes = array();
    $this->spectators = array();
    $this->loadTablesFromDB();

  }

  /*
   * Laster inn alle tabellene fra databasen.
   * Øvelser, uttøvere og tilskuere legges til i sine respektive
   * lister, før utøvere i øvelser og tilskuere til øvelser
   * legges til i de respektive øvelsene.
   */
  function loadTablesFromDB() {
    $tables = loadTablesFromDB();

    foreach ($tables["events"] as &$row) {
      $event = new Event($row["date"], $row["time"], $row["type"], $row["place"]);
      $this->eventList[$row["type"]] =  $event;
    }

    foreach ($tables["athletes"] as &$row) {
      $athlete = new Athlete($row["firstName"], $row["lastName"], $row["address"], $row["postalNr"], $row["city"], $row["phoneNr"], $row["nationality"]);
      $this->athletes[$row["phoneNr"]] =  $athlete;
    }

    foreach ($tables["spectators"] as &$row) {
      $spectator = new Athlete($row["firstName"], $row["lastName"], $row["address"], $row["postalNr"], $row["city"], $row["phoneNr"], $row["ticketType"]);
      $this->spectators[$row["phoneNr"]] =  $spectator;
    }

    foreach ($tables["athletesInEvents"] as &$row) {
      $this->eventList[$row["eventType"]]->addAthleteToEvent($row["phoneNr"], $this->athletes[$row["phoneNr"]]);
    }

    foreach ($tables["spectatorsInEvents"] as &$row) {
      $this->eventList[$row["eventType"]]->addSpectatorToEvent($row["phoneNr"], $this->spectators[$row["phoneNr"]]);
    }
  }

  function addEvent($eventDate, $eventTime, $eventType, $eventLocation) {
    if (isset($this->eventList[$eventType])) {
      echo "Denne øvelsen er allerede lagt til!";
      return false;
    } else if (addEventToDB($eventDate, $eventTime, $eventType, $eventLocation)) {
      $this->eventList[$eventType] = new Event($eventDate, $eventTime, $eventType, $eventLocation);
      return true;
    } else {
      return false;
    }
  }

  function getEventList() {
    return $this->eventList;
  }

  function getEvent($type) {
    return $this->eventList[$type];
  }

  function addAthlete($firstName, $lastName, $address, $postNr, $city, $phoneNr, $nationality) {

    if (isset($this->athletes[$phoneNr])) {
      echo "Uttøveren er allerede registrert til mesterskapet!";
      return false;
    } else {
      if (addAthleteToDB($firstName, $lastName, $address, $postNr, $city, $phoneNr, $nationality)) {
        $this->athletes[$phoneNr] = new Athlete($firstName, $lastName, $address, $postNr, $city, $phoneNr, $nationality);
        return true;
      } else {
        return false;
      }
    }
  }

  function getAthletes() {
    return $this->athletes;
  }

  function getAthlete($id) {
    return $this->athletes[$id];
  }

  function getAthletesInEvent($eventType) {
    return $this->eventList[$eventType]->getAthletes();
  }

  function addAthleteToEvent($eventType, $athlete, $id) {
    if (!$this->eventList[$eventType]->hasAthlete($id)){
      if (addAthleteInEventToDB($id, $eventType)) {
        $this->eventList[$eventType]->addAthleteToEvent($id, $athlete);
        return true;
      } else {
        return false;
      }
    } else {
      echo "Uttøveren er allerede registrert til denne øvelsen!";
      return false;
    }
  }

  function addSpectator($firstName, $lastName, $address, $postNr, $city, $phoneNr, $ticketType) {
    if (isset($this->spectators[$phoneNr])) {
      echo "Publikummeren er allerede registrert til mesterskapet!";
      return false;
    } else {
      if (addSpectatorToDB($firstName, $lastName, $address, $postNr, $city, $phoneNr, $ticketType)) {
        $this->spectators[$phoneNr] = new Spectator($firstName, $lastName, $address, $postNr, $city, $phoneNr, $ticketType);
        return true;
      } else {
        return false;
      }
    }
  }

  function getSpectators() {
    return $this->spectators;
  }


  function getSpectator($id) {
    return $this->spectators[$id];
  }


  function getSpectatorsInEvent($eventType) {
    return $this->eventList[$eventType]->getAthletes();
  }

  function addSpectatorToEvent($eventType, $spectator, $id) {

    if (!$this->eventList[$eventType]->hasSpectator($id)){
      if (addSpectatorInEventToDB($id, $eventType)) {
        $this->eventList[$eventType]->addSpectatorToEvent($id, $spectator);
        return true;
      } else {
        return false;
      }
    } else {
      echo "Publikummeren er allerede registrert til denne øvelsen!";
      return false;
    }
  }

}
