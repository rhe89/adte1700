<?php
  session_start();

  $athleteID = unserialize($_SESSION["athleteID"]);
  $worldCup = unserialize($_SESSION["worldCup"]);

  var_dump($worldCup);
  $athlete = $worldCup->getAthlete($athleteID);

  echo "hei";
  $urlID = str_replace(" ", "space", $athlete);
  if ($worldCup->addAthleteToEvent($_POST["eventType"], $athlete, $athleteID)) {
    echo "Utøver er nå registrert til denne øvelsen!";
  }
?>

<nav>
  <ul>
    <li>
      <a href="<?php echo "athlete.php?".$urlID?>">Tilbake til uttøver</a>
    </li>
  </ul>
</nav>
