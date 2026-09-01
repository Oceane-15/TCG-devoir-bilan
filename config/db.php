<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'tcg_shop';
    private $username = 'root';
    private $password = '';
    private ?PDO $conn = null;

    public function getConnection(): ?PDO {
        if ($this->conn !== null) {
            return $this->conn;
        }

        try {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

         $this->conn = new PDO($dsn, $this->username, $this->password, $options);

         } catch (PDOException $e) {
            error_log('Erreur de connexion BDD : ' . $e->getMessage());

            throw new RuntimeException('Le service est momentanément indisponible.');
        }
        
        return $this->conn;
    }
}
?>