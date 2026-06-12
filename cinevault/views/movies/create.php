<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Filme</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
<h2>Novo Filme</h2>
<form method="POST">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
    <input type="text" name="titulo" placeholder="Título" required>
    <textarea name="descricao" placeholder="Descrição"></textarea>
    <input type="number" name="ano" placeholder="Ano">
    <input type="text" name="genero" placeholder="Gênero">
    <input type="text" name="capa" placeholder="URL da capa">
    <button type="submit">Salvar</button>
</form>
</body>
</html>