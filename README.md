# simple_vunerable_app

# Projet PHP - Gestion des Clients avec Login

Ce projet est une application PHP simple pour gérer des clients avec un système de login. Il permet de se connecter et de gérer les clients via un système CRUD.

### Fonctionnalités

- **Connexion utilisateur** : Permet aux utilisateurs de se connecter via un formulaire.
- **Gestion des clients** : Ajouter, modifier et supprimer des clients dans la base de données.
- **Table des utilisateurs** : Stocke les informations des utilisateurs (nom d'utilisateur et mot de passe).

---

## Prérequis

Avant de commencer, assurez-vous que vous avez les éléments suivants installés sur votre machine :
- **PHP** 
- **MySQL**
- **Serveur web local** (comme apache)

---

## Installation et démarrage

### Étapes

1. **Cloner ou télécharger ce projet** sur votre machine.
   
   Par exemple :
   ```bash
   git clone https://github.com/fredericBui/simple_vunerable_app.git
   cd simple_vunerable_app

2. Modifier le mot de passe de l'utilisateur root de mysql
```
sudo mysql
Alter user 'root'@'localhost' identified WITH mysql_native_password by 'root';
flush privileges;
exit;
```

3. Modifier le fichier .env avec vos credentials 

4. Exécuter les scripts de migration :
```
php migration.php
php migration_user.php
```

5. Créer un utilisateur administrateur dans votre base de donnée mysql :
```
INSERT INTO users (username, password) VALUES ('votre_nom_utilisateur', 'votre_mot_de_passe');
```

6. Déployer le site internet sur votre server web avec FTP dans le dossier /var/www/html/ si vous utiliser apache2

Note : Changer temporairement les droits du dossier html ou modifier les privilèges de votre utilisateur