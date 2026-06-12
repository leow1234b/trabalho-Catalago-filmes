<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Filmes</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
<h2>Lista de Filmes</h2>
<a href="index.php?page=create_movie">Cadastrar Filme</a>
<?php foreach($movies as $movie): ?>
<div>
    <h3><?= htmlspecialchars($movie['titulo']); ?></h3>
    <p><?= htmlspecialchars($movie['descricao']); ?></p>
    <p><?= htmlspecialchars($movie['genero']); ?></p>
</div>
<hr>
<?php endforeach; ?>
</body>
</html>