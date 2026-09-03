<?php

require_once __DIR__ . '/../config/db.php'; 

class Produit {
    private ?PDO $conn = null;
    private string $table_name = "produits";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllProduits(): array {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log('Erreur getAllProduits : ' . $e->getMessage());
            return [];
        }
    }

public function trouverParId(int $id): ?array {
    try {
        $query = "SELECT produit_id, nom_produit, description, prix, stock, type, rarete, image_url
                  FROM " . $this->table_name . "
                  WHERE produit_id = :id
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);

        $produit = $stmt->fetch(PDO::FETCH_ASSOC);
        return $produit ?: null;

    } catch (PDOException $e) {
        error_log('Erreur trouverParId : ' . $e->getMessage());
        return null;
    }
}
}
?>