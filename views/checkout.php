<?php $titrePage = "On commande"; require __DIR__ . '/partials/header.php'; ?>
<?php /** @var array $resume */ ?>

<main class="checkout container">
    <h1 class="checkout__titre">On commande !</h1>

    <?php if (!empty($_SESSION['flash_erreur'])): ?>
        <p class="alerte alerte-erreur"><?= e($_SESSION['flash_erreur']) ?></p>
        <?php unset($_SESSION['flash_erreur']); ?>
    <?php endif; ?>

    <form action="index.php?route=commande" method="post" class="checkout__carte">
        <?= csrf_field() ?>

        <div class="checkout__produits">
            <?php foreach ($resume['lignes'] as $ligne): ?>
                <?php $p = $ligne['produit']; ?>
                <div class="checkout__produit">
                    <img src="<?= e($p['image_url']) ?>" alt="<?= e($p['nom_produit']) ?>" class="checkout__image">
                    <div class="checkout__produit-infos">
                        <p class="checkout__nom"><?= e($p['nom_produit']) ?></p>
                        <p class="checkout__qte">Quantité : <?= (int) $ligne['quantite'] ?></p>
                    </div>
                    <p class="checkout__ligne-prix"><?= e(number_format($ligne['sous_total'], 2, ',', ' ')) ?> €</p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="checkout__recap">
            <p class="checkout__total"><?= e(number_format($resume['total'], 2, ',', ' ')) ?> €</p>

            <fieldset class="checkout__choix">
                <legend class="checkout__legende">Paiement</legend>
                <div class="checkout__options">
                    <label><input type="radio" name="paiement" value="visa" required> Visa</label>
                    <label><input type="radio" name="paiement" value="cb"> CB</label>
                </div>
            </fieldset>

            <fieldset class="checkout__choix checkout__livraison">
                <legend class="checkout__legende">Livraison</legend>
                <div class="checkout__options">
                    <label><input type="radio" name="livraison" value="domicile" required> Domicile</label>
                    <label><input type="radio" name="livraison" value="relais"> Point relais</label>
                </div>
            </fieldset>

            <button type="submit" class="checkout__bouton">Procéder au paiement sécurisé</button>
        </div>
    </form>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>