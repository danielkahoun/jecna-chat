# Ječná Chat

Webová aplikace pro skupinový chat s možností vytváření jak veřejných, tak uzavřených chatovacích místností. Realizováno pomocí technologií Laravel a Vue.js.

## REST API

`GET` https://chat.danielkahoun.eu/api/messages

### Dostupné query parametry

-   `user` - ID uživatele
-   `chat` - ID chatroomu
-   `word` - hledané slovo nebo výraz

### Příklad

`GET` https://chat.danielkahoun.eu/api/messages?user=1&word=Ahoj

## Realizace WebSocketu

WebSocket je implementován pomocí technologií Laravel Echo, Pusher a `beyondcode/laravel-websockets`. Při odeslání zprávy přes asynchronní POST request je zpráva vložena do databáze a pomocí eventu `MessageSent` je zpráva taktéž zaslána do příslušného Pusher channelu. Nová zpráva se tak zobrazí všem uživatelům v místnosti.

## Live demo aplikace

[https://chat.danielkahoun.eu](https://chat.danielkahoun.eu)
