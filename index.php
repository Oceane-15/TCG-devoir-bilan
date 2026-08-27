<?php

require_once __DIR__ . '/controllers/ProduitController.php';

$controller = new ProduitController();

$controller->listerProduits();