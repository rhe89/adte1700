<?php include "../data.php";
session_start(); ?>

<html>
<head>
  <link rel="stylesheet" href="../style.css" type="text/css">
</head>

<body>

<?php include "../main-menu.php";?>

<header>
  <h1>Registrering av publikummere</h1>
</header>

<main>
  <section>
    <form action="registerSpectator.php" method="post">
      <p><input name="firstName" type="text" placeholder="Fornavn på publikummer" required="true"></p>
      <p><input name="lastName" type="text" placeholder="Etternavn på publikummer" required="true"></p>
      <p><input name="address" type="text" placeholder="Adresse til publikummer" required="true"></p>
      <p><input name="postalNr" type="text" placeholder="Postnummer" required="true"></p>
      <p><input name="city" type="text" placeholder="By" required="true"></p>
      <p><input name="phoneNr" type="text" placeholder="Telefonnummer" required="true"></p>
      <p>Billettype: <select name="ticketType" required>
          <option value="vip">VIP</option>
          <option value="standing">Ståplass</option>
          <option value="forrest">I skogen</option>
        </select></p>
      <input class="submit" type="submit" name="registerSpectator" value="Registrer publikummer">
    </form>
  </section>
</main>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script rel="script" src="../script.js" type="text/javascript"></script>
</body>
</html>


<?php

$everythingFine = true;
if(isset($_POST["registerSpectator"])) {
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $address = $_POST["address"];
  $postalNr = $_POST["postalNr"];
  $city = $_POST["city"];
  $phoneNr = $_POST["phoneNr"];
  $ticketType = $_POST["ticketType"];

  if (!preg_match("/[A-Å]+[a-å]{1,20}$/", $firstName)) {
    echo "Fornavn er skrevet feil. Det må være mellom 1 og 20 bokstaver, starte på en stor bokstav, med bokstaver fra a-å</br>";
    $everythingFine = false;
  }

  if (!preg_match("/[A-Å]+[a-å]{1,20}$/", $lastName)) {
    echo "Etternavn er skrevet feil. Det må være mellom 1 og 20 bokstaver, starte på en stor bokstav, med bokstaver fra a-å</br>";
    $everythingFine = false;
  }

  if (!preg_match("/[A-Å]+[a-å1-9 ]{1,20}$/", $address)) {
    echo "Adresse er skrevet feil. Det må være mellom 1 og 30 bokstaver eller tall, starte på en stor bokstav, med bokstaver fra a-å</br>";
    $everythingFine = false;
  }

  if (!preg_match("/[0-9]{4}$/", $postalNr)) {
    echo "Postnummer er skrevet feil. Det må bestå av 4 tall fra 1-9</br>";
    $everythingFine = false;
  }

  if (!preg_match("/[A-Å]+[a-å]{1,20}$/", $city)) {
    echo "By er skrevet feil. Det må være mellom 1 og 20 bokstaver, starte på en stor bokstav, med bokstaver fra a-å</br>";
    $everythingFine = false;
  }

  if (!preg_match("/[0-9]{8}$/", $phoneNr)) {
    echo "Telefonnummer er skrevet feil. Det må bestå av 8 tall fra 1-9</br>";
    $everythingFine = false;
  }


  if ($everythingFine) {
    if ($worldCup->addSpectator($firstName, $lastName, $address, $postalNr, $city, $phoneNr, $ticketType)) {
      echo "Publikummer er nå registrert til mesterskapet!";
      echo '<meta http-equiv="refresh" content="0; url=http://localhost:8888/oblig3/index.php"/>';
    }
  }
}



?>

