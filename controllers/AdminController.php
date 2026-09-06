<?php

require_once __DIR__ . '/../models/Produit.php';

class AdminController
{
    private Produit $produitModel;

    public function __construct(){   
        if (!est_admin()) {
            $_SESSION['flash'] = "Accès réservé à l'administrateur.";
            redirect('connexion');
        }
        $this->produitModel = new Produit();
    }

    public function liste(): void
    {
        $produits = $this->produitModel->getAllProduits();
        require __DIR__ . '/../views/admin_liste.php';
    }

    public function ajouter(): void
    {
        $mode    = 'ajouter';
        $erreurs = [];
        $old     = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            [$erreurs, $donnees] = $this->validerFormulaire();
            if (empty($erreurs)) {
                $this->produitModel->ajouterProduit($donnees);
                $_SESSION['flash'] = "Le produit a bien été ajouté.";
                redirect('admin');
            }
            $old = $_POST;
        }

        require __DIR__ . '/../views/admin_formulaire.php';
    }

    public function modifier(): void{   
        $id      = (int) ($_GET['id'] ?? 0);
        $produit = $this->produitModel->trouverParId($id);
        if ($produit === null) {
            redirect('admin');
        }

        $mode    = 'modifier';
        $erreurs = [];
        $old     = $produit; 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            [$erreurs, $donnees] = $this->validerFormulaire();
            if (empty($erreurs)) {
                $this->produitModel->modifierProduit($id, $donnees);
                $_SESSION['flash'] = "Le produit a bien été modifié.";
                redirect('admin');
            }
            $old = $_POST;
            $old['produit_id'] = $id;
        }

        require __DIR__ . '/../views/admin_formulaire.php';
    }

    public function supprimer(): void{
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verifier()) {
            redirect('admin');
        }

        $id = (int) ($_POST['produit_id'] ?? 0);
        $ok = $this->produitModel->supprimerProduit($id);

        $_SESSION['flash'] = $ok
            ? "Le produit a bien été supprimé."
            : "Impossible de supprimer ce produit (il est peut-être lié à des commandes).";

        redirect('admin');
    }

    private function validerFormulaire(): array{
        if (!csrf_verifier()) {
            return [['global' => "Session expirée, merci de renvoyer le formulaire."], []];
        }

        $nom         = trim($_POST['nom_produit'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $type        = $_POST['type'] ?? '';
        $image       = trim($_POST['image_url'] ?? '');
        $rareteIn    = $_POST['rarete'] ?? '';
        $prixIn      = trim((string) ($_POST['prix'] ?? ''));
        $stockIn     = trim((string) ($_POST['stock'] ?? ''));

        $typesValides   = ['carte', 'booster', 'display'];
        $raretesValides = ['Commune', 'Rare', 'Légendaire'];

        $erreurs = [];
        if ($nom === '')                                 $erreurs['nom_produit'] = "Le nom est obligatoire.";
        if ($description === '')                         $erreurs['description'] = "La description est obligatoire.";
        if (!in_array($type, $typesValides, true))       $erreurs['type']        = "Type invalide.";
        if ($image === '')                               $erreurs['image_url']   = "L'image est obligatoire.";

        $prix = null;
        $stock = null;
        $rarete = null;

        if ($type === 'carte') {
            if (!in_array($rareteIn, $raretesValides, true)) {
                $erreurs['rarete'] = "Choisissez une rareté pour la carte.";
            } else {
                $rarete = $rareteIn;
            }
        } elseif ($type === 'booster' || $type === 'display') {
            if ($prixIn === '' || !is_numeric($prixIn) || (float) $prixIn <= 0) {
                $erreurs['prix'] = "Prix invalide (nombre supérieur à 0).";
            } else {
                $prix = (float) $prixIn;
            }
            if ($stockIn === '' || !ctype_digit($stockIn)) {
                $erreurs['stock'] = "Stock invalide (entier positif ou nul).";
            } else {
                $stock = (int) $stockIn;
            }
        }

        $donnees = [
            'nom_produit' => $nom,
            'description' => $description,
            'prix'        => $prix,
            'stock'       => $stock,
            'type'        => $type,
            'rarete'      => $rarete,
            'image_url'   => $image,
        ];

        return [$erreurs, $donnees];
    }
}