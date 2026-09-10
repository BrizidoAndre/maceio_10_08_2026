-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: localhost    Database: module_f
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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `email`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `password`   varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK
TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins`
VALUES (2, 'admin@mail.com', '$2y$12$I0iZtEGP98A1avYBLIMQV.5k4.HVHUaIbbGZka0VZ1GjL6WRRJ9Vi', '2026-08-13 18:58:23',
        '2026-08-13 18:58:23');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries`
(
    `id`          int DEFAULT NULL,
    `city`        text,
    `country`     text,
    `description` text,
    `continent`   text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK
TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries`
VALUES (1, 'Rio de Janeiro', 'Brazil',
        'A vibrant coastal city famous for its beaches, mountains, Carnival, and the iconic Christ the Redeemer statue.',
        'South America'),
       (2, 'Sao Paulo', 'Brazil', 'Brazil\'s largest city and a major cultural, financial, and gastronomic center filled
        with museums, restaurants, and nightlife.',' South America '),(3,' Buenos Aires ',' Argentina ',' The elegant
        capital of Argentina, known for tango, European - style architecture, vibrant neighborhoods, and exceptional
        cuisine.',' South America '),(4,' Mendoza ',' Argentina ',' A beautiful city at the foot of the Andes,
        famous for its vineyards, Malbec wines, and spectacular mountain landscapes.',' South America '),(5,' Santiago
        ',' Chile ',' Chile\'s modern capital surrounded by the Andes, offering a mix of urban attractions, culture, cuisine, and nearby ski resorts.',
        'South America'),
       (6, 'Valparaiso', 'Chile',
        'A colorful Pacific port city famous for its steep hills, street art, historic funiculars, and distinctive architecture.',
        'South America'),
       (7, 'Lima', 'Peru',
        'The coastal capital of Peru, renowned for its colonial architecture, Pacific Ocean views, and one of South America\'s best food scenes.','South America'),(8,'Cusco','Peru','A historic Andean city and former capital of the Inca Empire,
        serving as the gateway to Machu Picchu.','South America'),(9,'La Paz','Bolivia','A dramatic high-altitude city set among the Andes,
        known for its cable cars, markets, and spectacular mountain scenery.',' South America '),(10,' Sucre ',' Bolivia
        ',' A charming colonial city with whitewashed buildings, historic churches, and a relaxed atmosphere surrounded
        by Andean landscapes.',' South America '),(11,' Quito ',' Ecuador ',' Ecuador\'s high-altitude capital, surrounded by volcanoes and famous for its beautifully preserved historic center.',
        'South America'),
       (12, 'Guayaquil', 'Ecuador', 'Ecuador\'s largest port city, known for its waterfront promenade, tropical climate,
        parks, and lively urban culture.',' South America '),(13,' Bogota ',' Colombia ',' Colombia\'s high-altitude capital, combining historic neighborhoods, world-class museums, vibrant street art, and a thriving culinary scene.',
        'South America'),
       (14, 'Medellin', 'Colombia',
        'A green and innovative city surrounded by mountains, famous for its pleasant climate, cable cars, parks, and transformation.',
        'South America'),
       (15, 'Cartagena', 'Colombia',
        'A beautiful Caribbean city famous for its colorful colonial buildings, historic walls, tropical beaches, and lively atmosphere.',
        'South America'),
       (16, 'Montevideo', 'Uruguay', 'Uruguay\'s relaxed coastal capital, known for its waterfront promenade,
        historic districts, beaches, and laid - back culture.',' South America '),(17,' Punta del Este ',' Uruguay ',' A
        glamorous seaside resort known for beautiful beaches, modern architecture, nightlife, and luxury hotels.','
        South America '),(18,' Asuncion ',' Paraguay ',' Paraguay\'s riverside capital, offering historic landmarks, local markets, parks, and a growing contemporary cultural scene.',
        'South America'),
       (19, 'Georgetown', 'Guyana',
        'A tropical Caribbean-influenced capital known for wooden colonial architecture, colorful markets, and diverse cultural traditions.',
        'South America'),
       (20, 'Cayenne', 'French Guiana',
        'A small multicultural capital on the Atlantic coast, blending French and Creole influences with tropical landscapes.',
        'South America'),
       (21, 'Manaus', 'Brazil',
        'A gateway to the Amazon rainforest, famous for the Meeting of the Waters, the Amazon Theatre, and incredible biodiversity.',
        'South America'),
       (22, 'Florianopolis', 'Brazil',
        'A scenic island city famous for its beaches, lagoons, surf culture, hiking trails, and relaxed coastal lifestyle.',
        'South America'),
       (23, 'Salvador', 'Brazil',
        'A colorful historic city known for Afro-Brazilian culture, colonial architecture, music, festivals, and beautiful Atlantic beaches.',
        'South America'),
       (24, 'San Pedro de Atacama', 'Chile',
        'A desert town surrounded by otherworldly landscapes, salt flats, volcanoes, lagoons, and some of the clearest skies on Earth.',
        'South America'),
       (25, 'Arequipa', 'Peru',
        'A historic Peruvian city surrounded by volcanoes, famous for its white volcanic-stone architecture and nearby Colca Canyon.',
        'South America'),
       (26, 'New York City', 'United States', 'One of the world\'s most iconic cities, known for Times Square,
        Central Park, Broadway, museums, skyscrapers, and diverse neighborhoods.',' North America '),(27,' Los Angeles
        ',' United States ',' A sprawling Southern California city famous for Hollywood, beaches, entertainment,
        diverse cuisine, and sunny weather.',' North America '),(28,' San Francisco ',' United States ',' A picturesque
        city known for the Golden Gate Bridge, steep streets, cable cars, and distinctive neighborhoods.',' North
        America '),(29,' Las Vegas ',' United States ',' A spectacular desert destination famous for its entertainment,
        resorts, nightlife, shows, and extravagant architecture.',' North America '),(30,' Miami ',' United States ',' A
        vibrant tropical city known for its beaches, Art Deco architecture, nightlife, Latin American culture, and warm
        climate.',' North America '),(31,' Chicago ',' United States ',' A major city on Lake Michigan celebrated for
        its architecture, museums, parks, music, and deep - dish pizza.',' North America '),(32,' Boston ',' United
        States ',' A historic New England city known for its universities, colonial heritage, waterfront, museums, and
        walkable neighborhoods.',' North America '),(33,' New Orleans ',' United States ',' A culturally rich city
        famous for jazz, Creole cuisine, historic architecture, festivals, and the lively French Quarter.',' North
        America '),(34,' Washington DC ',' United States ',' The capital of the United States,
        home to iconic monuments, national museums, historic landmarks, and government institutions.',' North America
        '),(35,' Honolulu ',' United States ',' The tropical capital of Hawaii, offering beautiful beaches,
        volcanic landscapes, surfing, and a unique Polynesian culture.',' North America '),(36,' Toronto ',' Canada ','
        Canada\'s largest city, known for its multicultural neighborhoods, waterfront, museums, entertainment, and iconic CN Tower.',
        'North America'),
       (37, 'Vancouver', 'Canada',
        'A scenic coastal city surrounded by mountains, offering outdoor adventures, diverse cuisine, parks, and beautiful waterfront views.',
        'North America'),
       (38, 'Montreal', 'Canada',
        'A vibrant French-speaking city known for its historic architecture, festivals, arts, cuisine, and distinctive European atmosphere.',
        'North America'),
       (39, 'Quebec City', 'Canada',
        'A charming historic city famous for its fortified old town, French heritage, stone buildings, and picturesque streets.',
        'North America'),
       (40, 'Calgary', 'Canada',
        'A modern western Canadian city near the Rocky Mountains, known for outdoor activities, rodeos, and easy access to national parks.',
        'North America'),
       (41, 'Cancun', 'Mexico',
        'A popular Caribbean destination famous for white-sand beaches, turquoise waters, resorts, and access to ancient Mayan sites.',
        'North America'),
       (42, 'Mexico City', 'Mexico', 'Mexico\'s enormous capital, filled with historic landmarks, museums,
        vibrant neighborhoods, traditional cuisine, and contemporary culture.',' North America '),(43,' Guadalajara ','
        Mexico ',' A lively Mexican city known as a center of mariachi music and tequila culture, with beautiful plazas
        and colonial architecture.',' North America '),(44,' Puerto Vallarta ',' Mexico ',' A scenic Pacific coast
        destination combining beaches, mountains, traditional Mexican architecture, restaurants, and vibrant nightlife.
        ',' North America '),(45,' Oaxaca ',' Mexico ',' A culturally rich city known for indigenous traditions,
        colorful markets, colonial architecture, art, and exceptional regional cuisine.',' North America '),(46,' Havana
        ',' Cuba ',' Cuba\'s historic capital, famous for colorful colonial buildings, vintage cars, lively music, and the atmosphere of Old Havana.',
        'North America'),
       (47, 'Kingston', 'Jamaica', 'Jamaica\'s capital and cultural heart, known for reggae music, Caribbean cuisine,
        museums, and mountain views.',' North America '),(48,' Santo Domingo ',' Dominican Republic ',' The oldest
        European - founded city in the Americas, featuring a historic colonial zone, Caribbean culture, and beautiful
        waterfront areas.',' North America '),(49,' San Juan ',' Puerto Rico ',' A colorful Caribbean capital known for
        its historic forts, cobblestone streets, beaches, music, and vibrant Spanish heritage.',' North America '),(50,'
        Guatemala City ',' Guatemala ',' Guatemala\'s modern capital, offering museums, historic districts, local markets, and access to volcanoes and Mayan cultural sites.',
        'North America');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `customer_purchase`
--

DROP TABLE IF EXISTS `customer_purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_purchase`
(
    `id`           bigint unsigned NOT NULL AUTO_INCREMENT,
    `purchase_id`  bigint unsigned NOT NULL,
    `customers_id` bigint unsigned NOT NULL,
    `isDependent`  tinyint(1) NOT NULL DEFAULT '1',
    `created_at`   timestamp NULL DEFAULT NULL,
    `updated_at`   timestamp NULL DEFAULT NULL,
    `deleted_at`   timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_purchase`
--

LOCK
TABLES `customer_purchase` WRITE;
/*!40000 ALTER TABLE `customer_purchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_purchase` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers`
(
    `id`              bigint unsigned NOT NULL AUTO_INCREMENT,
    `name`            varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`           varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `password`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `birthday`        date                                    NOT NULL,
    `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `status`          enum('default','buyer','loyal customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
    `customer_id`     bigint unsigned DEFAULT NULL,
    `created_at`      timestamp NULL DEFAULT NULL,
    `updated_at`      timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK
TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers`
VALUES (1, 'username', 'mail@mail.com', '$2y$12$23dVyU1cn1nT3kNu2R3RbestJZNT2ToIwz3Asm5KWwSdBlYXiIrU.', '2026-07-28',
        'customers/phproWb6D', 'default', 2, '2026-08-13 18:46:55', '2026-08-13 18:51:46'),
       (2, 'username', 'mail2@mail.com', '$2y$12$xUIyafna8ufXvOn8bJ7WbuhpjylWw0ZGusaT.UnxEoJ.JeLFNmdp.', '2026-08-06',
        'customers/phpUTgFmp', 'default', NULL, '2026-08-13 18:51:46', '2026-08-13 18:51:46');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `discounts`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `package_id` bigint unsigned NOT NULL,
    `min_people` int  DEFAULT NULL,
    `discount`   int NOT NULL,
    `start_date` date DEFAULT NULL,
    `end_date`   date DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK
TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts`
VALUES (1, 2, NULL, 15, '2026-08-13', '2026-08-17', '2026-08-13 20:22:36', '2026-08-13 20:22:36'),
       (2, 2, NULL, 15, '2026-08-13', '2026-08-17', '2026-08-13 20:22:47', '2026-08-13 20:22:47'),
       (3, 3, 5, 15, NULL, NULL, '2026-08-13 20:25:34', '2026-08-13 20:25:34'),
       (4, 3, 5, 15, NULL, NULL, '2026-08-13 20:25:37', '2026-08-13 20:25:37'),
       (5, 2, NULL, 20, '2026-08-28', '2026-08-31', '2026-08-13 20:26:31', '2026-08-13 20:26:31'),
       (6, 2, NULL, 19, '2026-08-13', '2026-08-15', '2026-08-13 20:26:46', '2026-08-13 20:26:46');
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `local_id`   bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `filepath`   varchar(522) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK
TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images`
VALUES (1, 2, '2026-08-13 19:37:22', '2026-08-13 19:37:22', 'countries/phpUpYhjt'),
       (2, 2, '2026-08-13 19:37:22', '2026-08-13 19:37:22', 'countries/phpUt7l89'),
       (3, 2, '2026-08-13 19:37:22', '2026-08-13 19:37:22', 'countries/phpSNabNn'),
       (4, 5, '2026-08-13 19:42:20', '2026-08-13 19:42:20', 'countries/php1RSLOH'),
       (5, 5, '2026-08-13 19:42:20', '2026-08-13 19:42:20', 'countries/phpUDq6Vt'),
       (6, 3, '2026-08-13 19:42:53', '2026-08-13 19:42:53', 'countries/phpHIILr5');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `local_package`
--

DROP TABLE IF EXISTS `local_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `local_package`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `package_id` bigint unsigned NOT NULL,
    `local_id`   bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `local_package`
--

LOCK
TABLES `local_package` WRITE;
/*!40000 ALTER TABLE `local_package` DISABLE KEYS */;
INSERT INTO `local_package`
VALUES (1, 1, 2, '2026-08-13 19:57:45', '2026-08-13 19:57:45'),
       (2, 1, 3, '2026-08-13 19:57:45', '2026-08-13 19:57:45'),
       (3, 1, 5, '2026-08-13 19:57:45', '2026-08-13 19:57:45');
/*!40000 ALTER TABLE `local_package` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `locals`
--

DROP TABLE IF EXISTS `locals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locals`
(
    `id`          bigint unsigned NOT NULL AUTO_INCREMENT,
    `city`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `country_id`  bigint unsigned NOT NULL,
    `description` text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locals`
--

LOCK
TABLES `locals` WRITE;
/*!40000 ALTER TABLE `locals` DISABLE KEYS */;
INSERT INTO `locals`
VALUES (2, 'São Paulo', 1, 'Descrição', '2026-08-13 19:37:22', '2026-08-13 19:37:22'),
       (3, 'São José (update)', 1, 'Descrição (update)', '2026-08-13 19:37:22', '2026-08-13 19:42:59'),
       (5, 'São José', 3, 'Descrição', '2026-08-13 19:42:20', '2026-08-13 19:42:20');
/*!40000 ALTER TABLE `locals` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations`
(
    `id`        int unsigned NOT NULL AUTO_INCREMENT,
    `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch`     int                                     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK
TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations`
VALUES (1, '2026_08_13_180006_create_customers_table', 1),
       (2, '2026_08_13_180056_create_admins_table', 1),
       (3, '2026_08_13_180123_create_sales_people_table', 1),
       (4, '2026_08_13_180159_create_partners_table', 1),
       (5, '2026_08_13_181039_create_countries_table', 2),
       (6, '2026_08_13_181144_create_locals_table', 2),
       (7, '2026_08_13_181244_create_images_table', 2),
       (8, '2026_08_13_181349_create_packages_table', 2),
       (9, '2026_08_13_181410_create_local_package_table', 2),
       (10, '2026_08_13_181534_create_discounts_table', 2),
       (11, '2026_08_13_181641_create_promotions_table', 2),
       (12, '2026_08_13_181801_create_purchases_table', 2),
       (13, '2026_08_13_181828_create_customer_purchase_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `packages`
(
    `id`             bigint unsigned NOT NULL AUTO_INCREMENT,
    `name`           varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description`    text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `price` double NOT NULL,
    `start_date`     date                                    NOT NULL,
    `end_date`       date                                    NOT NULL,
    `minimum_people` int                                     NOT NULL,
    `partner_id`     bigint unsigned NOT NULL,
    `maximum_people` int                                     NOT NULL,
    `created_at`     timestamp NULL DEFAULT NULL,
    `updated_at`     timestamp NULL DEFAULT NULL,
    `deleted_at`     timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK
TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages`
VALUES (2, 'Basic', 'Basic', 10, '2026-08-13', '2026-08-20', 1, 1, 5, '2026-08-13 17:12:05', '2026-08-13 17:12:08',
        NULL),
       (3, 'Premium', 'Premium', 50, '2026-08-13', '2026-08-20', 2, 1, 10, '2026-08-13 17:12:05', '2026-08-13 17:12:08',
        NULL),
       (4, 'Vip', 'Vip', 100, '2026-08-13', '2026-08-20', 1, 1, 5, '2026-08-13 17:12:05', '2026-08-13 17:12:09', NULL);
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners`
(
    `id`           bigint unsigned NOT NULL AUTO_INCREMENT,
    `legal_name`   varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `website`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `password`     varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at`   timestamp NULL DEFAULT NULL,
    `updated_at`   timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK
TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners`
VALUES (1, 'legal name', 'website', '$2y$12$Qr9gc9RQ.cz/hKSPcLQNxObs.S8d29YBsimWj76CUs4hQOFX/7Wdm', 'partner@mail.com',
        '1203912312', '2026-08-13 19:11:21', '2026-08-13 19:11:21');
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotions`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `title`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `package_id` bigint unsigned NOT NULL,
    `discount`   int                                     NOT NULL,
    `start_time` date                                    NOT NULL,
    `end_time`   date                                    NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotions`
--

LOCK
TABLES `promotions` WRITE;
/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchases`
(
    `id`           bigint unsigned NOT NULL AUTO_INCREMENT,
    `package_id`   bigint unsigned NOT NULL,
    `start_date`   date NOT NULL,
    `end_date`     date NOT NULL,
    `calculated_price` double NOT NULL,
    `discount_id`  bigint unsigned DEFAULT NULL,
    `promotion_id` bigint unsigned DEFAULT NULL,
    `created_at`   timestamp NULL DEFAULT NULL,
    `updated_at`   timestamp NULL DEFAULT NULL,
    `deleted_at`   timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK
TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `sales_people`
--

DROP TABLE IF EXISTS `sales_people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales_people`
(
    `id`              bigint unsigned NOT NULL AUTO_INCREMENT,
    `name`            varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`           varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at`      timestamp NULL DEFAULT NULL,
    `updated_at`      timestamp NULL DEFAULT NULL,
    `password`        varchar(522) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_people`
--

LOCK
TABLES `sales_people` WRITE;
/*!40000 ALTER TABLE `sales_people` DISABLE KEYS */;
INSERT INTO `sales_people`
VALUES (1, 'salesperson', 'sales@mail.com', 'salesperson/phpzoNBZY', '2026-08-13 19:18:53', '2026-08-13 19:18:53',
        '$2y$12$1YMR7gsrNjQ.r7gaX2tbduZgJKacHmMnmc5j22LMcWcs79huQTBhy');
/*!40000 ALTER TABLE `sales_people` ENABLE KEYS */;
UNLOCK
TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-13 17:38:09
