<?php

function connectDb():PDO {
    $pdo = new PDO('sqlite:' . DB_DIR . '/' . 'db.sqlite');
    //set some attributes of the connection by calling the setAttribute method
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //dodanie trybu błędu i wartości jaką chcemy w nim uzyskać
    return $pdo; //return pdo connection
}

///function load the schema from schema.sql into the sqlite.sql
function loadSchema(PDO $pdo, string $schemaFile):void {
    $sql = file_get_contents($schemaFile); //ładowanie całej zawartości pliku
    if(false === $sql) {
        die("Failed to load schema from file: $schemaFile."); //zamiast error handling
    }
    $pdo->exec($sql); //runs sql
    echo "Schema loaded successfully.\n";
}

//function insert the new message into the database
function insertMessage(PDO $pdo, string $name, string $email, string $message): bool {
    $sql = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)"; //use placeholders :name, :email etc. - aby uniknąć sytuacji gdzie w podanym przez użytkownika danej, w inpucie nie ma kodu sql, któy wywołałby się w naszym kodzie i zepsuł cały program!!!
    $stmt = $pdo->prepare($sql); //prepare a statement -> next run the query
    //obiekt stmt zwracany przez pdo, na którym używamy metodę execute, nadanie nazwy wartości zmiennych dla bezpiecznego uruchomienia zapytania
    $stmt->execute([ 
        ':name' => $name,
        ':email' => $email,
        ':message' => $message,
    ]);
    return $stmt->rowCount() > 0; //sprawdzenie czy zapytanie się wykonało
}

//funkcja pobierająca dane z bazy danych i wyświetlająca je na stronie księgi gości
function getMessages(PDO $pdo):array {
    $sql = "SELECT * FROM messages ORDER BY created_at DESC"; //query
    $stmt = $pdo->query($sql);//statement - instrukcja utworzona poprzez wywołanie zapytania pdo za pomocą sql, bez argumentów;
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //uruchomienie instrukcji poprzez wywołanie "pobierz wszystko" - fetchALL; przekazanie jednego argumentu okreslającego sposób otrzymania wyników - tutaj tryb fetch::assco - pobierz do tablicy asocjacyjnej w ktorej każdy klucz to nazwa kolumny a wartość, to wartość kolumny
}