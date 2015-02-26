<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
/*
 * I dette systemet vil deltagere og publikum først registrere seg som hhv deltagere og publikum,
 * før de deretter kan registrere seg på de ulike øvelsene i mesterskapet. Jeg har også valgt
 * å ha med en ny variabel til person, personnummer. Dette for å gjøre arbeidet med nøkler
 * i arrayer, primærnøkler og fremmednøkler i databasetabellene enklere.
 */
class SkiWorldCup {

  private $eventList, $athletes, $spectators;

  public function __construct() {
    $this->eventList = array();
    $this->loadEvents();

  }

  function loadEvents() {
    $listFromDB = loadEventsFromDB();

    foreach ($listFromDB as &$item) {
      $event = new Event($item["date"], $item["time"], $item["type"], $item["place"]);
      $this->eventList[$item["type"]] =  $event;
    }
  }
  /*
   * Siden alt blir lastet på nytt når bruker går tilbake til startsiden,
   * legger jeg ikke til et nytt objekt i eventList, da dette blir gjort
   * fra loadEvents ved reload av siden.
   */
  function addEvent($eventDate, $eventTime, $eventType, $eventLocation) {
    if (isset($this->eventList[$eventType])) {
      echo "Denne øvelsen er allerede lagt til!";
      return false;
    } else if (addEventToDB($eventDate, $eventTime, $eventType, $eventLocation)) {
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

  function addAthlete($persNr, $firstName, $lastName, $address, $postNr, $city, $phoneNr, $nationality) {
    if (isset($this->athletes[$persNr])) {
      echo "Utøveren er allerede registrert til mesterskapet!";
      return false;
    } else if (addAthleteToDB($persNr, $firstName, $lastName, $address, $postNr, $city, $phoneNr, $nationality)) {
      return true;
    } else {
      return false;
    }
  }

  function getAthletes() {
    return $this->athletes;
  }

  function getAthletesInEvent($eventType) {
    return $this->eventList[$eventType]->getAthletes();
  }

  function addAthleteToEvent($eventType, $athlete) {
    $this->eventList[$eventType]->addAthleteToEvent($eventType, $athlete);
  }

  function addSpectator($persNr, $firstName, $lastName, $address, $postNr, $city, $phoneNr, $ticketType) {
    if (isset($this->athletes[$persNr])) {
      echo "Publikummeren er allerede registrert til mesterskapet!";
      return false;
    } else if (addSpectatorToDB($persNr, $firstName, $lastName, $address, $postNr, $city, $phoneNr, $ticketType)) {
      return true;
    } else {
      return false;
    }
  }

  function getSpectators() {
    return $this->athletes;
  }

  function getSpectatorsInEvent($eventType) {
    return $this->eventList[$eventType]->getAthletes();
  }

  function addSpectatorToEvent($eventType, $spectator) {
    $this->eventList[$eventType]->addSpectatorToEvent($eventType, $spectator);
  }

}
