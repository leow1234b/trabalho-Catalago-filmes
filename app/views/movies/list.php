<?php
if (!defined('APP_STARTED')) {
    exit('Acesso negado.');
}

$pageTitle = 'Filmes';
require_once __DIR__ . '/../layout/header.php';
?>
<main class="container py-5">
    <div class="d-flex justify-content-between align-items-center gap-3 mb-4 flex-wrap">
        <div>
            <p class="text-danger fw-semibold mb-1">CineVault</p>
            <h1 class="h2 mb-0">Filmes cadastrados</h1>
        </div>
        <?php if (isset($_SESSION['user'])): ?>
            <a class="btn btn-danger" href="index.php?page=create_movie">Cadastrar filme</a>
        <?php else: ?>
            <a class="btn btn-outline-light" href="index.php?page=login">Entrar para cadastrar</a>
        <?php endif; ?>
    </div>

    <?php if (empty($movies)): ?>
        <div class="empty-state">
            <h2 class="h4">Nenhum filme cadastrado</h2>
            <p class="mb-0 text-secondary-emphasis">Quando houver filmes no banco, eles aparecerão aqui.</p>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($movies as $movie): ?>
                <div class="col-md-6 col-xl-4">
                    <article class="movie-card h-100">
                        <?php if (!empty($movie['capa'])): ?>
                            <img class="movie-cover" src="<?= htmlspecialchars($movie['capa']); ?>" alt="Capa do filme <?= htmlspecialchars($movie['titulo']); ?>">
                        <?php endif; ?>

                        <div class="p-4">
                            <h2 class="h4"><?= htmlspecialchars($movie['titulo']); ?></h2>
                            <p class="movie-meta mb-2">
                                <?= htmlspecialchars($movie['genero'] ?: 'Sem gênero'); ?>
                                <?php if (!empty($movie['ano'])): ?>
                                    &bull; <?= htmlspecialchars($movie['ano']); ?>
                                <?php endif; ?>
                            </p>
                            <p class="mb-4"><?= htmlspecialchars($movie['descricao'] ?: 'Sem descrição cadastrada.'); ?></p>

                            <?php if (isset($_SESSION['user']) && (int) $movie['usuario_id'] === (int) $_SESSION['user']['id']): ?>
                                <div class="d-flex gap-2">
                                    <a class="btn btn-sm btn-outline-light" href="index.php?page=edit_movie&id=<?= htmlspecialchars($movie['id']); ?>">Editar</a>
                                    <form method="POST" action="index.php?page=delete_movie&id=<?= htmlspecialchars($movie['id']); ?>" onsubmit="return confirm('Deseja excluir este filme?');">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Excluir</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>
