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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum_mvc.category : ~3 rows (environ)
INSERT INTO `category` (`id_category`, `categoryLabel`) VALUES
	(1, 'Jeu-vidéo'),
	(2, 'Musique'),
	(3, 'Informatique');

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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum_mvc.post : ~3 rows (environ)
INSERT INTO `post` (`id_post`, `text`, `post_creation_date`, `user_id`, `topic_id`) VALUES
	(47, 'test', '2023-07-07 08:53:21', 37, 57),
	(48, 'eza', '2023-07-07 08:54:45', 37, 60),
	(49, 'eza', '2023-07-07 09:15:26', 37, 61);

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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum_mvc.topic : ~3 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `topic_creation_date`, `is_locked`, `user_id`, `category_id`) VALUES
	(1, 'test', '2023-07-07 08:50:43', 0, 6, 3),
	(57, 'test', '2023-07-07 08:53:21', 0, 37, 2),
	(60, 'azezae', '2023-07-07 08:54:45', 0, 37, 2),
	(61, 'azezae', '2023-07-07 09:15:26', 0, 37, 2);

-- Listage de la structure de table forum_mvc. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `user_registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `password` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum_mvc.user : ~2 rows (environ)
INSERT INTO `user` (`id_user`, `nickname`, `password`, `email`, `user_registration_date`, `role`) VALUES
	(6, 'Edouard_Cislak', '$2y$10$GG9CHtOoGRdhl/KTKy/Bb.7CMLoAV.K4hx0fktCHpTCNNRAfnKSrG', 'edouardcislak@gmail.com', '2023-03-29 09:04:44', 'admin'),
	(37, 'testtest', '$2y$10$9FPG0SmH8By1ZPOK483FtOelgWuu6.c2qiyUQc//g3mfYlmZF0Lz.', 'test123@gmail.com', '2023-07-07 08:52:50', 'normal'),
	(38, 'azeazeaze', '$2y$10$lj5letRXtpOfct70SwZCTejBTdvQmMnSlPZHIK.3B4n72F6you3SO', 'aaaaas@gmail.com', '2023-07-07 09:15:42', 'normal');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
