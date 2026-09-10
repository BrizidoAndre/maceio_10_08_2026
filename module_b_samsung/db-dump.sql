-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: localhost    Database: module_b_samsung
-- ------------------------------------------------------
-- Server version	8.4.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(50) NOT NULL,
  `base_salary` bigint unsigned NOT NULL,
  `employment_start_date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `photo_path` varchar(255) DEFAULT NULL,
  `deactivated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_code` (`employee_code`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'EMP001','Budi Santoso','budi.santoso@company.com','Engineering',12000000,'2024-01-15','active',NULL,NULL,'2026-08-11 12:09:13','2026-08-11 12:09:13'),(2,'EMP002','Sari Dewi','sari.dewi@company.com','Engineering',18000000,'2023-06-01','active',NULL,NULL,'2026-08-11 12:09:13','2026-08-11 12:09:13'),(3,'EMP003','Anton Wijaya','anton.wijaya@company.com','Operations',8500000,'2024-03-10','active',NULL,NULL,'2026-08-11 12:09:13','2026-08-11 12:09:13'),(4,'EMP004','Rina Kusuma','rina.kusuma@company.com','Operations',9000000,'2023-11-20','active',NULL,NULL,'2026-08-11 12:09:13','2026-08-11 12:09:13'),(5,'EMP005','Hendra Putra','hendra.putra@company.com','Engineering',25000000,'2022-07-01','active',NULL,NULL,'2026-08-11 12:09:13','2026-08-11 12:09:13'),(6,'EMP006','Maya Sari','maya.sari@company.com','Operations',6000000,'2021-03-15','inactive',NULL,'2025-12-31 00:00:00','2026-08-11 12:09:13','2026-08-11 12:09:13');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_requests`
--

DROP TABLE IF EXISTS `leave_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leave_requests` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int unsigned NOT NULL,
  `leave_type_id` int unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text,
  `status` enum('pending','approved','rejected','cancelled') NOT NULL DEFAULT 'pending',
  `effective_days` int unsigned DEFAULT NULL COMMENT 'Computed on approval; NULL until approved',
  `rejection_note` varchar(255) DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`),
  KEY `leave_type_id` (`leave_type_id`),
  CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  CONSTRAINT `leave_requests_ibfk_2` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_requests`
--

