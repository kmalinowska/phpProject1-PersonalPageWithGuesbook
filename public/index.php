<?php
//index.php - front controller
declare (strict_types = 1); //use strict types

//w pliku tym możemy zdefiniowac pewne stałe, takie jak nazwy katalogów, 
//czy ścieżki bezwzględne do wszystkich katalogów, których będziemy używac w aplikacji
//zmienne dostępne w całym projekcie
const INCLUDES_DIR = __DIR__ . '/../includes'; //__DIR__ zwraca rzeczywisty katalog; '/../" - one directory up
const ROUTES_DIR = __DIR__ . '/../routes';
const TEMPLATES_DIR = __DIR__ . '/../templates';
const DB_DIR = __DIR__ . '/../db';

//każde żądanie przychodzące do naszej aplikacji będzie przechodzić przez ten konkretny plik
//jest więc dobrym miejscem na rozpoczęcie sesji:
session_start();
//dołączenie pliku przy pomocy require, po rozpoczęciu sesji możemu użyć tego katalogu inlude i przekazać go routerowi PHP
require_once INCLUDES_DIR . '/router.php'; 
require_once INCLUDES_DIR . '/view.php';
require_once INCLUDES_DIR . '/db.php';

//handle request -> obsłużenie żądania poprzez wywołanie funkcji routera
dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);