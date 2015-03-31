<?php
  include "../data.php";
  session_start();

if (isset($_SESSION["athleteID"])) {

    $athleteID = unserialize($_SESSION["athleteID"]);
    $worldCup = unserialize($_SESSION["worldCup"]);

    if ($worldCup->athleteExists($athleteID)) {

    $athlete = $worldCup->getAthlete($athleteID);

      $urlID = str_replace(" ", "space", $athleteID);
      if ($worldCup->addAthleteToEvent($_POST["eventType"], $athlete, $athleteID)) {
        echo "Utøver er nå registrert til denne øvelsen!";
        $_SESSION["athleteID"] = null;
      }
      ?>
      <head>
        <link rel="stylesheet" href="../style.css" type="text/css">
        <meta http-equiv="refresh"
              content="0; url=http://localhost:8888/oblig3/athlete/<?php echo "athlete.php?" . $urlID ?>"/>
        ;
      </head>
    <?php
    } else {
      include "../error.php";
    }?>

<?php
} else {
    include "../error.php";
}
