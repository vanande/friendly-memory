<?php

function createTask($description){
    require_once __DIR__ . "/../../database/connection.php";

    $databaseConnection = getDatabaseConnection();

    $createTasksQuery = $databaseConnection->prepare("
    INSERT INTO tasks (
      description
    ) VALUES (
      :description
    );
  ");

    return $createTasksQuery->execute([
        "description" => htmlspecialchars($description),
    ]);
}
