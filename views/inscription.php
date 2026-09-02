<?php $titrePage = "Inscription"; require __DIR__ . '/partials/header.php'; 

/** @var array $old */
/** @var array $erreurs */
$titrePage = "Inscription";

?>

<main class="auth-main">
    <h1>Inscription</h1>

    <?php if (!empty($erreurs['global'])): ?>
        <p class="alerte alerte-erreur"><?= e($erreurs['global']) ?></p>
    <?php endif; ?>

    <form action="index.php?route=inscription" method="post" data-auth="inscription" novalidate>
        <?= csrf_field() ?>

        <div class="field">
            <label for="prenom">Prénom <span class="req">*</span></label>
            <input type="text" id="prenom" name="prenom" value="<?= e($old['prenom']) ?>"
                   autocomplete="given-name" placeholder="Jean" required>
            <?php if (!empty($erreurs['prenom'])): ?>
                <span class="erreur"><?= e($erreurs['prenom']) ?></span>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="nom">Nom <span class="req">*</span></label>
            <input type="text" id="nom" name="nom" value="<?= e($old['nom']) ?>"
                   autocomplete="family-name" placeholder="Dupont" required>
            <?php if (!empty($erreurs['nom'])): ?>
                <span class="erreur"><?= e($erreurs['nom']) ?></span>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="email">Adresse e-mail <span class="req">*</span></label>
            <input type="email" id="email" name="email" value="<?= e($old['email']) ?>"
                   autocomplete="email" placeholder="jean.dupont@email.com" required>
            <?php if (!empty($erreurs['email'])): ?>
                <span class="erreur"><?= e($erreurs['email']) ?></span>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="mdp">Mot de passe <span class="req">*</span></label>
            <input type="password" id="mdp" name="mot_de_passe"
                   autocomplete="new-password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required>
            <span class="hint">Au moins 12 caractères, avec majuscule, chiffre et caractère spécial.</span>
            <?php if (!empty($erreurs['mot_de_passe'])): ?>
                <span class="erreur"><?= e($erreurs['mot_de_passe']) ?></span>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="mdp2">Confirmer le mot de passe <span class="req">*</span></label>
            <input type="password" id="mdp2" name="mot_de_passe_confirm"
                   autocomplete="new-password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required>
            <?php if (!empty($erreurs['mot_de_passe_confirm'])): ?>
                <span class="erreur"><?= e($erreurs['mot_de_passe_confirm']) ?></span>
            <?php endif; ?>
        </div>

        <div class="field-checkbox">
            <input type="checkbox" id="cgv" name="cgv" value="1">
            <label for="cgv">J'accepte les <a href="index.php?route=cgv">conditions générales de vente</a> <span class="req">*</span></label>
        </div>
        <?php if (!empty($erreurs['cgv'])): ?>
            <span class="erreur erreur-cgv"><?= e($erreurs['cgv']) ?></span>
        <?php endif; ?>

        <button type="submit" class="submit">Créer mon compte</button>

        <p class="switch">Déjà un compte ? <a href="index.php?route=connexion">Se connecter</a></p>
    </form>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>