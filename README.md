# Template - Application Club Sportif

## Aperçu

Ce dépôt contient une application backend en PHP pour la gestion des membres, catégories et éducateurs d'un club sportif. L'application suit l'architecture MVC (Modèle-Vue-Contrôleur) et utilise le DAO (Data Access Object) pour les interactions avec la base de données. De plus, il existe une interface frontale basée sur Symfony pour permettre aux éducateurs d'interagir avec le système.

## Table des matières

1. [Partie 1: PHP DAO/MVC](#partie-1-php-daomvc)
    - [Base de données](#Base-de-données)
    - [Classes](#classes)
    - [Fonctionnalités](#fonctionnalités)
    - [Bonus](#bonus)
2. [Partie 2: Symfony](#partie-2-symfony)
    - [Classes Supplémentaires](#classes-supplémentaires)
    - [Fonctionnalités](#fonctionnalités-1)

## Partie 1: PHP DAO/MVC
### Base de données

``` sql
CREATE TABLE contact (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nom VARCHAR(255) NOT NULL,
 prenom VARCHAR(255) NOT NULL,
 email VARCHAR(255) NOT NULL,
 numero_tel VARCHAR(20) NOT NULL
);

CREATE TABLE categorie (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nom VARCHAR(255) NOT NULL,
 code_raccourci VARCHAR(10) NOT NULL
);

CREATE TABLE licencie (
 numero_licence INT AUTO_INCREMENT PRIMARY KEY,
 nom VARCHAR(255) NOT NULL,
 prenom VARCHAR(255) NOT NULL,
 id_contact INT,
 id_categorie INT,
 FOREIGN KEY (id_contact) REFERENCES contact(id) ON DELETE SET NULL,
 FOREIGN KEY (id_categorie) REFERENCES categorie(id) ON DELETE SET NULL
);

CREATE TABLE educateur (
 id INT AUTO_INCREMENT PRIMARY KEY,
 numero_licence INT NOT NULL,
 email VARCHAR(255) NOT NULL,
 mot_de_passe VARCHAR(255) NOT NULL,
 est_administrateur BOOLEAN NOT NULL,
 FOREIGN KEY (numero_licence) REFERENCES licencie(numero_licence) ON DELETE SET NULL
);

-- AJOUTER POUR LA PARTIE 2

CREATE TABLE mail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_envoi DATETIME NOT NULL,
    objet VARCHAR(255) NOT NULL,
    message TEXT NOT NULL
);

CREATE TABLE mail_educateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_mail INT,
    id_educateur INT,
    FOREIGN KEY (id_mail) REFERENCES mail(id) ON DELETE CASCADE,
    FOREIGN KEY (id_educateur) REFERENCES educateur(id) ON DELETE CASCADE
);

CREATE TABLE mail_contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_mail INT,
    id_contact INT,
    FOREIGN KEY (id_mail) REFERENCES mail(id) ON DELETE CASCADE,
    FOREIGN KEY (id_contact) REFERENCES contact(id) ON DELETE CASCADE
);

```

### Classes

1. **Categorie**
    - Propriétés : `nom`, `codeRaccourci`
    - Méthodes : `create`, `update`, `delete`, `listCategories`

2. **Licencie**
    - Propriétés : `numeroLicence`, `nom`, `prenom`, `contact`, `categorie`
    - Méthodes : `create`, `update`, `delete`, `listLicencies`

3. **Contact**
    - Propriétés : `nom`, `prenom`, `email`, `numeroTel`
    - Méthodes : `create`, `update`, `delete`

4. **Educateur**
    - Hérite de **Licencie**
    - Propriétés Supplémentaires : `email`, `motDePasse`, `isAdmin`
    - Méthodes : `listEducateurs`

### Fonctionnalités

1. **Categorie**
    - Créer/Mettre à jour/Supprimer/Lister les catégories

2. **Licencie**
    - Créer/Mettre à jour/Supprimer/Lister les licenciés

3. **Educateur**
    - Créer/Mettre à jour/Supprimer/Lister les éducateurs (administrateurs uniquement)

4. **Contact**
    - Créer/Mettre à jour/Supprimer le contact d'un licencié

5. **Authentification**
    - Accessible via l'email et le mot de passe pour les éducateurs (administrateurs uniquement)

6. **Bonus**
    - Importation/Exportation des licenciés

### Utilisation

1. Clonez le dépôt.
2. Créez une base de données et mettez à jour le fichier `config.php` avec les identifiants de la base de données.
3. Implémentez chaque fonctionnalité, poussez sur la branche désignée.
4. Poussez régulièrement les mises à jour.

## Partie 2: Symfony

### Classes Supplémentaires

1. **MailEdu**
    - Propriétés : `dateEnvoi`, `objet`, `message`, `educateurs`
    - Méthodes : `listSentMails`, `deleteSentMail`

2. **MailContact**
    - Propriétés : `dateEnvoi`, `objet`, `message`, `licenciés`
    - Méthodes : `listSentMails`, `deleteSentMail`

### Fonctionnalités

1. **Connexion**
    - Les éducateurs peuvent se connecter.

2. **Liste des Licenciés**
    - Les éducateurs peuvent voir la liste des licenciés pour une catégorie.

3. **Liste des Contacts**
    - Les éducateurs peuvent voir la liste des contacts pour une catégorie.

4. **Liste des Mails Envoyés aux Éducateurs**
    - Les éducateurs peuvent voir et supprimer les mails envoyés à d'autres éducateurs.

5. **Liste des Mails Envoyés aux Contacts**
    - Les éducateurs peuvent voir et supprimer les mails envoyés aux contacts des licenciés.

6. **Envoyer un Mail aux Éducateurs**
    - Les éducateurs peuvent composer et envoyer des mails à d'autres éducateurs.

7. **Envoyer un Mail aux Contacts**
    - Les éducateurs peuvent composer et envoyer des mails aux contacts des licenciés.

### Utilisation

1. Clonez le dépôt.
2. Implémentez chaque fonctionnalité dans l'interface Symfony, poussez sur la branche désignée.
3. Poussez régulièrement les mises à jour.

## Vidéo de Démonstration

Veuillez fournir une vidéo de démonstration des fonctionnalités implémentées. Assurez-vous que la vidéo montre clairement chaque fonctionnalité et son utilisation.

## Contact

Pour tout problème ou question, contactez [Votre Nom] à [votre.email@example.com].
