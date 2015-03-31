<?php
include "../data.php";
session_start();

$spectatorID = $_SERVER['QUERY_STRING'];

if ($worldCup->spectatorExists($spectatorID)):

$spectator = $worldCup->getSpectator($spectatorID);

$_SESSION["spectatorID"] = serialize($spectatorID);
$_SESSION["worldCup"] = serialize($worldCup);


?>
<!--
Her presenteres en utøver og hvilke øvelser han/hun er meldt på til.
Videre vises en liste som viser hvilke øvelser han/hun ikke er registrert til,
og som hun/han kan melde seg på i. -->

<html>
<head>
  <link rel="stylesheet" href="../style.css" type="text/css">
</head>

<body>

<?php include "../main-menu.php";?>

<header>
  <h1><?php echo $spectator->getFirstName() . " " . $spectator->getLastName()?></h1>
</header>

<main>
  <section id="eventList">
    <table>
      <caption>Skal se følgende øvelser</caption>
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
          $id = str_replace(" ", "space", $event->getType());;?>
          <tr class="event-row" id="<?php echo $id;?>">
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
  <?php if (isset($_SESSION["logged_in"])):?>
    <section id="addToEvent">
      <h2>Meld på publikummer til øvelse</h2>
      <form action="addSpectatorToEvent.php" method="post">
        <select style="width: 100%" name="eventType" required="true">
          <?php foreach ($eventList as &$event):
            if ($event->getSpectator($spectatorID) == null):?>
              <option value="<?php echo $event->getType();?>" ><?php echo $event->getType();?></option>
            <?php endif;
          endforeach;?>
        </select>
        <input class="submit" style="margin-top: 10px;" type="submit" name="registerSpectator" value="Meld på publikummer">
      </form>
    </section>
  <?php endif; ?>

</main>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script rel="script" src="../script.js" type="text/javascript"></script>
</body>
</html>
<?php
else:
  include "../error.php";
endif;