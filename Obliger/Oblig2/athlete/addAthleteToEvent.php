<?php
  include "../data.php";
  session_start();

  $athleteID = unserialize($_SESSION["athleteID"]);
  $worldCup = unserialize($_SESSION["worldCup"]);

  $athlete = $worldCup->getAthlete($athleteID);

  $urlID = str_replace(" ", "space", $athleteID);
  if ($worldCup->addAthleteToEvent($_POST["eventType"], $athlete, $athleteID)) {
    echo "Utøver er nå registrert til denne øvelsen!";
  }
?>
<head>
  <link rel="stylesheet" href="../style.css" type="text/css">
</head>
<nav>
  <ul>
    <li>
      <a href="<?php echo "athlete.php?".$urlID?>">Tilbake til uttøver</a>
    </li>
  </ul>
</nav>
