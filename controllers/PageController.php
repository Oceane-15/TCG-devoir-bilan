<?php

class PageController
{
    public function accueil(): void
    {
        require __DIR__ . '/../views/accueil.php';
    }

    public function mentions(): void
    {
        require __DIR__ . '/../views/mentions.php';
    }

    public function cgv(): void
    {
        require __DIR__ . '/../views/cgv.php';
    }

      public function faq(): void
    {
        $erreurs = [];
        $old     = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrf_verifier()) {
                $erreurs['global'] = "Session expirée, merci de renvoyer le formulaire.";
            } else {
                $nom       = trim($_POST['nom'] ?? '');
                $email     = trim($_POST['email'] ?? '');
                $telephone = trim($_POST['telephone'] ?? '');
                $message   = trim($_POST['message'] ?? '');

                $old = ['nom' => $nom, 'email' => $email, 'telephone' => $telephone, 'message' => $message];

                if ($nom === '') {
                    $erreurs['nom'] = "Votre prénom / nom est obligatoire.";
                }
                if ($email === '') {
                    $erreurs['email'] = "Votre e-mail est obligatoire.";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $erreurs['email'] = "L'adresse e-mail est invalide.";
                }
                if ($message === '') {
                    $erreurs['message'] = "Un message est obligatoire.";
                }

                if (empty($erreurs)) {
                    
                    $_SESSION['flash'] = "Votre message a bien été envoyé.";
                    redirect('faq');
                }
            }
        }

        require __DIR__ . '/../views/faq.php';
    }
}