<?php $titrePage = "Animaldex"; require __DIR__ . '/partials/header.php'; ?>
<?php
/** @var array $cartes */
$slugsRarete = ['Commune' => 'commune', 'Rare' => 'rare', 'Légendaire' => 'legendaire'];
?>

<main class="animaldex container">
    <h1 class="animaldex__titre">Animaldex</h1>

    <input type="search" id="dexRecherche" class="animaldex__recherche"
           placeholder="Chercher parmi les cartes..." aria-label="Chercher parmi les cartes">

    <button type="button" class="animaldex__filtres-btn" data-bs-toggle="collapse"
            data-bs-target="#dexFiltres" aria-expanded="false" aria-controls="dexFiltres">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/><circle cx="9" cy="6" r="2" fill="#fff"/><circle cx="15" cy="12" r="2" fill="#fff"/><circle cx="8" cy="18" r="2" fill="#fff"/></svg>
        Filtres
    </button>

    <div class="collapse animaldex__filtres" id="dexFiltres">
        <fieldset class="animaldex__filtres-groupe">
            <legend class="animaldex__filtres-legende">Rareté</legend>
            <label><input type="checkbox" class="dex-rarete" value="Commune" checked> Commune</label>
            <label><input type="checkbox" class="dex-rarete" value="Rare" checked> Rare</label>
            <label><input type="checkbox" class="dex-rarete" value="Légendaire" checked> Légendaire Holographique</label>
        </fieldset>
    </div>

    <div class="row g-4" id="dexGrille">
        <?php foreach ($cartes as $carte): ?>
            <?php
                $rarete = $carte['rarete'] ?? '';
                $slug   = $slugsRarete[$rarete] ?? 'commune';
            ?>
            <div class="col-12 col-sm-6 col-lg-4 carte-dex"
                 data-nom="<?= e(mb_strtolower($carte['nom_produit'])) ?>"
                 data-rarete="<?= e($rarete) ?>">

                <div class="carte-dex__cadre carte-dex__cadre--<?= $slug ?>">
                    <img src="<?= e($carte['image_url']) ?>" alt="<?= e($carte['nom_produit']) ?>" class="carte-dex__image">
                </div>

                <span class="carte-dex__nom"><?= e($carte['nom_produit']) ?></span>
                <span class="carte-dex__rarete carte-dex__rarete--<?= $slug ?>"><?= e($rarete) ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <p class="animaldex__vide" id="dexVide" hidden>Aucune carte ne correspond à ta recherche.</p>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>