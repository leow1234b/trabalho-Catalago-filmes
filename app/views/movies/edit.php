<?php
if (!defined('APP_STARTED')) {
    exit('Acesso negado.');
}

$pageTitle = 'Editar filme';
require_once __DIR__ . '/../layout/header.php';
?>
<main class="container py-5">
    <div class="form-panel mx-auto">
        <h1 class="h3 mb-4">Editar filme</h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">

            <label class="form-label" for="titulo">Título</label>
            <input class="form-control mb-3" id="titulo" type="text" name="titulo" maxlength="150" value="<?= htmlspecialchars($movieData['titulo'] ?? ''); ?>" required>

            <label class="form-label" for="descricao">Descrição</label>
            <textarea class="form-control mb-3" id="descricao" name="descricao" rows="4"><?= htmlspecialchars($movieData['descricao'] ?? ''); ?></textarea>

            <label class="form-label" for="ano">Ano</label>
            <input class="form-control mb-3" id="ano" type="number" name="ano" min="1895" max="<?= htmlspecialchars((string) ((int) date('Y') + 1)); ?>" value="<?= htmlspecialchars($movieData['ano'] ?? ''); ?>">

            <label class="form-label" for="genero">Gênero</label>
            <input class="form-control mb-3" id="genero" type="text" name="genero" maxlength="100" value="<?= htmlspecialchars($movieData['genero'] ?? ''); ?>">

            <label class="form-label" for="capa">URL da capa</label>
            <input class="form-control mb-4" id="capa" type="url" name="capa" maxlength="255" value="<?= htmlspecialchars($movieData['capa'] ?? ''); ?>">

            <div class="d-flex gap-2">
                <button class="btn btn-danger" type="submit">Salvar</button>
                <a class="btn btn-outline-light" href="index.php?page=movies">Cancelar</a>
            </div>
        </form>
    </div>
</main>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>
