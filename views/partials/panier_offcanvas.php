<?php if (!isset($panierResume)) { $panierResume = panier_resume(); } ?>

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