/* insertion d'un utilisateur */
INSERT INTO `user` (`id`, `login`, `password`, `name`, `surname`, `mail`) VALUES
(1, 'Test_001', 'test1122', 'Walter', 'Junior', 'testmail@mail.fr');

/* insertion d'un projet */
INSERT INTO `project` (`id`, `name`, `owner`, `master`, `contributors`, `last_update`, `creation_date`, `repository_link`) VALUES
(3, 'Project de test', 1, 1, 1, '2016-10-20 07:14:00', '2016-10-12 00:00:00', 'github.fr/112133');