CREATE TABLE `nse_test`.`userinfo` (
  `userinfoid` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `mobile` VARCHAR(10) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `filename` VARCHAR(255) NULL DEFAULT NULL,
  `is_active` BIT(1) NOT NULL DEFAULT b'1',
  `is_soft_delete` BIT(1) NOT NULL DEFAULT b'0',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`userinfoid`));

  