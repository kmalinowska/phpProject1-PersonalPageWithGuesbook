<?php
//route to display the form
renderView('contact_get', ['csrfToken' => getCurrentCsrfToken()]);
//wyrendowanie widoku, poprzez przekazanie nazwy szablonu/template będąca taką samą nazwą jak nazwa danego route
//użycie tokena csrf wewnątrz formularza - w tym miejscu otrzymamy aktualny token csrf 