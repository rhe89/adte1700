<?php

require "Person.php";
require "Ticket.php";

$date = date("d-m-Y");

//Oppretter objekter som senere skal brukes til sending av mail og skriving til fil.
$person = new Person($_POST["navn"], $_POST["tlfnr"], $_POST["epost"]);
$ticket = new Ticket(new Person($_POST["navn"], $_POST["tlfnr"], $_POST["epost"]), $date, $_POST["billettype"], $_POST["antallBilletter"]);

/*
 * Starter en ny session som skal ta vare på person- og billett-objektene
 * etter at bestilling er bekreftet
 */
session_start();

/*
 * Sjekker om bestillingen er bekreftet. Hvis ikke, vises info om bestillingen
 * og muligheten til å bekrefte/avbryte bestillingen
 */
$confirmed = $_POST["confirmField"];
if (isset($confirmed) != true) {

    /*
     * Lagrer objektene i session-arrayen
     */
    $_SESSION["ticket"] = $ticket;
    $_SESSION["person"] = $person;?>
<html>
    <body>

    <p><?php echo "Dagens dato: ".$date;?></p>
    <h3>Vennligst bekreft din informasjon!</h3>
    <p>Navn: <?php echo $person->getName()?></p>
    <p>Telefonnummer: <?php echo $person->getPhone()?></p>
    <p>Epostadresse: <?php echo $person->getMail()?></p>
    <p>Billettype: <?php echo $ticket->getTicketType()?></p>
    <p>Antall billetter: <?php echo $ticket->getTicketCount()?></p>

    <form action="recieveInfo.php" method="post">
        <input type="text" name="confirmField" value="true" hidden>
        <input type="submit" value="Bekreft">
    </form>
    <a href="index.php"><button>Avbryt</button></a>
    </body>
</html>
<?php

} else {
    echo "Bestilling bekreftet! Sender mail og skriver ut bekreftelse! </br>";

    /*
     * Henter tilbake objektene fra session-arrayen, og bruker
     * funksjoner i ticket-objektet til å sende mail og
     * skrive til fil.
     */
    $person = $_SESSION["person"];
    $ticket = $_SESSION["ticket"];

    if ($ticket->sendMail()) {
        echo "Mail sendt! </br>";
    }

    if ($ticket->printConfirmation()) {
        echo "Bekreftelse skrevet til fil! </br>";
    }

}



