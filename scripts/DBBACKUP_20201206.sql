-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         10.4.11-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla lmpdb.countries
DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `CNTIso2` varchar(10) NOT NULL,
  `CNTName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CNTIso2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.countries: ~5 rows (aproximadamente)
DELETE FROM `countries`;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`CNTIso2`, `CNTName`) VALUES
	('DE', 'ALEMANIA'),
	('ES', 'ESPAÑA'),
	('FR', 'FRANCIA'),
	('GB', 'REINO UNIDO'),
	('RO', 'RUMANÍA');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.documents
DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `DOCId` int(11) NOT NULL AUTO_INCREMENT,
  `DOCName` varchar(50) NOT NULL,
  `DOCObj` varchar(50) NOT NULL,
  `DOCObjId` int(11) NOT NULL,
  `DOCPath` varchar(250) NOT NULL,
  `DOCInsertDate` datetime NOT NULL,
  `DOCInsertBy` varchar(50) NOT NULL,
  PRIMARY KEY (`DOCId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.documents: ~0 rows (aproximadamente)
DELETE FROM `documents`;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.employees
DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `EMPId` int(11) NOT NULL AUTO_INCREMENT,
  `EMPNatId` varchar(20) DEFAULT NULL,
  `EMPUsrId` varchar(20) DEFAULT NULL,
  `EMPType` varchar(10) DEFAULT NULL,
  `EMPName` varchar(75) NOT NULL,
  `EMPLastName` varchar(100) DEFAULT NULL,
  `EMPEmail` varchar(150) DEFAULT NULL,
  `EMPPhone` varchar(20) DEFAULT NULL,
  `EMPMobile` varchar(20) DEFAULT NULL,
  `EMPRateHour` float DEFAULT NULL,
  `EMPRateDay` float DEFAULT NULL,
  `EMPNotes` varchar(250) DEFAULT NULL,
  `EMPDateInsert` datetime DEFAULT NULL,
  `EMPInsertBy` varchar(50) DEFAULT NULL,
  `EMPDateUpdate` datetime DEFAULT NULL,
  `EMPUpdateBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`EMPId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.employees: ~1 rows (aproximadamente)
DELETE FROM `employees`;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`EMPId`, `EMPNatId`, `EMPUsrId`, `EMPType`, `EMPName`, `EMPLastName`, `EMPEmail`, `EMPPhone`, `EMPMobile`, `EMPRateHour`, `EMPRateDay`, `EMPNotes`, `EMPDateInsert`, `EMPInsertBy`, `EMPDateUpdate`, `EMPUpdateBy`) VALUES
	(1, '6668884G', NULL, 'ABL', 'Pedro', 'Heras', 'pedro@herasyabogados.com', '', '', 100, NULL, '', '2020-11-29 13:56:19', 'ampineda', '2020-12-03 20:20:35', 'ampineda');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.entities
