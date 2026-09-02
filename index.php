<?php

require_once __DIR__ . '/config/init.php';

$route = $_GET['route'] ?? 'accueil';

try {
    switch ($route) {

        case 'accueil':
        case 'catalogue':
            require_once __DIR__ . '/controllers/ProduitController.php';
            (new ProduitController())->listerProduits();
            break;

        case 'inscription':
            require_once __DIR__ . '/controllers/AuthController.php';
            (new AuthController())->inscription();
            break;

        case 'connexion':
            require_once __DIR__ . '/controllers/AuthController.php';
            (new AuthController())->connexion();
            break;

        case 'deconnexion':
            require_once __DIR__ . '/controllers/AuthController.php';
            (new AuthController())->deconnexion();
            break;

        case 'panier-ajouter':
            require_once __DIR__ . '/controllers/PanierController.php';
            (new PanierController())->ajouter();
            break;

        case 'panier-modifier':
            require_once __DIR__ . '/controllers/PanierController.php';
            (new PanierController())->modifier();
            break;

        case 'panier-supprimer':
            require_once __DIR__ . '/controllers/PanierController.php';
            (new PanierController())->supprimer();
            break;

        case 'checkout':
            require_once __DIR__ . '/controllers/PanierController.php';
            (new PanierController())->checkout();
            break;

        case 'commande':
            require_once __DIR__ . '/controllers/PanierController.php';
            (new PanierController())->valider();
            break;

        case 'commande-confirmee':
            require_once __DIR__ . '/controllers/PanierController.php';
            (new PanierController())->confirmation();
            break;

        default:
            http_response_code(404);
            require __DIR__ . '/views/404.php';
            break;
    }
    
} catch (Throwable $e) {
    error_log('Erreur application : ' . $e->getMessage());
    http_response_code(500);
    echo "Une erreur est survenue. Merci de réessayer plus tard.";
}
