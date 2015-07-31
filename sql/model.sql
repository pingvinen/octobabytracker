
CREATE TABLE `feedings` (
  `id` CHAR(40) NOT NULL,
  `date_time` DATETIME NOT NULL,
  `breast_left` SMALLINT UNSIGNED NULL,
  `breast_right` SMALLINT UNSIGNED NULL,
  `milking` SMALLINT UNSIGNED NULL,
  `pee` SMALLINT UNSIGNED NULL,
  `poo` SMALLINT UNSIGNED NULL,
  `bottle` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `feedings_datetime_idx` (`date_time` ASC)
);
