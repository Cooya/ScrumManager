/* suppression de la base de données "scrummanager" si elle existe */
DROP DATABASE ScrumManager;

/* création de la base de données "scrummanager" */
CREATE DATABASE ScrumManager;
USE ScrumManager;

/* ajout de la table "project" */
CREATE TABLE `project` (
	`id` int(80) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(80) NOT NULL,
	`owner` int(80) unsigned,
	`master` int(80) unsigned NOT NULL,
	`last_update` datetime,
	`creation_date` datetime NOT NULL,
	`repository_link` varchar(80) NOT NULL,
	PRIMARY KEY (`id`),
	KEY `owner` (`owner`),
	KEY `master` (`master`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

/* ajout de la table "user" */
CREATE TABLE `user` (
	`id` int(80) unsigned NOT NULL AUTO_INCREMENT,
	`login` varchar(20) NOT NULL,
	`password` varchar(80) NOT NULL,
	`name` varchar(80) NOT NULL,
	`surname` text NOT NULL,
	`mail` varchar(80) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

/* ajout de la table "contributor" */
CREATE TABLE `contributor` (
	`projectId` int(80) unsigned NOT NULL,
	`userId` int(80) unsigned NOT NULL,
	PRIMARY KEY (`projectId`, `userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

/* contraintes pour la table "project" */
ALTER TABLE `project`
	ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`),
	ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`master`) REFERENCES `user` (`id`);

/* contraintes pour la table "project" */
ALTER TABLE `contributor`
	ADD CONSTRAINT `contributor_ibfk_1` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`),
	ADD CONSTRAINT `contributor_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);