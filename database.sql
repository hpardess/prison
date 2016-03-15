SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `prison` ;
CREATE SCHEMA IF NOT EXISTS `prison` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `prison` ;

-- -----------------------------------------------------
-- Table `prison`.`groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`groups` ;

CREATE TABLE IF NOT EXISTS `prison`.`groups` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '	',
  `group_name` VARCHAR(45) NULL,
  `prisoner_new` TINYINT(1) NULL,
  `prisoner_delete` TINYINT(1) NULL,
  `prisoner_edit` TINYINT(1) NULL,
  `prisoner_view` TINYINT(1) NULL,
  `crime_new` TINYINT(1) NULL,
  `crime_view` TINYINT(1) NULL,
  `crime_edit` TINYINT(1) NULL,
  `crime_delete` TINYINT(1) NULL,
  `prisoner_unlock` TINYINT(1) NULL,
  `crime_unlock` TINYINT(1) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`user` ;

CREATE TABLE IF NOT EXISTS `prison`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(45) NULL,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `isadmin` VARCHAR(45) NULL,
  `groups_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_groups1_idx` (`groups_id` ASC),
  CONSTRAINT `fk_user_groups1`
    FOREIGN KEY (`groups_id`)
    REFERENCES `prison`.`groups` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`district`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`district` ;

CREATE TABLE IF NOT EXISTS `prison`.`district` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`province`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`province` ;

CREATE TABLE IF NOT EXISTS `prison`.`province` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `district_id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_province_district1_idx` (`district_id` ASC),
  CONSTRAINT `fk_province_district1`
    FOREIGN KEY (`district_id`)
    REFERENCES `prison`.`district` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`crime`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`crime` ;

CREATE TABLE IF NOT EXISTS `prison`.`crime` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `crime_date` TIMESTAMP NULL,
  `crime_location` VARCHAR(70) NULL,
  `arrist_location` VARCHAR(70) NULL,
  `police_custody` VARCHAR(70) NULL,
  `crime_province_id` INT NOT NULL,
  `crime_district_id` INT NOT NULL,
  `arrist_province_id` INT NOT NULL,
  `arrist_district_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_crime_province1_idx` (`crime_province_id` ASC),
  INDEX `fk_crime_district1_idx` (`crime_district_id` ASC),
  INDEX `fk_crime_province2_idx` (`arrist_province_id` ASC),
  INDEX `fk_crime_district2_idx` (`arrist_district_id` ASC),
  CONSTRAINT `fk_crime_province1`
    FOREIGN KEY (`crime_province_id`)
    REFERENCES `prison`.`province` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_crime_district1`
    FOREIGN KEY (`crime_district_id`)
    REFERENCES `prison`.`district` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_crime_province2`
    FOREIGN KEY (`arrist_province_id`)
    REFERENCES `prison`.`province` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_crime_district2`
    FOREIGN KEY (`arrist_district_id`)
    REFERENCES `prison`.`district` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`marital_status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`marital_status` ;

CREATE TABLE IF NOT EXISTS `prison`.`marital_status` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`prisoner`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`prisoner` ;

CREATE TABLE IF NOT EXISTS `prison`.`prisoner` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `marital_status_id` INT NOT NULL,
  `present_province_id` INT NOT NULL,
  `present_district_id` INT NOT NULL,
  `permanent_province_id` INT NOT NULL,
  `permanent_district_id` INT NOT NULL,
  `name` VARCHAR(70) NULL,
  `father_name` VARCHAR(70) NULL,
  `grand_father_name` VARCHAR(70) NULL,
  `age` INT NULL,
  `criminal_history` TINYINT(1) NULL,
  `num_of_children` INT NULL,
  `profile_pic` VARCHAR(200) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_prisoner_marital_status1_idx` (`marital_status_id` ASC),
  INDEX `fk_prisoner_province1_idx` (`present_province_id` ASC),
  INDEX `fk_prisoner_district1_idx` (`present_district_id` ASC),
  INDEX `fk_prisoner_province2_idx` (`permanent_province_id` ASC),
  INDEX `fk_prisoner_district2_idx` (`permanent_district_id` ASC),
  CONSTRAINT `fk_prisoner_marital_status1`
    FOREIGN KEY (`marital_status_id`)
    REFERENCES `prison`.`marital_status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prisoner_province1`
    FOREIGN KEY (`present_province_id`)
    REFERENCES `prison`.`province` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prisoner_district1`
    FOREIGN KEY (`present_district_id`)
    REFERENCES `prison`.`district` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prisoner_province2`
    FOREIGN KEY (`permanent_province_id`)
    REFERENCES `prison`.`province` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prisoner_district2`
    FOREIGN KEY (`permanent_district_id`)
    REFERENCES `prison`.`district` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`crime_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`crime_type` ;

