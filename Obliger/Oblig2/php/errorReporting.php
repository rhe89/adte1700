<?php

register_shutdown_function("quit");
/*
 * Bruker eksemplene fra forelseningen fra Uke 6 for å håndtere feil
 * og skrive dem til en loggfil på server istedet for å skrive dem ut på
 * nettsiden. Legg merke til URLen for å redigere til en side for fatale feil,
 * det er servernavnet hos meg, så det er mulig det er noe annet hos deg (Bruker MAMP).
 */
function quit() {
  $error = error_get_last();

  if ($error['type'] == E_ERROR) {
    $message = $error['message'] . "\n";
    error_log($message, 3, "logg.txt");
    header("Location: http://localhost:8888/oblig2/error.php");
  }
}

set_error_handler("custom_warning_handler", E_ALL);

function custom_warning_handler($errno, $errstr, $errfile, $errline) {
  $date = date('d-m-Y H:i');

  $error = $date . " " . $errfile . " " . $errline . " " . $errno . " " . $errstr . "\r\n";
  error_log($error, 3, "logg.txt");
}