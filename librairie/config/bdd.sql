/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `grds` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `grds`;

CREATE TABLE IF NOT EXISTS `admin` (
  `idadmin` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilpicture` varchar(50) NOT NULL,
  `courriel` varchar(50) NOT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`idadmin`, `firstname`, `lastname`, `username`, `password`, `profilpicture`, `courriel`) VALUES
	(1, 'Frédéric', 'Carisey', 'administrateur', '$2y$10$GM.1O.TvXYs1Slc/kGA8.uHnFWL4tJl.kB79x0RAtDQPUVjbNpuG2', 'default.jpg', 'admin@grds.fr');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `classe` (
  `idclasse` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  `internshipdatestart` date DEFAULT NULL,
  `internshipdateend` date DEFAULT NULL,
  PRIMARY KEY (`idclasse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `classe` DISABLE KEYS */;
/*!40000 ALTER TABLE `classe` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `teacher` (
  `idteacher` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilpicture` varchar(50) NOT NULL,
  `courriel` varchar(50) NOT NULL,
  PRIMARY KEY (`idteacher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `affiliate` (
  `idteacher` int(11) NOT NULL,
  `idclasse` int(11) NOT NULL,
  PRIMARY KEY (`idteacher`,`idclasse`),
  KEY `FK_affiliate_teacher` (`idteacher`),
  KEY `FK_affiliate_classe` (`idclasse`) USING BTREE,
  CONSTRAINT `FK_affiliate_classe` FOREIGN KEY (`idclasse`) REFERENCES `classe` (`idclasse`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_affiliate_teacher` FOREIGN KEY (`idteacher`) REFERENCES `teacher` (`idteacher`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `affiliate` DISABLE KEYS */;
/*!40000 ALTER TABLE `affiliate` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `student` (
  `idstudent` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilpicture` varchar(255) NOT NULL,
  `courriel` varchar(255) NOT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `lm` varchar(255) DEFAULT NULL,
  `idclasse` int(11) NOT NULL,
  PRIMARY KEY (`idstudent`),
  KEY `FK_student_classe` (`idclasse`),
  CONSTRAINT `FK_student_classe` FOREIGN KEY (`idclasse`) REFERENCES `classe` (`idclasse`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `student` DISABLE KEYS */;
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `internship` (
  `idinternship` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `shortdescription` varchar(255) NOT NULL,
  `website` varchar(50) DEFAULT NULL,
  `enterprise` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `isdone` tinyint(4) NOT NULL,
  `idclasse` int(11) NOT NULL,
  PRIMARY KEY (`idinternship`),
  KEY `FK_internship_classe` (`idclasse`),
  CONSTRAINT `FK_internship_classe` FOREIGN KEY (`idclasse`) REFERENCES `classe` (`idclasse`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `internship` DISABLE KEYS */;
/*!40000 ALTER TABLE `internship` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `currentinternship` (
  `idcurrentinternship` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `website` varchar(50) DEFAULT NULL,
  `enterprise` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  `internshipagreement` varchar(50) DEFAULT NULL,
  `idstudent` int(11) NOT NULL,
  PRIMARY KEY (`idcurrentinternship`),
  KEY `FK_currentinternship_student` (`idstudent`),
  CONSTRAINT `FK_currentinternship_student` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `currentinternship` DISABLE KEYS */;
/*!40000 ALTER TABLE `currentinternship` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `interest` (
  `idstudent` int(11) NOT NULL,
  `idinternship` int(11) NOT NULL,
  PRIMARY KEY (`idstudent`,`idinternship`),
  KEY `FK_interest_internship` (`idinternship`),
  KEY `FK_interest_student` (`idstudent`),
  CONSTRAINT `FK_interest_internship` FOREIGN KEY (`idinternship`) REFERENCES `internship` (`idinternship`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_interest_student` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `interest` DISABLE KEYS */;
/*!40000 ALTER TABLE `interest` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
