<?php

getTasks();

function getTasks()
{
    require_once __DIR__ . "/../../database/connection.php";

    $databaseConnection = getDatabaseConnection();

    $getTasksQuery = $databaseConnection->query("SELECT * FROM tasks");

    $tasks = $getTasksQuery->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
}
