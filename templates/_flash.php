<?php $messages = getFlashMessages(); 
/*
_flash.php - w nazwie częściowych szablonów, które nie są renderowane dla widoku głównego, 
ale są ponownie wykorzystywane w innych widokach, nazwa powinna zaczynać się od podkreślenia "_"
oznacza to,  że ten szablon jest zawsze częścią czegoś innego
żądanie dodajemy w header.php: "<?php require_once('_flash.php');
- w pierwszej kolejności pobieramy wiadomość - utworzenie zmiennej $messages i wywołanie funkcji getFlashMessages()
- następnie dodajemy instrukcję if, która sprawdza, czy zmienna empty zwraca false = nie jest pusta dla zmiennej messages
*/
?>

<?php if (!empty($messages)): ?>
  <div class="flash-messages">
    <?php foreach ($messages as $type => $message): ?>
      <div class="flash-message flash-<?= htmlspecialchars($type) ?>">
        <?=htmlspecialchars($message, ENT_QUOTES, 'UTF-8')?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

