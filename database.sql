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
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '  ',
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
  `court_session_new` TINYINT(1) NULL,
  `court_session_view` TINYINT(1) NULL,
  `court_session_edit` TINYINT(1) NULL,
  `court_session_delete` TINYINT(1) NULL,
  `court_session_unlock` TINYINT(1) NULL,
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
-- Table `prison`.`province`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`province` ;

CREATE TABLE IF NOT EXISTS `prison`.`province` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name_english` VARCHAR(45) NULL,
  `name_dari` VARCHAR(45) NULL,
  `name_pashto` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`district`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`district` ;

CREATE TABLE IF NOT EXISTS `prison`.`district` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name_english` VARCHAR(45) NULL,
  `province_id` INT NOT NULL,
  `name_dari` VARCHAR(45) NULL,
  `name_pashto` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_district_province1_idx` (`province_id` ASC),
  CONSTRAINT `fk_district_province1`
    FOREIGN KEY (`province_id`)
    REFERENCES `prison`.`province` (`id`)
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
  `crime_date_shamsi` VARCHAR(45) NULL,
  `arrest_date` TIMESTAMP NULL,
  `arrest_date_shamsi` VARCHAR(45) NULL,
  `crime_location` VARCHAR(70) NULL,
  `arrest_location` VARCHAR(70) NULL,
  `police_custody` VARCHAR(70) NULL,
  `crime_province_id` INT NOT NULL,
  `crime_district_id` INT NOT NULL,
  `arrest_province_id` INT NOT NULL,
  `arrest_district_id` INT NOT NULL,
  `case_number` VARCHAR(45) NULL,
  `time_spent_in_prison` VARCHAR(45) NULL,
  `remaining_jail_term` VARCHAR(45) NULL,
  `use_benefit_forgiveness_presidential` VARCHAR(200) NULL,
  `command_issue_date` VARCHAR(45) NULL,
  `command_issue_date_shamsi` VARCHAR(45) NULL,
  `commission_proposal` VARCHAR(200) NULL,
  `prisoner_request` VARCHAR(200) NULL,
  `commission_member` VARCHAR(200) NULL,
  `registration_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `crime_reason` VARCHAR(300) NULL,
  `crime_supporter` VARCHAR(200) NULL,
  `locked` TINYINT(1) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_crime_province1_idx` (`crime_province_id` ASC),
  INDEX `fk_crime_district1_idx` (`crime_district_id` ASC),
  INDEX `fk_crime_province2_idx` (`arrest_province_id` ASC),
  INDEX `fk_crime_district2_idx` (`arrest_district_id` ASC),
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
    FOREIGN KEY (`arrest_province_id`)
    REFERENCES `prison`.`province` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_crime_district2`
    FOREIGN KEY (`arrest_district_id`)
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
  `status_english` VARCHAR(45) NULL,
  `status_dari` VARCHAR(45) NULL,
  `status_pashto` VARCHAR(45) NULL,
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
  `locked` TINYINT(1) NULL,
  `tazkira_number` VARCHAR(30) NULL,
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
  `type_name_english` VARCHAR(45) NULL,
  `type_name_dari` VARCHAR(45) NULL,
  `type_name_pashto` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`court_decision_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`court_decision_type` ;

CREATE TABLE IF NOT EXISTS `prison`.`court_decision_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `decision_type_name_english` VARCHAR(45) NULL,
  `decision_type_name_dari` VARCHAR(45) NULL,
  `decision_type_name_pashto` VARCHAR(45) NULL,
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
  `decision_date` TIMESTAMP NULL,
  `decision_date_shamsi` VARCHAR(45) NULL,
  `defence_lawyer_name` VARCHAR(70) NULL,
  `defence_lawyer_certificate_id` VARCHAR(70) NULL,
  `decision` VARCHAR(1000) NULL,
  `sentence_execution_date` TIMESTAMP NULL,
  `sentence_execution_date_shamsi` VARCHAR(45) NULL,
  `locked` TINYINT(1) NULL,
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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;







-- --------------------------------------------------------

