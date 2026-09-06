<?php $titrePage = "Accueil"; require __DIR__ . '/partials/header.php'; ?>

<main class="accueil">
    <section class="hero">
        <img src="assets/img/image_fond_accueil.jpg"
             alt="Chats et chiens de la collection Animal TCG"
             class="hero__image">

        <div class="hero__contenu">
            <p class="hero__marque">Animal TCG</p>
            <p class="hero__slogan">Collectionnez-les tous&nbsp;!</p>
            <a href="index.php?route=catalogue" class="hero__bouton">Voir la boutique</a>
        </div>
    </section>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>