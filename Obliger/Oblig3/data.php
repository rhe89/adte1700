<?php
include "php/errorReporting.php";
include "php/Person.php";
include "php/Athlete.php";
include "php/Event.php";
include "php/Spectator.php";
include "php/sqlHandling.php";
include "php/SkiWorldCup.php";

createTables();

loadTablesFromDB();

$worldCup = new SkiWorldCup();

$eventList = $worldCup->getEventList();
$athletes = $worldCup->getAthletes();
$spectators = $worldCup->getSpectators();

if (!isset($_SESSION["logged_in"])) {
  $_SESSION["logged_in"] = false;
}