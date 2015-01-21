-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 21 Janvier 2015 à 16:31
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `starcitizen`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `rsi_joueur`
--

INSERT INTO `rsi_joueur` (`id_joueur`, `handle`, `admin`, `img`, `email`, `mdp`, `creato`, `lastco`) VALUES
(1, 'Gourmand', 1, 'Sc.png', 'empireatwar@free.fr', 'o2dwTGVGq1xTh2iBdjq6pQDz5kuzaOOvr/uoR.j.0Uth7GRUPYptNyITPCQCUeD8HYhqVT3KqeGYdrVhXKNNX1', '2014-11-24 16:00:11', '2014-11-24 16:00:11'),
(2, 'Luneclaire', 1, 'img_54786d68b05859.89896291.png', 'frederic.davin@free.fr', 'efnU3ti.4xCmdLKSmB0y6ZzTXVVq1efSQdb.DQnKsnq5IMh0mAqhYTIqp92XZFWU.rZyfupvmZV52VWkTWeOi/', '2014-11-24 17:17:23', '2014-11-24 17:17:23'),
(3, 'Ocarina', 0, 'Gif_captain_harlock_and_yama_i_by_personaapollo-D6geyj3-1024x576.jpg', 'jeanbaptiste.jamon@gmail.com', 't5g6DZ8dGUeb7NJNJAWibOEPf9uX1khNEFzxIHbXdPY.wJi61GGeqAIODEY/YHVdAsJtT7wug6G8AYHKGCvLu/', '2014-11-24 17:23:26', '2014-11-24 17:23:26'),
(4, 'Menfino', 0, 'atavar.jpg', 'menfin34@wanadoo.fr', 'zc6pwgmzuloLM8E3G0X8oeDNxbYHdVWpbD.9ugsnTT9RkyMN.txjc7b32ZAsiaRuIwNQOClMpfo838PyP/Eqq1', '2014-11-24 19:15:29', '2014-11-24 19:15:29'),
(5, 'pipoleon', 0, 'crane_de_chapeau_superieur_posters-r445edbb242734b85bcdc08922c0346ca_2eddn_8byvr_512 - Copie - Copie.jpg', 's_mattivi@hotmail.com', '8wWd5WTZgIvJEyZII8sgzfRwRNdvM3e/4FDXp32vFsuSayAuhW.kJWKSplkdkWrnb9usIM.eIQipExnT78QDX0', '2014-11-24 21:06:05', '2014-11-24 21:06:05'),
(6, 'sparxx', 0, 'Bret-Hart-logo-psd76632.png', 'eric.simon6@free.fr', 'VR1jBynR6D3ryKRhhmyRYWh4ErX6Ylo0OCGw/UNf8JutyVCQF21ZGAt.x6tph/x.IHuwlUA4tF5PzPYh5sbXq.', '2014-11-24 22:27:08', '2014-11-24 22:27:08'),
(7, 'Vukodlac', 1, 'guybodan.jpg', 'guybodan@gmail.com', 'xDVT.cVx.Aojn266q10Jk4M7e0a.bOxxpAjPaqD.JFWlZq6jUV1PSs4t.lOlqirm/1r/CrGHnZIcMqMlKVxGs1', '2014-11-24 22:56:27', '2014-11-24 22:56:27'),
(8, 'hasphese', 0, '11-65.png', 'hasphese@gmail.com', 'P8iZIcnuhQ1taXRTplPx3dRbDiNnB3IaTKaTZlbMDLDi9BnGqDdILkQEB/Ns25vxIMSN1gvxCDNEAE1kMqdsS.', '2014-11-25 12:09:39', '2014-11-25 12:09:39'),
(9, 'Fabian_HAWK_Esmiol', 1, 'test.png', 'admin@starpirates.fr', '9o8o.5s4nXRuW.OJBqKUECWFJZHOLvIUwR5WKMTSVFCC9lf2ueF0UD8rO71Zq.HZMAt6zDI/w5ZPNgvLNcGlI/', '2014-11-25 12:14:10', '2014-11-25 12:14:10'),
(10, 'Benji_27', 0, '1794547_757726377595436_6882391111196423280_n.jpg', 'benjamin.damien@skynet.be', 'tvBeTj1XsAN3FB5ThgaPjDEhqjp59OWEqQqgb7Ag1ILxQLfkl5NQIAO.z5dXh8i91u0XlCf2wiS.cMmefQNEu0', '2014-11-25 15:25:34', '2014-11-25 15:25:34'),
(11, 'spuky', 0, 'VCV.png', 'dudu61200@gmail.com', 'ImnQzu5I/MTHSAeK8Np3BDhClnd4xmJSEQ.cqylbuSkxrxK4HeNLIkk1gcISPAWuVQ8JWBPoOGrGP6PxAhaEo.', '2014-11-25 20:08:29', '2014-11-25 20:08:29'),
(12, 'titizebest', 0, 'Avatar1.jpg', 'thierry.ruys@gmail.com', 'Xa9.9IyuNemKr1zRtlKQDflwcRZHir2KVqUAqvnXhnLCMEVgycZFVpYGVqDivtcY.6Kc7afPXot4SH6yvnalo0', '2014-11-25 21:12:33', '2014-11-25 21:12:33'),
(13, 'Toranis', 0, 'Avatar.jpg', 'philippe.ruveron@gmail.com', '2y7Wqscil1y8bNL37LFU89Voh3bv58h4sGWNF4yQUtLhZj62F2SNA56y7dB406CO4MD8Hoj.a0OMgLXJr9wbB0', '2014-11-25 21:21:54', '2014-11-25 21:21:54'),
(14, 'Ragnarhok', 0, 'Koala.jpg', 'jordandescamps@hotmail.com', 'T4zyMbVhlVUfjFBRR0p3fog0OlTyE7myOcR3qeqqjnyRNJrAzTKZO2aJ5p3AgMuMPRreBLqqZxX1XdX3I4h740', '2014-11-26 00:07:17', '2014-11-26 00:07:17'),
(15, 'fefel', 0, '306THSP-Logo.png', 'lord-fefel@hotmail.fr', '0NY6ioimL0YgrtOce6qmtWgMrRvQ/Q/kHFMWqp0JAA1ANnAWocLaurvGaiG8/cvoEfHh.yNBOfvqipHs9QeuI.', '2014-11-26 06:34:02', '2014-11-26 06:34:02'),
(16, 'Volfs', 0, 'images.jpg', 'nathan.infos@gmail.com', 'kpOGkyNubjCYPfPd51ucFo.SSQO0PSM97CeALHVjA6FR.DY7nBh4U9kuNRprL5OOjwh9tm.En98RLF7LVEzoj0', '2014-11-26 18:22:53', '2014-11-26 18:22:53'),
(17, 'PA-Wampadala', 0, '2014_Husqvarna_FC_450_2495543.png', 'wampadala@gmail.com', 'HmueLMhIdlF7RhuuxpOELig26sDUOdT4Fy3HTj2AgGiE1yrOCmfg2zSZvvhbDSXW6zfS93ue947wxbxT3ldff0', '2014-11-27 12:16:51', '2014-11-27 12:16:51'),
(18, 'Hadjime', 0, '6.gif', 'langloist@hotmail.com', 'ReEtuA/mqLyGtKK/9dyVDWO4qdFz3M3.Gf6/WB8oEcehS0o5pnvTYVx6eq5wYxWfIh9A81Npdcwb4gXXCou4I.', '2014-11-27 14:04:14', '2014-11-27 14:04:14'),
(19, 'romrommm06', 0, 'Rpha10-Plus-Cage-Mc1-S6.jpg', 'romain.polchi@gmail.com', 'g3myQuPAPaTLGeM.SjFrGAwOJ83rNNQtgwAQ1H4EJ7kO5xrDRCOgjpmzDsx5fE.5K3RK9TEFBM2L2sjR0js6h.', '2014-11-27 14:06:39', '2014-11-27 14:06:39'),
(20, 'Js54', 0, 'Dragojs54.jpg', 'schuler.jessy@gmail.com', '1lrNiyCp7AH3G.YUfFl/4x7T1Y5AAqXI0WyMLKexk5S8wfAS8jK81n5sd0tm9X1lLYX1Nq21ddWYM6hJ/IVFp0', '2014-11-27 15:29:12', '2014-11-27 15:29:12'),
(21, 'L00PING', 0, 'img_54787c0170c872.75623355.png', 'xav506@hotmail.fr', 'o2dwTGVGq1xTh2iBdjq6pQDz5kuzaOOvr/uoR.j.0Uth7GRUPYptNyITPCQCUeD8HYhqVT3KqeGYdrVhXKNNX1', '2014-11-28 14:43:30', '2014-11-28 14:43:30'),
(22, 'karakthur', 0, 'img_54788a2a696db5.57924610.jpg', 'aeyonas@gmail.com', 'SA8A1DziCiyQChO4Y8KBvCB3gLZTWUl/KdixxhZ8bVw6n3SPf/cmVXAspcaRCDpIHdrL/tM8EL1xSjEOVnXR1.', '2014-11-28 15:43:55', '2014-11-28 15:43:55'),
(23, 'DrWiz', 0, 'img_54788b79d7bc02.07216966.jpg', 'jacques.wisard@gmail.com', 'ePAiww3iNm857T1qIIhHibgx6OZDwiVGmTJ8ONG40kxDgPnBm7Kq.oipKbYdYp0nmOb/0VC3k7Ougd4FWTb4P0', '2014-11-28 15:49:30', '2014-11-28 15:49:30'),
(24, 'Dorago', 0, 'img_5479a19d3f6e66.16065583.jpg', 'rodrigo.lopez@windowslive.com', 'sN8kBK28SzU497jXqw7L44KYmZxJss1sqmfxA1apsHtfSqFtu07Q1KQ3RksX3JWAhGoaJ6uQXCYtSbvtbGGFN0', '2014-11-29 11:36:14', '2014-11-29 11:36:14'),
(26, 'YellowRoach', 0, 'img_547a091a7ab173.63576364.gif', 'games@visyr.ch', 'e8WXzIuvpxs0iA.YNiTjXX3pBZIE7lPBIcdBG5/AjM4WKe3ynUAnsqD1mOlxBcZCRawXhuABjsrABEbEm.KT90', '2014-11-29 18:57:23', '2014-11-29 18:57:23'),
(27, 'JimKayD', 0, 'img_547a118f3e8793.22744125.jpg', 'j.kaydlay@gmail.com', 'sYvacfmQwU6ldTFKqJuB15PX28oUoLOiUqUppcO/yMS306VeGjgJ/kU9b3HDLdTWsG39NlREgmZDLX3wQk.gu1', '2014-11-29 19:33:52', '2014-11-29 19:33:52'),
(28, 'leon09', 0, 'img_547a20460d96b6.70117997.jpg', 'jeanfrancoisquintin@hotmail.com', 'UEPzdIfibATdJ1.XrDCXRqW4hW3ZnBquAbO/akEHlPEYo5wFUyGwEL0ImvTpeiPDl2cenBaVGOvVWEOz5RZLr.', '2014-11-29 20:36:38', '2014-11-29 20:36:38'),
(29, 'Buzzbizard-306th', 0, 'img_547ae3105e64e8.91452082.jpg', 'lolowin17@hotmail.fr', 'aYnmdiwyMYuzd640ITEZlCVc3681Nc7EovxQznWTjdZTMfpXdScecfP0sSb0feSX.dJli33ZosLD/dgzDhAXO.', '2014-11-30 10:27:45', '2014-11-30 10:27:45'),
(30, 'Atri', 0, 'img_547b11458d0798.81066603.jpg', 'le_did_du_9_zero@hotmail.fr', 'n4ZFctRBD4rFLqhSSwtnIk8dsudFEz/BMcy9EO9OetM2pF3j89hFeyWBxtEvldKE7oYiHAPuMbgr9c6XKHW4Z.', '2014-11-30 13:44:54', '2014-11-30 13:44:54'),
(31, 'ROR', 0, 'img_547b43a12dc469.80360754.jpg', 'pourmesjeux111@gmail.com', '/ymatYicTcB7t465H9S6yk1nzIzi2/FuphD4BnwbGF8/WUBY.UoFK1lCs42SIRBylXIsgVXd6GXmqPVhMrPun1', '2014-11-30 17:19:46', '2014-11-30 17:19:46'),
(34, 'hawk', 0, 'img_547d84eb4a7c45.67349444.png', 'empireatwa2@free.fr', 'o2dwTGVGq1xTh2iBdjq6pQDz5kuzaOOvr/uoR.j.0Uth7GRUPYptNyITPCQCUeD8HYhqVT3KqeGYdrVhXKNNX1', '2014-12-02 10:22:51', '2014-12-02 10:22:51'),
(37, 'RINZLER971', 0, 'img_547edb11ab7871.19553958.png', 'empireatwar2@free.fr', 'o2dwTGVGq1xTh2iBdjq6pQDz5kuzaOOvr/uoR.j.0Uth7GRUPYptNyITPCQCUeD8HYhqVT3KqeGYdrVhXKNNX1', '2014-12-03 10:42:42', '2014-12-03 10:42:42');

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
(1, 24, 6, 0),
(1, 26, 6, 0),
(1, 27, 6, 0),
(1, 28, 1, 0),
(1, 29, 1, 0),
(1, 30, 1, 0),
(1, 31, 11, 0),
(1, 34, 1, 0),
(1, 37, 1, 0);

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
(2, NULL, 6, 50),
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
(1, NULL, 9, 43),
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
(1, NULL, 19, 10),
(1, NULL, 19, 14),
(1, NULL, 19, 17),
(1, NULL, 19, 22),
(1, NULL, 19, 39),
(1, NULL, 19, 43),
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
(1, NULL, 22, 43),
(1, NULL, 22, 50),
(1, NULL, 23, 2),
(1, NULL, 23, 7),
(1, NULL, 23, 27),
(1, NULL, 24, 7),
(1, NULL, 24, 8),
(1, NULL, 24, 17),
(1, NULL, 24, 23),
(1, NULL, 24, 30),
(1, NULL, 24, 40),
(1, NULL, 24, 42),
(1, NULL, 24, 43),
(1, NULL, 24, 44),
(1, NULL, 24, 47),
(1, NULL, 24, 49),
(2, NULL, 24, 50),
(1, NULL, 26, 3),
(1, NULL, 26, 17),
(1, NULL, 26, 27),
(1, NULL, 26, 34),
(1, NULL, 27, 8),
(1, NULL, 27, 15),
(1, NULL, 28, 25),
(1, NULL, 28, 29),
(1, NULL, 29, 2),
(1, NULL, 29, 8),
(1, NULL, 29, 21),
(1, NULL, 29, 29),
(1, NULL, 30, 25),
(1, NULL, 31, 14);

