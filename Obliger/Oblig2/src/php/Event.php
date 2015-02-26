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

  public function getRegisteredAthletes()
  {
    return $this->registeredAthletes;
  }

  public function addAthleteToEvent($athlete)
  {
    array_push($this->registeredAthletes, $athlete);
  }

  public function getRegisteredSpectators()
  {
    return $this->registeredSpectators;
  }

  public function addSpectatorToEvent($spectator)
  {
    array_push($this->registeredSpectators, $spectator);
  }
}