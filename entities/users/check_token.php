<?php


function checkToken($token){

    if ($token === null) {
        return false;
    }

    require_once __DIR__ . "/get-token.php";
    if (getToken($token) === null) {
        return false;
    }

    return true;
}