<?php

include "../data.php";
session_start();

if (isset($_SESSION["logged_in"])) {
  $event = unserialize($_SESSION["event"]);

  $eventType = $event->getType();

  if (deleteEvent($eventType) == true) {
    echo "Øvelse er fjernet fra mesterskapet!";
    echo '<meta http-equiv="refresh" content="0; url=http://localhost:8888/oblig3/index.php"/>';
  }

  $_SESSION["event"] = null;
  ?>

  <head>
    <link rel="stylesheet" href="../style.css" type="text/css">
  </head>

  <?php include "../main-menu.php";
} else {
  include "../error.php";
}?>


