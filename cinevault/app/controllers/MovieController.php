<?php
require_once __DIR__ . '/../models/Movie.php';

class MovieController{
    public function index(){
        $movie = new Movie();
        $movies = $movie->getAll();
        require_once __DIR__ . '/../views/movies/list.php';
    }

    public function create(){
        if(!isset($_SESSION['user'])){
            die('Acesso negado');
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['csrf_token'] !== $_SESSION['csrf_token']){
                die('Token inválido');
            }
            $movie = new Movie();
            $movie->create(
                $_POST['titulo'],
                $_POST['descricao'],
                $_POST['ano'],
                $_POST['genero'],
                $_POST['capa']
            );
            header('Location: index.php?page=movies');
        }
        require_once __DIR__ . '/../views/movies/create.php';
    }
}
?>