<?php

require_once __DIR__ . '/controllers/ProduitController.php';

try {
    $controller = new ProduitController();
    $controller->listerProduits();
} catch (Throwable $e) {
    
    error_log('Erreur application : ' . $e->getMessage());
    http_response_code(500);
    echo "Une erreur est survenue. Merci de réessayer plus tard.";
}