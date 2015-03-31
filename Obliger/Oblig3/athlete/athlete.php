<?php
include "../data.php";
session_start();
$athleteID = $_SERVER['QUERY_STRING'];

if ($worldCup->athleteExists($athleteID)):

  $athlete = $worldCup->getAthlete($athleteID);

  $_SESSION["athleteID"] = serialize($athleteID);
  $_SESSION["worldCup"] = serialize($worldCup);

  ?>

  <html>
  <head>
    <link rel="stylesheet" href="../style.css" type="text/css">
  </head>

  <body>

  <?php include "../main-menu.php";?>

  <header>
    <h1><?php echo $athlete->getFirstName() . " " . $athlete->getLastName()?></h1>
  </header>

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
          if ($event->getAthlete($athleteID) != null):
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

    <?php
    if ($_SESSION["logged_in"]):?>
      <section id="addToEvent">
        <h2>Meld på uttøver til øvelse</h2>
        <form action="addAthleteToEvent.php" method="post">
          <select name="eventType" required="true">
            <?php foreach ($eventList as &$event):
              if ($event->getAthlete($athleteID) == null):?>
                <option value="<?php echo $event->getType();?>" ><?php echo $event->getType();?></option>
              <?php endif;
            endforeach;?>
          </select>
          <input class="submit" style="margin-top: 10px;" type="submit" name="registerAthlete" value="Meld på uttøver">
        </form>
      </section>
    <?php endif;?>


  </main>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
  <script rel="script" src="../script.js" type="text/javascript"></script>
  </body>
  </html>

<?php
else:
  include "../error.php";
endif;?>