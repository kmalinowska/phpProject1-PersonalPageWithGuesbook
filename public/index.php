<?php
//index.php - front controller
declare (strict_types = 1); //use strict types

require_once './../bootstrap.php';
//każde żądanie przychodzące do naszej aplikacji będzie przechodzić przez ten konkretny plik
//jest więc dobrym miejscem na rozpoczęcie sesji:
session_start();
//handle request -> obsłużenie żądania poprzez wywołanie funkcji routera
dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);