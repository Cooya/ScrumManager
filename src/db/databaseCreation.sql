/* suppression de la base de données "scrummanager" si elle existe */
DROP DATABASE scrummanager;

/* création de la base de données "scrummanager" */
CREATE DATABASE scrummanager;
USE scrummanager;

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
	`login` varchar(20) UNIQUE NOT NULL,
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

/* ajout de la table "task" */
CREATE TABLE `task` (
	`id` int(80) unsigned NOT NULL AUTO_INCREMENT,
	`projectId` int(80) unsigned DEFAULT NULL,
	`description` varchar(80) NOT NULL,
	`developerId` int(80) unsigned DEFAULT NULL,
	`sprint` int(80) NOT NULL,
	`status` int(80) NOT NULL,
	`duration` int(80) NOT NULL,
	PRIMARY KEY (`id`),
	KEY `projectId` (`projectId`),
	KEY `developerId` (`developerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/* ajout de la table "us" */
CREATE TABLE `us` (
	`id` int(80) NOT NULL,
	`projectId` int(80) unsigned NOT NULL,
	`description` varchar(80) NOT NULL,
	`priority` int(80) DEFAULT NULL,
	`cost` int(80) DEFAULT NULL,
	`sprint` int(80) NOT NULL,
	PRIMARY KEY (`id`),
	KEY `projectId` (`projectId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/* contraintes pour la table "project" */
ALTER TABLE `project`
	ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`),
	ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`master`) REFERENCES `user` (`id`);

/* contraintes pour la table "project" */
ALTER TABLE `contributor`
	ADD CONSTRAINT `contributor_ibfk_1` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`),
	ADD CONSTRAINT `contributor_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

/* contraintes pour la table "task" */
ALTER TABLE `task`
	ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`developerId`) REFERENCES `user` (`id`),
	ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`);

/* contraintes pour la table "us" */
ALTER TABLE `us`
	ADD CONSTRAINT `us_ibfk_1` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`);