-- --------------------------------------------------------

--
-- Structure de la table `rsi_joueur_possede_vaisseau`
--

CREATE TABLE IF NOT EXISTS `rsi_joueur_possede_vaisseau` (
  `id_jv` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL DEFAULT '',
  `LTI` tinyint(1) DEFAULT NULL,
  `date_dispo` datetime DEFAULT NULL,
  `cargo` int(11) DEFAULT NULL,
  `autonomie` int(11) DEFAULT NULL,
  `coutReparation` int(11) DEFAULT NULL,
  `id_joueur` int(11) NOT NULL,
  `id_vaisseau` int(11) NOT NULL,
  PRIMARY KEY (`id_jv`),
  UNIQUE KEY `id_joueur` (`id_joueur`,`id_vaisseau`,`nom`),
  KEY `FK_rsi_joueur_possede_vaisseau_id_vaisseau` (`id_vaisseau`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=193 ;

--
-- Contenu de la table `rsi_joueur_possede_vaisseau`
--

INSERT INTO `rsi_joueur_possede_vaisseau` (`id_jv`, `nom`, `LTI`, `date_dispo`, `cargo`, `autonomie`, `coutReparation`, `id_joueur`, `id_vaisseau`) VALUES
(8, 'ship_547f1b9a03049', 0, NULL, NULL, NULL, NULL, 37, 14),
(11, 'eplucheur', 0, NULL, NULL, NULL, NULL, 37, 2),
(12, 'ship_547f1f591a4fa', 1, NULL, NULL, NULL, NULL, 37, 31),
(13, 'Hornet one', 1, NULL, 0, 0, 0, 1, 2),
(14, 'Cercueil volant', 1, NULL, 16, 0, 0, 1, 3),
(15, 'ship_547f2478e172d', 0, NULL, NULL, NULL, NULL, 2, 2),
(16, 'ship_547f247901604', 0, NULL, NULL, NULL, NULL, 2, 3),
(17, 'ship_547f247909929', 0, NULL, NULL, NULL, NULL, 2, 4),
(18, 'ship_547f2479117a3', 0, NULL, NULL, NULL, NULL, 2, 5),
(19, 'ship_547f247917a89', 0, NULL, NULL, NULL, NULL, 2, 7),
(20, 'ship_547f24791f998', 0, NULL, NULL, NULL, NULL, 2, 8),
(21, 'ship_547f247925c51', 0, NULL, NULL, NULL, NULL, 2, 12),
(22, 'ship_547f24792db2d', 0, NULL, NULL, NULL, NULL, 2, 16),
(23, 'ship_547f247933e2c', 0, NULL, NULL, NULL, NULL, 2, 18),
(24, 'ship_547f24793bd2c', 0, NULL, NULL, NULL, NULL, 2, 23),
(25, 'ship_547f24794206f', 0, NULL, NULL, NULL, NULL, 2, 27),
(26, 'ship_547f247956f7f', 0, NULL, NULL, NULL, NULL, 2, 30),
(27, 'ship_547f247966a96', 0, NULL, NULL, NULL, NULL, 2, 31),
(28, 'ship_547f24796f15a', 0, NULL, NULL, NULL, NULL, 2, 32),
(29, 'ship_547f24797e6e7', 0, NULL, NULL, NULL, NULL, 2, 33),
(30, 'ship_547f24798b480', 0, NULL, NULL, NULL, NULL, 2, 34),
(31, 'ship_547f2479b2faf', 0, NULL, NULL, NULL, NULL, 2, 35),
(32, 'ship_547f2479bee7d', 0, NULL, NULL, NULL, NULL, 2, 38),
(33, 'ship_547f2479c6f7f', 0, NULL, NULL, NULL, NULL, 2, 39),
(34, 'ship_547f2479cd201', 0, NULL, NULL, NULL, NULL, 2, 40),
(35, 'ship_547f2479d5142', 0, NULL, NULL, NULL, NULL, 2, 41),
(36, 'ship_547f2479db400', 0, NULL, NULL, NULL, NULL, 2, 42),
(37, 'ship_547f2479e331c', 0, NULL, NULL, NULL, NULL, 2, 50),
(38, 'ship_547f247a05949', 0, NULL, NULL, NULL, NULL, 2, 50),
(39, 'ship_547f247a0b61f', 0, NULL, NULL, NULL, NULL, 3, 12),
(40, 'ship_547f247a118ec', 0, NULL, NULL, NULL, NULL, 3, 15),
(41, 'ship_547f247a17796', 0, NULL, NULL, NULL, NULL, 3, 24),
(42, 'ship_547f247a2c06b', 0, NULL, NULL, NULL, NULL, 4, 15),
(43, 'ship_547f247a33b53', 0, NULL, NULL, NULL, NULL, 4, 25),
(44, 'ship_547f247a39e0a', 0, NULL, NULL, NULL, NULL, 4, 26),
(45, 'ship_547f247a3fcc6', 0, NULL, NULL, NULL, NULL, 5, 2),
(46, 'ship_547f247a45fac', 0, NULL, NULL, NULL, NULL, 5, 12),
(47, 'ship_547f247a4be70', 0, NULL, NULL, NULL, NULL, 5, 27),
(48, 'ship_547f247a52164', 0, NULL, NULL, NULL, NULL, 6, 2),
(49, 'ship_547f247a57fe5', 0, NULL, NULL, NULL, NULL, 6, 4),
(50, 'ship_547f247a5e2df', 0, NULL, NULL, NULL, NULL, 6, 8),
(51, 'ship_547f247a64198', 0, NULL, NULL, NULL, NULL, 6, 15),
(52, 'ship_547f247a6a459', 0, NULL, NULL, NULL, NULL, 6, 21),
(53, 'ship_547f247a7033b', 0, NULL, NULL, NULL, NULL, 6, 22),
(54, 'ship_547f247a7660f', 0, NULL, NULL, NULL, NULL, 6, 26),
(55, 'ship_547f247a7c4bc', 0, NULL, NULL, NULL, NULL, 6, 31),
(56, 'ship_547f247a82785', 0, NULL, NULL, NULL, NULL, 6, 32),
(57, 'ship_547f247a88669', 0, NULL, NULL, NULL, NULL, 6, 34),
(58, 'ship_547f247a8e920', 0, NULL, NULL, NULL, NULL, 6, 39),
(59, 'ship_547f247a94804', 0, NULL, NULL, NULL, NULL, 6, 40),
(60, 'ship_547f247a9aabc', 0, NULL, NULL, NULL, NULL, 6, 42),
(61, 'ship_547f247aa09b7', 0, NULL, NULL, NULL, NULL, 6, 44),
(62, 'ship_547f247aa6c47', 0, NULL, NULL, NULL, NULL, 6, 50),
(63, 'ship_547f247aacaf5', 0, NULL, NULL, NULL, NULL, 6, 50),
(64, 'ship_547f247ab2e24', 0, NULL, NULL, NULL, NULL, 7, 10),
(65, 'ship_547f247ab8c9e', 0, NULL, NULL, NULL, NULL, 7, 10),
(66, 'ship_547f247abefae', 0, NULL, NULL, NULL, NULL, 7, 14),
(67, 'ship_547f247ac4e51', 0, NULL, NULL, NULL, NULL, 7, 20),
(68, 'ship_547f247acb119', 0, NULL, NULL, NULL, NULL, 7, 25),
(69, 'ship_547f247ad0fe3', 0, NULL, NULL, NULL, NULL, 7, 25),
(70, 'ship_547f247ad72ef', 0, NULL, NULL, NULL, NULL, 7, 31),
(71, 'ship_547f247add195', 0, NULL, NULL, NULL, NULL, 8, 2),
(72, 'ship_547f247ae3486', 0, NULL, NULL, NULL, NULL, 8, 4),
(73, 'ship_547f247ae92f9', 0, NULL, NULL, NULL, NULL, 8, 13),
(74, 'ship_547f247aef5d9', 0, NULL, NULL, NULL, NULL, 8, 21),
(75, 'ship_547f247b01233', 0, NULL, NULL, NULL, NULL, 8, 29),
(76, 'ship_547f247b07590', 0, NULL, NULL, NULL, NULL, 9, 2),
(77, 'ship_547f247b15798', 0, NULL, NULL, NULL, NULL, 9, 3),
(78, 'ship_547f247b1f138', 0, NULL, NULL, NULL, NULL, 9, 4),
(79, 'ship_547f247b279bd', 0, NULL, NULL, NULL, NULL, 9, 7),
(80, 'ship_547f247b2d857', 0, NULL, NULL, NULL, NULL, 9, 8),
(81, 'ship_547f247b33b2e', 0, NULL, NULL, NULL, NULL, 9, 12),
(82, 'ship_547f247b399dc', 0, NULL, NULL, NULL, NULL, 9, 15),
(83, 'ship_547f247b3fc9e', 0, NULL, NULL, NULL, NULL, 9, 16),
(84, 'ship_547f247b45b81', 0, NULL, NULL, NULL, NULL, 9, 18),
(85, 'ship_547f247b4be4f', 0, NULL, NULL, NULL, NULL, 9, 21),
(86, 'ship_547f247b51ceb', 0, NULL, NULL, NULL, NULL, 9, 22),
(87, 'ship_547f247b57ff8', 0, NULL, NULL, NULL, NULL, 9, 27),
(88, 'ship_547f247b5dea1', 0, NULL, NULL, NULL, NULL, 9, 30),
(89, 'ship_547f247b64185', 0, NULL, NULL, NULL, NULL, 9, 31),
(90, 'ship_547f247b6a046', 0, NULL, NULL, NULL, NULL, 9, 32),
(91, 'ship_547f247b70307', 0, NULL, NULL, NULL, NULL, 9, 33),
(92, 'ship_547f247b761c5', 0, NULL, NULL, NULL, NULL, 9, 34),
(93, 'ship_547f247b7c4c1', 0, NULL, NULL, NULL, NULL, 9, 35),
(94, 'ship_547f247b82359', 0, NULL, NULL, NULL, NULL, 9, 38),
(95, 'ship_547f247b8a491', 0, NULL, NULL, NULL, NULL, 9, 39),
(96, 'ship_547f247b90341', 0, NULL, NULL, NULL, NULL, 9, 40),
(97, 'ship_547f247b96639', 0, NULL, NULL, NULL, NULL, 9, 41),
(98, 'ship_547f247b9c4ac', 0, NULL, NULL, NULL, NULL, 9, 43),
(99, 'ship_547f247ba6836', 0, NULL, NULL, NULL, NULL, 9, 44),
(100, 'ship_547f247bac6a7', 0, NULL, NULL, NULL, NULL, 9, 47),
(101, 'ship_547f247bb29d4', 0, NULL, NULL, NULL, NULL, 10, 31),
(102, 'ship_547f247bb8865', 0, NULL, NULL, NULL, NULL, 11, 3),
(103, 'ship_547f247bbeb44', 0, NULL, NULL, NULL, NULL, 11, 8),
(104, 'ship_547f247bc49f6', 0, NULL, NULL, NULL, NULL, 12, 11),
(105, 'ship_547f247bcacaf', 0, NULL, NULL, NULL, NULL, 13, 14),
(106, 'ship_547f247bd0b69', 0, NULL, NULL, NULL, NULL, 14, 23),
(107, 'ship_547f247bd6e8f', 0, NULL, NULL, NULL, NULL, 14, 35),
(108, 'ship_547f247bdcd1f', 0, NULL, NULL, NULL, NULL, 14, 39),
(109, 'ship_547f247be3019', 0, NULL, NULL, NULL, NULL, 14, 47),
(110, 'ship_547f247be8ecb', 0, NULL, NULL, NULL, NULL, 15, 5),
(111, 'ship_547f247bef1d2', 0, NULL, NULL, NULL, NULL, 15, 8),
(112, 'ship_547f247c0f034', 0, NULL, NULL, NULL, NULL, 15, 14),
(113, 'ship_547f247c1737c', 0, NULL, NULL, NULL, NULL, 15, 17),
(114, 'ship_547f247c1d1f8', 0, NULL, NULL, NULL, NULL, 15, 23),
(115, 'ship_547f247c234cc', 0, NULL, NULL, NULL, NULL, 15, 42),
(116, 'ship_547f247c29381', 0, NULL, NULL, NULL, NULL, 15, 47),
(117, 'ship_547f247c2f63e', 0, NULL, NULL, NULL, NULL, 16, 25),
(118, 'ship_547f247c3551b', 0, NULL, NULL, NULL, NULL, 17, 3),
(119, 'ship_547f247c3b7f8', 0, NULL, NULL, NULL, NULL, 17, 15),
(120, 'ship_547f247c416a2', 0, NULL, NULL, NULL, NULL, 18, 2),
(121, 'ship_547f247c47980', 0, NULL, NULL, NULL, NULL, 18, 15),
(122, 'ship_547f247c4d830', 0, NULL, NULL, NULL, NULL, 18, 29),
(123, 'ship_547f247c53af1', 0, NULL, NULL, NULL, NULL, 19, 5),
(124, 'ship_547f247c59a10', 0, NULL, NULL, NULL, NULL, 19, 10),
(125, 'ship_547f247c5fcdf', 0, NULL, NULL, NULL, NULL, 19, 14),
(126, 'ship_547f247c65b92', 0, NULL, NULL, NULL, NULL, 19, 17),
(127, 'ship_547f247c6be49', 0, NULL, NULL, NULL, NULL, 19, 22),
(128, 'ship_547f247c71d2b', 0, NULL, NULL, NULL, NULL, 19, 39),
(129, 'ship_547f247c77ff5', 0, NULL, NULL, NULL, NULL, 19, 43),
(130, 'ship_547f247c7deb9', 0, NULL, NULL, NULL, NULL, 20, 2),
(131, 'ship_547f247c8417a', 0, NULL, NULL, NULL, NULL, 20, 5),
(132, 'ship_547f247c8a022', 0, NULL, NULL, NULL, NULL, 20, 20),
(133, 'ship_547f247c9034c', 0, NULL, NULL, NULL, NULL, 20, 31),
(134, 'ship_547f247c9a265', 0, NULL, NULL, NULL, NULL, 20, 44),
(135, 'ship_547f247ca052a', 0, NULL, NULL, NULL, NULL, 21, 1),
(136, 'ship_547f247ca6419', 0, NULL, NULL, NULL, NULL, 21, 2),
(137, 'ship_547f247cac6d5', 0, NULL, NULL, NULL, NULL, 21, 3),
(138, 'ship_547f247cb2577', 0, NULL, NULL, NULL, NULL, 21, 4),
(139, 'ship_547f247cb885b', 0, NULL, NULL, NULL, NULL, 21, 7),
(140, 'ship_547f247cbe6c2', 0, NULL, NULL, NULL, NULL, 21, 8),
(141, 'ship_547f247cc4a1b', 0, NULL, NULL, NULL, NULL, 21, 15),
(142, 'ship_547f247cca8ce', 0, NULL, NULL, NULL, NULL, 21, 16),
(143, 'ship_547f247cd0b68', 0, NULL, NULL, NULL, NULL, 21, 22),
(144, 'ship_547f247cd6a52', 0, NULL, NULL, NULL, NULL, 21, 23),
(145, 'ship_547f247cdcd05', 0, NULL, NULL, NULL, NULL, 21, 26),
(146, 'ship_547f247ce2be1', 0, NULL, NULL, NULL, NULL, 21, 27),
(147, 'ship_547f247ce8e7e', 0, NULL, NULL, NULL, NULL, 21, 33),
(148, 'ship_547f247ceed76', 0, NULL, NULL, NULL, NULL, 21, 35),
(149, 'ship_547f247d00e28', 0, NULL, NULL, NULL, NULL, 21, 39),
(150, 'ship_547f247d06c99', 0, NULL, NULL, NULL, NULL, 21, 40),
(151, 'ship_547f247d0cfba', 0, NULL, NULL, NULL, NULL, 21, 42),
(152, 'ship_547f247d12e4d', 0, NULL, NULL, NULL, NULL, 21, 44),
(153, 'ship_547f247d1916e', 0, NULL, NULL, NULL, NULL, 21, 47),
(154, 'ship_547f247d23055', 0, NULL, NULL, NULL, NULL, 21, 49),
(155, 'ship_547f247d29336', 0, NULL, NULL, NULL, NULL, 21, 50),
(156, 'ship_547f247d2f247', 0, NULL, NULL, NULL, NULL, 21, 50),
(157, 'ship_547f247d3550e', 0, NULL, NULL, NULL, NULL, 22, 1),
(158, 'ship_547f247d3b3c3', 0, NULL, NULL, NULL, NULL, 22, 4),
(159, 'ship_547f247d41698', 0, NULL, NULL, NULL, NULL, 22, 35),
(160, 'ship_547f247d47540', 0, NULL, NULL, NULL, NULL, 22, 42),
(161, 'ship_547f247d4d82d', 0, NULL, NULL, NULL, NULL, 22, 43),
(162, 'ship_547f247d536eb', 0, NULL, NULL, NULL, NULL, 22, 50),
(163, 'ship_547f247d5999c', 0, NULL, NULL, NULL, NULL, 23, 2),
(164, 'ship_547f247d5f858', 0, NULL, NULL, NULL, NULL, 23, 7),
(165, 'ship_547f247d6605b', 0, NULL, NULL, NULL, NULL, 23, 27),
(166, 'ship_547f247d6da48', 0, NULL, NULL, NULL, NULL, 24, 7),
(167, 'ship_547f247d79e35', 0, NULL, NULL, NULL, NULL, 24, 8),
(168, 'ship_547f247d85a88', 0, NULL, NULL, NULL, NULL, 24, 17),
(169, 'ship_547f247d91e45', 0, NULL, NULL, NULL, NULL, 24, 23),
(170, 'ship_547f247d97ff1', 0, NULL, NULL, NULL, NULL, 24, 30),
(171, 'ship_547f247da0303', 0, NULL, NULL, NULL, NULL, 24, 40),
(172, 'ship_547f247da61f0', 0, NULL, NULL, NULL, NULL, 24, 42),
(173, 'ship_547f247dac4a1', 0, NULL, NULL, NULL, NULL, 24, 43),
(174, 'ship_547f247db2314', 0, NULL, NULL, NULL, NULL, 24, 44),
(175, 'ship_547f247dba461', 0, NULL, NULL, NULL, NULL, 24, 47),
(176, 'ship_547f247dc0355', 0, NULL, NULL, NULL, NULL, 24, 49),
(177, 'ship_547f247dc65c7', 0, NULL, NULL, NULL, NULL, 24, 50),
(178, 'ship_547f247dcc4a4', 0, NULL, NULL, NULL, NULL, 24, 50),
(179, 'ship_547f247dd27ed', 0, NULL, NULL, NULL, NULL, 26, 3),
(180, 'ship_547f247dd868e', 0, NULL, NULL, NULL, NULL, 26, 17),
(181, 'ship_547f247dde97e', 0, NULL, NULL, NULL, NULL, 26, 27),
(182, 'ship_547f247de4835', 0, NULL, NULL, NULL, NULL, 26, 34),
(183, 'ship_547f247deab18', 0, NULL, NULL, NULL, NULL, 27, 8),
(184, 'ship_547f247df09c8', 0, NULL, NULL, NULL, NULL, 27, 15),
(185, 'ship_547f247e02a47', 0, NULL, NULL, NULL, NULL, 28, 25),
(186, 'ship_547f247e08933', 0, NULL, NULL, NULL, NULL, 28, 29),
(187, 'ship_547f247e1cdfe', 0, NULL, NULL, NULL, NULL, 29, 2),
(188, 'ship_547f247e28d4d', 0, NULL, NULL, NULL, NULL, 29, 8),
(189, 'ship_547f247e330ba', 0, NULL, NULL, NULL, NULL, 29, 21),
(190, 'ship_547f247e38f3f', 0, NULL, NULL, NULL, NULL, 29, 29),
(191, 'ship_547f247e3f209', 0, NULL, NULL, NULL, NULL, 30, 25),
(192, 'ship_547f247e450d8', 0, NULL, NULL, NULL, NULL, 31, 14);

-- --------------------------------------------------------

--
-- Structure de la table `rsi_joueur_sortie`
--

CREATE TABLE IF NOT EXISTS `rsi_joueur_sortie` (
  `id_sortie` int(10) unsigned NOT NULL,
  `id_joueur` int(10) unsigned NOT NULL,
  `id_jv` int(10) unsigned NOT NULL,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`id_sortie`,`id_joueur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rsi_joueur_sortie`
--

INSERT INTO `rsi_joueur_sortie` (`id_sortie`, `id_joueur`, `id_jv`, `commentaire`) VALUES
(4, 1, 13, ''),
(6, 1, 14, '');

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
(1, 24),
(3, 24),
(4, 24),
(5, 24),
(7, 24),
(9, 24),
(10, 24),
(12, 24),
(1, 26),
(2, 26),
(3, 26),
(7, 26),
(10, 26),
(12, 26),
(10, 27),
(11, 28),
(3, 29),
(4, 29),
(9, 29),
(10, 30),
(2, 31),
(3, 31),
(10, 31),
(11, 31);

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
-- Structure de la table `rsi_sortie`
--

CREATE TABLE IF NOT EXISTS `rsi_sortie` (
  `id_sortie` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_organisateur` int(10) unsigned NOT NULL,
  `id_teamspeak` int(10) unsigned NOT NULL,
  `titre` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime DEFAULT NULL,
  `visibilite` enum('1','2','3') NOT NULL DEFAULT '3' COMMENT '1: team; 2: team+ allié; 3: tous',
  PRIMARY KEY (`id_sortie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `rsi_sortie`
--

INSERT INTO `rsi_sortie` (`id_sortie`, `id_organisateur`, `id_teamspeak`, `titre`, `detail`, `debut`, `fin`, `visibilite`) VALUES
(1, 31, 2, 'entrainement vol en formation', 'super', '2015-01-20 21:00:00', '2015-01-20 23:59:00', '3'),
(2, 1, 1, 'organisation TS', '', '2015-01-20 20:59:00', '2015-01-20 21:05:00', '3'),
(3, 2, 1, 'team only', 'tt', '2015-01-23 21:00:00', '2015-01-23 23:59:00', '2'),
(6, 1, 1, 'entrainement vol en formation', 'cool', '2015-02-03 15:00:00', '2015-02-03 23:59:00', '3');

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
-- Structure de la table `rsi_teamspeak`
--

CREATE TABLE IF NOT EXISTS `rsi_teamspeak` (
  `id_teamspeak` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_teamspeak`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `rsi_teamspeak`
--

INSERT INTO `rsi_teamspeak` (`id_teamspeak`, `label`, `url`) VALUES
(1, 'TS StarPirates', 'ts3server://ts3.starpirates.fr?port=9987'),
(2, 'TS FEU', 'ts3server://ts3.FEU.fr?port=9987');

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
-- Contraintes pour la table `rsi_joueur_possede_vaisseau`
--
ALTER TABLE `rsi_joueur_possede_vaisseau`
  ADD CONSTRAINT `FK_rsi_joueur_possede_vaisseau_id_joueur` FOREIGN KEY (`id_joueur`) REFERENCES `rsi_joueur` (`id_joueur`),
  ADD CONSTRAINT `FK_rsi_joueur_possede_vaisseau_id_vaisseau` FOREIGN KEY (`id_vaisseau`) REFERENCES `rsi_vaisseau` (`id_vaisseau`);

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
