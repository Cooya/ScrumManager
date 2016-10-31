/* création de la base de données "scrummanager" */
CREATE DATABASE IF NOT EXISTS ScrumManager;
USE ScrumManager;

/* ajout de la table "project" */
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

/* ajout de la table "user" */
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(80) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `surname` text NOT NULL,
  `mail` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;

/* contraintes pour la table "project" */
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_3` FOREIGN KEY (`contributors`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`master`) REFERENCES `user` (`id`);