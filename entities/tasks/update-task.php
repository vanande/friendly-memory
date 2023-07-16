<?php

function updateTask($id, $description)
{

    require_once __DIR__ . "/../../database/connection.php";

    $databaseConnection = getDatabaseConnection();

    var_dump($description);
    $set = 'description="' . $description["description"] . '"';

    $description = htmlspecialchars($description["description"]);

    // make a query that concate the set and the where
    $query = "UPDATE tasks SET $set WHERE id = :id";
    var_dump($query);

    $updateTaskQuery = $databaseConnection->prepare($query);
    $updateTaskQuery->execute([
        "id" => $id,
    ]);

    return $updateTaskQuery->rowCount() > 0;
}
