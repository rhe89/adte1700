<html>
<head>
  <?php include "../data.php" ?>
  <link rel="stylesheet" href="../style.css" type="text/css">
</head>

<body>
<header>
  <h1>Registreringssystem for Ski-VM!</h1>
</header>

<nav>
  <ul>
    <li>
      <a href="../index.php">Tilbake</a>
    </li>
  </ul>
</nav>
<main>
  <section>
    <form action="registerAthlete.php" method="post">
      <p><input name="firstName" type="text" placeholder="Fornavn på uttøver"></p>
      <p><input name="lastName" type="text" placeholder="Etternavn på uttøver"></p>
      <p><input name="address" type="text" placeholder="Adresse til uttøver"></p>
      <p><input name="postalNr" type="text" placeholder="Postnummer"></p>
      <p><input name="city" type="text" placeholder="By"></p>
      <p><input name="phoneNr" type="text" placeholder="Telefonnummer"></p>
      <p><input name="nationality" type="text" placeholder="Nasjonalitet"></p>
      <input type="submit" name="registerAthlete" value="Registrer uttøver">
    </form>
  </section>
</main>

<script rel="script" src="../script.js" type="text/javascript"></script>
</body>
</html>


<?php

$everythingFine = true;
if(isset($_POST["registerAthlete"])) {
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $address = $_POST["address"];
  $postalNr = $_POST["postalNr"];
  $city = $_POST["city"];
  $phoneNr = $_POST["phoneNr"];
  $nationality = $_POST["nationality"];

  if (!preg_match("/[A-Å]+[a-å]{1,20}$/", $firstName)) {
    echo "Fornavn er skrevet feil. Det må være mellom 1 og 20 bokstaver, starte på en stor bokstav, med bokstaver fra a-å</br>";
    $everythingFine = false;
  }

  if (!preg_match("/[A-Å]+[a-å]{1,20}$/", $lastName)) {
    echo "Etternavn er skrevet feil. Det må være mellom 1 og 20 bokstaver, starte på en stor bokstav, med bokstaver fra a-å</br>";
    $everythingFine = false;
  }

  if (!preg_match("/[A-Å]+[a-å1-9 ]{1,20}$/", $address)) {
    echo "Adresse er skrevet feil. Det må være mellom 1 og 20 bokstaver eller tall, starte på en stor bokstav, med bokstaver fra a-å</br>";
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

  if (!preg_match("/[A-Å]+[a-å]{1,20}$/", $nationality)) {
    echo "Nasjonalitet er skrevet feil. Det må være mellom 1 og 20 bokstaver, starte på en stor bokstav, med bokstaver fra a-å</br>";
    $everythingFine = false;
  }

  if ($everythingFine) {
    if ($worldCup->addAthlete($firstName, $lastName, $address, $postalNr, $city, $phoneNr, $nationality)) {
      echo "Uttøver er nå registrert til mesterskapet!";
    }
  }
}



?>