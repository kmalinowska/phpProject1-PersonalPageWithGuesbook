<?php
declare (strict_types = 1);

//stałe dostępne w całym projekcie, wraz ze ścieżkami bezwzględnymi do katalogów używanych w całej aplikacji
const INCLUDES_DIR = __DIR__ . '/includes'; //__DIR__ zwraca rzeczywisty katalog;
const ROUTES_DIR = __DIR__ . '/routes';
const TEMPLATES_DIR = __DIR__ . '/templates';
const DB_DIR = __DIR__ . '/db';

//dołączenie pliku przy pomocy require, po rozpoczęciu sesji możemu użyć tego katalogu inlude i przekazać go routerowi PHP
require_once INCLUDES_DIR . '/router.php'; 
require_once INCLUDES_DIR . '/view.php';
require_once INCLUDES_DIR . '/db.php';