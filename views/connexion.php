<?php $titrePage = "Connexion"; require __DIR__ . '/partials/header.php'; 

/** @var array $old */
/** @var array $erreurs */
$titrePage = "Connexion";

?>


<main class="auth-main">
    <h1>Connexion</h1>

    <?php if (!empty($_SESSION['flash'])): ?>
        <p class="alerte alerte-succes"><?= e($_SESSION['flash']) ?></p>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <?php if (!empty($erreurs['global'])): ?>
        <p class="alerte alerte-erreur"><?= e($erreurs['global']) ?></p>
    <?php endif; ?>

    <form action="index.php?route=connexion" method="post" novalidate>
        <?= csrf_field() ?>

        <div class="field">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" value="<?= e($old['email']) ?>"
                   autocomplete="email" placeholder="jean.dupont@email.com" required>
        </div>

        <div class="field">
            <label for="mdp">Mot de passe</label>
            <input type="password" id="mdp" name="mot_de_passe"
                   autocomplete="current-password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required>
        </div>

        <button type="submit" class="submit">Se connecter</button>

        <p class="switch">Pas encore de compte ? <a href="index.php?route=inscription">Inscrivez-vous</a></p>
    </form>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>