<?php

include "../data.php";
session_start();

if ($_SESSION["logged_in"]) {
  $event = unserialize($_SESSION["event"]);

  $eventType = $event->getType();

  if (deleteEvent($eventType) == true) {
    echo "<script> alert('Øvelse er nå fjernet fra mesterskapet!') </script>";
    echo '<meta http-equiv="refresh" content="0; url=/oblig3/index.php"/>';
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


