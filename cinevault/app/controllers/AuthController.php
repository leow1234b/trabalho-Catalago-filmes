<?php

require_once __DIR__ . '/../models/User.php';

class AuthController{

    public function register(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if($_POST['csrf_token'] !== $_SESSION['csrf_token']){
                die('Token CSRF inválido');
            }

            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $user = new User();

            $user->register($nome, $email, $senha);

            header('Location: index.php?page=login');
        }

        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function login(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if($_POST['csrf_token'] !== $_SESSION['csrf_token']){
                die('Token CSRF inválido');
            }

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $userModel = new User();

            $user = $userModel->login($email, $senha);

            if($user){

                $_SESSION['user'] = $user;

                setcookie('ultimo_login', date('d/m/Y H:i'), time()+3600);

                header('Location: index.php');
                exit;
            }

            echo 'Login inválido';
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout(){
        session_destroy();
        header('Location: index.php');
    }
}