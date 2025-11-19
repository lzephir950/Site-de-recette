# Site-de-recette

Ce projet est un petit site web développé en PHP permettant aux utilisateurs de créer leurs propres recettes et d'échanger entre eux grâce aux commentaires. Le site propose un simple système de connexion, d'inscription, d'ajout de recettes et de commentaires entre internautes.

## Fonctionnalités

- Inscription d'un nouvel utilisateur
- Connecion / déconnexion
- Création d'une recette
- Lecture des recettes
- Modification d'une recette
- Supression d'une recette
- Ajout d'un commentaire
- Affichage des commentaires des autres utilisateurs, dans un tableau

## Technologies utilisées
- PHP (procédural)
- MYSQL (base de données)
- HTML / CSS
- Serveur local : WAMP

## Installation du projet
1. Télécharger ou cloner le projet
2. Placer les fichiers dans le dossier www/ (WAMP) ou htdocs (XAMPP)
3. Importer le fichier SQL dans phpMyAdmin pour créer la base de données
4. Modifier les identifiants de connexion à la base dans le fichier de configuration (ex: config.php)
5. Lancer le projet depuis l'URL

## Structure du projet
/config.php → Connexion à la base de données
/index.php → Connexion utilisateur
/register.php → Inscription utilisateur
/home.php → Page d'accueil, affichage des recettes
/create_recipe.php → Ajouter une recette
/update_recipe.php → Afficher une recette à modifier
/post_update_recipe.php → Modifier une recette
/delete_recipe.php → Supprimer une recette
/read_recipe.php → Afficher les détails d'une recette + les commentaires des utilisateurs
/create_comment → Ajouter un commentaire

## Auteur
Projet réalisé par **Ludmilla**, dans le cadre d'un apprentissage personnel en PHP.