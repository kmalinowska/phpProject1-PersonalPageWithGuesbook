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

connectDb(); //connect to database

var_dump($email, $name, $message);die;