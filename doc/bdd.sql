-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Ven 28 Novembre 2014 à 19:39
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `rsi_alliance`
--

INSERT INTO `rsi_alliance` (`id_alliance`, `nom`, `charte`) VALUES
(1, 'Acte de non-agression', 'Les membres des 2 teams qui conclu cet acte s''engage a ne pas engager le combat entre-eux.'),
(3, 'Accord commerciaux', 'Le commerce est privilégié entre ces 2 teams'),
(4, 'Rapprochement diplomatique', 'Aucune charte, les 2 teams on entamé un rapprochement par ambassade et peuvent communiqué via des diplomates');

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

--
-- Contenu de la table `rsi_alliance_team`
--

INSERT INTO `rsi_alliance_team` (`id_team`, `id_team_rsi_team`, `id_alliance`) VALUES
(1, 7, 1),
(1, 8, 4),
(1, 9, 4),
(1, 10, 4),
(6, 10, 4),
(1, 11, 4);

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
(3, 1),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rsi_joueur`
--

CREATE TABLE IF NOT EXISTS `rsi_joueur` (
  `id_joueur` int(11) NOT NULL AUTO_INCREMENT,
  `handle` varchar(255) DEFAULT NULL,
  `admin` tinyint(4) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `creato` datetime DEFAULT NULL,
  `lastco` datetime DEFAULT NULL,
  PRIMARY KEY (`id_joueur`),
  UNIQUE KEY `handle` (`handle`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `rsi_joueur`
--

INSERT INTO `rsi_joueur` (`id_joueur`, `handle`, `admin`, `img`, `email`, `mdp`, `creato`, `lastco`) VALUES
(1, 'Gourmand', 1, 'Sc.png', 'empireatwar@free.fr', 'bWab', '2014-11-24 16:00:11', '2014-11-24 16:00:11'),
(2, 'Luneclaire', 1, 'img_54786d68b05859.89896291.png', 'frederic.davin@free.fr', 'imXWqsXZrKvS', '2014-11-24 17:17:23', '2014-11-24 17:17:23'),
(3, 'Ocarina', 0, 'Gif_captain_harlock_and_yama_i_by_personaapollo-D6geyj3-1024x576.jpg', 'jeanbaptiste.jamon@gmail.com', 'o56ZpMWXa22Y', '2014-11-24 17:23:26', '2014-11-24 17:23:26'),
(4, 'Menfino', 0, 'atavar.jpg', 'menfin34@wanadoo.fr', 'fpGnlpWYbW6Jiw==', '2014-11-24 19:15:29', '2014-11-24 19:15:29'),
(5, 'pipoleon', 0, 'crane_de_chapeau_superieur_posters-r445edbb242734b85bcdc08922c0346ca_2eddn_8byvr_512 - Copie - Copie.jpg', 's_mattivi@hotmail.com', 'qpnSntjGppqUllQ=', '2014-11-24 21:06:05', '2014-11-24 21:06:05'),
(6, 'sparxx', 0, 'Bret-Hart-logo-psd76632.png', 'eric.simon6@afree.fr', 'qqnTmNHGq63I16BrmGxk', '2014-11-24 22:27:08', '2014-11-24 22:27:08'),
(7, 'Vukodlac', 1, 'guybodan.jpg', 'guybodan@gmail.com', 'pJnIoMneaWs=', '2014-11-24 22:56:27', '2014-11-24 22:56:27'),
(8, 'hasphese', 0, '11-65.png', 'hasphese@gmail.com', 'pJHYqcnXcG0=', '2014-11-25 12:09:39', '2014-11-25 12:09:39'),
(9, 'Fabian_HAWK_Esmiol', 1, 'test.png', 'admin@starpirates.fr', 'nqeXotfQoamW', '2014-11-25 12:14:10', '2014-11-25 12:14:10'),
(10, 'Benji_27', 0, '1794547_757726377595436_6882391111196423280_n.jpg', 'benjamin.damien@skynet.be', 'pJ/MrMXOanA=', '2014-11-25 15:25:34', '2014-11-25 15:25:34'),
(11, 'spuky', 0, 'VCV.png', 'dudu61200@gmail.com', 'mqnXntCWb2mW', '2014-11-25 20:08:29', '2014-11-25 20:08:29'),
(12, 'titizebest', 0, 'Avatar1.jpg', 'thierry.ruys@gmail.com', 'q5nZnt7KbHA=', '2014-11-25 21:12:33', '2014-11-25 21:12:33'),
(13, 'Toranis', 0, 'Avatar.jpg', 'philippe.ruveron@gmail.com', 'eImwbpzGsaScnQ==', '2014-11-25 21:21:54', '2014-11-25 21:21:54'),
(14, 'Ragnarhok', 0, 'Koala.jpg', 'jordandescamps@hotmail.com', 'aWeWZ5WecWk=', '2014-11-26 00:07:17', '2014-11-26 00:07:17'),
(15, 'fefel', 0, '306THSP-Logo.png', 'lord-fefel@hotmail.fr', 'sZSbrd3cnA==', '2014-11-26 06:34:02', '2014-11-26 06:34:02'),
(16, 'Volfs', 0, 'images.jpg', 'nathan.infos@gmail.com', 'mpXXntfKaWk=', '2014-11-26 18:22:53', '2014-11-26 18:22:53'),
(17, 'PA-Wampadala', 0, '2014_Husqvarna_FC_450_2495543.png', 'wampadala@gmail.com', 'n6iYZ5U=', '2014-11-27 12:16:51', '2014-11-27 12:16:51'),
(18, 'Hadjime', 0, '6.gif', 'langloist@hotmail.com', 'o5nToJWecHA=', '2014-11-27 14:04:14', '2014-11-27 14:04:14'),
(19, 'romrommm06', 0, 'Rpha10-Plus-Cage-Mc1-S6.jpg', 'romain.polchi@gmail.com', 'kWGVhJSwaWs=', '2014-11-27 14:06:39', '2014-11-27 14:06:39'),
(20, 'Js54', 0, 'Dragojs54.jpg', 'schuler.jessy@gmail.com', 'aGSVZ52Y', '2014-11-27 15:29:12', '2014-11-27 15:29:12'),
(21, 'L00PING', 0, 'img_54787c0170c872.75623355.png', 'xav506@hotmail.fr', 'Z2WVaZqX', '2014-11-28 14:43:30', '2014-11-28 14:43:30'),
(22, 'karakthur', 0, 'img_54788a2a696db5.57924610.jpg', 'aeyonas@gmail.com', 'p5HTqczKqp6HmA==', '2014-11-28 15:43:55', '2014-11-28 15:43:55'),
(23, 'DrWiz', 0, 'img_54788b79d7bc02.07216966.jpg', 'jacques.wisard@gmail.com', 'mp/anNLKrK3ImWBulQ==', '2014-11-28 15:49:30', '2014-11-28 15:49:30'),
(24, 'McMillay', 0, 'img_5478bc9290f451.43067642.jpg', 'j.kaydlay@gmail.com', 'n5/Xo8nZaWuTnA==', '2014-11-28 19:18:59', '2014-11-28 19:18:59');

-- --------------------------------------------------------

--
-- Structure de la table `rsi_joueur_dans_team`
--

CREATE TABLE IF NOT EXISTS `rsi_joueur_dans_team` (
  `principal` tinyint(1) DEFAULT NULL,
  `id_joueur` int(11) NOT NULL,
  `id_team` int(11) NOT NULL,
  `locker` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_joueur`,`id_team`),
  KEY `FK_rsi_joueur_dans_team_id_team` (`id_team`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rsi_joueur_dans_team`
--

INSERT INTO `rsi_joueur_dans_team` (`principal`, `id_joueur`, `id_team`, `locker`) VALUES
(1, 1, 1, 0),
(1, 2, 3, 0),
(1, 3, 1, 0),
(1, 4, 1, 0),
(1, 5, 1, 0),
(1, 6, 1, 0),
(1, 7, 2, 0),
(0, 8, 3, 0),
(1, 8, 4, 0),
(1, 9, 1, 0),
(1, 10, 1, 0),
(1, 11, 1, 0),
(1, 12, 1, 0),
(1, 13, 5, 0),
(1, 14, 5, 0),
(1, 15, 1, 0),
(1, 16, 2, 0),
(1, 17, 1, 0),
(1, 18, 3, 0),
(1, 19, 3, 0),
(1, 20, 1, 0),
(1, 21, 6, 1),
(1, 22, 1, 0),
(1, 23, 6, 0),
(1, 24, 6, 0);

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
(1, NULL, 1, 3),
(1, NULL, 2, 2),
(1, NULL, 2, 3),
(1, NULL, 2, 4),
(1, NULL, 2, 5),
(1, NULL, 2, 7),
(1, NULL, 2, 8),
(1, NULL, 2, 12),
(1, NULL, 2, 16),
(1, NULL, 2, 18),
(1, NULL, 2, 23),
(1, NULL, 2, 27),
(1, NULL, 2, 30),
(1, NULL, 2, 31),
(1, NULL, 2, 32),
(1, NULL, 2, 33),
(1, NULL, 2, 34),
(1, NULL, 2, 35),
(1, NULL, 2, 38),
(1, NULL, 2, 39),
(1, NULL, 2, 40),
(1, NULL, 2, 41),
(1, NULL, 2, 42),
(2, NULL, 2, 50),
(1, NULL, 3, 12),
(1, NULL, 3, 15),
(1, NULL, 3, 24),
(1, NULL, 4, 15),
(1, NULL, 4, 25),
(1, NULL, 4, 26),
(1, NULL, 5, 2),
(1, NULL, 5, 12),
(1, NULL, 5, 27),
(1, NULL, 6, 2),
(1, NULL, 6, 4),
(1, NULL, 6, 8),
(1, NULL, 6, 15),
(1, NULL, 6, 21),
(1, NULL, 6, 22),
(1, NULL, 6, 26),
(1, NULL, 6, 31),
(1, NULL, 6, 32),
(1, NULL, 6, 34),
(1, NULL, 6, 39),
(1, NULL, 6, 40),
(1, NULL, 6, 42),
(1, NULL, 6, 44),
(2, NULL, 7, 10),
(1, NULL, 7, 14),
(1, NULL, 7, 20),
(2, NULL, 7, 25),
(1, NULL, 7, 31),
(1, NULL, 8, 2),
(1, NULL, 8, 4),
(1, NULL, 8, 13),
(1, NULL, 8, 21),
(1, NULL, 8, 29),
(1, NULL, 9, 2),
(1, NULL, 9, 3),
(1, NULL, 9, 4),
(1, NULL, 9, 7),
(1, NULL, 9, 8),
(1, NULL, 9, 12),
(1, NULL, 9, 15),
(1, NULL, 9, 16),
(1, NULL, 9, 18),
(1, NULL, 9, 21),
(1, NULL, 9, 22),
(1, NULL, 9, 27),
(1, NULL, 9, 30),
(1, NULL, 9, 31),
(1, NULL, 9, 32),
(1, NULL, 9, 33),
(1, NULL, 9, 34),
(1, NULL, 9, 35),
(1, NULL, 9, 38),
(1, NULL, 9, 39),
(1, NULL, 9, 40),
(1, NULL, 9, 41),
(1, NULL, 9, 44),
(1, NULL, 9, 47),
(1, NULL, 10, 31),
(1, NULL, 11, 3),
(1, NULL, 11, 8),
(1, NULL, 12, 11),
(1, NULL, 13, 14),
(1, NULL, 14, 23),
(1, NULL, 14, 35),
(1, NULL, 14, 39),
(1, NULL, 14, 47),
(1, NULL, 15, 5),
(1, NULL, 15, 8),
(1, NULL, 15, 14),
(1, NULL, 15, 17),
(1, NULL, 15, 23),
(1, NULL, 15, 42),
(1, NULL, 15, 47),
(1, NULL, 16, 25),
(1, NULL, 17, 3),
(1, NULL, 17, 15),
(1, NULL, 18, 2),
(1, NULL, 18, 15),
(1, NULL, 18, 29),
(1, NULL, 19, 5),
(1, NULL, 19, 7),
(1, NULL, 19, 14),
(1, NULL, 19, 17),
(1, NULL, 19, 22),
(1, NULL, 19, 39),
(1, NULL, 20, 2),
(1, NULL, 20, 5),
(1, NULL, 20, 20),
(1, NULL, 20, 31),
(1, NULL, 20, 44),
(1, NULL, 21, 1),
(1, NULL, 21, 2),
(1, NULL, 21, 3),
(1, NULL, 21, 4),
(1, NULL, 21, 7),
(1, NULL, 21, 8),
(1, NULL, 21, 15),
(1, NULL, 21, 16),
(1, NULL, 21, 22),
(1, NULL, 21, 23),
(1, NULL, 21, 26),
(1, NULL, 21, 27),
(1, NULL, 21, 33),
(1, NULL, 21, 35),
(1, NULL, 21, 39),
(1, NULL, 21, 40),
(1, NULL, 21, 42),
(1, NULL, 21, 44),
(1, NULL, 21, 47),
(1, NULL, 21, 49),
(2, NULL, 21, 50),
(1, NULL, 22, 1),
(1, NULL, 22, 4),
(1, NULL, 22, 35),
(1, NULL, 22, 42),
(1, NULL, 22, 50),
(1, NULL, 23, 2),
(1, NULL, 23, 7),
(1, NULL, 23, 27);

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
(11, 1),
(2, 2),
(3, 2),
(3, 6),
(4, 7),
(5, 7),
(7, 7),
(11, 7),
(8, 8),
(9, 8),
(10, 8),
(12, 8),
(5, 10),
(6, 10),
(10, 10),
(11, 10),
(13, 10),
(10, 13),
(12, 13),
(2, 14),
(3, 14),
(4, 14),
(12, 14),
(10, 16),
(11, 16),
(4, 17),
(5, 17),
(4, 18),
(10, 18),
(3, 19),
(10, 19),
(2, 20),
(3, 20),
(4, 20),
(5, 20),
(6, 20),
(10, 20),
(11, 20),
(13, 20),
(1, 21),
(2, 21),
(10, 21),
(1, 22),
(3, 22),
(4, 22),
(7, 22),
(10, 22),
(11, 22),
(13, 22),
(4, 23),
(7, 23),
(4, 24);

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
(11, 1),
(3, 2),
(5, 2),
(6, 2),
(7, 2),
(3, 3),
(9, 3),
(2, 4),
(2, 5),
(10, 5),
(8, 6),
(1, 10),
(6, 10),
(10, 10),
(11, 10),
(1, 11),
(7, 11),
(4, 12),
(5, 12),
(9, 12),
(8, 13);

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
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id_team`),
  UNIQUE KEY `nom` (`nom`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `rsi_team`
--

INSERT INTO `rsi_team` (`id_team`, `nom`, `tag`, `logo`, `url`, `nbJoueur`, `mdp`) VALUES
(1, '306TH STAR PIRATES', '306THSP', '306THSP-Logo.png', 'http://www.starpirates.fr', 37, ''),
(2, 'MERCENARY SQUAD', 'MSQUAD', 'MS-Logo.png', 'http://msquad.xoo.it', 7, ''),
(3, 'BLACK PUMPKIN SPACE INDUSTRIES', 'BPSI', 'BPSI-Logo.jpg', 'http://www.bpsi-corporation.eu/', 47, ''),
(4, 'DYNAMIC ORE EXTRACTION', 'DOE', 'DOE-Logo (1).png', 'http://dynamicoreextraction.com/', 3, ''),
(5, 'MULTICORPS INDUSTRIES®', 'MCI', 'MCI-Logo.png', 'http://multicorps.fr', 26, ''),
(6, 'SWISS STARSHIPS', 'SWISS', 'img_54785cad18f023.37849586.png', 'https://robertsspaceindustries.com/orgs/SWISS', 21, ''),
(7, 'UNION HYDRA', 'UNIONHYDRA', 'img_54787734d11629.15774246.png', 'http://www.union-hydra.fr/site/', 38, ''),
(8, 'FLIBUSTIERS DE SIRIUS', 'FLIBSIRIUS', 'img_54787923629c98.41896832.jpg', 'http://flibustiers-de-sirius.enjin.com/', 19, ''),
(9, 'BLACK SQUADRON', 'BLACKSQUAD', 'img_54787b6ec811f2.34375737.png', 'http://blacksquadron.forumgratuit.eu/forum', 16, ''),
(10, 'FIGHT MERCENARY', 'FMY', 'img_54787c45a05fc7.45412411.png', 'http://fightclanwargame.fr/', 19, ''),
(11, 'THE SPACE WHISPERING BROTHERHOOD', 'SWB', 'img_54787cba9a51b1.44234864.png', 'http://www.the-swb.fr/', 18, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

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
(43, 'Carrack', 'Carrack_Landed_Final_Gurmukh.png', 'Exploration', 230, 0, 0, 4, 3),
(44, 'Herald', 'Herald-1.jpg', 'Info Runner', 0, 0, 0, 2, 1),
(45, 'Hull C', 'Media_Concept_Ship (1).jpg', 'Transport', 9000, 0, 0, 5, 6),
(46, 'Orion', 'Media_Concept_Ship (2).jpg', 'Mining', 940, 0, 0, 8, 4),
(47, 'Reclaimer', 'Reclaimer.jpg', 'Salvage', 2500, 0, 0, 5, 2),
(48, 'Javelin', 'Javelin_REV2_RearView_Hobbins.png', 'Destroyer', 5400, 0, 0, 23, 2),
(49, 'P-72 Archimedes', 'P-72 Archimedes.jpg', 'Short Range', 0, 0, 0, 1, 11),
(50, '85x', '85x.png', 'Short Range', 2, 0, 0, 1, 5);

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
  ADD CONSTRAINT `FK_rsi_joueur_dans_team_id_joueur` FOREIGN KEY (`id_joueur`) REFERENCES `rsi_joueur` (`id_joueur`),
  ADD CONSTRAINT `FK_rsi_joueur_dans_team_id_team` FOREIGN KEY (`id_team`) REFERENCES `rsi_team` (`id_team`);

--
-- Contraintes pour la table `rsi_joueur_possede_vaiss`
--
ALTER TABLE `rsi_joueur_possede_vaiss`
  ADD CONSTRAINT `FK_rsi_joueur_possede_vaiss_id_joueur` FOREIGN KEY (`id_joueur`) REFERENCES `rsi_joueur` (`id_joueur`),
  ADD CONSTRAINT `FK_rsi_joueur_possede_vaiss_id_vaisseau` FOREIGN KEY (`id_vaisseau`) REFERENCES `rsi_vaisseau` (`id_vaisseau`);

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
