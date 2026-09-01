<?php

require_once __DIR__ . '/../config/db.php';

class Utilisateur {
    private ?PDO $conn = null;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function emailExiste(string $email): bool {
        $sql  = "SELECT 1 FROM utilisateurs WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        return (bool) $stmt->fetchColumn();
    }

    public function creer(string $nom, string $prenom, string $email, string $motDePasseClair): int {
        $hash = password_hash($motDePasseClair, PASSWORD_DEFAULT); // bcrypt

        $sql  = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe)
                 VALUES (:nom, :prenom, :email, :mdp)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':nom'    => $nom,
            ':prenom' => $prenom,
            ':email'  => $email,
            ':mdp'    => $hash,
        ]);

        return (int) $this->conn->lastInsertId();
    }

    public function trouverParEmail(string $email): ?array {
        $sql  = "SELECT utilisateur_id, nom, prenom, email, mot_de_passe, role, actif
                 FROM utilisateurs
                 WHERE email = :email
                 LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        return $utilisateur ?: null;
    }
}