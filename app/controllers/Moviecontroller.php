<?php
if (!defined('APP_STARTED')) {
    exit('Acesso negado.');
}

require_once __DIR__ . '/../models/Movie.php';

class MovieController {
    private function requireLogin() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }
    }

    private function validCsrfToken() {
        $token = $_POST['csrf_token'] ?? '';
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    private function movieDataFromPost() {
        return [
            'titulo' => trim($_POST['titulo'] ?? ''),
            'descricao' => trim($_POST['descricao'] ?? ''),
            'ano' => ($_POST['ano'] ?? '') === '' ? null : (int) $_POST['ano'],
            'genero' => trim($_POST['genero'] ?? ''),
            'capa' => trim($_POST['capa'] ?? '')
        ];
    }

    private function validateMovieData($movieData) {
        $currentYear = (int) date('Y') + 1;

        if ($movieData['titulo'] === '' || strlen($movieData['titulo']) > 150) {
            return 'Informe um título com até 150 caracteres.';
        }

        if ($movieData['ano'] !== null && ($movieData['ano'] < 1895 || $movieData['ano'] > $currentYear)) {
            return 'Informe um ano válido para o filme.';
        }

        if (strlen($movieData['genero']) > 100) {
            return 'O gênero deve ter até 100 caracteres.';
        }

        if ($movieData['capa'] !== '' && (!filter_var($movieData['capa'], FILTER_VALIDATE_URL) || strlen($movieData['capa']) > 255)) {
            return 'Informe uma URL de capa válida.';
        }

        return '';
    }

    public function index() {
        $movie = new Movie();
        $movies = $movie->getAll();
        require_once __DIR__ . '/../views/movies/list.php';
    }

    public function create() {
        $this->requireLogin();
        $error = '';
        $movieData = [
            'titulo' => '',
            'descricao' => '',
            'ano' => '',
            'genero' => '',
            'capa' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movieData = $this->movieDataFromPost();

            if (!$this->validCsrfToken()) {
                $error = 'Token de segurança inválido.';
            } else {
                $error = $this->validateMovieData($movieData);
            }

            if ($error === '') {
                $movie = new Movie();
                $movie->create(
                    $movieData['titulo'],
                    $movieData['descricao'],
                    $movieData['ano'],
                    $movieData['genero'],
                    $movieData['capa'],
                    $_SESSION['user']['id']
                );
                header('Location: index.php?page=movies');
                exit;
            }
        }

        require_once __DIR__ . '/../views/movies/create.php';
    }

    public function edit() {
        $this->requireLogin();
        $movieModel = new Movie();
        $id = (int) ($_GET['id'] ?? 0);
        $error = '';
        $movieData = $movieModel->getById($id);

        if (!$movieData || (int) $movieData['usuario_id'] !== (int) $_SESSION['user']['id']) {
            header('Location: index.php?page=movies');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movieData = $this->movieDataFromPost();

            if (!$this->validCsrfToken()) {
                $error = 'Token de segurança inválido.';
            } else {
                $error = $this->validateMovieData($movieData);
            }

            if ($error === '') {
                $movieModel->update(
                    $id,
                    $movieData['titulo'],
                    $movieData['descricao'],
                    $movieData['ano'],
                    $movieData['genero'],
                    $movieData['capa'],
                    $_SESSION['user']['id']
                );
                header('Location: index.php?page=movies');
                exit;
            }
        }

        require_once __DIR__ . '/../views/movies/edit.php';
    }

    public function delete() {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->validCsrfToken()) {
            $movie = new Movie();
            $movie->delete((int) ($_GET['id'] ?? 0), $_SESSION['user']['id']);
        }

        header('Location: index.php?page=movies');
        exit;
    }
}
