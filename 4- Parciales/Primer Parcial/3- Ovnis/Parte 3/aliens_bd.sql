-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2019 a las 01:07:29
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
-- Base de datos: `aliens_bd`
--
CREATE DATABASE IF NOT EXISTS `aliens_bd` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `aliens_bd`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ovnis`
--

CREATE TABLE `ovnis` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `velocidad` double NOT NULL,
  `planeta` varchar(50) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ovnis`
--

INSERT INTO `ovnis` (`id`, `tipo`, `velocidad`, `planeta`, `foto`) VALUES
(1, 'Marciano', 45, 'Marte', ''),
(2, 'Lunar', 456, 'Luna', 'Lunar.Luna.02158.png'),
(3, 'Indefinido', 9, 'Indefinido', 'Indefinido.Indefinido.03532.jpg'),
(4, 'Lunar', 456, 'Luna', 'Lunar.Luna.02316.png'),
(5, 'Incongito', 60, 'Plutonwenoeraplanetaeso', 'Incongito.Plutonwenoeraplanetaeso.10619.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ovnis`
--
ALTER TABLE `ovnis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ovnis`
--
ALTER TABLE `ovnis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
