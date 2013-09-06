-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 01, 2011 at 03:34 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `resa_planning`
--

-- --------------------------------------------------------

--
-- Table structure for table `rdv`
--

CREATE TABLE IF NOT EXISTS `rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_stagiaire` int(11) NOT NULL,
  `ref_formateur` int(11) NOT NULL,
  `cour_sur` varchar(50) NOT NULL,
  `autre_numero_appel` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `timeslot` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=148 ;

--
-- Dumping data for table `rdv`
--

INSERT INTO `rdv` (`id`, `ref_stagiaire`, `ref_formateur`, `cour_sur`, `autre_numero_appel`, `date`, `time_start`, `timeslot`, `status`) VALUES
(1, 1, 8, 'identifiant_skype', '', '2011-08-10', '09:00:00', '9H00-9H30', 'complete'),
(2, 1, 9, 'identifiant_skype', '', '2011-08-24', '14:30:00', '14H30-15H00', 'complete'),
(3, 1, 8, 'identifiant_skype', '', '2011-08-25', '13:00:00', '13H00-13H30', 'complete'),
(4, 1, 9, 'identifiant_skype', '', '2011-08-26', '11:30:00', '11H30-12H00', 'cancelled'),
(6, 2, 8, 'identifiant_skype', '', '2011-08-25', '14:30:00', '14H30-15H00', 'complete'),
(7, 2, 8, 'identifiant_skype', '', '2011-08-08', '14:30:00', '14H30-15H00', 'complete'),
(8, 1, 7, 'identifiant_skype', '', '2011-08-08', '12:30:00', '12H30-13H00', 'complete'),
(128, 1, 7, 'identifiant_skype', '', '2011-09-07', '12:00:00', '12H00-12H30', 'active'),
(12, 2, 8, 'identifiant_skype', '', '2011-08-25', '20:00:00', '20H00-20H30', 'cancelled'),
(35, 1, 8, 'tel_domicile', '', '2011-08-11', '16:00:00', '16H00-16H30', 'complete'),
(33, 2, 8, 'identifiant_skype', '', '2011-08-11', '20:30:00', '20H30-21H00', 'complete'),
(32, 2, 8, 'identifiant_skype', '', '2011-08-11', '13:00:00', '13H00-13H30', 'complete'),
(31, 2, 8, 'identifiant_skype', '', '2011-08-11', '17:30:00', '17H30-18H00', 'complete'),
(30, 2, 8, 'identifiant_skype', '', '2011-08-25', '15:30:00', '15H30-16H00', 'cancelled'),
(29, 2, 8, 'tel_domicile', '', '2011-08-24', '15:30:00', '15H30-16H00', 'cancelled'),
(28, 2, 8, 'identifiant_skype', '', '2011-08-29', '19:30:00', '19H30-20H00', 'cancelled'),
(36, 1, 7, 'identifiant_skype', '', '2011-08-11', '19:00:00', '19H00-19H30', 'complete'),
(46, 1, 8, 'tel_domicile', '', '2011-08-23', '21:30:00', '21H30-22H00', 'cancelled'),
(45, 1, 8, 'tel_domicile', '', '2011-08-23', '16:30:00', '16H30-17H00', 'lost'),
(44, 1, 9, 'tel_domicile', '', '2011-08-23', '16:00:00', '16H00-16H30', 'lost'),
(43, 1, 7, 'tel_domicile', '', '2011-08-18', '19:30:00', '19H30-20H00', 'lost'),
(42, 1, 8, 'identifiant_skype', '', '2011-08-18', '13:00:00', '13H00-13H30', 'complete'),
(47, 1, 8, 'tel_domicile', '', '2011-08-23', '11:30:00', '11H30-12H00', 'lost'),
(48, 1, 8, 'tel_domicile', '', '2011-08-26', '08:00:00', '8H00-8H30', 'cancelled'),
(50, 1, 8, 'tel_domicile', '', '2011-08-22', '13:00:00', '13H00-13H30', 'cancelled'),
(52, 1, 8, 'identifiant_skype', '', '2011-08-19', '13:00:00', '13H00-13H30', 'cancelled'),
(55, 1, 8, 'autre', '01 70 70 74 75', '2011-08-24', '18:30:00', '18H30-19H00', 'complete'),
(56, 1, 9, 'tel_domicile', '', '2011-08-24', '20:00:00', '20H00-20H30', 'lost'),
(57, 1, 8, 'tel_domicile', '', '2011-08-26', '16:00:00', '16H00-16H30', 'cancelled'),
(58, 1, 8, 'tel_domicile', '', '2011-08-26', '16:30:00', '16H30-17H00', 'cancelled'),
(59, 1, 9, 'autre', '01 70 70 74 75', '2011-08-19', '12:30:00', '12H30-13H00', 'complete'),
(61, 1, 8, 'tel_domicile', '', '2011-08-25', '17:00:00', '17H00-17H30', 'complete'),
(62, 1, 8, 'autre', '01 70 70 74 75', '2011-08-25', '18:30:00', '18H30-19H00', 'cancelled'),
(63, 1, 8, 'tel_domicile', '', '2011-08-26', '21:30:00', '21H30-22H00', 'complete'),
(64, 1, 7, 'autre', '01 70 70 74 73', '2011-08-24', '14:00:00', '14H00-14H30', 'complete'),
(91, 1, 9, 'identifiant_skype', '', '2011-08-30', '12:30:00', '12H30-13H00', 'cancelled'),
(90, 1, 8, 'tel_domicile', '', '2011-08-19', '21:00:00', '21H00-21H30', 'complete'),
(89, 1, 7, 'tel_domicile', '', '2011-08-19', '19:00:00', '19H00-19H30', 'lost'),
(88, 1, 9, 'tel_domicile', '', '2011-08-19', '19:00:00', '19H00-19H30', 'complete'),
(87, 1, 8, 'tel_domicile', '', '2011-08-19', '14:00:00', '14H00-14H30', 'complete'),
(86, 1, 9, 'identifiant_skype', '', '2011-08-19', '15:00:00', '15H00-15H30', 'complete'),
(85, 1, 8, 'tel_domicile', '', '2011-08-18', '21:30:00', '21H30-22H00', 'complete'),
(84, 1, 8, 'tel_domicile', '', '2011-08-17', '14:00:00', '14H00-14H30', 'cancelled'),
(83, 1, 8, 'tel_domicile', '', '2011-08-17', '16:30:00', '16H30-17H00', 'cancelled'),
(82, 1, 8, 'tel_domicile', '', '2011-08-17', '16:00:00', '16H00-16H30', 'cancelled'),
(81, 1, 7, 'tel_domicile', '', '2011-08-17', '18:30:00', '18H30-19H00', 'complete'),
(80, 1, 8, 'tel_domicile', '', '2011-08-17', '21:30:00', '21H30-22H00', 'complete'),
(126, 1, 8, 'tel_domicile', '', '2011-08-31', '15:30:00', '15H30-16H00', 'active'),
(125, 1, 7, 'tel_domicile', '', '2011-08-31', '16:30:00', '16H30-17H00', 'active'),
(92, 1, 8, 'identifiant_skype', '', '2011-08-25', '20:30:00', '20H30-21H00', 'cancelled'),
(93, 1, 9, 'tel_domicile', '', '2011-08-26', '21:30:00', '21H30-22H00', 'cancelled'),
(94, 1, 9, 'tel_domicile', '', '2011-08-26', '21:30:00', '21H30-22H00', 'cancelled'),
(95, 1, 8, 'tel_domicile', '', '2011-08-25', '21:30:00', '21H30-22H00', 'cancelled'),
(96, 1, 7, 'tel_domicile', '', '2011-08-25', '18:00:00', '18H00-18H30', 'complete'),
(98, 1, 8, 'tel_domicile', '', '2011-08-27', '21:30:00', '21H30-22H00', 'cancelled'),
(101, 1, 8, 'identifiant_skype', '', '2011-08-25', '21:00:00', '21H00-21H30', 'cancelled'),
(103, 1, 8, 'tel_domicile', '', '2011-08-26', '18:30:00', '18H30-19H00', 'complete'),
(104, 1, 8, 'tel_domicile', '', '2011-08-31', '17:00:00', '17H00-17H30', 'cancelled'),
(105, 1, 8, 'tel_domicile', '', '2011-08-31', '19:30:00', '19H30-20H00', 'cancelled'),
(106, 1, 8, 'tel_domicile', '', '2011-08-31', '21:30:00', '21H30-22H00', 'cancelled'),
(107, 1, 8, 'tel_domicile', '', '2011-08-31', '11:30:00', '11H30-12H00', 'cancelled'),
(108, 1, 9, 'tel_domicile', '', '2011-08-30', '17:00:00', '17H00-17H30', 'cancelled'),
(109, 1, 9, 'tel_domicile', '', '2011-08-25', '21:30:00', '21H30-22H00', 'complete'),
(110, 1, 9, 'identifiant_skype', '', '2011-08-25', '19:00:00', '19H00-19H30', 'complete'),
(127, 1, 8, 'tel_domicile', '', '2011-09-14', '12:00:00', '12H00-12H30', 'active'),
(111, 1, 8, 'tel_domicile', '', '2011-08-26', '21:00:00', '21H00-21H30', 'cancelled'),
(112, 1, 9, 'tel_domicile', '', '2011-08-29', '13:30:00', '13H30-14H00', 'complete'),
(113, 1, 8, 'tel_domicile', '', '2011-08-29', '13:30:00', '13H30-14H00', 'complete'),
(114, 1, 9, 'tel_domicile', '', '2011-08-30', '20:30:00', '20H30-21H00', 'active'),
(115, 1, 8, 'tel_domicile', '', '2011-08-29', '21:00:00', '21H00-21H30', 'lost'),
(116, 1, 7, 'tel_domicile', '', '2011-08-29', '15:30:00', '15H30-16H00', 'complete'),
(117, 1, 8, 'identifiant_skype', '', '2011-08-31', '17:00:00', '17H00-17H30', 'active'),
(118, 1, 9, 'tel_domicile', '', '2011-08-31', '19:00:00', '19H00-19H30', 'active'),
(119, 1, 7, 'tel_domicile', '', '2011-08-31', '08:30:00', '8H30-9H00', 'active'),
(121, 1, 8, 'tel_domicile', '', '2011-08-31', '21:30:00', '21H30-22H00', 'active'),
(122, 1, 9, 'identifiant_skype', '', '2011-08-30', '19:00:00', '19H00-19H30', 'active'),
(123, 1, 8, 'tel_domicile', '', '2011-08-29', '13:30:00', '13H30-14H00', 'complete'),
(124, 1, 8, 'tel_domicile', '', '2011-09-02', '17:00:00', '17H00-17H30', 'complete'),
(129, 1, 8, 'tel_domicile', '', '2011-09-01', '09:00:00', '9H00-9H30', 'active'),
(130, 1, 8, 'tel_domicile', '', '2011-09-20', '08:30:00', '8H30-9H00', 'active'),
(131, 1, 8, 'tel_domicile', '', '2011-08-31', '19:30:00', '19H30-20H00', 'active'),
(132, 1, 8, 'tel_domicile', '', '2011-08-31', '14:30:00', '14H30-15H00', 'active'),
(133, 1, 8, 'tel_domicile', '', '2011-08-31', '13:30:00', '13H30-14H00', 'active'),
(134, 3, 8, 'tel_domicile', '', '2011-08-31', '19:00:00', '19H00-19H30', 'active'),
(135, 3, 8, 'tel_domicile', '', '2011-08-31', '17:30:00', '17H30-18H00', 'active'),
(136, 3, 8, 'tel_domicile', '', '2011-08-31', '10:00:00', '10H00-10H30', 'active'),
(137, 3, 8, 'tel_domicile', '', '2011-08-31', '14:00:00', '14H00-14H30', 'active'),
(138, 1, 9, 'tel_domicile', '', '2011-08-31', '12:00:00', '12H00-12H30', 'active'),
(139, 1, 8, 'identifiant_skype', '', '2011-08-31', '11:30:00', '11H30-12H00', 'active'),
(140, 1, 8, 'tel_bureau', '', '2011-08-31', '18:30:00', '18H30-19H00', 'active'),
(141, 2, 8, 'identifiant_skype', '', '2011-08-31', '18:00:00', '18H00-18H30', 'active'),
(142, 2, 8, 'tel_bureau', '', '2011-09-01', '15:00:00', '15H00-15H30', 'active'),
(143, 2, 8, 'identifiant_skype', '', '2011-09-01', '19:30:00', '19H30-20H00', 'active'),
(144, 3, 8, 'tel_bureau', '', '2011-08-31', '16:30:00', '16H30-17H00', 'active'),
(145, 3, 9, 'tel_domicile', '', '2011-09-01', '15:00:00', '15H00-15H30', 'active'),
(146, 3, 9, 'tel_domicile', '', '2011-08-31', '16:00:00', '16H00-16H30', 'active'),
(147, 1, 8, 'tel_bureau', '', '2011-09-06', '11:30:00', '11H30-12H00', 'active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
