<?php

require_once __DIR__ . '/../models/Produit.php';

class ProduitController
{

    public function listerProduits()
    {

        $produitModel = new Produit();

        $produits = $produitModel->getAllProduits();

        require_once __DIR__ . '/../views/catalogue.php';
    }

    public function animaldex(): void
    {
        $produitModel = new Produit();
        $cartes = $produitModel->getCartes();

        require __DIR__ . '/../views/animaldex.php';
    }
}
