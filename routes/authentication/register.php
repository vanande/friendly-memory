<?php

/*
 * Lorsque l’email est introuvable
■ Code de statut : 400 (Bad Request)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: false
● message: Email not found
○ Lorsque le mot de passe est introuvable
■ Code de statut : 400 (Bad Request)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: false
● message: Password not found
○ Lorsque l’email est n’est pas un email valide
■ Code de statut : 400 (Bad Request)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: false
● message: Invalid email
○ Lorsque le mot de passe ne contient pas au moins 8 caractères
■ Code de statut : 400 (Bad Request)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: false
● message: Password not strong enough
○ Lorsque la requête est valide
■ Code de statut : 200 (Success)
■ En-tête
● Content-Type: application/json
■ Réponse
● success: true
● message: Created
 */

require_once __DIR__ . "/../../libraries/body.php";
require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../entities/users/login-user.php";
require_once __DIR__ . "/../../entities/users/registerUser.php";

try {
  $body = getBody();

  if ($body["email"] === null) {
    echo jsonResponse(400, ["Content-Type => application/json"], [
      "success" => false,
      "message" => "Email not found"
    ]);
    return;
  }

  if ($body["password"] === null) {
    echo jsonResponse(400, ["Content-Type => application/json"], [
      "success" => false,
      "message" => "Password not found"
    ]);
    return;
  }

  if (!filter_var($body["email"], FILTER_VALIDATE_EMAIL)) {
    echo jsonResponse(400, ["Content-Type => application/json"], [
      "success" => false,
      "message" => "Invalid email"
    ]);
    return;
  }

  if (strlen($body["password"]) < 8) {
    echo jsonResponse(400, ["Content-Type => application/json"], [
      "success" => false,
      "message" => "Password not strong enough"
    ]);
    return;
  }

  $email = $body["email"];
  $password = $body["password"];

  $token = registerUser($email, $password);

  echo jsonResponse(200, ["Content-Type => application/json"], [
    "success" => true,
    "message" => "Created"
  ]);

} catch (Exception $exception) {
    echo jsonResponse(500, [], [
        "success" => false,
        "message" => $exception->getMessage()
    ]);
}