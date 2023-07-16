<?php

require_once __DIR__ . "/../database/connection.php";

try {
    $databaseConnection = getDatabaseConnection();

    $success = $databaseConnection->query("
        DROP TABLE IF EXISTS users;

        CREATE TABLE users (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            email VARCHAR(50) NOT NULL,
            password CHAR(60) NOT NULL,
            token CHAR(60)
        );

        INSERT INTO users(
            email,
            password
        ) VALUES (
            'admin@gmail.com',
            'mopmop'
        );
        
        DROP TABLE IF EXISTS tasks;
        
        CREATE TABLE tasks (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            description TEXT NOT NULL
        );

    ");

    if ($success) {
        echo "Migrations successful";
    } else {
        echo "Error when migrating data";
    }

} catch (Exception $exception) {
    var_dump($exception->getMessage());
}
