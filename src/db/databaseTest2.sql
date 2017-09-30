USE scrummanager;

INSERT INTO `user` (`id`, `login`, `password`, `name`, `surname`, `mail`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test', 'test', 'tomdupont@fake.com');
INSERT INTO `project` (`id`, `name`, `owner`, `master`, `last_update`, `creation_date`, `repository_link`) VALUES
(1, 'Mega Project', NULL, 1, '2016-10-20 07:14:00', '2016-10-12 00:00:00', 'github.fr/fake');
INSERT INTO `us` (`id`, `specificId`, `projectId`, `description`, `priority`, `cost`, `done`, `sprint`) VALUES ('1', '1', '1', 'test', '1', '3', '0', '1'); 
INSERT INTO `us` (`id`, `specificId`, `projectId`, `description`, `priority`, `cost`, `done`, `sprint`) VALUES ('2', '2', '1', 'test', '1', '4', '1', '1'); 
INSERT INTO `us` (`id`, `specificId`, `projectId`, `description`, `priority`, `cost`, `done`, `sprint`) VALUES ('3', '3', '1', 'test', '1', '6', '1', '1'); 
INSERT INTO `us` (`id`, `specificId`, `projectId`, `description`, `priority`, `cost`, `done`, `sprint`) VALUES ('4', '4', '1', 'test', '1', '2', '0', '2'); 
INSERT INTO `us` (`id`, `specificId`, `projectId`, `description`, `priority`, `cost`, `done`, `sprint`) VALUES ('5', '5', '1', 'test', '1', '8', '1', '2'); 
INSERT INTO `us` (`id`, `specificId`, `projectId`, `description`, `priority`, `cost`, `done`, `sprint`) VALUES ('6', '6', '1', 'test', '1', '8', '1', '2'); 
INSERT INTO `us` (`id`, `specificId`, `projectId`, `description`, `priority`, `cost`, `done`, `sprint`) VALUES ('7', '7', '1', 'test', '1', '7', '0', '3'); 
INSERT INTO `us` (`id`, `specificId`, `projectId`, `description`, `priority`, `cost`, `done`, `sprint`) VALUES ('8', '8', '1', 'test', '1', '5', '0', '3'); 
INSERT INTO `us` (`id`, `specificId`, `projectId`, `description`, `priority`, `cost`, `done`, `sprint`) VALUES ('9', '9', '1', 'test', '1', '3', '1', '3'); 
INSERT INTO `us` (`id`, `specificId`, `projectId`, `description`, `priority`, `cost`, `done`, `sprint`) VALUES ('10', '10', '1', 'test', '1', '3', '0', '3'); 