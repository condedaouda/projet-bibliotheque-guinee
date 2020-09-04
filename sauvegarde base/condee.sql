-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 10 juin 2020 à 09:33
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
-- Base de données :  `condee`
--

-- --------------------------------------------------------

--
-- Structure de la table `brochures`
--

CREATE TABLE `brochures` (
  `id` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `brochures`
--

INSERT INTO `brochures` (`id`, `class`, `matiere`, `nom`, `image`, `commentaire`) VALUES
(3, '10', 'biologie', '10_1.pdf', '10_1.jpg', 'tres bonne brochure');

-- --------------------------------------------------------

--
-- Structure de la table `dossiers`
--

CREATE TABLE `dossiers` (
  `id_d` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `nom_dossier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dossiers`
--

INSERT INTO `dossiers` (`id_d`, `class`, `nom_dossier`) VALUES
(9, '7', 'livres'),
(10, '7', 'brochures'),
(11, '7', 'sujetevaluation'),
(12, '8', 'livres'),
(13, '8', 'brochures'),
(14, '8', 'sujetevaluation'),
(15, '9', 'livres'),
(16, '9', 'brochures'),
(17, '9', 'sujetevaluation'),
(18, '10', 'livres'),
(19, '10', 'brochures'),
(21, '10', 'sujetexamen'),
(23, '11 SM', 'livres'),
(24, '11 SM', 'brochures'),
(25, '11 SM', 'sujetevaluation'),
(27, '11 SE', 'livres'),
(28, '11 SE', 'brochures'),
(29, '11 SE', 'sujetevaluation'),
(31, '11 SS', 'livres'),
(32, '11 SS', 'brochures'),
(33, '11 SS', 'sujetevaluation'),
(35, '12 SM', 'livres'),
(36, '12 SM', 'brochures'),
(39, '12 SM', 'sujetevaluation'),
(41, '12 SE', 'livres'),
(42, '12 SE', 'brochures'),
(43, '12 SE', 'sujetevaluation'),
(45, '12 SS', 'livres'),
(46, '12 SS', 'brochures'),
(47, '12 SS', 'sujetevaluation'),
(48, 'Terminale SM', 'livres'),
(49, 'Terminale SM', 'brochures'),
(51, 'Terminale SM', 'sujetexamen'),
(52, 'Terminale SE', 'livres'),
(53, 'Terminale SE', 'brochures'),
(54, 'Terminale SE', 'sujetexamen'),
(55, 'Terminale SS', 'livres'),
(56, 'Terminale SS', 'brochures'),
(57, 'Terminale SS', 'sujetexamen');

-- --------------------------------------------------------

--
-- Structure de la table `ecoles`
--

CREATE TABLE `ecoles` (
  `id` int(11) NOT NULL,
  `code_ecole` varchar(255) NOT NULL,
  `nom_ecole` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `slogant` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ecoles`
--

INSERT INTO `ecoles` (`id`, `code_ecole`, `nom_ecole`, `photo`, `slogant`) VALUES
(1, '111111', 'semyg 2', 'semyg1.jfif', 'semyg toujours the best.'),
(2, '222222', 'cdlex', 'cdlex.jfif', 'cdlex the best'),
(13, 'adminconde666', 'admin', '', ''),
(14, '333333', 'aicha bah', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `exo`
--

CREATE TABLE `exo` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `exo`
--

INSERT INTO `exo` (`id`, `nom`, `class`, `image`, `commentaire`) VALUES
(1, '10_1.pdf', '10', '10_1.jpg', 'Un tres bon livre'),
(2, '9_2.pdf', '9', '9_2.jpg', 'tres interessant'),
(4, '10_3.pdf', '10', '10_3.jpg', 'meilleur livre'),
(5, '9_4.pdf', '9', '9_4.jpg', 'meilleur');

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE `livres` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id`, `nom`, `class`, `matiere`, `image`, `commentaire`) VALUES
(14, '10_1.pdf', '10', 'chimie', '10_1.jpg', 'meilleur livre'),
(15, '10_3.pdf', '10', 'histoire', '10_3.jpg', 'meilleur livre d\'histoire'),
(17, '9_5.pdf', '9', 'français', '9_5.jpg', 'meilleur livre de français'),
(24, '7_1.pdf', '7', 'geographie', '7_1.jpg', 'meilleur'),
(25, '7_2.jpg', '7', 'geographie', '7_2.jpg', 'un sujet tres interressant'),
(26, '7_3.pdf', '7', 'geographie', '7_3.jpg', 'tres cool');

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE `matieres` (
  `id_m` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `nom_matiere` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `matieres`
--

INSERT INTO `matieres` (`id_m`, `class`, `nom_matiere`) VALUES
(7, '7', 'histoire'),
(8, '7', 'geographie'),
(9, '7', 'maths'),
(10, '7', 'physique'),
(11, '7', 'biologie'),
(12, '7', 'geologie'),
(13, '7', 'chimie'),
(14, '8', 'histoire'),
(15, '8', 'geographie'),
(16, '8', 'maths'),
(17, '8', 'phisique'),
(18, '8', 'biologie'),
(19, '8', 'geologie'),
(20, '8', 'chimie'),
(21, '9', 'histoire'),
(22, '9', 'geographie'),
(23, '9', 'maths'),
(24, '9', 'physique'),
(25, '9', 'biologie'),
(26, '9', 'geologie'),
(27, '9', 'chimie'),
(28, '10', 'histoire'),
(29, '10', 'geographie'),
(30, '10', 'maths'),
(31, '10', 'physique'),
(32, '10', 'biologie'),
(33, '10', 'geologie'),
(34, '10', 'chimie'),
(35, '10', 'français'),
(36, '7', 'français'),
(37, '8', 'français'),
(38, '9', 'français');

-- --------------------------------------------------------

--
-- Structure de la table `sujetevaluation`
--

CREATE TABLE `sujetevaluation` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `class` int(11) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sujetevaluation`
--

INSERT INTO `sujetevaluation` (`id`, `image`, `class`, `matiere`, `commentaire`) VALUES
(7, '8_1.jpg', 8, 'biologie', 'tres bon sujet'),
(8, '8_2.jpg', 8, 'biologie', 'sujet de reference');

-- --------------------------------------------------------

--
-- Structure de la table `sujetexamen`
--

CREATE TABLE `sujetexamen` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `class` int(11) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `annee` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sujetexamen`
--

INSERT INTO `sujetexamen` (`id`, `image`, `class`, `matiere`, `annee`) VALUES
(9, '10_10.png', 10, 'physique', '2018'),
(10, '10_1.pdf', 10, 'physique', '2020'),
(11, '7_1.pdf', 10, 'biologie', '200'),
(15, '10_1.pdf', 10, 'maths', '2015'),
(16, '10_2.pdf', 10, 'maths', '2016');

-- --------------------------------------------------------

--
-- Structure de la table `titi`
--

CREATE TABLE `titi` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `brochures`
--
ALTER TABLE `brochures`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `brochures` ADD FULLTEXT KEY `commentaire_index` (`commentaire`);

--
-- Index pour la table `dossiers`
--
ALTER TABLE `dossiers`
  ADD PRIMARY KEY (`id_d`);

--
-- Index pour la table `ecoles`
--
ALTER TABLE `ecoles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `exo`
--
ALTER TABLE `exo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `livres` ADD FULLTEXT KEY `commentaire_index` (`commentaire`);

--
-- Index pour la table `matieres`
--
ALTER TABLE `matieres`
  ADD PRIMARY KEY (`id_m`);

--
-- Index pour la table `sujetevaluation`
--
ALTER TABLE `sujetevaluation`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sujetevaluation` ADD FULLTEXT KEY `commentaire_index` (`commentaire`);

--
-- Index pour la table `sujetexamen`
--
ALTER TABLE `sujetexamen`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `sujetexamen` ADD FULLTEXT KEY `commentaire_index` (`annee`);

--
-- Index pour la table `titi`
--
ALTER TABLE `titi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `brochures`
--
ALTER TABLE `brochures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `dossiers`
--
ALTER TABLE `dossiers`
  MODIFY `id_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `ecoles`
--
ALTER TABLE `ecoles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `exo`
--
ALTER TABLE `exo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `livres`
--
ALTER TABLE `livres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `matieres`
--
ALTER TABLE `matieres`
  MODIFY `id_m` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `sujetevaluation`
--
ALTER TABLE `sujetevaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `sujetexamen`
--
ALTER TABLE `sujetexamen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `titi`
--
ALTER TABLE `titi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
