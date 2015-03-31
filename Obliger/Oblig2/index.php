<?php include "data.php";?>

<html>
<head>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
<header>
  <h1>Registreringssystem for Ski-VM!</h1>
</header>

<nav>
  <ul>
    <li>
      <a href="event/registerEvent.php">Registrer ny øvelse</a>
    </li>

    <li>
      <a href="athlete/registerAthlete.php">Registrer uttøver</a>
    </li>

    <li>
      <a href="spectator/registerSpectator.php">Registrer publikum</a>
    </li>
  </ul>
</nav>
<main>
  <section id="eventList">
    <table>
      <caption>Liste over øvelser i årets VM (Klikk på en øvelse for å se deltakere og publikum)</caption>
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
      /*
       * Itererer gjennom hver event, som vil legges til en ny rad i tabellen. Hver rad
       * får en id lik event-typen, som gjør at den kan brukes for å laste inn en side
       * som viser mer info om hver spesifikke event vha. javascript
       */
        foreach ($eventList as &$event):
          $id = str_replace(" ", "space", $event->getType());;?>
          <tr class="event-row" id="<?php echo $id;?>">
            <td><a><?php echo $event->getType();?></a></td>
            <td><a><?php echo $event->getDate();?></a></td>
            <td><a><?php echo $event->getTime();?></a></td>
            <td><a><?php echo $event->getPlace();?></a></td>
          </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </section>

  <section id="athleteList">
    <table>
      <caption>Liste over deltagere i årets VM (Klikk på en uttøver for å se hvilke øvelser han/hun deltar i)</caption>
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
      foreach ($athletes as &$athlete):
        $id = str_replace(" ", "", $athlete->getPhoneNr());;?>
        <tr class="athlete-row" id="<?php echo $id;?>">
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
      <caption>Liste over publikummere i årets VM (Klikk på en person for å se hvilke øvelser han/hun skal se på)</caption>
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
      foreach ($spectators as &$spectator):
        $id = str_replace(" ", "", $spectator->getPhoneNr());;?>
        <tr class="spectator-row" id="<?php echo $id;?>">
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
</main>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script rel="script" src="script.js" type="text/javascript"></script>
</body>
</html>