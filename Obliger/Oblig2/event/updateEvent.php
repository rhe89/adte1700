<?php
/*
  * Sjekker hvilke felter som er fylt ut, og erstatter originalinfo med den nye infoen.
  * Derettes kalles det på en metode som oppdaterer dette i databasen, samt at
  * de variablene det gjelder oppdateres i Event-objektet.
  */

include "../data.php";
session_start();

$event = unserialize($_SESSION["event"]);

  $eventType = $event->getType();
  $eventDate = $event->getDate();
  $eventTime = $event->getTime();
  $eventPlace = $event->getPlace();

  if ($_POST["eventDate"] != '') {
    $eventDate = $_POST["eventDate"];
    $event->setDate($eventDate);
    echo "Dato oppdatert!</br>";
  }

  if ($_POST["eventTime"] != '') {
    $eventTime = $_POST["eventTime"];
    $event->setTime($eventTime);
    echo "Tidspunkt oppdatert!</br>";

  }
  if ($_POST["eventPlace"] != '') {
    $eventPlace = $_POST["eventPlace"];
    $event->setPlace($eventPlace);
    echo "Sted oppdatert!</br>";
  }

  if (updateEventTable($eventDate, $eventTime, $eventType, $eventPlace) == true) {
    echo "Endringer oppdatert!</br>";
  }

  $urlID = str_replace(" ", "space", $eventType);

?>
<head>
  <link rel="stylesheet" href="../style.css" type="text/css">
</head>
<nav>
  <ul>
    <li>
      <a href="<?php echo "event.php?".$urlID?>">Tilbake til øvelse</a>
    </li>
  </ul>
</nav>
