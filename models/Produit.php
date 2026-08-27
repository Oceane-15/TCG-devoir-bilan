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
            
        } catch (PDOException $exception) {
            echo "Erreur de requête : " . $exception->getMessage();
            return [];
        }
    }
}
?>