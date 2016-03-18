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
-- Table `prison`.`province`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`province` ;

CREATE TABLE IF NOT EXISTS `prison`.`province` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prison`.`district`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prison`.`district` ;

CREATE TABLE IF NOT EXISTS `prison`.`district` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `province_id` INT NOT NULL,
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

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `name`) VALUES
(1, 'Kabul'),
(2, 'Kapisa'),
(3, 'Parwan'),
(4, 'Wardak'),
(5, 'Logar'),
(6, 'Ghazni'),
(7, 'Paktya'),
(8, 'Nangarhar'),
(9, 'Laghman'),
(10, 'Kunar'),
(11, 'Badakhshan'),
(12, 'Takhar'),
(13, 'Baghlan'),
(14, 'Kunduz'),
(15, 'Samangan'),
(16, 'Balkh'),
(17, 'Jawzjan'),
(18, 'Faryab'),
(19, 'Badghis'),
(20, 'Hirat'),
(21, 'Farah'),
(22, 'Nimroz'),
(23, 'Hilmand'),
(24, 'Kandahar'),
(25, 'Zabul'),
(26, 'Uruzgan'),
(27, 'Ghor'),
(28, 'Bamyan'),
(29, 'Paktika'),
(30, 'Nuristan'),
(31, 'Sari Pul'),
(32, 'Khost'),
(33, 'Panjsher'),
(34, 'Daykundi');

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`, `province_id`) VALUES
(1, 'Kabul', 1),
(2, 'Dih Sabz', 1),
(3, 'Mir Bacha Kot', 1),
(4, 'Kalakan', 1),
(5, 'Qarabagh', 1),
(6, 'Istalif', 1),
(7, 'Shakardara', 1),
(8, 'Paghman', 1),
(9, 'Chahar Asyab', 1),
(10, 'Bagrami', 1),
(11, 'Khaki Jabbar', 1),
(12, 'Surobi', 1),
(13, 'Guldara', 1),
(14, 'Musayi', 1),
(15, 'Farza', 1),
(16, 'Mahmudi Raqi', 2),
(17, 'Hisa-i-Awali Kohistan', 2),
(18, 'Koh Band', 2),
(19, 'Nijrab', 2),
(20, 'Tagab', 2),
(21, 'Alasay', 2),
(22, 'Hisa-i-Duwumi Kohistan', 2),
(23, 'Chaharikar', 3),
(24, 'Jabalussaraj', 3),
(25, 'Salang', 3),
(26, 'Shinwari', 3),
(27, 'Ghorband', 3),
(28, 'Shekh  Ali', 3),
(29, 'Surkhi Parsa', 3),
(30, 'Bagram', 3),
(31, 'Kohi Safi', 3),
(32, 'Sayd Khel', 3),
(33, 'Maydan Shahr', 4),
(34, 'Jalrez', 4),
(35, 'Hisa-I- Awali Bihsud', 4),
(36, 'Markazi Bihsud', 4),
(37, 'Day Mirdad', 4),
(38, 'Chaki Wardak', 4),
(39, 'Saydabad', 4),
(40, 'Nirkh', 4),
(41, 'Jaghatu', 4),
(42, 'Puli Alam', 5),
(43, 'Charkh', 5),
(44, 'Baraki Barak', 5),
(45, 'Khushi', 5),
(46, 'Muhammad Agha', 5),
(47, 'Azra', 5),
(48, 'Kharwar', 5),
(49, 'Ghazni', 6),
(50, 'Bahrami Shahid (Jaghatu)', 6),
(51, 'Khwaja Umari', 6),
(52, 'Nawur', 6),
(53, 'Ajristan', 6),
(54, 'Malistan', 6),
(55, 'Jaghuri', 6),
(56, 'Muqur', 6),
(57, 'Gelan', 6),
(58, 'Nawa', 6),
(59, 'Ab Band', 6),
(60, 'Giro', 6),
(61, 'Qarabagh', 6),
(62, 'Andar', 6),
(63, 'Dih Yak', 6),
(64, 'Zana Khan', 6),
(65, 'Rashidan', 6),
(66, 'Waghaz', 6),
(67, 'Wali Muhammadi Shahid', 6),
(68, 'Wali Muhammadi Shahid', 6),
(69, 'Gardez', 7),
(70, 'Zurmat', 7),
(71, 'Shwak', 7),
(72, 'Wuza Zadran', 7),
(73, 'Ahmadabad', 7),
(74, 'Jani Khel', 7),
(75, 'Dand Wa Patan', 7),
(76, 'Chamkanay', 7),
(77, 'Lija Ahmad Khel', 7),
(78, 'Sayid Karam', 7),
(79, 'Jaji', 7),
(80, 'Jalalabad', 8),
(81, 'Surkh Rod', 8),
(82, 'Hisarak', 8),
(83, 'Sherzad', 8),
(84, 'Khogyani', 8),
(85, 'Chaparhar', 8),
(86, 'Pachir Wa  Agam', 8),
(87, 'Dih Bala', 8),
(88, 'Rodat', 8),
(89, 'Achin', 8),
(90, 'Nazyan', 8),
(91, 'Dur Baba', 8),
(92, 'Shinwar', 8),
(93, 'Muhmand Dara', 8),
(94, 'Lal Pur', 8),
(95, 'Goshta', 8),
(96, 'Bati Kot', 8),
(97, 'Kama', 8),
(98, 'Kuz Kunar', 8),
(99, 'Dara-I-Nur', 8),
(100, 'Bihsud', 8),
(101, 'Kot', 8),
(102, 'Mihtarlam', 9),
(103, 'Qarghayi', 9),
(104, 'Alingar', 9),
(105, 'Dawlat Shah', 9),
(106, 'Alishing', 9),
(107, 'Asadabad', 10),
(108, 'Marawara', 10),
(109, 'Bar Kunar', 10),
(110, 'Dangam', 10),
(111, 'Nari', 10),
(112, 'Ghaziabad', 10),
(113, 'Shaygal wa shiltan', 10),
(114, 'Wata Pur', 10),
(115, 'Chapa Dara', 10),
(116, 'Dara-I-Pech', 10),
(117, 'Narang', 10),
(118, 'Chawkay', 10),
(119, 'Nurgal', 10),
(120, 'Khas Kunar', 10),
(121, 'Sirkanay', 10),
(122, 'Fayzabad', 11),
(123, 'Kishim', 11),
(124, 'Jurm', 11),
(125, 'Kuran Wa Munjan', 11),
(126, 'Zebak', 11),
(127, 'Wakhan', 11),
(128, 'Ishkashim', 11),
(129, 'Baharak', 11),
(130, 'Shighnan', 11),
(131, 'Darwaz', 11),
(132, 'Khwahan', 11),
(133, 'Ragh', 11),
(134, 'Shahri Buzurg', 11),
(135, 'Arghanj Khwa', 11),
(136, 'Argo', 11),
(137, 'Darayim', 11),
(138, 'Darwazi Bala', 11),
(139, 'Khash', 11),
(140, 'Kohistan', 11),
(141, 'Kuf Ab', 11),
(142, 'Shiki', 11),
(143, 'Shuhada', 11),
(144, 'Tagab (Kishmi Bala)', 11),
(145, 'Tishkan', 11),
(146, 'Warduj', 11),
(147, 'Yaftali Sufla', 11),
(148, 'Yamgan (Girwan)', 11),
(149, 'Yawan', 11),
(150, 'Taluqan', 12),
(151, 'Bangi', 12),
(152, 'Ishkamish', 12),
(153, 'Chal', 12),
(154, 'Warsaj', 12),
(155, 'Farkhar', 12),
(156, 'Kalafgan', 12),
(157, 'Rustaq', 12),
(158, 'Chah Ab', 12),
(159, 'Yangi Qala', 12),
(160, 'Darqad', 12),
(161, 'Khwaja Ghar', 12),
(162, 'Baharak', 12),
(163, 'Dashti Qala', 12),
(164, 'Hazar Sumuch', 12),
(165, 'Khwaja Bahawuddin', 12),
(166, 'Namak Ab', 12),
(167, 'Puli Khumri', 13),
(168, 'Puli Hisar', 13),
(169, 'Dahana-I- Ghuri', 13),
(170, 'Dushi', 13),
(171, 'Tala Wa Barfak', 13),
(172, 'Khinjan', 13),
(173, 'Andarab', 13),
(174, 'Khost Wa Firing', 13),
(175, 'Nahrin', 13),
(176, 'Burka', 13),
(177, 'Baghlani Jadid', 13),
(178, 'Baghlani Jadid', 13),
(179, 'Dih Salah', 13),
(180, 'Farang Wa Gharu', 13),
(181, 'Guzargahi Nur', 13),
(182, 'Khwaja Hijran (Jilga Nahrin)', 13),
(183, 'Kunduz', 14),
(184, 'Imam Sahib', 14),
(185, 'Qalay-I- Zal', 14),
(186, 'Chahar Dara', 14),
(187, 'Aliabad', 14),
(188, 'Khanabad', 14),
(189, 'Archi', 14),
(190, 'Aybak', 15),
(191, 'Hazrati Sultan', 15),
(192, 'Dara-I-Sufi Bala', 15),
(193, 'Dara-I-Sufi Payin', 15),
(194, 'Ruyi Du Ab', 15),
(195, 'Khuram Wa Sarbagh', 15),
(196, 'Feroz Nakhchir', 15),
(197, 'Mazari Sharif', 16),
(198, 'Nahri Shahi', 16),
(199, 'Zari', 16),
(200, 'Shortepa', 16),
(201, 'Dawlatabad', 16),
(202, 'Balkh', 16),
(203, 'Chahar Bolak', 16),
(204, 'Chimtal', 16),
(205, 'Sholgara', 16),
(206, 'Kishindih', 16),
(207, 'Chahar Kint', 16),
(208, 'Dihdadi', 16),
(209, 'Kaldar', 16),
(210, 'Khulm', 16),
(211, 'Marmul', 16),
(212, 'Shibirghan', 17),
(213, 'Khwaja Du Koh', 17),
(214, 'Darzab', 17),
(215, 'Mingajik', 17),
(216, 'Qarqin', 17),
(217, 'Aqcha', 17),
(218, 'Mardyan', 17),
(219, 'Fayzabad', 17),
(220, 'Khamyab', 17),
(221, 'Khaniqa', 17),
(222, 'Qush Tepa', 17),
(223, 'Maymana', 18),
(224, 'Pashtun Kot', 18),
(225, 'Almar', 18),
(226, 'Qaysar', 18),
(227, 'Kohistan', 18),
(228, 'Bilchiragh', 18),
(229, 'Gurziwan', 18),
(230, 'Shirin Tagab', 18),
(231, 'Dawlatabad', 18),
(232, 'Qaramqol', 18),
(233, 'Khani Chahar Bagh', 18),
(234, 'Andkhoy', 18),
(235, 'Khwaja Sabz Posh', 18),
(236, 'Qurghan', 18),
(237, 'Qala-I- Naw', 19),
(238, 'Ab Kamari', 19),
(239, 'Qadis', 19),
(240, 'Jawand', 19),
(241, 'Ghormach', 19),
(242, 'Murghab', 19),
(243, 'Muqur', 19),
(244, 'Hirat', 20),
(245, 'Injil', 20),
(246, 'Guzara', 20),
(247, 'Pashtun Zarghun', 20),
(248, 'Karukh', 20),
(249, 'Kushk', 20),
(250, 'Gulran', 20),
(251, 'Kohsan', 20),
(252, 'Ghoryan', 20),
(253, 'Zinda  Jan', 20),
(254, 'Adraskan', 20),
(255, 'Obe', 20),
(256, 'Farsi', 20),
(257, 'Shindand', 20),
(258, 'Chishti Sharif', 20),
(259, 'Kushki Kuhna', 20),
(260, 'Farah', 21),
(261, 'Bakwa', 21),
(262, 'Gulistan', 21),
(263, 'Pur Chaman', 21),
(264, 'Bala Buluk', 21),
(265, 'Khaki Safed', 21),
(266, 'Anar Dara', 21),
(267, 'Qala-I-Kah', 21),
(268, 'Lash Wa Juwayn', 21),
(269, 'Shib Koh', 21),
(270, 'Pusht Rod', 21),
(271, 'Zaranj', 22),
(272, 'Kang', 22),
(273, 'Chahar Burjak', 22),
(274, 'Chakhansur', 22),
(275, 'Khash Rod', 22),
(276, 'Lashkar Gah', 23),
(277, 'Nahri Sarraj', 23),
(278, 'Kajaki', 23),
(279, 'Musa Qala', 23),
(280, 'Baghran', 23),
(281, 'Naw Zad', 23),
(282, 'Washer', 23),
(283, 'Nad Ali', 23),
(284, 'Nawa-I- Barak Zayi', 23),
(285, 'Dishu', 23),
(286, 'Garmser', 23),
(287, 'Sangin', 23),
(288, 'Reg', 23),
(289, 'Kandahar', 24),
(290, 'Daman', 24),
(291, 'Shah Wali Kot', 24),
(292, 'Arghandab', 24),
(293, 'Khakrez', 24),
(294, 'Ghorak', 24),
(295, 'Maywand', 24),
(296, 'Panjwayi', 24),
(297, 'Reg', 24),
(298, 'Shorabak', 24),
(299, 'Spin Boldak', 24),
(300, 'Arghistan', 24),
(301, 'Maruf', 24),
(302, 'Miya Nishin', 24),
(303, 'Nesh', 24),
(304, 'Zhari', 24),
(305, 'Zhari', 24),
(306, 'Qalat', 25),
(307, 'Shahjoy', 25),
(308, 'Arghandab', 25),
(309, 'Daychopan', 25),
(310, 'Mizan', 25),
(311, 'Tarnak Wa Jaldak', 25),
(312, 'Shinkay', 25),
(313, 'Atghar', 25),
(314, 'Shamulzayi', 25),
(315, 'Kakar', 25),
(316, 'Naw Bahar', 25),
(317, 'Naw Bahar', 25),
(318, 'Tirin Kot', 26),
(319, 'Chora', 26),
(320, 'Khas Uruzgan', 26),
(321, 'Shahidi Hassas', 26),
(322, 'Dihrawud', 26),
(323, 'Chaghcharan', 27),
(324, 'Shahrak', 27),
(325, 'Tulak', 27),
(326, 'Saghar', 27),
(327, 'Taywara', 27),
(328, 'Pasaband', 27),
(329, 'Lal Wa Sarjangal', 27),
(330, 'Charsada', 27),
(331, 'Dawlat Yar', 27),
(332, 'Du Layna', 27),
(333, 'Bamyan', 28),
(334, 'Shibar', 28),
(335, 'Kahmard', 28),
(336, 'Yakawlang', 28),
(337, 'Panjab', 28),
(338, 'Waras', 28),
(339, 'Sayghan', 28),
(340, 'Sharan', 29),
(341, 'Zarghun Shahr', 29),
(342, 'Dila', 29),
(343, 'Waza Khwa', 29),
(344, 'Wor Mamay', 29),
(345, 'Gomal', 29),
(346, 'Omna', 29),
(347, 'Sarobi', 29),
(348, 'Barmal', 29),
(349, 'Gayan', 29),
(350, 'Urgun', 29),
(351, 'Ziruk', 29),
(352, 'Nika', 29),
(353, 'Sar Hawza', 29),
(354, 'Mata Khan', 29),
(355, 'Jani Khel', 29),
(356, 'Turwo', 29),
(357, 'Yahya Khel', 29),
(358, 'Yosuf Khel', 29),
(359, 'Nuristan', 30),
(360, 'Kamdesh', 30),
(361, 'Waygal', 30),
(362, 'Mandol', 30),
(363, 'Bargi Matal', 30),
(364, 'Wama', 30),
(365, 'Du Ab', 30),
(366, 'Nurgaram', 30),
(367, 'Sari Pul', 31),
(368, 'Sangcharak', 31),
(369, 'Kohistanat', 31),
(370, 'Balkhab', 31),
(371, 'Sozma Qala', 31),
(372, 'Sayyad', 31),
(373, 'Gosfandi', 31),
(374, 'Khost(Matun)', 32),
(375, 'Jaji Maydan', 32),
(376, 'Tani', 32),
(377, 'Spera', 32),
(378, 'Musa Khel', 32),
(379, 'Mando Zayi', 32),
(380, 'Tere Zayi', 32),
(381, 'Nadir Shah Kot', 32),
(382, 'Sabari', 32),
(383, 'Bak', 32),
(384, 'Gurbuz', 32),
(385, 'Qalandar', 32),
(386, 'Shamal', 32),
(387, 'Bazarak', 33),
(388, 'Dara', 33),
(389, 'Hisa-I-Awal Panjsher', 33),
(390, 'Paryan', 33),
(391, 'Shutul', 33),
(392, 'Unaba', 33),
(393, 'Rukha', 33),
(394, 'Rukha', 33),
(395, 'Nili', 34),
(396, 'Gizab', 34),
(397, 'Ishtarlay', 34),
(398, 'Kajran', 34),
(399, 'Khadir', 34),
(400, 'Kiti', 34),
(401, 'Miramor', 34),
(402, 'Sangi Takht', 34),
(403, 'Shahristan', 34);
