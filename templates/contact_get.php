<section>
    <h2>Leave a Public Note/Question</h2>
    <form method="POST">
        <!-- CSRF token - bezpośrednio powiązany z pojedynczym wysłaniem formularza 
         możemy przesłać tylko jeden token razem z formularzem, więc jeśli zostanie wygenerowany musimy się tylko upewnić że został zweryfikowany
         dodajemy pole wejściowe typu ukryte, dane nie będą widoczne ale będą wysłane razem z formularzem -->
        <input type="hidden" name="csrfToken" value="<?=$data['csrfToken']?>" />
        <label>Name</label>
        <input type="text" name="name" />
        <label>Email</label>
        <input type="text" name="email" />
        <label>Message</label>
        <textarea rows="4" name="message"></textarea>
        <button type="submit">Send Message</button>
    </form>
</section>