DROP TABLE IF EXISTS `entities`;
CREATE TABLE IF NOT EXISTS `entities` (
  `ENTId` int(11) NOT NULL AUTO_INCREMENT,
  `ENTType` varchar(10) NOT NULL,
  `ENTStatus` varchar(10) NOT NULL,
  `ENTName` varchar(75) DEFAULT NULL,
  `ENTLastName` varchar(100) DEFAULT NULL,
  `ENTCompany` varchar(100) DEFAULT NULL,
  `ENTFiscalId` varchar(50) DEFAULT NULL,
  `ENTAddress` varchar(175) DEFAULT NULL,
  `ENTCity` varchar(75) DEFAULT NULL,
  `ENTPostalCode` varchar(20) DEFAULT NULL,
  `ENTCountry` varchar(50) DEFAULT NULL,
  `ENTEmail` varchar(150) DEFAULT NULL,
  `ENTPhone` varchar(20) DEFAULT NULL,
  `ENTMobile` varchar(20) DEFAULT NULL,
  `ENTAccount` varchar(50) DEFAULT NULL,
  `ENTPayment` int(11) DEFAULT 0,
  `ENTPaymentDay` int(11) DEFAULT 0,
  `ENTBank` varchar(50) DEFAULT NULL,
  `ENTBillingNotes` varchar(255) DEFAULT NULL,
  `ENTNotes` varchar(255) DEFAULT NULL,
  `ENTDateInsert` datetime DEFAULT NULL,
  `ENTInsertBy` varchar(50) DEFAULT NULL,
  `ENTDateUpdate` datetime DEFAULT NULL,
  `ENTUpdateBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ENTId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.entities: ~2 rows (aproximadamente)
DELETE FROM `entities`;
/*!40000 ALTER TABLE `entities` DISABLE KEYS */;
INSERT INTO `entities` (`ENTId`, `ENTType`, `ENTStatus`, `ENTName`, `ENTLastName`, `ENTCompany`, `ENTFiscalId`, `ENTAddress`, `ENTCity`, `ENTPostalCode`, `ENTCountry`, `ENTEmail`, `ENTPhone`, `ENTMobile`, `ENTAccount`, `ENTPayment`, `ENTPaymentDay`, `ENTBank`, `ENTBillingNotes`, `ENTNotes`, `ENTDateInsert`, `ENTInsertBy`, `ENTDateUpdate`, `ENTUpdateBy`) VALUES
	(1, 'CLT', 'ACT', 'Alberto', 'Pineda', '', '', 'C/Redondillo 8, 15', 'MORALZARZAL', '28411', 'España', 'ampineda@outlook.com', '', '+34627435443', '', 60, 28, '', '', '', '2020-11-18 20:15:08', 'ampineda', NULL, NULL),
	(2, 'CLT', 'ACT', '', '', 'ENCOM', 'B86868686', 'C/Tron, 82', 'Boston', 'BMA45232', 'ESTADOS UNIDOS', 'info@encom.com', '', '', '', NULL, NULL, '', '', '', '2020-11-18 20:24:35', 'ampineda', '0000-00-00 00:00:00', '');
/*!40000 ALTER TABLE `entities` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.log
DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `IdLog` int(11) NOT NULL AUTO_INCREMENT,
  `Date` datetime DEFAULT NULL,
  `User` varchar(50) DEFAULT '0',
  `Error` mediumtext DEFAULT '0',
  `Notes` varchar(150) DEFAULT '0',
  PRIMARY KEY (`IdLog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.log: ~0 rows (aproximadamente)
DELETE FROM `log`;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.params
DROP TABLE IF EXISTS `params`;
CREATE TABLE IF NOT EXISTS `params` (
  `PRMId` int(11) NOT NULL AUTO_INCREMENT,
  `PRMCode` varchar(10) NOT NULL,
  `PRMName` varchar(50) NOT NULL,
  `PRMValue` varchar(250) NOT NULL,
  `PRMScope` varchar(50) NOT NULL,
  PRIMARY KEY (`PRMId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.params: ~0 rows (aproximadamente)
DELETE FROM `params`;
/*!40000 ALTER TABLE `params` DISABLE KEYS */;
/*!40000 ALTER TABLE `params` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.status
DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `STTId` int(11) NOT NULL AUTO_INCREMENT,
  `STTTable` varchar(50) DEFAULT NULL,
  `STTCode` varchar(10) DEFAULT NULL,
  `STTName` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`STTId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.status: ~4 rows (aproximadamente)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`STTId`, `STTTable`, `STTCode`, `STTName`) VALUES
	(1, 'ENTITIES', 'ACT', 'ACTIVO'),
	(2, 'ENTITIES', 'BLQ', 'BLOQUEADO'),
	(3, 'ENTITIES', 'BRD', 'BORRADO'),
	(4, 'ENTITES', 'PDT', 'PENDIENTE');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.types
DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `TYPId` int(11) NOT NULL AUTO_INCREMENT,
  `TYPTable` varchar(50) DEFAULT '0',
  `TYPCode` varchar(10) DEFAULT '0',
  `TYPName` varchar(75) DEFAULT '0',
  PRIMARY KEY (`TYPId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.types: ~6 rows (aproximadamente)
DELETE FROM `types`;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` (`TYPId`, `TYPTable`, `TYPCode`, `TYPName`) VALUES
	(1, 'ENTITIES', 'CLT', 'CLIENTE'),
	(2, 'ENTITIES', 'PCN', 'PARTE CONTRARIA'),
	(3, 'ENTITIES', 'ABG', 'ABOGADO'),
	(4, 'ENTITIES', 'JUZ', 'JUEZ'),
	(5, 'EMPLOYEES', 'ABG', 'ABOGADO'),
	(6, 'EMPLOYEES', 'ABL', 'ABOGADO LABORAL');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `USRId` int(11) NOT NULL AUTO_INCREMENT,
  `USRLogin` varchar(50) NOT NULL,
  `USRPsw` varchar(50) NOT NULL,
  `USREmail` varchar(100) NOT NULL,
  `USRName` varchar(50) NOT NULL,
  `USRLastName` varchar(75) NOT NULL,
  `USRDateInsert` datetime DEFAULT NULL,
  `USRInsertBy` varchar(50) DEFAULT NULL,
  `USRDateUpdate` datetime DEFAULT NULL,
  `USRUpdateBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`USRId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.users: ~5 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`USRId`, `USRLogin`, `USRPsw`, `USREmail`, `USRName`, `USRLastName`, `USRDateInsert`, `USRInsertBy`, `USRDateUpdate`, `USRUpdateBy`) VALUES
	(1, 'ampineda', 'Amp000888', 'ampineda@outlook.com', 'Alberto', 'Martínez', NULL, NULL, NULL, NULL),
	(2, 'luli', 'Monita76', 'lulitico@yahoo.com', 'Iuliana María', 'Crivat', NULL, NULL, '2020-11-04 20:23:54', 'ampineda'),
	(3, 'Neo', 'Neo000888', 'neo@outlook.com', 'Neo', 'Anderson', NULL, NULL, '2020-11-21 18:46:18', 'ampineda'),
	(4, 'Morfeo', 'Mor000888', 'morfeo@outlook.com', 'Morfeo', 'Laurence', NULL, NULL, '2020-11-22 12:24:10', 'ampineda'),
	(8, 'Clark', 'Cla000888', 'clark@outlook.com', 'Clark', 'Kent', '2020-11-04 20:29:43', 'ampineda', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
