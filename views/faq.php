<?php $titrePage = "Contact et FAQ"; require __DIR__ . '/partials/header.php'; ?>
<?php
/** @var array $erreurs */
/** @var array $old */

$questions = [
    [
        "Comment passer une commande ?",
        "Ajoutez les produits souhaités à votre panier, puis validez depuis la page on commande. Un compte est nécessaire pour finaliser l'achat.",
    ],
    [
        "Quels sont les délais de livraison ?",
        "Les commandes sont préparées sous 48h puis expédiées à l'adresse choisie (domicile ou point relais). Les délais varient selon le mode de livraison sélectionné.",
    ],
    [
        "Comment sont protégées mes données personnelles ?",
        "Vos données (nom, prénom, e-mail) sont stockées de manière sécurisée et ne sont jamais cédées à des tiers. Vous pouvez demander leur suppression à tout moment, conformément au RGPD.",
    ],
    [
        "Puis-je modifier ou annuler ma commande ?",
        "Tant que votre commande n'a pas été expédiée, contactez notre service client via le formulaire ci-dessous pour toute modification ou annulation.",
    ],
];
?>

<main class="faq container">
    <h1 class="faq__titre">FAQ</h1>

    <div class="faq__liste">
        <?php foreach ($questions as $qr): ?>
            <div class="faq-item">
                <p class="faq-item__question"><?= e($qr[0]) ?></p>
                <p class="faq-item__reponse"><?= e($qr[1]) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <section class="faq-contact">
        <h2 class="faq-contact__titre">Contacter le SAV</h2>

        <?php if (!empty($_SESSION['flash'])): ?>
            <p class="alerte alerte-succes"><?= e($_SESSION['flash']) ?></p>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
        <?php if (!empty($erreurs['global'])): ?>
            <p class="alerte alerte-erreur"><?= e($erreurs['global']) ?></p>
        <?php endif; ?>

        <form action="index.php?route=faq" method="post" class="faq-contact__form">
            <?= csrf_field() ?>

            <div class="field">
                <label for="nom" class="sr-only">Votre prénom / nom</label>
                <input type="text" id="nom" name="nom" value="<?= e($old['nom'] ?? '') ?>" placeholder="Votre prénom / nom...">
                <?php if (!empty($erreurs['nom'])): ?><span class="erreur"><?= e($erreurs['nom']) ?></span><?php endif; ?>
            </div>

            <div class="field">
                <label for="email" class="sr-only">Adresse e-mail</label>
                <input type="email" id="email" name="email" value="<?= e($old['email'] ?? '') ?>" placeholder="email...">
                <?php if (!empty($erreurs['email'])): ?><span class="erreur"><?= e($erreurs['email']) ?></span><?php endif; ?>
            </div>

            <div class="field">
                <label for="telephone" class="sr-only">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" value="<?= e($old['telephone'] ?? '') ?>" placeholder="Téléphone...">
            </div>

            <div class="field">
                <label for="message" class="sr-only">Votre message</label>
                <textarea id="message" name="message" rows="6" placeholder="Votre message..."><?= e($old['message'] ?? '') ?></textarea>
                <?php if (!empty($erreurs['message'])): ?><span class="erreur"><?= e($erreurs['message']) ?></span><?php endif; ?>
            </div>

            <button type="submit" class="submit">Envoyer</button>
        </form>
    </section>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>