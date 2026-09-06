<?php $titrePage = "Gestion catalogue"; require __DIR__ . '/partials/header.php'; ?>
<?php /** @var array $produits */ ?>

<main class="admin container">
    <h1 class="admin__titre">Gestion catalogue</h1>

    <?php if (!empty($_SESSION['flash'])): ?>
        <p class="alerte alerte-succes"><?= e($_SESSION['flash']) ?></p>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="admin__haut">
        <a href="index.php?route=admin-ajouter" class="admin__ajouter">Ajouter un produit</a>
    </div>

    <div class="admin__liste">
        <?php foreach ($produits as $produit): ?>
            <div class="admin-ligne">
                <span class="admin-ligne__champ admin-ligne__nom"><?= e($produit['nom_produit']) ?></span>
                <span class="admin-ligne__champ"><?= e(ucfirst($produit['type'])) ?></span>
                <span class="admin-ligne__champ">
                    <?= $produit['stock'] !== null ? (int) $produit['stock'] : '—' ?>
                </span>

                <a href="index.php?route=admin-modifier&id=<?= (int) $produit['produit_id'] ?>"
                   class="admin-ligne__modifier">Modifier</a>

                <form action="index.php?route=admin-supprimer" method="post"
                      onsubmit="return confirm('Supprimer définitivement ce produit ?');">
                    <?= csrf_field() ?>
                    <input type="hidden" name="produit_id" value="<?= (int) $produit['produit_id'] ?>">
                    <button type="submit" class="admin-ligne__supprimer">Supprimer</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>