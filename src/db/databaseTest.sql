/* insertion d'un utilisateur */
INSERT INTO `user` (`id`, `login`, `password`, `name`, `surname`, `mail`) VALUES
(1, 'Walterdu33', 'test1122', 'Walter', 'Junior', 'testmail@mail.fr');

/* insertion d'un projet */
INSERT INTO `project` (`id`, `name`, `owner`, `master`, `last_update`, `creation_date`, `repository_link`) VALUES
(3, 'Test', 1, 1, '2016-10-20 07:14:00', '2016-10-12 00:00:00', 'github.fr/112133');

/* insertion d'une tâche */
INSERT INTO `task` (`id`, `description`, `developper_id`, `sprint`, `duration`) VALUES (1, 'Tâche 1 : test', '1', '1', '2');


/* insertion d'une US */
INSERT INTO `us` (`id`, `description`, `priority`, `cost`, `sprint`) VALUES ('1', 'US 1 : Test', '1', '2', '1');
