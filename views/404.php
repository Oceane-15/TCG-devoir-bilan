<?php $titrePage = "Page introuvable"; require __DIR__ . '/partials/header.php'; ?>

<main class="auth-main">
    <div class="erreur-404">
        <img src="assets/img/404_error.png" alt="Robot signalant une erreur 404" class="erreur-404__image">

        <p class="erreur-404__texte">Page non trouvée</p>

        <a href="index.php?route=accueil" class="erreur-404__bouton">Retour à l'accueil</a>
    </div>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>