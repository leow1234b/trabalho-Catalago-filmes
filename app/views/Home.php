<?php
if (!defined('APP_STARTED')) {
    exit('Acesso negado.');
}

$pageTitle = 'Início';
require_once __DIR__ . '/layout/header.php';
?>
<main class="home-hero">
    <div class="container py-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <p class="text-danger fw-semibold mb-2">Catálogo de filmes</p>
                <h1 class="display-5 fw-bold">CineVault</h1>
                <p class="lead text-secondary-emphasis">
                    Organize filmes com título, gênero, ano, descrição e capa em um sistema PHP no padrão MVC.
                </p>
                <div class="d-flex gap-2 flex-wrap">
                    <a class="btn btn-danger" href="index.php?page=movies">Ver filmes</a>
                    <?php if (!isset($_SESSION['user'])): ?>
                        <a class="btn btn-outline-light" href="index.php?page=login">Entrar</a>
                    <?php else: ?>
                        <a class="btn btn-outline-light" href="index.php?page=create_movie">Cadastrar filme</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="status-panel">
                    <span class="badge text-bg-danger mb-3">MVC</span>
                    <h2 class="h4">Projeto final A1</h2>
                    <p class="mb-0 text-secondary-emphasis">
                        Rotas pelo index.php, dados nos models, regras nos controllers e HTML nas views.
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/layout/footer.php'; ?>
