<?php

include "../data.php";
session_start();

$event = unserialize($_SESSION["event"]);

  $eventType = $event->getType();

  if (deleteEvent($eventType) == true) {
    echo "Øvelse er fjernet fra mesterskapet!";
  }

?>

<head>
  <link rel="stylesheet" href="../style.css" type="text/css">
</head>
<nav>
  <ul>
    <li>
      <a href="../index.php">Tilbake til startisden</a>
    </li>
  </ul>
</nav>

