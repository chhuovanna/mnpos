-- MySQL dump 10.13  Distrib 5.7.14, for Win64 (x86_64)
--
-- Host: localhost    Database: mnpos
-- ------------------------------------------------------
-- Server version	5.7.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`catid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Snack','2017-08-18 03:32:27','2017-10-21 03:52:10'),(2,'Drink','2017-08-18 03:32:27','2017-08-18 03:32:27'),(3,'Cosmetic','2017-08-18 03:32:27','2017-08-18 03:32:27'),(4,'Soap','2017-08-18 03:32:27','2017-10-17 07:33:24'),(5,'Shampoo','2017-08-18 03:32:27','2017-10-17 07:33:33'),(6,'Cloth','2017-08-18 18:51:29','2017-10-17 07:33:48'),(13,'Whitening cream','2017-08-21 18:58:04','2017-10-17 07:33:55'),(14,'Unknown','2017-10-17 07:44:18','2017-10-17 07:44:18'),(15,'Diaper','2017-10-21 03:51:35','2017-10-21 03:51:35'),(16,'OTC','2017-11-02 20:01:16','2017-11-02 20:01:16'),(17,'Medicine','2017-11-03 16:17:08','2017-11-03 16:17:08'),(18,'medical Material','2017-11-03 16:17:40','2017-11-03 16:17:40'),(19,'Hygene','2017-11-03 16:17:52','2017-11-03 16:17:52'),(20,'Toothpaste','2017-12-13 07:32:00','2017-12-13 07:32:00');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `cusid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cusid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (-5,'Return',NULL,NULL,NULL,'2017-10-10 14:13:52','2017-10-10 14:13:52'),(-4,'Gift',NULL,NULL,NULL,'2017-10-10 08:28:20','2017-10-10 08:28:20'),(-3,'Used',NULL,NULL,NULL,'2017-10-10 08:28:20','2017-10-10 08:28:20'),(-2,'Lost',NULL,NULL,'lost@gmail.com','2017-10-09 02:19:55','2017-10-09 02:19:55'),(-1,'Expired',NULL,NULL,'ex@gmail.com','2017-10-09 02:19:07','2017-10-09 02:19:07'),(2,'chanthy','Phnom Penh','0123456','chanthy@gmail.com','2017-08-22 02:57:27','2017-08-22 02:57:27'),(3,'Vanna','sadfsdf',NULL,'asdfas@asdf.com','2017-10-03 20:51:32','2017-10-03 20:51:32'),(4,'dana','ds;dlfjas;d',NULL,'asdfj@sadfj.com','2017-10-03 20:51:54','2017-10-03 20:51:54'),(5,'Moni',NULL,NULL,'moni@gmail.com','2017-10-21 03:52:48','2017-10-21 03:52:48');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drugs`
--

DROP TABLE IF EXISTS `drugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drugs` (
  `pid` int(11) NOT NULL,
  `activesub` varchar(255) DEFAULT NULL,
  `leafletpath` varchar(255) DEFAULT NULL,
  `leaftleturl` varchar(255) DEFAULT NULL,
  `size` varchar(100) DEFAULT NULL,
  `dousageform` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`),
  CONSTRAINT `drugs_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drugs`
--

