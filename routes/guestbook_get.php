<?php
//pobranie wpisów z wykorzystaniem funkcji get messages i przekazanie im funkcji connect db - połączenie z bazą danych
$messages = getMessages(connectDb());
//throw new RunTimeException('Whoops!');
echo $hey;
//użycie funkcji widoku renderującego do przesłania danych
renderView(
    template: 'guestbook_get', // nazwa szablonu wg konwencji jest taka sama jak nazwa routes
    data: ['messages' => $messages] // compact($messages) //drugi parametr to dane, domyślnie przekazuje się pustą tablicę, w tym przykładzie przekazane są dodatkowe dane, gdzie wiadomości = wpisom
);