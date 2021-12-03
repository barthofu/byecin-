-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 30 nov. 2021 à 14:41
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `byecine`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

DROP TABLE IF EXISTS `acteur`;
CREATE TABLE IF NOT EXISTS `acteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `acteur`
--

INSERT INTO `acteur` (`id`, `nom`, `prenom`) VALUES
(1, 'Gili', 'Bartholomé'),
(2, 'Bourcereau', 'Ethan'),
(3, 'Richard', 'Sébastien'),
(4, 'Iglesis', 'Léna'),
(14, 'Adjamidis', 'Antoine'),
(18, 'Fayolle', 'Lodovic'),
(19, 'Gomez Sanchez', 'Atlas');

-- --------------------------------------------------------

--
-- Structure de la table `casting`
--

DROP TABLE IF EXISTS `casting`;
CREATE TABLE IF NOT EXISTS `casting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filmId` int(11) NOT NULL,
  `acteurId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `casting`
--

INSERT INTO `casting` (`id`, `filmId`, `acteurId`) VALUES
(94, 1688, 19),
(93, 3, 18),
(89, 4, 14),
(87, 5, 1),
(86, 5, 2),
(85, 3, 2),
(88, 1, 14),
(83, 2, 1),
(82, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int(4) NOT NULL,
  `score` float DEFAULT '0',
  `nbVotants` int(5) DEFAULT '0',
  `image` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1690 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`id`, `nom`, `annee`, `score`, `nbVotants`, `image`) VALUES
(1, '2001: A Space Odyssey', 1968, 8.4, 6413, 'phpAA05.jpg'),
(2, 'Blade Runner', 1983, 8.6, 8672, 'phpDD0D.jpg'),
(3, 'Pulp Fiction', 1994, 8.4, 11693, 'php324.jpg'),
(4, 'Avengers', 2010, 8.1, 8908, 'php28AE.jpg'),
(5, 'Interstellar', 2013, 9.4, 15981, 'php5CBF.jpg'),
(1688, 'Vice-Versa', 2015, 0, 1, 'php7C5E.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `avatar`, `admin`, `created_at`) VALUES
(6, 'lazare', '$2y$10$4OgwBOwLrUoWt1x707LEIeTCqeSaelBrP4vJ5Luo1H3lJt3EKFVGG', '_defaultAvatar.png', 0, '2021-11-29 08:40:32'),
(4, 'bartho', '$2y$10$UMkxwbaSL4LTwc/QRIEvuORaWwHnpPzkj2/d0Fdo1g5.wo.PR8Cya', 'php97B6.jpg', 1, '2021-11-29 08:38:23');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