LOCK TABLES `drugs` WRITE;
/*!40000 ALTER TABLE `drugs` DISABLE KEYS */;
/*!40000 ALTER TABLE `drugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchangerates`
--

DROP TABLE IF EXISTS `exchangerates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exchangerates` (
  `exrateid` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(4,0) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `currentrate` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`exrateid`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchangerates`
--

LOCK TABLES `exchangerates` WRITE;
/*!40000 ALTER TABLE `exchangerates` DISABLE KEYS */;
INSERT INTO `exchangerates` VALUES (38,4000,'2017-10-08 00:24:10','2017-10-21 03:59:08',0),(39,4100,'2017-10-21 03:58:57','2017-10-21 03:58:57',0),(40,4100,'2017-11-02 08:04:11','2017-11-02 08:04:11',1);
/*!40000 ALTER TABLE `exchangerates` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`localhost`*/ /*!50003 TRIGGER reinsertcurrentexc
AFTER DELETE ON exchangerates
FOR EACH ROW
IF old.currentrate= 1 THEN
    INSERT INTO exchangerates
    VALUES (old.exrateid, old.amount,old.created_at, old.updated_at, old.currentrate);
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `importers`
--

DROP TABLE IF EXISTS `importers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `importers` (
  `impid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`impid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `importers`
--

LOCK TABLES `importers` WRITE;
/*!40000 ALTER TABLE `importers` DISABLE KEYS */;
INSERT INTO `importers` VALUES (1,'uniliver','asdfsd',NULL,NULL,'2017-08-18 03:35:02','2017-08-18 03:35:02'),(2,'dksl','asdfsd',NULL,NULL,'2017-08-18 03:35:02','2017-08-18 03:35:02'),(11,'Mega',NULL,NULL,'mega@gmail.com','2017-10-17 07:36:14','2017-10-17 07:36:14'),(12,'Unknown',NULL,NULL,'unkown@gmail.com','2017-10-17 07:41:49','2017-10-17 07:44:31'),(13,'HSC FOODS & BEVERAGES','Chamkamorn',NULL,'hsc@gmail.com','2017-10-21 04:02:38','2017-10-21 04:02:51'),(14,'Cyspharma','Cambodia',NULL,'chansophal@gmail.com','2017-11-08 15:08:19','2017-11-08 15:08:19'),(15,'Kong Veng heng','Phnom penh',NULL,'chansophal@gmail.com','2017-11-08 15:36:40','2017-11-08 15:36:40'),(16,'SARVA','Phnom Penh',NULL,'chansophal@gmail.com','2017-11-09 22:49:59','2017-11-09 22:49:59'),(17,'Dynamic','Phnom Penh',NULL,NULL,'2017-11-12 01:29:48','2017-11-12 01:29:48');
/*!40000 ALTER TABLE `importers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventories` (
  `invid` bigint(20) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `impid` int(11) DEFAULT NULL,
  `mfg` date DEFAULT NULL,
  `exp` date DEFAULT NULL,
  `importunit` int(11) DEFAULT NULL,
  `importdate` date DEFAULT NULL,
  `SRP` decimal(8,2) DEFAULT NULL,
  `unitinstock` int(11) DEFAULT NULL,
  `finish` tinyint(4) DEFAULT NULL,
  `shelf` varchar(100) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `buypriceunit` decimal(8,2) DEFAULT NULL,
  `buypricepack` decimal(8,2) DEFAULT NULL,
  `buypricebox` decimal(8,2) DEFAULT NULL,
  `importpack` int(11) DEFAULT NULL,
  `importbox` int(11) DEFAULT NULL,
  `packinstock` int(11) DEFAULT NULL,
  `boxinstock` int(11) DEFAULT NULL,
  PRIMARY KEY (`invid`),
  KEY `pid` (`pid`),
  KEY `impid` (`impid`),
  CONSTRAINT `inventories_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`),
  CONSTRAINT `inventories_ibfk_2` FOREIGN KEY (`impid`) REFERENCES `importers` (`impid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventories`
--

LOCK TABLES `inventories` WRITE;
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;
INSERT INTO `inventories` VALUES (4,86,1,NULL,NULL,3,NULL,NULL,0,1,NULL,3.00,'2017-11-04 21:15:19','2017-11-04 21:17:54',1.00,1.00,10.00,0,0,0,0),(5,86,1,NULL,NULL,4,NULL,NULL,0,1,NULL,4.00,'2017-11-04 21:21:21','2017-11-06 21:27:28',1.00,1.00,10.00,0,0,0,0),(6,37,1,NULL,NULL,10,NULL,NULL,7,0,NULL,2.50,'2018-03-20 21:06:04','2018-03-20 21:07:06',0.25,1.00,10.00,0,0,0,0),(7,63,14,NULL,NULL,2,NULL,NULL,2,0,NULL,2.00,'2018-03-27 21:13:07','2018-03-27 21:13:07',1.00,10.00,100.00,0,0,0,0);
/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufacturers` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers`
--

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
INSERT INTO `manufacturers` VALUES (5,'PPM',NULL,NULL,'2017-10-17 07:34:38','2017-10-17 07:34:38'),(6,'Dumex',NULL,NULL,'2017-10-17 07:34:58','2017-10-17 07:34:58'),(7,'Evene',NULL,NULL,'2017-10-17 07:35:20','2017-10-17 07:35:20'),(8,'A unknown',NULL,NULL,'2017-10-17 07:42:10','2017-10-17 07:42:10'),(9,'Angel','PP',NULL,'2017-10-21 04:01:23','2017-10-21 04:01:36'),(10,'DKSH',NULL,NULL,'2017-11-02 08:04:56','2017-11-02 08:04:56'),(11,'Lypack',NULL,NULL,'2017-11-02 08:05:41','2017-11-02 08:05:41'),(12,'Hovid','Phnom penh',NULL,'2017-11-03 16:18:39','2017-11-03 16:18:39'),(13,'KBK','Keo Nimol ,Phnom Penh',NULL,'2017-11-03 16:18:56','2017-11-03 16:19:48'),(14,'TTL','Ter Tec long',NULL,'2017-11-03 16:19:17','2017-11-03 16:19:17'),(15,'CRP','Chamroen Phal',NULL,'2017-11-03 16:20:11','2017-11-03 16:20:11'),(16,'AR','Arunraksmey',NULL,'2017-11-03 16:21:30','2017-11-03 16:21:30'),(17,'HH','hak heak',NULL,'2017-11-03 16:21:56','2017-11-03 16:21:56'),(18,'Chea Chamnan','Phnom Penh',NULL,'2017-11-05 10:01:56','2017-11-05 10:02:13'),(19,'Boehringer Ingeheim','France',NULL,'2017-11-05 10:11:26','2017-11-05 10:11:26'),(20,'L\'Oreal','Thailand',NULL,'2017-11-08 12:36:45','2017-11-08 12:36:45'),(21,'Mandom','Indonesia',NULL,'2017-11-08 13:15:23','2017-11-08 13:15:23'),(22,'Uniliver','Thailand',NULL,'2017-11-08 13:15:54','2017-11-08 13:15:54'),(23,'Daevon Pharm','Korea',NULL,'2017-11-08 13:16:29','2017-11-08 13:16:29'),(24,'MS','Phnom Penh',NULL,'2017-11-08 13:16:51','2017-11-08 13:16:51'),(25,'CCM','Malaysia',NULL,'2017-11-08 13:17:32','2017-11-08 13:17:32'),(26,'Beiersdorf','Germany',NULL,'2017-11-08 15:07:24','2017-11-08 15:07:24'),(27,'Bouchara-Recordati','France',NULL,'2017-11-08 15:36:05','2017-11-08 15:36:05'),(28,'Cipla LTD','India',NULL,'2017-11-08 15:46:10','2017-11-08 15:46:10'),(29,'Korean','Korean',NULL,'2017-11-08 15:51:09','2017-11-08 15:51:09'),(30,'Unosource Pharma','India',NULL,'2017-11-08 15:55:34','2017-11-08 15:55:34'),(31,'Ephac','Phnom Penh',NULL,'2017-11-09 02:48:02','2017-11-09 02:48:02'),(32,'DSM','India',NULL,'2017-11-09 02:48:39','2017-11-09 02:48:39'),(33,'Zeshra International','Cambodia',NULL,'2017-11-09 22:48:44','2017-11-09 22:48:44'),(34,'Unilab','Cambodia',NULL,'2017-11-09 22:57:10','2017-11-09 22:57:10'),(35,'ZHCL','cambodia',NULL,'2017-11-09 23:21:02','2017-11-09 23:21:02'),(36,'IPSEN',NULL,NULL,'2017-11-11 01:51:56','2017-11-11 01:51:56'),(37,'JANNSEN','French',NULL,'2017-11-11 01:57:27','2017-11-11 01:57:27'),(38,'Denk Pharma','Germany',NULL,'2017-11-11 02:00:55','2017-11-11 02:00:55'),(39,'GSK','France',NULL,'2017-11-11 02:03:55','2017-11-11 02:03:55'),(40,'Roche','French',NULL,'2017-11-11 02:10:41','2017-11-11 02:10:41'),(41,'Tradiphar','France',NULL,'2017-11-11 02:41:40','2017-11-11 02:41:40'),(42,'BAYER','French',NULL,'2017-11-11 02:51:38','2017-11-11 02:51:38'),(43,'Novartis','Switzerland',NULL,'2017-11-11 02:55:25','2017-11-11 02:55:25'),(44,'Thai Nakorin Patana','Thailand',NULL,'2017-11-12 01:13:33','2017-11-12 01:13:33'),(45,'Crown Pharma','Korea',NULL,'2017-11-12 01:24:27','2017-11-12 01:24:27'),(46,'DexaMedica','Indonesia',NULL,'2017-11-12 01:29:16','2017-11-12 01:29:16'),(47,'Alcon','Belgium',NULL,'2017-11-12 01:41:26','2017-11-12 01:41:26'),(48,'TEVA Sante','French',NULL,'2017-11-12 01:45:37','2017-11-12 01:45:37'),(49,'KALBE','Indonesia',NULL,'2017-12-02 16:41:43','2017-12-02 16:41:43'),(50,'Uni-Charm','Thailand',NULL,'2017-12-03 07:39:37','2017-12-03 07:39:37'),(51,'SCA Hygiene Malaysia','Malaysia',NULL,'2017-12-03 07:55:39','2017-12-03 07:55:39'),(52,'Taisun','VN',NULL,'2017-12-03 08:16:50','2017-12-03 08:16:50'),(53,'SChering-Plous','USA',NULL,'2017-12-03 21:04:46','2017-12-03 21:04:46'),(54,'D-nee','Thailand',NULL,'2017-12-13 06:11:16','2017-12-13 06:11:16'),(55,'Thai',NULL,NULL,'2017-12-24 08:21:11','2017-12-24 08:21:11'),(56,'Sanofi -aventis France','France',NULL,'2017-12-24 08:30:19','2017-12-24 08:30:19'),(57,'FRiLAB+','France',NULL,'2018-03-13 16:17:13','2018-03-13 16:17:13'),(59,'PIEERE FABRE MEDICAMENT','Boulogne',NULL,'2018-03-13 16:29:15','2018-03-13 16:29:15'),(60,'Kotra pharma','Malaysia',NULL,'2018-03-13 16:42:48','2018-03-13 16:42:48'),(62,'UPSA','France',NULL,'2018-03-13 16:46:06','2018-03-13 16:46:06'),(63,'Mistine','Thailand',NULL,'2018-03-16 14:34:26','2018-03-16 14:34:26'),(64,'SEOL Pharma','Korean',NULL,'2018-03-18 19:14:07','2018-03-18 19:14:07'),(65,'Medico','Cambodia',NULL,'2018-03-18 19:15:21','2018-03-18 19:15:21'),(66,'VINAHANKOOK','Vientnam',NULL,'2018-03-19 17:22:52','2018-03-19 17:22:52'),(67,'BRISTOL-MYERS','France',NULL,'2018-03-19 17:27:39','2018-03-19 17:27:39'),(68,'ROUCHARA RECORDATI','France',NULL,'2018-03-20 16:35:31','2018-03-20 16:35:31'),(69,'Bailly-Creat','France',NULL,'2018-03-20 17:01:22','2018-03-20 17:07:03'),(71,'arrow generique','France',NULL,'2018-03-21 16:45:40','2018-03-21 16:45:40'),(72,'SERVIER','France',NULL,'2018-03-22 17:10:00','2018-03-22 17:10:00'),(73,'Vitabiotics','UK',NULL,'2018-03-22 17:10:22','2018-03-22 17:10:22'),(74,'aspen','Irland',NULL,'2018-03-22 17:10:59','2018-03-22 17:10:59'),(75,'Mega','Cambodia',NULL,'2018-03-25 15:54:58','2018-03-25 15:54:58');
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `barcode` bigint(20) DEFAULT NULL,
  `description` text,
  `shortcut` varchar(50) DEFAULT NULL,
  `salepriceunit` decimal(8,2) DEFAULT NULL,
  `salepricepack` decimal(8,2) DEFAULT NULL,
  `photopath` varchar(255) DEFAULT NULL,
  `unitinstock` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `catid` int(11) DEFAULT NULL,
  `isdrugs` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salepricebox` decimal(8,2) DEFAULT NULL,
  `packinstock` int(11) DEFAULT NULL,
  `boxinstock` int(11) DEFAULT NULL,
  `unitperpack` int(11) DEFAULT NULL,
  `unitperbox` int(11) DEFAULT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `name` (`name`),
  KEY `mid` (`mid`),
  KEY `catid` (`catid`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `manufacturers` (`mid`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`catid`) REFERENCES `categories` (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=354 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (37,'Protect Honey Solid Soap',8850006534373,'Make your skin soft','Protect HSS',3.00,1.10,NULL,7,7,4,0,'2017-10-17 07:41:00','2018-03-20 21:07:06',10.00,0,0,4,40),(38,'Scott Extra Tissue',8850039602070,NULL,'scott tissue',0.25,1.50,NULL,0,8,1,0,'2017-10-17 07:44:04','2017-11-01 22:54:59',15.00,0,0,6,60),(39,'Softy Body Fit 1x8 Slim Wing 29cm',8851111161072,NULL,NULL,1.20,11.00,NULL,0,8,14,0,'2017-10-17 07:46:09','2017-11-01 22:53:57',20.00,0,0,10,200),(40,'OISHI GREEN TEA 500ml',0,NULL,'oishi',0.50,0.50,NULL,0,8,2,0,'2017-10-21 04:06:30','2017-10-29 21:56:06',11.00,0,0,1,24),(41,'cerelac with milk pro plus 250g 8m+',9556001188731,NULL,NULL,3.30,3.30,NULL,NULL,5,1,0,'2017-11-01 22:51:03','2017-11-01 22:51:03',3.30,NULL,NULL,1,1),(42,'Dumex 1 SuperGold 400g',9556098829289,'0-12 month , Abbott , DKSK','D1S 400g',10.50,10.50,NULL,NULL,10,2,1,'2017-11-02 07:48:49','2017-11-02 08:07:39',247.20,NULL,NULL,1,24),(43,'Dumex 3 Dugro 800g',9556098829951,'2-9years','DD3 800g',10.80,10.80,NULL,NULL,10,2,1,'2017-11-02 08:09:52','2017-11-02 08:09:52',127.56,NULL,NULL,1,12),(44,'LAILAC 2 900g',3575410581472,'6-12 months, France,','LL2 900g',17.80,17.80,NULL,NULL,8,2,0,'2017-11-02 08:14:37','2017-11-02 08:14:37',211.20,NULL,NULL,1,12),(45,'Pureen Baby ម្សៅ​ 525g (bleu)',9556123100468,'Baby powder , USA , made in Thai','P B Powder',5.10,5.10,NULL,NULL,8,3,0,'2017-11-02 08:21:45','2017-11-02 08:21:45',57.60,NULL,NULL,1,12),(46,'NutriGold 3 800g',8715845000512,'2-3years, Netherland, Lypack','NGold 3 800g',15.40,15.40,NULL,NULL,8,2,0,'2017-11-02 08:25:08','2017-11-02 08:35:37',91.80,NULL,NULL,1,12),(47,'Dumex 3 Super Gold 800g',9556098829326,'2-3years, Golod,  Abbott','DSG3 800g',16.85,16.85,NULL,NULL,10,2,0,'2017-11-02 08:28:57','2017-11-02 08:28:57',200.40,NULL,NULL,1,12),(48,'S26 (2) 900g',9347832000343,'From  6 months, KBK, New Zealand','S26 2 900mg',14.50,14.50,NULL,NULL,8,2,0,'2017-11-02 08:34:30','2017-11-02 08:34:47',85.20,NULL,NULL,1,6),(49,'celia (1) 900g',3114270202921,'from 6 months, Made in French','Celia 900g',12.30,12.30,NULL,NULL,8,2,0,'2017-11-02 08:38:15','2017-11-02 08:38:15',145.80,NULL,NULL,1,12),(50,'Pediasur 900g',8888426229104,'1-10years, Abbott,','Pedia',22.30,22.30,NULL,NULL,10,2,0,'2017-11-02 08:40:07','2017-11-02 08:40:07',266.40,NULL,NULL,1,12),(51,'Dumex 2 Dupro 800g',9556098829937,'6-24months, Abbott','DD 2 800g',11.50,11.50,NULL,NULL,8,2,0,'2017-11-02 08:42:05','2017-11-02 08:42:05',135.60,NULL,NULL,1,12),(52,'NutriGold (2) 800g',8715845001014,'6-24months, Netherland, Lypack','NGold 2 800g',15.35,15.35,NULL,NULL,8,2,0,'2017-11-02 08:44:16','2017-11-02 08:44:16',91.50,NULL,NULL,1,6),(53,'NutriGold (1) 800g',8715845001212,'0-6months, Netherland, Lypack','NGold 1 800g',15.40,15.40,NULL,NULL,8,2,0,'2017-11-02 08:46:18','2017-11-02 08:46:18',91.80,NULL,NULL,1,6),(54,'NutriMum 400g',8885009319009,'pregnant','Nutrimum',10.80,10.80,NULL,NULL,8,2,0,'2017-11-02 08:48:25','2017-11-02 08:48:25',256.80,NULL,NULL,1,24),(55,'Similac 3 GainIq 850g',8886451091727,'from 3years','SG3 850g',19.35,19.35,NULL,NULL,8,2,0,'2017-11-02 08:52:07','2017-11-02 08:52:07',230.40,NULL,NULL,1,12),(56,'Pediasure 400g',8886451091666,'1-10years','Pedia',11.40,11.40,NULL,NULL,5,1,0,'2017-11-02 08:53:42','2017-11-02 08:53:42',271.20,NULL,NULL,1,24),(57,'Dumex 2 Dupro 400g',9556098829920,'6-24months','DD2 400g',6.10,6.10,NULL,NULL,10,2,0,'2017-11-02 08:56:03','2017-11-02 08:56:03',144.00,NULL,NULL,1,24),(58,'Dumex mama 400g',9556098829340,'pregnant','DMama 400g',8.70,8.70,NULL,NULL,10,2,0,'2017-11-02 08:57:51','2017-11-02 08:57:51',204.00,NULL,NULL,1,24),(59,'Lyyon 1L',8846000020028,'Pure drinking water','Lyyon',0.50,2.60,NULL,NULL,8,2,0,'2017-11-02 09:00:44','2017-11-02 09:00:44',5.00,NULL,NULL,6,12),(60,'Vital 500ml',8846002481698,'Pure drinking water','V 500ml',0.25,0.25,NULL,NULL,8,2,0,'2017-11-02 09:04:57','2017-11-02 09:04:57',3.10,NULL,NULL,1,24),(61,'D-nee bottle wash 1800ml',8851989061672,'Bottle and Nipple wash','DBW 1800ml',5.45,5.45,NULL,NULL,8,4,0,'2017-11-02 09:10:54','2017-11-02 09:10:54',31.50,NULL,NULL,1,6),(62,'Milna Biscuit (Apple+orange)',8992802315050,'6 months plus, Baby Biscuit','MBB',1.60,1.60,NULL,NULL,8,1,0,'2017-11-02 09:24:24','2017-11-02 09:24:24',17.76,NULL,NULL,1,12),(63,'Milna food(Chicken soup)',8992802512114,'baby cereal, chicken soup and sweet corn','MFC',1.70,1.70,NULL,2,8,1,0,'2017-11-02 09:28:09','2017-11-02 09:28:09',18.00,0,0,1,24),(64,'cerelac food',9556001188731,'baby food, cereal with milk , Neslet,','CF',3.30,3.30,NULL,NULL,8,1,0,'2017-11-02 09:30:58','2017-11-02 09:30:58',37.20,NULL,NULL,1,12),(65,'atomy Toothpaste 200g',8809258220893,'Toothpaste with propolis, Korean products','AT 200g',4.50,4.50,NULL,NULL,8,16,0,'2017-11-02 20:02:41','2017-11-02 20:02:41',20.00,NULL,NULL,1,5),(66,'Closeup 30g',8934839120641,'12h fresh, deep action','CU 30g',0.36,0.36,NULL,NULL,8,16,0,'2017-11-02 20:05:33','2017-11-02 20:05:33',3.12,NULL,NULL,1,12),(67,'Colgate Cavity protection 35g',8850006274019,'Proven Cavity protection','CCP 35g',0.36,0.36,NULL,NULL,8,16,0,'2017-11-02 20:07:37','2017-11-02 20:07:37',3.12,NULL,NULL,1,12),(68,'Systema TP Breezy mint 160g',8888300065231,'Toothpaste, prevent gum problem','SG 160g',1.70,1.70,NULL,NULL,8,16,0,'2017-11-02 20:11:04','2017-11-02 20:11:04',9.30,NULL,NULL,1,6),(69,'Colgate TP Salt Herbal 160g',8850006322482,'Salt herbal, toothpaste','CTP SH 160g',1.40,1.40,NULL,NULL,8,16,0,'2017-11-02 20:14:42','2017-11-02 20:14:42',7.50,NULL,NULL,1,6),(70,'Colgate TP Cavity 140g',8850006272015,'Toothpaste , proven cavity protection','CTPC 140g',1.22,1.22,NULL,NULL,8,16,0,'2017-11-02 20:17:21','2017-11-02 20:17:21',6.72,NULL,NULL,1,6),(71,'Systema TP Sakura Mint 160g',8888300065231,'Sakura Mint','STP SM 160g',1.70,1.70,NULL,NULL,8,16,0,'2017-11-02 20:19:57','2017-11-02 20:19:57',9.30,NULL,NULL,1,6),(72,'Closeup TP 160g',8934839120665,'12h protection','CTP 160g',1.05,1.05,NULL,NULL,8,16,0,'2017-11-02 20:22:01','2017-11-02 20:22:01',5.40,NULL,NULL,1,6),(73,'Colgate TP USA Total 226g',35000746016,'Total , USA , 226g','CTP USA T 226g',4.15,4.15,NULL,NULL,8,16,0,'2017-11-02 20:24:13','2017-11-02 20:24:13',24.00,NULL,NULL,1,6),(74,'Colgate TP 12h 150g',8850006325636,'total 12h','CTP 12h 150g',2.20,2.20,NULL,NULL,8,16,0,'2017-11-02 20:30:18','2017-11-02 20:30:18',12.60,NULL,NULL,1,6),(75,'Sensody TP Fresh Mint 100g',8991991161332,'Fluoride , twice daily brushing','STP FM 100g',2.60,2.60,NULL,NULL,8,16,0,'2017-11-02 20:46:48','2017-11-02 20:46:48',15.00,NULL,NULL,1,6),(76,'Aquafresh Cool Mint 158.7g',8888008108049,'fluoride toothpaste, cavity protection','ATP CM 158.7g',2.60,2.60,NULL,NULL,8,16,0,'2017-11-02 20:49:21','2017-11-02 20:49:21',12.60,NULL,NULL,1,6),(77,'Colgate TP sensitive 120g',8850006342299,'salt minerals','CTP S 120g',2.70,2.70,NULL,NULL,8,16,0,'2017-11-02 20:51:13','2017-11-02 20:51:13',15.60,NULL,NULL,1,6),(78,'Twin Lotus 150g',8850348118019,'Natural Gum and Teeth protection','TL 150g',1.34,1.34,NULL,0,8,16,0,'2017-11-02 20:53:04','2017-11-04 20:27:41',7.44,0,0,1,6),(79,'Twin Lotus 40g',8850348104012,'Natural Gum and Cavity Protection','TL 40g',0.41,0.41,NULL,NULL,8,16,0,'2017-11-02 20:55:40','2017-11-02 20:55:40',4.32,NULL,NULL,1,12),(80,'Darlie Whitening Fresh 160g+40g',4891338011167,'all shiny , Lime Mint , whitening freshness','DWF 160g+40g',1.60,1.60,NULL,NULL,8,16,0,'2017-11-02 20:59:50','2017-11-02 20:59:50',9.00,NULL,NULL,1,6),(81,'Darlie Twin Strong Mint 225g+225g',4891338033268,'original Strong Mint, Double action','DT SM 225g + 225g',2.70,2.70,NULL,NULL,8,16,0,'2017-11-02 21:02:40','2017-11-02 21:02:40',15.60,NULL,NULL,1,6),(82,'Sensodyne Whitening 100g',4893776000772,'fluoride, Whitening','SW 100g',2.60,2.60,NULL,NULL,8,16,0,'2017-11-02 21:04:23','2017-11-02 21:04:23',15.00,NULL,NULL,1,6),(83,'Strepsil Orange Lozenges',9556108211356,'24tbl per pack','SO Lozenges',0.07,0.80,NULL,NULL,10,17,0,'2017-11-03 16:24:29','2017-11-03 16:24:29',1.50,NULL,NULL,12,24),(84,'Strepsil Original Lozenges',9556108211325,'24 tbl per pack','SO Lozenges',0.07,0.80,NULL,NULL,10,17,0,'2017-11-03 16:25:57','2017-11-03 16:25:57',1.50,NULL,NULL,12,24),(85,'Strepsil Cool Lozenges',9556108211349,'24 tbl per pack','SC lozeges',0.07,0.80,NULL,0,10,17,0,'2017-11-03 16:27:21','2017-11-04 20:17:53',1.50,0,0,12,24),(86,'Mentopas 1x10 sheets',8850304103707,NULL,'Mentopas',0.35,0.35,NULL,0,8,16,1,'2017-11-04 20:22:31','2017-11-06 21:27:28',7.20,0,0,1,24),(87,'Takabb anti-cough pill',8852761000711,'original flavour','TAC pill',0.40,0.40,NULL,NULL,8,17,0,'2017-11-05 09:26:30','2017-11-05 09:26:30',4.20,NULL,NULL,1,12),(88,'Strepsil Honey Lemon logenes',9556108211332,'24 tbl per box','SHL lozenges',0.07,0.80,NULL,NULL,8,17,0,'2017-11-05 09:29:41','2017-11-05 09:29:41',1.60,NULL,NULL,12,24),(89,'Mentos Berry  Chewing Gum',8935001707387,'Sugar free,','MB Chewing Gum',0.35,0.35,NULL,NULL,8,1,0,'2017-11-05 09:34:01','2017-11-05 09:34:01',3.40,NULL,NULL,1,10),(90,'Urgo Waterproof 20pc',8851401002436,'2x 7.2cm','Urgo',1.10,1.10,NULL,NULL,8,18,0,'2017-11-05 09:36:18','2017-11-05 09:36:18',9.50,NULL,NULL,1,10),(91,'Urgo Durable 20pc',8851401002016,'2x6cm','Urgo',1.10,1.10,NULL,NULL,8,18,0,'2017-11-05 09:38:12','2017-11-05 09:38:12',9.50,NULL,NULL,1,10),(92,'Quicklean Hand Gel 50ml',9556100104199,'99% kill bacterial','Q Hand Gel',1.10,1.10,NULL,NULL,12,19,1,'2017-11-05 09:42:28','2017-11-05 09:42:28',10.00,NULL,NULL,1,10),(93,'Tylenol 500mg tablet',300450444394,'325 tablets per box, Extra Strength','Tylenol',0.09,0.09,NULL,NULL,8,17,1,'2017-11-05 09:46:20','2017-11-05 09:46:20',22.75,NULL,NULL,1,325),(94,'Cool Air Chewing Gum Bottle',8936045081815,'Menthol and Eucalyptus','Cool Air',1.10,1.10,NULL,NULL,8,16,1,'2017-11-05 09:48:51','2017-11-05 09:48:51',6.00,NULL,NULL,1,6),(95,'Vit C orange  flavor for Kid',8858757006583,'Vit C lozenge for kid','Vit C',1.00,1.00,NULL,NULL,8,17,1,'2017-11-05 09:51:40','2017-11-05 09:51:40',5.40,NULL,NULL,1,6),(96,'Vit C Effervescent 20 tbl',4001728371058,'Vit C with Cal','Vit C Effe',0.30,0.30,NULL,NULL,8,17,1,'2017-11-05 09:54:28','2017-11-05 09:54:28',4.40,NULL,NULL,1,20),(97,'Axe brand Oil 10ml',8888115000144,'Quick relief of Cold and Headache','Axe oil 10ml',1.23,1.23,NULL,NULL,8,17,1,'2017-11-05 09:56:55','2017-11-05 09:56:55',13.20,NULL,NULL,1,12),(98,'Siang Pure Oil 3ml',8850109001130,'Menthol and Peppermint','Siang',0.60,0.60,NULL,NULL,8,17,1,'2017-11-05 09:58:47','2017-11-05 09:58:47',6.60,NULL,NULL,1,12),(99,'Vit B Compelex',8848012902149,'B 1 B12 B6','Vit B Comp',0.04,0.04,NULL,NULL,18,17,1,'2017-11-05 10:01:20','2017-11-05 10:02:43',3.90,NULL,NULL,1,100),(100,'DoubleMint Chewing Gum bottle',8936045081839,'Peppermint','Doublemint',1.10,1.10,NULL,NULL,8,16,0,'2017-11-05 10:04:39','2017-11-05 10:04:39',6.00,NULL,NULL,1,6),(101,'Vit C Strawberry Flavor  for kid',8858757006576,'For kid','Vit for kid',1.00,1.00,NULL,NULL,8,17,1,'2017-11-05 10:06:55','2017-11-05 10:06:55',5.40,NULL,NULL,1,6),(102,'Lysopain lozenge 24tbl',1000001,'relief sore throat , sugar free , Mint','Lysopain',0.11,0.11,NULL,NULL,19,17,1,'2017-11-05 10:10:32','2017-11-05 10:12:30',2.20,NULL,NULL,1,24),(103,'L\' Oreal Men Anti-acne Facial Foam 100ml',8992304032431,'White Active , anti -acne, Volcanic Mineral Extract','L\'Oreal Men FF',3.10,3.10,NULL,NULL,10,3,0,'2017-11-08 12:36:03','2017-11-08 12:36:03',30.00,NULL,NULL,1,10),(104,'Oral Aid Lotion',1000002,'Lignocaine 2.5%','Oral aid',3.00,3.00,NULL,NULL,25,17,1,'2017-11-08 14:51:31','2017-11-08 14:51:31',29.00,NULL,NULL,1,10),(105,'Neo-K tablet',8806009002319,'Antitussives, Expectorant','Neo-K',0.07,0.60,NULL,NULL,23,17,1,'2017-11-08 15:00:26','2017-11-08 15:00:26',5.10,NULL,NULL,10,100),(106,'Gateby Energizing Facial Foam 100g',8992222054591,'Cooling face wash','Gateby Energi',2.68,2.68,NULL,NULL,21,3,0,'2017-11-08 15:05:18','2017-11-08 15:05:18',15.36,NULL,NULL,1,6),(107,'Nivea Invisible 48h Female Dry -roll on 43g',72140009779,'For black and white 48h','Nivea Dry Roll on',3.30,3.30,NULL,NULL,26,3,0,'2017-11-08 15:16:24','2017-11-08 15:16:24',18.90,NULL,NULL,1,6),(108,'Pond Men face Scrub 100g',8999999034733,'White boost','Pond Men Scrub',2.50,2.50,NULL,NULL,22,3,0,'2017-11-08 15:23:59','2017-11-08 15:23:59',14.10,NULL,NULL,1,6),(109,'Vaseline Men Face foam 100g',4800888157966,'Healthy white','Vaseline Men',2.40,2.40,NULL,NULL,22,3,0,'2017-11-08 15:27:26','2017-11-08 15:27:26',13.50,NULL,NULL,1,6),(110,'Alphachymotripsine table',8848003003992,'alpha 4.2mg','Alphachy',0.07,0.60,NULL,NULL,24,17,1,'2017-11-08 15:32:40','2017-11-08 15:32:40',4.50,NULL,NULL,10,100),(111,'Polydexa ear drop',3400931533429,'Neomycine polymyxine dexamethason','Polydexa',3.30,3.30,NULL,NULL,27,17,1,'2017-11-08 15:34:56','2017-11-08 15:37:10',18.90,NULL,NULL,1,6),(112,'Gateby  Whitening foam 50g',8992222054546,'Clear Whitenging','Gateby  50g',1.65,1.65,NULL,NULL,21,3,0,'2017-11-08 15:40:57','2017-11-08 16:05:46',18.60,NULL,NULL,1,12),(113,'Ciplox Eye/Ear drop',8901117088016,'Ciprofloxacine','Ciplox',1.20,1.20,NULL,NULL,28,17,1,'2017-11-08 15:45:35','2017-11-08 15:46:31',10.50,NULL,NULL,1,10),(115,'Setamol table',1000003,'Paracetamol 500mg','Setamol',0.05,0.40,NULL,NULL,12,17,1,'2017-11-08 15:54:29','2017-11-08 15:54:29',2.00,NULL,NULL,10,100),(116,'Unorizine tablet',1000004,'Levocetirizine 5mg (xyzal)','Unorizine',0.06,0.50,NULL,NULL,30,17,1,'2017-11-08 15:59:20','2017-11-08 15:59:20',3.50,NULL,NULL,10,100),(117,'Gateby Anti-acne Foam 50g',8992222054560,'Anti-acne','Gateby 50g',1.65,1.65,NULL,NULL,21,3,0,'2017-11-08 16:01:28','2017-11-08 16:05:25',18.60,NULL,NULL,1,12),(118,'Gateby Oil Control 100g',8992222054539,'Oil Control','Gateby Oil Control',2.68,2.68,NULL,NULL,21,3,0,'2017-11-08 16:05:06','2017-11-08 16:05:06',15.36,NULL,NULL,1,6),(120,'DSM-Acetazap 325mg tbl',8904176813803,'Paracetamol 325mg','DSM acetazap',0.05,0.40,NULL,NULL,32,17,1,'2017-11-09 02:53:27','2017-11-09 02:53:27',2.60,NULL,NULL,10,100),(121,'Nivea Men White foam 100g',4005808655984,'10x extra white','Nivea Men white',2.75,2.75,NULL,NULL,26,3,1,'2017-11-09 03:02:49','2017-11-09 03:02:49',7.80,NULL,NULL,1,3),(122,'Gateby Anti-acne Foam 100g',8992222054577,'Anti Acne','Gateby  100g',2.68,2.68,NULL,NULL,21,3,0,'2017-11-09 22:10:46','2017-11-09 22:10:46',15.36,NULL,NULL,1,6),(123,'Nivea Men Anti-Acne foam 100g',8850029001791,'Anti-acne','Nivea Men 100g',2.68,2.68,NULL,NULL,26,3,0,'2017-11-09 22:14:33','2017-11-09 22:14:33',15.36,NULL,NULL,1,6),(124,'Vaseline Men Anti Dull face scrub 100g',4800888157942,'Anti dull face scrub, jelly and micro beads','Vaseline Men 100g',2.40,2.40,NULL,NULL,22,3,0,'2017-11-09 22:16:57','2017-11-09 22:16:57',13.50,NULL,NULL,1,6),(125,'Pond Men Energy charge foam 100g',8999999034696,'Recharge skin','Pond Men',2.50,2.50,NULL,NULL,22,3,0,'2017-11-09 22:21:37','2017-11-09 22:21:37',14.10,NULL,NULL,1,6),(126,'L\' Oreal Men Oil Control 100ml',8992304009679,'Brightening + oil control','L\'Oreal Men FF',3.15,3.15,NULL,NULL,20,3,0,'2017-11-09 22:28:21','2017-11-09 22:28:21',18.00,NULL,NULL,1,6),(127,'Nivea Men oil control + white foam 100g',4005808888696,'10x white oil control','Nivea Men oil control',2.65,2.65,NULL,NULL,26,3,0,'2017-11-09 22:46:32','2017-11-09 22:46:32',15.00,NULL,NULL,1,6),(128,'HISZIN table',1000005,'Cetirizine 10mg','Hiszin',0.05,0.40,NULL,NULL,33,17,1,'2017-11-09 22:52:19','2017-11-09 22:52:42',2.50,NULL,NULL,10,100),(129,'Decolgen Fort',8992112000318,'Para 500mg\r\nPhenylpropanolamine 25mg\r\nChlorpheniramine 2mg','Decolgen',0.07,1.03,NULL,NULL,34,17,1,'2017-11-09 22:56:39','2017-11-09 22:58:17',4.80,NULL,NULL,20,100),(130,'Pond Men Pollution Out foam 100g',8999999041656,'Foam + coffee bean scrubs+charcoal mask','Pond Men',2.50,2.50,NULL,NULL,22,3,0,'2017-11-09 23:01:45','2017-11-09 23:01:45',14.10,NULL,NULL,1,6),(131,'Enchanteur female white roll on 20ml',8935212800396,'fresh milk cream','Enchanteur roll on',1.20,1.20,NULL,NULL,10,3,0,'2017-11-09 23:07:41','2017-11-09 23:07:41',12.00,NULL,NULL,1,12),(132,'Gateby Energyzing foam 50g',8992222054584,'Smooth Power','Gateby  50g',1.65,1.65,NULL,NULL,21,3,0,'2017-11-09 23:15:29','2017-12-02 21:19:38',18.50,NULL,NULL,1,10),(133,'Zeagra 100mg table',8904054610579,'Sildenafil','Zeagra',2.00,2.00,NULL,NULL,35,17,1,'2017-11-09 23:20:33','2017-11-09 23:21:18',19.00,NULL,NULL,1,10),(134,'Intetrix cap',3400930535349,'Tibroquinol and Tiliquinol','Intetrix',0.21,2.00,NULL,NULL,36,17,1,'2017-11-11 01:53:31','2017-11-11 01:53:31',3.90,NULL,NULL,10,20),(135,'Imodium cap',3400931886075,'Loperamid 2mg','Imodium',0.22,4.10,NULL,NULL,37,17,1,'2017-11-11 01:56:47','2017-11-11 01:58:04',4.10,NULL,NULL,20,20),(136,'Amlo-Denk 5mg tbl',4031571051166,'Amlodipine','Amlo-Denk 5mg',1.51,1.51,NULL,NULL,38,17,1,'2017-11-11 02:00:22','2017-11-11 02:01:17',7.30,NULL,NULL,1,5),(137,'Ventolin Inhaler 100mcg',4800333161456,'Salbutamol 100mcg/actuation','Ventolin',4.40,4.40,NULL,NULL,39,17,1,'2017-11-11 02:03:31','2017-11-11 02:04:15',4.40,NULL,NULL,1,1),(138,'Motilium 10mg tbl',3400932341122,'Domperidone 10mg','Motilium',0.12,4.10,NULL,NULL,37,17,1,'2017-11-11 02:06:50','2017-11-11 02:06:50',4.10,NULL,NULL,40,40),(139,'Bactrim Fort 800mg/160mgtbl',3400932197040,'Sulfamethoxazole+ Trimethoprim','Bactrum',0.33,3.10,NULL,NULL,40,17,1,'2017-11-11 02:10:14','2017-11-11 02:11:04',3.10,NULL,NULL,10,10),(140,'Amlo-Denk 10mg',4031571051197,'Amlodipine 10mg','Amlo_Denk',2.35,11.50,NULL,NULL,38,17,1,'2017-11-11 02:34:05','2017-11-11 02:34:05',11.50,NULL,NULL,1,5),(141,'Carbophos tbl',3400930186442,'Charbon Vegetal 400mg','Carbophos',0.12,2.07,NULL,NULL,41,17,1,'2017-11-11 02:41:06','2017-11-11 02:42:05',3.94,NULL,NULL,20,40),(143,'Bepanthene 100mg tbl',1000007,'Vit B 5','Bepanthene',1.20,1.20,NULL,NULL,42,17,1,'2017-11-11 02:51:08','2017-11-11 02:51:57',2.40,NULL,NULL,1,2),(144,'Otrivin 0.05%',1000008,'Xylometazoline 0.05%','Otrivin',2.00,2.00,NULL,NULL,43,17,1,'2017-11-11 02:54:34','2017-11-11 02:55:52',2.00,NULL,NULL,1,1),(145,'Otrivin 0.1%',1000009,'Xylometazoline','Otrivin',2.30,2.30,NULL,NULL,43,17,1,'2017-11-11 02:57:35','2017-11-11 02:57:35',2.30,NULL,NULL,1,1),(147,'Allergis',8851473004291,'Sterile eye drop','Allergie',1.50,1.50,NULL,NULL,44,17,1,'2017-11-12 01:12:46','2017-11-12 01:14:06',1.50,NULL,NULL,1,1),(148,'Urispas 200mg tbl',1000010,'Flavoxate','Urispas',0.25,3.24,NULL,NULL,27,17,1,'2017-11-12 01:20:40','2017-11-12 01:20:40',9.72,NULL,NULL,14,42),(149,'Relax 7.5mg tbl',8806497008831,'Sod. Picosulfate','Relax',0.09,1.60,NULL,NULL,45,17,1,'2017-11-12 01:23:55','2017-11-12 01:24:47',1.60,NULL,NULL,20,20),(150,'Bactrim Adult 400/80mg tbl',3400930010693,'Sulfametoxazole+trimethoprime','Bactrim',0.19,1.70,NULL,NULL,40,17,1,'2017-11-12 01:28:13','2017-11-12 01:28:13',3.40,NULL,NULL,10,20),(151,'Vometa sp drop',1000011,'Domperidone 5mg/ml','Vometa',3.80,3.70,NULL,NULL,46,17,1,'2017-11-12 01:32:21','2017-11-12 01:32:21',3.70,NULL,NULL,1,1),(152,'Tobrex eye drop',1000012,'Tobramycin 0.3%','Tobrex',2.50,2.50,NULL,NULL,47,17,1,'2017-11-12 01:36:15','2017-11-12 01:41:51',2.50,NULL,NULL,1,1),(154,'Tobradex eye drop',5413895038730,'Tobramycine+Dexa','Tobradex',2.65,2.65,NULL,NULL,47,17,1,'2017-11-12 01:43:35','2017-11-12 01:43:35',2.65,NULL,NULL,1,1),(155,'Spasfon tbl',3400930986080,'Phloroglucinol 80mg','Spasfon',0.12,1.10,NULL,NULL,48,17,1,'2017-11-12 01:48:21','2017-11-12 01:48:21',3.30,NULL,NULL,10,30),(156,'Berodual',1000013,'Ipratropium bromide 250mcg+Fenoterol 500mcg','Berodual',5.30,5.30,NULL,NULL,19,17,1,'2017-11-12 01:51:50','2017-11-12 01:51:50',5.30,NULL,NULL,1,1),(157,'Vometa 10mg tbl',1000014,'Domperidone','Vometa',0.11,1.00,NULL,NULL,46,17,1,'2017-11-12 01:54:43','2017-11-12 01:54:43',4.60,NULL,NULL,10,50),(158,'Wood Cherry Flavour',8992858687408,'6 lozenges per pack','Wood Cherry',0.30,0.30,NULL,NULL,49,17,1,'2017-12-02 16:40:44','2017-12-02 16:42:15',3.70,NULL,NULL,1,15),(160,'Gateby Spiky Hair Gel',8992222051729,'Stand up , Power and spikes','Gateby Hair Gel',1.76,1.76,NULL,NULL,21,3,0,'2017-12-02 16:51:23','2017-12-02 16:51:23',9.96,NULL,NULL,1,6),(161,'Gateby British Hair Gel',8992222051606,'Hard & Free','Gateby Hair Gel',1.76,1.76,NULL,NULL,21,3,0,'2017-12-02 20:48:10','2017-12-02 20:48:10',9.96,NULL,NULL,1,6),(162,'Gateby Harajuku Hair Gel',8992222051613,'Mat & Hard , Volume up','Gateby Hair Gel',1.76,1.76,NULL,NULL,21,3,0,'2017-12-02 20:49:52','2017-12-02 20:49:52',9.96,NULL,NULL,1,6),(163,'Gateby  Mohawk Hair Gel',8992222053129,'Ultimate & Shaggy, Firmed','Gateby Hair Gel',1.76,1.76,NULL,NULL,21,3,0,'2017-12-02 20:58:35','2017-12-02 20:58:35',9.96,NULL,NULL,1,6),(164,'Wood Orange Flavour',8992858687507,'6  lozenges per pack','Wood Orange',0.30,0.30,NULL,NULL,49,17,1,'2017-12-02 21:02:20','2017-12-02 21:08:14',3.75,NULL,NULL,1,15),(165,'Wood Lemon Flavour',8992858687309,'6 lozenges per pack','Wood Lemon',0.30,0.30,NULL,NULL,49,17,1,'2017-12-02 21:03:49','2017-12-02 21:07:54',3.70,NULL,NULL,1,15),(166,'Wood Original Flavour',8992858687101,'6 lozenges per pack','Wood Original',0.30,0.30,NULL,NULL,49,17,1,'2017-12-02 21:05:08','2017-12-02 21:07:39',3.70,NULL,NULL,1,15),(168,'Gateby Perfect Clean Foam 50g',8992222054508,'smooth power','Gateby  50g',1.65,1.65,NULL,NULL,21,3,0,'2017-12-02 21:17:23','2017-12-02 21:19:14',18.50,NULL,NULL,1,12),(174,'Mamypoko pants Boy&Girl S 70',8851111410071,'S70 pants 4-8kg, up to 12h','Mamypoko',12.60,12.60,NULL,NULL,50,16,0,'2017-12-03 07:35:41','2017-12-03 07:48:22',37.05,NULL,NULL,1,3),(175,'Mamypoko pants Boy&Girl S 78',8851111417087,'for boy&girl 4-8kg, up to 8h','Mamypoko',11.25,11.25,NULL,NULL,50,16,0,'2017-12-03 07:47:20','2017-12-03 07:47:20',33.50,NULL,NULL,1,3),(176,'Mamypoko pants Boy&Girl S 38',8851111417223,'for boy&girl, up to 8h','Mamypoko',6.65,6.65,NULL,NULL,50,16,0,'2017-12-03 07:53:00','2017-12-03 07:53:00',26.30,NULL,NULL,1,4),(177,'Dryper pants S 48',9557327004767,'4-8kg,  up to 10h','Dryper',10.50,10.50,NULL,NULL,51,16,0,'2017-12-03 07:58:21','2017-12-03 07:58:21',41.40,NULL,NULL,1,4),(178,'Dryper we we dry S 82',9557327011000,'3-7kg','Dryper we we dry',11.80,11.80,NULL,NULL,51,15,0,'2017-12-03 08:05:34','2018-03-09 15:52:05',34.80,NULL,NULL,1,3),(179,'Dryper we we dry M20',9557327011208,'6-11kg','Dryper',3.55,3.55,NULL,NULL,51,16,0,'2017-12-03 08:10:44','2017-12-03 08:10:44',27.60,NULL,NULL,1,8),(180,'Dryper we we dry L 24',9557327000592,'9-11kg','Dryper',4.50,4.50,NULL,NULL,51,16,0,'2017-12-03 08:13:57','2017-12-03 08:13:57',35.20,NULL,NULL,1,8),(181,'UniDry pants M22',8935142959225,'6-11kg','Unidry',3.17,3.17,NULL,NULL,52,16,0,'2017-12-03 08:19:12','2017-12-03 08:19:12',26.16,NULL,NULL,1,8),(182,'UniDry pants L20',8935142959201,'9-11kg','Unidry',3.17,3.17,NULL,NULL,52,16,0,'2017-12-03 08:20:56','2017-12-03 08:20:56',26.10,NULL,NULL,1,8),(183,'UniDry pads S30',8935142966322,'3-7kg','Unidry',2.70,2.70,NULL,NULL,52,16,0,'2017-12-03 08:24:06','2017-12-03 08:24:06',21.20,NULL,NULL,1,8),(184,'Bobby Newborn2 60pads',8934755030505,'Newborn','Bobby',4.80,4.80,NULL,NULL,50,16,0,'2017-12-03 08:32:24','2017-12-03 08:43:06',28.10,NULL,NULL,1,6),(185,'Bobby Newborn1 56pads',8934755030413,'Newborn','Bobby',3.05,3.05,NULL,NULL,50,16,0,'2017-12-03 08:37:07','2017-12-03 08:37:07',24.00,NULL,NULL,1,8),(186,'Bobby Newborn2 40pads',8934755030420,'Newborn','Bobby',3.20,3.20,NULL,NULL,50,16,0,'2017-12-03 08:42:48','2017-12-03 08:42:48',19.10,NULL,NULL,1,6),(189,'Aerius 0.5mg/ml',1000015,'Desloratadine 60ml','Aerius sp',3.80,3.80,NULL,NULL,53,17,1,'2017-12-03 21:03:47','2017-12-03 21:05:09',37.10,NULL,NULL,1,10),(190,'D-nee lively detergent 3000 ml',8851989061337,'bright&white, hand&machine wash','D-nee detergent',8.00,8.00,NULL,NULL,54,4,0,'2017-12-13 06:10:15','2017-12-13 06:17:11',31.40,NULL,NULL,1,4),(191,'D-nee Honey star detergent 3000 ml',8851989060316,'hand& machine wash','D-nee detergent',8.00,8.00,NULL,NULL,54,4,0,'2017-12-13 06:16:53','2017-12-13 06:16:53',31.40,NULL,NULL,1,4),(192,'D-nee Yellow moon detergent 3000 ml',8851989061535,'hand&machine wash','D-nee detergent',8.00,8.00,NULL,NULL,54,4,0,'2017-12-13 06:19:18','2017-12-13 06:19:18',31.40,NULL,NULL,1,4),(193,'D-nee Lovely sky detergent 3000 ml',8851989060057,'hand&machine wash','D-nee detergent',8.00,8.00,NULL,NULL,54,4,0,'2017-12-13 06:20:36','2017-12-13 06:20:36',31.40,NULL,NULL,1,4),(194,'D-nee bottle wash 500ml',8851989060248,'bottle&nipple wash','D-nee bottle wash',2.20,2.20,NULL,NULL,54,4,0,'2017-12-13 06:33:03','2017-12-13 06:33:03',24.00,NULL,NULL,1,12),(195,'D-nee powder Pure 180g',8851989061016,'Spring sea water&sakura&VitE','D-nee Powder',1.10,1.10,NULL,NULL,54,3,0,'2017-12-13 06:42:06','2017-12-13 06:42:06',3.00,NULL,NULL,1,3),(198,'D-nee Kids Bath Berry 400 ml',8851989060842,'Head&body bath','D-nee Bath',2.90,2.90,NULL,NULL,54,4,0,'2017-12-13 06:52:56','2017-12-13 07:05:32',8.20,NULL,NULL,1,3),(199,'D-nee Pure Bath 400ml',8851989060422,'Head&body baby wash','D-nee Bath',2.70,2.70,NULL,NULL,54,4,0,'2017-12-13 07:01:06','2017-12-13 07:01:06',7.70,NULL,NULL,1,3),(200,'D-nee Pure Bath 200ml',8851989060378,'Head&body bath for sensitive skin','D-nee Bath',1.55,1.55,NULL,NULL,54,4,0,'2017-12-13 07:08:39','2017-12-13 07:08:39',4.40,NULL,NULL,1,3),(203,'D-nee Kids Bath Berry 200 ml',8851989060576,'Head&body wash','D-nee Bath',1.60,1.60,NULL,NULL,54,4,0,'2017-12-13 07:16:56','2017-12-13 07:16:56',4.50,NULL,NULL,1,3),(204,'D-nee Kids Bath Cherry 200 ml',8851989060569,'head&body wash','D-nee Bath',1.60,1.60,NULL,NULL,54,4,0,'2017-12-13 07:18:38','2017-12-13 07:18:38',4.50,NULL,NULL,1,3),(205,'D-nee Kids Bath 3 in 1 (Yellow) 200 ml',8851989063065,'shampoo&conditioner&body wash','D-nee Bath',1.70,1.70,NULL,NULL,54,4,0,'2017-12-13 07:22:28','2017-12-13 07:25:35',4.50,NULL,NULL,1,3),(206,'D-nee Kids Bath 3 in 1 (Blue) 200 ml',8851989063058,'shampoo&conditioner&body wash','D-nee Bath',1.70,1.70,NULL,NULL,54,4,0,'2017-12-13 07:25:08','2017-12-13 07:25:08',4.50,NULL,NULL,1,3),(207,'D-nee kid toothpaste Berry 40g',8851989062013,'Cream beads for children','D-nee Toothpaste',0.85,0.85,NULL,NULL,54,20,0,'2017-12-13 07:31:37','2017-12-13 07:34:16',2.15,NULL,NULL,1,3),(208,'D-nee kid toothpaste Cherry 40g',8851989062037,'Cream beads for children','D-nee Toothpaste',0.85,0.85,NULL,NULL,54,20,0,'2017-12-13 07:33:57','2017-12-13 07:33:57',2.15,NULL,NULL,1,3),(209,'D-nee kid toothpaste Stawberry 40g',8851989062006,'Cream for children','D-nee Toothpaste',0.85,0.85,NULL,NULL,54,20,0,'2017-12-13 07:35:51','2017-12-13 07:35:51',2.15,NULL,NULL,1,3),(210,'Tylenol SP 160mg/5ml 60ml',8850583000247,'Paracetamol oral suspension, cherry flavor, alcohol free','Tylenol',1.66,1.66,NULL,NULL,10,17,1,'2017-12-24 08:17:23','2017-12-24 08:17:23',15.50,NULL,NULL,1,10),(211,'Sara SP 120mg/5ml 60ml',8851473000385,'Paracetamol, strawberry flavor, alcohol free& sugar free','Sara',1.18,1.18,NULL,NULL,44,17,1,'2017-12-24 08:20:41','2017-12-24 08:21:50',10.00,NULL,NULL,1,10),(213,'Dolipran SP 100ml',3461546,'paracetamol 2.4%, 3-26kg, strawberry flavor','Dolipran',3.60,3.60,NULL,NULL,56,17,1,'2017-12-24 08:29:31','2017-12-24 08:30:50',31.50,NULL,NULL,1,10),(214,'Many Day&Night L 64',8851111419180,'L64 Pant 9-14kg','Mamy pants',11.20,11.20,NULL,NULL,50,15,0,'2018-03-09 15:44:12','2018-03-09 15:52:56',31.30,NULL,NULL,1,3),(215,'Many Day&Night XXL48',8851111421046,'Pants, XXL48 , 15-25kg','Mamy pants',11.20,11.20,NULL,NULL,50,15,0,'2018-03-09 15:48:41','2018-03-09 15:52:41',31.30,NULL,NULL,1,3),(216,'Mamypoko pants Girl XXXL14',8851111401871,'Pants, XXXL 14, 18-35','Mamy pants',9.20,9.20,NULL,NULL,50,15,0,'2018-03-09 15:57:20','2018-03-09 15:57:20',36.30,NULL,NULL,1,4),(217,'Unidry pants L54',8935142960542,'Pants, L 54, 9-14kg','Unidry',8.50,8.50,NULL,NULL,52,15,0,'2018-03-09 16:04:26','2018-03-09 16:04:26',32.00,NULL,NULL,1,4),(219,'Rhumadol',8848003000236,'B1, B12, B6 & Dexamethason','Rhumadol',0.08,0.60,NULL,NULL,24,17,0,'2018-03-11 17:25:47','2018-03-11 17:25:47',5.10,NULL,NULL,10,100),(225,'Aerius 5mg tbl',1000017,'Desloratadine tablet of 5mg','Aerius',0.40,3.90,NULL,NULL,53,17,1,'2018-03-13 16:12:39','2018-03-13 16:12:39',3.90,NULL,NULL,10,10),(226,'Phenergan 25mg tbl',1000018,'Promethazine','Phenergan',0.08,1.30,NULL,NULL,57,17,1,'2018-03-13 16:15:35','2018-03-13 16:22:23',1.30,NULL,NULL,20,20),(229,'Phenergan Syrup 0.1%',1000019,'Promethazin','Phenergan',2.10,2.10,NULL,NULL,57,17,1,'2018-03-13 16:27:15','2018-03-13 16:27:15',2.10,NULL,NULL,1,1),(230,'Primalan syrup 0.05g/100ml',3400932636808,'mequitazine','Primalan',3.00,3.00,NULL,NULL,59,17,1,'2018-03-13 16:39:20','2018-03-13 16:39:20',3.00,NULL,NULL,1,1),(231,'Primalan 5mg tbl',3400931815686,'Mequitazine','Primalan',0.37,4.70,NULL,NULL,59,17,1,'2018-03-13 16:41:37','2018-03-13 16:41:37',4.70,NULL,NULL,14,14),(232,'Pengesic SR 100mg tbl',1000020,'Tramadol 100mg','Pengesic',0.20,1.60,NULL,NULL,12,17,1,'2018-03-14 16:11:53','2018-03-14 16:11:53',4.65,NULL,NULL,10,30),(233,'Pengesic 50mg cap',1000021,'tramadol 50mg','Pengesic',0.10,0.85,NULL,NULL,12,17,1,'2018-03-14 16:17:16','2018-03-14 16:17:16',7.80,NULL,NULL,10,100),(234,'Cloxacap 500mg cap',1000022,'Cloxacillin','Cloxacillin',0.11,1.00,NULL,NULL,12,17,1,'2018-03-14 16:20:07','2018-03-14 16:20:07',8.80,NULL,NULL,10,100),(235,'Suprim 480mg tbl',1000023,'Co-trimoxazole','Suprim',0.06,0.50,NULL,NULL,12,17,1,'2018-03-14 16:23:37','2018-03-14 16:23:37',3.80,NULL,NULL,10,100),(236,'Suprim suspension 240mg',1000024,'Co-trimoxazole','Suprim',1.50,1.50,NULL,NULL,12,17,1,'2018-03-14 16:25:37','2018-03-14 16:25:37',1.50,NULL,NULL,1,1),(237,'Virest 200mg tbl',1000025,'Aciclovir 200mg','Virest',0.12,0.88,NULL,NULL,12,17,1,'2018-03-14 16:28:56','2018-03-14 16:28:56',8.60,NULL,NULL,5,25),(238,'Virest 5% cream 5g',1000026,'Aciclovir','Virest',1.80,1.80,NULL,NULL,12,17,1,'2018-03-14 16:31:54','2018-03-14 16:31:54',1.80,NULL,NULL,1,1),(239,'Colodium 2mg cap',1000027,'Loperamide','Colodium',0.07,0.40,NULL,NULL,12,17,1,'2018-03-14 16:34:38','2018-03-14 16:34:38',3.30,NULL,NULL,10,100),(240,'Amoxigran 125mg/5ml suspension 60ml',1000028,'Amoxicillin','Amoxigran',1.50,1.50,NULL,NULL,12,17,1,'2018-03-14 16:37:27','2018-03-14 16:37:27',1.50,NULL,NULL,1,1),(241,'Xyfisim 100mg',1000029,'cefixim granule 100mg \r\nstrawberry flavour','Xyfisim',0.60,0.60,NULL,NULL,12,17,1,'2018-03-14 16:40:03','2018-03-14 16:40:03',3.30,NULL,NULL,1,6),(242,'Amoxicap 500mg cap',1000030,'Amoxicillin','Amoxicap',0.07,0.60,NULL,NULL,12,17,1,'2018-03-14 16:43:59','2018-03-14 16:43:59',5.30,NULL,NULL,10,100),(248,'Wings',8855629000120,'face powder SPF25+ \r\nall skin types','Face Powder',6.50,6.50,NULL,NULL,63,3,0,'2018-03-16 14:45:30','2018-03-16 14:45:30',6.50,NULL,NULL,11,1),(249,'Sun Protection',8855629006467,'face powder SPF50+\r\nall skin types','Face Powder',5.50,5.50,NULL,NULL,63,3,0,'2018-03-16 14:48:10','2018-03-16 14:48:10',5.50,NULL,NULL,1,1),(250,'Selfie',8855629006696,'Face powder SPF 45+\r\nall skin types','Face Powder',5.30,5.30,NULL,NULL,63,3,0,'2018-03-16 14:49:33','2018-03-16 14:49:33',5.30,NULL,NULL,1,1),(251,'Beer Shampoo 500ml',8859178711087,'Brewery with B5','Shampoo',6.50,6.50,NULL,NULL,63,3,0,'2018-03-16 15:07:51','2018-03-16 15:07:51',6.50,NULL,NULL,1,1),(252,'White Aura body Lotion 400ml',8855629006382,'GF protein\r\nwhitening','Body Lotion',5.00,5.00,NULL,NULL,63,3,0,'2018-03-16 15:47:09','2018-03-16 15:47:09',5.00,NULL,NULL,1,1),(253,'Bulgarian Yogurt White Body Lotion 500ml',8855629000335,'Yogurt Extra \r\nWhitening','Body Lotion',5.00,5.00,NULL,NULL,63,3,0,'2018-03-16 15:49:13','2018-03-16 15:49:13',5.00,NULL,NULL,1,1),(254,'Q10 Body Lotion 600ml',8855629361450,'Co-ezxyme Q10\r\n Plus Cherry Extra + sunscreen','Body Lotion',4.20,4.20,NULL,NULL,63,3,0,'2018-03-16 15:53:12','2018-03-16 15:53:12',4.20,NULL,NULL,1,1),(255,'FUK KA   Body Lotion 500ml',8859178707646,'Gac Fruit & Vit C+E\r\nDouble UV Filters \r\nSoluble Collagen','Body Lotion',4.70,4.70,NULL,NULL,63,3,0,'2018-03-16 16:21:01','2018-03-16 16:21:01',4.70,NULL,NULL,1,1),(256,'Energizing Aroma shower Gel',8859178710783,'Lemongrass & Lemon & Mint','Shower',5.00,5.00,NULL,NULL,63,3,0,'2018-03-16 16:23:33','2018-03-16 16:23:33',5.00,NULL,NULL,1,1),(257,'Glutathion Body Scrub 200ml',8859178710714,'Gluta White Bead','Body Scrub',4.00,4.00,NULL,NULL,63,3,0,'2018-03-16 16:25:01','2018-03-16 16:25:01',4.00,NULL,NULL,1,1),(258,'Acne Clear Plus Foam 85g',8859178713722,'Comedolytic againt impurities\r\nOil control \r\nMoisturizing','Foam',2.50,2.50,NULL,NULL,63,3,0,'2018-03-16 16:31:08','2018-03-16 16:31:08',2.50,NULL,NULL,1,1),(259,'MAHAD Foam 80g',8859178707080,'Honey Vit C Shea Butter','Foam',3.00,3.00,NULL,NULL,63,3,0,'2018-03-16 16:32:52','2018-03-16 16:32:52',3.00,NULL,NULL,1,1),(260,'L  Lady Care 200ml',8859178707578,'pH Balance\r\nRoyal Gelly','Intimate Cleanser',2.50,2.50,NULL,NULL,63,3,0,'2018-03-16 16:36:21','2018-03-16 16:38:02',2.50,NULL,NULL,1,1),(261,'Lady Care 200ml',8859178707387,'Daily use','Intimate Cleanser',2.40,2.40,NULL,NULL,63,3,0,'2018-03-16 16:37:40','2018-03-16 16:37:40',2.40,NULL,NULL,1,1),(262,'Lady Care Cool  200ml',8859178707394,'Daily Use','Intimate Cleanser',2.40,2.40,NULL,NULL,63,3,0,'2018-03-16 16:39:25','2018-03-16 16:39:25',2.40,NULL,NULL,1,1),(263,'Centric Men Perfume 50ml',8859178710035,'perfume','Perfume',6.90,6.90,NULL,NULL,63,3,0,'2018-03-16 16:42:37','2018-03-16 16:42:37',6.90,NULL,NULL,1,1),(264,'Dolipran 500mg tbl',3582910080282,'Paracetamol','Dolipran',0.12,0.85,NULL,NULL,56,17,1,'2018-03-18 18:46:55','2018-03-18 18:46:55',1.70,NULL,NULL,8,16),(265,'Dolipran 200mg sachet',3582910076148,'Paracetamol \r\n11-38Kg body weight','Dolipran',0.20,1.70,NULL,NULL,56,17,1,'2018-03-18 18:53:12','2018-03-18 18:53:12',1.70,NULL,NULL,12,12),(266,'Dolipran 150mg sachet',3582910076124,'Paracetamol\r\n8-30Kg body weight','Dolipran',0.20,1.70,NULL,NULL,56,17,1,'2018-03-18 18:55:01','2018-03-18 18:55:01',1.70,NULL,NULL,12,12),(267,'Dolipran 300mg sachet',3582910076155,'Paracetamol\r\n16-38Kg body weight','Dolipran',0.20,1.71,NULL,NULL,56,17,1,'2018-03-18 18:56:19','2018-03-18 18:56:19',71.00,NULL,NULL,12,12),(268,'Dolipran 100mg Suppo',3480911,'Paracetamol\r\n15-24Kg body weight','Dolipran',0.25,2.50,NULL,NULL,56,17,1,'2018-03-18 18:59:14','2018-03-18 18:59:14',2.50,NULL,NULL,10,10),(269,'Dolipran 200mg Suppo',3480986,'Paracetamol \r\n12-16Kg body weight;','Dolipran',0.25,2.50,NULL,NULL,56,17,1,'2018-03-18 19:07:01','2018-03-18 19:07:01',2.50,NULL,NULL,10,10),(270,'Dolipran 300mg Suppo',3481017,'Paracetamol\r\n15-24Kg body weight','Dolipran',0.25,2.50,NULL,NULL,56,17,1,'2018-03-18 19:10:02','2018-03-18 19:10:02',2.50,NULL,NULL,10,10),(271,'Safi-Cream 10g',1000036,'Triamcinolone & Econazole&\r\nGentamycine','Safi',1.30,1.30,NULL,NULL,64,17,1,'2018-03-18 19:13:22','2018-03-18 19:14:40',1.30,NULL,NULL,1,1),(272,'Posen Cream 10g',1000037,'Betamethason\r\nClotrimazole\r\nGentamycine','Posen',1.20,1.20,NULL,NULL,65,17,1,'2018-03-18 19:18:58','2018-03-18 19:18:58',1.20,NULL,NULL,1,1),(273,'Syringe VN 1cc',1000038,'1cc','Syringe',0.05,0.37,NULL,NULL,66,18,0,'2018-03-19 18:25:59','2018-03-19 18:25:59',3.70,NULL,NULL,10,100),(274,'Syringe VN 3ccs',1000039,'3cc','Syringe',0.05,0.37,NULL,NULL,66,18,0,'2018-03-19 18:27:37','2018-03-19 18:27:37',3.70,NULL,NULL,10,100),(275,'Syringe VN 5cc',1000040,'5cc','Syringe',0.05,0.37,NULL,NULL,66,18,0,'2018-03-19 18:29:20','2018-03-19 18:29:20',3.70,NULL,NULL,10,100),(276,'Syringe VN 10ccs',1000041,'10cc','Syringe',0.07,0.61,NULL,NULL,66,18,0,'2018-03-19 18:32:12','2018-03-19 18:32:12',6.00,NULL,NULL,10,100),(277,'Syringe VN 50/50',1000042,'50/50\r\nfood serving','Syringe',0.40,0.40,NULL,NULL,66,18,0,'2018-03-19 18:34:17','2018-03-19 18:34:17',0.40,NULL,NULL,1,1),(281,'Neo-codion Adult Syrup 180ml',1000043,'Camphosulfonate de codein','Neo-codion',3.10,3.10,NULL,NULL,27,17,1,'2018-03-20 16:41:14','2018-03-20 16:41:14',3.11,NULL,NULL,1,1),(282,'Neo-codion Children Syrup 125mls',1000044,'Camphosulfonate de codein','Neo-codion',2.20,2.20,NULL,NULL,27,17,1,'2018-03-20 16:43:12','2018-03-20 16:43:12',2.20,NULL,NULL,1,1),(283,'Neo-codion Infants Syrup 125mls',1000045,'Camphosulfonate de codein','Neo-codion',2.30,2.30,NULL,NULL,27,17,1,'2018-03-20 16:44:22','2018-03-20 16:44:22',2.30,NULL,NULL,1,1),(284,'Neo-codion tbl',1000046,'Camphosulfonate de codein','Neo-codion',0.17,1.50,NULL,NULL,27,17,1,'2018-03-20 16:46:22','2018-03-20 16:46:22',3.00,NULL,NULL,10,20),(285,'Bisolvon 8mg tbl',1000047,'Bromhexine 8mg','Bisolvon',0.11,1.00,NULL,NULL,19,17,1,'2018-03-20 16:48:29','2018-03-20 16:48:29',2.90,NULL,NULL,10,30),(287,'Ampicillin 500mg cap',1000049,'Ampicillin','Ampicillin',0.11,1.00,NULL,NULL,69,17,1,'2018-03-20 17:04:44','2018-03-20 17:04:44',1.00,NULL,NULL,10,10),(288,'Amoxicilline 500mg cap',1000050,'Amoxicilline','Amoxicilline',0.11,1.00,NULL,NULL,69,17,1,'2018-03-20 17:06:28','2018-03-20 17:06:28',1.00,NULL,NULL,10,10),(289,'Doxycycline 100mg tbl',1000051,'Doxycycline','Doxycycline',0.09,0.60,NULL,NULL,69,17,1,'2018-03-20 17:09:36','2018-03-20 17:09:36',10.60,NULL,NULL,10,10),(290,'Paracetamol 500mg tbl',1000052,'Paracetamol','Paracetamol',0.08,0.40,NULL,NULL,69,17,1,'2018-03-20 17:11:18','2018-03-20 17:11:18',0.40,NULL,NULL,10,10),(291,'Ery 500mg tbl',1000053,'Erythromycin','Ery',0.27,2.40,NULL,NULL,27,17,1,'2018-03-20 17:13:50','2018-03-20 17:13:50',4.80,NULL,NULL,10,20),(292,'Ery 250mg sachet',1000054,'Erythromycin\r\n1-25kg body weight\r\nor 1-8years','Ery',0.16,3.30,NULL,NULL,27,17,1,'2018-03-20 17:16:10','2018-03-20 17:16:10',3.30,NULL,NULL,24,24),(293,'Bepanthene 250mg/ml Inj 2ml I.M.',1000055,'Vit B5','Bepanthene',0.68,3.65,NULL,NULL,42,17,1,'2018-03-20 17:21:28','2018-03-20 17:25:12',3.65,NULL,NULL,6,6),(294,'Biotine 0.5% inj 1ml I.M.',1000056,'Vit H','Biotine',0.68,3.65,NULL,NULL,42,17,1,'2018-03-20 17:24:42','2018-03-20 17:24:42',3.65,NULL,NULL,6,6),(295,'Becozyme inj IM or IV 2ml',1000057,'Vit B1 B2 B5 B & Vit PP','Becozyme',0.61,3.45,NULL,NULL,42,17,1,'2018-03-20 17:29:46','2018-03-20 17:29:46',6.90,NULL,NULL,6,12),(296,'Laroscorbine 1g/5ml inj I.V.',1000058,'Vit C','Laroscorbine',1.02,6.00,NULL,NULL,42,17,1,'2018-03-20 17:32:28','2018-03-20 17:32:28',6.00,NULL,NULL,6,6),(297,'Laroscorbine 1g Effeves',1000059,'Vit C + Zinc','Laroscorbine',0.30,2.60,NULL,NULL,42,17,1,'2018-03-20 17:35:36','2018-03-20 17:35:36',2.60,NULL,NULL,10,10),(298,'Dian 35',1000060,'Cyproteron 2mg+Ethinylestradiol 0.035','Dian',6.00,6.00,NULL,NULL,42,17,1,'2018-03-20 17:37:21','2018-03-20 17:37:21',6.00,NULL,NULL,1,1),(299,'Yasmin',1000061,'Drospirenone 3mg+Ethinylestradiol 0.03mg','Yasmin',10.00,10.00,NULL,NULL,42,17,1,'2018-03-20 17:38:52','2018-03-20 17:38:52',10.00,NULL,NULL,1,1),(301,'Dafalgan Pediatric 3% 100ml',3400935197023,'Paracetamol \r\ncaramel vanilla','Dafalgan',2.50,2.50,NULL,NULL,62,17,1,'2018-03-21 16:19:15','2018-03-21 16:19:15',2.50,NULL,NULL,1,1),(302,'Efferalgan 500mg Efferves',3400932570010,'Paracetamol','Efferalgan',0.15,0.50,NULL,NULL,62,17,1,'2018-03-21 16:21:59','2018-03-21 16:21:59',1.90,NULL,NULL,4,16),(303,'Aspirine UPSA',3400930076811,'Acid acetylsalicylic &\r\nAscorbique acid','Aspirine',0.30,2.60,NULL,NULL,62,17,1,'2018-03-21 16:25:32','2018-03-21 16:25:32',5.20,NULL,NULL,10,20),(304,'Efferalgan 80mg suppo',1000062,'Paracetamol','Efferalgan',0.25,1.10,NULL,NULL,67,17,1,'2018-03-21 16:37:49','2018-03-21 16:37:49',2.00,NULL,NULL,5,10),(305,'Efferalgan 150mg suppo',1000063,'Paracetamol','Efferalgan',0.25,1.10,NULL,NULL,67,17,1,'2018-03-21 16:39:08','2018-03-21 16:39:08',2.00,NULL,NULL,5,10),(306,'Dolipran 500mg/150mg Efferves',1000064,'Paracetamol + Vit C 150mg','Dolipran',0.20,1.30,NULL,NULL,56,17,1,'2018-03-21 16:44:48','2018-03-21 16:44:48',2.60,NULL,NULL,8,16),(307,'Paracetamol Arrow 1g tbl',3400936381575,'Paracetamol 1g','Paracetamol',0.25,0.85,NULL,NULL,71,17,1,'2018-03-21 16:48:12','2018-03-21 16:48:12',1.60,NULL,NULL,4,8),(308,'Sorbitol',1000065,'Delalande 5g\r\nDigestive difficulties\r\nConstipation','Sorbitol',0.15,2.30,NULL,NULL,56,17,1,'2018-03-21 16:51:27','2018-03-21 16:51:27',2.30,NULL,NULL,20,20),(309,'Maalox tbl',1000066,'Aluminium 400mg\r\nMagesium 400mg','Maalox',0.10,0.70,NULL,NULL,56,17,1,'2018-03-21 16:54:22','2018-03-21 16:54:22',2.50,NULL,NULL,12,48),(310,'Polysilane',3400933657598,'Dimetisone 22500g','Polysilane',0.55,5.10,NULL,NULL,62,17,1,'2018-03-21 16:56:40','2018-03-21 16:56:40',5.10,NULL,NULL,12,12),(311,'Phenergan cream 2% 30g',1000067,'Promethazine','Phenergan',3.00,3.00,NULL,NULL,57,17,1,'2018-03-21 16:59:30','2018-03-21 16:59:55',3.00,NULL,NULL,1,1),(312,'Flagyl 250mg tbl',1000068,'Metronidazol','Flagyl',0.08,0.61,NULL,NULL,56,17,1,'2018-03-21 17:02:21','2018-03-21 17:02:21',1.30,NULL,NULL,10,20),(313,'Meliane',1000069,'Gestodene 0.075mg\r\nEthinylestradiol0.02mg','Meliane',4.00,4.00,NULL,NULL,42,17,1,'2018-03-21 17:06:01','2018-03-21 17:06:01',4.00,NULL,NULL,1,1),(314,'Canesten Cream 10g',1000070,'Clotrimazole','Canesten',4.20,4.20,NULL,NULL,42,17,1,'2018-03-21 17:07:37','2018-03-21 17:07:37',4.21,NULL,NULL,1,1),(315,'Canesten 500mg Vaginal',1000071,'Clotrimazole 1-day-Therapy','Canesten',3.50,3.50,NULL,NULL,42,17,1,'2018-03-21 17:09:34','2018-03-21 17:09:34',3.50,NULL,NULL,1,1),(316,'Clomid 50mg tbl',3262338,'Citrate de Clomifene','Clomid',5.40,5.40,NULL,NULL,56,17,1,'2018-03-21 17:18:49','2018-03-21 17:18:49',5.40,NULL,NULL,5,5),(317,'Vitamine D3 B.O.N 200000UI/1ml',1000072,'Cholecalciferol','Vit D3',2.50,2.50,NULL,NULL,27,17,1,'2018-03-21 17:21:51','2018-03-21 17:21:51',2.50,NULL,NULL,1,1),(318,'Zyloric 300mg tbl',1000073,'Allopurinol 28tbl','Zyloric',0.18,2.30,NULL,NULL,74,17,1,'2018-03-22 17:15:50','2018-03-22 17:15:50',4.50,NULL,NULL,14,28),(319,'Zyloric 200mg tbl',1000074,'Allopurinol 28mg','Zyloric',0.15,1.90,NULL,NULL,74,17,1,'2018-03-22 17:17:57','2018-03-22 17:17:57',3.70,NULL,NULL,14,28),(320,'Zyloric 100mg tbl',1000075,'Allopurinol 28tbl','Zyloric',0.13,1.60,NULL,NULL,74,17,1,'2018-03-22 17:19:50','2018-03-22 17:19:50',3.10,NULL,NULL,14,28),(321,'Supradyn Effevers',1000076,'Energizing\r\nMult & Mineral \r\nLemon flavor','Supradyn',0.42,3.70,NULL,NULL,42,17,1,'2018-03-22 17:24:24','2018-03-22 17:24:24',3.70,NULL,NULL,101,10),(322,'Beroca Effevers',1000077,'Performance','Beroca',0.45,4.00,NULL,NULL,42,17,1,'2018-03-22 17:27:06','2018-03-22 17:27:06',41.00,NULL,NULL,10,10),(323,'Feroglobin syrup',5021265231102,'Iron Zinc + Vit B Complex \r\nOrange honey \r\nMineral','Feroglobin',8.00,8.00,NULL,NULL,73,17,1,'2018-03-22 17:29:16','2018-03-22 17:29:16',8.00,NULL,NULL,1,1),(324,'Perfectil',5021265220038,'skin nail and hair','Perfectil',0.60,8.75,NULL,NULL,73,17,1,'2018-03-22 17:31:25','2018-03-22 17:31:25',17.50,NULL,NULL,15,30),(325,'Pregnacare',5021265225026,'16 vits& Mineral\r\nConception pregnancy \r\nBrest feeding','Pregnacare',0.35,5.45,NULL,NULL,73,17,1,'2018-03-22 17:34:15','2018-03-22 17:34:15',10.90,NULL,NULL,15,30),(326,'Pregnacare Plus',5021265221523,'Folic acid400ug& Vit D 10ug\r\nOmega-3300mg DHA\r\nPregnancy & Breast Feeding','Pregnacare',0.69,10.45,NULL,NULL,73,17,1,'2018-03-22 17:40:52','2018-03-22 17:40:52',20.90,NULL,NULL,30,60),(327,'Coversyl 5mg tbl',3594456600305,'Perindopril\r\nComprime secable','Coversyl',8.90,8.90,NULL,NULL,72,17,1,'2018-03-23 15:53:14','2018-03-23 15:53:14',8.90,NULL,NULL,1,1),(328,'Covesyl Plus 5mg/1.25mg tbl',3594454400440,'Perindopril & Indapamide','Coversyl',10.20,10.20,NULL,NULL,72,17,1,'2018-03-23 15:55:31','2018-03-23 15:55:31',10.20,NULL,NULL,1,1),(329,'Coveram 5mg/5mg tbl',5391189200493,'Perindopril & Amlodipine','Coveram',11.00,11.00,NULL,NULL,72,17,1,'2018-03-23 15:58:00','2018-03-23 15:58:00',11.00,NULL,NULL,1,1),(330,'Diamicron MR 30mg',1000078,'Gliclazid','Diamicron',0.15,4.50,NULL,NULL,72,17,1,'2018-03-23 16:01:03','2018-03-23 16:01:03',9.00,NULL,NULL,30,60),(331,'Diamicron MR 60mg tbl',1000079,'Gliclazide','Diamicron',0.28,4.35,NULL,NULL,72,17,1,'2018-03-23 16:03:32','2018-03-23 16:03:32',8.60,NULL,NULL,15,30),(332,'Vastarel MR 35mg tbl',3594455800010,'Trimetazidine','Vastarel',0.15,4.35,NULL,NULL,72,17,1,'2018-03-23 16:07:41','2018-03-23 16:07:41',8.60,NULL,NULL,30,60),(333,'Cimetidine 400mg tbl',3700502100549,'Cimetidine','Cimetidine',0.10,0.85,NULL,NULL,69,17,1,'2018-03-25 15:34:42','2018-03-25 15:34:42',7.50,NULL,NULL,10,100),(338,'Cosamine 500mg cap',9556100105523,'Glucosamine 500mg','Cosamine',0.17,8.54,NULL,NULL,12,17,1,'2018-03-25 15:57:07','2018-03-25 15:57:07',8.54,NULL,NULL,60,60),(339,'Cosamine 250mg cap',9556100101464,'Glucosamine 250mg','Cosamine',0.10,4.85,NULL,NULL,12,17,1,'2018-03-25 15:59:04','2018-03-25 15:59:04',4.85,NULL,NULL,100,100),(340,'Giloba',8850769013238,'Ginkgo Biloba 40mg','Giloba',2.20,6.40,NULL,NULL,75,17,1,'2018-03-25 16:01:17','2018-03-25 16:01:17',6.40,NULL,NULL,10,30),(341,'Fenza tbl',8850769014426,'Pregnancy Multi + DHA & Zinc','Fenza',11.20,11.20,NULL,NULL,75,17,1,'2018-03-25 16:03:30','2018-03-25 16:03:30',11.20,NULL,NULL,30,30),(342,'Vitacap cap',8850769014389,'Vit & Mineral','Vitacap',0.93,0.93,NULL,NULL,75,17,1,'2018-03-25 16:06:22','2018-03-25 16:06:22',4.30,NULL,NULL,1,5),(343,'Calcivita cap',8850769014778,'Cal, Vit A & D','Calcivita',0.70,0.70,NULL,NULL,75,17,1,'2018-03-25 16:08:25','2018-03-25 16:08:25',6.20,NULL,NULL,1,5),(344,'Glow cap',8850769008661,'Skin Care','Glow',3.00,3.00,NULL,NULL,75,17,1,'2018-03-25 16:10:06','2018-03-25 16:10:06',9.50,NULL,NULL,1,3),(345,'Enat 400 cap',8850769010824,'Vit E 400UI','Enat',1.50,1.50,NULL,NULL,75,17,1,'2018-03-25 16:11:32','2018-03-25 16:11:32',4.50,NULL,NULL,1,3),(346,'NNO',8850769009712,'Vit E','NNO',4.40,4.40,NULL,NULL,75,17,1,'2018-03-25 16:15:24','2018-03-25 16:15:24',4.40,NULL,NULL,1,1),(347,'Eugica Fort cap',8850769013801,'For cough, pharingodania, coryza, flu\r\nAsh essential oil\r\nEucalyptol\r\nMenthol\r\nGinger\r\nCajuput','Eugica',0.07,0.45,NULL,NULL,75,17,1,'2018-03-25 16:21:19','2018-03-25 16:21:19',4.30,NULL,NULL,10,100),(348,'Stamlo 5mg tbl',8901148202344,'Amlodipine','Stamlo',0.85,0.85,NULL,NULL,75,17,1,'2018-03-25 16:27:22','2018-03-25 16:27:22',1.60,NULL,NULL,1,2),(349,'Stamlo 10smg tbl',8901148202320,'Amlodipine','Stamlo',1.35,1.35,NULL,NULL,75,17,1,'2018-03-25 16:29:35','2018-03-25 16:29:35',2.70,NULL,NULL,1,2),(350,'Para-Denk 500mg tbl',4031571047442,'Paracetamol','Para-Denk',0.10,0.96,NULL,NULL,38,17,1,'2018-03-25 16:32:42','2018-03-25 16:32:42',1.95,NULL,NULL,10,20),(353,'Gofen 400mg cap',8850769016314,'Ibuprofen','Gofen',0.17,1.60,NULL,NULL,75,17,1,'2018-03-25 16:43:12','2018-03-25 16:43:12',15.80,NULL,NULL,10,50);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saleassistants`
--

DROP TABLE IF EXISTS `saleassistants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saleassistants` (
  `said` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `impid` int(11) DEFAULT NULL,
  PRIMARY KEY (`said`),
  KEY `impid` (`impid`),
  CONSTRAINT `saleassistants_ibfk_1` FOREIGN KEY (`impid`) REFERENCES `importers` (`impid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saleassistants`
--

LOCK TABLES `saleassistants` WRITE;
/*!40000 ALTER TABLE `saleassistants` DISABLE KEYS */;
INSERT INTO `saleassistants` VALUES (18,'Sok Dalin',NULL,NULL,'sokdalin@gmail.com','2017-10-17 07:36:43','2017-10-17 07:36:43',2),(19,'Lao Pisey',NULL,NULL,'laopisey@gmail.com','2017-10-17 07:37:10','2017-10-17 07:37:10',11),(20,'Chan Sophal','PP',NULL,'chansophal@gmail.com','2017-10-21 04:03:33','2017-10-21 04:03:33',13);
/*!40000 ALTER TABLE `saleassistants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saleproducts`
--

DROP TABLE IF EXISTS `saleproducts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saleproducts` (
  `saleid` bigint(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `subtotal` decimal(8,2) DEFAULT NULL,
  `unitquantity` int(11) DEFAULT NULL,
  `packquantity` int(11) DEFAULT NULL,
  `boxquantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salepriceunit` decimal(8,2) DEFAULT NULL,
  `salepricepack` decimal(8,2) DEFAULT NULL,
  `salepricebox` decimal(8,2) DEFAULT NULL,
  `stock` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`saleid`,`pid`),
  KEY `pid` (`pid`),
  CONSTRAINT `saleproducts_ibfk_3` FOREIGN KEY (`saleid`) REFERENCES `sales` (`saleid`) ON DELETE CASCADE,
  CONSTRAINT `saleproducts_ibfk_4` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saleproducts`
--

LOCK TABLES `saleproducts` WRITE;
/*!40000 ALTER TABLE `saleproducts` DISABLE KEYS */;
INSERT INTO `saleproducts` VALUES (9,86,0.35,1,0,0,'2017-11-04 21:15:35','2017-11-04 21:15:35',0.35,0.35,7.20,'2,0,0'),(10,86,0.35,1,0,0,'2017-11-04 21:15:53','2017-11-04 21:15:53',0.35,0.35,7.20,'1,0,0'),(11,86,0.35,1,0,0,'2017-11-04 21:17:54','2017-11-04 21:17:54',0.35,0.35,7.20,'0,0,0'),(12,86,0.35,1,0,0,'2017-11-04 21:22:32','2017-11-04 21:22:32',0.35,0.35,7.20,'3,0,0'),(13,86,0.35,1,0,0,'2017-11-04 21:43:23','2017-11-04 21:43:23',0.35,0.35,7.20,'2,0,0'),(14,86,0.35,1,0,0,'2017-11-04 22:05:16','2017-11-04 22:05:16',0.35,0.35,7.20,'1,0,0'),(15,86,0.35,1,0,0,'2017-11-06 21:27:28','2017-11-06 21:27:28',0.35,0.35,7.20,'0,0,0'),(16,37,9.00,3,0,0,'2018-03-20 21:07:06','2018-03-20 21:07:06',3.00,1.10,10.00,'7,0,0');
/*!40000 ALTER TABLE `saleproducts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `saleid` bigint(20) NOT NULL AUTO_INCREMENT,
  `saledate` datetime DEFAULT CURRENT_TIMESTAMP,
  `cusid` int(11) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `ftotal` decimal(8,2) DEFAULT NULL,
  `recievedd` decimal(8,2) DEFAULT NULL,
  `recievedr` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `exchangerate` decimal(8,2) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`saleid`),
  KEY `cusid` (`cusid`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`cusid`) REFERENCES `customers` (`cusid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (9,'2017-11-05 11:15:35',NULL,0.35,0.00,0.35,1.00,0.00,'2017-11-04 21:15:35','2017-11-04 21:15:35',4100.00,NULL),(10,'2017-11-05 11:15:53',NULL,0.35,0.00,0.35,1.00,0.00,'2017-11-04 21:15:53','2017-11-04 21:15:53',4100.00,NULL),(11,'2017-11-05 11:17:54',NULL,0.35,0.00,0.35,1.00,0.00,'2017-11-04 21:17:54','2017-11-04 21:17:54',4100.00,NULL),(12,'2017-11-05 11:22:32',NULL,0.35,0.00,0.35,1.00,0.00,'2017-11-04 21:22:32','2017-11-04 21:22:32',4100.00,NULL),(13,'2017-11-05 11:43:23',NULL,0.35,0.00,0.35,1.00,0.00,'2017-11-04 21:43:23','2017-11-04 21:43:23',4100.00,NULL),(14,'2017-11-05 12:05:16',NULL,0.35,0.00,0.35,1.00,0.00,'2017-11-04 22:05:16','2017-11-04 22:05:16',4100.00,NULL),(15,'2017-11-07 11:27:28',NULL,0.35,0.00,0.35,1.00,0.00,'2017-11-06 21:27:28','2017-11-06 21:27:28',4100.00,NULL),(16,'2018-03-21 11:07:06',NULL,9.00,0.00,9.00,9.00,0.00,'2018-03-20 21:07:06','2018-03-20 21:07:06',4100.00,NULL);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-28 15:16:53
