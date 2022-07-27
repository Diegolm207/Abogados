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
CREATE TABLE IF NOT EXISTS `countries` (
  `CNTIso2` varchar(10) NOT NULL,
  `CNTName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CNTIso2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.countries: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`CNTIso2`, `CNTName`) VALUES
	('DE', 'ALEMANIA'),
	('ES', 'ESPAÑA'),
	('FR', 'FRANCIA'),
	('GB', 'REINO UNIDO'),
	('RO', 'RUMANÍA');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.documents
CREATE TABLE IF NOT EXISTS `documents` (
  `DOCId` int(11) NOT NULL AUTO_INCREMENT,
  `DOCName` varchar(50) NOT NULL,
  `DOCObj` varchar(50) NOT NULL,
  `DOCObjId` int(11) NOT NULL,
  `DOCPath` varchar(250) NOT NULL,
  `DOCInsertDate` datetime NOT NULL,
  `DOCInsertBy` varchar(50) NOT NULL,
  PRIMARY KEY (`DOCId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.documents: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` (`DOCId`, `DOCName`, `DOCObj`, `DOCObjId`, `DOCPath`, `DOCInsertDate`, `DOCInsertBy`) VALUES
	(3, 'Test Docs Tools.cs', 'ENTITES', 1, 'https://1drv.ms/w/s!AlLVrscivkNigqQT5hnFbToR35sUrw?e=osBWLw', '0000-00-00 00:00:00', ''),
	(4, 'Test Docs Tools.cs', 'ENTITES', 1, 'Certificado Oracle.pdf', '0000-00-00 00:00:00', ''),
	(5, 'Test Docs Tools.cs', 'ENTITES', 1, '', '2021-02-07 19:14:33', 'ampineda'),
	(6, 'Documento Word', 'PROJECTS', 3, 'https://1drv.ms/w/s!AlLVrscivkNigqQT5hnFbToR35sUrw?e=KGEtHu', '2021-05-01 18:08:01', 'ampineda');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.employees
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.employees: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`EMPId`, `EMPNatId`, `EMPUsrId`, `EMPType`, `EMPName`, `EMPLastName`, `EMPEmail`, `EMPPhone`, `EMPMobile`, `EMPRateHour`, `EMPRateDay`, `EMPNotes`, `EMPDateInsert`, `EMPInsertBy`, `EMPDateUpdate`, `EMPUpdateBy`) VALUES
	(1, '6668884G', NULL, 'ABL', 'Pedro', 'Heras', 'pedro@herasyabogados.com', '', '622 333 444', 100, NULL, '', '2020-11-29 13:56:19', 'ampineda', '2020-12-06 18:33:04', 'ampineda'),
	(3, 'J22233356', NULL, 'ABG', 'Javier', 'Heras González', 'javier@herasyabogados.es', '', '+34 609 070 733', NULL, NULL, '', '2020-12-23 09:39:01', 'ampineda', NULL, NULL);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.entities
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
/*!40000 ALTER TABLE `entities` DISABLE KEYS */;
INSERT INTO `entities` (`ENTId`, `ENTType`, `ENTStatus`, `ENTName`, `ENTLastName`, `ENTCompany`, `ENTFiscalId`, `ENTAddress`, `ENTCity`, `ENTPostalCode`, `ENTCountry`, `ENTEmail`, `ENTPhone`, `ENTMobile`, `ENTAccount`, `ENTPayment`, `ENTPaymentDay`, `ENTBank`, `ENTBillingNotes`, `ENTNotes`, `ENTDateInsert`, `ENTInsertBy`, `ENTDateUpdate`, `ENTUpdateBy`) VALUES
	(1, 'CLT', 'ACT', 'Alberto', 'Pineda', '', '', 'C/Redondillo 8, 15', 'MORALZARZAL', '28411', 'España', 'ampineda@outlook.com', '', '+34627435443', '', 60, 28, '', '', '', '2020-11-18 20:15:08', 'ampineda', NULL, NULL),
	(2, 'CLT', 'ACT', '', '', 'ENCOM', 'B86868686', 'C/Tron, 82', 'Boston', 'BMA45232', 'ESTADOS UNIDOS', 'info@encom.com', '', '', '', NULL, NULL, '', '', '', '2020-11-18 20:24:35', 'ampineda', '0000-00-00 00:00:00', '');
/*!40000 ALTER TABLE `entities` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.invoices
CREATE TABLE IF NOT EXISTS `invoices` (
  `INVId` int(11) NOT NULL AUTO_INCREMENT,
  `INVIdProject` int(11) NOT NULL,
  `INVNumber` varchar(50) DEFAULT NULL,
  `INVDate` date NOT NULL,
  `INVDateAcc` date NOT NULL,
  `INVDateDue` date NOT NULL,
  `INVDatePlanned` date NOT NULL,
  `INVStatus` varchar(10) DEFAULT NULL,
  `INVBase` double NOT NULL,
  `INVVatType` varchar(20) DEFAULT NULL,
  `INVVat` double NOT NULL,
  `INVVatTotal` double NOT NULL,
  `INVIRPF` double DEFAULT NULL,
  `INVIRPFTotal` double DEFAULT NULL,
  `INVTotal` double NOT NULL,
  `INVNotes` varchar(200) NOT NULL,
  `INVDateInsert` datetime DEFAULT NULL,
  `INVInsertBy` varchar(50) DEFAULT NULL,
  `INVDateUpdate` datetime DEFAULT NULL,
  `INVUpdateBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`INVId`),
  KEY `FKINVProjects` (`INVIdProject`),
  CONSTRAINT `FKINVProjects` FOREIGN KEY (`INVIdProject`) REFERENCES `projects` (`PRJId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.invoices: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` (`INVId`, `INVIdProject`, `INVNumber`, `INVDate`, `INVDateAcc`, `INVDateDue`, `INVDatePlanned`, `INVStatus`, `INVBase`, `INVVatType`, `INVVat`, `INVVatTotal`, `INVIRPF`, `INVIRPFTotal`, `INVTotal`, `INVNotes`, `INVDateInsert`, `INVInsertBy`, `INVDateUpdate`, `INVUpdateBy`) VALUES
	(1, 4, '2104000111', '2021-04-01', '2021-04-01', '2021-04-01', '2021-04-01', 'IPLN', 100, 'GENERAL', 21, 21, NULL, NULL, 121, '', '2021-04-18 00:00:00', 'ampineda', '2021-04-18 19:02:47', 'ampineda'),
	(3, 1, 'FC22030005', '2022-03-01', '2022-03-01', '2022-04-01', '2022-04-01', '', 1000, 'GENERAL', 21, 210, 15, 150, 1060, 'MOD', '2022-03-02 20:25:54', 'ampineda', '2022-03-02 20:27:02', 'ampineda');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.log
CREATE TABLE IF NOT EXISTS `log` (
  `IdLog` int(11) NOT NULL AUTO_INCREMENT,
  `Date` datetime DEFAULT NULL,
  `User` varchar(50) DEFAULT '0',
  `Error` mediumtext DEFAULT '0',
  `Notes` varchar(150) DEFAULT '0',
  PRIMARY KEY (`IdLog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.log: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.params
CREATE TABLE IF NOT EXISTS `params` (
  `PRMId` int(11) NOT NULL AUTO_INCREMENT,
  `PRMCode` varchar(10) NOT NULL,
  `PRMName` varchar(50) NOT NULL,
  `PRMValue` varchar(250) NOT NULL,
  `PRMScope` varchar(50) NOT NULL,
  PRIMARY KEY (`PRMId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.params: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `params` DISABLE KEYS */;
/*!40000 ALTER TABLE `params` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `PRJId` int(11) NOT NULL AUTO_INCREMENT,
  `PRJIdEntity` int(11) DEFAULT NULL,
  `PRJIdEmployee` int(11) DEFAULT NULL,
  `PRJType` varchar(10) DEFAULT NULL,
  `PRJStatus` varchar(10) DEFAULT NULL,
  `PRJName` varchar(50) DEFAULT NULL,
  `PRJDescription` varchar(250) DEFAULT NULL,
  `PRJDateStart` date DEFAULT NULL,
  `PRJDateEnd` date DEFAULT NULL,
  `PRJDateStartPln` date DEFAULT NULL,
  `PRJDateEndPln` date DEFAULT NULL,
  `PRJBudget` float DEFAULT NULL,
  `PRJBudgetReal` float DEFAULT NULL,
  `PRJCost` float DEFAULT NULL,
  `PRJCostReal` float DEFAULT NULL,
  `PRJNotes` varchar(255) DEFAULT NULL,
  `PRJDateInsert` date DEFAULT NULL,
  `PRJInsertBy` varchar(50) DEFAULT NULL,
  `PRJDateUpdate` date DEFAULT NULL,
  `PRJUpdateBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PRJId`),
  KEY `FKPRJEmployee` (`PRJIdEmployee`),
  KEY `FKPRJEntity` (`PRJIdEntity`),
  CONSTRAINT `FKPRJEmployee` FOREIGN KEY (`PRJIdEmployee`) REFERENCES `employees` (`EMPId`),
  CONSTRAINT `FKPRJEntity` FOREIGN KEY (`PRJIdEntity`) REFERENCES `entities` (`ENTId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.projects: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` (`PRJId`, `PRJIdEntity`, `PRJIdEmployee`, `PRJType`, `PRJStatus`, `PRJName`, `PRJDescription`, `PRJDateStart`, `PRJDateEnd`, `PRJDateStartPln`, `PRJDateEndPln`, `PRJBudget`, `PRJBudgetReal`, `PRJCost`, `PRJCostReal`, `PRJNotes`, `PRJDateInsert`, `PRJInsertBy`, `PRJDateUpdate`, `PRJUpdateBy`) VALUES
	(1, 1, 1, 'ADM', 'PLN', 'Declaración de la Renta', 'Declaración de la Renta 2020', '2020-01-01', '2020-08-01', '0000-00-00', '0000-00-00', 150, NULL, 150, NULL, '', '2020-12-22', 'ampineda', '2020-12-22', 'ampineda'),
	(3, 2, 1, 'FIN', 'INC', 'Gestión Contable', 'Gestión Contable 2021', '2021-01-01', '2021-12-31', '0000-00-00', '0000-00-00', 350, NULL, NULL, NULL, '', '2020-12-22', 'ampineda', NULL, NULL),
	(4, 2, 3, 'LAB', 'INC', 'Gestión Laboral 2021', 'Gestión Recursos Humanos', '2021-01-01', '2021-12-31', '0000-00-00', '0000-00-00', 350, NULL, NULL, NULL, 'Cobro Mensual', '2020-12-26', 'ampineda', NULL, NULL);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.status
CREATE TABLE IF NOT EXISTS `status` (
  `STTId` int(11) NOT NULL AUTO_INCREMENT,
  `STTTable` varchar(50) DEFAULT NULL,
  `STTCode` varchar(10) DEFAULT NULL,
  `STTName` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`STTId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.status: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`STTId`, `STTTable`, `STTCode`, `STTName`) VALUES
	(1, 'ENTITIES', 'ACT', 'ACTIVO'),
	(2, 'ENTITIES', 'EBLQ', 'BLOQUEADO'),
	(3, 'ENTITIES', 'EBRD', 'BORRADO'),
	(4, 'ENTITIES', 'EPDT', 'PENDIENTE'),
	(5, 'PROJECTS', 'PPLN', 'PLANIFICADO'),
	(6, 'PROJECTS', 'PCRS', 'EN CURSO'),
	(7, 'PROJECTS', 'PCRD', 'CERRADO'),
	(8, 'TASKS', 'TPLN', 'PLANIFICADO'),
	(9, 'TASKS', 'TCRS', 'EN CURSO'),
	(10, 'TASKS', 'TCRD', 'CERRADO'),
	(11, 'INVOICES', 'IPLN', 'PLANIFICADA');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `TSKId` int(11) NOT NULL AUTO_INCREMENT,
  `TSKIdProject` int(11) DEFAULT NULL,
  `TSKIdEmployee` int(11) DEFAULT NULL,
  `TSKIdEntity` int(11) DEFAULT NULL,
  `TSKStatus` varchar(10) DEFAULT NULL,
  `TSKName` varchar(50) DEFAULT NULL,
  `TSKDescription` varchar(250) DEFAULT NULL,
  `TSKDateStart` datetime DEFAULT NULL,
  `TSKDateEnd` datetime DEFAULT NULL,
  `TSKPercentageDone` float DEFAULT NULL,
  `TSKToInvoice` bit(1) DEFAULT NULL,
  `TSKInvoice` varchar(50) DEFAULT NULL,
  `TSKTimePlanned` float DEFAULT 0,
  `TSKTime` float DEFAULT 0,
  `TSKHourRate` float DEFAULT 0,
  `TSKTotal` float DEFAULT 0,
  `TSKTotalCost` float DEFAULT 0,
  `TSKNotes` varchar(255) DEFAULT '0',
  `TSKDateInsert` date DEFAULT NULL,
  `TSKInsertBy` varchar(50) DEFAULT NULL,
  `TSKDateUpdate` date DEFAULT NULL,
  `TSKUpdateBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`TSKId`),
  KEY `FKTSKEntity` (`TSKIdEntity`),
  KEY `FKTSKEmployee` (`TSKIdEmployee`),
  KEY `FKTSKProject` (`TSKIdProject`),
  CONSTRAINT `FKTSKEmployee` FOREIGN KEY (`TSKIdEmployee`) REFERENCES `employees` (`EMPId`),
  CONSTRAINT `FKTSKEntity` FOREIGN KEY (`TSKIdEntity`) REFERENCES `entities` (`ENTId`),
  CONSTRAINT `FKTSKProject` FOREIGN KEY (`TSKIdProject`) REFERENCES `projects` (`PRJId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.tasks: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` (`TSKId`, `TSKIdProject`, `TSKIdEmployee`, `TSKIdEntity`, `TSKStatus`, `TSKName`, `TSKDescription`, `TSKDateStart`, `TSKDateEnd`, `TSKPercentageDone`, `TSKToInvoice`, `TSKInvoice`, `TSKTimePlanned`, `TSKTime`, `TSKHourRate`, `TSKTotal`, `TSKTotalCost`, `TSKNotes`, `TSKDateInsert`, `TSKInsertBy`, `TSKDateUpdate`, `TSKUpdateBy`) VALUES
	(3, 4, 1, 2, 'TPLN', 'Preparación Nóminas', 'Preparación Nóminas Enero 2021', '2021-01-18 09:00:00', '2021-01-22 19:00:00', 0, b'1', '', 8, 8, 80, 360, 360, '', '2021-01-03', 'ampineda', '2021-01-04', 'ampineda'),
	(4, 1, 1, 1, 'TCRS', 'TEST TAREA', 'TEST TAREA', '2022-07-07 19:43:00', '2022-07-22 19:43:00', 50, b'0', '', 5, 5, 50, 250, 250, '', '2022-07-07', 'ampineda', NULL, NULL);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.types
CREATE TABLE IF NOT EXISTS `types` (
  `TYPId` int(11) NOT NULL AUTO_INCREMENT,
  `TYPTable` varchar(50) DEFAULT NULL,
  `TYPCode` varchar(10) DEFAULT NULL,
  `TYPName` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`TYPId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla lmpdb.types: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` (`TYPId`, `TYPTable`, `TYPCode`, `TYPName`) VALUES
	(1, 'ENTITIES', 'CLT', 'CLIENTE'),
	(2, 'ENTITIES', 'PCN', 'PARTE CONTRARIA'),
	(3, 'ENTITIES', 'ABG', 'ABOGADO'),
	(4, 'ENTITIES', 'JUZ', 'JUEZ'),
	(5, 'EMPLOYEES', 'ABG', 'ABOGADO'),
	(6, 'EMPLOYEES', 'ABL', 'ABOGADO LABORAL'),
	(7, 'PROJECTS', 'FIN', 'FINANCIERO'),
	(8, 'PROJECTS', 'JUR', 'JURÍDICO'),
	(9, 'PROJECTS', 'LAB', 'LABORAL'),
	(10, 'PROJECTS', 'ADM', 'ADMINISTRATIVO');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;


-- Volcando estructura para tabla lmpdb.users
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
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`USRId`, `USRLogin`, `USRPsw`, `USREmail`, `USRName`, `USRLastName`, `USRDateInsert`, `USRInsertBy`, `USRDateUpdate`, `USRUpdateBy`) VALUES
	(1, 'ampineda', 'Amp000888', 'ampineda@outlook.com', 'Alberto', 'Martínez', NULL, NULL, '2021-01-16 20:06:52', 'ampineda'),
	(2, 'luli', 'Monita76', 'lulitico@yahoo.com', 'Iuliana María', 'Crivat', NULL, NULL, '2020-11-04 20:23:54', 'ampineda'),
	(3, 'Neo', 'Neo000888', 'neo@outlook.com', 'Neo', 'Anderson', NULL, NULL, '2020-11-21 18:46:18', 'ampineda'),
	(4, 'Morfeo', 'Mor000888', 'morfeo@outlook.com', 'Morfeo', 'Laurence', NULL, NULL, '2020-11-22 12:24:10', 'ampineda'),
	(8, 'Clark', 'Cla000888', 'clark@outlook.com', 'Clark', 'Kent', '2020-11-04 20:29:43', 'ampineda', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
