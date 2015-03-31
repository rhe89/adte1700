<?php session_start();
;?>

<nav id="main-menu">
  <ul>
    <li>
      <a href="/oblig3/index.php">Hjem</a>
    </li>
    <li>
      <a href="/oblig3/spectator/registerSpectator.php">Registrer publikum</a>
    </li>
    <?php
    if ($_SESSION["logged_in"]) {?>
      <li>

        <span id="admin-menu-toggle">Administrator-meny</span>
        <nav id="admin-menu">
          <ul>
            <li>
              <a href="/oblig3/event/registerEvent.php">Registrer ny øvelse</a>
            </li>

            <li>
              <a href="/oblig3/athlete/registerAthlete.php">Registrer ny uttøver</a>
            </li>

            <li>
              <form action="/oblig3/main-menu.php" method="post">
                <input name="sign-out" class="submit" type="submit" value="Logg ut">
              </form>
            </li>
          </ul>
        </nav>
      </li>
    <?php } else { ?>
      <li>
        <a href="/oblig3/admin/login.php" id="login-button">Logg inn</a>
      </li>
    <?php
    }
    ?>
  </ul>
</nav>

<?php
if (isset($_POST["sign-out"])) {
  $_SESSION["logged_in"] = false;
  echo '<meta http-equiv="refresh" content="0; url=/oblig3/index.php"/>';

}

