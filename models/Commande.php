<?php

require_once __DIR__ . '/../config/db.php';

class Commande {
    private ?PDO $conn = null;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * @param int   $utilisateurId
     * @param array $lignes  ['produit_id'=>int, 'quantite'=>int, 'prix_unitaire'=>float]
     * @param float $total
     * @return int  l'identifiant de la commande créée
     */
    public function creer(int $utilisateurId, array $lignes, float $total): int {
        try {
            $this->conn->beginTransaction();

            $stmtEntete = $this->conn->prepare(
                "INSERT INTO commandes (utilisateur_id, montant_total) VALUES (:uid, :total)"
            );
            $stmtEntete->execute([':uid' => $utilisateurId, ':total' => $total]);
            $commandeId = (int) $this->conn->lastInsertId();

            $stmtLireStock = $this->conn->prepare(
                "SELECT stock FROM produits WHERE produit_id = :pid FOR UPDATE"
            );
            $stmtLigne = $this->conn->prepare(
                "INSERT INTO commande_produits (commande_id, produit_id, quantite, prix_unitaire)
                 VALUES (:cid, :pid, :qte, :pu)"
            );
            $stmtDecrement = $this->conn->prepare(
                "UPDATE produits SET stock = stock - :qte WHERE produit_id = :pid"
            );

            foreach ($lignes as $ligne) {

                $stmtLigne->execute([
                    ':cid' => $commandeId,
                    ':pid' => $ligne['produit_id'],
                    ':qte' => $ligne['quantite'],
                    ':pu'  => $ligne['prix_unitaire'],
                ]);

                $stmtLireStock->execute([':pid' => $ligne['produit_id']]);
                $stockActuel = $stmtLireStock->fetchColumn();

                if ($stockActuel !== null && $stockActuel !== false) {
                    if ((int) $stockActuel < $ligne['quantite']) {
                        throw new RuntimeException("Stock insuffisant pour le produit {$ligne['produit_id']}");
                    }
                    $stmtDecrement->execute([
                        ':qte' => $ligne['quantite'],
                        ':pid' => $ligne['produit_id'],
                    ]);
                }
            }

            $this->conn->commit();
            return $commandeId;

        } catch (Throwable $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            error_log('Erreur creation commande : ' . $e->getMessage());
            throw $e;
        }
    }
}