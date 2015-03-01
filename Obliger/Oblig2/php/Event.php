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

  public function getAthlete($id) {
    if (isset($this->registeredAthletes[$id])) {
      return $this->registeredAthletes[$id];
    } else {
      error_log("Prøvde å finne utøver i øvelse, men han/hun fantes ikke\n", 3, "logg.txt");
      return null;
    }
  }

  public function hasAthlete($id) {
    return isset($this->registeredAthletes[$id]);
  }

  public function addAthleteToEvent($id, $athlete)
  {
    $this->registeredAthletes[$id] = $athlete;
  }

  public function getSpectators()
  {
    return $this->registeredSpectators;
  }

  public function getSpectator($id) {
    if (isset($this->registeredSpectators[$id])) {
      return $this->registeredSpectators[$id];
    } else {
      error_log("Prøvde å finne tilskuer i øvelse, men han/hun fantes ikke\n", 3, "logg.txt");
      return null;
    }
  }

  public function hasSpectator($id) {
    return isset($this->registeredSpectators[$id]);
  }

  public function setDate($date)
  {
    $this->date = $date;
  }

  public function setTime($time)
  {
    $this->time = $time;
  }

  public function setPlace($place)
  {
    $this->place = $place;
  }

  public function addSpectatorToEvent($id, $spectator)
  {
    $this->registeredSpectators[$id] = $spectator;
  }
}