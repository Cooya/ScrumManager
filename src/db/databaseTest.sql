/* insertion d'un utilisateur */
INSERT INTO `user` (`id`, `login`, `password`, `name`, `surname`, `mail`) VALUES
(1, 'Walterdu33', 'test1122', 'Walter', 'Junior', 'testmail@mail.fr');

/* insertion d'un projet */
INSERT INTO `project` (`id`, `name`, `owner`, `master`, `last_update`, `creation_date`, `repository_link`) VALUES
(3, 'Test', 1, 1, '2016-10-20 07:14:00', '2016-10-12 00:00:00', 'github.fr/112133');

/* insertion d'une tâche */
INSERT INTO `task` (`id`, `projectId`, `description`, `developerId`, `sprint`, `duration`) VALUES ('1', '3', 'Création de la vue ...', '1', '1', '2');

/* insertion d'une US */
INSERT INTO `us` (`id`, `specificId`, `projectId`, `description`, `priority`, `cost`, `done`, `sprint`) VALUES ('1', '1', '3', 'test ', '1', '2', '0', '1'); 

/* insertion d'une documentation */
INSERT INTO `documentation` (`id`, `projectId`, `description`) VALUES ('1', '1', 'ceci est un projet qui de test, il a pour but .....');