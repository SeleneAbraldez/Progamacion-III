-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2019 a las 23:09:03
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `productos_bd`
--
CREATE DATABASE IF NOT EXISTS `productos_bd` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `productos_bd`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `televisores`
--

CREATE TABLE `televisores` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `televisores`
--

INSERT INTO `televisores` (`id`, `tipo`, `precio`, `pais`, `foto`) VALUES
(1, 'Curvo', 20000, 'Chile', ''),
(9, 'Largo', 60000, 'Uruguay', 'Largo.Uruguay.11924.png'),
(10, 'Lsd', 50000, 'Mexico', 'Lsd.Mexico.225708.png'),
(11, 'Largo', 60000, 'Uruguay', 'Largo.Uruguay.225322.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `televisores`
--
ALTER TABLE `televisores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `televisores`
--
ALTER TABLE `televisores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
