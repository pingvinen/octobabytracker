
CREATE TABLE `feedings` (
  `id` CHAR(40) NOT NULL,
  `date_time` DATETIME NOT NULL,
  `status` VARCHAR(255) NOT NULL,
  `breast_left` SMALLINT UNSIGNED NULL,
  `breast_right` SMALLINT UNSIGNED NULL,
  `milking` SMALLINT UNSIGNED NULL,
  `pee` SMALLINT UNSIGNED NULL,
  `poo` SMALLINT UNSIGNED NULL,
  `bottle` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `feedings_datetime_idx` (`date_time` ASC)
);

CREATE TABLE `timings` (
  `id` CHAR(40) NOT NULL,
  `feeding_id` CHAR(40) NOT NULL,
  `started_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `timings_feedingid_idx` (`feeding_id` ASC)
);
