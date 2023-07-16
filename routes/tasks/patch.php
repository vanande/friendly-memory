<?php

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../libraries/body.php";
require_once __DIR__ . "/../../libraries/parameters.php";
require_once __DIR__ . "/../../entities/tasks/update-task.php";

try {
    $parameters = getParametersForRoute("Exercice4/tasks/:task");
    $id = $parameters["task"];
    $body = getBody();

    $description = $body["description"];
    if (empty($description)) {
        throw new Exception("Description is required");
    }


    if (!updateTask($id, $body)) {
        throw new Exception("Task not found");
    }

    echo jsonResponse(200, [], [
        "success" => true,
        "message" => "Task updated successfully"
    ]);
} catch (Exception $exception) {
    echo jsonResponse(500, [], [
        "success" => false,
        "message" => $exception->getMessage()
    ]);
}
