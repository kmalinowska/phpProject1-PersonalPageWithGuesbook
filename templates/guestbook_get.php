<?php
//functions obfuscating/zaciemniająca name and email:
function obfuscateName(string $name): string {
    if(strlen($name) <= 2) {
        return $name;
    }
    return substr($name, 0, 1) . str_repeat('*', strlen($name) - 2) . substr($name, -1);
}

function obfuscateEmail(string $email): string {
    $parts = explode('@', $email);
    $username = $parts[0];
    $domain = $parts[1] ?? '';
    $username = substr($username, 0, 2) . str_repeat('*', max(0, strlen($username) - 2));
    return "$username@$domain";
}

//utworzenie zmiennej pomocniczej $messages - przechowuje dane z wpisów/wiadomości użytkowników
$messages = $data['messages'] ; //zmienna $data jest dostępna w tym szablonie,ponieważ funkcja renderowania widoku renderView() przyjmuje ją jako argument i dopiero wtedy uwzględnia szablon
//var_dump($messages); //potwierdzenie pomyslnego odczytania komunikatów z bazy danych
?>
<section>
    <h2>Guest Messages</h2>
    <!-- sprawdzenie czy w ogóle są jakies komunikaty, funkcja empty zwraca wartości tru jeśli tablica jest pusta-->
    <?php if (empty($messages)): ?>
        <p>No messages yet. Be the first to leave a message</p>
    <?php else: ?>
        <?php foreach ($messages as $message): ?>
            <h3>
                <?=obfuscateName(htmlspecialchars($message['name']))?>
            </h3>
            <p>Email:<?=obfuscateEmail(htmlspecialchars($message['email'])) ?></p>
            <p><?=nl2br(htmlspecialchars($message['message'])) ?></p> <!-- nl2br() - funkcja zmieniająca znaki nowej lini na oryginalnym wejściu, pozwala na poprawne formatowaniue wieloliniowych komunikatów-->
            <small>Posted on: <?=htmlspecialchars($message['created_at'])?></small>
            <?php endforeach ?>
    <?php endif; ?>
</section>