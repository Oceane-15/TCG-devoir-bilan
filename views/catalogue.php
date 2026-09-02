<?php $titrePage = "Les cartes"; require __DIR__ . '/partials/header.php'; ?>

<main class="catalogue container">
    <h1 class="catalogue__titre">Les cartes</h1>

    <div class="row justify-content-center g-4">
        <?php if (!empty($produits)): ?>
            <?php foreach ($produits as $produit): ?>
                <?php if ($produit['type'] === 'carte') { continue; }?>
                <div class="col-12 col-sm-6 col-lg-4">
                    <article class="produit-carte">
                        <div class="produit-carte__media">
                            <img src="<?= e($produit['image_url']) ?>" alt="<?= e($produit['nom_produit']) ?>" class="produit-carte__image">
                        </div>
                        <h2 class="produit-carte__nom"><?= e($produit['nom_produit']) ?></h2>
                        <p class="produit-carte__prix"><?= e(number_format((float) $produit['prix'], 2, ',', ' ')) ?> €</p>

                        <form action="index.php?route=panier-ajouter" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="produit_id" value="<?= e($produit['produit_id']) ?>">
                            <button type="submit" class="produit-carte__bouton">Ajouter au panier</button>
                        </form>
                    </article>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun produit disponible.</p>
        <?php endif; ?>
    </div>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>