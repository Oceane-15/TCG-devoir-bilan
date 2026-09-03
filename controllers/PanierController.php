<?php

require_once __DIR__ . '/../models/Produit.php';
require_once __DIR__ . '/../models/Commande.php';

class PanierController {

    private Produit $produitModel;

    public function __construct() {
        $this->produitModel = new Produit();
    }

    private function estAjax(): bool {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

     private function repondrePanier(): void {
        if ($this->estAjax()) {
            $panierResume = panier_resume();

            ob_start();
            require __DIR__ . '/../views/partials/panier_contenu.php';
            $html = ob_get_clean();

            header('Content-Type: application/json');
            echo json_encode(['nb' => $panierResume['nb'], 'html' => $html]);
            exit;
        }

        $_SESSION['ouvrir_panier'] = true;
        redirect('catalogue');
    }

    public function ajouter(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verifier()) {
            redirect('catalogue');
        }

        $produitId = (int) ($_POST['produit_id'] ?? 0);
        $produit   = $this->produitModel->trouverParId($produitId);

        if ($produit !== null && $produit['type'] !== 'carte' && $produit['prix'] !== null) {
            $_SESSION['panier'][$produitId] = ($_SESSION['panier'][$produitId] ?? 0) + 1;
        }

        $this->repondrePanier();;
    }

    public function modifier(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verifier()) {
            redirect('catalogue');
        }

        $produitId = (int) ($_POST['produit_id'] ?? 0);
        $quantite  = (int) ($_POST['quantite'] ?? 1);
        if ($quantite < 1) {
            $quantite = 1;
        }

        if (isset($_SESSION['panier'][$produitId])) {
            $_SESSION['panier'][$produitId] = $quantite;
        }

        $this->repondrePanier();
    }

    public function supprimer(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verifier()) {
            redirect('catalogue');
        }

        $produitId = (int) ($_POST['produit_id'] ?? 0);
        unset($_SESSION['panier'][$produitId]);

        $this->repondrePanier();
    }

     public function checkout(): void {
        if (!est_connecte()) {
            $_SESSION['flash'] = "Vous devez être connecté pour passer commande.";
            redirect('connexion');
        }

        $resume = panier_resume();
        if (empty($resume['lignes'])) {
            redirect('catalogue');
        }

        require __DIR__ . '/../views/checkout.php';
    }

    public function valider(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verifier()) {
            redirect('catalogue');
        }

        if (!est_connecte()) {
            $_SESSION['flash'] = "Vous devez être connecté pour valider votre commande.";
            redirect('connexion');
        }

        $panier = $_SESSION['panier'] ?? [];
        if (empty($panier)) {
            redirect('catalogue');
        }

        $lignes = [];
        $total  = 0.0;
        foreach ($panier as $produitId => $quantite) {
            $produit = $this->produitModel->trouverParId((int) $produitId);
            if ($produit === null || $produit['type'] === 'carte' || $produit['prix'] === null) {
                continue;
            }
            $lignes[] = [
                'produit_id'    => (int) $produit['produit_id'],
                'quantite'      => (int) $quantite,
                'prix_unitaire' => (float) $produit['prix'],
            ];
            $total += (float) $produit['prix'] * $quantite;
        }

        if (empty($lignes)) {
            redirect('catalogue');
        }

        try {
            $commandeModel = new Commande();
            $commandeId = $commandeModel->creer((int) $_SESSION['utilisateur_id'], $lignes, $total);

            unset($_SESSION['panier']);
            $_SESSION['derniere_commande'] = $commandeId;
            redirect('commande-confirmee');

        } catch (Throwable $e) {
            $_SESSION['flash_erreur'] = "Impossible de valider la commande (stock insuffisant ?).";
            redirect('catalogue');
        }
    }

     public function confirmation(): void {
        if (empty($_SESSION['derniere_commande'])) {
            redirect('catalogue');
        }

        $commandeId = (int) $_SESSION['derniere_commande'];
        unset($_SESSION['derniere_commande']); 

        require __DIR__ . '/../views/confirmation.php';
    }
}