-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 07 juin 2020 à 19:04
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mybuilding`
--

-- --------------------------------------------------------

--
-- Structure de la table `buildings`
--

DROP TABLE IF EXISTS `buildings`;
CREATE TABLE IF NOT EXISTS `buildings` (
  `pk_building` int(11) NOT NULL AUTO_INCREMENT,
  `building_name` varchar(250) NOT NULL,
  `adress` varchar(250) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`pk_building`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `buildings`
--

INSERT INTO `buildings` (`pk_building`, `building_name`, `adress`, `deleted`) VALUES
(1, 'test', 'test , 19', 0),
(2, 'Batiment Sundic', 'Rue syndic , 12', 0),
(3, 'maxbuilding', 'rue levis , 10', 0),
(4, 'Vicbuilding', 'Rue Ayotte , 1', 0),
(8, 'Ifosup', 'rue de l\'ecole , 45', 0);

-- --------------------------------------------------------

--
-- Structure de la table `communication`
--

DROP TABLE IF EXISTS `communication`;
CREATE TABLE IF NOT EXISTS `communication` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `communication` text NOT NULL,
  `Date` date DEFAULT NULL,
  `fk_building` int(11) NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `Communication_Building` (`fk_building`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `communication`
--

INSERT INTO `communication` (`pk`, `communication`, `Date`, `fk_building`) VALUES
(1, 'Ascensceur kapouttttt', '2020-06-07', 3),
(2, 'exctincteur a changer', '2020-06-04', 2),
(3, 'fuite d\'eau', '2020-06-04', 4),
(6, 'Attention sa brule', '2020-06-07', 8);

--
-- Déclencheurs `communication`
--
DROP TRIGGER IF EXISTS `InsertDate`;
DELIMITER $$
CREATE TRIGGER `InsertDate` BEFORE INSERT ON `communication` FOR EACH ROW SET NEW.Date = NOW()
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `UpdateDate`;
DELIMITER $$
CREATE TRIGGER `UpdateDate` BEFORE UPDATE ON `communication` FOR EACH ROW Set NEW.DATE = now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `roles_pk` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(250) NOT NULL,
  PRIMARY KEY (`roles_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`roles_pk`, `role_name`) VALUES
(1, 'Syndic'),
(2, 'Resident');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `fk_user` int(11) NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `Ticket_User` (`fk_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `box` int(11) DEFAULT NULL,
  `fk_building` int(11) NOT NULL DEFAULT 1,
  `mail` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `session_token` varchar(255) DEFAULT NULL,
  `session_time` timestamp NULL DEFAULT current_timestamp(),
  `fk_roles` int(11) NOT NULL DEFAULT 2,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_accepted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `mail` (`mail`),
  KEY `fk_roles_2` (`fk_roles`),
  KEY `Resident_Building` (`fk_building`),
  KEY `fk_roles_3` (`fk_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`pk`, `username`, `lastname`, `firstname`, `box`, `fk_building`, `mail`, `password`, `created_at`, `updated_at`, `session_token`, `session_time`, `fk_roles`, `is_deleted`, `is_accepted`) VALUES
(29, 'Admin', 'Admin', 'admin', 1, 2, 'Admin@Admin.be', '$2y$10$fanJKbKtxHQRFe2ylQUw5utJYISPpecJl31gMCAC0DImktMEx09pa', '2020-06-07 12:35:14', '2020-06-07 13:10:55', 'e7edf662f5ce2f22.1591528255', '2020-06-07 09:10:55', 1, 0, 0),
(38, 'resident', 'resident', 'resident', 1, 8, 'resident@ifosup.be', '$2y$10$1TBiuUoGu1XGfNvGF78db.T.g/la7wIl06nch7.Dw/h2HF6Mm4x7G', '2020-06-07 20:54:23', '2020-06-07 20:54:23', '', '2020-06-07 18:54:23', 2, 0, 0),
(39, 'max', 'Dago', 'Maxime', 69, 1, 'Max@menace.be', '$2y$10$K3USRqguONq9LS6v0sU8p.efEaAHKHx61A5kl81QQO1rD12WmzHym', '2020-06-07 20:56:19', '2020-06-07 20:56:19', '', '2020-06-07 18:56:19', 2, 0, 0),
(40, 'lolo', 'Groslos', 'Laurent', 69, 3, 'Laurent@grogro.be', '$2y$10$Xd8U6z/xmYCnvrFXU9KeF.OKT2beoKJo4/C2Pc4Of.KYTHgKny.Z6', '2020-06-07 20:58:17', '2020-06-07 20:58:17', '', '2020-06-07 18:58:17', 2, 0, 0);

--
-- Déclencheurs `users`
--
DROP TRIGGER IF EXISTS `updated_at`;
DELIMITER $$
CREATE TRIGGER `updated_at` BEFORE UPDATE ON `users` FOR EACH ROW Set new.updated_at = now()
$$
DELIMITER ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `communication`
--
ALTER TABLE `communication`
  ADD CONSTRAINT `Communication_Building` FOREIGN KEY (`fk_building`) REFERENCES `buildings` (`pk_building`);

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `Ticket_User` FOREIGN KEY (`fk_user`) REFERENCES `users` (`pk`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Resident_Building` FOREIGN KEY (`fk_building`) REFERENCES `buildings` (`pk_building`),
  ADD CONSTRAINT `Resident_Syndic` FOREIGN KEY (`fk_roles`) REFERENCES `roles` (`roles_pk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
