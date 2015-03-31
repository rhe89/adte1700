For å kunne utføre adminoppgaver må man logge inn, som gjøres via menyen
øverst. Når innlogget kan man utføre de oppgaver i oppgaveteksten som kreves.
Hvis man prøver å gå inn på en side manuelt uten å være innlogget, vises
en feilmeldingsside. Siden uttøver- og øvelsehåndtering gjøres på
spesifikke sider for den uttøveren eller øvelsen, vil disse skjemaene,
om man ikke er logget inn, ikke blir vist.

Når man logger inn lagres en boolean i session-arrayen, når man logger ut slettes
denne indeksen fra samme array. Det er opp mot denne variabelen man sjekker innlogging.
Ellers brukes både klient- og server-validering med RegEX for registrering av administratorer.
Jeg har valgt å ikke bruke HTML5-validering pga av at jeg nå bruker Javascript.

Administratorer registreres med navn, ønsket brukernavn og passord, og brukernavn brukes som
primærnøkkel i tabellen i databasen.


Her er forutsetningene for forrige Oblig, som fortsatt gjelder for denne:

Jeg bruker PHP versjon 5.4, HTML5, Javascript og CSS i denne leveringen.
Jeg har brukt IntelliJ som utviklerverktøy, og filene kjøres på server fra mappen som heter
"/oblig2". Filene er organisert slik:

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

I innleveringen blir også eventuelle warnings og fatal errors håndtert, og skrevet til en fil
(som blir opprettet ved behov) på server ved navn "logg.txt".

I min innlevering har jeg med en funksjon som oppretter og legger inn data i tabellene i databasen
slik at det er mulig å teste de ganske raskt (i tillegg til skjemaer for å legge til data på
nettsiden, selvsagt). Siden oppgaven er så åpen så tenkte jeg det var greiest å gjøre det slik
da alle sikkert har forskjellige kolonnennavn og til og med tabellnavn i databasene sine.

I tillegg kjører jeg databasen i MAMP, og dermed vil serveradressen (hos meg) være localhost:8888,
og om den er noe annet hos deg vil jo det skape problemer.

Om du igjen skulle få en haug av feilmeldinger ønsker jeg selvfølgelig og rette opp i det,
men da trenger jeg litt info om hva som er feil, da jeg ved testing av obligen på min PC,
PCene på skolen (UiO) og på en server på Internett ikke får noen feil.