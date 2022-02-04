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


-- Listage de la structure de la base pour grdsnew
CREATE DATABASE IF NOT EXISTS `grdsnew` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `grdsnew`;

-- Listage de la structure de la table grdsnew. admin
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

-- Listage des données de la table grdsnew.admin : ~0 rows (environ)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Listage de la structure de la table grdsnew. affiliate
CREATE TABLE IF NOT EXISTS `affiliate` (
  `idteacher` int(11) NOT NULL,
  `idclasse` int(11) NOT NULL,
  PRIMARY KEY (`idteacher`,`idclasse`),
  KEY `FK_affiliate_classe` (`idclasse`) USING BTREE,
  KEY `FK_affiliate_teacher` (`idteacher`),
  CONSTRAINT `FK_affiliate_classe` FOREIGN KEY (`idclasse`) REFERENCES `classe` (`idclasse`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_affiliate_teacher` FOREIGN KEY (`idteacher`) REFERENCES `teacher` (`idteacher`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table grdsnew.affiliate : ~0 rows (environ)
DELETE FROM `affiliate`;
/*!40000 ALTER TABLE `affiliate` DISABLE KEYS */;
/*!40000 ALTER TABLE `affiliate` ENABLE KEYS */;

-- Listage de la structure de la table grdsnew. classe
CREATE TABLE IF NOT EXISTS `classe` (
  `idclasse` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `internshipdatestart` date NOT NULL,
  `internshipdateend` date NOT NULL,
  PRIMARY KEY (`idclasse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table grdsnew.classe : ~0 rows (environ)
DELETE FROM `classe`;
/*!40000 ALTER TABLE `classe` DISABLE KEYS */;
INSERT INTO `classe` (`idclasse`, `designation`, `internshipdatestart`, `internshipdateend`) VALUES
	(1, 'BTS SIO', '2022-02-02', '2022-08-13');
/*!40000 ALTER TABLE `classe` ENABLE KEYS */;

-- Listage de la structure de la table grdsnew. currentinternship
CREATE TABLE IF NOT EXISTS `currentinternship` (
  `idcurrentinternship` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `website` varchar(50) DEFAULT NULL,
  `enterprise` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  `internshipagreement` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idcurrentinternship`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table grdsnew.currentinternship : ~0 rows (environ)
DELETE FROM `currentinternship`;
/*!40000 ALTER TABLE `currentinternship` DISABLE KEYS */;
/*!40000 ALTER TABLE `currentinternship` ENABLE KEYS */;

-- Listage de la structure de la table grdsnew. interest
CREATE TABLE IF NOT EXISTS `interest` (
  `idstudent` int(11) NOT NULL,
  `idinternship` int(11) NOT NULL,
  PRIMARY KEY (`idstudent`,`idinternship`),
  KEY `FK_interest_internship` (`idinternship`),
  KEY `FK_interest_student` (`idstudent`),
  CONSTRAINT `FK_interest_internship` FOREIGN KEY (`idinternship`) REFERENCES `internship` (`idinternship`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_interest_student` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table grdsnew.interest : ~0 rows (environ)
DELETE FROM `interest`;
/*!40000 ALTER TABLE `interest` DISABLE KEYS */;
/*!40000 ALTER TABLE `interest` ENABLE KEYS */;

-- Listage de la structure de la table grdsnew. internship
CREATE TABLE IF NOT EXISTS `internship` (
  `idinternship` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table grdsnew.internship : ~0 rows (environ)
DELETE FROM `internship`;
/*!40000 ALTER TABLE `internship` DISABLE KEYS */;
INSERT INTO `internship` (`idinternship`, `designation`, `description`, `website`, `enterprise`, `email`, `phone`, `isdone`, `idclasse`) VALUES
	(1, 'Développement de site web', 'Delectari ut remuneratione cultuque ut gloria cultuque delectari admodum officiorumque dicam honore ut non animante possit vicissitudine ita ut vel multis honore cultuque', 'https://isn-services.com', 'ISN SERVICES', 'contact@isn-services.com', '0936469856', 0, 1);
/*!40000 ALTER TABLE `internship` ENABLE KEYS */;

-- Listage de la structure de la table grdsnew. student
CREATE TABLE IF NOT EXISTS `student` (
  `idstudent` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `profilpicture` varchar(255) NOT NULL DEFAULT '',
  `courriel` varchar(255) NOT NULL DEFAULT '',
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

-- Listage des données de la table grdsnew.student : ~1 rows (environ)
DELETE FROM `student`;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` (`idstudent`, `firstname`, `lastname`, `username`, `password`, `profilpicture`, `courriel`, `cv`, `lm`, `idclasse`, `idcurrentinternship`) VALUES
	(3, 'frédéric', 'carisey', 'fcarisey', '$2y$10$Yl1ovO4Fd7oCgZFq0aXJRum9TRB5scSZdX1fnBpUJoefbYxT7j2Nm', 'default.jpg', 'fcarisey@groupmontroland.fr', NULL, NULL, 1, NULL);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

-- Listage de la structure de la table grdsnew. teacher
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

-- Listage des données de la table grdsnew.teacher : ~0 rows (environ)
DELETE FROM `teacher`;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
