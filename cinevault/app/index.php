<?php

session_start();

if(!isset($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/MovieController.php';

$page = $_GET['page'] ?? 'home';

switch($page){

    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'movies':
        $controller = new MovieController();
        $controller->index();
        break;

    case 'create_movie':
        $controller = new MovieController();
        $controller->create();
        break;

    default:
        require_once 'app/views/home.php';
        break;
}
?>