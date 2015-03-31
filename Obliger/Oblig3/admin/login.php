<?php include "../data.php";
session_start();
if (!$_SESSION["logged_in"]) {
?>
<html>
<head>
  <link rel="stylesheet" href="../style.css" type="text/css">
</head>

<body>
  <main id="login-screen">
    <header>
      <h1>Vennligst fyll inn brukernavn og passord for å kunne utføre administrator-oppgaver.</h1>

    </header>
    <form name="form" action="login.php" method="post" onsubmit="return validateInput();">
      <p>
      <input id="username" name="username" type="text" placeholder="Brukernavn">
      <span class="error-message username-message-empty">Brukernavn må fylles ut.</span>
      </p>

      <p>
      <input id="password" name="password" type="password" placeholder="Passord">
      <span class="error-message password-message-empty">Passord må fylles ut.</span>
      </p>

      <input class="submit" type="submit" name="login" value="Logg inn">
    </form>

    <a id="register-admin" href="register-admin.php">Eller registrer deg</a>
  </main>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script>
  var usernameInput = $("#username");
  var passwordInput = $("#password");

  function checkUsername() {
    var username = document.form.username.value;

    if (username.length == 0) {
      $(".username-message-empty").css("display", "inline-block");
      return false;
    }
    else {
      $(".username-message-empty").css("display", "none");
      return true;
    }
  }

  function checkPassword() {
    var password = document.form.password.value;

    if (password.length == 0) {
      $(".password-message-empty").css("display", "inline-block");
      return false;
    }
    else {
      $(".password-message-empty").css("display", "none");
      return true;
    }
  }

  function validateInput() {
    return (checkUsername() && checkPassword());
  }
</script>

<?php
if (isset($_POST["login"])) {
  if (isset($_POST["username"]) && isset($_POST["password"]))
    if ($worldCup->validateLogin($_POST["username"], $_POST["password"])) {
      $_SESSION["logged_in"] = true;
      echo "<script> alert('Du er nå logget inn!') </script>";
      echo '<meta http-equiv="refresh" content="0; url=/oblig3/index.php"/>';
    }
  else
      echo "<p>Feil brukernavn eller passord!</p>";
  else
    echo "<p>Fyll ut brukernavn og passord!</p>";
}

} else {
  echo '<meta http-equiv="refresh" content="0; url=/oblig3/index.php"/>';
}
