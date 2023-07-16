<?php

function deleteTask($id){

    require_once __DIR__ . "/../../database/connection.php";

    $databaseConnection = getDatabaseConnection();

    $deleteTaskQuery = $databaseConnection->prepare("DELETE FROM tasks WHERE id = :id");

    return $deleteTaskQuery->execute([
        "id" => $id
    ]);
}