--
-- Structure for view `prisoner_view`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prisoner_view` AS select `prisoner`.`id` AS `id`,`prisoner`.`tazkira_number` AS `tazkira_number`,`prisoner`.`marital_status_id` AS `marital_status_id`,`marital_status`.`status_english` AS `marital_status_english`,`marital_status`.`status_dari` AS `marital_status_dari`,`marital_status`.`status_pashto` AS `marital_status_pashto`,`prisoner`.`present_province_id` AS `present_province_id`,`present_province`.`name_english` AS `present_province_english`,`present_province`.`name_dari` AS `present_province_dari`,`present_province`.`name_pashto` AS `present_province_pashto`,`prisoner`.`present_district_id` AS `present_district_id`,`present_district`.`name_english` AS `present_district_english`,`present_district`.`name_dari` AS `present_district_dari`,`present_district`.`name_pashto` AS `present_district_pashto`,`prisoner`.`permanent_province_id` AS `permanent_province_id`,`permanent_province`.`name_english` AS `permanent_province_english`,`permanent_province`.`name_dari` AS `permanent_province_dari`,`permanent_province`.`name_pashto` AS `permanent_province_pashto`,`prisoner`.`permanent_district_id` AS `permanent_district_id`,`permanent_district`.`name_english` AS `permanent_district_english`,`permanent_district`.`name_dari` AS `permanent_district_dari`,`permanent_district`.`name_pashto` AS `permanent_district_pashto`,`prisoner`.`name` AS `name`,`prisoner`.`father_name` AS `father_name`,`prisoner`.`grand_father_name` AS `grand_father_name`,`prisoner`.`age` AS `age`,`prisoner`.`criminal_history` AS `criminal_history`,`prisoner`.`num_of_children` AS `num_of_children`,`prisoner`.`profile_pic` AS `profile_pic`,`prisoner`.`locked` AS `locked` from (((((`prisoner` join `marital_status` on((`marital_status`.`id` = `prisoner`.`marital_status_id`))) join `province` `present_province` on((`present_province`.`id` = `prisoner`.`present_province_id`))) join `district` `present_district` on((`present_district`.`id` = `prisoner`.`present_district_id`))) join `province` `permanent_province` on((`permanent_province`.`id` = `prisoner`.`permanent_province_id`))) join `district` `permanent_district` on((`permanent_district`.`id` = `prisoner`.`permanent_district_id`))) order by `prisoner`.`id`;

--
-- VIEW  `prisoner_view`
-- Data: None
--

/*
CREATE or REPLACE VIEW `prisoner_view` AS select 
`prisoner`.`id` AS `id`,
`prisoner`.`tazkira_number` AS `tazkira_number`,
`prisoner`.`marital_status_id` AS `marital_status_id`,
`marital_status`.`status_english` AS `marital_status_english`,
`marital_status`.`status_dari` AS `marital_status_dari`,
`marital_status`.`status_pashto` AS `marital_status_pashto`,
`prisoner`.`present_province_id` AS `present_province_id`,
`present_province`.`name_english` AS `present_province_english`,
`present_province`.`name_dari` AS `present_province_dari`,
`present_province`.`name_pashto` AS `present_province_pashto`,
`prisoner`.`present_district_id` AS `present_district_id`,
`present_district`.`name_english` AS `present_district_english`,
`present_district`.`name_dari` AS `present_district_dari`,
`present_district`.`name_pashto` AS `present_district_pashto`,
`prisoner`.`permanent_province_id` AS `permanent_province_id`,
`permanent_province`.`name_english` AS `permanent_province_english`,
`permanent_province`.`name_dari` AS `permanent_province_dari`,
`permanent_province`.`name_pashto` AS `permanent_province_pashto`,
`prisoner`.`permanent_district_id` AS `permanent_district_id`,
`permanent_district`.`name_english` AS `permanent_district_english`,
`permanent_district`.`name_dari` AS `permanent_district_dari`,
`permanent_district`.`name_pashto` AS `permanent_district_pashto`,
`prisoner`.`name` AS `name`,
`prisoner`.`father_name` AS `father_name`,
`prisoner`.`grand_father_name` AS `grand_father_name`,
`prisoner`.`age` AS `age`,
`prisoner`.`criminal_history` AS `criminal_history`,
`prisoner`.`num_of_children` AS `num_of_children`,
`prisoner`.`profile_pic` AS `profile_pic`,
`prisoner`.`locked` AS `locked`
 from `prisoner` 
 INNER JOIN `marital_status` ON `marital_status`.`id` = `prisoner`.`marital_status_id`
 INNER JOIN `province` AS `present_province` ON `present_province`.id = `prisoner`.`present_province_id`
 INNER JOIN `district` AS `present_district` ON `present_district`.id = `prisoner`.`present_district_id`
 INNER JOIN `province` AS `permanent_province` ON `permanent_province`.id = `prisoner`.`permanent_province_id`
 INNER JOIN `district` AS `permanent_district` ON `permanent_district`.id = `prisoner`.`permanent_district_id`
 order by `prisoner`.`id`;
 */

--
-- Structure for view `crime_view`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `crime_view` AS select `crime`.`id` AS `id`,`crime`.`registration_date` AS `registration_date`,`crime`.`case_number` AS `case_number`,`crime`.`crime_date` AS `crime_date`,`crime`.`crime_date_shamsi` AS `crime_date_shamsi`,`crime`.`arrest_date` AS `arrest_date`,`crime`.`arrest_date_shamsi` AS `arrest_date_shamsi`,`crime`.`crime_reason` AS `crime_reason`,`crime`.`crime_supporter` AS `crime_supporter`,`crime`.`crime_location` AS `crime_location`,`crime`.`arrest_location` AS `arrest_location`,`crime`.`police_custody` AS `police_custody`,`crime`.`crime_province_id` AS `crime_province_id`,`crime_province`.`name_english` AS `crime_province_english`,`crime_province`.`name_dari` AS `crime_province_dari`,`crime_province`.`name_pashto` AS `crime_province_pashto`,`crime`.`crime_district_id` AS `crime_district_id`,`crime_district`.`name_english` AS `crime_district_english`,`crime_district`.`name_dari` AS `crime_district_dari`,`crime_district`.`name_pashto` AS `crime_district_pashto`,`crime`.`arrest_province_id` AS `arrest_province_id`,`arrest_province`.`name_english` AS `arrest_province_english`,`arrest_province`.`name_dari` AS `arrest_province_dari`,`arrest_province`.`name_pashto` AS `arrest_province_pashto`,`crime`.`arrest_district_id` AS `arrest_district_id`,`arrest_district`.`name_english` AS `arrest_district_english`,`arrest_district`.`name_dari` AS `arrest_district_dari`,`arrest_district`.`name_pashto` AS `arrest_district_pashto`,`crime`.`time_spent_in_prison` AS `time_spent_in_prison`,`crime`.`remaining_jail_term` AS `remaining_jail_term`,`crime`.`use_benefit_forgiveness_presidential` AS `use_benefit_forgiveness_presidential`,`crime`.`command_issue_date` AS `command_issue_date`,`crime`.`command_issue_date_shamsi` AS `command_issue_date_shamsi`,`crime`.`commission_proposal` AS `commission_proposal`,`crime`.`prisoner_request` AS `prisoner_request`,`crime`.`commission_member` AS `commission_member`,`crime`.`locked` AS `locked` from ((((`crime` join `province` `crime_province` on((`crime_province`.`id` = `crime`.`crime_province_id`))) join `district` `crime_district` on((`crime_district`.`id` = `crime`.`crime_district_id`))) join `province` `arrest_province` on((`arrest_province`.`id` = `crime`.`arrest_province_id`))) join `district` `arrest_district` on((`arrest_district`.`id` = `crime`.`arrest_district_id`))) order by `crime`.`id`;

--
-- VIEW  `crime_view`
-- Data: None
--

/*
CREATE or REPLACE VIEW `crime_view` AS select 
`crime`.`id` AS `id`,
`crime`.`registration_date` AS `registration_date`,
`crime`.`case_number` AS `case_number`,
`crime`.`crime_date` AS `crime_date`,
`crime`.`crime_date_shamsi` AS `crime_date_shamsi`,
`crime`.`arrest_date` AS `arrest_date`,
`crime`.`arrest_date_shamsi` AS `arrest_date_shamsi`,
`crime`.`crime_reason` AS `crime_reason`,
`crime`.`crime_supporter` AS `crime_supporter`,
`crime`.`crime_location` AS `crime_location`,
`crime`.`arrest_location` AS `arrest_location`,
`crime`.`police_custody` AS `police_custody`,
`crime`.`crime_province_id` AS `crime_province_id`,
`crime_province`.`name_english` AS `crime_province_english`,
`crime_province`.`name_dari` AS `crime_province_dari`,
`crime_province`.`name_pashto` AS `crime_province_pashto`,
`crime`.`crime_district_id` AS `crime_district_id`,
`crime_district`.`name_english` AS `crime_district_english`,
`crime_district`.`name_dari` AS `crime_district_dari`,
`crime_district`.`name_pashto` AS `crime_district_pashto`,
`crime`.`arrest_province_id` AS `arrest_province_id`,
`arrest_province`.`name_english` AS `arrest_province_english`,
`arrest_province`.`name_dari` AS `arrest_province_dari`,
`arrest_province`.`name_pashto` AS `arrest_province_pashto`,
`crime`.`arrest_district_id` AS `arrest_district_id`,
`arrest_district`.`name_english` AS `arrest_district_english`,
`arrest_district`.`name_dari` AS `arrest_district_dari`,
`arrest_district`.`name_pashto` AS `arrest_district_pashto`,
`crime`.`time_spent_in_prison` AS `time_spent_in_prison`,
`crime`.`remaining_jail_term` AS `remaining_jail_term`,
`crime`.`use_benefit_forgiveness_presidential` AS `use_benefit_forgiveness_presidential`,
`crime`.`command_issue_date` AS `command_issue_date`,
`crime`.`command_issue_date_shamsi` AS `command_issue_date_shamsi`,
`crime`.`commission_proposal` AS `commission_proposal`,
`crime`.`prisoner_request` AS `prisoner_request`,
`crime`.`commission_member` AS `commission_member`,
`crime`.`locked` AS `locked`
 from `crime`
 INNER JOIN `province` AS `crime_province` ON `crime_province`.id = `crime`.`crime_province_id`
 INNER JOIN `district` AS `crime_district` ON `crime_district`.id = `crime`.`crime_district_id`
 INNER JOIN `province` AS `arrest_province` ON `arrest_province`.id = `crime`.`arrest_province_id`
 INNER JOIN `district` AS `arrest_district` ON `arrest_district`.id = `crime`.`arrest_district_id`
 order by `crime`.`id`;
*/

--
-- Structure for view `user_view`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_view` AS select `user`.`id` AS `id`,`user`.`firstname` AS `firstname`,`user`.`lastname` AS `lastname`,`user`.`username` AS `username`,`user`.`password` AS `password`,`user`.`email` AS `email`,`user`.`isadmin` AS `isadmin`,`user`.`groups_id` AS `groups_id`,`groups`.`group_name` AS `group_name` from (`user` join `groups` on((`groups`.`id` = `user`.`groups_id`)));

--
-- VIEW  `user_view`
-- Data: None
--

/*
CREATE or REPLACE VIEW `user_view` AS select 
`user`.`id` AS `id`,
`user`.`firstname` AS `firstname`,
`user`.`lastname` AS `lastname`,
`user`.`username` AS `username`,
`user`.`password` AS `password`,
`user`.`email` AS `email`,
`user`.`isadmin` AS `isadmin`,
`user`.`groups_id` AS `groups_id`,
`groups`.`group_name` AS `group_name`
 from `user`
 INNER JOIN `groups` ON `groups`.`id`=`user`.`groups_id`;
*/


--
-- Structure for view `court_session_view`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `court_session_view` AS select `court_session`.`id` AS `id`,`court_session`.`crime_id` AS `crime_id`,`court_session`.`court_decision_type_id` AS `court_decision_type_id`,`court_decision_type`.`decision_type_name_english` AS `court_decision_type_english`,`court_decision_type`.`decision_type_name_dari` AS `court_decision_type_dari`,`court_decision_type`.`decision_type_name_pashto` AS `court_decision_type_pashto`,`court_session`.`decision_date` AS `decision_date`,`court_session`.`decision_date_shamsi` AS `decision_date_shamsi`,`court_session`.`decision` AS `decision`,`court_session`.`defence_lawyer_name` AS `defence_lawyer_name`,`court_session`.`defence_lawyer_certificate_id` AS `defence_lawyer_certificate_id`,`court_session`.`sentence_execution_date` AS `sentence_execution_date`,`court_session`.`sentence_execution_date_shamsi` AS `sentence_execution_date_shamsi`,`court_session`.`locked` AS `locked` from (`court_session` join `court_decision_type` on((`court_decision_type`.`id` = `court_session`.`court_decision_type_id`)));

