USE mydatabase;

CREATE TABLE IF NOT EXIST `mydatabase`.`users` (
  `id` INT(255) NOT NULL DEFAULT '1' AUTO_INCREMENT, 
  `name` VARCHAR(255) NOT NULL , 
  `email` VARCHAR(255) NOT NULL , 
  `password_hash` VARCHAR(255) NOT NULL , 
  UNIQUE `email` (`email`(255)),
  PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;