
<?php include "../data.php";
session_start();?>


<?php
if (isset($_SESSION["logged_in"])) { ?>
  <html>
  <head>
    <link rel="stylesheet" href="../style.css" type="text/css">
  </head>

  <body>

  <?php
  include "../main-menu.php";
  ?>

  <header>
    <h1>Registrering av uttøvere</h1>
  </header>

  <main>
    <section id="eventList">
      <form action="registerEvent.php" method="post">
        <p>Dato for øvelse: <input name="eventDate" type="date" required="true"></p>

        <p>Tidspunkt for øvelse: <input name="eventTime" type="time" required="true"></p>

        <p><input name="eventType" type="text" placeholder="Type øvelse (Eks. 50 km (K), Stafett (M)" required="true">
        </p>

        <p><input name="eventLocation" type="text" placeholder="Sted" required="true"></p>

        <input class="submit" type="submit" name="registerEvent" value="Registrer øvelse">
      </form>
    </section>
  </main>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
  <script rel="script" src="../script.js" type="text/javascript"></script>
  </body>
  </html>
  <?php
  $everythingFine = true;
  if (isset($_POST["registerEvent"])) {
    $eventDate = $_POST["eventDate"];
    $eventTime = $_POST["eventTime"];
    $eventType = $_POST["eventType"];
    $eventLocation = $_POST["eventLocation"];

    if (!preg_match("/[1-50]+[ ]+[k]+[m]+[ ][(]+[K-M]+[)]$/", $eventType) && !preg_match("/[a-z]+[ ][(]+[K-M]+[)]$/", $eventType)) {
      echo "Feil i navnet på øvelsen! <br>
            Skriv enten slik: [distanse] km (K)/(M) eller slik: [Øvelse] (K)/(M). <br>
            Eksempel: 50 km (M), Stafett (K), Sprint (K), 30 km (K)</br>";
      $everythingFine = false;
    }

    if (!preg_match("/[A-Z]+[a-z]{2,20}$/", $eventLocation)) {
      echo "Feil i måten stedet til øvelsen er skrevet. Det må være mellom 2 og 20 bokstaver, starte på en stor bokstav, med bokstaver fra a-z</br>";
      $everythingFine = true;
    }
    /*
     * Velger å ikke skjekke dato- og tids-format, da det i HTML5 lages ferdige felter for dette som det ikke kan gjøres feil på.
     */

    if ($everythingFine) {
      if ($worldCup->addEvent($eventDate, $eventTime, $eventType, $eventLocation)) {
        echo "Event lagt til i databasen!";
      };
    }
  }
} else {
  include "../error.php";
} ?>

