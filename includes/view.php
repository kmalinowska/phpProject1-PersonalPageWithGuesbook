<?php
declare(strict_types=1);

//function made for put all templates together to render the eader footer and a specyfic template
function renderView(string $template, array $data = []): void //load some php files, dont return anything; przekazanie pewnych danych do szablonu przez kontroler /routes/index_get.php
{
    // dodane poniżej pliki, automatycznie uzyskają dostęp do zmiennej danych: $data
    // można bezpiecznie używać zmiennej danych w każdym z tych szablonów
    include TEMPLATES_DIR . '/'  . $template . '.php'; //main template we'd like to render - wyrenderowanie szablonu
    include TEMPLATES_DIR . '/header.php';
    include TEMPLATES_DIR . '/footer.php';
}