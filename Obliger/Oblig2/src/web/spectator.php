<?php
include "data.php";


session_start();

$registered = isset($_POST["registerSpectator"]);

if (!$registered) {
  $name = $_SERVER['QUERY_STRING'];
  $name = str_replace("space", " ", $name);
  $spectator = $worldCup->getSpectator($name);

  $spectatorID = $spectator->getPhoneNr();

  $_SESSION["spectator"] = $spectator;
  $_SESSION["spectatorID"] = $spectatorID;
  $_SESSION["worldCup"] = $worldCup;

} else {
  $spectatorID = $_SESSION["spectatorID"];
  $spectator = $_SESSION["spectator"];
  $worldCup = $_SESSION["worldCup"];
}
?>
<!--
Her presenteres en utøver og hvilke øvelser han/hun er meldt på til.
Videre vises en liste som viser hvilke øvelser han/hun ikke er registrert til,
og som hun/han kan melde seg på i. -->


<html>
<head>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>

<header>
  <h1><?php echo $spectator->getFirstName() . " " . $spectator->getLastName()?></h1>
</header>

<nav>
  <ul>
    <li>
      <a href="index.php">Tilbake</a>
    </li>
  </ul>
</nav>

<main>
  <section id="eventList">
    <table>
      <caption>Deltar i følgende øvelser</caption>
      <thead>
      <tr>
        <th>Øvelse</th>
        <th>Dato</th>
        <th>Tid</th>
        <th>Sted</th>
      </tr>
      </thead>
      <tbody>
      <?php
      foreach ($eventList as &$event):
        if ($event->getSpectator($spectatorID) != null):
          $id = str_replace(" ", "", $event->getType());;?>
          <tr id="<?php echo $id;?>">
            <td><a><?php echo $event->getType();?></a></td>
            <td><a><?php echo $event->getDate();?></a></td>
            <td><a><?php echo $event->getTime();?></a></td>
            <td><a><?php echo $event->getPlace();?></a></td>
          </tr>
        <?php
        endif;
      endforeach;?>
      </tbody>
    </table>
  </section>

  <section id="addToEvent">
    <h2>Meld på uttøver til øvelse</h2>
    <form action="spectator.php" method="post">
      <select name="eventType" required="true">
        <?php foreach ($eventList as &$event):
          if ($event->getSpectator($spectatorID) == null):?>
            <option value="<?php echo $event->getType();?>" ><?php echo $event->getType();?></option>
          <?php endif;
        endforeach;?>
      </select>
      <input type="submit" name="registerSpectator" value="Meld på uttøver">
    </form>
  </section>
</main>

<script rel="script" src="script.js" type="text/javascript"></script>
</body>
</html>

<?php
if ($registered) {
  $spectatorID = $_SESSION["spectatorID"];
  $spectator = $_SESSION["spectator"];
  $worldCup = $_SESSION["worldCup"];

  if ($worldCup->addSpectatorToEvent($_POST["eventType"], $spectator, $spectatorID)) {
    echo "Publikummer er nå registrert til denne øvelsen!";
  }
  session_destroy();
}
?>