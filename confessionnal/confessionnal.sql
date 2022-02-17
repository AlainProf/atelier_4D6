-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 13 fév. 2022 à 13:49
-- Version du serveur :  5.7.21
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `confessionnal`
--

-- --------------------------------------------------------

--
-- Structure de la table `croyants`
--

DROP TABLE IF EXISTS `croyants`;
CREATE TABLE IF NOT EXISTS `croyants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `motPasse` varchar(10) NOT NULL,
  `creation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `croyants`
--

INSERT INTO `croyants` (`id`, `nom`, `motPasse`, `creation`) VALUES
(1, 'Curé', '11', '2022-02-13 08:40:26'),
(2, 'alain', '11', '2022-02-13 08:40:41'),
(3, 'joe', '11', '2022-02-13 08:41:04');

-- --------------------------------------------------------

--
-- Structure de la table `peches`
--

DROP TABLE IF EXISTS `peches`;
CREATE TABLE IF NOT EXISTS `peches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCroyant` int(25) NOT NULL,
  `peche` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `statut` varchar(10) NOT NULL,
  `dateStatut` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `peches`
--

INSERT INTO `peches` (`id`, `idCroyant`, `peche`, `date`, `statut`, `dateStatut`) VALUES
(1, 2, 'Paresse', '2022-02-13 08:40:46', 'initial', '2022-02-13 08:40:46'),
(2, 2, 'Luxure', '2022-02-13 08:40:53', 'initial', '2022-02-13 08:40:53'),
(3, 3, 'vol de banque', '2022-02-13 08:41:11', 'initial', '2022-02-13 08:41:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
