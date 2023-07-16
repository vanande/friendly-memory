<?php

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../libraries/body.php";
require_once __DIR__ . "/../../entities/users/login-user.php";

try {
  $body = getBody();

  if ($body["email"] === null || $body["password"] === null) {
    echo jsonResponse(400, ["Content-Type => application/json"], [
      "success" => false,
      "message" => "Bad email or password1"
    ]);
    return;
  }


  $email = $body["email"];
  $password = $body["password"];

  $token = loginUser($email, $password);

  if (!$token) {
    echo jsonResponse(404, ["Content-Type => application/json"], [
      "success" => false,
      "message" => "Bad email or password2"
    ]);

    return;
  }

  echo jsonResponse(200, ["Content-Type => application/json"], [
    "success" => true,
    "token" => $token
  ]);
} catch (Exception $exception) {
  echo jsonResponse(500, [], [
    "success" => false,
    "message" => $exception->getMessage()
  ]);
}
