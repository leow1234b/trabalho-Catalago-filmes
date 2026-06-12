<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CineVault</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<header>
    <h1>CineVault</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="index.php?page=movies">Filmes</a>
        <?php if(isset($_SESSION['user'])): ?>
            <a href="index.php?page=logout">Sair (<?= $_SESSION['user']['nome']; ?>)</a>
        <?php else: ?>
            <a href="index.php?page=login">Login</a>
            <a href="index.php?page=register">Cadastro</a>
        <?php endif; ?>
    </nav>
</header>
<main>
    <section>
        <h2>Bem-vindo ao CineVault</h2>
        <p>Seu catálogo de filmes online.</p>
    </section>
</main>
<footer>
    <p>Projeto Faculdade - Desenvolvimento de Sistemas</p>
</footer>
</body>
</html>