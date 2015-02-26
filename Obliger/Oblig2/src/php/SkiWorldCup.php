<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
class SkiWorldCup {

  private $eventList;

  public function __construct() {
    $this->eventList = array();
    $this->loadEvents();

  }

  function loadEvents() {
    $listFromDB = loadEventsFromDB();

    foreach ($listFromDB as &$item) {
      $event = new Event($item["date"], $item["time"], $item["type"], $item["place"]);
      array_push($this->eventList, $event);
    }
  }

  function getEventList() {
    return $this->eventList;
  }

  function getEvent($type) {
    return $this->eventList[$type];
  }

}
