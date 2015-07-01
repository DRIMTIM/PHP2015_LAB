-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-06-2015 a las 05:31:09
-- Versión del servidor: 5.5.43-0+deb8u1
-- Versión de PHP: 5.6.9-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `PHP_LAB`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ADMINISTRADORES`
--

CREATE TABLE IF NOT EXISTS `ADMINISTRADORES` (
`id` bigint(20) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nick` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CATEGORIAS`
--

CREATE TABLE IF NOT EXISTS `CATEGORIAS` (
`id` bigint(20) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CATEGORIAS_OFERTAS`
--

CREATE TABLE IF NOT EXISTS `CATEGORIAS_OFERTAS` (
  `id_categoria` bigint(20) NOT NULL,
  `id_oferta` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `COMPRAS`
--

CREATE TABLE IF NOT EXISTS `COMPRAS` (
`id_compra` bigint(20) NOT NULL,
  `id_oferta` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OFERTAS`
--

CREATE TABLE IF NOT EXISTS `OFERTAS` (
`id` bigint(20) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `descripcion_corta` varchar(80) DEFAULT NULL,
  `precio` decimal(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OFERTAS_STOCK`
--

CREATE TABLE IF NOT EXISTS `OFERTAS_STOCK` (
  `id` bigint(20) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OFERTAS_TEMPORALES`
--

CREATE TABLE IF NOT EXISTS `OFERTAS_TEMPORALES` (
  `id` bigint(20) NOT NULL,
  `fecha_fin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_inicio` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE IF NOT EXISTS `USUARIOS` (
`id` bigint(20) NOT NULL,
  `nick` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fechaNac` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `timeZone` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `edad` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`id`, `nick`, `nombre`, `apellido`, `email`, `fechaNac`, `timeZone`, `celular`, `password`, `edad`) VALUES
(1, 'JONAF22', 'Jonathan', 'Franco', 'jonaf2103@gmail.com', '1991-03-21 03:00:00', 'GMT -3', '091076361', 'jona', 24);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ADMINISTRADORES`
--
ALTER TABLE `ADMINISTRADORES`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `CATEGORIAS`
--
ALTER TABLE `CATEGORIAS`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `CATEGORIAS_OFERTAS`
--
ALTER TABLE `CATEGORIAS_OFERTAS`
 ADD PRIMARY KEY (`id_categoria`,`id_oferta`), ADD KEY `id_oferta` (`id_oferta`);

--
-- Indices de la tabla `COMPRAS`
--
ALTER TABLE `COMPRAS`
 ADD PRIMARY KEY (`id_compra`), ADD KEY `id_oferta` (`id_oferta`), ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `OFERTAS`
--
ALTER TABLE `OFERTAS`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `OFERTAS_STOCK`
--
ALTER TABLE `OFERTAS_STOCK`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `OFERTAS_TEMPORALES`
--
ALTER TABLE `OFERTAS_TEMPORALES`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ADMINISTRADORES`
--
ALTER TABLE `ADMINISTRADORES`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `CATEGORIAS`
--
ALTER TABLE `CATEGORIAS`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `COMPRAS`
--
ALTER TABLE `COMPRAS`
MODIFY `id_compra` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `OFERTAS`
--
ALTER TABLE `OFERTAS`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `CATEGORIAS_OFERTAS`
--
ALTER TABLE `CATEGORIAS_OFERTAS`
ADD CONSTRAINT `CATEGORIAS_OFERTAS_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `CATEGORIAS` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `CATEGORIAS_OFERTAS_ibfk_2` FOREIGN KEY (`id_oferta`) REFERENCES `OFERTAS` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `COMPRAS`
--
ALTER TABLE `COMPRAS`
ADD CONSTRAINT `COMPRAS_ibfk_1` FOREIGN KEY (`id_oferta`) REFERENCES `OFERTAS` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `COMPRAS_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `USUARIOS` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `OFERTAS_STOCK`
--
ALTER TABLE `OFERTAS_STOCK`
ADD CONSTRAINT `OFERTAS_STOCK_ibfk_1` FOREIGN KEY (`id`) REFERENCES `OFERTAS` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `OFERTAS_TEMPORALES`
--
ALTER TABLE `OFERTAS_TEMPORALES`
ADD CONSTRAINT `OFERTAS_TEMPORALES_ibfk_1` FOREIGN KEY (`id`) REFERENCES `OFERTAS` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