--
-- VIEW  `court_session_view`
-- Data: None
--

/*
CREATE or REPLACE VIEW `court_session_view` AS select 
`court_session`.`id` AS `id`,
`court_session`.`crime_id` AS `crime_id`,
`court_session`.`court_decision_type_id` AS `court_decision_type_id`,
`court_decision_type`.`decision_type_name_english` AS `court_decision_type_english`,
`court_decision_type`.`decision_type_name_dari` AS `court_decision_type_dari`,
`court_decision_type`.`decision_type_name_pashto` AS `court_decision_type_pashto`,
`court_session`.`decision_date` AS `decision_date`,
`court_session`.`decision_date_shamsi` AS `decision_date_shamsi`,
`court_session`.`decision` AS `decision`,
`court_session`.`defence_lawyer_name` AS `defence_lawyer_name`,
`court_session`.`defence_lawyer_certificate_id` AS `defence_lawyer_certificate_id`,
`court_session`.`sentence_execution_date` AS `sentence_execution_date`,
`court_session`.`sentence_execution_date_shamsi` AS `sentence_execution_date_shamsi`,
`court_session`.`locked` AS `locked`
 from `court_session`
INNER JOIN `court_decision_type` ON `court_decision_type`.id =  `court_session`.`court_decision_type_id`;

*/


--
-- Structure for view `general_view`
--

 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `general_view` AS select `prisoner`.`tazkira_number` AS `tazkira_number`,`prisoner`.`marital_status_id` AS `marital_status_id`,`marital_status`.`status_english` AS `marital_status_english`,`marital_status`.`status_dari` AS `marital_status_dari`,`marital_status`.`status_pashto` AS `marital_status_pashto`,`prisoner`.`present_province_id` AS `present_province_id`,`present_province`.`name_english` AS `present_province_english`,`present_province`.`name_dari` AS `present_province_dari`,`present_province`.`name_pashto` AS `present_province_pashto`,`prisoner`.`present_district_id` AS `present_district_id`,`present_district`.`name_english` AS `present_district_english`,`present_district`.`name_dari` AS `present_district_dari`,`present_district`.`name_pashto` AS `present_district_pashto`,`prisoner`.`permanent_province_id` AS `permanent_province_id`,`permanent_province`.`name_english` AS `permanent_province_english`,`permanent_province`.`name_dari` AS `permanent_province_dari`,`permanent_province`.`name_pashto` AS `permanent_province_pashto`,`prisoner`.`permanent_district_id` AS `permanent_district_id`,`permanent_district`.`name_english` AS `permanent_district_english`,`permanent_district`.`name_dari` AS `permanent_district_dari`,`permanent_district`.`name_pashto` AS `permanent_district_pashto`,`prisoner`.`name` AS `name`,`prisoner`.`father_name` AS `father_name`,`prisoner`.`grand_father_name` AS `grand_father_name`,`prisoner`.`age` AS `age`,`prisoner`.`criminal_history` AS `criminal_history`,`prisoner`.`num_of_children` AS `num_of_children`,`prisoner`.`profile_pic` AS `profile_pic`,`crime`.`registration_date` AS `registration_date`,`crime`.`case_number` AS `case_number`,`crime`.`crime_date` AS `crime_date`,`crime`.`crime_date_shamsi` AS `crime_date_shamsi`,`crime`.`arrest_date` AS `arrest_date`,`crime`.`arrest_date_shamsi` AS `arrest_date_shamsi`,`crime`.`crime_reason` AS `crime_reason`,`crime`.`crime_supporter` AS `crime_supporter`,`crime`.`crime_location` AS `crime_location`,`crime`.`arrest_location` AS `arrest_location`,`crime`.`police_custody` AS `police_custody`,`crime`.`crime_province_id` AS `crime_province_id`,`crime_province`.`name_english` AS `crime_province_english`,`crime_province`.`name_dari` AS `crime_province_dari`,`crime_province`.`name_pashto` AS `crime_province_pashto`,`crime`.`crime_district_id` AS `crime_district_id`,`crime_district`.`name_english` AS `crime_district_english`,`crime_district`.`name_dari` AS `crime_district_dari`,`crime_district`.`name_pashto` AS `crime_district_pashto`,`crime`.`arrest_province_id` AS `arrest_province_id`,`arrest_province`.`name_english` AS `arrest_province_english`,`arrest_province`.`name_dari` AS `arrest_province_dari`,`arrest_province`.`name_pashto` AS `arrest_province_pashto`,`crime`.`arrest_district_id` AS `arrest_district_id`,`arrest_district`.`name_english` AS `arrest_district_english`,`arrest_district`.`name_dari` AS `arrest_district_dari`,`arrest_district`.`name_pashto` AS `arrest_district_pashto`,`crime`.`time_spent_in_prison` AS `time_spent_in_prison`,`crime`.`remaining_jail_term` AS `remaining_jail_term`,`crime`.`use_benefit_forgiveness_presidential` AS `use_benefit_forgiveness_presidential`,`crime`.`command_issue_date` AS `command_issue_date`,`crime`.`command_issue_date_shamsi` AS `command_issue_date_shamsi`,`crime`.`commission_proposal` AS `commission_proposal`,`crime`.`prisoner_request` AS `prisoner_request`,`crime`.`commission_member` AS `commission_member`,`crime`.`locked` AS `locked`,`crime_prisoner`.`prisoner_id` AS `prisoner_id`,`crime_prisoner`.`crime_id` AS `crime_id` from (((((((((((`prisoner` join `marital_status` on((`marital_status`.`id` = `prisoner`.`marital_status_id`))) join `province` `present_province` on((`present_province`.`id` = `prisoner`.`present_province_id`))) join `district` `present_district` on((`present_district`.`id` = `prisoner`.`present_district_id`))) join `province` `permanent_province` on((`permanent_province`.`id` = `prisoner`.`permanent_province_id`))) join `district` `permanent_district` on((`permanent_district`.`id` = `prisoner`.`permanent_district_id`))) join `crime_prisoner` on((`crime_prisoner`.`prisoner_id` = `prisoner`.`id`))) join `crime` on((`crime`.`id` = `crime_prisoner`.`crime_id`))) join `province` `crime_province` on((`crime_province`.`id` = `crime`.`crime_province_id`))) join `district` `crime_district` on((`crime_district`.`id` = `crime`.`crime_district_id`))) join `province` `arrest_province` on((`arrest_province`.`id` = `crime`.`arrest_province_id`))) join `district` `arrest_district` on((`arrest_district`.`id` = `crime`.`arrest_district_id`))) order by `crime_prisoner`.`crime_id`;

--
-- VIEW  `general_view`
-- Data: None
--

