<?php

class Ticket {
    private $person, $date, $ticketCount, $ticketType;

    public function __construct($person, $date, $ticketCount, $ticketType) {
        $this->person = $person;
        $this->date = $date;
        $this->ticketCount = $ticketCount;
        $this->ticketType = $ticketType;
    }

    public function sendMail() {
        $person = $this->person;

        $mailBody = "
        Dato: " . $this->date . "\n
        Navn: " . $person->getName() . "\n
        Telefonnummer: " . $person->getPhone() . "\n
        Mail: " . $person->getMail() . "\n
        Billettype: " . $this->ticketType . "\n
        Antall billetter: " . $this->ticketCount . "\n";

        $status = mail($person->getMail(), "Bekreftelse på kinobestilling ", $mailBody);
        return $status;
    }

    public function printConfirmation() {
        $person = $this->person;

        $myfile = fopen("filmbekreftelse.txt", "a");

        $txt = "
            Dato: " . $this->date . "\n
            Navn: " . $person->getName() . "\n
            Telefonnummer: " . $person->getPhone() . "\n
            Mail: " . $person->getMail() . "\n
            Billettype: " . $this->ticketType . "\n
            Antall billetter: " . $this->ticketCount . "\n
        ";

        fwrite($myfile, $txt);

        fclose($myfile);

        return true;

    }

    public function getTicketCount()
    {
        return $this->ticketCount;
    }

    public function getTicketType()
    {
        return $this->ticketType;
    }
}

?>