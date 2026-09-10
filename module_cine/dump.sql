-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: localhost    Database: cinema_system
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
-- Table structure for table `cashback`
--

DROP TABLE IF EXISTS `cashback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cashback`
(
    `id`          int  NOT NULL AUTO_INCREMENT,
    `customer_id` int  NOT NULL,
    `purchase_id` int  NOT NULL,
    `amount`      int  NOT NULL,
    `expires_at`  date NOT NULL,
    PRIMARY KEY (`id`),
    KEY           `customer_id` (`customer_id`),
    KEY           `purchase_id` (`purchase_id`),
    CONSTRAINT `cashback_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
    CONSTRAINT `cashback_ibfk_2` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cashback`
--

LOCK
TABLES `cashback` WRITE;
/*!40000 ALTER TABLE `cashback` DISABLE KEYS */;
INSERT INTO `cashback`
VALUES (1, 2, 40, 300, '2026-09-12');
/*!40000 ALTER TABLE `cashback` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `combos`
--

DROP TABLE IF EXISTS `combos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `combos`
(
    `id`          int                                     NOT NULL AUTO_INCREMENT,
    `name`        varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description` text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `price`       int                                     NOT NULL,
    `image`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `combos`
--

LOCK
TABLES `combos` WRITE;
/*!40000 ALTER TABLE `combos` DISABLE KEYS */;
INSERT INTO `combos`
VALUES (1, 'Classic Popcorn', 'Freshly prepared large popcorn.', 1800, 'combos/popcorn.jpeg'),
       (2, 'Popcorn + Soda', 'Large popcorn with a chilled soda.', 3000, 'combos/popcorn_soda.jpeg'),
       (3, 'Nachos + Soda', 'Nachos with cheese sauce and a soda.', 3500, 'combos/nachos_soda.png'),
       (4, 'Family Combo', 'Large popcorn, two sodas and nachos.', 6500, 'combos/family.jpeg'),
       (5, 'Premium Combo', 'Large popcorn, two sodas and premium snacks.', 8000, 'combos/premium.png'),
       (6, 'Movie Duo', 'Two medium popcorns and two sodas.', 5500, 'combos/duo.png');
/*!40000 ALTER TABLE `combos` ENABLE KEYS */;
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
    `id`       int                                     NOT NULL AUTO_INCREMENT,
    `name`     varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`    varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token`    varchar(522) COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    `balance`  int                                     NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK
TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers`
VALUES (1, 'Test Customer', 'customer@example.com', '$2y$10$example-placeholder-hash', NULL, 0),
       (2, 'John Doe', 'john@example.com', '$2y$12$H9njqON/AH0018Sd45zMJuh7iy4CRPC0dD0/SmyatVuGIMNUZx34C',
        'LGFxFyDLJSWqknMLvBIIiiu4gfThm8dPM49NNEWFOLLcedF2XAOF', 0),
       (3, 'John Doe', 'john2@example.com', '$2y$12$WZblwss6NEqic95j1CRDkugBG1qdZP0sDzjw8FMJwq9fJZj4JMqPC', NULL, 0);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movies`
(
    `id`           int                                     NOT NULL AUTO_INCREMENT,
    `title`        varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description`  text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `image`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `release_date` date                                    NOT NULL,
    `in_theaters`  tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies`
--

LOCK
TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies`
VALUES (1, 'Echoes of Tomorrow', 'A science-fiction drama about memory and time.', 'movies/movie_01.png', '2026-08-01',
        1),
       (2, 'The Last Harbor', 'A mystery unfolds in a forgotten coastal town.', 'movies/movie_02.png', '2026-08-02', 1),
       (3, 'Beyond the Red Moon', 'An expedition discovers something impossible.', 'movies/movie_03.png', '2026-08-03',
        1),
       (4, 'Midnight Protocol', 'A cybersecurity analyst races against an unknown threat.', 'movies/movie_04.png',
        '2026-08-04', 1),
       (5, 'Paper Kingdom', 'A family story about ambition, loss and reconciliation.', 'movies/movie_05.png',
        '2026-08-05', 1),
       (6, 'Parallel Skies', 'Two strangers discover their lives are unexpectedly connected.', 'movies/movie_06.png',
        '2026-08-06', 1),
       (7, 'After the Storm', 'A community rebuilds after a devastating storm.', 'movies/movie_07.png', '2026-08-07',
        0),
       (8, 'The Silent Signal', 'A remote observatory receives a message from the dark.', 'movies/movie_08.png',
        '2026-08-08', 1);
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `purchase_combos`
--

DROP TABLE IF EXISTS `purchase_combos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_combos`
(
    `id`          int NOT NULL AUTO_INCREMENT,
    `purchase_id` int NOT NULL,
    `combo_id`    int NOT NULL,
    `quantity`    int NOT NULL,
    PRIMARY KEY (`id`),
    KEY           `purchase_id` (`purchase_id`),
    KEY           `combo_id` (`combo_id`),
    CONSTRAINT `purchase_combos_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`),
    CONSTRAINT `purchase_combos_ibfk_2` FOREIGN KEY (`combo_id`) REFERENCES `combos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_combos`
--

LOCK
TABLES `purchase_combos` WRITE;
/*!40000 ALTER TABLE `purchase_combos` DISABLE KEYS */;
INSERT INTO `purchase_combos`
VALUES (1, 11, 1, 2),
       (2, 12, 1, 2),
       (3, 13, 1, 2),
       (4, 13, 2, 1),
       (5, 14, 1, 2),
       (6, 14, 2, 1),
       (7, 15, 1, 2),
       (8, 15, 2, 1),
       (9, 16, 1, 2),
       (10, 16, 2, 1),
       (11, 17, 1, 2),
       (12, 17, 2, 1),
       (13, 18, 1, 2),
       (14, 18, 2, 1),
       (15, 19, 1, 2),
       (16, 19, 2, 1),
       (17, 20, 1, 2),
       (18, 20, 2, 1),
       (19, 21, 1, 2),
       (20, 21, 2, 1),
       (21, 22, 1, 2),
       (22, 22, 2, 1),
       (33, 28, 1, 2),
       (34, 28, 2, 1),
       (35, 29, 1, 2),
       (36, 29, 2, 1),
       (37, 30, 1, 2),
       (38, 30, 2, 1),
       (39, 31, 1, 2),
       (40, 31, 2, 1),
       (41, 32, 1, 2),
       (42, 32, 2, 1),
       (43, 33, 1, 2),
       (44, 33, 2, 1),
       (45, 34, 1, 2),
       (46, 34, 2, 1),
       (47, 35, 1, 2),
       (48, 35, 2, 1),
       (49, 36, 1, 2),
       (50, 36, 2, 1),
       (51, 37, 1, 2),
       (52, 37, 2, 1),
       (53, 38, 1, 2),
       (54, 38, 2, 1),
       (55, 39, 1, 2),
       (56, 39, 2, 1),
       (57, 40, 1, 2),
       (58, 40, 2, 1);
/*!40000 ALTER TABLE `purchase_combos` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `purchase_seats`
--

DROP TABLE IF EXISTS `purchase_seats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_seats`
(
    `id`          int NOT NULL AUTO_INCREMENT,
    `purchase_id` int NOT NULL,
    `seat_id`     int NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `seat_id` (`seat_id`),
    KEY           `purchase_id` (`purchase_id`),
    CONSTRAINT `purchase_seats_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`),
    CONSTRAINT `purchase_seats_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_seats`
--

LOCK
TABLES `purchase_seats` WRITE;
/*!40000 ALTER TABLE `purchase_seats` DISABLE KEYS */;
INSERT INTO `purchase_seats`
VALUES (13, 1, 1),
       (14, 1, 10),
       (15, 1, 2),
       (16, 1, 3),
       (17, 1, 4),
       (18, 1, 5),
       (19, 1, 6),
       (20, 1, 7),
       (21, 1, 8),
       (23, 4, 81),
       (24, 4, 82),
       (25, 5, 89),
       (26, 5, 90),
       (27, 6, 97),
       (28, 6, 98),
       (37, 11, 105),
       (38, 11, 106),
       (39, 12, 113),
       (40, 12, 114),
       (41, 13, 121),
       (42, 13, 122),
       (43, 30, 83),
       (44, 30, 84),
       (45, 31, 85),
       (46, 32, 86),
       (47, 33, 91),
       (48, 34, 92),
       (49, 35, 93),
       (50, 36, 99),
       (51, 37, 100),
       (52, 38, 107),
       (53, 39, 108),
       (54, 40, 115);
/*!40000 ALTER TABLE `purchase_seats` ENABLE KEYS */;
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
    `id`              int                                    NOT NULL AUTO_INCREMENT,
    `customer_id`     int                                    NOT NULL,
    `session_id`      int                                    NOT NULL,
    `subtotal`        int                                    NOT NULL,
    `total`           int                                    NOT NULL,
    `wallet_amount`   int                                    NOT NULL DEFAULT '0',
    `card_amount`     int                                    NOT NULL DEFAULT '0',
    `cashback_amount` int                                    NOT NULL DEFAULT '0',
    `status`          varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
    `purchased_at`    datetime                               NOT NULL DEFAULT (now()),
    PRIMARY KEY (`id`),
    KEY               `customer_id` (`customer_id`),
    KEY               `session_id` (`session_id`),
    CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
    CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK
TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases`
VALUES (1, 1, 1, 20, 20, 20, 20, 20, 'okay', '2026-08-12 10:20:35'),
       (2, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:05:53'),
       (3, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:09:06'),
       (4, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:10:48'),
       (5, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:11:25'),
       (6, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:12:40'),
       (11, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:14:57'),
       (12, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:15:16'),
       (13, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:16:07'),
       (14, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:16:48'),
       (15, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:17:00'),
       (16, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:17:52'),
       (17, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:18:41'),
       (18, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:18:53'),
       (19, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:19:01'),
       (20, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:19:01'),
       (21, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:19:02'),
       (22, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:19:38'),
       (28, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:21:04'),
       (29, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:21:11'),
       (30, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:22:15'),
       (31, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:22:33'),
       (32, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:22:44'),
       (33, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:23:00'),
       (34, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:23:17'),
       (35, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:23:54'),
       (36, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:24:07'),
       (37, 2, 2, 3000, 3000, 3000, 0, 3000, '200', '2026-08-12 14:24:28'),
       (38, 2, 2, 3000, 3000, 3000, 0, 300, 'paid', '2026-08-12 14:28:51'),
       (39, 2, 2, 3000, 3000, 3000, 3000, 300, 'paid', '2026-08-12 14:29:10'),
       (40, 2, 2, 3000, 3000, 3000, 3000, 300, 'paid', '2026-08-12 14:31:25');
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms`
(
    `id`   int                                     NOT NULL AUTO_INCREMENT,
    `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
    `type` enum('normal','vip') COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK
TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms`
VALUES (1, 'Room 01', 'normal'),
       (2, 'Room 02', 'vip'),
       (3, 'Room 03', 'normal');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `seats`
--

DROP TABLE IF EXISTS `seats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seats`
(
    `id`        int                                    NOT NULL AUTO_INCREMENT,
    `room_id`   int                                    NOT NULL,
    `seat_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `room_id` (`room_id`,`seat_code`),
    CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seats`
--

LOCK
TABLES `seats` WRITE;
/*!40000 ALTER TABLE `seats` DISABLE KEYS */;
INSERT INTO `seats`
VALUES (1, 1, 'A1'),
       (10, 1, 'A10'),
       (2, 1, 'A2'),
       (3, 1, 'A3'),
       (4, 1, 'A4'),
       (5, 1, 'A5'),
       (6, 1, 'A6'),
       (7, 1, 'A7'),
       (8, 1, 'A8'),
       (9, 1, 'A9'),
       (11, 1, 'B1'),
       (20, 1, 'B10'),
       (12, 1, 'B2'),
       (13, 1, 'B3'),
       (14, 1, 'B4'),
       (15, 1, 'B5'),
       (16, 1, 'B6'),
       (17, 1, 'B7'),
       (18, 1, 'B8'),
       (19, 1, 'B9'),
       (21, 1, 'C1'),
       (30, 1, 'C10'),
       (22, 1, 'C2'),
       (23, 1, 'C3'),
       (24, 1, 'C4'),
       (25, 1, 'C5'),
       (26, 1, 'C6'),
       (27, 1, 'C7'),
       (28, 1, 'C8'),
       (29, 1, 'C9'),
       (31, 1, 'D1'),
       (40, 1, 'D10'),
       (32, 1, 'D2'),
       (33, 1, 'D3'),
       (34, 1, 'D4'),
       (35, 1, 'D5'),
       (36, 1, 'D6'),
       (37, 1, 'D7'),
       (38, 1, 'D8'),
       (39, 1, 'D9'),
       (41, 1, 'E1'),
       (50, 1, 'E10'),
       (42, 1, 'E2'),
       (43, 1, 'E3'),
       (44, 1, 'E4'),
       (45, 1, 'E5'),
       (46, 1, 'E6'),
       (47, 1, 'E7'),
       (48, 1, 'E8'),
       (49, 1, 'E9'),
       (51, 1, 'F1'),
       (60, 1, 'F10'),
       (52, 1, 'F2'),
       (53, 1, 'F3'),
       (54, 1, 'F4'),
       (55, 1, 'F5'),
       (56, 1, 'F6'),
       (57, 1, 'F7'),
       (58, 1, 'F8'),
       (59, 1, 'F9'),
       (61, 1, 'G1'),
       (70, 1, 'G10'),
       (62, 1, 'G2'),
       (63, 1, 'G3'),
       (64, 1, 'G4'),
       (65, 1, 'G5'),
       (66, 1, 'G6'),
       (67, 1, 'G7'),
       (68, 1, 'G8'),
       (69, 1, 'G9'),
       (71, 1, 'H1'),
       (80, 1, 'H10'),
       (72, 1, 'H2'),
       (73, 1, 'H3'),
       (74, 1, 'H4'),
       (75, 1, 'H5'),
       (76, 1, 'H6'),
       (77, 1, 'H7'),
       (78, 1, 'H8'),
       (79, 1, 'H9'),
       (81, 2, 'A1'),
       (82, 2, 'A2'),
       (83, 2, 'A3'),
       (84, 2, 'A4'),
       (85, 2, 'A5'),
       (86, 2, 'A6'),
       (87, 2, 'A7'),
       (88, 2, 'A8'),
       (89, 2, 'B1'),
       (90, 2, 'B2'),
       (91, 2, 'B3'),
       (92, 2, 'B4'),
       (93, 2, 'B5'),
       (94, 2, 'B6'),
       (95, 2, 'B7'),
       (96, 2, 'B8'),
       (97, 2, 'C1'),
       (98, 2, 'C2'),
       (99, 2, 'C3'),
       (100, 2, 'C4'),
       (101, 2, 'C5'),
       (102, 2, 'C6'),
       (103, 2, 'C7'),
       (104, 2, 'C8'),
       (105, 2, 'D1'),
       (106, 2, 'D2'),
       (107, 2, 'D3'),
       (108, 2, 'D4'),
       (109, 2, 'D5'),
       (110, 2, 'D6'),
       (111, 2, 'D7'),
       (112, 2, 'D8'),
       (113, 2, 'E1'),
       (114, 2, 'E2'),
       (115, 2, 'E3'),
       (116, 2, 'E4'),
       (117, 2, 'E5'),
       (118, 2, 'E6'),
       (119, 2, 'E7'),
       (120, 2, 'E8'),
       (121, 2, 'F1'),
       (122, 2, 'F2'),
       (123, 2, 'F3'),
       (124, 2, 'F4'),
       (125, 2, 'F5'),
       (126, 2, 'F6'),
       (127, 2, 'F7'),
       (128, 2, 'F8'),
       (129, 3, 'A1'),
       (138, 3, 'A10'),
       (139, 3, 'A11'),
       (140, 3, 'A12'),
       (130, 3, 'A2'),
       (131, 3, 'A3'),
       (132, 3, 'A4'),
       (133, 3, 'A5'),
       (134, 3, 'A6'),
       (135, 3, 'A7'),
       (136, 3, 'A8'),
       (137, 3, 'A9'),
       (141, 3, 'B1'),
       (150, 3, 'B10'),
       (151, 3, 'B11'),
       (152, 3, 'B12'),
       (142, 3, 'B2'),
       (143, 3, 'B3'),
       (144, 3, 'B4'),
       (145, 3, 'B5'),
       (146, 3, 'B6'),
       (147, 3, 'B7'),
       (148, 3, 'B8'),
       (149, 3, 'B9'),
       (153, 3, 'C1'),
       (162, 3, 'C10'),
       (163, 3, 'C11'),
       (164, 3, 'C12'),
       (154, 3, 'C2'),
       (155, 3, 'C3'),
       (156, 3, 'C4'),
       (157, 3, 'C5'),
       (158, 3, 'C6'),
       (159, 3, 'C7'),
       (160, 3, 'C8'),
       (161, 3, 'C9'),
       (165, 3, 'D1'),
       (174, 3, 'D10'),
       (175, 3, 'D11'),
       (176, 3, 'D12'),
       (166, 3, 'D2'),
       (167, 3, 'D3'),
       (168, 3, 'D4'),
       (169, 3, 'D5'),
       (170, 3, 'D6'),
       (171, 3, 'D7'),
       (172, 3, 'D8'),
       (173, 3, 'D9'),
       (177, 3, 'E1'),
       (186, 3, 'E10'),
       (187, 3, 'E11'),
       (188, 3, 'E12'),
       (178, 3, 'E2'),
       (179, 3, 'E3'),
       (180, 3, 'E4'),
       (181, 3, 'E5'),
       (182, 3, 'E6'),
       (183, 3, 'E7'),
       (184, 3, 'E8'),
       (185, 3, 'E9'),
       (189, 3, 'F1'),
       (198, 3, 'F10'),
       (199, 3, 'F11'),
       (200, 3, 'F12'),
       (190, 3, 'F2'),
       (191, 3, 'F3'),
       (192, 3, 'F4'),
       (193, 3, 'F5'),
       (194, 3, 'F6'),
       (195, 3, 'F7'),
       (196, 3, 'F8'),
       (197, 3, 'F9'),
       (201, 3, 'G1'),
       (210, 3, 'G10'),
       (211, 3, 'G11'),
       (212, 3, 'G12'),
       (202, 3, 'G2'),
       (203, 3, 'G3'),
       (204, 3, 'G4'),
       (205, 3, 'G5'),
       (206, 3, 'G6'),
       (207, 3, 'G7'),
       (208, 3, 'G8'),
       (209, 3, 'G9'),
       (213, 3, 'H1'),
       (222, 3, 'H10'),
       (223, 3, 'H11'),
       (224, 3, 'H12'),
       (214, 3, 'H2'),
       (215, 3, 'H3'),
       (216, 3, 'H4'),
       (217, 3, 'H5'),
       (218, 3, 'H6'),
       (219, 3, 'H7'),
       (220, 3, 'H8'),
       (221, 3, 'H9'),
       (225, 3, 'I1'),
       (234, 3, 'I10'),
       (235, 3, 'I11'),
       (236, 3, 'I12'),
       (226, 3, 'I2'),
       (227, 3, 'I3'),
       (228, 3, 'I4'),
       (229, 3, 'I5'),
       (230, 3, 'I6'),
       (231, 3, 'I7'),
       (232, 3, 'I8'),
       (233, 3, 'I9'),
       (237, 3, 'J1'),
       (246, 3, 'J10'),
       (247, 3, 'J11'),
       (248, 3, 'J12'),
       (238, 3, 'J2'),
       (239, 3, 'J3'),
       (240, 3, 'J4'),
       (241, 3, 'J5'),
       (242, 3, 'J6'),
       (243, 3, 'J7'),
       (244, 3, 'J8'),
       (245, 3, 'J9');
/*!40000 ALTER TABLE `seats` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions`
(
    `id`           int      NOT NULL AUTO_INCREMENT,
    `movie_id`     int      NOT NULL,
    `room_id`      int      NOT NULL,
    `session_date` datetime NOT NULL,
    PRIMARY KEY (`id`),
    KEY            `movie_id` (`movie_id`),
    KEY            `room_id` (`room_id`),
    CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
    CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK
TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions`
VALUES (1, 1, 1, '2026-08-10 14:00:00'),
       (2, 1, 2, '2026-08-10 19:30:00'),
       (3, 2, 3, '2026-08-10 18:00:00'),
       (4, 3, 1, '2026-08-11 20:00:00'),
       (5, 4, 2, '2026-08-11 21:30:00'),
       (6, 5, 3, '2026-08-12 16:00:00'),
       (7, 6, 1, '2026-08-12 19:00:00'),
       (8, 8, 2, '2026-08-13 22:00:00'),
       (9, 1, 1, '2026-08-10 19:30:00'),
       (10, 1, 1, '2026-08-10 20:30:00'),
       (11, 1, 1, '2026-08-10 20:30:00'),
       (12, 1, 1, '2026-08-10 22:30:00'),
       (13, 1, 1, '2026-08-10 22:30:00'),
       (14, 1, 1, '2026-08-10 22:30:00'),
       (15, 1, 1, '2026-08-10 22:30:00');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings`
(
    `id`                     int           NOT NULL AUTO_INCREMENT,
    `cashback_percent`       decimal(5, 2) NOT NULL,
    `cashback_validity_days` int           NOT NULL,
    `normal_ticket_price`    int           NOT NULL,
    `vip_ticket_price`       int           NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK
TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings`
VALUES (1, 10.00, 30, 2500, 4500);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
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

-- Dump completed on 2026-08-12 11:38:28
