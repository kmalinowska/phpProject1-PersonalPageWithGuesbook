<?php

function connectDb():PDO {
    $pdo = new PDO('sqlite:' . DB_DIR . '/' . 'db.sqlite');
    //set some attributes of the connection by calling the setAttribute method
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //dodanie trybu błędu i wartości jaką chcemy w nim uzyskać
    return $pdo; //return pdo connection
}