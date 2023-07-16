<?php

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../libraries/parameters.php";
require_once __DIR__ . "/../../entities/tasks/delete-task.php";

try {
    $parameters = getParametersForRoute("Exercice4/tasks/:task");
    $task = $parameters["task"];
    $id = $parameters["task"];

    if (!deleteTask($id)) {
        throw new Exception("Task not found");
    }

    echo jsonResponse(200, [], [
        "success" => true,
        "message" => "Task deleted"
    ]);
} catch (Exception $exception) {
    echo jsonResponse(500, [], [
        "success" => false,
        "message" => $exception->getMessage()
    ]);
}
