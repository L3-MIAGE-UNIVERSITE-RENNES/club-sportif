# Application Club Sportif

## Aperçu

Ce dépôt contient une application backoffice en PHP pour la gestion des membres, catégories et éducateurs d'un club sportif. L'application suit l'architecture MVC (Modèle-Vue-Contrôleur) et utilise le DAO (Data Access Object) pour les interactions avec la base de données. De plus, il existe un front office basée sur Symfony pour permettre aux éducateurs d'interagir avec le système.

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
--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `code_raccourci` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `numero_tel` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220104120000', '2024-01-04 13:40:55', 30),
('DoctrineMigrations\\Version20220104120001', '2024-01-07 02:53:50', 94);

-- --------------------------------------------------------

--
-- Table structure for table `educateur`
--

CREATE TABLE `educateur` (
  `id` int(11) NOT NULL,
  `numero_licence` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `est_administrateur` tinyint(1) DEFAULT NULL,
  `roles` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `licencie`
--

CREATE TABLE `licencie` (
  `numero_licence` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `id_contact` int(11) DEFAULT NULL,
  `id_categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mail_contact`
--

CREATE TABLE `mail_contact` (
  `id` int(11) NOT NULL,
  `date_envoi` datetime DEFAULT NULL,
  `objet` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `expediteur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mail_educateur`
--

CREATE TABLE `mail_educateur` (
  `id` int(11) NOT NULL,
  `date_envoi` datetime DEFAULT NULL,
  `objet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expediteur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_educateur_contact`
--

CREATE TABLE `mail_educateur_contact` (
  `mail_contact_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mail_educateur_educateur`
--

CREATE TABLE `mail_educateur_educateur` (
  `mail_educateur_id` int(11) NOT NULL,
  `educateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `educateur`
--
ALTER TABLE `educateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `educateur_ibfk_1` (`numero_licence`);

--
-- Indexes for table `licencie`
--
ALTER TABLE `licencie`
  ADD PRIMARY KEY (`numero_licence`),
  ADD KEY `licencie_ibfk_1` (`id_contact`),
  ADD KEY `licencie_ibfk_2` (`id_categorie`);

--
-- Indexes for table `mail_contact`
--
ALTER TABLE `mail_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ABCDEFGH` (`expediteur_id`);

--
-- Indexes for table `mail_educateur`
--
ALTER TABLE `mail_educateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EA83F3814018F9C` (`expediteur_id`);

--
-- Indexes for table `mail_educateur_contact`
--
ALTER TABLE `mail_educateur_contact`
  ADD PRIMARY KEY (`mail_contact_id`,`contact_id`),
  ADD KEY `IDX_123456789` (`mail_contact_id`),
  ADD KEY `IDX_ABCDEFGHI` (`contact_id`);

--
-- Indexes for table `mail_educateur_educateur`
--
ALTER TABLE `mail_educateur_educateur`
  ADD PRIMARY KEY (`mail_educateur_id`,`educateur_id`),
  ADD KEY `IDX_EA3E2A2E7C43913` (`mail_educateur_id`),
  ADD KEY `IDX_EA3E2A2E74B64B64` (`educateur_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `educateur`
--
ALTER TABLE `educateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `licencie`
--
ALTER TABLE `licencie`
  MODIFY `numero_licence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `mail_contact`
--
ALTER TABLE `mail_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mail_educateur`
--
ALTER TABLE `mail_educateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `educateur`
--
ALTER TABLE `educateur`
  ADD CONSTRAINT `educateur_ibfk_1` FOREIGN KEY (`numero_licence`) REFERENCES `licencie` (`numero_licence`) ON DELETE CASCADE;

--
-- Constraints for table `licencie`
--
ALTER TABLE `licencie`
  ADD CONSTRAINT `licencie_ibfk_1` FOREIGN KEY (`id_contact`) REFERENCES `contact` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `licencie_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `mail_contact`
--
ALTER TABLE `mail_contact`
  ADD CONSTRAINT `FK_ABCDEFGH` FOREIGN KEY (`expediteur_id`) REFERENCES `educateur` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mail_educateur`
--
ALTER TABLE `mail_educateur`
  ADD CONSTRAINT `FK_EA83F3814018F9C` FOREIGN KEY (`expediteur_id`) REFERENCES `educateur` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mail_educateur_contact`
--
ALTER TABLE `mail_educateur_contact`
  ADD CONSTRAINT `FK_123456789` FOREIGN KEY (`mail_contact_id`) REFERENCES `mail_contact` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ABCDEFGHI` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mail_educateur_educateur`
--
ALTER TABLE `mail_educateur_educateur`
  ADD CONSTRAINT `FK_EA3E2A2E74B64B64` FOREIGN KEY (`educateur_id`) REFERENCES `educateur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EA3E2A2E7C43913` FOREIGN KEY (`mail_educateur_id`) REFERENCES `mail_educateur` (`id`) ON DELETE CASCADE;
COMMIT;

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


## Vidéo de Démonstration

Veuillez fournir une vidéo de démonstration des fonctionnalités implémentées. Assurez-vous que la vidéo montre clairement chaque fonctionnalité et son utilisation.

## Contact

Pour tout problème ou question, contactez : 
 - TRO KOPE EMMANUEL à kope-emmanuel-j.tro@etudiant.univ-rennes1.fr
 - OLIVE IRAKOZE à olive-audrey.irakoze@etudiant.univ-rennes1.fr

