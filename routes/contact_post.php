<?php
//route to handle the post request/obsłuzy żądanie and do something with the input send to us/zrobi coś z danymi wejściowymi które są do nas przesyłane
//CSRF
//add super global contain all the data sent through the form
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

//validation
if(empty($name) || empty($email) || empty($message))
{
    badRequest("All fields are required!");
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    badRequest("Email field is invalid");
}

$inserted = insertMessage(
    connectDb(), //connect to database
    name: $name, 
    email: $email, 
    message: $message
); 

if($inserted) {
    $safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); //escape from user input some scripts
    //echo "Thank you, $safeName, for your message. It was stored";
    addFlashMessage('success', "Thank you, $safeName, for your message. It was stored");
    redirect('/guestbook');
    //exit;
}
//if not
//serverError('Could not store the message, sorry');
addFlashMessage('error', 'Could not store the message, sorry');
//przekierowanie do innego miejsca - funkcja redirect w router.php
redirect('/guestbook');