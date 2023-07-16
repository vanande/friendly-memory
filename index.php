<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once __DIR__ . "/libraries/path.php";
require_once __DIR__ . "/libraries/method.php";


if (isPath("Exercice4/login")) {
    if (isGetMethod()) {
        require_once __DIR__ . "/routes/authentication/login.php";
        die();
    }
}

if (isPath("Exercice4/register")) {
    if (isPostMethod()) {
        require_once __DIR__ . "/routes/authentication/register.php";
        die();
    }
}


if (isPath("Exercice4/tasks")) {
    if (isGetMethod()) {
        require_once __DIR__ . "/routes/tasks/get.php";
        die();
    }
    if (isPostMethod()) {
        require_once __DIR__ . "/routes/tasks/post.php";
        die();
    }
}

if (isPath("Exercice4/tasks/:id")) {
    if (isPatchMethod()) {
        require_once __DIR__ . "/routes/tasks/patch.php";
        die();
    }
    if (isDeleteMethod()) {
        require_once __DIR__ . "/routes/tasks/delete.php";
        die();
    }
}