LOCK TABLES `leave_requests` WRITE;
/*!40000 ALTER TABLE `leave_requests` DISABLE KEYS */;
INSERT INTO `leave_requests` VALUES (1,1,1,'2026-04-10','2026-04-17','Family vacation','approved',5,NULL,'2026-04-05 09:00:00','2026-08-11 12:09:13','2026-08-11 12:09:13'),(2,2,2,'2026-05-18','2026-05-20','Medical appointment','pending',NULL,NULL,NULL,'2026-08-11 12:09:13','2026-08-11 12:09:13'),(3,3,1,'2026-03-02','2026-03-04','Personal matter','rejected',NULL,NULL,'2026-02-28 14:00:00','2026-08-11 12:09:13','2026-08-11 12:09:13');
/*!40000 ALTER TABLE `leave_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_types`
--

DROP TABLE IF EXISTS `leave_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leave_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `annual_quota_days` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_types`
--

LOCK TABLES `leave_types` WRITE;
/*!40000 ALTER TABLE `leave_types` DISABLE KEYS */;
INSERT INTO `leave_types` VALUES (1,'Annual Leave',12,'2026-08-11 12:09:13','2026-08-11 12:09:13'),(2,'Sick Leave',12,'2026-08-11 12:09:13','2026-08-11 12:09:13');
/*!40000 ALTER TABLE `leave_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payslips`
--

DROP TABLE IF EXISTS `payslips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payslips` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int unsigned NOT NULL,
  `year` smallint unsigned NOT NULL,
  `month` tinyint unsigned NOT NULL,
  `working_days` int unsigned NOT NULL,
  `effective_leave_days` int unsigned NOT NULL DEFAULT '0',
  `gross_salary` bigint unsigned NOT NULL,
  `monthly_tax` bigint unsigned NOT NULL,
  `net_salary` bigint unsigned NOT NULL,
  `generated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_employee_month` (`employee_id`,`year`,`month`),
  CONSTRAINT `payslips_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payslips`
--

LOCK TABLES `payslips` WRITE;
/*!40000 ALTER TABLE `payslips` DISABLE KEYS */;
INSERT INTO `payslips` VALUES (1,1,2026,4,20,5,12000000,1300000,10700000,'2026-05-01 09:00:00','2026-08-11 12:09:13','2026-08-11 12:09:13'),(2,2,2026,4,20,0,18000000,2200000,15800000,'2026-05-01 09:00:00','2026-08-11 12:09:13','2026-08-11 12:09:13'),(3,3,2026,4,20,0,8500000,775000,7725000,'2026-05-01 09:00:00','2026-08-11 12:09:13','2026-08-11 12:09:13'),(4,4,2026,4,20,0,9000000,850000,8150000,'2026-05-01 09:00:00','2026-08-11 12:09:13','2026-08-11 12:09:13'),(5,5,2026,4,20,0,25000000,3666667,21333333,'2026-05-01 09:00:00','2026-08-11 12:09:13','2026-08-11 12:09:13');
/*!40000 ALTER TABLE `payslips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `public_holidays`
--

DROP TABLE IF EXISTS `public_holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `public_holidays` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `public_holidays`
--

LOCK TABLES `public_holidays` WRITE;
/*!40000 ALTER TABLE `public_holidays` DISABLE KEYS */;
INSERT INTO `public_holidays` VALUES (1,'New Year\'s Day','2026-01-01','New Year celebration','2026-08-11 12:09:13','2026-08-11 12:09:13'),(2,'Lunar New Year','2026-02-10','Lunar New Year celebration','2026-08-11 12:09:13','2026-08-11 12:09:13'),(3,'Good Friday','2026-04-03','Christian Good Friday - weekday','2026-08-11 12:09:13','2026-08-11 12:09:13'),(4,'Eid al-Fitr Holiday','2026-04-14','Eid al-Fitr public holiday - weekday','2026-08-11 12:09:13','2026-08-11 12:09:13'),(5,'Labor Day','2026-05-01','International Labor Day - weekday','2026-08-11 12:09:13','2026-08-11 12:09:13'),(6,'Ascension Day','2026-05-14','Ascension of Jesus Christ - weekday','2026-08-11 12:09:13','2026-08-11 12:09:13'),(7,'Pancasila Day','2026-06-01','National Pancasila Day','2026-08-11 12:09:13','2026-08-11 12:09:13'),(8,'Christmas Day','2026-12-25','Christmas celebration','2026-08-11 12:09:13','2026-08-11 12:09:13');
/*!40000 ALTER TABLE `public_holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_brackets`
--

DROP TABLE IF EXISTS `tax_brackets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tax_brackets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `lower_bound` bigint unsigned NOT NULL,
  `upper_bound` bigint unsigned DEFAULT NULL COMMENT 'NULL means no upper limit (last bracket)',
  `rate_percent` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_brackets`
--

LOCK TABLES `tax_brackets` WRITE;
/*!40000 ALTER TABLE `tax_brackets` DISABLE KEYS */;
INSERT INTO `tax_brackets` VALUES (1,0,60000000,5.00,'2026-08-11 12:09:13','2026-08-11 12:09:13'),(2,60000000,250000000,15.00,'2026-08-11 12:09:13','2026-08-11 12:09:13'),(3,250000000,500000000,25.00,'2026-08-11 12:09:13','2026-08-11 12:09:13'),(4,500000000,NULL,30.00,'2026-08-11 12:09:13','2026-08-11 12:09:13');
/*!40000 ALTER TABLE `tax_brackets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-11  9:18:50
