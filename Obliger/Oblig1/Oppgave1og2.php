<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

/*
 * Har valgt å representere oppgavene i klasser, og alle deloppgavene
 * som funksjoner i hver klasse. Derfor er oppgave 2 d og e samme funksjon.
 */
$opppgave1 = new Oppgave1();
$opppgave1->oppgave1A();
$opppgave1->oppgave1B();
$opppgave1->oppgave1c();

$oppgave2 = new Oppgave2();
$oppgave2->oppgave2A();
$oppgave2->oppgave2B();
$oppgave2->oppgave2C();
$oppgave2->oppgave2DogE();


//Oppgave 2F
$limit = 6;
$tall = $oppgave2->oppgave2Fdel1($limit);

for ($i = 0; $i < count($tall); $i++) {
    if ($tall[$i] > $limit) {
        echo $tall[$i] . "</br>";
    }
}
$oppgave2->oppgave2Fdel2($limit);


class Oppgave1
{

    public function __construct() {
        echo "</br></br> ----------------------- Oppgave 1 ----------------------- ";
    }

    function oppgave1A()
    {
        echo "</br> Oppgave 1 a: </br>";
        for ($i = 0; $i <= 100; $i++) {
            if ($i % 3 == 0) echo $i . "</br>";
        }
    }

    function oppgave1B()
    {
        echo "</br> Oppgave 1 b: </br>";
        $i = 0;
        while ($i <= 100) {
            if ($i % 3 == 0) echo $i . "</br>";

            $i++;
        }
    }

    function oppgave1C()
    {
        echo "</br> Oppgave 1 c: </br>";
        $counter = 0;
        $sum = 0;

        for ($i = 0; $i <= 100; $i++) {
            if ($i % 3 == 0) {
                $sum += $i;
                $counter++;
            }
        }
        $avg = $sum / $counter;

        echo "Gjennomsnitt av tallene som er delelig på 3 er: " . $avg . "</br>";
    }
}

class Oppgave2 {

    private $tall;

    public function __construct()
    {
        echo "</br></br> ----------------------- Oppgave 2 ----------------------- ";
        $this->tall = array(1,4,8,1,4,10,5,6,2,4,6);
    }

    public function oppgave2A() {
        echo "</br> Oppgave 2 a: </br>";

        $tall = $this->tall;
        for ($i = 0; $i < count($tall); $i++) {
            if ($tall[$i] > 5) echo $tall[$i] . "</br>";
        }
    }

    public function oppgave2B() {
        echo "</br> Oppgave 2 b: </br>";
        $counter = 0;
        $tall = $this->tall;
        for ($i = 0; $i < count($tall); $i++) {
            if ($tall[$i] > 5) $counter++;
        }

        echo "Antall tall som er over 5: " . $counter . "</br>";
    }

    public function oppgave2C() {
        echo "</br> Oppgave 2 c: </br>";

        $tall = $this->tall;
        for ($i = count($tall)-1; $i >= 0; $i--) {
           echo $tall[$i] . "</br>";
        }
    }

    public function oppgave2DogE() {
        echo "</br> Oppgave 2 d og e: </br>";

        $tall = $this->tall;
        $min = PHP_INT_MAX;

        for ($i = 0; $i < count($tall); $i++) {

            if ($min > $tall[$i]) {
                $min = $tall[$i];
            }
        }

        echo "Det minste tallet er: " . $min . "<br/>";

    }

    public function oppgave2Fdel1($limit) {
        echo "</br> Oppgave 2 f del 1: </br>";

        $tall = $this->tall;
        $toRet = array();
        for ($i = 0; $i < count($tall); $i++) {
            if ($tall[$i] > $limit) {
                $toRet[] = $tall[$i];
            }
        }

        return $toRet;
    }

    public function oppgave2Fdel2($limit) {
        echo "</br> Oppgave 2 f del 2: </br>";
        $counter = 0;
        $tall = $this->tall;
        for ($i = 0; $i < count($tall); $i++) {
            if ($tall[$i] > $limit) $counter++;
        }

        echo "Antall tall som er over " . $limit . ": " . $counter . "</br>";
    }
}

