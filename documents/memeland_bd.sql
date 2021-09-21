-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : tinygod731.mysql.db
-- Généré le : mer. 22 sep. 2021 à 01:30
-- Version du serveur : 5.6.50-log
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tinygod731`
--
CREATE DATABASE IF NOT EXISTS `tinygod731` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tinygod731`;

-- --------------------------------------------------------

--
-- Structure de la table `p_categorie`
--

CREATE TABLE `p_categorie` (
  `id_categorie` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_categorie`
--

INSERT INTO `p_categorie` (`id_categorie`) VALUES
('chaussure'),
('pins'),
('pull'),
('shirt');

-- --------------------------------------------------------

--
-- Structure de la table `p_commande`
--

CREATE TABLE `p_commande` (
  `id_commande` int(11) NOT NULL,
  `utilisateur_login` varchar(32) NOT NULL,
  `date` date NOT NULL,
  `prix_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_commande`
--

INSERT INTO `p_commande` (`id_commande`, `utilisateur_login`, `date`, `prix_total`) VALUES
(37, 'admin', '2020-12-10', 285),
(38, 'julien', '2020-12-10', 5),
(39, 'admin', '2020-12-10', 345),
(40, 'julien', '2020-12-10', 40),
(41, 'admin', '2020-12-10', 510),
(42, 'hamza', '2020-12-10', 175),
(43, 'hamza', '2020-12-10', 245),
(44, 'hamza', '2020-12-10', 275),
(45, 'hamza', '2020-12-10', 301),
(46, 'alexandre', '2020-12-10', 121),
(47, 'ilyes', '2020-12-10', 335);

-- --------------------------------------------------------

--
-- Structure de la table `p_listeArticle`
--

CREATE TABLE `p_listeArticle` (
  `commande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `nb_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_listeArticle`
--

INSERT INTO `p_listeArticle` (`commande_id`, `produit_id`, `nb_produit`) VALUES
(37, 65, 3),
(37, 72, 1),
(38, 67, 5),
(39, 71, 3),
(40, 71, 1),
(40, 72, 1),
(41, 70, 3),
(41, 73, 1),
(42, 65, 1),
(42, 66, 1),
(43, 71, 1),
(43, 70, 1),
(44, 73, 1),
(44, 72, 1),
(45, 67, 1),
(45, 68, 1),
(46, 71, 1),
(46, 72, 1),
(46, 67, 1),
(46, 66, 1),
(47, 73, 3),
(47, 70, 2),
(47, 68, 4),
(47, 65, 1);

-- --------------------------------------------------------

--
-- Structure de la table `p_produit`
--

CREATE TABLE `p_produit` (
  `id_produit` int(11) NOT NULL,
  `categorie_id` varchar(32) NOT NULL,
  `prix` float NOT NULL,
  `nom` varchar(32) NOT NULL,
  `description` varchar(512) NOT NULL,
  `image` varchar(64) NOT NULL,
  `couleur` varchar(64) NOT NULL,
  `disponible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_produit`
--

INSERT INTO `p_produit` (`id_produit`, `categorie_id`, `prix`, `nom`, `description`, `image`, `couleur`, `disponible`) VALUES
(65, 'chaussure', 90, 'Chaussure Meme Land', 'Belle Chaussure', '01e858b80ead735214e822f2c85a00d0.png', 'Verte', 1),
(66, 'chaussure', 85, 'Chaussure Meme Land', 'Jolie Chaussure', 'ab128179ed79606e84fed8e938170a37.png', 'Blanche', 1),
(67, 'pins', 1, 'Pins Meme Land', 'Un Pins simple', '8c9cdce09c2b8f3a6e9275c2f0d39281.png', 'Normal', 1),
(68, 'pins', 25, 'Pins Meme Land', 'Pins Pas Simple', '709bfc11ffd1fc371d31b781a8811916.png', 'Normal', 1),
(69, 'pins', 36, 'Lot Pins', 'Un lot simple', 'b6f321d557f46a136c06c0264c2cc3b0.png', 'Normal', 0),
(70, 'pull', 50, 'Pull Meme Land', 'Jolie Pull', 'f01eecb05797da9e7f68bcbe40a4f090.png', 'Noir', 1),
(71, 'pull', 20, 'Sweet Meme Land', 'Jolie Sweet', '62bde7945f02e126faaa94cc39516d93.png', 'Blanc', 1),
(72, 'shirt', 15, 'T-Shirt', 'Jolie T-shirt', 'a2c006c07a6b9d44ae79dd59242710fa.png', 'Blanc', 1),
(73, 'shirt', 15, 'T-Shirt Meme Land', 'Jolie T-shirt', '6bddc39c83ace629d557b62bfb091fac.png', 'Noir', 1);

-- --------------------------------------------------------

--
-- Structure de la table `p_utilisateur`
--

CREATE TABLE `p_utilisateur` (
  `login` varchar(32) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `nonce` varchar(32) DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `mdp` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_utilisateur`
--

INSERT INTO `p_utilisateur` (`login`, `nom`, `prenom`, `nonce`, `email`, `admin`, `mdp`) VALUES
('admin', 'Deneuville', 'Walter', NULL, 'walter@yopmail.fr', 1, 'e1fa69778afb25400246af46407f7bd7fb347b3b2d9c0fabf2d7d4fa48c2c332'),
('alexandre', 'Bousquet', 'Alexandre', NULL, 'alexandre.bousquet@etu.umontpellier.fr', 0, '2e46e4695ab51400b5523112461ea5516e4ea89697f7c096acd6ecc884c575d6'),
('hamza', 'Ikiou', 'Hamza', NULL, 'hamza.ikiou@etu.umontpellier.fr', 0, '80c87410dd298611318cc79c982410bb331b47795dbf0c0ddf5f034990fa0f83'),
('ilyes', 'Achalhi', 'Ilyes', NULL, 'ilyes.achalhi@etu.umontpellier.fr', 0, 'adee70a2b78d2906e1a06546b33e1695199c143b51ffdc922248627fd48ae87e'),
('julien', 'Atchy', 'Julien', NULL, 'julien.atchy-dalama@etu.umontpellier.fr', 0, '1c6110125209bdd3c7e84acfe8da62c04f7f85c173ab49d83061bb5155c7d3bb'),
('matthieu', 'Giaccaglia', 'Matthieu', NULL, 'matthieu.giaccaglia@etu.umontpellier.fr', 0, '6fdb5d6c52c6db468cedda12d32709bc7654e5a2f454e34cd5cafe5453ee8a06');
