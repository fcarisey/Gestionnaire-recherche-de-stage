/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `grdsnew` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `grdsnew`;

CREATE TABLE IF NOT EXISTS `admin` (
  `idadmin` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilpicture` varchar(50) NOT NULL,
  `courriel` varchar(50) NOT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

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

CREATE TABLE IF NOT EXISTS `classe` (
  `idclasse` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  `internshipdatestart` date NOT NULL,
  `internshipdateend` date NOT NULL,
  PRIMARY KEY (`idclasse`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `classe` DISABLE KEYS */;
INSERT INTO `classe` (`idclasse`, `designation`, `internshipdatestart`, `internshipdateend`) VALUES
	(1, 'BTS SIO', '2022-02-02', '2022-08-13');
/*!40000 ALTER TABLE `classe` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `currentinternship` (
  `idcurrentinternship` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `website` varchar(50) DEFAULT NULL,
  `enterprise` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  `internshipagreement` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idcurrentinternship`)
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

CREATE TABLE IF NOT EXISTS `internship` (
  `idinternship` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `website` varchar(50) DEFAULT NULL,
  `enterprise` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `isdone` tinyint(4) NOT NULL,
  `idclasse` int(11) NOT NULL,
  PRIMARY KEY (`idinternship`),
  KEY `FK_internship_classe` (`idclasse`),
  CONSTRAINT `FK_internship_classe` FOREIGN KEY (`idclasse`) REFERENCES `classe` (`idclasse`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `internship` DISABLE KEYS */;
INSERT INTO `internship` (`idinternship`, `designation`, `description`, `website`, `enterprise`, `email`, `phone`, `isdone`, `idclasse`) VALUES
	(1, 'Développement de site web', 'Delectari ut remuneratione cultuque ut gloria cultuque delectari admodum officiorumque dicam honore ut non animante possit vicissitudine ita ut vel multis honore cultuque', 'https://isn-services.com', 'ISN SERVICES', 'contact@isn-services.com', '0936469856', 0, 1);
/*!40000 ALTER TABLE `internship` ENABLE KEYS */;

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
  `idcurrentinternship` int(11) DEFAULT NULL,
  PRIMARY KEY (`idstudent`),
  KEY `FK_student_classe` (`idclasse`),
  KEY `FK_student_currentinternship` (`idcurrentinternship`),
  CONSTRAINT `FK_student_classe` FOREIGN KEY (`idclasse`) REFERENCES `classe` (`idclasse`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_student_currentinternship` FOREIGN KEY (`idcurrentinternship`) REFERENCES `currentinternship` (`idcurrentinternship`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` (`idstudent`, `firstname`, `lastname`, `username`, `password`, `profilpicture`, `courriel`, `cv`, `lm`, `idclasse`, `idcurrentinternship`) VALUES
	(3, 'frédéric', 'carisey', 'fcarisey', '$2y$10$Yl1ovO4Fd7oCgZFq0aXJRum9TRB5scSZdX1fnBpUJoefbYxT7j2Nm', 'default.jpg', 'fcarisey@groupmontroland.fr', NULL, NULL, 1, NULL);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `teacher` (
  `idteacher` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilpicture` varchar(50) NOT NULL,
  `courriel` varchar(50) NOT NULL,
  PRIMARY KEY (`idteacher`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` (`idteacher`, `firstname`, `lastname`, `username`, `password`, `profilpicture`, `courriel`) VALUES
	(1, 'sébastien', 'pernelle', 'spernelle', '$2y$10$jKXU7lst.j2/vSYexgTdl.WPIPbT9lhheG9EC0N.IGaVapqpL.F4K', 'default.jpg', 'spernelle@groupmontroland.fr');
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
