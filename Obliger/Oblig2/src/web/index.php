<html>
<head>
  <?php include "data.php"?>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
<header>
  <h1>Registreringssystem for Ski-VM!</h1>
</header>

<nav>
  <ul>
    <li>
      <a href="registerEvent.php">Registrer ny øvelse</a>
    </li>

    <li>
      <a href="registerAthlete.php">Registrer uttøver</a>
    </li>

    <li>
      <a href="registerSpectator.php">Registrer publikum</a>
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
          $id = str_replace(" ", "", $event->getType());;?>
          <tr id="<?php echo $id;?>">
            <td><a><?php echo $event->getType();?></a></td>
            <td><a><?php echo $event->getDate();?></a></td>
            <td><a><?php echo $event->getTime();?></a></td>
            <td><a><?php echo $event->getPlace();?></a></td>
          </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </section>
</main>

<script rel="script" src="script.js" type="text/javascript"></script>
</body>
</html>