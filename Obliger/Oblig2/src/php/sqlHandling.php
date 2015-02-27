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

function createTables() {
  $testing = false;

  $connect = getDBConnection();

  if (!$testing) {


    $createTables = "CREATE TABLE Athletes (
                        firstName VARCHAR(20) NOT NULL,
                        lastName VARCHAR(20) NOT NULL,
                        address VARCHAR(20) NOT NULL,
                        postalNr INT NOT NULL,
                        city VARCHAR(20) NOT NULL,
                        phoneNr INT PRIMARY KEY NOT NULL,
                        nationality VARCHAR(20) NOT NULL
                        );";

    $createTables .= "CREATE TABLE Spectators (
                        firstName VARCHAR(20) NOT NULL,
                        lastName VARCHAR(20) NOT NULL,
                        address VARCHAR(20) NOT NULL,
                        postalNr INT NOT NULL,
                        city VARCHAR(20) NOT NULL,
                        phoneNr INT PRIMARY KEY NOT NULL,
                        ticketType VARCHAR(20) NOT NULL
                        );";

    $createTables .= "CREATE TABLE SpectatorsInEvent (
                      phoneNr INT,
                      eventType VARCHAR(30),
                      PRIMARY KEY (phoneNr, eventType),
                      FOREIGN KEY (phoneNr) REFERENCES Spectators(phoneNr),
                      FOREIGN KEY (eventType) REFERENCES Events(type)
                      );";

    $createTables .= "CREATE TABLE AthletesInEvent (
                        phoneNr INT,
                        eventType VARCHAR(30),
                        PRIMARY KEY (phoneNr, eventType),
                        FOREIGN KEY (phoneNr) REFERENCES Athletes(phoneNr),
                        FOREIGN KEY (eventType) REFERENCES Events(type)
                        );";

    if ($connect->multi_query($createTables) == TRUE) {
      //Skriv til logg
    } else {
      //Skriv til logg
    }
  }

  $connect->close();
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

  while($row = $result->fetch_assoc()){
    array_push($rows, $row);
  }
  $toRet["athletesInEvents"] = $rows;

  $rows = array();
  $sql = "SELECT * FROM SpectatorsInEvents";
  $result = $connect->query($sql);
  while($row = $result->fetch_assoc()){

    array_push($rows, $row);
  }
  $toRet["spectatorsInEvents"] = $rows;

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
    $connect->close();
    return true;
  } else {
    echo "Error: " . $insert . "<br>" . $connect->error;
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
    echo "Error: " . $insert . "<br>" . $connect->error;
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
    echo "Error: " . $insert . "<br>" . $connect->error;
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
    echo "Error: " . $insert . "<br>" . $connect->error;
    $connect->close();
    return false;
  }

}