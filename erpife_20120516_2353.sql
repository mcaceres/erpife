-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.23-2


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema ponencias
--

CREATE DATABASE IF NOT EXISTS ponencias;
USE ponencias;

--
-- Definition of table `ponencias`.`area_tematica`
--

DROP TABLE IF EXISTS `ponencias`.`area_tematica`;
CREATE TABLE  `ponencias`.`area_tematica` (
  `a_id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `a_descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='datos de las áreas temáticas';

--
-- Dumping data for table `ponencias`.`area_tematica`
--

/*!40000 ALTER TABLE `area_tematica` DISABLE KEYS */;
LOCK TABLES `area_tematica` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `area_tematica` ENABLE KEYS */;


--
-- Definition of table `ponencias`.`evento`
--

DROP TABLE IF EXISTS `ponencias`.`evento`;
CREATE TABLE  `ponencias`.`evento` (
  `eve_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `eve_nombre` varchar(250) NOT NULL,
  `eve_anio` varchar(4) NOT NULL,
  PRIMARY KEY (`eve_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='datos de los eventos';

--
-- Dumping data for table `ponencias`.`evento`
--

/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
LOCK TABLES `evento` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;


--
-- Definition of table `ponencias`.`perfil`
--

DROP TABLE IF EXISTS `ponencias`.`perfil`;
CREATE TABLE  `ponencias`.`perfil` (
  `perfil_id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) NOT NULL,
  PRIMARY KEY (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='perfiles de usuario';

--
-- Dumping data for table `ponencias`.`perfil`
--

/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
LOCK TABLES `perfil` WRITE;
INSERT INTO `ponencias`.`perfil` VALUES  (001,'expositor'),
 (002,'evaluador'),
 (003,'admin');
UNLOCK TABLES;
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;


--
-- Definition of table `ponencias`.`trabajo`
--

DROP TABLE IF EXISTS `ponencias`.`trabajo`;
CREATE TABLE  `ponencias`.`trabajo` (
  `t_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `t_ex_id` int(5) unsigned zerofill NOT NULL,
  `t_titulo` varchar(100) NOT NULL,
  `t_area_id` int(3) unsigned zerofill NOT NULL,
  `t_keywords` varchar(100) NOT NULL,
  `t_resumen` varchar(500) NOT NULL,
  PRIMARY KEY (`t_id`),
  KEY `fk_exp` (`t_ex_id`),
  CONSTRAINT `fk_exp` FOREIGN KEY (`t_ex_id`) REFERENCES `usuario` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='datos de los trabajos';

--
-- Dumping data for table `ponencias`.`trabajo`
--

/*!40000 ALTER TABLE `trabajo` DISABLE KEYS */;
LOCK TABLES `trabajo` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `trabajo` ENABLE KEYS */;


--
-- Definition of table `ponencias`.`usuario`
--

DROP TABLE IF EXISTS `ponencias`.`usuario`;
CREATE TABLE  `ponencias`.`usuario` (
  `u_id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `u_username` varchar(20) NOT NULL,
  `u_password` varchar(350) NOT NULL,
  `u_perfil` int(3) unsigned zerofill DEFAULT NULL,
  `u_dni` varchar(11) NOT NULL,
  `u_email` varchar(30) NOT NULL,
  `u_nomyape` varchar(50) NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `i_username` (`u_username`) USING BTREE,
  KEY `fk_u_perfil` (`u_perfil`),
  CONSTRAINT `fk_u_perfil` FOREIGN KEY (`u_perfil`) REFERENCES `perfil` (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='datos de los usuarios';

--
-- Dumping data for table `ponencias`.`usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
LOCK TABLES `usuario` WRITE;
INSERT INTO `ponencias`.`usuario` VALUES  (00001,'mcaceres','pass',003,'123','marcoscaceres@hotmail.com','Marcos David Cáceres'),
 (00003,'nborgmann','123',002,'','',''),
 (00004,'ffalduto','123',001,'','','');
UNLOCK TABLES;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
