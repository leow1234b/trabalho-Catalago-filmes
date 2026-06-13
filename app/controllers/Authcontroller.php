<?php
if (!defined('APP_STARTED')) {
    exit('Acesso negado.');
}

require_once __DIR__ . '/../models/User.php';

class AuthController {
    private function validCsrfToken() {
        $token = $_POST['csrf_token'] ?? '';
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public function register() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->validCsrfToken()) {
                $error = 'Token de segurança inválido.';
            } else {
                $nome = trim($_POST['nome'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $senha = $_POST['senha'] ?? '';

                if ($nome === '' || $email === '' || $senha === '') {
                    $error = 'Preencha todos os campos.';
                } elseif (strlen($nome) < 3 || strlen($nome) > 100) {
                    $error = 'O nome deve ter entre 3 e 100 caracteres.';
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 100) {
                    $error = 'Informe um e-mail válido.';
                } elseif (strlen($senha) < 6) {
                    $error = 'A senha deve ter pelo menos 6 caracteres.';
                } else {
                    $user = new User();
                    if ($user->register($nome, $email, $senha)) {
                        header('Location: index.php?page=login');
                        exit;
                    }
                    $error = 'Não foi possível cadastrar o usuário. Verifique se o e-mail já foi usado.';
                }
            }
        }

        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->validCsrfToken()) {
                $error = 'Token de segurança inválido.';
            } else {
                $email = trim($_POST['email'] ?? '');
                $senha = $_POST['senha'] ?? '';

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = 'Informe um e-mail válido.';
                } else {
                    $user = new User();
                    $login = $user->login($email, $senha);

                    if ($login) {
                        session_regenerate_id(true);
                        $_SESSION['user'] = $login;
                        header('Location: index.php');
                        exit;
                    }

                    $error = 'E-mail ou senha inválidos.';
                }
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$this->validCsrfToken()) {
            header('Location: index.php');
            exit;
        }

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'] ?? '',
                $params['secure'] ?? false,
                $params['httponly'] ?? true
            );
        }

        session_destroy();
        header('Location: index.php');
        exit;
    }
}
