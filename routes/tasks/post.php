<?php
/*
 * POST /tasks
○ Lorsque le jeton n’est pas dans les en-têtes ou que le token ne
correspond à aucun utilisateur
■ Code de statut : 401 (Unauthorized)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: false
● message: Provide an Authorization: Bearer token
○ Lorsque la description n’est pas dans le corps de requête
■ Code de statut : 400 (Bad Request)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: false
● message: Description not found
○ Lorsque la description n’est pas une chaîne de caractères
■ Code de statut : 400 (Bad Request)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: false
● message: Description is not a string
○ Lorsqu’une exception est levée
■ Code de statut : 500 (Internal Server Error)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: false
● error: Message d’exception
○ Lorsque la requête est valide
■ Code de statut : 200 (Success)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: true
● message: Created
 */

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../libraries/header.php";
require_once __DIR__ . "/../../libraries/body.php";
require_once __DIR__ . "/../../entities/users/check_token.php";


$token = getAuthorizationBearerToken();

if (!checkToken($token)){
    echo jsonResponse(401, [], [
        "success" => false,
        "message" => " Provide an Authorization: Bearer token"
    ]);
}

$body = getBody();

if ($body["description"] === null) {
    echo jsonResponse(400, ["Content-Type => application/json"], [
        "success" => false,
        "message" => "Description not found"
    ]);
    return;
}

if (!is_string($body["description"])) {
    echo jsonResponse(400, ["Content-Type => application/json"], [
        "success" => false,
        "message" => "Description is not a string"
    ]);
    return;
}

$description = $body["description"];

require_once __DIR__ . "/../../entities/tasks/create-task.php";

try {
    createTask($description);
    echo jsonResponse(200, ["Content-Type => application/json"], [
        "success" => true,
        "message" => "Created"
    ]);
} catch (Exception $e) {
    echo jsonResponse(500, ["Content-Type => application/json"], [
        "success" => false,
        "error" => $e->getMessage()
    ]);
}