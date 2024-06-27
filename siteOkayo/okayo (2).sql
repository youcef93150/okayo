-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 27 juin 2024 à 12:16
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `okayo`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `code_client` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `adresse`, `code_client`) VALUES
(1, 'Dupont', '10 Rue de Paris, 75001 Paris', 'C001'),
(2, 'Martin', '20 Avenue des Champs, 75008 Paris', 'C002'),
(3, 'Durand', '30 Boulevard Saint-Germain, 75005 Paris', 'C003');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id` int(11) NOT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `date_facturation` date DEFAULT NULL,
  `date_echeance` date DEFAULT NULL,
  `total_ht` decimal(15,2) DEFAULT NULL,
  `total_ttc` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `reference`, `date_facturation`, `date_echeance`, `total_ht`, `total_ttc`) VALUES
(1, 'F20230625-001', '2024-06-25', '2024-07-25', '250.00', '300.00'),
(2, 'F20230625-002', '2024-06-25', '2024-07-25', '100.00', '110.00');

-- --------------------------------------------------------

--
-- Structure de la table `facture_prestation`
--

CREATE TABLE `facture_prestation` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `facture_id` int(11) DEFAULT NULL,
  `prestation_id` int(11) DEFAULT NULL,
  `tva_id` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `total_ht` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `facture_prestation`
--

INSERT INTO `facture_prestation` (`id`, `client_id`, `facture_id`, `prestation_id`, `tva_id`, `quantite`, `total_ht`) VALUES
(1, 1, 1, 1, 1, 2, '200.00'),
(2, 1, 1, 2, 1, 1, '100.00'),
(3, 2, 2, 3, 2, 10, '100.00');

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

CREATE TABLE `prestation` (
  `id` int(11) NOT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `tva_id` int(11) NOT NULL,
  `pu_ht` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `prestation`
--

INSERT INTO `prestation` (`id`, `designation`, `tva_id`, `pu_ht`) VALUES
(1, 'Consulting', 1, '100.00'),
(2, 'Development', 1, '150.00'),
(3, 'Hosting', 2, '10.00');

-- --------------------------------------------------------

--
-- Structure de la table `tva`
--

CREATE TABLE `tva` (
  `id` int(11) NOT NULL,
  `taux` decimal(5,2) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tva`
--

INSERT INTO `tva` (`id`, `taux`, `date_debut`, `date_fin`) VALUES
(1, '20.00', '2023-01-01', '2023-12-31'),
(2, '5.50', '2023-01-01', '2023-12-31');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facture_prestation`
--
ALTER TABLE `facture_prestation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_facture_prestation_client` (`client_id`),
  ADD KEY `fk_facture_prestation_facture` (`facture_id`),
  ADD KEY `fk_facture_prestation_prestation` (`prestation_id`),
  ADD KEY `fk_facture_prestation_tva` (`tva_id`);

--
-- Index pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prestation_tva` (`tva_id`);

--
-- Index pour la table `tva`
--
ALTER TABLE `tva`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `facture_prestation`
--
ALTER TABLE `facture_prestation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `prestation`
--
ALTER TABLE `prestation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tva`
--
ALTER TABLE `tva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `facture_prestation`
--
ALTER TABLE `facture_prestation`
  ADD CONSTRAINT `facture_prestation_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `facture_prestation_ibfk_2` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`),
  ADD CONSTRAINT `facture_prestation_ibfk_3` FOREIGN KEY (`prestation_id`) REFERENCES `prestation` (`id`),
  ADD CONSTRAINT `facture_prestation_ibfk_4` FOREIGN KEY (`tva_id`) REFERENCES `tva` (`id`);

--
-- Contraintes pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD CONSTRAINT `fk_prestation_tva` FOREIGN KEY (`tva_id`) REFERENCES `tva` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
