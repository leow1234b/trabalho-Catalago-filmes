<?php

session_start();

require_once __DIR__ . "/app/controllers/AuthController.php";
require_once __DIR__ . "/app/controllers/MovieController.php";


$auth = new AuthController();
$movie = new MovieController();


$acao = $_GET['acao'] ?? 'filmes';


switch ($acao) {

    case "login":
        $auth->login();
        break;

    case "register":
        $auth->register();
        break;

    case "logout":
        $auth->logout();
        break;

    case "filmes":
        $movie->index();
        break;

    default:
        $movie->index();
        break;
}

?>