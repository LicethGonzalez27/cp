-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2016 a las 02:59:52
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `transporte_especial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `automotor`
--

CREATE TABLE IF NOT EXISTS `automotor` (
  `id` int(11) NOT NULL,
  `numero` int(15) DEFAULT NULL,
  `placa` varchar(6) DEFAULT NULL,
  `marca` varchar(25) DEFAULT NULL,
  `clase` varchar(25) DEFAULT NULL,
  `modelo` varchar(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `automotor`
--

INSERT INTO `automotor` (`id`, `numero`, `placa`, `marca`, `clase`, `modelo`) VALUES
(1, 105, 'BFY756', 'Nissan', 'Camioneta', '2007');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `id` int(11) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `cedula` int(15) DEFAULT NULL,
  `fec_nacimiento` date DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombres`, `apellidos`, `cedula`, `fec_nacimiento`, `direccion`, `telefono`) VALUES
(1, 'Mateo', 'Sandoval L', 12345678, '1989-09-14', 'Calle 128', '8780999');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE IF NOT EXISTS `licencia` (
  `id` int(11) NOT NULL,
  `numero` int(25) DEFAULT NULL,
  `fec_expedicion` date DEFAULT NULL,
  `fec_vencimiento` date DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `id_empleados` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE IF NOT EXISTS `parametros` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(100) DEFAULT NULL,
  `nit` varchar(15) DEFAULT NULL,
  `direccion` varchar(25) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `sello` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajeros`
--

CREATE TABLE IF NOT EXISTS `pasajeros` (
  `id` int(11) NOT NULL,
  `cedula` int(15) DEFAULT '0',
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pasajeros`
--

INSERT INTO `pasajeros` (`id`, `cedula`, `nombres`, `apellidos`, `direccion`, `telefono`) VALUES
(1, 12345678, 'Juan', 'Moreno', 'Calle 123 23-20', '3003210198');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planillas`
--

CREATE TABLE IF NOT EXISTS `planillas` (
  `id` int(11) NOT NULL,
  `contrato` int(15) DEFAULT NULL,
  `id_automotor` int(11) DEFAULT NULL,
  `consec_transito` int(45) DEFAULT NULL,
  `fec_inicial` date DEFAULT NULL,
  `fec_final` date DEFAULT NULL,
  `id_recorridos` int(11) DEFAULT NULL,
  `convenio` varchar(45) DEFAULT NULL,
  `fec_registro` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_conductores`
--

CREATE TABLE IF NOT EXISTS `planilla_conductores` (
  `id` int(11) NOT NULL,
  `id_planillas` int(11) DEFAULT NULL,
  `id_empleados` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_pasajeros`
--

CREATE TABLE IF NOT EXISTS `planilla_pasajeros` (
  `id` int(11) NOT NULL,
  `id_planillas` int(11) DEFAULT NULL,
  `id_pasajeros` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE IF NOT EXISTS `puntos` (
  `id` int(11) NOT NULL,
  `punto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorridos`
--

CREATE TABLE IF NOT EXISTS `recorridos` (
  `id` int(11) NOT NULL,
  `origen` varchar(50) DEFAULT NULL,
  `destino` varchar(50) DEFAULT NULL,
  `valor` int(15) DEFAULT NULL,
  `ano` year(4) DEFAULT NULL,
  `id_ruta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL,
  `rol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'ESPECIAL'),
(3, 'USUARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE IF NOT EXISTS `ruta` (
  `id` int(11) NOT NULL,
  `nombre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta_puntos`
--

CREATE TABLE IF NOT EXISTS `ruta_puntos` (
  `id` int(11) NOT NULL,
  `id_ruta` int(11) DEFAULT NULL,
  `id_puntos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soat`
--

CREATE TABLE IF NOT EXISTS `soat` (
  `id` int(11) NOT NULL,
  `poliza` varchar(25) NOT NULL DEFAULT 'NULL',
  `fec_expedicion` date DEFAULT NULL,
  `fec_vencimiento` date DEFAULT NULL,
  `id_automotor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta_operacion`
--

CREATE TABLE IF NOT EXISTS `tarjeta_operacion` (
  `id` int(11) NOT NULL,
  `tarjeta` varchar(25) DEFAULT NULL,
  `capacidad` int(2) DEFAULT NULL,
  `fec_expedicion` date DEFAULT NULL,
  `fec_vencimiento` date DEFAULT NULL,
  `id_automotor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `id_empleados` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `id_rol`, `id_empleados`, `estado`) VALUES
(1, 'mateosanlu', '4dde59bcddc7c2b009308c30847c8bddd56c37e1', 1, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `automotor`
--
ALTER TABLE `automotor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleados` (`id_empleados`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pasajeros`
--
ALTER TABLE `pasajeros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planillas`
--
ALTER TABLE `planillas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_automotor` (`id_automotor`),
  ADD KEY `id_recorridos` (`id_recorridos`);

--
-- Indices de la tabla `planilla_conductores`
--
ALTER TABLE `planilla_conductores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_planillas` (`id_planillas`),
  ADD KEY `id_empleados` (`id_empleados`);

--
-- Indices de la tabla `planilla_pasajeros`
--
ALTER TABLE `planilla_pasajeros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_planillas` (`id_planillas`),
  ADD KEY `id_pasajeros` (`id_pasajeros`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recorridos`
--
ALTER TABLE `recorridos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ruta` (`id_ruta`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ruta_puntos`
--
ALTER TABLE `ruta_puntos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ruta` (`id_ruta`),
  ADD KEY `id_puntos` (`id_puntos`);

--
-- Indices de la tabla `soat`
--
ALTER TABLE `soat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_automotor` (`id_automotor`);

--
-- Indices de la tabla `tarjeta_operacion`
--
ALTER TABLE `tarjeta_operacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_automotor` (`id_automotor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_empleados` (`id_empleados`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `automotor`
--
ALTER TABLE `automotor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pasajeros`
--
ALTER TABLE `pasajeros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `planillas`
--
ALTER TABLE `planillas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `planilla_conductores`
--
ALTER TABLE `planilla_conductores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `planilla_pasajeros`
--
ALTER TABLE `planilla_pasajeros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `recorridos`
--
ALTER TABLE `recorridos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ruta_puntos`
--
ALTER TABLE `ruta_puntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `soat`
--
ALTER TABLE `soat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tarjeta_operacion`
--
ALTER TABLE `tarjeta_operacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD CONSTRAINT `licencia_ibfk_1` FOREIGN KEY (`id_empleados`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `planillas`
--
ALTER TABLE `planillas`
  ADD CONSTRAINT `planillas_ibfk_1` FOREIGN KEY (`id_automotor`) REFERENCES `automotor` (`id`),
  ADD CONSTRAINT `planillas_ibfk_2` FOREIGN KEY (`id_recorridos`) REFERENCES `recorridos` (`id`);

--
-- Filtros para la tabla `planilla_conductores`
--
ALTER TABLE `planilla_conductores`
  ADD CONSTRAINT `planilla_conductores_ibfk_1` FOREIGN KEY (`id_planillas`) REFERENCES `planillas` (`id`),
  ADD CONSTRAINT `planilla_conductores_ibfk_2` FOREIGN KEY (`id_empleados`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `planilla_pasajeros`
--
ALTER TABLE `planilla_pasajeros`
  ADD CONSTRAINT `planilla_pasajeros_ibfk_1` FOREIGN KEY (`id_planillas`) REFERENCES `planillas` (`id`),
  ADD CONSTRAINT `planilla_pasajeros_ibfk_2` FOREIGN KEY (`id_pasajeros`) REFERENCES `pasajeros` (`id`);

--
-- Filtros para la tabla `recorridos`
--
ALTER TABLE `recorridos`
  ADD CONSTRAINT `recorridos_ibfk_1` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id`);

--
-- Filtros para la tabla `ruta_puntos`
--
ALTER TABLE `ruta_puntos`
  ADD CONSTRAINT `ruta_puntos_ibfk_1` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id`),
  ADD CONSTRAINT `ruta_puntos_ibfk_2` FOREIGN KEY (`id_puntos`) REFERENCES `puntos` (`id`);

--
-- Filtros para la tabla `soat`
--
ALTER TABLE `soat`
  ADD CONSTRAINT `soat_ibfk_1` FOREIGN KEY (`id_automotor`) REFERENCES `automotor` (`id`);

--
-- Filtros para la tabla `tarjeta_operacion`
--
ALTER TABLE `tarjeta_operacion`
  ADD CONSTRAINT `tarjeta_operacion_ibfk_1` FOREIGN KEY (`id_automotor`) REFERENCES `automotor` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_empleados`) REFERENCES `empleados` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
