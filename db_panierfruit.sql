-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 03 fév. 2020 à 22:35
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
-- Base de données :  `db_panierfruit`
--

-- --------------------------------------------------------

--
-- Structure de la table `fruit`
--

CREATE TABLE `fruit` (
  `Nom` varchar(30) NOT NULL,
  `Poids` int(11) NOT NULL,
  `Prix` int(11) NOT NULL,
  `identifiant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fruit`
--

INSERT INTO `fruit` (`Nom`, `Poids`, `Prix`, `identifiant`) VALUES
('cerise1', 30, 10, 1),
('cerise2', 120, 10, 3),
('pomme1', 150, 20, 1),
('pomme2', 140, 20, 1),
('pomme3', 130, 20, 2),
('pomme4', 140, 20, 3);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `identifiant` int(11) NOT NULL,
  `NomClient` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`identifiant`, `NomClient`) VALUES
(1, 'Matthieu'),
(2, 'Marc'),
(3, 'Toto');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `fruit`
--
ALTER TABLE `fruit`
  ADD PRIMARY KEY (`Nom`),
  ADD KEY `FK_fruit_panier` (`identifiant`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`identifiant`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fruit`
--
ALTER TABLE `fruit`
  ADD CONSTRAINT `FK_fruit_panier` FOREIGN KEY (`identifiant`) REFERENCES `panier` (`identifiant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
