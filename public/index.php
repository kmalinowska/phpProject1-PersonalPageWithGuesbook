<?php
//index.php - front controller
declare (strict_types = 1); //use strict types

//w pliku tym możemy zdefiniowac pewne stałe, takie jak nazwy katalogów, 
//czy ścieżki bezwzględne do wszystkich katalogów, których będziemy używac w aplikacji
//zmienne dostępne w całym projekcie
const INCLUDES_DIR = __DIR__ . '/../includes'; //__DIR__ zwraca rzeczywisty katalog; '/../" - one directory up

//każde żądanie przychodzące do naszej aplikacji będzie przechodzić przez ten konkretny plik
//jest więc dobrym miejscem na rozpoczęcie sesji:
session_start();
require_once INCLUDES_DIR . '/router.php'; //dołączenie pliku przy pomocy require, po rozpoczęciu sesji możemu użyć tego katalogu inlude i przekazać go routerowi PHP

//handle request -> obsłużenie żądania poprzez wywołanie funkcji routera