<?php if (!isset($panierResume)) {
    $panierResume = panier_resume();
} ?>

<div class="offcanvas offcanvas-end panier-tiroir" tabindex="-1" id="panierOffcanvas" aria-labelledby="panierOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title panier-tiroir__titre" id="panierOffcanvasLabel">
            Mon panier (<span id="panierCount"><?= (int) $panierResume['nb'] ?></span>)
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
    </div>

    <div class="offcanvas-body" id="panierContenu">
        <?php require __DIR__ . '/panier_contenu.php'; ?>
    </div>
</div>
<?php if (empty($panierResume['lignes'])): ?>
    <p class="panier-tiroir__vide">Votre panier est vide.</p>
<?php else: ?>
    <?php foreach ($panierResume['lignes'] as $ligne): ?>
        <?php $p = $ligne['produit']; ?>
        <div class="panier-ligne">
            <img src="<?= e($p['image_url']) ?>" alt="<?= e($p['nom_produit']) ?>" class="panier-ligne__image">

            <div class="panier-ligne__infos">
                <p class="panier-ligne__nom"><?= e($p['nom_produit']) ?></p>

                <div class="panier-ligne__quantite">
                    <form action="index.php?route=panier-modifier" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="produit_id" value="<?= e($p['produit_id']) ?>">
                        <input type="hidden" name="quantite" value="<?= (int) $ligne['quantite'] - 1 ?>">
                        <button type="submit" class="panier-ligne__fleche" aria-label="Diminuer la quantité">&larr;</button>
                    </form>

                    <span class="panier-ligne__nombre"><?= (int) $ligne['quantite'] ?></span>

                    <form action="index.php?route=panier-modifier" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="produit_id" value="<?= e($p['produit_id']) ?>">
                        <input type="hidden" name="quantite" value="<?= (int) $ligne['quantite'] + 1 ?>">
                        <button type="submit" class="panier-ligne__fleche" aria-label="Augmenter la quantité">&rarr;</button>
                    </form>
                </div>
            </div>

            <div class="panier-ligne__droite">
                <form action="index.php?route=panier-supprimer" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="produit_id" value="<?= e($p['produit_id']) ?>">
                    <button type="submit" class="panier-ligne__supprimer" aria-label="Supprimer l'article">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6" />
                            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2" />
                        </svg>
                    </button>
                </form>

                <p class="panier-ligne__prix"><?= e(number_format($ligne['sous_total'], 2, ',', ' ')) ?> €</p>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="panier-tiroir__total">
        <span>Total</span>
        <strong><?= e(number_format($panierResume['total'], 2, ',', ' ')) ?> €</strong>
    </div>
<?php endif; ?>
</div>

<?php if (!empty($panierResume['lignes'])): ?>
    <div class="panier-tiroir__pied">
        <a href="index.php?route=checkout" class="panier-tiroir__commander">Commander maintenant</a>
    </div>
<?php endif; ?>
</div>