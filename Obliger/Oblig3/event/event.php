<?php
include "../data.php";
session_start();

$eventID = $_SERVER['QUERY_STRING'];
$eventID = str_replace("space", " ", $eventID);

if ($worldCup->eventExists($eventID)):

$event = $worldCup->getEvent($eventID);

$_SESSION["event"] = serialize($event);

?>
<html>
<head>
  <link rel="stylesheet" href="../style.css" type="text/css">
</head>

<body>

<?php include "../main-menu.php";?>

<header>
  <h1><?php echo $event->getType()?></h1>
</header>

<main>
  <section id="athleteList">
    <table>
      <caption>Påmeldte uttøvere</caption>
      <thead>
      <tr>
        <th>Fornavn</th>
        <th>Etternavn</th>
        <th>Adresse</th>
        <th>Postnummer</th>
        <th>By</th>
        <th>Telefonnummer</th>
        <th>Nasjonalitet</th>
      </tr>
      </thead>
      <tbody>
      <?php
      foreach ($event->getAthletes() as &$athlete):?>
        <tr class="athlete-row" id="<?php echo $athlete->getPhoneNr();?>">
          <td><a><?php echo $athlete->getFirstName();?></a></td>
          <td><a><?php echo $athlete->getLastName();?></a></td>
          <td><a><?php echo $athlete->getAddress();?></a></td>
          <td><a><?php echo $athlete->getPostalNr();?></a></td>
          <td><a><?php echo $athlete->getCity();?></a></td>
          <td><a><?php echo $athlete->getPhoneNr();?></a></td>
          <td><a><?php echo $athlete->getNationality();?></a></td>

        </tr>
      <?php endforeach;?>
      </tbody>
    </table>
  </section>

  <section id="spectatorList">
    <table>
      <caption>Påmeldte publikummere</caption>
      <thead>
      <tr>
        <th>Fornavn</th>
        <th>Etternavn</th>
        <th>Adresse</th>
        <th>Postnummer</th>
        <th>By</th>
        <th>Telefonnummer</th>
        <th>Billettype</th>
      </tr>
      </thead>
      <tbody>
      <?php
      foreach ($event->getSpectators() as &$spectator):?>
        <tr class="spectator-row" id="<?php echo $spectator->getPhoneNr();?>">
          <td><a><?php echo $spectator->getFirstName();?></a></td>
          <td><a><?php echo $spectator->getLastName();?></a></td>
          <td><a><?php echo $spectator->getAddress();?></a></td>
          <td><a><?php echo $spectator->getPostalNr();?></a></td>
          <td><a><?php echo $spectator->getCity();?></a></td>
          <td><a><?php echo $spectator->getPhoneNr();?></a></td>
          <td><a><?php echo $spectator->getNationality();?></a></td>

        </tr>
      <?php endforeach;?>
      </tbody>
    </table>
  </section>

  <?php if(isset($_SESSION["logged_in"])) {?>
  <section>
    <form action="updateEvent.php" method="post">
    <table id="editEventDetails">
      <caption>Endre øvelsesdetaljer</caption>
      <thead>
      <tr>
        <th></th>
        <th>Originalt</th>
        <th>Endre?</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>
          Dato
        </td>
        <td><?php echo $event->getDate()?></td>
        <td>
          <input type="date" name="eventDate">
        </td>
      </tr>
      <tr>
        <td>
          Tidspunkt
        </td>
        <td><?php echo $event->getTime()?></td>
        <td>
          <input type="time" name="eventTime">
        </td>
      </tr>
      <tr>
        <td>
          Sted
        </td>
        <td><?php echo $event->getPlace()?></td>
        <td>
          <input type="text" name="eventPlace">
        </td>
      </tr>
      </tbody>

    </table>
      <input class="submit" type="submit" name="doChanges" value="Gjør endringer">

    </form>


  </section>
  <form action="deleteEvent.php" method="post">
    <input class="hidden-input" type="text" name="deleteEvent" value="delete" >
    <input class="submit" type="submit" value="Slett øvelse">
  </form>
  <?php }?>
</main>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script rel="script" src="../script.js" type="text/javascript"></script>
</body>
</html>
<?php
else:
  include "../error.php";
endif;
?>