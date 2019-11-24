-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2019 a las 20:10:00
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
-- Base de datos: `merceriabd`
--
CREATE DATABASE IF NOT EXISTS `merceriabd` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `merceriabd`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medias`
--

CREATE TABLE `medias` (
  `ID` int(11) NOT NULL,
  `color` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `marca` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `talle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `medias`
--

INSERT INTO `medias` (`ID`, `color`, `marca`, `precio`, `talle`) VALUES
(1, 'verde', 'saralin', 800, 2),
(2, 'rojo', 'pepito', 300, 2),
(3, 'rojo', 'sani', 150, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `correo` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `clave` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `nombre` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `apellido` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `perfil` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(60) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `correo`, `clave`, `nombre`, `apellido`, `perfil`, `foto`) VALUES
(1, 'pepito@gmail.com', '123', 'pepo', 'palta', 'encargado', 'palta.210155.jpg'),
(2, 'juana@gmail.com', '111', 'juana', 'palta', 'propietario', 'palta.200707.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `medias`
--
ALTER TABLE `medias`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
