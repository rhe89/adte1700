<?php

class Event {
  private $date, $time, $type, $place, $registeredAthletes, $registeredSpectators;

  public function __construct($date, $time, $type, $place)
  {
    $this->date = $date;
    $this->time = $time;
    $this->type = $type;
    $this->place = $place;
    $this->registeredAthletes = array();
    $this->registeredSpectators = array();
  }

  public function getDate()
  {
    return $this->date;
  }

  public function getTime()
  {
    return $this->time;
  }

  public function getType()
  {
    return $this->type;
  }

  public function getPlace()
  {
    return $this->place;
  }

  public function getAthletes()
  {
    return $this->registeredAthletes;
  }

  public function addAthleteToEvent($eventType, $athlete)
  {

  }

  public function getSpectators()
  {
    return $this->registeredSpectators;
  }

  public function addSpectatorToEvent($spectator, $id)
  {
    $this->registeredSpectators[$id] = $spectator;
  }
}