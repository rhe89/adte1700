Fikk tilbakemelding sist om mange feilmeldinger hos deg når du rettet obligen min.
Ønsker derfor å beskrive antagelser og forutsetninger for denne leveringen.

Jeg bruker PHP versjon 5.4, HTML5, Javascript og CSS i denne leveringen.
Jeg har brukt IntelliJ som utviklerverktøy, og filene kjøres fra root-mappen som heter "/oblig2".
Filene er organisert slik:

"/athlete/*" - Her ligger alle sidene som omhandler uttøvere.
"/spectator/*" - Her ligger alle sidene som omhandler tilskuere.
"/event/*" - Her ligger alle sidene som omhandler øvelser.

"/php/*" - Her ligger alle filene som omhandler brorparten av backend-operasjonene,
blant annet objektene for øvelser, uttøvere og tilskuere, samt et hovedobjekt (SkiWorldCup)
som håndterer alle operasjoner med disse objektene. I tillegg gjøres interaksjonen
med MySQL i filen "sqlHandling.php", for å skille ting fra hverandre og gjøre det litt mer
oversiktlig. Tabellene som inneholder uttøvere og publikum til øvelser bruker "ON UPDATE CASCADE" og
"ON DELETE CASCADE" på fremmednøkler, slik at hvis en øvelse slettes, vil også uttøvere og publikum
som er registrert til øvelsen også automatisk slettes fra tabellene.

For å legge til øvelser, tilskuere og publikummere brukes menyen øverst i "index.php".
For å legge til tilskuere og publikummere til spesifikke øvelser, trykker man på en rad
i tabellene som representerer de enkeltvis i "index.php". Da havner man på en ny side,
med oversikt over øvelser de allerede er påmeldt til, samt en select-box som viser
hvilke øvelser de ikke er meldt på til og som de kan melde seg på til.

Om du igjen skulle få en haug av feilmeldinger ønsker jeg selvfølgelig og rette opp i det,
men da trenger jeg litt info om hva som er feil, da jeg ved testing av obligen på min PC,
PCene på skolen (UiO) og på en server på Internett ikke får noen feil.