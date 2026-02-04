<?php
declare (strict_types = 1);

require_once __DIR__ . '/error_handling.php';
//obsługa błędów - dwa rodzaje
//1 - to wywołanie tradycyjnego błędu np. wywołanie echo lub użycie zmiennej która nigdzie nie została zainicjowana
error_reporting(E_ALL); //ustawienie poziomu raportowania błędów, aby wyświetlał wszystkie błędy
//ini_set('display_errors', 1); - old version way, now is by default reported into console, not in the web page - za pomocą dowolnej metody użycie ustawienia o nazwie display unerscore errors
//2- throw exeptions/wyjątki - możemy zgłaszać własne, albo obsługiwać wyjątki generowane przez niektóre biblioteki PHP
//throw new RuntimeExeption('Whoops!');
set_exception_handler('exceptionHandler');
set_error_handler('errorHandler');

//stałe dostępne w całym projekcie, wraz ze ścieżkami bezwzględnymi do katalogów używanych w całej aplikacji
const INCLUDES_DIR = __DIR__ . '/includes'; //__DIR__ zwraca rzeczywisty katalog;
const ROUTES_DIR = __DIR__ . '/routes';
const TEMPLATES_DIR = __DIR__ . '/templates';
const DB_DIR = __DIR__ . '/db';

//dołączenie pliku przy pomocy require, po rozpoczęciu sesji możemu użyć tego katalogu inlude i przekazać go routerowi PHP
require_once INCLUDES_DIR . '/router.php'; 
require_once INCLUDES_DIR . '/view.php';
require_once INCLUDES_DIR . '/db.php';
require_once INCLUDES_DIR . '/flash.php';
require_once INCLUDES_DIR . '/csrf.php';