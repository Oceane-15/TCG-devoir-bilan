<?php

if (session_status() === PHP_SESSION_NONE) {
    $secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';

    session_set_cookie_params([
        'httponly' => true,
        'secure'   => $secure,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function e(?string $valeur): string {
    return htmlspecialchars($valeur ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect(string $route): void {
    header('Location: index.php?route=' . $route);
    exit;
}

function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}

function csrf_verifier(): bool {
    return isset($_POST['csrf_token'], $_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
}

function est_connecte(): bool {
    return isset($_SESSION['utilisateur_id']);
}

function est_admin(): bool {
    return est_connecte() && (($_SESSION['role'] ?? '') === 'admin');
}


function panier_resume(): array {
    $panier = $_SESSION['panier'] ?? [];
    $lignes = [];
    $total  = 0.0;
    $nb     = 0;

    if (!empty($panier)) {
        require_once __DIR__ . '/../models/Produit.php';
        $model = new Produit();

        foreach ($panier as $produitId => $quantite) {
            $produit = $model->trouverParId((int) $produitId);
            if ($produit === null) {
                continue;
            }
            $sousTotal = (float) $produit['prix'] * $quantite;
            $total    += $sousTotal;
            $nb       += $quantite;

            $lignes[] = [
                'produit'    => $produit,
                'quantite'   => $quantite,
                'sous_total' => $sousTotal,
            ];
        }
    }

    return ['lignes' => $lignes, 'total' => $total, 'nb' => $nb];
}