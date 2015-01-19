-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 19 Janvier 2015 à 16:04
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
-- Structure de la table `rsi_sortie`
--

DROP TABLE IF EXISTS `rsi_sortie`;
CREATE TABLE IF NOT EXISTS `rsi_sortie` (
  `id_sortie` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_organisateur` int(10) unsigned NOT NULL,
  `id_teamspeak` int(10) unsigned NOT NULL,
  `titre` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sortie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `rsi_sortie`
--

INSERT INTO `rsi_sortie` (`id_sortie`, `id_organisateur`, `id_teamspeak`, `titre`, `detail`, `debut`, `fin`) VALUES
(1, 1, 2, 'entrainement vol en formation', 'super', '2015-01-20 21:00:00', '2015-01-20 23:59:00');

-- --------------------------------------------------------

--
-- Structure de la table `rsi_teamspeak`
--

DROP TABLE IF EXISTS `rsi_teamspeak`;
CREATE TABLE IF NOT EXISTS `rsi_teamspeak` (
  `id_teamspeak` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_teamspeak`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `rsi_teamspeak`
--

INSERT INTO `rsi_teamspeak` (`id_teamspeak`, `url`) VALUES
(1, 'ts3server://ts3.starpirates.fr?port=9987'),
(2, 'ts3server://ts3.FEU.fr?port=9987');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
