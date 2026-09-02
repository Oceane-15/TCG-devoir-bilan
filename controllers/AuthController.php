<?php

require_once __DIR__ . '/../models/Utilisateur.php';

class AuthController {

    private Utilisateur $utilisateurModel;

    public function __construct() {
        $this->utilisateurModel = new Utilisateur();
    }
    
    public function inscription(): void {
        $erreurs = [];
        $old     = ['prenom' => '', 'nom' => '', 'email' => '']; 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!csrf_verifier()) {
                $erreurs['global'] = "Session expirée, merci de renvoyer le formulaire.";
            } else {
                $prenom = trim($_POST['prenom'] ?? '');
                $nom    = trim($_POST['nom'] ?? '');
                $email  = trim($_POST['email'] ?? '');
                $mdp    = $_POST['mot_de_passe'] ?? '';
                $mdp2   = $_POST['mot_de_passe_confirm'] ?? '';
                $cgv    = isset($_POST['cgv']);

                $old = ['prenom' => $prenom, 'nom' => $nom, 'email' => $email];

                if ($prenom === '') $erreurs['prenom'] = "Le prénom est obligatoire.";
                if ($nom === '')    $erreurs['nom']    = "Le nom est obligatoire.";

                if ($email === '') {
                    $erreurs['email'] = "L'adresse e-mail est obligatoire.";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $erreurs['email'] = "Le format de l'adresse e-mail est invalide.";
                }

                if (!$this->motDePasseValide($mdp)) {
                    $erreurs['mot_de_passe'] =
                        "12 caractères minimum, avec au moins une majuscule, un chiffre et un caractère spécial.";
                } elseif ($mdp !== $mdp2) {
                    $erreurs['mot_de_passe_confirm'] = "Les deux mots de passe ne correspondent pas.";
                }

                if (!$cgv) {
                    $erreurs['cgv'] = "Vous devez accepter les CGV pour créer un compte.";
                }

                if (!isset($erreurs['email']) && $this->utilisateurModel->emailExiste($email)) {
                    $erreurs['email'] = "Un compte existe déjà avec cette adresse e-mail.";
                }

                if (empty($erreurs)) {
                    $this->utilisateurModel->creer($nom, $prenom, $email, $mdp);
                    $_SESSION['flash'] = "Votre compte a bien été créé. Vous pouvez vous connecter.";
                    redirect('connexion');
                }
            }
        }

        require __DIR__ . '/../views/inscription.php';
    }

    public function connexion(): void {
        $erreurs = [];
        $old     = ['email' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!csrf_verifier()) {
                $erreurs['global'] = "Session expirée, merci de renvoyer le formulaire.";
            } else {
                $email = trim($_POST['email'] ?? '');
                $mdp   = $_POST['mot_de_passe'] ?? '';
                $old   = ['email' => $email];

                if ($email === '' || $mdp === '') {
                    $erreurs['global'] = "Merci de remplir tous les champs.";
                } else {
                    $utilisateur = $this->utilisateurModel->trouverParEmail($email);

                    if (!$utilisateur || !password_verify($mdp, $utilisateur['mot_de_passe'])) {
                        $erreurs['global'] = "Adresse e-mail ou mot de passe incorrect.";
                    } elseif ((int) $utilisateur['actif'] !== 1) {
                        $erreurs['global'] = "Ce compte est désactivé.";
                    } else {
                        session_regenerate_id(true); 
                        $_SESSION['utilisateur_id'] = $utilisateur['utilisateur_id'];
                        $_SESSION['prenom']         = $utilisateur['prenom'];
                        $_SESSION['role']           = $utilisateur['role'];
                        redirect('catalogue');
                    }
                }
            }
        }

        require __DIR__ . '/../views/connexion.php';
    }

    public function deconnexion(): void {
        $_SESSION = [];
        session_destroy();
        redirect('connexion');
    }

    private function motDePasseValide(string $mdp): bool {
        return strlen($mdp) >= 12
            && preg_match('/[A-Z]/', $mdp)         
            && preg_match('/[0-9]/', $mdp)          
            && preg_match('/[^A-Za-z0-9]/', $mdp);  
    }
}