/*
CREATE or REPLACE VIEW `general_view` AS select
`prisoner`.`tazkira_number` AS `tazkira_number`,
`prisoner`.`marital_status_id` AS `marital_status_id`,
`marital_status`.`status_english` AS `marital_status_english`,
`marital_status`.`status_dari` AS `marital_status_dari`,
`marital_status`.`status_pashto` AS `marital_status_pashto`,
`prisoner`.`present_province_id` AS `present_province_id`,
`present_province`.`name_english` AS `present_province_english`,
`present_province`.`name_dari` AS `present_province_dari`,
`present_province`.`name_pashto` AS `present_province_pashto`,
`prisoner`.`present_district_id` AS `present_district_id`,
`present_district`.`name_english` AS `present_district_english`,
`present_district`.`name_dari` AS `present_district_dari`,
`present_district`.`name_pashto` AS `present_district_pashto`,
`prisoner`.`permanent_province_id` AS `permanent_province_id`,
`permanent_province`.`name_english` AS `permanent_province_english`,
`permanent_province`.`name_dari` AS `permanent_province_dari`,
`permanent_province`.`name_pashto` AS `permanent_province_pashto`,
`prisoner`.`permanent_district_id` AS `permanent_district_id`,
`permanent_district`.`name_english` AS `permanent_district_english`,
`permanent_district`.`name_dari` AS `permanent_district_dari`,
`permanent_district`.`name_pashto` AS `permanent_district_pashto`,
`prisoner`.`name` AS `name`,
`prisoner`.`father_name` AS `father_name`,
`prisoner`.`grand_father_name` AS `grand_father_name`,
`prisoner`.`age` AS `age`,
`prisoner`.`criminal_history` AS `criminal_history`,
`prisoner`.`num_of_children` AS `num_of_children`,
`prisoner`.`profile_pic` AS `profile_pic`,

`crime`.`registration_date` AS `registration_date`,
`crime`.`case_number` AS `case_number`,
`crime`.`crime_date` AS `crime_date`,
`crime`.`crime_date_shamsi` AS `crime_date_shamsi`,
`crime`.`arrest_date` AS `arrest_date`,
`crime`.`arrest_date_shamsi` AS `arrest_date_shamsi`,
`crime`.`crime_reason` AS `crime_reason`,
`crime`.`crime_supporter` AS `crime_supporter`,
`crime`.`crime_location` AS `crime_location`,
`crime`.`arrest_location` AS `arrest_location`,
`crime`.`police_custody` AS `police_custody`,
`crime`.`crime_province_id` AS `crime_province_id`,
`crime_province`.`name_english` AS `crime_province_english`,
`crime_province`.`name_dari` AS `crime_province_dari`,
`crime_province`.`name_pashto` AS `crime_province_pashto`,
`crime`.`crime_district_id` AS `crime_district_id`,
`crime_district`.`name_english` AS `crime_district_english`,
`crime_district`.`name_dari` AS `crime_district_dari`,
`crime_district`.`name_pashto` AS `crime_district_pashto`,
`crime`.`arrest_province_id` AS `arrest_province_id`,
`arrest_province`.`name_english` AS `arrest_province_english`,
`arrest_province`.`name_dari` AS `arrest_province_dari`,
`arrest_province`.`name_pashto` AS `arrest_province_pashto`,
`crime`.`arrest_district_id` AS `arrest_district_id`,
`arrest_district`.`name_english` AS `arrest_district_english`,
`arrest_district`.`name_dari` AS `arrest_district_dari`,
`arrest_district`.`name_pashto` AS `arrest_district_pashto`,
`crime`.`time_spent_in_prison` AS `time_spent_in_prison`,
`crime`.`remaining_jail_term` AS `remaining_jail_term`,
`crime`.`use_benefit_forgiveness_presidential` AS `use_benefit_forgiveness_presidential`,
`crime`.`command_issue_date` AS `command_issue_date`,
`crime`.`command_issue_date_shamsi` AS `command_issue_date_shamsi`,
`crime`.`commission_proposal` AS `commission_proposal`,
`crime`.`prisoner_request` AS `prisoner_request`,
`crime`.`commission_member` AS `commission_member`,
`crime`.`locked` AS `locked`,

`crime_prisoner`.`prisoner_id`,
`crime_prisoner`.`crime_id`

 from `prisoner` 
 INNER JOIN `marital_status` ON `marital_status`.`id` = `prisoner`.`marital_status_id`
 INNER JOIN `province` AS `present_province` ON `present_province`.id = `prisoner`.`present_province_id`
 INNER JOIN `district` AS `present_district` ON `present_district`.id = `prisoner`.`present_district_id`
 INNER JOIN `province` AS `permanent_province` ON `permanent_province`.id = `prisoner`.`permanent_province_id`
 INNER JOIN `district` AS `permanent_district` ON `permanent_district`.id = `prisoner`.`permanent_district_id`

 INNER JOIN `crime_prisoner` AS `crime_prisoner` ON `crime_prisoner`.`prisoner_id` = `prisoner`.`id`

 INNER JOIN `crime` AS `crime` ON `crime`.`id` = `crime_prisoner`.`crime_id`
 INNER JOIN `province` AS `crime_province` ON `crime_province`.id = `crime`.`crime_province_id`
 INNER JOIN `district` AS `crime_district` ON `crime_district`.id = `crime`.`crime_district_id`
 INNER JOIN `province` AS `arrest_province` ON `arrest_province`.id = `crime`.`arrest_province_id`
 INNER JOIN `district` AS `arrest_district` ON `arrest_district`.id = `crime`.`arrest_district_id`

 order by `crime_prisoner`.`crime_id`;

 */



/*
CREATE or REPLACE VIEW `general_view` AS select 
`prisoner`.`marital_status_id` AS `marital_status_id`,
`marital_status`.`status` AS `marital_status`,
`prisoner`.`present_province_id` AS `present_province_id`,
`present_province`.`name` AS `present_province`,
`prisoner`.`present_district_id` AS `present_district_id`,
`present_district`.`name` AS `present_district`,
`prisoner`.`permanent_province_id` AS `permanent_province_id`,
`permanent_province`.`name` AS `permanent_province`,
`prisoner`.`permanent_district_id` AS `permanent_district_id`,
`permanent_district`.`name` AS `permanent_district`,
`prisoner`.`name` AS `name`,
`prisoner`.`father_name` AS `father_name`,
`prisoner`.`grand_father_name` AS `grand_father_name`,
`prisoner`.`age` AS `age`,
`prisoner`.`criminal_history` AS `criminal_history`,
`prisoner`.`num_of_children` AS `num_of_children`,
`prisoner`.`profile_pic` AS `profile_pic`,

`crime`.`case_number` AS `case_number`,
`crime`.`crime_date` AS `crime_date`,
`crime`.`crime_location` AS `crime_location`,
`crime`.`arrest_location` AS `arrest_location`,
`crime`.`police_custody` AS `police_custody`,
`crime`.`crime_province_id` AS `crime_province_id`,
`crime_province`.`name` AS `crime_province`,
`crime`.`crime_district_id` AS `crime_district_id`,
`crime_district`.`name` AS `crime_district`,
`crime`.`arrest_province_id` AS `arrest_province_id`,
`arrest_province`.`name` AS `arrest_province`,
`crime`.`arrest_district_id` AS `arrest_district_id`,
`arrest_district`.`name` AS `arrest_district`,
`crime`.`time_spent_in_prison` AS `time_spent_in_prison`,
`crime`.`remaining_jail_term` AS `remaining_jail_term`,
`crime`.`use_benefit_forgiveness_presidential` AS `use_benefit_forgiveness_presidential`,
`crime`.`command_issue_date` AS `command_issue_date`,
`crime`.`commission_proposal` AS `commission_proposal`,
`crime`.`prisoner_request` AS `prisoner_request`,
`crime`.`commission_member` AS `commission_member`,

`court_session`.`court_decision_type_id` AS `court_decision_type_id`,
`court_decision_type`.`decision_type_name` AS `court_decision_type`,
`court_session`.`decision_date` AS `decision_date`,
`court_session`.`decision` AS `decision`,
`court_session`.`defence_lawyer_name` AS `defence_lawyer_name`,
`court_session`.`defence_lawyer_certificate_id` AS `defence_lawyer_certificate_id`,
`court_session`.`sentence_execution_date` AS `sentence_execution_date`,

`court_session`.`id` AS `court_session_id`,
`crime_prisoner`.`prisoner_id`,
`crime_prisoner`.`crime_id`

 from `prisoner` 
 INNER JOIN `marital_status` ON `marital_status`.`id` = `prisoner`.`marital_status_id`
 INNER JOIN `province` AS `present_province` ON `present_province`.id = `prisoner`.`present_province_id`
 INNER JOIN `district` AS `present_district` ON `present_district`.id = `prisoner`.`present_district_id`
 INNER JOIN `province` AS `permanent_province` ON `permanent_province`.id = `prisoner`.`permanent_province_id`
 INNER JOIN `district` AS `permanent_district` ON `permanent_district`.id = `prisoner`.`permanent_district_id`

 INNER JOIN `crime_prisoner` AS `crime_prisoner` ON `crime_prisoner`.`prisoner_id` = `prisoner`.`id`

 INNER JOIN `crime` AS `crime` ON `crime`.`id` = `crime_prisoner`.`crime_id`
 INNER JOIN `province` AS `crime_province` ON `crime_province`.id = `crime`.`crime_province_id`
 INNER JOIN `district` AS `crime_district` ON `crime_district`.id = `crime`.`crime_district_id`
 INNER JOIN `province` AS `arrest_province` ON `arrest_province`.id = `crime`.`arrest_province_id`
 INNER JOIN `district` AS `arrest_district` ON `arrest_district`.id = `crime`.`arrest_district_id`

 INNER JOIN `court_session` AS `court_session` ON `court_session`.`crime_id` = `crime`.`id`
 INNER JOIN `court_decision_type` ON `court_decision_type`.id =  `court_session`.`court_decision_type_id`

 order by `crime_prisoner`.`crime_id`;
*/

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `prisoner_new`, `prisoner_delete`, `prisoner_edit`, `prisoner_view`, `crime_new`, `crime_view`, `crime_edit`, `crime_delete`, `prisoner_unlock`, `crime_unlock`, `court_session_new`, `court_session_view`, `court_session_edit`, `court_session_delete`, `court_session_unlock`) VALUES
(1, 'Admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 , 1, 1, 1, 1, 1),
(2, 'Supervisor', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 'Data Entry', 1, 1, 1, 1, 1, 1, 1, 1, 0, 0 , 0, 0, 0, 0, 0),
(5, 'Staff', NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL);

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `password`, `isadmin`, `email`, `groups_id`) VALUES
(1, 'Hameedullah', 'Pardess', 'hpardess', '9a69e50114a30c4c5c1d455a2cfb87d1', 1, NULL, 1),
(2, 'Naser', 'Rawan', 'naserrawan', '9a69e50114a30c4c5c1d455a2cfb87d1', 0, NULL, 2);

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`id`, `status_english`, `status_dari`, `status_pashto`) VALUES
(1, 'Single','مجرد','مجرد'),
(2, 'Married','متاهل','متاهل'),
(3, 'Widow','بیوه','کونډه'),
(4, 'Engaged','نامزد','نامزد');

