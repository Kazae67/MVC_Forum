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
  `categoryLabel` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum_mvc.category : ~5 rows (environ)
INSERT INTO `category` (`id_category`, `categoryLabel`) VALUES
	(1, 'Update'),
	(2, 'Events'),
	(4, 'Questions'),
	(5, 'FAQ'),
	(8, 'test'),
	(9, 'lol'),
	(10, 'aaaah'),
	(11, 'azezaeza'),
	(12, 'tttttt'),
	(13, 'azezaeza'),
	(14, 'tttttzzz'),
	(15, 'blablabla'),
	(16, 'roule ma poule');

-- Listage de la structure de table forum_mvc. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `post_creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `FK_post_topic` (`topic_id`),
  KEY `FK_post_user` (`user_id`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum_mvc.post : ~0 rows (environ)
INSERT INTO `post` (`id_post`, `text`, `post_creation_date`, `user_id`, `topic_id`) VALUES
	(62, 'azea', '2023-07-24 14:50:21', 40, 75);

-- Listage de la structure de table forum_mvc. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `topic_creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`) USING BTREE,
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum_mvc.topic : ~5 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `topic_creation_date`, `is_locked`, `user_id`, `category_id`) VALUES
	(1, '1er topic', '2022-07-13 11:56:28', 0, 39, 1),
	(2, '2eme topic', '2023-07-13 15:01:22', 0, 39, 2),
	(3, '3eme topic', '2023-07-13 15:13:32', 0, 39, 2),
	(4, '4eme topic', '2023-07-13 15:14:37', 0, 39, 4),
	(5, '5eme', '2023-07-13 15:22:14', 0, 39, 4),
	(70, 'TEST 3', '2023-07-24 11:05:41', 0, 40, 1),
	(71, 'TEST 3', '2023-07-24 11:05:52', 0, 40, 1),
	(72, 'Salut', '2023-07-24 11:11:56', 0, 40, 1),
	(73, 'Test', '2023-07-24 13:40:37', 0, 40, 5),
	(74, 'Test', '2023-07-24 13:40:48', 0, 40, 5),
	(75, 'test', '2023-07-24 14:16:38', 0, 40, 1),
	(76, 'test', '2023-07-24 16:33:33', 0, 40, 9),
	(77, 'ezaezaez', '2023-07-24 16:38:39', 0, 40, 11),
	(78, 'ttt', '2023-07-24 16:40:32', 0, 40, 12),
	(79, 'azeazeza541', '2023-07-24 16:49:17', 0, 40, 11);

-- Listage de la structure de table forum_mvc. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `user_registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `password` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum_mvc.user : ~8 rows (environ)
INSERT INTO `user` (`id_user`, `nickname`, `password`, `email`, `user_registration_date`, `role`) VALUES
	(39, 'aaaa', '$2y$10$Ba5I7cD62KUcbjNBLv6Yr.gJZGfBqDyZzvmnmWLFhpmL1C.Jhc71y', 'azeazeza@gmail.com', '2023-07-12 11:57:03', 'User'),
	(40, 'Kaz', '$2y$10$4f/kWgBZ4ebbAjj9zz4e5.B1zool1pVqetCLa3ALrvYZJqv1.COxi', 'Kazae@gmail.com', '2023-07-18 14:09:48', 'admin'),
	(70, 'kaz33', '$2y$10$egN79k.SbD92d3wc9f5OvOubA4z9NemGZNfy6cAlmXughPXw2wtNm', 'kaz33@gmail.com', '2023-07-19 11:22:57', 'User'),
	(71, 'test1', '$2y$10$tPV2dzrnAEOHY5tDgT2cKOYuI/wSIOgBrzKUSnxvE0pZHDf/i.NsG', 'test1@gmail.com', '2023-07-19 16:51:06', 'User'),
	(72, 'test2', '$2y$10$8V4wTI/qowAndRlH3qydIOs3yAG/5jmJfMsGpVLZ7uAiPVgs2m7t2', 'test2@gmail.com', '2023-07-19 16:52:30', 'user'),
	(73, 'Kaz112', '$2y$10$i0Q7zKUc8ew1KmPyIXDmNe8NjrpjrNRtXLc1hhUXuRzM6V9E94eKK', 'kaz112@gmail.com', '2023-07-19 17:02:38', 'User'),
	(74, 'Kaz55', '$2y$10$dvmZIdlatONC5P00/hsTW.pOUuGPQdbIrueOYcUFk5ffoGLj00w4a', 'kaz55@gmail.com', '2023-07-20 09:32:48', 'User'),
	(75, 'kaz66', '$2y$10$jDQt8ydwCaWPSPyVin3wC.KugQsupNECYM9/7EGxUCflqFAFCBDVK', 'kaz66@gmail.com', '2023-07-20 09:48:39', 'User'),
	(76, 'azeeza', '$2y$10$En737euFDjBacWT1ztmr..LNdlmc3vqPMtMtBbojacijsI1DHbrZm', 'Kazae1111111111111@gmail.com', '2023-07-20 10:39:42', 'User'),
	(77, 'Kazzzz', '$2y$10$rjQNhrxBONVHf4RWkbBeF.RVRjrIALe3k9SSNZIBZkuYiE2mA4l6G', 'Kazazzze@gmail.com', '2023-07-24 09:21:15', 'User'),
	(78, 'Kazeerta', '$2y$10$2pzkTmMxTx9f4K1vKUi8Fur.J47bM5DQNDubr20klc.Y9t1/apjju', 'Kazae5000@gmail.com', '2023-07-24 09:21:54', 'User'),
	(79, 'Kazae1020', '$2y$10$2OUP4zSAMTZqz12UGWd9C.tuFDuCUq8ehKxsBzJyhQaZfy0zViWl6', '50Kazae@gmail.com', '2023-07-24 09:23:07', 'User'),
	(80, 'Kaz800', '$2y$10$IKrHitKsz6Pa2tdoLBq9GODZyxBZ0rc9tn3ozMnX.jDGjdfpwECXG', 'kaz800@gmail.com', '2023-07-24 09:26:00', 'User'),
	(81, 'Kaz8009', '$2y$10$3//s4rxOpLEms2u81rcg7un.xbiU9gMZpxisEpWoH5liwAoJjCsFy', 'kaz809@gmail.com', '2023-07-24 09:37:28', 'User'),
	(82, 'Test52', '$2y$10$yyJen5MI/1OF38yooYq72ula2TVM2vWA8R.n6m/8exL6O94u47YpG', 'Test52@gmail.com', '2023-07-24 15:48:04', 'user'),
	(83, 'test11', '$2y$10$dMDhvUrVrKnnCcK1KytpfuP0kr2ixsaBqmeO.g9ntRTVlb/eG/izu', 'test11@gmail.com', '2023-07-24 15:49:40', 'admin'),
	(84, 'test555', '$2y$10$mglIuBR/./DII92kvW1ImuTS.mt8pgDg9iV/OV4Epzne6NhDdeNgm', 'test555@gmail.com', '2023-07-24 15:57:12', 'admin');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
