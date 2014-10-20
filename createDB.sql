-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2012 at 03:15 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `p31`
--

-- --------------------------------------------------------

--
-- Table structure for table `liaisons`
--

CREATE TABLE `liaisons` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `villeDepart` bigint(20) NOT NULL,
  `villeArrivee` bigint(20) NOT NULL,
  `longueur` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_VILLE_DEPART` (`villeDepart`),
  KEY `FK_VILLE_ARRIVEE` (`villeArrivee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `liaisons`
--


-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user` bigint(20) NOT NULL,
  `trajet` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `FK_USER` (`user`),
  KEY `FK_TRAJET` (`trajet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `reservations`
--


-- --------------------------------------------------------

--
-- Table structure for table `trains`
--

CREATE TABLE `trains` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nbPlaces` int(11) NOT NULL,
  `vitesse` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `trains`
--


-- --------------------------------------------------------

--
-- Table structure for table `trajets`
--

CREATE TABLE `trajets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `liaison` bigint(20) NOT NULL,
  `train` bigint(20) NOT NULL,
  `heureDepart` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_LIAISON` (`liaison`),
  KEY `FK_TRAIN` (`train`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trajets`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--


-- --------------------------------------------------------

--
-- Table structure for table `villes`
--

CREATE TABLE `villes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `villes`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `liaisons`
--
ALTER TABLE `liaisons`
  ADD CONSTRAINT `liaisons_ibfk_3` FOREIGN KEY (`villeDepart`) REFERENCES `villes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `liaisons_ibfk_4` FOREIGN KEY (`villeArrivee`) REFERENCES `villes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`trajet`) REFERENCES `trajets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trajets`
--
ALTER TABLE `trajets`
  ADD CONSTRAINT `trajets_ibfk_2` FOREIGN KEY (`train`) REFERENCES `trains` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trajets_ibfk_1` FOREIGN KEY (`liaison`) REFERENCES `liaisons` (`id`) ON DELETE CASCADE;
