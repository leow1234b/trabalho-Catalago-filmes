<?php
if (!defined('APP_STARTED')) {
    exit('Acesso negado.');
}

$pageTitle = 'Login';
require_once __DIR__ . '/../layout/header.php';
?>
<main class="container py-5">
    <div class="form-panel mx-auto">
        <h1 class="h3 mb-4">Login</h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">

            <label class="form-label" for="email">E-mail</label>
            <input class="form-control mb-3" id="email" type="email" name="email" maxlength="100" required>

            <label class="form-label" for="senha">Senha</label>
            <input class="form-control mb-4" id="senha" type="password" name="senha" minlength="6" required>

            <button class="btn btn-danger w-100" type="submit">Entrar</button>
        </form>

        <p class="mt-3 mb-0 text-center">
            Ainda não tem conta?
            <a href="index.php?page=register">Cadastre-se</a>
        </p>
    </div>
</main>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>
