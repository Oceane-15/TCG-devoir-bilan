<?php

require_once __DIR__ . '/../config/db.php';

class Produit
{
    private ?PDO $conn = null;
    private string $table_name = "produits";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllProduits(): array
    {
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

    public function getCartes(): array
    {
        try {
            $query = "SELECT * FROM " . $this->table_name . "
                      WHERE type = 'carte'
                      ORDER BY nom_produit";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erreur getCartes : ' . $e->getMessage());
            return [];
        }
    }

    public function trouverParId(int $id): ?array
    {
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

      public function ajouterProduit(array $d): bool
    {
        try {
            $query = "INSERT INTO " . $this->table_name . "
                      (nom_produit, description, prix, stock, type, rarete, image_url)
                      VALUES (:nom, :description, :prix, :stock, :type, :rarete, :image_url)";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([
                ':nom'         => $d['nom_produit'],
                ':description' => $d['description'],
                ':prix'        => $d['prix'],
                ':stock'       => $d['stock'],
                ':type'        => $d['type'],
                ':rarete'      => $d['rarete'],
                ':image_url'   => $d['image_url'],
            ]);
        } catch (PDOException $e) {
            error_log('Erreur ajouterProduit : ' . $e->getMessage());
            return false;
        }
    }

    public function modifierProduit(int $id, array $d): bool
    {
        try {
            $query = "UPDATE " . $this->table_name . " SET
                        nom_produit = :nom,
                        description = :description,
                        prix        = :prix,
                        stock       = :stock,
                        type        = :type,
                        rarete      = :rarete,
                        image_url   = :image_url
                      WHERE produit_id = :id";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([
                ':nom'         => $d['nom_produit'],
                ':description' => $d['description'],
                ':prix'        => $d['prix'],
                ':stock'       => $d['stock'],
                ':type'        => $d['type'],
                ':rarete'      => $d['rarete'],
                ':image_url'   => $d['image_url'],
                ':id'          => $id,
            ]);
        } catch (PDOException $e) {
            error_log('Erreur modifierProduit : ' . $e->getMessage());
            return false;
        }
    }

    public function supprimerProduit(int $id): bool{
    
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE produit_id = :id";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log('Erreur supprimerProduit : ' . $e->getMessage());
            return false;
        }
    }
}
