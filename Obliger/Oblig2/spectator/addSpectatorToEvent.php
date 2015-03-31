<?php
  include "../data.php";
  session_start();

  $spectatorID = unserialize($_SESSION["spectatorID"]);
  $worldCup = unserialize($_SESSION["worldCup"]);

  $spectator = $worldCup->getSpectator($spectatorID);

  $urlID = str_replace(" ", "space", $spectatorID);
  if ($worldCup->addSpectatorToEvent($_POST["eventType"], $spectator, $spectatorID)) {
    echo "Publikummer er nå registrert til denne øvelsen!";
  }
?>
<head>
  <link rel="stylesheet" href="../style.css" type="text/css">
</head>
<nav>
  <ul>
    <li>
      <a href="<?php echo "spectator.php?".$urlID?>">Tilbake til publikummer</a>
    </li>
  </ul>
</nav>
