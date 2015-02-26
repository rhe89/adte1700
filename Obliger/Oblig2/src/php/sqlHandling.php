<?php

function getDBConnection() {
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbName = "SkiWorldCup";

  $conn = new mysqli($servername, $username, $password, $dbName) or die();

  if ($conn->connect_error) {
    //Skriv til logg, die("Connection failed: " . mysqli_connect_error());
    die("Connection failed");
  }
  return $conn;
}

function insertDataToDB() {
  $testing = true;

  $connect = getDBConnection();

  if (!$testing) {
    $createEventTable = "CREATE TABLE Events (
                        date DATE NOT NULL,
                        time TIME NOT NULL,
                        type VARCHAR(30) PRIMARY KEY,
                        place VARCHAR(30) NOT NULL
                        )";
    if ($connect->query($createEventTable) === TRUE) {
      //Skriv til logg
    } else {
      //Skriv til logg
      echo ("Kunne ikke lage tabellen Events: <br>" . $connect->connect_error);
    }
    //$persNr, $firstName, $lastName, $address, $postalNr, $city, $phoneNr
    $createAthleteTable = "CREATE TABLE Athletes (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        firstName VARCHAR(20) NOT NULL,
                        lastName VARCHAR(20) PRIMARY KEY,
                        address VARCHAR(20) NOT NULL,
                        postalNr INT NOT NULL,
                        city VARCHAR(20) NOT NULL,
                        phoneNr VARCHAR(8) NOT NULL,
                        nationality VARCHAR(20) NOT NULL
                        )";
    if ($connect->query($createAthleteTable) === TRUE) {
      //Skriv til logg
    } else {
      //Skriv til logg
      echo ("Kunne ikke lage tabellen Athletes: <br>" . $connect->connect_error);
    }

    $createSpectatorTable = "CREATE TABLE Spectators (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        firstName VARCHAR(20) NOT NULL,
                        lastName VARCHAR(20) PRIMARY KEY,
                        address VARCHAR(20) NOT NULL,
                        postalNr INT NOT NULL,
                        city VARCHAR(20) NOT NULL,
                        phoneNr VARCHAR(8) NOT NULL,
                        ticketType VARCHAR(20) NOT NULL
                        )";
    if ($connect->query($createSpectatorTable) === TRUE) {
      //Skriv til logg
    } else {
      //Skriv til logg
      echo ("Kunne ikke lage tabellen Spectators: <br>" . $connect->connect_error);
    }

    $createSpectatorsInEventTable = "CREATE TABLE SpectatorsInEvent (
                        persID INT,
                        eventType VARCHAR(30),
                        PRIMARY KEY (persID, eventType),
                        FOREIGN KEY (persID) REFERENCES Spectators(id),
                        FOREIGN KEY (eventType) REFERENCES Events(event);
                        )";
    if ($connect->query($createSpectatorsInEventTable) === TRUE) {
      //Skriv til logg
    } else {
      //Skriv til logg
      echo ("Kunne ikke lage tabellen SpectatorsInEvent: <br>" . $connect->connect_error);
    }

    $createAthletesInEventTable = "CREATE TABLE AthletesInEvent (
                        persID INT,
                        eventType VARCHAR(30),
                        PRIMARY KEY (persID, eventType),
                        FOREIGN KEY (persID) REFERENCES Athletes(id),
                        FOREIGN KEY (eventType) REFERENCES Events(event);
                        )";
    if ($connect->query($createAthletesInEventTable) === TRUE) {
      //Skriv til logg
    } else {
      //Skriv til logg
      echo ("Kunne ikke lage tabellen AthletesInEvent: <br>" . $connect->connect_error);
    }
  }

  $connect->close();
}

function loadEveryThingFromDB($worldCup) {
  $connect = getDBConnection();

  $sql = "SELECT * FROM Events";

  $events = array();

  $result = $connect->query($sql);

  while($row = $result->fetch_assoc()){

    array_push($events, $row);
  }

  $connect->close();

}

function loadAthletesFromDB() {
  $connect = getDBConnection();

  $sql = "SELECT * FROM Athletes";

  $toRet = array();

  $result = $connect->query($sql);

  while($row = $result->fetch_assoc()){

    array_push($toRet, $row);
  }

  $connect->close();

  return $toRet;
}

function loadSpectatorsFromDB() {
  $connect = getDBConnection();

  $sql = "SELECT * FROM Spectators";

  $toRet = array();

  $result = $connect->query($sql);

  while($row = $result->fetch_assoc()){

    array_push($toRet, $row);
  }

  $connect->close();

  return $toRet;
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

    return false;
    //echo "Error: " . $insert . "<br>" . $connect->error;
  }
}

function addAthleteToDB($firstName, $lastName, $address, $postNr, $city, $phoneNr, $nationality) {
  $connect = getDBConnection();

  $insert =
    "INSERT INTO Athletes
      VALUES ('" . $firstName .  "', '" . $lastName .  "', '" . $address .  "', '" . $postNr .  "'
      , '" . $city .  "', '" . $phoneNr .  "', '" . $nationality .  "');";

  if ($connect->query($insert) === TRUE) {
    /*
     * Returnerer id'en (som autoinkrementerer), slik at den kan lagres i objektet og brukes som fremmednøkkel senere.
     */
    $connect->close();
    return $connect->insert_id;
  } else {
    echo "Error: " . $insert . "<br>" . $connect->error;
    $connect->close();
    return -1;
  }
}

function addSpectatorToDB($persNr, $firstName, $lastName, $address, $postNr, $city, $phoneNr, $ticketType) {
  $connect = getDBConnection();

  $insert =
    "INSERT INTO Spectators
      VALUES ('" . $persNr .  "', '" . $firstName .  "', '" . $lastName .  "', '" . $address .  "', '" . $postNr .  "'
      , '" . $city .  "', '" . $phoneNr .  "', '" . $ticketType .  "');";

  if ($connect->query($insert) === TRUE) {
    /*
     * Returnerer id'en (som autoinkrementerer), slik at den kan lagres i objektet og brukes som fremmednøkkel senere.
     */
    $connect->close();
    return $connect->insert_id;
  } else {
    echo "Error: " . $insert . "<br>" . $connect->error;
    $connect->close();
    return -1;
  }
}

function addSpectatorInEventToDB($persNr, $eventType) {
  $connect = getDBConnection();

  $insert =
    "INSERT INTO SpectatorsInEvents
      VALUES ('" . $persNr .  "', '" . $eventType .  "');";

  if ($connect->query($insert) === TRUE) {
    //Skriv til logg
    $connect->close();
    return true;
  } else {
    echo "Error: " . $insert . "<br>" . $connect->error;
    $connect->close();
    return false;
  }
}

function addAthletesInEventToDB($persNr, $eventType) {
  $connect = getDBConnection();

  $insert =
    "INSERT INTO AthletesInEvents
      VALUES ('" . $persNr .  "', '" . $eventType .  "');";

  if ($connect->query($insert) === TRUE) {
    //Skriv til logg
    $connect->close();
    return true;
  } else {
    echo "Error: " . $insert . "<br>" . $connect->error;
    $connect->close();
    return false;
  }

}