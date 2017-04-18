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
    <h2>kmom05</h2>
    <h2>kmom06</h2>
    <h2>kmom07-10</h2>
  </article>
</main>
