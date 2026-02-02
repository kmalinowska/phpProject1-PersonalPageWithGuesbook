<?php
/* DODANIE FUNKCJI, KTÓRA DODA WIADOMOŚĆ BŁYSKAWICZNĄ
- chcemy zachować typ ($type), który pozwoli nam oddzielić komunikaty o powodzeniu od komunikatów o błędach - potrzebujemy do tego odpowiednie kolory
- kolejny argument to sam komunikat ($message), który nic nie zwraca (void)
- dodajemy superglobalną zmienną sesję ($_SESSION) w której dodajemy wpis flash, kolejny typ i wiadomość;
*/
function addFlashMessage(string $type, string $message): void {
    $_SESSION['flash'][$type] = $message;
}

/* DODANIE FUNKCJI, KTÓRA ODCZYTA WIADOMOŚĆ BŁYSKAWICZNĄ
- pobieramy wiadomości z supeglobalnej sesji flash, jeśli ich nie ma zwracamy pustą tablicę
- jeśli odczytamy wiadomści flash po wywołaniu funkcji i założymy że zostały gdzieś wyświetlone, usuniemy je - użycie polecenia unset() aby usunąć element z tablicy sesji znajdujący się pod kluczem flash
- musimy pamiętać aby dodać plik flash.php do bootstrap.php
- następnie musimy znaleźć miejsce gdzie będą wyświetlone te wiadomości, najlepsze miejsce to header.php, ale nie w samym header, tylko w partial template / częściowym szablonie flash.php
*/
function getFlashMessages(): array {
    $messages = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $messages;
}