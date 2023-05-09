-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-04-2023 a las 21:48:56
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foroenfermeriadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name_unique` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(2, 'Cuidados Lesiones de la Piel'),
(1, 'Patologías prevalentes en Mayores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_topic` int NOT NULL,
  `post_by` int NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `post_topic` (`post_topic`),
  KEY `post_by` (`post_by`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`) VALUES
(31, 'prueba de grabado de un mensaje', '2023-04-28 13:56:10', 51, 34),
(32, 'Prueba de grabado de un mensaje', '2023-04-28 13:58:01', 45, 34),
(33, 'segundo mensaje', '2023-04-28 14:07:40', 45, 34),
(34, 'prueba 3 mensaje\r\n\r\n', '2023-04-28 14:45:36', 45, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int NOT NULL AUTO_INCREMENT,
  `topic_subject` varchar(255) NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_cat` int NOT NULL,
  `topic_by` int NOT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `topic_by` (`topic_by`),
  KEY `topic_cat` (`topic_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`) VALUES
(43, 'Alimentos cardiosalubles, bajos en sal', '2023-04-27 23:23:49', 1, 34),
(44, 'Como Tomarse la Tensión Arterial', '2023-04-27 23:43:36', 1, 34),
(45, 'Alimentos cardiosalubles, bajos en sal', '2023-04-28 00:16:57', 1, 34),
(47, 'Alimentos cardiosalubles, bajos en sal', '2023-04-28 00:27:19', 1, 34),
(48, 'Cuidados Lesiones de la Piel', '2023-04-28 00:29:52', 1, 34),
(51, 'Cuidados Lesiones de la Piel', '2023-04-28 08:53:59', 2, 34),
(52, 'Cuidados Lesiones de la Piel', '2023-04-28 09:00:43', 2, 34),
(53, 'Cuidados en las Colostomias', '2023-04-28 09:01:05', 2, 34),
(54, 'Cuidados Lesiones de la Piel', '2023-04-28 09:19:15', 2, 34),
(55, 'Programando enfadado', '2023-04-28 11:14:24', 2, 34),
(56, 'Alimentos cardiosalubles, bajos en sal', '2023-04-28 12:19:40', 2, 34),
(57, 'Cuidados Lesiones de la Piel', '2023-04-28 12:39:34', 2, 34),
(58, 'Cuidados Lesiones de la Piel', '2023-04-28 12:42:02', 2, 34),
(59, 'Hola', '2023-04-28 14:08:09', 1, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_date` datetime NOT NULL,
  `user_level` int NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name_unique` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_level`) VALUES
(34, 'Arodriguezt', '$2y$12$KP0SwJs4k7gz3Qq4EnnoRunR/vyZUIByYSjKKuqrkqwbCYqAWjwgS', 'rosatabsaa@outlook.es', '2023-04-27 05:12:20', 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`topic_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--Usuarios creados con acceso a la base de datos

--Usuario administrador de la base de datos:
GRANT USAGE ON *.* TO `foroenfermeriauser`@`%`;

GRANT ALL PRIVILEGES ON `foroenfermeriadb`.* TO `foroenfermeriauser`@`%`;

--Usuario básico de la base de datos solo con control para la tabla mensajes:
GRANT USAGE ON *.* TO `foroenfermeriabasic`@`%`;

GRANT ALL PRIVILEGES ON `foroenfermeriadb`.`topics` TO `foroenfermeriabasic`@`%`;

