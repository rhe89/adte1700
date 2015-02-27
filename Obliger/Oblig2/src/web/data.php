<?php

include "../php/Person.php";
include "../php/Athlete.php";
include "../php/Event.php";
include "../php/Spectator.php";
include "../php/sqlHandling.php";
include "../php/SkiWorldCup.php";

$testing = false;

if (!$testing) {
  createTables();
}
loadTablesFromDB();


$worldCup = new SkiWorldCup();

$eventList = $worldCup->getEventList();
$athletes = $worldCup->getAthletes();
$spectators = $worldCup->getSpectators();

