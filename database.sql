CREATE DATABASE IF NOT EXISTS `prison` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `prison`;
--
-- Database: `prison`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `isadmin` tinyint(1) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `password`, `isadmin`, `email`) VALUES
(3, 'Hameedullah', 'Pardess', 'hpardess', '9a69e50114a30c4c5c1d455a2cfb87d1', 1, NULL),
(4, 'Naser', 'Rawan', 'naserrawan', '9a69e50114a30c4c5c1d455a2cfb87d1', 0, NULL);