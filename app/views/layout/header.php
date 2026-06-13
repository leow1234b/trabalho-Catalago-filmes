<?php
if (!defined('APP_STARTED')) {
    exit('Acesso negado.');
}

$pageTitle = $pageTitle ?? 'CineVault';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?> - CineVault</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<header class="site-header">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">CineVault</a>
            <div class="navbar-nav flex-row gap-3 align-items-center">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="index.php?page=movies">Filmes</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <form class="m-0" method="POST" action="index.php?page=logout">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <button class="nav-link btn btn-link p-0" type="submit">
                            Sair (<?= htmlspecialchars($_SESSION['user']['nome']); ?>)
                        </button>
                    </form>
                <?php else: ?>
                    <a class="nav-link" href="index.php?page=login">Login</a>
                    <a class="nav-link" href="index.php?page=register">Cadastro</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
