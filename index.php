<?php
define('APP_STARTED', true);

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/app/controllers/Authcontroller.php';
require_once __DIR__ . '/app/controllers/Moviecontroller.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'login':
        (new AuthController())->login();
        break;
    case 'register':
        (new AuthController())->register();
        break;
    case 'logout':
        (new AuthController())->logout();
        break;
    case 'movies':
        (new MovieController())->index();
        break;
    case 'create_movie':
        (new MovieController())->create();
        break;
    case 'edit_movie':
        (new MovieController())->edit();
        break;
    case 'delete_movie':
        (new MovieController())->delete();
        break;
    default:
        require_once __DIR__ . '/app/views/Home.php';
        break;
}
