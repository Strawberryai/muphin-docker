-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 16-09-2020 a las 16:37:17
-- Versión del servidor: 10.5.5-MariaDB-1:10.5.5+maria~focal
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
CREATE TABLE `usuarios` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `nombre_apellidos` text NOT NULL,
  `DNI` text NOT NULL,
  `telf` int(9) NOT NULL,
  `email` text NOT NULL,
  `fecha` text NOT NULL,
  PRIMARY KEY(`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `muffins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imagen` text NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  `likes` int DEFAULT 0,
  `user_prop` text DEFAULT "Anonimo",
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `ip` (
  `address` char(16) COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin; 

--
-- Volcado de datos para la tabla `usuarios`
--
INSERT INTO `usuarios` (`username`, `password`, `nombre_apellidos`, `DNI`, `telf`, `email`, `fecha`) VALUES
('Mikel001', 'test', 'Mikel García', '11111111Z', '111111111', 'mikel001@mail.com', '2022-10-06'),
('Mikel002', 'test', 'Mikel García2', '22222222Z', '222222222', 'mikel002@mail.com', '2022-10-07'),
('Mikel003', 'test', 'Mikel García3', '33333333Z', '333333333', 'mikel003@mail.com', '2022-10-08'),
('Aitor001', 'test', 'Aitor Viñedo', '11111111Z', '111111111', 'aitor001@mail.com', '2022-10-09');


INSERT INTO `muffins` (`imagen`,`titulo`,`descripcion`,`likes`,`user_prop`) VALUES ('Muffin con crema','Muffin a la blanquesina','Delicioso muffin con crema de leche por encima y ligero sabor a limon','2222','Alvaro Diez'),('Muffin de choco','Muffin bronceado','Muffin achocolatado bajo en azucares y libre de edulcorantes pero con mucho MUCHO chocolate','1233','Alan Garcia'),('Muffin frutoso','Muffin del bosque','Un bocado a este muffin es como teletransportarte a un bosque y disfrutar de la naturaleza','673','Mikel Egaña'),('Muffin normal','Muffin principiante','Muffin basico, he tardado solo 30 minutos en hacerlos!','122','Adrian Lopez'),('Muffin de Linux','Open source','Delicioso muffin con el que saborearas la libertad del software hecho muffin','9999','OpenSource');
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
