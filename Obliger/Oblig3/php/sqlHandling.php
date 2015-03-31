<?php

/*
 * Denne php-filen tar seg av all interaksjon med databasen.
 */
function getDBConnection() {
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbName = "SkiWorldCup";

  $conn = new mysqli($servername, $username, $password, $dbName) or die();

  if ($conn->connect_error) {
    error_log("Feil opprettelse av forbindelse til database:" . mysqli_connect_error() . "\n", 3, "logg.txt");
    header("Location: /oblig3/error.php");
    die("Connection failed");

  }
  return $conn;
}

/*
 * Sett $testing til true før kjøring for å opprette tabellene og legge til uttøvere og publikummere.
 */
function createTables()
{
  $testing = false;
  $testing2 = false;

  if ($testing) {

    $connect = getDBConnection();

    $createTables = "CREATE TABLE Events (
                        date DATE NOT NULL,
                        time TIME NOT NULL,
                        type VARCHAR(30) PRIMARY KEY,
                        place VARCHAR(30) NOT NULL
                        );";

    $createTables .= "CREATE TABLE Athletes (
                        firstName VARCHAR(20) NOT NULL,
                        lastName VARCHAR(20) NOT NULL,
                        address VARCHAR(20) NOT NULL,
                        postalNr VARCHAR(4) NOT NULL,
                        city VARCHAR(20) NOT NULL,
                        phoneNr INT PRIMARY KEY NOT NULL,
                        nationality VARCHAR(20) NOT NULL
                        );";

    $createTables .= "CREATE TABLE Spectators (
                        firstName VARCHAR(20) NOT NULL,
                        lastName VARCHAR(20) NOT NULL,
                        address VARCHAR(20) NOT NULL,
                        postalNr VARCHAR(4) NOT NULL,
                        city VARCHAR(20) NOT NULL,
                        phoneNr INT PRIMARY KEY NOT NULL,
                        ticketType VARCHAR(20) NOT NULL
                        );";

    $createTables .= "CREATE TABLE SpectatorsInEvents (
                      phoneNr INT,
                      eventType VARCHAR(30),
                      PRIMARY KEY (phoneNr, eventType),
                      FOREIGN KEY (phoneNr) REFERENCES Spectators(phoneNr) ON UPDATE CASCADE ON DELETE CASCADE,
                      FOREIGN KEY (eventType) REFERENCES Events(type) ON UPDATE CASCADE ON DELETE CASCADE
                      ); \n";

    $createTables .= "CREATE TABLE AthletesInEvents (
                        phoneNr INT,
                        eventType VARCHAR(30),
                        PRIMARY KEY (phoneNr, eventType),
                        FOREIGN KEY (phoneNr) REFERENCES Athletes(phoneNr) ON UPDATE CASCADE ON DELETE CASCADE,
                        FOREIGN KEY (eventType) REFERENCES Events(type) ON UPDATE CASCADE ON DELETE CASCADE
                        );";


    $createTables .= "INSERT INTO Athletes (firstName, lastName, address, postalNr, city, phoneNr, nationality) VALUES
            ('Petter', 'Northug', 'Mosvika 1', '9282', 'Trondheim', 12345678, 'Norge'),
            ('Dario', 'Cologna', 'Santa Maria 1', '7777', 'Santa Maria', 12348765, 'Sveits'),
            ('Marcus', 'Hellner', 'Lerdalaveien 1', '2345', 'Lerdala', 87651234, 'Sverige'),
            ('Martin', 'Johnsrud Sundby', 'RÃ¸aveien 1', '2222', 'Oslo', 87654321, 'Norge');";

    $createTables .= "INSERT INTO Events (date, time, type, place) VALUES
              ('2015-06-26', '13:13:00', 'Sprint (M)', 'Falun'),
              ('2015-02-15', '13:30:00', 'Stafett (K)', 'Falun');";

    $createTables .= "INSERT INTO Spectators (firstName, lastName, address, postalNr, city, phoneNr, ticketType) VALUES
              ('Petter', 'Hoel', 'Hoelveien 1', '0982', 'Oslo', 11223344, 'vip'),
              ('Magnus', 'Li', 'Liveien 1', '9999', 'Drammen', 22334455, 'vip'),
              ('Roar', 'Hoksnes Eriksen', 'Fossumkroken 11', '0982', 'Oslo', 97514420, 'vip');";


    if ($connect->multi_query($createTables) == FALSE) {
      error_log("Feil under opprettelse av tabeller eller insetting i disse:" . "\n" . $connect->error, 3, "logg.txt");
    }

    $connect->close();
  }

  if ($testing2) {

    $connect = getDBConnection();

    $createTables = "CREATE TABLE Administrators (
                        username VARCHAR(30) PRIMARY KEY,
                        password VARCHAR(100) NOT NULL,
                        name VARCHAR(40) NOT NULL,
                        salt VARCHAR(30) NOT NULL
                        );";


    if ($connect->multi_query($createTables) == FALSE) {

      error_log("Feil under opprettelse av tabeller eller insetting i disse:" . "\n" . $connect->error, 3, "logg.txt");
    }

    $connect->close();
  }
}

