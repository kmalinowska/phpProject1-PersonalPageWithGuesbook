<?php
declare(strict_types=1);
//CSRF - Cross-site request forgery protection 
// - ochrona przeciw fałszowaniem żądań między witrynami
// ZABLOKOWANIE WYSYŁANIA FORMULARZA 
// Jeśli nie mamy ważnego tokena, formularz zostanie tymczasowo wyłączony

// stała określająca ilość znaków/długość tokena / token length
const  CSRF_TOKEN_LENGTH = 32;
// stała określająca czas wygaśnięcia tokena / token expire time
const CSRF_TOKEN_LIFETIME = 60 * 30; // 30 minutes

// Zanim zweryfikujemy token musimy najpierw go wygenerować / generate new token
//- Token to indywidualna kwestia dla każdego użytkownika, musimy go najpierw wygenerować i zapisać go w sesji 
// - musi być generowany automatycznie, losowo i być unikalny dla tego użytkownika
function generateCsrfToken(): string {
    $token = bin2hex(random_bytes(CSRF_TOKEN_LENGTH)); //wygenerowanie losowych bajtów za pomocą funkcji random_bytes(), funkcja bin2hex() - konwertuje natomiast wygenerowane dane binarne na postać 16-tkową; długość znaków została określona w zmiennej
    setCsrfTokenAndTime($token);
    return $token;
}
// var_dump(generateCsrfToken());die;

// zamiast wielokrotnie używać sesji z kluczami 'csrf_token' i csrf_token_time w kodzie: if(!isset($_SESSION['csrf_token'], $_SESSION['csrf_token_time']), 
// można utworzyć opcjonalne funkcje, które będą odpowiedzialne za zwrócenie bieżącego tokenu i czasu, a także ustawienie bieżącego tokenu i czasu - zawsze są one połączone
function getCsrfTokenAndTime(): array {
    return [
        $_SESSION['csrf_token'] ?? null, // wpisy sesji, czyli token csrf lub wartość null
        $_SESSION['csrf_token_time'] ?? null, // czas tokenu csrf lub wartość null
    ];
}
function setCsrfTokenAndTime(?string $token): void {
    //jeśli token jest nullem - usunięcie wartości tokena z sesji i zwrócenie
    if($token === null) {
        unset(
            $_SESSION['csrf_token'],
            $_SESSION['csrf_token_time']
        );
        return;
    }
    //jeśli token nie jest nullem - wygenerowanie nowego tokena
    $_SESSION['csrf_token'] = $token; // po wygenerowaniu tokena musimy go przechować w sesji
    $_SESSION['csrf_token_time'] = time(); //czas wygenerowania tokena; aktualny znacznik czasu UNIX, liczba sekund które upłynęły od tzw. epoki unix
    
}

// opcjonalna funkcja sprawdzająca czy token wygasł, 
// zamiast (time() - $_SESSION['csrf_token_time'] > CSRF_TOKEN_LIFETIME))
// jeżeli czas bieżący pomniejszony o czas wygenerowania tokena jest dłuższy niż oczekiwany czas życia należy go ponownie wygenerować
function isTokenExpired(?int $time): bool {
    return $time === null || (time() - $time) > CSRF_TOKEN_LIFETIME;
}

//add function to return the current token / zwracająca aktualny token
function getCurrentCsrfToken():string {
    // pobranie aktualnego tokena wykorzystując destrukturyzację tablicy, pobierając token i czas:
    [$token, $time] = getCsrfTokenAndTime();
    // 1. check if there is a valid/ważny, non-expired/nie wygasły token already
    //    return if it exists, if not:
    // 2. Generate a new one
    //    return it
    if(!isset($token, $time) || isTokenExpired($time)) { //isset sprawdza czy wewnątrz sesji istnieją dane dwie wartości; funckja isTokenExpired(), czy token wygasł
        return generateCsrfToken(); // jeśli token nie istnieje lub wygasł zwrócimy wygenerowany nowy token
    }
    return $_SESSION['csrf_token']; // jesli istnieje zwrócimy token z obecnej sesji
}

//add function to validate CSRF token / weryfikacja tokena CSRF 
function validateCsrfToken(?string $token): bool { //akceptuje ciąg znaków, który może być nullem - domyślnie token byłby nullem, chyba że go wygenerujemy
    [$storedToken, $time] = getCsrfTokenAndTime();

    if(!isset($storedToken, $time)) {
        return false;
    }

    if(isTokenExpired($time)) {
        //usunięcie obu wartości z sesji
        setCsrfTokenAndTime(null);
        /*unset(
            $_SESSION['csrf_token'],
            $_SESSION['csrf_token_time']
        );*/
        return false;
    }

//walidacja tokena
//aby zaimplementować funkcję weryfikującą możemy użyć funkcji hash_equals będącą bezpiecznym sposobem porównywania tokenów, haseł i innych skróconych ciągów znaków wymagających bezpiecznego porównania
//pierwszym argumentem powinien być token wysłany lub dostarczony przez użytkownika
//drugim argumentem - token wysłany wraz z formularzem lub pusty string
    $valid = hash_equals($storedToken, $token ?? '');

    if ($valid) {
        generateCsrfToken();
    }
    return $valid;
}
