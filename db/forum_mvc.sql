-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum_mvc
CREATE DATABASE IF NOT EXISTS `forum_mvc` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum_mvc`;

-- Listage de la structure de table forum_mvc. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `categoryLabel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum_mvc.category : ~4 rows (environ)
INSERT INTO `category` (`id_category`, `categoryLabel`) VALUES
	(1, 'FAQ'),
	(71, 'Category pour tester'),
	(78, 'Le meilleurtatata'),
	(85, 'List of categorieazea'),
	(92, 'Jamais'),
	(97, 'ALALA');

-- Listage de la structure de table forum_mvc. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `post_creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `FK_post_topic` (`topic_id`),
  KEY `FK_post_user` (`user_id`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum_mvc.post : ~8 rows (environ)
INSERT INTO `post` (`id_post`, `text`, `post_creation_date`, `user_id`, `topic_id`) VALUES
	(153, 'zaeaze', '2023-07-29 20:27:54', 40, 138),
	(154, 'aaa', '2023-07-30 19:31:28', 40, 138),
	(157, 'eazeza', '2023-07-30 20:53:59', 89, 139),
	(163, 'eazeaz', '2023-07-30 21:32:52', 40, 138),
	(164, 'ezaezaeza', '2023-07-30 21:33:02', 40, 139),
	(165, 'eazeza', '2023-07-30 21:33:11', 40, 143),
	(167, 'ezaeza', '2023-07-31 03:46:00', 40, 153),
	(168, 'eazeza', '2023-07-31 03:46:03', 40, 153),
	(169, 'tatata', '2023-07-31 03:46:22', 40, 138),
	(170, 'tatata', '2023-07-31 03:46:28', 40, 139);

-- Listage de la structure de table forum_mvc. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `topic_creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `topic_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  PRIMARY KEY (`id_topic`) USING BTREE,
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum_mvc.topic : ~6 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `topic_creation_date`, `is_locked`, `user_id`, `category_id`, `topic_description`) VALUES
	(137, 'AH', '2023-07-29 20:16:36', 0, 40, 1, 'AH'),
	(138, 'ezaezae', '2023-07-29 20:27:49', 0, 40, 71, 'aezae'),
	(139, 'test', '2023-07-30 13:59:53', 1, 87, 71, 'testeur'),
	(143, 'ezaezae', '2023-07-30 20:54:08', 0, 89, 71, 'zaezae'),
	(153, 'Heeerarez', '2023-07-31 03:45:57', 0, 40, 78, 'aezaeaeza'),
	(155, 'List of categories', '2023-08-01 05:06:05', 0, 40, 85, 'azeae');

-- Listage de la structure de table forum_mvc. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `user_registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'user',
  `ban` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `password` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum_mvc.user : ~21 rows (environ)