function loadTablesFromDB() {
  $connect = getDBConnection();

  $toRet = array();
  $rows = array();

  $sql = "SELECT * FROM Events";
  $result = $connect->query($sql);

  while($row = $result->fetch_assoc()){

    array_push($rows, $row);
  }
  $toRet["events"] = $rows;

  $rows = array();
  $sql = "SELECT * FROM Athletes";
  $result = $connect->query($sql);

  while($row = $result->fetch_assoc()){

    array_push($rows, $row);
  }
  $toRet["athletes"] = $rows;

  $rows = array();
  $sql = "SELECT * FROM Spectators";
  $result = $connect->query($sql);

  while($row = $result->fetch_assoc()){

    array_push($rows, $row);
  }
  $toRet["spectators"] = $rows;

  $rows = array();
  $sql = "SELECT * FROM AthletesInEvents";

  $result = $connect->query($sql);

  if ($result == true) {
    while($row = $result->fetch_assoc()) {
      array_push($rows, $row);
    }
    $toRet["athletesInEvents"] = $rows;
  } else {
    $toRet["athletesInEvents"] = array();
  }

  $rows = array();
  $sql = "SELECT * FROM SpectatorsInEvents";
  $result = $connect->query($sql);
  if ($result == true) {
    while($row = $result->fetch_assoc()) {
      array_push($rows, $row);
    }
    $toRet["spectatorsInEvents"] = $rows;
  } else {
    $toRet["spectatorsInEvents"] = array();
  }

  $connect->close();

  return $toRet;
}

function addAdminToDB($name, $username, $password) {
  $salt = mcrypt_create_iv(30);

  $passwordToHash = $salt . $password;

  $hashToDB = Hash("sha256", $passwordToHash);

  $connect = getDBConnection();
  $insert = "
  INSERT INTO Administrators VALUES ('" . $username . "', '$hashToDB', '" . $name . "', '$salt');";


  if ($connect->query($insert) === TRUE) {
    $connect->close();

    return true;

  } else {
    $connect->close();

    error_log("Feil under innsetting av rad i Administrators: " . $insert . "\n" . $connect->error, 3, "logg.txt");
    return false;
  }
}

function usernameExistsInDB($username) {
  $connect = getDBConnection();

  $select = "SELECT * FROM Administrators
             WHERE username = '$username';";

  $result = $connect->query($select);

  $num_rows = $result->num_rows;

  if ($num_rows == 1) return true;
  else return false;
}
function adminExistsInDB($userName, $password) {
  $connect = getDBConnection();

  $select = "SELECT salt FROM Administrators
              WHERE username = '$userName'";
  $result = $connect->query($select);

  $num_rows = $result->num_rows;

  if ($num_rows == 0) return false;

  $salt = $result->fetch_assoc()["salt"];

  $passwordToHash = $salt . $password;

  $hashedPassword = Hash("sha256", $passwordToHash);

  $select = "SELECT * FROM Administrators
             WHERE username = '$userName' AND
              password = '$hashedPassword';";

  $result = $connect->query($select);

  $num_rows = $result->num_rows;

  if ($num_rows > 0) return true;
  else return false;
}
function addEventToDB($eventDate, $eventTime, $eventType, $eventLocation) {
  $connect = getDBConnection();

  $insert =
    "INSERT INTO Events
      VALUES ('" . $eventDate .  "', '" . $eventTime .  "', '" . $eventType .  "', '" . $eventLocation .  "');";

  if ($connect->query($insert) === TRUE) {
    $connect->close();

    return true;

  } else {
    $connect->close();
    error_log("Feil under innsetting av rad i Events: " . $insert . "\n" . $connect->error, 3, "logg.txt");
    return false;
  }
}

