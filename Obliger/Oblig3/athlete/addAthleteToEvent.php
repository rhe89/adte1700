<?php
  include "../data.php";
  session_start();

if (isset($_SESSION["athleteID"]) && $_SESSION["logged_in"]) {

    $athleteID = unserialize($_SESSION["athleteID"]);
    $worldCup = unserialize($_SESSION["worldCup"]);

    if ($worldCup->athleteExists($athleteID)) {

    $athlete = $worldCup->getAthlete($athleteID);

      $urlID = str_replace(" ", "space", $athleteID);
      if ($worldCup->addAthleteToEvent($_POST["eventType"], $athlete, $athleteID)) {
        echo "<script> alert('Uttøver er nå registrert til øvelsen!') </script>";
        $_SESSION["athleteID"] = null;
      }
      ?>
      <head>
        <link rel="stylesheet" href="../style.css" type="text/css">
        <meta http-equiv="refresh" content="0; url=/oblig3/athlete/<?php echo "athlete.php?" . $urlID ?>"/>
      </head>
    <?php
    } else {
      include "../error.php";
    }?>

<?php
} else {
    include "../error.php";
}
