<?php ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titrePage) ? e($titrePage) . ' — ' : '' ?>Animal TCG</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="site-header">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#menuMobile" aria-controls="menuMobile" aria-label="Ouvrir le menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a href="index.php?route=accueil" class="logo navbar-brand order-lg-0" aria-label="Accueil Animal TCG">
                <img src="assets/img/canard.png" alt="Animal TCG">
            </a>

            <div class="nav-icones order-lg-2">
                <button class="btn p-0 border-0" aria-label="Rechercher"><svg viewBox="0 0 24 24" fill="none" stroke="#1a1a1a" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="21" y2="21" stroke-linecap="round"/></svg></button>

                <?php if (est_connecte()): ?>
                    <a href="index.php?route=deconnexion" aria-label="Se déconnecter" title="Déconnexion (<?= e($_SESSION['prenom'] ?? '') ?>)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#1a1a1a" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" stroke-linecap="round" stroke-linejoin="round"/><polyline points="16 17 21 12 16 7" stroke-linecap="round" stroke-linejoin="round"/><line x1="21" y1="12" x2="9" y2="12" stroke-linecap="round"/></svg>
                    </a>
                <?php else: ?>
                    <a href="index.php?route=connexion" aria-label="Se connecter">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#1a1a1a" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8" stroke-linecap="round"/></svg>
                    </a>
                <?php endif; ?>

                <a href="index.php?route=panier" aria-label="Mon panier">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#1a1a1a" stroke-width="2"><path d="M3 4h2l2.4 12.2a1.5 1.5 0 001.5 1.2h8.6a1.5 1.5 0 001.5-1.2L22 8H6" stroke-linecap="round" stroke-linejoin="round"/><circle cx="10" cy="21" r="1.4" fill="#1a1a1a"/><circle cx="18" cy="21" r="1.4" fill="#1a1a1a"/></svg>
                </a>
            </div>

            <div class="offcanvas offcanvas-top order-lg-1" tabindex="-1" id="menuMobile" aria-labelledby="menuMobileLabel">
                <div class="offcanvas-header d-lg-none">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="index.php?route=catalogue">Les cartes</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?route=animaldex">Animaldex</a></li>
                        <?php if (est_admin()): ?>
                            <li class="nav-item"><a class="nav-link" href="index.php?route=admin">Gestion catalogue</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        </div>
    </nav>
</header>