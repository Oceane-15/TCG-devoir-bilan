<?php $titrePage = "Commande confirmée"; require __DIR__ . '/partials/header.php'; ?>
<?php /** @var int $commandeId */ ?>

<main class="confirmation container">
    <h1 class="confirmation__titre">Merci pour votre commande !</h1>
    <p class="confirmation__texte">
        Votre commande n°<?= (int) $commandeId ?> a bien été enregistrée.
    </p>
    <a href="index.php?route=catalogue" class="confirmation__bouton">Retour à la boutique</a>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>