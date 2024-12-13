# Gestionnaire de Packages

Ce projet est une application CRUD (Create, Read, Update, Delete) permettant de gérer des packages, leurs auteurs et versions. L'application est construite avec PHP et MySQL et utilise l'environnement de développement local Laragon.

## Fonctionnalités

-  Ajouter, afficher, modifier et supprimer des packages.
-  Gérer les informations des auteurs (nom, email, bio).
-  Associer des versions aux packages.
-  Interface simple et conviviale.

## Prérequis

-  [Laragon](https://laragon.org/) installé sur votre machine.
-  PHP >= 7.4.
-  MySQL.
-  Navigateur web moderne.
-  Git.

## Installation

1. **Cloner le dépôt :**

   ```
   git clone https://github.com/Youcode-Classe-E-2024-2025/Akraou_ayoub_package.git
   Déplacer dans le répertoire du projet :
   cd Akraou_ayoub_package
   ```

   Déplacer les fichiers dans le dossier www de Laragon : Copiez le répertoire du projet dans le dossier www de votre installation Laragon.

2. **Configurer la base de données :**

-  Démarrez Laragon.
-  Ouvrez phpMyAdmin ou tout autre outil de gestion de bases de données.
-  Créez une base de données nommée package_manager.
-  Importez le fichier SQL fourni dans le projet (s'il existe) ou utilisez le script suivant pour - - créer les tables :

```
CREATE DATABASE IF NOT EXISTS package_manager CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE package_manager;

CREATE TABLE authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    bio TEXT
);

CREATE TABLE packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    author_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES authors(id) ON DELETE CASCADE
);

CREATE TABLE versions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    version_number VARCHAR(50) NOT NULL,
    package_id INT NOT NULL,
    FOREIGN KEY (package_id) REFERENCES packages(id) ON DELETE CASCADE
);
```

-  Lancer le serveur :

-  Dans Laragon, cliquez sur le bouton “Start All”.
-  Ouvrez votre navigateur et accédez à http://localhost/Akraou_ayoub_package.
-  Utilisation Page principale : Affiche la liste des packages avec leurs auteurs associées.
-  Ajouter un package : Utilisez le formulaire pour ajouter un package avec les détails de l'auteur.
-  Modifier ou supprimer : Chaque package dispose d'options pour être modifié ou supprimé.

## Structure du Projet

    - index.php : Point d'entrée principal de l'application.
    - components/ : Contient les composants réutilisables comme les formulaires et les tableaux. -  css/ : Contient les fichiers de style.
    -  main.js : Contient le code JavaScript pour les interactions client.

## Contribution

      Les contributions sont les bienvenues. Veuillez suivre les étapes ci-dessous pour contribuer :

-  Forkez le dépôt. Créez une branche pour votre fonctionnalité : ` bash Copy code git checkout -b ma-nouvelle-fonctionnalite`
-  Faites vos modifications et commitez : ` bash Copy code git commit -m "Ajout d'une nouvelle fonctionnalité"`
-  Poussez vos changements : ` bash Copy code git push origin nom_du_branch`
-  Créez une pull request sur GitHub.

## Auteur:

    Ayoub Akraou Apprenant à Youcode.

## Licence:

     Ce projet est sous licence MIT. Vous êtes libre de l'utiliser et de le modifier selon vos besoins.
