<?php
/** @var array $old */
/** @var array $erreurs */
/** @var string $mode */
$titrePage = ($mode === 'modifier') ? "Modifier un produit" : "Ajouter un produit";
require __DIR__ . '/partials/header.php';

$action = ($mode === 'modifier')
    ? 'index.php?route=admin-modifier&id=' . (int) ($old['produit_id'] ?? 0)
    : 'index.php?route=admin-ajouter';
?>

<main class="admin container">
    <h1 class="admin__titre"><?= $mode === 'modifier' ? 'Modifier un produit' : 'Ajouter un produit' ?></h1>

    <?php if (!empty($erreurs['global'])): ?>
        <p class="alerte alerte-erreur"><?= e($erreurs['global']) ?></p>
    <?php endif; ?>

    <form action="<?= e($action) ?>" method="post" class="admin-form">
        <?= csrf_field() ?>

        <div class="field">
            <label for="nom_produit">Nom <span class="req">*</span></label>
            <input type="text" id="nom_produit" name="nom_produit" value="<?= e($old['nom_produit'] ?? '') ?>" required>
            <?php if (!empty($erreurs['nom_produit'])): ?><span class="erreur"><?= e($erreurs['nom_produit']) ?></span><?php endif; ?>
        </div>

        <div class="field">
            <label for="description">Description <span class="req">*</span></label>
            <textarea id="description" name="description" rows="3" required><?= e($old['description'] ?? '') ?></textarea>
            <?php if (!empty($erreurs['description'])): ?><span class="erreur"><?= e($erreurs['description']) ?></span><?php endif; ?>
        </div>

        <div class="field">
            <label for="type">Type <span class="req">*</span></label>
            <select id="type" name="type" required>
                <?php foreach (['carte' => 'Carte', 'booster' => 'Booster', 'display' => 'Display'] as $val => $lib): ?>
                    <option value="<?= $val ?>" <?= (($old['type'] ?? '') === $val) ? 'selected' : '' ?>><?= $lib ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($erreurs['type'])): ?><span class="erreur"><?= e($erreurs['type']) ?></span><?php endif; ?>
        </div>

        <div class="field">
            <label for="prix">Prix (€) <span class="admin-form__aide">— boosters / displays uniquement</span></label>
            <input type="number" step="0.01" min="0" id="prix" name="prix" value="<?= e($old['prix'] ?? '') ?>">
            <?php if (!empty($erreurs['prix'])): ?><span class="erreur"><?= e($erreurs['prix']) ?></span><?php endif; ?>
        </div>

        <div class="field">
            <label for="stock">Stock <span class="admin-form__aide">— boosters / displays uniquement</span></label>
            <input type="number" min="0" id="stock" name="stock" value="<?= e($old['stock'] ?? '') ?>">
            <?php if (!empty($erreurs['stock'])): ?><span class="erreur"><?= e($erreurs['stock']) ?></span><?php endif; ?>
        </div>

        <div class="field">
            <label for="rarete">Rareté <span class="admin-form__aide">— cartes uniquement</span></label>
            <select id="rarete" name="rarete">
                <option value="">—</option>
                <?php foreach (['Commune', 'Rare', 'Légendaire'] as $r): ?>
                    <option value="<?= $r ?>" <?= (($old['rarete'] ?? '') === $r) ? 'selected' : '' ?>><?= $r ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($erreurs['rarete'])): ?><span class="erreur"><?= e($erreurs['rarete']) ?></span><?php endif; ?>
        </div>

        <div class="field">
            <label for="image_url">Image <span class="req">*</span> <span class="admin-form__aide">— ex. assets/img/booster_animal.png</span></label>
            <input type="text" id="image_url" name="image_url" value="<?= e($old['image_url'] ?? '') ?>" placeholder="assets/img/mon_image.png" required>
            <?php if (!empty($erreurs['image_url'])): ?><span class="erreur"><?= e($erreurs['image_url']) ?></span><?php endif; ?>
        </div>

        <div class="admin-form__actions">
            <button type="submit" class="submit"><?= $mode === 'modifier' ? 'Enregistrer' : 'Ajouter le produit' ?></button>
            <a href="index.php?route=admin" class="admin-form__annuler">Annuler</a>
        </div>
    </form>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>