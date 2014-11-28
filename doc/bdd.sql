-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Lun 24 Novembre 2014 à 16:03
-- Version du serveur :  5.1.73
-- Version de PHP :  5.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `sc_planner`
--

-- --------------------------------------------------------

--
-- Structure de la table `rsi_alliance`
--

CREATE TABLE IF NOT EXISTS `rsi_alliance` (
  `id_alliance` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `charte` text,
  PRIMARY KEY (`id_alliance`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `rsi_alliance`
--

INSERT INTO `rsi_alliance` (`id_alliance`, `nom`, `charte`) VALUES
(1, 'Acte de non-agression', 'Les membres des 2 teams qui conclu cet acte s''engage a ne pas engager le combat entre-eux.'),
(3, 'Accord commerciaux', 'Le commerce est privilégié entre ces 2 teams');

-- --------------------------------------------------------

--
-- Structure de la table `rsi_alliance_groupe`
--

CREATE TABLE IF NOT EXISTS `rsi_alliance_groupe` (
  `id_alliance` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id_alliance`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `rsi_alliance_groupe`
--

INSERT INTO `rsi_alliance_groupe` (`id_alliance`, `nom`, `logo`, `url`, `description`) VALUES
(1, 'FRENCH ECONOMIC UNION', 'FEU-Logo.jpg', 'http://feu-sc.eu', 'La French Economic Union est l''alliance de plusieurs entreprises industriels ainsi que de service, garantissant ainsi toutes ses productions, de l''extraction du minerais jusqu''au produit fini, ainsi que la livraison et la sécurité de ses convoies. La FEU n''est en aucun cas une puissance militaire, mais possède une flotte de dissuasion.');

-- --------------------------------------------------------

--
-- Structure de la table `rsi_alliance_team`
--

CREATE TABLE IF NOT EXISTS `rsi_alliance_team` (
  `id_team` int(11) NOT NULL,
  `id_team_rsi_team` int(11) NOT NULL,
  `id_alliance` int(11) NOT NULL,
  PRIMARY KEY (`id_team`,`id_team_rsi_team`,`id_alliance`),
  KEY `FK_rsi_alliance_team_id_team_rsi_team` (`id_team_rsi_team`),
  KEY `FK_rsi_alliance_team_id_alliance` (`id_alliance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rsi_constructeur`
--

CREATE TABLE IF NOT EXISTS `rsi_constructeur` (
  `id_constructeur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_constructeur`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `rsi_constructeur`
--

INSERT INTO `rsi_constructeur` (`id_constructeur`, `nom`, `logo`) VALUES
(1, 'Drake Interplanetary', 'Drake.png'),
(2, 'Aegis Dynamics', 'Aegis.png'),
(3, 'Anvil Aerospace', 'Anvil.png'),
(4, 'Roberts Space Industries', 'RSI.png'),
(5, 'Origin Jumpworks GmbH', 'Origin.png'),
(6, 'Musashi Industrial & Starflight Concern', 'MISC.png'),
(7, 'Consolidated Outland', 'Consolidated_outland.png'),
(8, 'Vanduul', 'Vanduul.png'),
(9, 'Xi''An', 'Xian.png'),
(10, 'Banu', 'Banu.png'),
(11, 'Kruger Intergalactic', 'Kruger.png');

-- --------------------------------------------------------

--
-- Structure de la table `rsi_groupe_alliance`
--

CREATE TABLE IF NOT EXISTS `rsi_groupe_alliance` (
  `id_team` int(11) NOT NULL,
  `id_alliance` int(11) NOT NULL,
  PRIMARY KEY (`id_team`,`id_alliance`),
  KEY `FK_rsi_groupe_alliance_id_alliance` (`id_alliance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rsi_groupe_alliance`
--

INSERT INTO `rsi_groupe_alliance` (`id_team`, `id_alliance`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rsi_joueur`
--

CREATE TABLE IF NOT EXISTS `rsi_joueur` (
  `id_joueur` int(11) NOT NULL AUTO_INCREMENT,
  `handle` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `creato` datetime DEFAULT NULL,
  `lastco` datetime DEFAULT NULL,
  PRIMARY KEY (`id_joueur`),
  UNIQUE KEY `handle` (`handle`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `rsi_joueur`
--

INSERT INTO `rsi_joueur` (`id_joueur`, `handle`, `img`, `email`, `mdp`, `creato`, `lastco`) VALUES
(1, 'Gourmand', 'Sc.png', 'empireatwar@free.fr', 'aGKYaZmb', '2014-11-24 16:00:11', '2014-11-24 16:00:11');

-- --------------------------------------------------------

--
-- Structure de la table `rsi_joueur_dans_team`
--

CREATE TABLE IF NOT EXISTS `rsi_joueur_dans_team` (
  `principal` tinyint(1) DEFAULT NULL,
  `id_joueur` int(11) NOT NULL,
  `id_team` int(11) NOT NULL,
  PRIMARY KEY (`id_joueur`,`id_team`),
  KEY `FK_rsi_joueur_dans_team_id_team` (`id_team`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rsi_joueur_dans_team`
--

INSERT INTO `rsi_joueur_dans_team` (`principal`, `id_joueur`, `id_team`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rsi_joueur_possede_vaiss`
--

CREATE TABLE IF NOT EXISTS `rsi_joueur_possede_vaiss` (
  `nb` int(11) DEFAULT NULL,
  `date_dispo` datetime DEFAULT NULL,
  `id_joueur` int(11) NOT NULL,
  `id_vaisseau` int(11) NOT NULL,
  PRIMARY KEY (`id_joueur`,`id_vaisseau`),
  KEY `FK_rsi_joueur_possede_vaiss_id_vaisseau` (`id_vaisseau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rsi_joueur_possede_vaiss`
--

INSERT INTO `rsi_joueur_possede_vaiss` (`nb`, `date_dispo`, `id_joueur`, `id_vaisseau`) VALUES
(1, NULL, 1, 2),
(1, NULL, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `rsi_orientation`
--

CREATE TABLE IF NOT EXISTS `rsi_orientation` (
  `id_orientation` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_orientation`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `rsi_orientation`
--

INSERT INTO `rsi_orientation` (`id_orientation`, `nom`, `logo`) VALUES
(1, 'Social', 'Social.png'),
(2, 'Commerce', 'Trade.png'),
(3, 'Transport', 'Transport.png'),
(4, 'Sécurité', 'Security.png'),
(5, 'Chasseur de prime', 'Bounty_hunting.png'),
(6, 'Pirate', 'Piracy.png'),
(7, 'Eclaireur', 'Scouting.png'),
(8, 'Infiltration', 'Infiltration.png'),
(9, 'Ingénierie', 'Engineering.png'),
(10, 'Exploration', 'Exploration.png'),
(11, 'Freelance', 'Freelancing.png'),
(12, 'Ressources', 'Resources.png'),
(13, 'Contrebande', 'Smuggling.png');

-- --------------------------------------------------------

--
-- Structure de la table `rsi_orientation_joueur`
--

CREATE TABLE IF NOT EXISTS `rsi_orientation_joueur` (
  `id_orientation` int(11) NOT NULL,
  `id_joueur` int(11) NOT NULL,
  PRIMARY KEY (`id_orientation`,`id_joueur`),
  KEY `FK_rsi_orientation_joueur_id_joueur` (`id_joueur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rsi_orientation_joueur`
--

INSERT INTO `rsi_orientation_joueur` (`id_orientation`, `id_joueur`) VALUES
(4, 1),
(5, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rsi_orientation_team`
--

CREATE TABLE IF NOT EXISTS `rsi_orientation_team` (
  `id_team` int(11) NOT NULL,
  `id_orientation` int(11) NOT NULL,
  PRIMARY KEY (`id_team`,`id_orientation`),
  KEY `FK_rsi_orientation_team_id_orientation` (`id_orientation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rsi_orientation_team`
--

INSERT INTO `rsi_orientation_team` (`id_team`, `id_orientation`) VALUES
(5, 2),
(4, 12),
(5, 12);

-- --------------------------------------------------------

--
-- Structure de la table `rsi_team`
--

CREATE TABLE IF NOT EXISTS `rsi_team` (
  `id_team` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `nbJoueur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_team`),
  UNIQUE KEY `nom` (`nom`,`tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `rsi_team`
--

INSERT INTO `rsi_team` (`id_team`, `nom`, `tag`, `logo`, `url`, `nbJoueur`) VALUES
(1, '306TH STAR PIRATES', '306THSP', '306THSP-Logo.png', 'http://www.starpirates.fr', 37),
(2, 'MERCENARY SQUAD', 'MSQUAD', 'MS-Logo.png', 'http://msquad.xoo.it', 7),
(3, 'BLACK PUMPKIN SPACE INDUSTRIES', 'BPSI', 'BPSI-Logo.jpg', 'http://www.bpsi-corporation.eu/', 47),
(4, 'DYNAMIC ORE EXTRACTION', 'DOE', 'DOE-Logo (1).png', 'http://dynamicoreextraction.com/', 3),
(5, 'MULTICORPS INDUSTRIES®', 'MCI', 'MCI-Logo.png', 'http://multicorps.fr', 26);

-- --------------------------------------------------------

--
-- Structure de la table `rsi_vaisseau`
--

CREATE TABLE IF NOT EXISTS `rsi_vaisseau` (
  `id_vaisseau` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `focus` varchar(255) DEFAULT NULL,
  `cargo` int(11) DEFAULT NULL,
  `autonomie` int(11) DEFAULT NULL,
  `coutReparation` int(11) DEFAULT NULL,
  `nbEquipage` int(11) DEFAULT NULL,
  `id_constructeur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_vaisseau`),
  UNIQUE KEY `nom` (`nom`),
  KEY `cargo` (`cargo`),
  KEY `FK_rsi_vaisseau_id_constructeur` (`id_constructeur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Contenu de la table `rsi_vaisseau`
--

INSERT INTO `rsi_vaisseau` (`id_vaisseau`, `nom`, `img`, `focus`, `cargo`, `autonomie`, `coutReparation`, `nbEquipage`, `id_constructeur`) VALUES
(1, 'F7C Hornet', 'F7c_hornet_storefront_visual.jpg', 'Civilian Close Support', 16, 0, 0, 1, 3),
(2, 'F7C-M Super Hornet', 'F7c-M_super-Hornet_storefront_visual.jpg', 'Space Superiority', 0, 0, 0, 2, 3),
(3, 'Aurora LX', 'Lx.jpg', 'Interdiction', 16, 0, 0, 1, 4),
(4, 'M50 Interceptor', 'M50_new_comp47.jpg', 'Racing / Interception', 0, 0, 0, 1, 5),
(5, 'MUSTANG OMEGA', 'Mustang_Gamma_AMD_Version_06_Bhasin.png', 'Racing', 0, 0, 0, 1, 7),
(6, 'MUSTANG', 'Mustang_Action_View_A_Hobbins.png', 'Starter', 0, 0, 0, 1, 7),
(7, 'Redeemer', 'Red1.jpg', 'Gunship', 0, 0, 0, 5, 2),
(8, 'Gladius', 'Gladius_Front_Perspective.jpg', 'Short-range Patrol Fighter', 0, 0, 0, 1, 2),
(9, 'Aurora ES', 'Rsi_aurora_es_storefront_visual.jpg', 'Starter/Exploration', 16, 0, 0, 1, 4),
(10, 'Aurora MR', 'Rsi_aurora_mr_storefront_visual.jpg', 'Interdiction', 16, 0, 0, 1, 4),
(11, 'Aurora CL', 'Rsi_aurora_cl_storefront_visual.jpg', 'Mercantile', 36, 0, 0, 1, 4),
(12, 'Aurora LN', 'Rsi_aurora_ln_storefront_visual.jpg', 'Militia/Patrol', 16, 0, 0, 1, 4),
(13, '300i', '300i_storefront_visual.jpg', 'Touring', 16, 0, 0, 1, 5),
(14, '315p', '315p_storefront_visual.jpg', 'Exploration', 24, 0, 0, 1, 4),
(15, '325A', '325a_storefront_visual.jpg', 'Interdiction', 16, 0, 0, 1, 5),
(16, '350r', '350r_storefront_visual.jpg', 'Racing', 0, 0, 0, 1, 5),
(17, 'F7C-S Hornet Ghost', 'F7cs_hornet_ghost_storefront_visual.jpg', 'Infiltration', 0, 0, 0, 1, 3),
(18, 'F7C-R Hornet Tracker', 'F7c-R_hornet-Tracker_storefront_visual.jpg', 'Scout/Command and Control', 0, 0, 0, 1, 3),
(19, 'F7A Hornet', 'F7a.jpg', 'Military Close Support', 0, 0, 0, 1, 3),
(20, 'Constellation Andromeda', 'Andromeda_Storefront.jpg', 'Multi-Function', 1100, 0, 0, 5, 4),
(21, 'Constellation Taurus', 'Taurus-Storefront.jpg', 'Transport', 1900, 0, 0, 4, 4),
(22, 'Constellation Aquila', 'Aquila_Storefront.jpg', 'Exploration', 1100, 0, 0, 4, 4),
(23, 'Constellation Phoenix', 'Phoenix_Storefront.jpg', 'Luxury Touring', 540, 0, 0, 4, 4),
(24, 'Freelancer', 'Freelancer_storefront_visual.jpg', 'Mercantile', 168, 0, 0, 2, 6),
(25, 'Freelancer DUR', 'Freelancer_dur_storefront_visual.jpg', 'Exploration', 148, 0, 0, 2, 6),
(26, 'Freelancer MAX', 'Freelancer_max_storefront_visual.jpg', 'Transport', 280, 0, 0, 2, 6),
(27, 'Freelancer MIS', 'Freelancer_mis_storefront_visual.jpg', 'Militia', 132, 0, 0, 3, 6),
(28, 'Cutlass Red', 'Slide_Cut-Red.jpg', 'Search & Rescue', 120, 0, 0, 4, 1),
(29, 'Cutlass Black', 'Drake_cutlass_storefront_visual.jpg', 'Militia/Patrol', 150, 0, 0, 3, 1),
(30, 'Cutlass Blue', 'Blue-WR-Orth_000000.jpg', 'Police', 120, 0, 0, 3, 1),
(31, 'Avenger', 'Avenger_storefront_visualjpg.jpg', 'Interceptor/Interdiction', 32, 0, 0, 1, 2),
(32, 'Gladiator', 'Gladiator.png', 'Carrier-based Bomber', 0, 0, 0, 2, 3),
(33, 'Starfarer', 'Starfarer_earlyrender1.jpg', 'Transport', 900, 0, 0, 2, 6),
(34, 'Caterpillar', 'Cat-Model-Render4.jpg', 'Transport', 3200, 0, 0, 5, 1),
(35, 'Retaliator', 'Retaliator.JPG', 'Long-Range Bomber', 720, 0, 0, 8, 2),
(36, 'Scythe', 'Vanduul-Scythe_storefront_visual.jpg', 'Medium Fighter', 0, 0, 0, 1, 8),
(37, 'Idris-M', 'IDRISdownfrontquarter_copy.jpg', 'Frigate', 860, 0, 0, 10, 2),
(38, 'Idris-P', 'IDRISPdownfrontquarter_copy.jpg', 'Frigate', 1720, 0, 0, 10, 2),
(39, 'P-52 Merlin', 'Rsi_p52_merlin_storefront_visual.jpg', 'Short Range (w/ Constellation)', 0, 0, 0, 1, 11),
(40, 'Karthu-Al', 'karthuAl.jpg', 'Light Fighter', 0, 0, 0, 2, 9),
(41, 'Merchantman', 'Banu_merchantman_side_Version_A.jpg', 'Trade', 6000, 0, 0, 8, 10),
(42, '890 JUMP', '890_beautyShot-Concept_V01High_NF_140709.jpg', 'Luxury Touring', 1600, 0, 0, 5, 5),
(43, 'Carrack', 'Media_Concept_Ship.jpg', 'Exploration', 230, 0, 0, 4, 3),
(44, 'Herald', 'Herald-1.jpg', 'Info Runner', 0, 0, 0, 2, 1),
(45, 'Hull C', 'Media_Concept_Ship (1).jpg', 'Transport', 9000, 0, 0, 5, 6),
(46, 'Orion', 'Media_Concept_Ship (2).jpg', 'Mining', 940, 0, 0, 8, 4),
(47, 'Reclaimer', 'Reclaimer.jpg', 'Salvage', 2500, 0, 0, 5, 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `rsi_alliance_team`
--
ALTER TABLE `rsi_alliance_team`
  ADD CONSTRAINT `FK_rsi_alliance_team_id_alliance` FOREIGN KEY (`id_alliance`) REFERENCES `rsi_alliance` (`id_alliance`),
  ADD CONSTRAINT `FK_rsi_alliance_team_id_team` FOREIGN KEY (`id_team`) REFERENCES `rsi_team` (`id_team`),
  ADD CONSTRAINT `FK_rsi_alliance_team_id_team_rsi_team` FOREIGN KEY (`id_team_rsi_team`) REFERENCES `rsi_team` (`id_team`);

--
-- Contraintes pour la table `rsi_groupe_alliance`
--
ALTER TABLE `rsi_groupe_alliance`
  ADD CONSTRAINT `FK_rsi_groupe_alliance_id_alliance` FOREIGN KEY (`id_alliance`) REFERENCES `rsi_alliance_groupe` (`id_alliance`),
  ADD CONSTRAINT `FK_rsi_groupe_alliance_id_team` FOREIGN KEY (`id_team`) REFERENCES `rsi_team` (`id_team`);

--
-- Contraintes pour la table `rsi_joueur_dans_team`
--
ALTER TABLE `rsi_joueur_dans_team`
  ADD CONSTRAINT `FK_rsi_joueur_dans_team_id_team` FOREIGN KEY (`id_team`) REFERENCES `rsi_team` (`id_team`),
  ADD CONSTRAINT `FK_rsi_joueur_dans_team_id_joueur` FOREIGN KEY (`id_joueur`) REFERENCES `rsi_joueur` (`id_joueur`);

--
-- Contraintes pour la table `rsi_joueur_possede_vaiss`
--
ALTER TABLE `rsi_joueur_possede_vaiss`
  ADD CONSTRAINT `FK_rsi_joueur_possede_vaiss_id_vaisseau` FOREIGN KEY (`id_vaisseau`) REFERENCES `rsi_vaisseau` (`id_vaisseau`),
  ADD CONSTRAINT `FK_rsi_joueur_possede_vaiss_id_joueur` FOREIGN KEY (`id_joueur`) REFERENCES `rsi_joueur` (`id_joueur`);

--
-- Contraintes pour la table `rsi_orientation_joueur`
--
ALTER TABLE `rsi_orientation_joueur`
  ADD CONSTRAINT `FK_rsi_orientation_joueur_id_joueur` FOREIGN KEY (`id_joueur`) REFERENCES `rsi_joueur` (`id_joueur`),
  ADD CONSTRAINT `FK_rsi_orientation_joueur_id_orientation` FOREIGN KEY (`id_orientation`) REFERENCES `rsi_orientation` (`id_orientation`);

--
-- Contraintes pour la table `rsi_orientation_team`
--
ALTER TABLE `rsi_orientation_team`
  ADD CONSTRAINT `FK_rsi_orientation_team_id_orientation` FOREIGN KEY (`id_orientation`) REFERENCES `rsi_orientation` (`id_orientation`),
  ADD CONSTRAINT `FK_rsi_orientation_team_id_team` FOREIGN KEY (`id_team`) REFERENCES `rsi_team` (`id_team`);

--
-- Contraintes pour la table `rsi_vaisseau`
--
ALTER TABLE `rsi_vaisseau`
  ADD CONSTRAINT `FK_rsi_vaisseau_id_constructeur` FOREIGN KEY (`id_constructeur`) REFERENCES `rsi_constructeur` (`id_constructeur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