CREATE TABLE IF NOT EXISTS `prison`.`crime_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type_name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`court_decision_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`court_decision_type` ;

CREATE TABLE IF NOT EXISTS `prison`.`court_decision_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `decision_type_name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`court_session`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`court_session` ;

CREATE TABLE IF NOT EXISTS `prison`.`court_session` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `crime_id` INT NOT NULL,
  `court_decision_type_id` INT NOT NULL,
  `date` DATE NULL,
  `defence_lawyer_name` VARCHAR(70) NULL,
  `defence_lawyer_certificate_id` VARCHAR(70) NULL,
  PRIMARY KEY (`id`, `crime_id`, `court_decision_type_id`),
  INDEX `fk_court_session_crime1_idx` (`crime_id` ASC),
  INDEX `fk_court_session_court_decision_type1_idx` (`court_decision_type_id` ASC),
  CONSTRAINT `fk_court_session_crime1`
    FOREIGN KEY (`crime_id`)
    REFERENCES `prison`.`crime` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_court_session_court_decision_type1`
    FOREIGN KEY (`court_decision_type_id`)
    REFERENCES `prison`.`court_decision_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`crime_prisoner`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`crime_prisoner` ;

CREATE TABLE IF NOT EXISTS `prison`.`crime_prisoner` (
  `crime_id` INT NOT NULL,
  `prisoner_id` INT NOT NULL,
  PRIMARY KEY (`crime_id`, `prisoner_id`),
  INDEX `fk_crime_has_prisoner_prisoner1_idx` (`prisoner_id` ASC),
  INDEX `fk_crime_has_prisoner_crime_idx` (`crime_id` ASC),
  CONSTRAINT `fk_crime_has_prisoner_crime`
    FOREIGN KEY (`crime_id`)
    REFERENCES `prison`.`crime` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_crime_has_prisoner_prisoner1`
    FOREIGN KEY (`prisoner_id`)
    REFERENCES `prison`.`prisoner` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`crime_crime_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`crime_crime_type` ;

CREATE TABLE IF NOT EXISTS `prison`.`crime_crime_type` (
  `crime_id` INT NOT NULL,
  `crime_type_id` INT NOT NULL,
  PRIMARY KEY (`crime_id`, `crime_type_id`),
  INDEX `fk_crime_has_crime_type_crime_type1_idx` (`crime_type_id` ASC),
  INDEX `fk_crime_has_crime_type_crime1_idx` (`crime_id` ASC),
  CONSTRAINT `fk_crime_has_crime_type_crime1`
    FOREIGN KEY (`crime_id`)
    REFERENCES `prison`.`crime` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_crime_has_crime_type_crime_type1`
    FOREIGN KEY (`crime_type_id`)
    REFERENCES `prison`.`crime_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`official_command_discount`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`official_command_discount` ;

CREATE TABLE IF NOT EXISTS `prison`.`official_command_discount` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `command_issue_date` DATE NULL,
  `discription` VARCHAR(200) NULL,
  `years` INT NULL,
  `months` INT NULL,
  `days` INT NULL,
  `crime_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_official_command_crime1_idx` (`crime_id` ASC),
  CONSTRAINT `fk_official_command_crime1`
    FOREIGN KEY (`crime_id`)
    REFERENCES `prison`.`crime` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;












--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `prisoner_new`, `prisoner_delete`, `prisoner_edit`, `prisoner_view`, `crime_new`, `crime_view`, `crime_edit`, `crime_delete`, `prisoner_unlock`, `crime_unlock`) VALUES
(1, 'Admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'Supervisor', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 'Data Entry', 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
(5, 'Staff', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL);

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `password`, `isadmin`, `email`, `groups_id`) VALUES
(1, 'Hameedullah', 'Pardess', 'hpardess', '9a69e50114a30c4c5c1d455a2cfb87d1', 1, NULL, 1),
(2, 'Naser', 'Rawan', 'naserrawan', '9a69e50114a30c4c5c1d455a2cfb87d1', 0, NULL, 2);

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`id`, `status`) VALUES
(1, 'Single'),
(2, 'Married'),
(3, 'Widow');

--
-- Dumping data for table `crime_type`
--

INSERT INTO `crime_type` (`id`, `type_name`) VALUES
(1, 'Murder'),
(2, 'Rape'),
(3, 'Kidnap'),
(4, 'Escape');

