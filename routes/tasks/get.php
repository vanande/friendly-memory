<?php
/*
 *  GET /tasks
○ Lorsque le jeton n’est pas dans les en-têtes ou que le token ne
correspond à aucun utilisateur
■ Code de statut : 401 (Unauthorized)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: false
● message: Provide an Authorization: Bearer token
○ Lorsqu’aucune tâche n’existe en base de données
■ Code de statut : 404 (No Content)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: false
● message: No tasks found
○ Lorsqu’une exception est levée
■ Code de statut : 500 (Internal Server Error)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: false
● error: Message d’exception
○ Lorsqu’il y a des tâches
■ Code de statut : 200 (Success)
■ En-tête :
● Content-Type: application/json
■ Réponse
● success: true
● tasks: La liste des tâches
 */

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../libraries/header.php";
require_once __DIR__ . "/../../entities/tasks/get-tasks.php";
require_once __DIR__ . "/../../entities/users/get-token.php";
require_once __DIR__ . "/../../entities/users/check_token.php";

try{

    $token = getAuthorizationBearerToken();

    if (!checkToken($token)){
        echo jsonResponse(401, [], [
            "success" => false,
            "message" => " Provide an Authorization: Bearer token"
        ]);
    }

    $tasks = getTasks();
    if (!$tasks) {
        echo jsonResponse(404, [], [
            "success" => false,
            "message" => "No tasks found"
        ]);
        return;
    }


    echo jsonResponse(200, [], [
        "success" => true,
        "tasks" => $tasks
    ]);

} catch (Exception $exception) {
    echo jsonResponse(500, [], [
        "success" => false,
        "message" => $exception->getMessage()
    ]);
}