/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `grds` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `grds`;

CREATE TABLE IF NOT EXISTS `classe` (
  `IdClasse` int(11) NOT NULL AUTO_INCREMENT,
  `Designation` text NOT NULL,
  `InternshipDate` text NOT NULL,
  PRIMARY KEY (`IdClasse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `classe` DISABLE KEYS */;
/*!40000 ALTER TABLE `classe` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `interest` (
  `IdRole` int(11) NOT NULL,
  `IdInternship` int(11) NOT NULL,
  PRIMARY KEY (`IdRole`,`IdInternship`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `interest` DISABLE KEYS */;
/*!40000 ALTER TABLE `interest` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `internship` DISABLE KEYS */;
INSERT INTO `internship` (`IdInternship`, `Designation`, `Description`, `Website`, `Enterprise`, `Author`, `Email`, `Phone`) VALUES
	(1, 'ISN Services', 'Our Main Job is based on a big experience and professionalism: Maintain consistency of information published on the Website / Portal Enhance and manage Digital presence, as per guidelines including on-line brand management, strategy development, and tactical implementation plus tracking/reporting Coordinate with internal departments and ensure optimization for any initiative which can be taken Perform update and maintenance for website / Portal Search engine optimization Web security (cryptographic algorithm).', 'https://www.isn-services.com/', 'ISN Services', 'BACHIR EL HAGES', 'beh@exemple.com', '0972509003');
/*!40000 ALTER TABLE `internship` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `link` (
  `IdClasse` int(11) NOT NULL,
  `IdInternship` int(11) NOT NULL,
  PRIMARY KEY (`IdClasse`,`IdInternship`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `link` DISABLE KEYS */;
/*!40000 ALTER TABLE `link` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `role` (
  `IdRole` int(11) NOT NULL AUTO_INCREMENT,
  `Designation` text NOT NULL,
  PRIMARY KEY (`IdRole`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `user` (
  `IdUser` int(11) NOT NULL AUTO_INCREMENT,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `LM` text NOT NULL,
  `CV` text NOT NULL,
  `ProfilPicture` text NOT NULL,
  `Email` text NOT NULL,
  `IdRole` int(11) NOT NULL,
  `IdClasse` int(11) NOT NULL,
  PRIMARY KEY (`IdUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
