# Animal TCG

Application web de e-commerce dédiée à la vente de cartes à collectionner
(boosters et displays), développée dans le cadre du Titre Professionnel
Développeur Web et Web Mobile.

## Fonctionnalités
- Catalogue de produits (boosters, displays)
- Animaldex : encyclopédie des cartes avec recherche et filtres par rareté (JavaScript)
- Authentification sécurisée (inscription, connexion, sessions)
- Panier dynamique en AJAX et validation de commande
- Espace d'administration : gestion du catalogue (CRUD)

## Technologies
- **Back-end :** PHP 8.2 (architecture MVC), MySQL
- **Front-end :** HTML, CSS (Sass), JavaScript, Bootstrap 5
- **Environnement :** XAMPP (Apache + PHP + MySQL)
- **Versioning :** Git / GitHub

## Installation
1. Placer le projet dans le dossier `htdocs` de XAMPP (ex. `C:\xampp\htdocs\TCG`).
2. Démarrer **Apache** et **MySQL** depuis le panneau de contrôle XAMPP.
3. Dans phpMyAdmin (`localhost/phpmyadmin`), importer le fichier `database/base.sql`
   (crée la base `tcg_shop`, ses tables et les données de test).
4. Vérifier les identifiants de connexion dans `config/db.php`
   (par défaut : `root` / mot de passe vide).
5. Accéder au site à l'adresse `localhost/TCG`.

## Modifier les styles (facultatif)
Le CSS compilé (`assets/css/style.css`) est inclus : le site fonctionne sans compilation.
Les sources Sass se trouvent dans `assets/scss` et se recompilent avec
l'extension *Live Sass Compiler* (VS Code).

## Compte administrateur et utilisateur
Admin : email : docasaloceane@gmail.com , mdp : Essaiencore1fois007*
Utilisateur : email :  jean.dupond@gmail.com , mdp : Montmotdepasse123*
