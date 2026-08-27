<?php

require_once __DIR__ . '/../models/Produit.php';

class ProduitController {

    public function listerProduits() {

        $produitModel = new Produit();
        
        $produits = $produitModel->getAllProduits();
        
        require_once __DIR__ . '/../views/catalogue.php';
    }
}
?>