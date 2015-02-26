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
      die ("Kunne ikke lage tabellen Events");
    }
  }

  if (!$testing) {
    $insertIntoEventTable =
      "INSERT INTO Events (date, time, type, place)
      VALUES ('2015/02/15', '13:30:00', 'Stafett (K)', 'Falun');";
    $insertIntoEventTable .=
      "INSERT INTO Events (date, time, type, place)
      VALUES ('2015/02/16', '13:30:00', 'Stafett (M)', 'Falun');";
    $insertIntoEventTable .=
      "INSERT INTO Events (date, time, type, place)
      VALUES ('2015/02/17', '13:30:00', '30 km (K)', 'Falun');";
    $insertIntoEventTable .=
      "INSERT INTO Events (date, time, type, place)
      VALUES ('2015/02/17', '13:30:00', '50 km (M)', 'Falun');";

    /*
     * Skal gjøre flere queries til databasen, derfor brukes multi_query
     */
    if ($connect->multi_query($insertIntoEventTable) === TRUE) {
      //Skriv til logg
    } else {
      //Skriv til logg
      echo "Error: " . $insertIntoEventTable . "<br>" . $connect->error;
    }
  }

  $connect->close();
}

function loadEventsFromDB() {

  $connect = getDBConnection();

  $sql = "SELECT * FROM Events";

  $events = array();

  $result = $connect->query($sql);


  while($row = $result->fetch_assoc()){

    array_push($events, $row);
  }

  $connect->close();

  return $events;

}