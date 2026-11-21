# Portail Web de Gestion des Stagiaires et des Attestations (ISTA Lazaret)

Application web complète conçue et développée pour automatiser et faciliter la gestion administrative des stagiaires, des utilisateurs et des demandes d'attestations au sein de l'ISTA Lazaret d'Oujda.

## Fonctionnalités Principales

* **Authentification et Gestion des Rôles :** Système de connexion sécurisé avec gestion des sessions et contrôle d'accès selon le profil (`Agent` / Administrateur ou `Étudiant`).
* **Tableau de Bord Dynamique :** Affichage en temps réel des statistiques globales (nombre de stagiaires, utilisateurs, et suivi des attestations).
* **Gestion CRUD Complète :** Ajout, consultation, modification et suppression des dossiers stagiaires, des comptes utilisateurs et des attestations.
* **Sécurité et Architecture :** Refactorisation en **PHP Orienté Objet (POO)** avec utilisation du pattern **Singleton** et de **PDO** (requêtes préparées) pour prévenir les injections SQL, ainsi que le hachage des mots de passe (`password_hash`).

## Technologies Utilisées

* **Back-end :** PHP 8 (POO, PDO)
* **Base de données :** MySQL
* **Front-end :** HTML5, CSS3, Bootstrap 5, JavaScript
* **Serveur local :** XAMPP (Apache & MySQL)

## Installation en Local

1. Cloner ce dépôt dans le répertoire `htdocs` de votre serveur local (XAMPP) :
   ```bash
   git clone [https://github.com/farhathajar2000-bot/gestion-stagiaires-attestations.git](https://github.com/farhathajar2000-bot/gestion-stagiaires-attestations.git)