function addAthleteToDB($firstName, $lastName, $address, $postNr, $city, $phoneNr, $nationality) {
  $connect = getDBConnection();

  $insert =
    "INSERT INTO Athletes
      VALUES ('" . $firstName .  "', '" . $lastName .  "', '" . $address .  "', '" . $postNr .  "'
      , '" . $city .  "', '" . $phoneNr .  "', '" . $nationality .  "');";

  if ($connect->query($insert) === TRUE) {
    $connect->close();
    return true;
  } else {
    error_log("Feil under innsetting av rad i Athletes: " . $insert . "\n" . $connect->error, 3, "logg.txt");
    $connect->close();
    return false;
  }
}

function addSpectatorToDB($firstName, $lastName, $address, $postNr, $city, $phoneNr, $ticketType) {
  $connect = getDBConnection();

  $insert =
    "INSERT INTO Spectators
      VALUES ('" . $firstName .  "', '" . $lastName .  "', '" . $address .  "', '" . $postNr .  "'
      , '" . $city .  "', '" . $phoneNr .  "', '" . $ticketType .  "');";

  if ($connect->query($insert) === TRUE) {
    $connect->close();
    return true;
  } else {
    error_log("Feil under innsetting av rad i Spectators: " . $insert . "\n" . $connect->error, 3, "logg.txt");
    $connect->close();
    return false;
  }
}

function addSpectatorInEventToDB($phoneNr, $eventType) {
  $connect = getDBConnection();

  $insert =
    "INSERT INTO SpectatorsInEvents
      VALUES ('" . $phoneNr .  "', '" . $eventType .  "');";

  if ($connect->query($insert) === TRUE) {
    //Skriv til logg
    $connect->close();
    return true;
  } else {
    error_log("Feil under innsetting av rad i SpectatorsInEvents: " . $insert . "\n" . $connect->error, 3, "logg.txt");
    $connect->close();
    return false;
  }
}

function addAthleteInEventToDB($phoneNr, $eventType) {
  $connect = getDBConnection();

  $insert =
    "INSERT INTO AthletesInEvents
      VALUES ('" . $phoneNr .  "', '" . $eventType .  "');";

  if ($connect->query($insert) === TRUE) {
    //Skriv til logg
    $connect->close();
    return true;
  } else {
    error_log("Feil under innsetting av rad i AthletesInEvent: " . $insert . "\n" . $connect->error, 3, "logg.txt");
    $connect->close();
    return false;
  }

}

function updateEventTable($eventDate, $eventTime, $eventType, $eventPlace) {
  $connect = getDBConnection();

  $update =
    "UPDATE Events
    SET date = '" . $eventDate . "',
    time = '" . $eventTime . "',
    place = '" . $eventPlace . "'
    WHERE type = '" . $eventType . "';
  ";

  if ($connect->query($update) === true) {
    $connect->close();
  } else {
    error_log("Feil under oppdatering av rad i Event: " . $update . "\n" . $connect->error, 3, "logg.txt");
    $connect->close();
  }
}

function deleteEvent($eventType) {
  $connect = getDBConnection();

  $delete =
    "DELETE FROM Events
      WHERE type = '" . $eventType . "';
  ";

  if ($connect->query($delete) === true) {
    $connect->close();
    return true;
  } else {
    error_log("Feil under sletting av rad i Event: " . $delete . "\n" . $connect->error, 3, "logg.txt");
    $connect->close();
    return false;
  }
}