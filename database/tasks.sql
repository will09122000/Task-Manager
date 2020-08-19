CREATE TABLE `wc352`.`tasks` (
  `id` INT NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `desciprtion` MEDIUMTEXT NULL DEFAULT NULL,
  `due_date` DATETIME NOT NULL,
  `done` TINYINT(4) NOT NULL,
  `remote_task_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`));