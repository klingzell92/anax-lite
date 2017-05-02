Dokumentation
==================

Det här är en dokumentation för mitt webshops API.

###Varukorg
Man behöver aldrig skapa en ny varukorg utan det finns bara en varukorg. Den håller reda på vem som har beställt vad med customerId.
Så man behöver lägga till en kund i Customer tabellen och sedan använda id:et.

För att lägga till en produkt använder man proceduren **CALL addToCart(customerId, productId, items)**
Och för att ta bort en produkt **CALL removeFromCart(customerId, productId)**
För att visa innehållet i en varukorg så kallar man proceduren och anger customerId **CALL getCart(customerId)**
+ customerId, Id på kunden till vilken varukorgen är knuten till
+ productId, Id på produkten som skall läggas till eller tas bort
+ items , Antalet produkter som skall läggas till

###Order
För att skapa en order kör man **CALL createOrder(customerId)**
Den behöver bara ta emot customerId och lägger till produkter ifrån varukorgen där customerId matchar.
När produkterna läggs till i ordern så flyttas också det antalet produkter som har angetts ifrån lagret.

För att ta bort en order så kallar man på **CALL deleteOrder(orderId)**
Man behöver bara ange id för den ordern man vill ska tas bort.
När man tar bort en order flyttas produkterna i ordern tillbaka till lagret.

För att visa innehållet så kallar man på proceduren **CALL getOrder(orderId)**
Där orderId är id på den ordern var innehåll du vill hämta.

+ customerId, Id på kunden till vilken varukorgen är knuten till
+ orderId, Id på ordern som ska visas eller tas bort

###Inventory log

När lagret för en produkt uppdateras så triggas **inventoryNewOrder**. Om det nya antalet produkter är mindre än 5 så läggs en rad till i **InventoryLog** tabellen.
