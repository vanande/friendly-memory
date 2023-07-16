<?php

require_once __DIR__ . "/../../libraries/response.php";
require_once __DIR__ . "/../../entities/users/get-users.php";
require_once __DIR__ . "/../../libraries/header.php";

try {
  $token = getAuthorizationBearerToken(); 

  if (getToken($token)){
    echo jsonResponse(401, [], [
      "success" => false,
      "message" => "Token does not exist"
    ]);
    return;
  }

  echo jsonResponse(200, [], [
    "success" => true,
    "users" => getUsers()
  ]);
} catch (Exception $exception) {
  echo jsonResponse(500, [], [
    "success" => false,
    "message" => $exception->getMessage()
  ]);
}
