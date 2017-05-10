<main>
  <article>
    <h1>Report</h1>
    <h2>kmom01</h2>
    <h3>Hur känns det att hoppa rakt in i klasser med PHP, gick det bra?</h3>
    <p>
      Ja det gick bra tycker jag, det sklijde sig inte så mycket mot hur man jobbar med klasser i Python.
      Jag jobbade inte igenom hela oophp på 20 steg då jag kände att jag behövde börja med uppgifterna, men jag gjorde tillräckligt för att förstå hur man använder klasser i php.
      Det blev svårare med Guessupgiften än vad jag hade räknat med, vilket nog mest berodde på att det var ett tag sen som jag programmerade i PHP. Men det var en bra uppgift på så sätt för att friska upp minnet och även lära mig mycket nytt.
      Det var ett mycket omfattande kursmoment där det var mycket att läsa och ganska stora uppgifter särskilt med tanke på att detta var det första kursmomentet.
    </p>

    <h3>Berätta om dina reflektioner kring ramverk, anax-lite och din me-sida.</h3>
    <p>
      Det var intressant att göra som ett eget ramverk även fast vi lånade mycket kod. Men det känns som att jag har en bättre förståelse för hur ramverk är uppbyggda och särskilt Anax-flat som vi använde i en tidigare kurs.
      Jag hade inga större problem med att göra mitt anax-lite utan man behövde ju bara följa övningen som fanns. Min me sida är inte särskilt märkvärdig, jag använde bootstrap för att styla den och hann inte lägga ned särskilt mycket tid på stylen.
      Det finns med två bilder på me och about sidan, jag har även lagt till som en byline på me-sidan och använder navbaren ifrån navbaruppgiften.
    </p>

    <h3>Gick det bra att komma igång med MySQL, har du liknande erfarenheter sedan tidigare?</h3>
    <p>
      Det var inga problem att göra SQL-uppgiften då jag har hållt på en del med det tidigare, dels under tidigare kurser men även innan dess. Jag har tidigare använt phpmyadmin, men för den här uppgiften så använde jag Workbench och det var ett väldigt smidigt och bra verktyg.
      Jag gjorde 5 utav punkterna som blir en tredje del utav uppgiften och ser fram emot att göra färdigt resten utav uppgiften under kommande kursmoment.
    </p>

    <h2>kmom02</h2>
    <h3>Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?</h3>
    <p>
      Jag vet inte riktigt om jag förstår vad som menas med att skriva inuti ramverket. Men om det är t.ex så som vi har gjort med klassen för navbaren genom att lägga till den i frontkontrollern, så man kan använde klassen överallt i ramverket så ser jag nog bara fördelar med det.
      Jag försöker dock undvika att använda mig utav allt för mycket kod i vyerna och använder bara dem för att skriva ut saker.
    </p>

    <h3>Hur väljer du att organisera dina vyer?</h3>
    <p>
      Alla vyerna ligger i mappen view. Vyn för navbaren ligger i en egen mapp precis som man skulle göra enligt uppgiften.
      Och sedan ligger resten utav vyerna i take1 mappen, det kanske blir så att jag strukturerar om lite och skapar fler mappar att lägga vyerna i, men just nu får det duga som det är.
    </p>

    <h3>Berätta om hur du löste integreringen av klassen Session.</h3>
    <p>
      Jag sparade sessionsklassen med mitt namespace och implementerar ConfigureInterface och ConfigureTrait. Och sedan lade jag till Session i app i fronkontrollern.
    </p>

    <h3>Berätta om hur du löste uppgiften med Tärningsspelet 100/Månadskalendern, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?</h3>
    <p>
      Jag valde att göra uppgiften med månadskalendern då jag tyckte att den verkade roligast. Jag hade tänkt göra extrauppgifterna till en början men det kändes viktigare att komma vidare då det tog ganska lång tid att bli färdig med grundkraven.
      Jag har en klass Calendar som kan initieras med månad och år. Den innehåller en array med alla veckodagar och metoder för att få antal dagar i månaden, visa dagar för föregående och nästkommande månad samt för att generera html kod för kalendern.
      Sedan använder jag mig utav sessionsklassen för att kunna bläddra igenom kalendern, jag har två routes för detta som är increment och decrement samt en för calendar.
      Och i vyn så visar jag upp den genererade html koden för kalendern med en bild och två knappar för att kunna bläddra igenom kalendern.
    </p>

    <h3>Några tankar kring SQL så här långt?</h3>
    <p>
      Det är roligt att hålla på med SQL, fast utav det jag har gått igenom i uppgiften än så länge så har det mest vart repetition.
      Då jag hade lite tidsbrist så gjorde jag bara 3 utav punkterna den här gången, men det borde inte vara några problem att hinna färdigt med resten under nästa kursmoment.
    </p>
    <h2>kmom03</h2>
    <h3>Hur kändes det att jobba med PHP PDO, SQL och MySQL?</h3>
    <p>
      Det kändes bra, det var inte så mycket nytt. Jag tror att vi har gått igenom det tidigare i en annan kurs eller så är det jag som har hållt på med det tidigare.
      Men det är roligt att hålla på med SQL och jag gillade uppgfiten som vi har gjort under de tre första kursmomenten, då jag fick repetera lite men även lära mig en del nytt.
    </p>
    <h3>Reflektera kring koden du skrev för att lösa uppgifterna, klasser, formulär, integration Anax Lite?</h3>
    <p>
      Jag återanvände databsklassen som fanns i anax genom att ladda hem den med composer.
      Sedan skrev jag en egen klass Login som använder sig utav databasklassen och i den har jag metoder för att t.ex. uppdatera en användare eller byta lösenord.
      Båda klasserna är integrerade i Anax Lite så att jag kan använda dem över allt i ramverket. Vad gäller den övriga koden vet jag inte om den är så bra egentligen.
      Jag har mycket kod i mina routes för login och admin som är liknande så jag skulle ha kunnat skrivit mer återanvändbar och DRY kod. Men det funkar i alla fall och det får duga då jag inte direkt hade någon tid för att förbättra koden.

      Jag införde inte det kravet med behörigheter i den första uppgiften, så alla användare är administratörer. Jag har därför ingen setup-user-admin och man kommer åt admingränssnittet ifrån profilsidan när man har loggat in.
    </p>
    <h3>Känner du dig hemma i ramverket, dess komponenter och struktur?</h3>
    <p>
      Jag känner att jag har hyffsad koll på hur det fungerar. Vad gäller strukturen så känner jag mig ganska hemma nu och vet var jag skall lägga till filer och ändra kod.
    </p>

    <h3>Hur bedömmer du svårighetsgraden på kursens inledande kursmoment, känner du att du lär dig något/bra saker?</h3>
    <p>
      Uppgifterna är bra och jag känner att jag lär mig mycket. Det är helt klart tuffare än tidigare kurser mest beroende på att uppgifterna känns större, de är inte för svåra men tar tid att göra.
      Jag har hittills lagt nästan mer än dubbelt så mycket tid på den här kursen jämfört med webbappskursen och har svårt att hinna med att göra uppgifterna inom den tiden det är tänkt att det ska ta.
      Därför har jag heller inte hunnit med att göra någon extrauppgift än så länge.
    </p>
    <h2>kmom04</h2>
    <h3>Finns något att säga kring din klass för texfilter, eller rent allmänt om formattering och filtrering av text som sparas i databasen av användaren?</h3>
    <p>
    Jag valde att ladda ned den färdiga klassen CTextFilter med composer och integrera den i mitt ramverk. Jag har inte ändrat något i klassen utan den gör bara allt som krävs för att klara grundkraven.
    Jag sparar all text utan filtrering i databasen och använder bara den när jag ska visa texten på sidan.
    </p>
    <h3>Berätta hur du tänkte när du strukturerade klasserna och databasen för webbsidor och bloggposter?</h3>
    <p>
      Strukturen på databasen är precis så som i övningen. Jag skapade en klass Content som har funktioner för att hämta en eller flera bloggposter, webbsidor eller block samt att hämta all sorts content. Det finns också en funktion för att kolla om en slug existerar.
      Utöver det har jag skapat klassen functions där jag har lagt ett antal hjälpfunktioner som t.ex. getGet och getPost, vilket hjälpte mig att minska koden lite i mina routes.
    </p>

    <h3>Förklara vilka routes som används för att demonstrera funktionaliteten för webbsidor och blogg (så att en utomstående kan testa).</h3>
    <p>
      På admin sidan som man når genom att logga in och sedan gå till admin, så har jag lagt till create och overview.
      Om man klickar på create så får man ange en titel och sedan kan man redigera innehållet. Och på overview så kan man se en tabell över allt innehåll.
    </p>
    <p>
      För att se bloggen så klickar man på blog i navbaren. Där visas alla inlägg i en lista och man klickar på titelt för att komma till ett inlägg.
      Under pages i navbaren så finns en tabell över sidorna. Och om man klickar på titeln så kommer man till sidan.
    </p>
    <p>
      Under routen /block så visar jag upp de block som finns i databasen. Jag visste inte riktigt hur jag skulle visa dem så jag valde att göra dem som widgetar som i webbappskursen.
      För att testa CTextFilter klassen så har jag gjort en testsida som man når via navbaren under CTextFilter.
    </p>
    <h3>Hur känns det att dokumentera databasen så här i efterhand?</h3>
    <p>
      Det är bra tycker jag, man kan få en bra översikt över hur tabellerna hänger ihop. Och det var enkelt att åstadkomma me Reverse engineer i Workbench.
    </p>
    <h3>Om du är självkritisk till koden du skriver i Anax Lite, ser du förbättringspotential och möjligheter till alternativ struktur av din kod?</h3>
    <p>
        Ja det finns mycket att göra för att förbättra strukturen, men jag har inte riktigt haft tid att göra det då jag ligger lite efter.
        Den största förbättringspotentiallen som finns är nog i mina routes där jag har väldigt mycket kod.
        Jag skulle t.ex. kunna lägga till en funktion för att lägga till och rendera vyer i app klassen som Kenneth tipsade om. Det kommer jag nog också göra när jag får tid till det, utöver det finns det säkert mycket att finslipa på vad gäller koden.
    </p>

    <h2>kmom05</h2>
    <h3>Gick det bra att komma igång med det vi kallar programmering av databas, med transaktioner, lagrade procedurer, triggers, funktioner?</h3>
    <p>
      Att programmera på detta sättet var något som var helt nytt för mig. Jag hade hört talas om lagrade procedurer innan men visste inte hur man använde dem. Så med tanke på att det var något nytt för mig så tycker jag att det har gått bra.
    </p>

    <h3>Hur är din syn på att programmera på detta viset i databasen?</h3>
    <p>
      Jag ser nog bara fördelar med det. Det känns som ett bra sätt att minska användet utav SQL kod i php koden. När man istället kan använda sig utav lagrade procedurer eller funktioner som man kallar på för att utföra olika querys.
    </p>

    <h3>Några reflektioner kring din kod för backenden till webbshopen?</h3>
    <p>
      Jag utgick ifrån den exempel sql-koden som fanns för webshopen, på så sätt fick jag de mest utav de tabbellerna som jag behövde och kopplingen mellan dem.
      Nästan allt som har med att hämta, ta bort, lägga till eller updatera görs med lagrade procedurer. När man lägger till en produkt så läggs den också in i lagret med 100 items och när man tar bort en produkt så försvinner den också ifrån lagret.

      Jag vet inte om  min lösning för verukorgen är så bra men man behöver aldrig skapa en ny varukorg utan det finns bara en varukorg. Den håller reda på vem som har handlat vad med kund-id.
      Jag använder lagrade procedurer för att lägga till och ta bort produkter från varukorgen.

      För att skapa en ny order så har jag en lagrad procedur som tar emot kund-id och lägger till produkter ifrån varukorgen där kund-id matchar.
      Jag använder mig utav en while loop i proceduren för att kunna ta bort produkterna ifrån lagret om det är mer än en. Sedan när man tar bort en order läggs produkterna tillbaks i lagret på samma sätt.

      Själva CRUD delen i php koden var inga större problem då vi har gjort det ganska mycket nu. Fast det blev betydligt mindre sql kod i PHP koden nu när man kunde använda sig utav lagrade procedurer vilket var bra.
    </p>

    <h3>Något du vill säga om koden generellt i och kring Anax Lite?</h3>
    <p>
      Det finns nog väldigt mycket att förbättra vad gäller koden. Vad gäller CRUD som vi har gjort för en del uppgifter nu så är det väldigt repetiv kod och det skulle kunna skrivas på ett bättre sätt.
      Överlag så är det mycket kod i mina routes som inte är speciellt DRY, men just nu är jag bara glad att koden fungerar.
    </p>
    <h2>kmom06</h2>
    <h3>Vad du bekant med begreppet index i databaser sedan tidigare?</h3>
    <p>
      Nej det var något nytt för mig. Tidigare har jag enbart jobbat med primär nycklar och forreign keys så det var intressant att lära sig om något nytt.
      Jag vet inte om jag har förstått helt hur man jobbar med index mer än att man kan sökoptimera sina kolumner.
    </p>
    <h3>Berätta om hur du jobbade i uppgiften om index och vilka du valde att lägga till och skillnaden före/efter.</h3>
    <p>
      Jag valde att lägga till en unique på name i tabellen users, detta passade bra då användarnamnet måste vara unikt. Jag lade även till ett index på email i tabellen users.
      Då båda dessa används för att matcha mot på söksidan så passade det bra att lägga till indexet på email. För båda så ändrade det ifrån en full tabellsökning till bara en rad.
      Sedan lade jag även till ett index på title i tabellen content då det skulle kunna var en kolumn som man kan söka på. Här gick det okcså ifrån en full tabellsökning till bara en rad.
    </p>
    <h3>Har du tidigare erfarenheter av att skriva kod som testar annan kod?</h3>
    <p>
      Jag har inte så mycket erfarenhet utav det sedan tidigare. Men vi skrev ju liknande tester i oopython kursen så det är väl den erfarenheten som jag har utav enhetstester.
    </p>
    <h3>Hur ser du på begreppet enhetstestning och att skriva testbar kod?</h3>
    <p>
      Det kan väl vara ett bra sätt att kvalitetssäkra sin kod samt testa så att koden fungerar som tänkt. Fast det blir konstigt att skriva testfall för sin egen kod då man redan vet vilket resultat man kan förvänta sig och då är det svårt att upptäcka fel i koden.
    </p>
    <h3>Hur gick det att hitta testbar kod bland dina klasser i Anax Lite?</h3>
    <p>
      Det var ganska svårt då många utav klasserna använder mycket sql i metoderna eller returnerar html kod.
      Jag valde att testa min kalender klass och lyckades uppnå 100% kodtäckning.
    </p>
    <h2>kmom07-10</h2>
  </article>
</main>