INSERT INTO `user` (`id_user`, `nickname`, `password`, `email`, `user_registration_date`, `role`, `ban`) VALUES
	(39, 'aaaa', '$2y$10$Ba5I7cD62KUcbjNBLv6Yr.gJZGfBqDyZzvmnmWLFhpmL1C.Jhc71y', 'azeazeza@gmail.com', '2023-07-12 11:57:03', 'User', 0),
	(40, 'Kaz', '$2y$10$4f/kWgBZ4ebbAjj9zz4e5.B1zool1pVqetCLa3ALrvYZJqv1.COxi', 'Kazae@gmail.com', '2023-07-18 14:09:48', 'admin', 0),
	(70, 'kaz33', '$2y$10$egN79k.SbD92d3wc9f5OvOubA4z9NemGZNfy6cAlmXughPXw2wtNm', 'kaz33@gmail.com', '2023-07-19 11:22:57', 'User', 0),
	(71, 'test1', '$2y$10$tPV2dzrnAEOHY5tDgT2cKOYuI/wSIOgBrzKUSnxvE0pZHDf/i.NsG', 'test1@gmail.com', '2023-07-19 16:51:06', 'User', 0),
	(72, 'test2', '$2y$10$8V4wTI/qowAndRlH3qydIOs3yAG/5jmJfMsGpVLZ7uAiPVgs2m7t2', 'test2@gmail.com', '2023-07-19 16:52:30', 'user', 0),
	(73, 'Kaz112', '$2y$10$i0Q7zKUc8ew1KmPyIXDmNe8NjrpjrNRtXLc1hhUXuRzM6V9E94eKK', 'kaz112@gmail.com', '2023-07-19 17:02:38', 'User', 0),
	(74, 'Kaz55', '$2y$10$dvmZIdlatONC5P00/hsTW.pOUuGPQdbIrueOYcUFk5ffoGLj00w4a', 'kaz55@gmail.com', '2023-07-20 09:32:48', 'User', 0),
	(75, 'kaz66', '$2y$10$jDQt8ydwCaWPSPyVin3wC.KugQsupNECYM9/7EGxUCflqFAFCBDVK', 'kaz66@gmail.com', '2023-07-20 09:48:39', 'User', 0),
	(76, 'azeeza', '$2y$10$En737euFDjBacWT1ztmr..LNdlmc3vqPMtMtBbojacijsI1DHbrZm', 'Kazae1111111111111@gmail.com', '2023-07-20 10:39:42', 'User', 0),
	(77, 'Kazzzz', '$2y$10$rjQNhrxBONVHf4RWkbBeF.RVRjrIALe3k9SSNZIBZkuYiE2mA4l6G', 'Kazazzze@gmail.com', '2023-07-24 09:21:15', 'User', 0),
	(78, 'Kazeerta', '$2y$10$2pzkTmMxTx9f4K1vKUi8Fur.J47bM5DQNDubr20klc.Y9t1/apjju', 'Kazae5000@gmail.com', '2023-07-24 09:21:54', 'User', 0),
	(79, 'Kazae1020', '$2y$10$2OUP4zSAMTZqz12UGWd9C.tuFDuCUq8ehKxsBzJyhQaZfy0zViWl6', '50Kazae@gmail.com', '2023-07-24 09:23:07', 'User', 0),
	(80, 'Kaz800', '$2y$10$IKrHitKsz6Pa2tdoLBq9GODZyxBZ0rc9tn3ozMnX.jDGjdfpwECXG', 'kaz800@gmail.com', '2023-07-24 09:26:00', 'User', 0),
	(81, 'Kaz8009', '$2y$10$3//s4rxOpLEms2u81rcg7un.xbiU9gMZpxisEpWoH5liwAoJjCsFy', 'kaz809@gmail.com', '2023-07-24 09:37:28', 'User', 0),
	(82, 'Test52', '$2y$10$yyJen5MI/1OF38yooYq72ula2TVM2vWA8R.n6m/8exL6O94u47YpG', 'Test52@gmail.com', '2023-07-24 15:48:04', 'user', 0),
	(83, 'test11', '$2y$10$dMDhvUrVrKnnCcK1KytpfuP0kr2ixsaBqmeO.g9ntRTVlb/eG/izu', 'test11@gmail.com', '2023-07-24 15:49:40', 'admin', 0),
	(84, 'test555', '$2y$10$mglIuBR/./DII92kvW1ImuTS.mt8pgDg9iV/OV4Epzne6NhDdeNgm', 'test555@gmail.com', '2023-07-24 15:57:12', 'admin', 0),
	(85, 'test88', '$2y$10$6bNl9u.8QEHAFm7nh0PKsurkP8Rc462zDR40ZvU2sMOu/2CuGLz7u', 'test88@gmail.com', '2023-07-25 13:02:24', 'user', 0),
	(86, 'test8878', '$2y$10$YLg5nvZ/szwqEN8jAdWg2usaQ.x1IUxx4.XImS7Ch/SQaSDG4xDRC', 'test8878@gmail.com', '2023-07-26 15:04:11', 'user', 0),
	(87, 'testeur', '$2y$10$Tbqfv.j3V3bx2ip0LPWX9.sw5T4kNa5E2YeHmQe5z/54QeHIf38I6', 'testeur@gmail.com', '2023-07-27 16:35:37', 'user', 0),
	(88, 'VRAI', '$2y$10$9PDknWSccAQk5KfuNDrHde4wacHGp34Hg/tiFmYJ37Q1EBPafGnai', 'VRAITEST@gmail.com', '2023-07-28 16:54:51', 'user', 0),
	(89, 'Hello', '$2y$10$2G/RGM.v.J3Ko/mXIp5BvOPILcNiT65HeBzTTHEFCl1m3vOcXXLKW', 'Helloworld@gmail.com', '2023-07-30 20:53:34', 'user', 0),
	(90, 'wesh1', '$2y$10$q7YfE3wrMIPgD4H0UsiRYewOQQFPypiPPp37oRdSukZhmkI0.4j/C', 'wesh1@gmail.com', '2023-08-01 06:34:58', 'user', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
