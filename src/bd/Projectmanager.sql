-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 24 Octobre 2016 à 14:18
-- Version du serveur: 5.5.47-0ubuntu0.14.04.1
-- Version de PHP: 5.5.32-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `Projectmanager`
--

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(80) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `owner` int(80) unsigned NOT NULL,
  `master` int(80) unsigned NOT NULL,
  `contributors` int(80) unsigned NOT NULL,
  `last_update` datetime NOT NULL,
  `creation_date` datetime NOT NULL,
  `repository_link` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`),
  KEY `master` (`master`),
  KEY `contributors` (`contributors`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `project`
--

INSERT INTO `project` (`id`, `name`, `owner`, `master`, `contributors`, `last_update`, `creation_date`, `repository_link`) VALUES
(3, 'Project de test', 1, 1, 1, '2016-10-20 07:14:00', '2016-10-12 00:00:00', 'github.fr/112133');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(80) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `surname` text NOT NULL,
  `mail` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `name`, `surname`, `mail`) VALUES
(1, 'Test_001', 'test1122', 'Walter', 'Junior', 'testmail@mail.fr');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_3` FOREIGN KEY (`contributors`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`master`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
