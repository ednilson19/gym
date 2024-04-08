<?php

if (empty($_POST["name"])) {
    die("O nome é obrigatório");
    }

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("E-mail válido é obrigatório");
}

if (strlen($_POST["password"]) < 8) {
    die("Password deve conter pelo menos  8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password deve conter pelo menos 1 letra ");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password deve conter pelo menos 1 número");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords têm de ser iguais ");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                  $_POST["name"],
                  $_POST["email"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: signup-success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

// how i save my code in type of could?
