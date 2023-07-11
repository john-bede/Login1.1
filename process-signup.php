<?php

if(empty($_POST["name"])){
    die("Name is required");
}
if(! filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
    die("Valid email is required");
}
if(strlen($_POST["password"])<8){
    die("password must be atleast 8 characters");
}
if(! preg_match("/[a-z]/i", $_POST["password"])){
    die("password must contain atleast one letter");
}

if(! preg_match("/[1-9]/",$_POST["password"])){
    die("Password must contain atleast one number");
}

if($_POST["password"] !== $_POST["password_confirmation"]){
    die("Passwords must match");
}

$password_hash=password_hash($_POST["password"],PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name,email,password_hash)VALUES(?,?,?)";

$stmt = $mysqli->stmt_init();

if(! $stmt -> prepare($sql)){
    die("SQL error: " . $mysqli->error);
}

$stmt->prepare($sql);

print_r($_POST);
var_dump($password_hash);