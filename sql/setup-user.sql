USE phkl16;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `name` VARCHAR(250) NOT NULL,
  `pass` VARCHAR(250) NOT NULL,
  `email` VARCHAR(250),
  
	UNIQUE KEY `name_unique` (`name`),
    KEY `email_index` (`email`)
  
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

ALTER TABLE users ADD CONSTRAINT name_unique UNIQUE (`name`);

CREATE INDEX email_index ON users(`email`);

EXPLAIN SELECT * FROM users WHERE `email` = "philip.klingzell@gmail.com";

