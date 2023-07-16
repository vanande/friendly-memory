<?php

function registerUser($email, $password){

    require_once __DIR__ . "/../../database/connection.php";

    $databaseConnection = getDatabaseConnection();

    $getUserQuery = $databaseConnection->prepare("SELECT * FROM users WHERE email = :email");

    $getUserQuery->execute(["email" => $email ]);

    $user = $getUserQuery->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo jsonResponse(400, ["Content-Type => application/json"], [
            "success" => false,
            "message" => "Email already exists"
        ]);
        return false;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insertUserQuery = $databaseConnection->prepare("INSERT INTO users(email, password) VALUES (:email, :password)");

    $insertUserQuery->execute([
        "email" => $email,
        "password" => $hashedPassword
    ]);

    return true;
}