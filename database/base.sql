CREATE DATABASE IF NOT EXISTS tcg_shop;
USE tcg_shop;

-- 1. Table des utilisateurs (Clients et Administrateurs)

CREATE TABLE utilisateurs (
    utilisateur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    `role` ENUM('client', 'admin') DEFAULT 'client',
    actif TINYINT(1) NOT NULL DEFAULT 1,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 2. Table des produits (Cartes, Boosters, Displays)

CREATE TABLE produits (
    produit_id INT AUTO_INCREMENT PRIMARY KEY,
    nom_produit VARCHAR(100) NOT NULL,
    `description` TEXT NOT NULL,
    prix DECIMAL(6,2) DEFAULT NULL CHECK (prix IS NULL OR prix > 0),
    stock INT DEFAULT NULL CHECK (stock IS NULL OR stock >= 0),
    `type` ENUM('carte', 'booster', 'display') NOT NULL,
    rarete ENUM('Commune', 'Rare', 'Légendaire') DEFAULT NULL,
    image_url VARCHAR(255) NOT NULL,
    INDEX idx_type (`type`),
    INDEX idx_rarete (rarete),
    INDEX idx_nom_produit (nom_produit)
);

-- 3. Table des commandes

CREATE TABLE commandes (
    commande_id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    date_commande DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en cours', 'expediee', 'livree') DEFAULT 'en cours',
    montant_total DECIMAL(8,2) NOT NULL CHECK (montant_total >= 0),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(utilisateur_id) ON DELETE RESTRICT
);

-- 4. Table de liaison commande_produits

CREATE TABLE commande_produits (
    commande_id INT NOT NULL,
    produit_id INT NOT NULL,
    quantite INT NOT NULL CHECK (quantite > 0),
    prix_unitaire DECIMAL(6,2) NOT NULL CHECK (prix_unitaire > 0),
    PRIMARY KEY (commande_id, produit_id),
    FOREIGN KEY (commande_id) REFERENCES commandes(commande_id) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES produits(produit_id) ON DELETE RESTRICT
);

-- Insertion des produits de test

INSERT INTO produits (nom_produit, `description`, prix, stock, `type`, rarete, image_url) VALUES 
('Le chat maléfique', 'Carte ultra rare holographique.', NULL, NULL, 'carte', 'Légendaire', 'assets/img/le_chat_malefique.jpg'),
('Le chien endormi', 'Carte commune.', NULL, NULL, 'carte', 'Commune', 'assets/img/le_chien_endormi.jpg'),
('Le lapin magique', 'Carte rare aux pouvoirs psychiques redoutables.', NULL, NULL, 'carte', 'Rare', 'assets/img/le_lapin_magique.jpg'),
('Le canard obscur', 'Carte rare avec une défense impénétrable.', NULL, NULL, 'carte', 'Rare', 'assets/img/le_canard_obscure.jpg'),
('Teckel inquiet', 'Carte commune.', NULL, NULL, 'carte', 'Commune', 'assets/img/teckel_inquiet.jpg'),
('Le cheval de troie', 'Carte ultra rare holographique.', NULL, NULL, 'carte', 'Légendaire', 'assets/img/cheval_de_troie.jpg'),
('Booster Série 1', 'Sachet contenant 10 cartes aléatoires de la première extension.', 4.99, 100, 'booster', NULL, 'assets/img/booster_animal.png'),
('Display Collector - Boîte de 10 Boosters', 'Boîte scellée contenant 10 boosters de la première extension.', 44.99, 20, 'display', NULL, 'assets/img/display_animal.png');

-- Insertion d'utilisateurs de test (mot de passe haché factice pour l'exemple)

INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, `role`) VALUES 
('Doe', 'John', 'john.doe@test.com', '$2y$10$ExempleDeHashSecurisePourClientTest...', 'client'),
('Admin', 'Super', 'admin@tcgshop.com', '$2y$10$ExempleDeHashSecurisePourAdminTest...', 'admin');