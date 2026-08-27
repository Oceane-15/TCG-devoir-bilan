<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - TCG Shop</title>
</head>
<body>
    <h1>Catalogue de nos cartes</h1>

    <div class="produits-container" style="display: flex; flex-wrap: wrap; gap: 20px;">
        <?php if (!empty($produits)): ?>
            <?php foreach ($produits as $produit): ?>
                <div class="produit-carte" style="border: 1px solid #ccc; padding: 15px; width: 250px; border-radius: 8px;">
                    
                    <?php 
                    
                        if ($produit['type'] === 'display') {
                            $hauteurImage = '160px';
                            $styleObjet = 'object-fit: contain; background-color: #f9f9f9;';
                        } elseif ($produit['type'] === 'booster') {
                            $hauteurImage = '150px'; 
                            $styleObjet = 'object-fit: contain; background-color: #f9f9f9;';
                        } else {
                            $hauteurImage = '280px'; 
                            if ($produit['nom_produit'] === 'Le canard obscure') {
                                $styleObjet = 'object-fit: cover; object-position: right center;';
                            } else {
                                $styleObjet = 'object-fit: cover;';
                            }
                        }
                    ?>
                    <img src="<?= htmlspecialchars($produit['image_url']) ?>" 
                         alt="<?= htmlspecialchars($produit['nom_produit']) ?>" 
                         style="width: 100%; height: <?= $hauteurImage ?>; <?= $styleObjet ?> border-radius: 4px;">

                    <h3><?= htmlspecialchars($produit['nom_produit']) ?></h3>
                    
                    <p><strong>Prix :</strong> <?= htmlspecialchars($produit['prix']) ?> €</p>
                    <p><strong>Type :</strong> <?= htmlspecialchars($produit['type']) ?></p>
                    <p><?= htmlspecialchars($produit['description']) ?></p>
                    
                    <?php if (!empty($produit['rarete'])): ?>
                        <p><em>Rareté : <?= htmlspecialchars($produit['rarete']) ?></em></p>
                    <?php endif; ?>

                    <p><strong>Stock :</strong> <?= htmlspecialchars($produit['stock']) ?> restants</p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun produit trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>