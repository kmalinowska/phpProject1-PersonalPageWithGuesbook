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