--
-- Dumping data for table `crime_type`
--

INSERT INTO `crime_type` (`id`, `type_name_english`, `type_name_dari`, `type_name_pashto`) VALUES
(1, 'Murder', 'قتل', 'قتل'),
(2, 'Rape', 'تجاوز جنسی', 'تجاوز جنسی'),
(3, 'Adultery','زنا','زنا'),
(4, 'Run Away From Home', 'فرار از منزل', 'فرار از منزل'),
(5, 'Drug Trafficking','قاچاق مواد مخدر','قاچاق مواد مخدر'),
(6, 'Kidnap', 'اختطاف', 'اختطاف'),
(7, 'Terror','ترور','ترور'),
(8, 'Alcohol Assumption','شراب خوری','شراب خوری'),
(9, 'Bombing','ماین گذاری','ماین گذاری'),
(10, 'Suicide Attack','حملات انتحاری','حملات انتحاری'),
(11, 'Rudeness','خشونت','خشونت'),
(12, 'Rudeness Cause Suicide','خشونت منجر به خودکشی','خشونت منجر به خودکشی'),
(13, 'Adultery Cause Murder','فعل زنا منجر به قتل','فعل زنا منجر به قتل'),
(14, 'Fire Cause Murder','آتش سوزی منجر به قتل','آتش سوزی منجر به قتل'),
(15, 'Immoral Relationship','رابطه نامشروع','رابطه نامشروع'),
(16, 'Wounded','مجروحیت','مجروحیت'),
(17, 'Sodomy','لواطه','لواطه'),
(18, 'House Fire','حریق منزل','حریق منزل'),
(19, 'Alleged Murder','ادعای قتل','ادعای قتل'),
(20, 'Attempt Adultery Cause Murder','اقدام یه زنا سبب قتل','اقدام به زنا سبب قتل');

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `name_english`, `name_dari`, `name_pashto`) VALUES
(1, 'Kabul', 'کابل', 'کابل'),
(2, 'Kapisa','کاپیسا','کاپیسا'),
(3, 'Parwan','پروان','پروان'),
(4, 'Wardak','وردک','وردک'),
(5, 'Logar','لوگر','لوگر'),
(6, 'Ghazni','غزنی','غزنی'),
(7, 'Paktya','پکتیا','پکتیا'),
(8, 'Nangarhar','ننگرهار','ننگرهار'),
(9, 'Laghman','لغمان','لغمان'),
(10, 'Kunar','کنر','کنر'),
(11, 'Badakhshan','بدخشان','بدخشان'),
(12, 'Takhar','تخار','تخار'),
(13, 'Baghlan','بغلان','بغلان'),
(14, 'Kunduz','کندوز','کندوز'),
(15, 'Samangan','سمنگان','سمنگان'),
(16, 'Balkh','بلخ','بلخ'),
(17, 'Jawzjan','جوزجان','جوزجان'),
(18, 'Faryab','فاریاب','فاریاب'),
(19, 'Badghis','بادغیس','بادغیس'),
(20, 'Hirat','هرات','هرات'),
(21, 'Farah','فراه','فراه'),
(22, 'Nimroz','نیمروز','نیمروز'),
(23, 'Hilmand','هلمند','هلمند'),
(24, 'Kandahar','کندهار','کندهار'),
(25, 'Zabul','زابل','زابل'),
(26, 'Uruzgan','اروزگان','اروزگان'),
(27, 'Ghor','غور','غور'),
(28, 'Bamyan','بامیان','بامیان'),
(29, 'Paktika','پکتیکا','پکتیکا'),
(30, 'Nuristan','نورستان','نورستان'),
(31, 'Sari Pul','سریپول','سریپول'),
(32, 'Khost','خوست','خوست'),
(33, 'Panjsher','پنجشیر','پنجشیر'),
(34, 'Daykundi','دایکندی','دایکندی');

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name_english`, `name_dari`, `name_pashto`, `province_id`) VALUES
(1, 'Kabul', 'کابل', 'کابل', 1),
(2, 'Dih Sabz', 'ده سبز', 'ده سبز', 1),
(3, 'Mir Bacha Kot', 'میربچه کوت', 'میربچه کوت', 1),
(4, 'Kalakan','کلکان','کلکان', 1),
(5, 'Qarabagh','قره باغ','قره باغ', 1),
(6, 'Istalif','استالف','استالف', 1),
(7, 'Shakardara','شکردره','شکردره', 1),
(8, 'Paghman','پغمان','پغمان', 1),
(9, 'Chahar Asyab','چهارآسیاب','چهارآسیاب', 1),
(10, 'Bagrami','بگرامی','بگرامی', 1),
(11, 'Khaki Jabbar','خاک جبار','خاک جبار', 1),
(12, 'Surobi','سروبی','سروبی', 1),
(13, 'Guldara','گلدره','گلدره', 1),
(14, 'Musayi','موسی','موسی', 1),
(15, 'Farza','فرزه','فرزه', 1),
(16, 'Mahmudi Raqi','محمودراقی','محمودراقی', 2),
(17, 'Hisa-i-Awali Kohistan','حصه اول کوهستان','حصه اول کوهستان', 2),
(18, 'Koh Band','کوه بند','کوه بند', 2),
(19, 'Nijrab','نجرابی','نجرابی', 2),
(20, 'Tagab',' تگاب',' تگاب', 2),
(21, 'Alasay','السی','السی', 2),
(22, 'Hisa-i-Duwumi Kohistan','حصه دوم کوهستان','حصه دوم کوهستان', 2),
(23, 'Chaharikar','چاریکار','چاریکار', 3),
(24, 'Jabalussaraj','جبل السراج','جبل السراج', 3),
(25, 'Salang','سالنگ','سالنگ', 3),
(26, 'Shinwari','شینواری','شینواری', 3),
(27, 'Ghorband','غوربند','غوربند', 3),
(28, 'Shekh  Ali','شیخ علی','شیخ علی', 3),
(29, 'Surkhi Parsa',' سرخ پارسا',' سرخ پارسا', 3),
(30, 'Bagram','بگرام','بگرام', 3),
(31, 'Kohi Safi','کوه صافی','کوه صافی', 3),
(32, 'Sayd Khel','سیدخیل','سیدخیل', 3),
(33, 'Maydan Shahr','میدان شهر','میدان شهر', 4),
(34, 'Jalrez','جلریز','جلریز', 4),
(35, 'Hisa-I- Awali Bihsud',' حصه اول بهسود',' حصه اول بهسود', 4),
(36, 'Markazi Bihsud',' مرکز بهسود',' مرکز بهسود', 4),
(37, 'Day Mirdad','دای میرداد','دای میرداد', 4),
(38, 'Chaki Wardak','چک وردک','چک وردک', 4),
(39, 'Saydabad',' سیدآباد',' سیدآباد', 4),
(40, 'Nirkh',' نرخ',' نرخ', 4),
(41, 'Jaghatu','جیغه تو','جیغه تو', 4),
(42, 'Puli Alam',' پل علم',' پل علم', 5),
(43, 'Charkh',' چرخ',' چرخ', 5),
(44, 'Baraki Barak','برکی برک','برکی برک', 5),
(45, 'Khushi',' خوشی',' خوشی', 5),
(46, 'Muhammad Agha','محمدآغه','محمدآغه', 5),
(47, 'Azra','ازره','ازره', 5),
(48, 'Kharwar','خروار','خروار', 5),
(49, 'Ghazni','غزنی','غزنی', 6),
(50, 'Bahrami Shahid (Jaghatu)','بهرام شهید(جغتو)','بهرام شهید(جغتو)', 6),
(51, 'Khwaja Umari','خواجه عمری','خواجه عمری', 6),
(52, 'Nawur','ناهور','ناهور', 6),
(53, 'Ajristan','اجرستان','اجرستان', 6),
(54, 'Malistan','مالستان','مالستان', 6),
(55, 'Jaghuri','جاغوری','جاغوری', 6),
(56, 'Muqur','مقر','مقر', 6),
(57, 'Gelan','گیلان','گیلان', 6),
(58, 'Nawa','ناوه','ناوه', 6),
(59, 'Ab Band','آب بند','آب بند', 6),
(60, 'Giro','گیرو','گیرو', 6),
(61, 'Qarabagh','قره باغ','قره باغ', 6),
(62, 'Andar','اندر','اندر', 6),
(63, 'Dih Yak','ده یک','ده یک', 6),
(64, 'Zana Khan','زنه خان','زنه خان', 6),
(65, 'Rashidan','رشیدان','رشیدان', 6),
(66, 'Waghaz','واغاز','واغاز', 6),
(67, 'Wali Muhammadi Shahid','ولی محمدشهید','ولی محمدشهید', 6),
(68, 'Wali Muhammadi Shahid','','', 6),
(69, 'Gardez','گردیز','گردیز', 7),
(70, 'Zurmat','زرمت','زرمت', 7),
(71, 'Shwak','شاواک','شاواک', 7),
(72, 'Wuza Zadran','وزه زدران','وزه زدران', 7),
(73, 'Ahmadabad','احمدآباد','احمدآباد', 7),
(74, 'Jani Khel','جانی خیل','جانی خیل', 7),
(75, 'Dand Wa Patan','دند وپتان','دند وپتان', 7),
(76, 'Chamkanay','چمکنی','چمکنی', 7),
(77, 'Lija Ahmad Khel','لیجا احمدخیل','لیجا احمدخیل', 7),
(78, 'Sayid Karam','سیدکرم','سیدکرم', 7),
(79, 'Jaji','جاجی','جاجی', 7),
(80, 'Jalalabad','جلال آباد','جلال آباد', 8),
(81, 'Surkh Rod','سرخ رود','سرخ رود', 8),
(82, 'Hisarak','حصارک','حصارک', 8),
(83, 'Sherzad','شیرزاد','شیرزاد', 8),
(84, 'Khogyani','خوگیانی','خوگیانی', 8),
(85, 'Chaparhar','چپرهار','چپرهار', 8),
(86, 'Pachir Wa  Agam','چاپیروگمه','چاپیروگمه', 8),
(87, 'Dih Bala','ده بالا','ده بالا', 8),
(88, 'Rodat','رودات','رودات', 8),
(89, 'Achin','اچین','اچین', 8),
(90, 'Nazyan','نازیان','نازیان', 8),
(91, 'Dur Baba','دربابا','دربابا', 8),
(92, 'Shinwar','شنوار','شنوار', 8),
(93, 'Muhmand Dara','مهمند دره','مهمند دره', 8),
(94, 'Lal Pur','لالپور','لالپور', 8),
(95, 'Goshta','گوشته','گوشته', 8),
(96, 'Bati Kot','بتی کوت','بتی کوت', 8),
(97, 'Kama','کامه','کامه', 8),
(98, 'Kuz Kunar','کوزکنر','کوزکنر', 8),
(99, 'Dara-I-Nur','دره نور','دره نور', 8),
(100, 'Bihsud','بهسود','بهسود', 8),
(101, 'Kot','کوت','کوت', 8),
(102, 'Mihtarlam','میترلام','میترلام', 9),
(103, 'Qarghayi','قرغی','قرغی', 9),
(104, 'Alingar','النگار','النگار', 9),
(105, 'Dawlat Shah','دولتشاهی','دولتشاهی', 9),
(106, 'Alishing','البیشینگ','البیشینگ', 9),
(107, 'Asadabad','اسدآباد','اسدآباد', 10),
(108, 'Marawara','مورواره','مورواره', 10),
(109, 'Bar Kunar','بارکنر','بارکنر', 10),
(110, 'Dangam','دنگم','دنگم', 10),
(111, 'Nari','ناری','ناری', 10),
(112, 'Ghaziabad','غازی آباد','غازی آباد', 10),
(113, 'Shaygal wa shiltan',' شیگل وشیلتان',' شیگل وشیلتان', 10),
(114, 'Wata Pur','وته پور','وته پور', 10),
(115, 'Chapa Dara',' چپه دره',' چپه دره', 10),
(116, 'Dara-I-Pech','دره پیچ','دره پیچ', 10),
(117, 'Narang','نرنگ','نرنگ', 10),
(118, 'Chawkay','چاوکی','چاوکی', 10),
(119, 'Nurgal','نورگل','نورگل', 10),
(120, 'Khas Kunar','خاص کنر','خاص کنر', 10),
(121, 'Sirkanay','سیرکنی','سیرکنی', 10),
(122, 'Fayzabad','فیض آباد','فیض آباد', 11),
(123, 'Kishim','کیشم','کیشم', 11),
(124, 'Jurm','جرم','جرم', 11),
(125, 'Kuran Wa Munjan','کوران ومنجان','کوران ومنجان', 11),
(126, 'Zebak','زیباک','زیباک', 11),
(127, 'Wakhan','واخان','واخان', 11),
(128, 'Ishkashim','اشکاشم','اشکاشم', 11),
(129, 'Baharak','بهارک','بهارک', 11),
(130, 'Shighnan','شیغنان','شیغنان', 11),
(131, 'Darwaz','درواز','درواز', 11),
(132, 'Khwahan','خواهان','خواهان', 11),
(133, 'Ragh','راغ','راغ', 11),
(134, 'Shahri Buzurg','شهربزرگ','شهربزرگ', 11),
(135, 'Arghanj Khwa','ارغنج خاوه','ارغنج خاوه', 11),
(136, 'Argo','ارگو','ارگو', 11),
(137, 'Darayim','دره یم','دره یم', 11),
(138, 'Darwazi Bala','دروازبالا','دروازبالا', 11),
(139, 'Khash','خاش','خاش', 11),
(140, 'Kohistan','کوهستان','کوهستان', 11),
(141, 'Kuf Ab','کوف آب','کوف آب', 11),
(142, 'Shiki','شیکی','شیکی', 11),
(143, 'Shuhada','شهدا','شهدا', 11),
(144, 'Tagab (Kishmi Bala)','تگاب (کیشم بالا )','تگاب (کیشم بالا )', 11),
(145, 'Tishkan','تشکان','تشکان', 11),
(146, 'Warduj','وردوج','وردوج', 11),
(147, 'Yaftali Sufla','یفتل سفلا','یفتل سفلا', 11),
(148, 'Yamgan (Girwan)','یمگان ( گیروان )','یمگان ( گیروان )', 11),
(149, 'Yawan','یاوان','یاوان', 11),
(150, 'Taluqan','تالقان','تالقان', 12),
(151, 'Bangi','بنگی','بنگی', 12),
(152, 'Ishkamish','اشکمش','اشکمش', 12),
(153, 'Chal','چال','چال', 12),
(154, 'Warsaj','ورسج','ورسج', 12),
(155, 'Farkhar','فرخار','فرخار', 12),
(156, 'Kalafgan','کلفگان','کلفگان', 12),
(157, 'Rustaq','رستاق','رستاق', 12),
(158, 'Chah Ab',' چاه آب',' چاه آب', 12),
(159, 'Yangi Qala','ینگی قلعه','ینگی قلعه', 12),
(160, 'Darqad','درقد','درقد', 12),
(161, 'Khwaja Ghar','خواجه غار','خواجه غار', 12),
(162, 'Baharak','بهارک','بهارک', 12),
(163, 'Dashti Qala',' دشت قلعه',' دشت قلعه', 12),
(164, 'Hazar Sumuch','هزارسموج','هزارسموج', 12),
(165, 'Khwaja Bahawuddin','خواجه بهاوالدین','خواجه بهاوالدین', 12),
(166, 'Namak Ab','نمک آّب','نمک آّب', 12),
(167, 'Puli Khumri','پلخمری ','پلخمری', 13),
(168, 'Puli Hisar','پل حصار','پل حصار', 13),
(169, 'Dahana-I- Ghuri','دهنه غوری','دهنه غوری', 13),
(170, 'Dushi','دوشی','دوشی', 13),
(171, 'Tala Wa Barfak','تاله وبرفک','تاله وبرفک', 13),
(172, 'Khinjan','خنجان','خنجان', 13),
(173, 'Andarab','اندراب','اندراب', 13),
(174, 'Khost Wa Firing','خوست وفرنگ','خوست وفرنگ', 13),
(175, 'Nahrin','نهرین','نهرین', 13),
(176, 'Burka','برکه','برکه', 13),
(177, 'Baghlani Jadid','بغلان جدید','بغلان جدید', 13),
(178, 'Baghlani Jadid','','', 13),
(179, 'Dih balah','ده بالا','ده بالا', 13),
(180, 'Farang Wa Gharu','فرنگ وغوره','فرنگ وغوره', 13),
(181, 'Guzargahi Nur','گذرگاه نور','گذرگاه نور', 13),
(182, 'Khwaja Hijran (Jilga Nahrin)','خواجه هجراه (جلگه نهرین)','خواجه هجراه (جلگه نهرین)', 13),
(183, 'Kunduz','کندز','کندز', 14),
(184, 'Imam Sahib','امام صاحب','امام صاحب', 14),
(185, 'Qalay-I- Zal','قلعه ذال','قلعه ذال', 14),
(186, 'Chahar Dara','چهاردره','چهاردره', 14),
(187, 'Aliabad','علی آباد','علی آباد', 14),
(188, 'Khanabad','خان آباد','خان آباد', 14),
(189, 'Archi','هرچی','هرچی', 14),
(190, 'Aybak','ایبک','ایبک', 15),
(191, 'Hazrati Sultan','حضرت سلطان','حضرت سلطان', 15),
(192, 'Dara-I-Sufi Bala','دره صوف','دره صوف', 15),
(193, 'Dara-I-Sufi Payin','دره صوف پائین','دره صوف پائین', 15),
(194, 'Ruyi Du Ab','روی دوآب','روی دوآب', 15),
(195, 'Khuram Wa Sarbagh','خرم وسرباغ','خرم وسرباغ', 15),
(196, 'Feroz Nakhchir','فیروز نخچیر','فیروز نخچیر', 15),
(197, 'Mazari Sharif','مزارشریف','مزارشریف', 16),
(198, 'Nahri Shahi','نهرشاهی','نهرشاهی', 16),
(199, 'Zari','زاری','زاری', 16),
(200, 'Shortepa','شورتپه','شورتپه', 16),
(201, 'Dawlatabad','دولت آباد','دولت آباد', 16),
(202, 'Balkh','بلخ','بلخ', 16),
(203, 'Chahar Bolak','چهاربولک','چهاربولک', 16),
(204, 'Chimtal','چیمتال','چیمتال', 16),
(205, 'Sholgara','شولگره','شولگره', 16),
(206, 'Kishindih','خشینده','خشینده', 16),
(207, 'Chahar Kint','چهارکنت','چهارکنت', 16),
(208, 'Dihdadi','ده دادی','ده دادی', 16),
(209, 'Kaldar','کلدار','کلدار', 16),
(210, 'Khulm','خلم','خلم', 16),
(211, 'Marmul','مرمل','مرمل', 16),
(212, 'Shibirghan','شبرغان','شبرغان', 17),
(213, 'Khwaja Du Koh','خواجه دوکوه','خواجه دوکوه', 17),
(214, 'Darzab','درزاب','درزاب', 17),
(215, 'Mingajik','منجیلک','منجیلک', 17),
(216, 'Qarqin','قرقین','قرقین', 17),
(217, 'Aqcha','آقچه','آقچه', 17),
(218, 'Mardyan','مردیان','مردیان', 17),
(219, 'Fayzabad','فیض اباد','فیض اباد', 17),
(220, 'Khamyab','خمیاب','خمیاب', 17),
(221, 'Khaniqa','خانقاه','خانقاه', 17),
(222, 'Qush Tepa','کوش تپه','کوش تپه', 17),
(223, 'Maymana','میمنه','میمنه', 18),
(224, 'Pashtun Kot',' پشتون کوت',' پشتون کوت', 18),
(225, 'Almar','آلمار','آلمار', 18),
(226, 'Qaysar','قیصار','قیصار', 18),
(227, 'Kohistan','کوهستان','کوهستان', 18),
(228, 'Bilchiragh','بلچراغ','بلچراغ', 18),
(229, 'Gurziwan','گیرزیوان','گیرزیوان', 18),
(230, 'Shirin Tagab','شیرین تگاب','شیرین تگاب', 18),
(231, 'Dawlatabad','دولت اباد','دولت اباد', 18),
(232, 'Qaramqol','قرمقول','قرمقول', 18),
(233, 'Khani Chahar Bagh','خانچارباغ','خانچارباغ', 18),
(234, 'Andkhoy','اندخوی','اندخوی', 18),
(235, 'Khwaja Sabz Posh','خواجه سبزپوش','خواجه سبزپوش', 18),
(236, 'Qurghan','قرغان','قرغان', 18),
(237, 'Qala-I- Naw','قلعه نو','قلعه نو', 19),
(238, 'Ab Kamari','آب کمری','آب کمری', 19),
(239, 'Qadis','قادس','قادس', 19),
(240, 'Jawand','جاوند','جاوند', 19),
(241, 'Ghormach','غورماچ','غورماچ', 19),
(242, 'Murghab','مرغاب','مرغاب', 19),
(243, 'Muqur','مقور','مقور', 19),
(244, 'Hirat','هرات','هرات', 20),
(245, 'Injil','انجیل','انجیل', 20),
(246, 'Guzara','گذره','گذره', 20),
(247, 'Pashtun Zarghun','پشتون زرغون','پشتون زرغون', 20),
(248, 'Karukh','کروخ','کروخ', 20),
(249, 'Kushk','کوشک','کوشک', 20),
(250, 'Gulran','گلران','گلران', 20),
(251, 'Kohsan','کوهسان','کوهسان', 20),
(252, 'Ghoryan','غوریان','غوریان', 20),
(253, 'Zinda  Jan','زندجان','زندجان', 20),
(254, 'Adraskan','ادرسکن','ادرسکن', 20),
(255, 'Obe','اوبی','اوبی', 20),
(256, 'Farsi','فارسی','فارسی', 20),
(257, 'Shindand','شندند','شندند', 20),
(258, 'Chishti Sharif','چشت شریف','چشت شریف', 20),
(259, 'Kushki Kuhna','کشک کهنه','کشک کهنه', 20),
(260, 'Farah','فراه','فراه', 21),
(261, 'Bakwa','بکوا','بکوا', 21),
(262, 'Gulistan','گلستان','گلستان', 21),
(263, 'Pur Chaman','پورچمن','پورچمن', 21),
(264, 'Bala Buluk','بالابلوک','بالابلوک', 21),
(265, 'Khaki Safed','خاکی سفید','خاکی سفید', 21),
(266, 'Anar Dara','اناردره','اناردره', 21),
(267, 'Qala-I-Kah','قلعه کاه','قلعه کاه', 21),
(268, 'Lash Wa Juwayn','لش وجوین','لش وجوین', 21),
(269, 'Shib Koh','شیب کوه','شیب کوه', 21),
(270, 'Pusht Rod','پشت رود','پشت رود', 21),
(271, 'Zaranj','زرنج','زرنج', 22),
(272, 'Kang','کنگ','کنگ', 22),
(273, 'Chahar Burjak','چهاربرجک','چهاربرجک', 22),
(274, 'Chakhansur','چخانسور','چخانسور', 22),
(275, 'Khash Rod','خاشرود','خاشرود', 22),
(276, 'Lashkar Gah','لشکرگاه','لشکرگاه', 23),
(277, 'Nahri Sarraj','نهرسراج','نهرسراج', 23),
(278, 'Kajaki','کجکی','کجکی', 23),
(279, 'Musa Qala','موسی قلعه','موسی قلعه', 23),
(280, 'Baghran','باغران','باغران', 23),
(281, 'Naw Zad','نوزاد','نوزاد', 23),
(282, 'Washer','واشیر','واشیر', 23),
(283, 'Nad Ali','نادعلی','نادعلی', 23),
(284, 'Nawa-I- Barak Zayi','ناوه بارکزی','ناوه بارکزی', 23),
(285, 'Dishu','دیشو','دیشو', 23),
(286, 'Garmser','گرمسیر','گرمسیر', 23),
(287, 'Sangin','سنگین','سنگین', 23),
(288, 'Reg','ریگ','ریگ', 23),
(289, 'Kandahar','کندهار','کندهار', 24),
(290, 'Daman','دامان','دامان', 24),
(291, 'Shah Wali Kot','شاه ولی کوت','شاه ولی کوت', 24),
(292, 'Arghandab','ارغنداب','ارغنداب', 24),
(293, 'Khakrez','خاکریز','خاکریز', 24),
(294, 'Ghorak','غورک','غورک', 24),
(295, 'Maywand','میوند','میوند', 24),
(296, 'Panjwayi','پنج وائی','پنج وائی', 24),
(297, 'Reg','ریگ','ریگ', 24),
(298, 'Shorabak','شورابک','شورابک', 24),
(299, 'Spin Boldak','سپن بولدک','سپن بولدک', 24),
(300, 'Arghistan','ارغستان','ارغستان', 24),
(301, 'Maruf','معروف','معروف', 24),
(302, 'Miya Nishin','میان شین','میان شین', 24),
(303, 'Nesh','نیش','نیش', 24),
(304, 'Zhari','زاری','زاری', 24),
(305, 'Zabul','زابــل','زابــل', 25),
(306, 'Qalat','قلات','قلات', 25),
(307, 'Shahjoy','شاه جوی','شاه جوی', 25),
(308, 'Arghandab','ارغنداب','ارغنداب', 25),
(309, 'Daychopan','دای چوپان','دای چوپان', 25),
(310, 'Mizan','میزان','میزان', 25),
(311, 'Tarnak Wa Jaldak','ترک وجلدک','ترک وجلدک', 25),
(312, 'Shinkay','شینکی','شینکی', 25),
(313, 'Atghar','اتغر','اتغر', 25),
(314, 'Shamulzayi','شملزی','شملزی', 25),
(315, 'Kakar','کاکر','کاکر', 25),
(316, 'Naw Bahar','نوبهار','نوبهار', 25),
(317, 'oruzgan','ارزگــان ','ارزگــان ', 26),
(318, 'Tirin Kot','ترینکوت','ترینکوت', 26),
(319, 'Chora','چوره','چوره', 26),
(320, 'Khas Uruzgan','خاص ارزگان','خاص ارزگان', 26),
(321, 'Shahidi Hassas','شهیدحساس','شهیدحساس', 26),
(322, 'Dihrawud','ده راود','ده راود', 26),
(323, 'Chaghcharan','چغچران','چغچران', 27),
(324, 'Shahrak','شهرک','شهرک', 27),
(325, 'Tulak','تولک','تولک', 27),
(326, 'Saghar','ساغر','ساغر', 27),
(327, 'Taywara','تی واره','تی واره', 27),
(328, 'Pasaband','پسابند','پسابند', 27),
(329, 'Lal Wa Sarjangal','لعل وسرجنگل','لعل وسرجنگل', 27),
(330, 'Charsada','چارسده','چارسده', 27),
(331, 'Dawlat Yar','دولت یار','دولت یار', 27),
(332, 'Du Layna','دو لینه','دو لینه', 27),
(333, 'Bamyan','بامیان','بامیان', 28),
(334, 'Shibar','شیبر','شیبر', 28),
(335, 'Kahmard','کهمرد','کهمرد', 28),
(336, 'Yakawlang','یکاولنگ','یکاولنگ', 28),
(337, 'Panjab','پنجاب','پنجاب', 28),
(338, 'Waras','ورس','ورس', 28),
(339, 'Sayghan','سیغان','سیغان', 28),
(340, 'Sharan','شرن','شرن', 29),
(341, 'Zarghun Shahr','زرغون شهر','زرغون شهر', 29),
(342, 'Dila','دیله','دیله', 29),
(343, 'Waza Khwa','وازه خاوه','وازه خاوه', 29),
(344, 'Wor Mamay','ورمامی','ورمامی', 29),
(345, 'Gomal','گومل','گومل', 29),
(346, 'Omna','اومنه','اومنه', 29),
(347, 'Sarobi','سروبی','سروبی', 29),
(348, 'Barmal','برمل','برمل', 29),
(349, 'Gayan','گیان','گیان', 29),
(350, 'Urgun','اورگون','اورگون', 29),
(351, 'Ziruk','زیروک','زیروک', 29),
(352, 'Nika','نیکه','نیکه', 29),
(353, 'Sar Hawza','سرخوزه','سرخوزه', 29),
(354, 'Mata Khan','مته خان','مته خان', 29),
(355, 'Jani Khel','جانی خیل','جانی خیل', 29),
(356, 'Turwo','تورو','تورو', 29),
(357, 'Yahya Khel','یحی خیل','یحی خیل', 29),
(358, 'Yosuf Khel','یوسف خیل','یوسف خیل', 29),
(359, 'Nuristan','نورستان','نورستان', 30),
(360, 'Kamdesh','کامدیش','کامدیش', 30),
(361, 'Waygal','ویگل','ویگل', 30),
(362, 'Mandol','مندول','مندول', 30),
(363, 'Bargi Matal','برگ متل','برگ متل', 30),
(364, 'Wama','وامه','وامه', 30),
(365, 'Du Ab','دوآب','دوآب', 30),
(366, 'Nurgaram','نورگرم','نورگرم', 30),
(367, 'Sari Pul','سرپل','سرپل', 31),
(368, 'Sangcharak','سنگچارک','سنگچارک', 31),
(369, 'Kohistanat','کوهستانات','کوهستانات', 31),
(370, 'Balkhab','بلخاب','بلخاب', 31),
(371, 'Sozma Qala','سوزمه قلعه','سوزمه قلعه', 31),
(372, 'Sayyad','صیاد','صیاد', 31),
(373, 'Gosfandi','گوسفندی','گوسفندی', 31),
(374, 'Khost(Matun)','خوست (متون)','خوست (متون)', 32),
(375, 'Jaji Maydan','جاجی میدان','جاجی میدان', 32),
(376, 'Tani','تنی','تنی', 32),
(377, 'Spera','سپیره','سپیره', 32),
(378, 'Musa Khel','موسی خیل','موسی خیل', 32),
(379, 'Mando Zayi','مندوزی','مندوزی', 32),
(380, 'Tere Zayi','تیرزی','تیرزی', 32),
(381, 'Nadir Shah Kot','نادرشاه کوت','نادرشاه کوت', 32),
(382, 'Sabari','صابری','صابری', 32),
(383, 'Bak','بک','بک', 32),
(384, 'Gurbuz','گورباز','ګورباز', 32),
(385, 'Qalandar','قلندر','قلندر', 32),
(386, 'Shamal','شمال','شمال', 32),
(387, 'Bazarak','بازارک','بازارک', 33),
(388, 'Dara','دره','دره', 33),
(389, 'Hisa-I-Awal Panjsher','حصه اول پنجشیر','حصه اول پنجشیر', 33),
(390, 'Paryan','پریان','پریان', 33),
(391, 'Shutul','شتل','شتل', 33),
(392, 'Unaba','انابه','انابه', 33),
(393, 'Rukha','رخه','رخه', 33),
(394, 'Rukha','','', 33),
(395, 'Nili','نیلی','نیلی', 34),
(396, 'Gizab','گیزاب','گیزاب', 34),
(397, 'Ishtarlay','اشترلی','اشترلی', 34),
(398, 'Kajran','کجران','کجران', 34),
(399, 'Khadir','خدیر','خدیر', 34),
(400, 'Kiti','کیتی','کیتی', 34),
(401, 'Miramor','میرامور','میرامور', 34),
(402, 'Sangi Takht','سنگی تخت بندر','سنگی تخت بندر', 34),
(403, 'Shahristan','شهرستان','شهرستان', 34);


--
-- Dumping data for table `court_decision_type`
--

INSERT INTO `court_decision_type` (`id`, `decision_type_name_english`, `decision_type_name_dari`, `decision_type_name_pashto`) VALUES
(1, 'Primary Court', 'فیصله ابتدایی', 'فیصله ابتدایی'),
(2, 'Appellet Court', 'فیصله استیناف', 'فیصله استیناف'),
(3, 'Supreme Court', 'فیصله تمیز', 'فیصله تمیز');
