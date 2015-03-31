<?php include "data.php";?>

<html>
<head>
  <link rel="stylesheet" href="../style.css" type="text/css">
</head>

<body>
<main id="login-screen">
  <header>
    <h1>Vennligst fyll inn navn, ønsket brukernavn og passord for å kunne registrere deg som
      administrator.</h1>

  </header>
  <form action="register-admin.php" method="post" name="form" onsubmit="return validateInput();">
    <p>
      <input id="name" name="name" type="text" placeholder="Fullt navn">
      <span class="error-message name-message-empty">Navn må fylles ut.</span>
      <span class="error-message name-message-length">Navn må være mellom 5 og 30 bokstaver.</span>
    </p>
    <p>
      <input id="username" name="username" type="text" placeholder="Ønsket brukernavn">
      <span class="error-message username-message-empty">Brukernavn må fylles ut.</span>
      <span class="error-message username-message-length">Brukernavn må være mellom 5 og 30 tegn.</span>
    </p>
    <p>
      <input id="password" name="password" type="password" placeholder="Ønsket passord">
      <span class="error-message password-message-empty">Passord må fylles ut.</span>
      <span class="error-message password-message-length">Passord må være mellom 6 og 20 tegn.</span>
    </p>
    <p>
      <input id="passwordRepeat" name="passwordRepeat" type="password" placeholder="Gjenta passord">
      <span class="error-message repeat-password-message-empty">Passord må fylles ut.</span>
      <span class="error-message repeat-password-length">Passord må være mellom 6 og 20 tegn.</span>
      <span class="error-message password-message-no-match">Passordene er ikke like.</span>

    </p>
    <input class="submit" type="submit" name="submit-user" value="Registrer bruker">
  </form>
</main>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script src="client-validation.js"></script>

<?php
if (isset($_POST["submit-user"])) {
  $name = $_POST["name"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $passwordRepeat = $_POST["passwordRepeat"];


  if (validateInput($name, $username, $password, $passwordRepeat)) {
    if ($worldCup->usernameExists($username))
      echo "Brukernavn finnes allerede!";
    else if ($worldCup->addAdmin($name, $username, $password)) {
      echo "Ny administrator lagt til!";
      echo '<meta http-equiv="refresh" content="0; url=http://localhost:8888/oblig3/index.php"/>';
    }
    else
      echo "Kunne ikke legge til administrator";
  } else {
    echo "Kunne ikke legge til administrator";
  }
}
function validateInput($name, $username, $password, $passwordRepeat) {


  if (strlen($name) == 0) {
    echo "<p>Navn må fylles ut.</p>";
    return false;
  }
  if (strlen($username) == 0) {
    echo "<p>Brukernavn må fylles ut.</p>";
    return false;
  }
  if (strlen($password) == 0) {
    echo "<p>Passord må fylles ut.</p>";
    return false;
  }
  if (strlen($passwordRepeat) == 0) {
    echo "<p>Gjentakelse av passord må fylles ut.</p>";
  }

  if (!preg_match("/^[A-Za-z ]{5,30}$/", $name)) {
    echo "<p>Navn er skrevet feil.<br>
            Må inneholde 5 til 30 bokstaver fra A-Z, store eller små bokstaver, ingen tall.</p>";
    return false;
  }

  if (!preg_match("/^[A-Za-z0-9]{5,30}$/", $username)) {
    echo "<p>Brukernavn er skrevet feil</br>
        Må inneholde 5 til 30 tegn, store eller små bokstaver, uten mellomrom.</p>";
    return false;
  }

  if (!preg_match("/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/", $password)) {
    echo "<p>Passord er skrevet feil</br>
        Må inneholde 6 til 20 tegn fra A-Z eller !@#$%^&*()_, store eller små bokstaver.</p>";
    return false;
  }

  if ($password != $passwordRepeat) {
    echo "<p>Passordene er ikke like</p>";
    return false;
  }
  return true;
}
