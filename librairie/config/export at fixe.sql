-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour grds
CREATE DATABASE IF NOT EXISTS `grds` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `grds`;

-- Listage de la structure de la table grds. classe
CREATE TABLE IF NOT EXISTS `classe` (
  `IdClasse` int(11) NOT NULL AUTO_INCREMENT,
  `Designation` text NOT NULL,
  `InternshipDate` text NOT NULL,
  PRIMARY KEY (`IdClasse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table grds.classe : ~0 rows (environ)
DELETE FROM `classe`;
/*!40000 ALTER TABLE `classe` DISABLE KEYS */;
/*!40000 ALTER TABLE `classe` ENABLE KEYS */;

-- Listage de la structure de la table grds. interest
CREATE TABLE IF NOT EXISTS `interest` (
  `IdRole` int(11) NOT NULL,
  `IdInternship` int(11) NOT NULL,
  PRIMARY KEY (`IdRole`,`IdInternship`),
  KEY `FK_interest_role` (`IdRole`),
  KEY `FK_interest_internship` (`IdInternship`),
  CONSTRAINT `FK_interest_internship` FOREIGN KEY (`IdInternship`) REFERENCES `internship` (`IdInternship`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_interest_role` FOREIGN KEY (`IdRole`) REFERENCES `role` (`IdRole`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table grds.interest : ~0 rows (environ)
DELETE FROM `interest`;
/*!40000 ALTER TABLE `interest` DISABLE KEYS */;
/*!40000 ALTER TABLE `interest` ENABLE KEYS */;

-- Listage de la structure de la table grds. internship
CREATE TABLE IF NOT EXISTS `internship` (
  `IdInternship` int(11) NOT NULL AUTO_INCREMENT,
  `Designation` text NOT NULL,
  `Description` text NOT NULL,
  `Website` text NOT NULL,
  `Enterprise` text NOT NULL,
  `Author` text NOT NULL,
  `Email` text NOT NULL,
  `Phone` text NOT NULL,
  PRIMARY KEY (`IdInternship`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table grds.internship : ~0 rows (environ)
DELETE FROM `internship`;
/*!40000 ALTER TABLE `internship` DISABLE KEYS */;
INSERT INTO `internship` (`IdInternship`, `Designation`, `Description`, `Website`, `Enterprise`, `Author`, `Email`, `Phone`) VALUES
	(1, 'ISN Services', 'Our Main Job is based on a big experience and professionalism: Maintain consistency of information published on the Website / Portal Enhance and manage Digital presence, as per guidelines including on-line brand management, strategy development, and tactical implementation plus tracking/reporting Coordinate with internal departments and ensure optimization for any initiative which can be taken Perform update and maintenance for website / Portal Search engine optimization Web security (cryptographic algorithm).', 'https://www.isn-services.com/', 'ISN Services', 'BACHIR EL HAGES', 'beh@exemple.com', '0972509003');
/*!40000 ALTER TABLE `internship` ENABLE KEYS */;

-- Listage de la structure de la table grds. link
CREATE TABLE IF NOT EXISTS `link` (
  `IdClasse` int(11) NOT NULL,
  `IdInternship` int(11) NOT NULL,
  PRIMARY KEY (`IdClasse`,`IdInternship`),
  KEY `FK_link_internship` (`IdInternship`),
  KEY `FK_link_classe` (`IdClasse`),
  CONSTRAINT `FK_link_classe` FOREIGN KEY (`IdClasse`) REFERENCES `classe` (`IdClasse`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_link_internship` FOREIGN KEY (`IdInternship`) REFERENCES `internship` (`IdInternship`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table grds.link : ~0 rows (environ)
DELETE FROM `link`;
/*!40000 ALTER TABLE `link` DISABLE KEYS */;
/*!40000 ALTER TABLE `link` ENABLE KEYS */;

-- Listage de la structure de la table grds. role
CREATE TABLE IF NOT EXISTS `role` (
  `IdRole` int(11) NOT NULL AUTO_INCREMENT,
  `Designation` text NOT NULL,
  PRIMARY KEY (`IdRole`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Listage des données de la table grds.role : ~2 rows (environ)
DELETE FROM `role`;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`IdRole`, `Designation`) VALUES
	(1, 'Administrateur'),
	(2, 'Eleve');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Listage de la structure de la table grds. user
CREATE TABLE IF NOT EXISTS `user` (
  `IdUser` int(11) NOT NULL AUTO_INCREMENT,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `LM` text,
  `CV` text,
  `ProfilPicture` text,
  `Email` text NOT NULL,
  `IdRole` int(11) NOT NULL,
  `IdClasse` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdUser`),
  KEY `FK_user_role` (`IdRole`),
  KEY `FK_user_classe` (`IdClasse`),
  CONSTRAINT `FK_user_classe` FOREIGN KEY (`IdClasse`) REFERENCES `classe` (`IdClasse`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_user_role` FOREIGN KEY (`IdRole`) REFERENCES `role` (`IdRole`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table grds.user : ~0 rows (environ)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`IdUser`, `Username`, `Password`, `LM`, `CV`, `ProfilPicture`, `Email`, `IdRole`, `IdClasse`) VALUES
	(1, 'fcarisey', '$2y$10$hghtCPHuO7JVUkbyCtZv6eaxEG47h6EEQEDp0Msx1H0I1MP.pwBT6', NULL, NULL, NULL, 'fcarisey@groupmontroland.fr', 2, NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
