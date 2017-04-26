-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-02-2017 a las 05:39:56
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

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
-- Estructura de tabla para la tabla `aseguradoras`
--

CREATE TABLE `aseguradoras` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL DEFAULT 'NULL',
  `telefonos` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aseguradoras`
--

INSERT INTO `aseguradoras` (`id`, `nombre`, `telefonos`) VALUES
(1, 'Allianz Colombia', '1234567'),
(2, 'Liberty Seguros S.A.', '307 70 50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `automotor`
--

CREATE TABLE `automotor` (
  `id` int(11) NOT NULL,
  `numero` int(15) DEFAULT NULL,
  `placa` varchar(6) DEFAULT NULL,
  `marca` varchar(25) DEFAULT NULL,
  `clase` varchar(25) DEFAULT NULL,
  `modelo` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `automotor`
--

INSERT INTO `automotor` (`id`, `numero`, `placa`, `marca`, `clase`, `modelo`) VALUES
(1, 105, 'BFY756', 'Nissan', 'Camioneta', '2007'),
(2, 103, 'MHS613', 'Chevrolet', 'Camioneta', '2010'),
(4, 106, 'CME334', 'Chevrolet', 'Automovil', '2005'),
(5, 3, 'TYU876', 'Chevrolet', 'Campero', '2'),
(6, 107, 'MHS613', 'Chevrolet', 'Camioneta', '2016'),
(7, 108, 'BGT567', 'Otro', 'Camioneta', '2018'),
(8, 109, 'JHG679', 'Otro', 'Camioneta', '2001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `cedula` int(15) DEFAULT NULL,
  `fec_nacimiento` date DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombres`, `apellidos`, `cedula`, `fec_nacimiento`, `direccion`, `telefono`) VALUES
(1, 'Mateo', 'Sandoval L', 12345678, '1989-09-14', 'Calle 128', '8780999'),
(2, 'Leidy', 'Torres R', 1014, '1990-09-19', 'Km 7 via Pasca', '314000000'),
(3, 'Liceth', 'Gonzalez', 1016765528, '1998-12-27', 'Villa Lorena', '3002000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `id` int(11) NOT NULL,
  `numero` int(25) DEFAULT NULL,
  `fec_expedicion` date DEFAULT NULL,
  `fec_vencimiento` date DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `id_empleados` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `licencia`
--

INSERT INTO `licencia` (`id`, `numero`, `fec_expedicion`, `fec_vencimiento`, `estado`, `id_empleados`) VALUES
(1, 1019037667, '2016-10-04', '2017-12-06', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `modulo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `modulo`) VALUES
(1, 'Parque Automotor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `nit` varchar(25) DEFAULT NULL,
  `consec_transito` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajeros`
--

CREATE TABLE `pasajeros` (
  `id` int(11) NOT NULL,
  `cedula` int(15) DEFAULT '0',
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `tipo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pasajeros`
--

INSERT INTO `pasajeros` (`id`, `cedula`, `nombres`, `apellidos`, `direccion`, `telefono`, `tipo`) VALUES
(1, 12345, 'Miguel', 'Ojeda', 'Calle 12 23-34', '3005461234', ''),
(2, 123, 'Ana', 'Guzman', '', '', ''),
(3, 1234, 'Juan', 'Tolomeo', 'Carrera 65', '45667', ''),
(4, 123456, 'Camilo', 'Torres', 'Calle', '878', '1'),
(5, 1234567, 'Pablo', 'Acosta', 'Avenida', '873', '1'),
(6, 12345678, 'Sebastian', 'Villegas', '', '', '1'),
(7, 1233, 'Marta', 'Moncaleano', '', '', '1'),
(8, 12344, 'Carlos', 'Vargas', '', '', '1'),
(9, 12334, 'Sandra', 'Camacho', '', '', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `permiso` varchar(50) NOT NULL,
  `key` varchar(25) DEFAULT NULL,
  `id_modulos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `permiso`, `key`, `id_modulos`) VALUES
(1, 'vehículos', 'automotores', 1),
(2, 'aseguradoras', 'aseguradoras', 1),
(3, 'seguros', 'seguros', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_roles`
--

CREATE TABLE `permisos_roles` (
  `id_rol` int(11) DEFAULT NULL,
  `id_permisos` int(11) DEFAULT NULL,
  `agregar` tinyint(4) DEFAULT '0',
  `consultar` tinyint(4) DEFAULT '0',
  `modificar` tinyint(4) DEFAULT '0',
  `eliminar` tinyint(4) DEFAULT '0',
  `imprimir` tinyint(4) DEFAULT '0',
  `exportar` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos_roles`
--

INSERT INTO `permisos_roles` (`id_rol`, `id_permisos`, `agregar`, `consultar`, `modificar`, `eliminar`, `imprimir`, `exportar`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1),
(1, 2, 1, 1, 1, 1, 1, 1),
(1, 3, 1, 1, 1, 1, 1, 1),
(2, 1, 1, 1, 1, 0, 0, 0),
(2, 2, 1, 1, 1, 0, 0, 0),
(2, 3, 1, 1, 1, 0, 0, 0),
(3, 1, 0, 1, 0, 0, 0, 0),
(3, 2, 1, 1, 0, 0, 0, 0),
(3, 3, 1, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_usuarios`
--

CREATE TABLE `permisos_usuarios` (
  `id_usuarios` int(11) DEFAULT NULL,
  `id_permisos` int(11) DEFAULT NULL,
  `agregar` tinyint(4) DEFAULT '0',
  `consultar` tinyint(4) DEFAULT '0',
  `modificar` tinyint(4) DEFAULT '0',
  `eliminar` tinyint(4) DEFAULT '0',
  `imprimir` tinyint(4) DEFAULT '0',
  `exportar` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planillas`
--

CREATE TABLE `planillas` (
  `id` int(11) NOT NULL,
  `contrato` int(15) DEFAULT NULL,
  `id_automotor` int(11) DEFAULT NULL,
  `consec_transito` int(45) DEFAULT NULL,
  `fec_inicial` date DEFAULT NULL,
  `fec_final` date DEFAULT NULL,
  `id_recorridos` int(11) DEFAULT NULL,
  `convenio` varchar(45) DEFAULT NULL,
  `fec_registro` timestamp NULL DEFAULT NULL,
  `id_contratante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `planillas`
--

INSERT INTO `planillas` (`id`, `contrato`, `id_automotor`, `consec_transito`, `fec_inicial`, `fec_final`, `id_recorridos`, `convenio`, `fec_registro`, `id_contratante`) VALUES
(1, 1, 2, 9739, '2017-02-08', '2017-02-08', 1, '1', '0000-00-00 00:00:00', 1),
(2, 2, 2, 9739, '2017-02-08', '2017-02-08', 2, '1', '0000-00-00 00:00:00', 3),
(3, 3, 4, 9739, '2017-02-08', '2017-02-08', 1, '1', '0000-00-00 00:00:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_conductores`
--

CREATE TABLE `planilla_conductores` (
  `id` int(11) NOT NULL,
  `id_planillas` int(11) DEFAULT NULL,
  `id_empleados` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `planilla_conductores`
--

INSERT INTO `planilla_conductores` (`id`, `id_planillas`, `id_empleados`) VALUES
(1, 1, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_pasajeros`
--

CREATE TABLE `planilla_pasajeros` (
  `id` int(11) NOT NULL,
  `id_planillas` int(11) DEFAULT NULL,
  `id_pasajeros` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `planilla_pasajeros`
--

INSERT INTO `planilla_pasajeros` (`id`, `id_planillas`, `id_pasajeros`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 3, 2),
(4, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorridos`
--

CREATE TABLE `recorridos` (
  `id` int(11) NOT NULL,
  `recorrido` varchar(100) NOT NULL,
  `origen` varchar(50) DEFAULT NULL,
  `destino` varchar(50) DEFAULT NULL,
  `valor` int(15) DEFAULT NULL,
  `ano` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recorridos`
--

INSERT INTO `recorridos` (`id`, `recorrido`, `origen`, `destino`, `valor`, `ano`) VALUES
(1, 'Fusagasugá - Pasca', 'Fusagasugá', 'Pasca', 12500, 2016),
(2, 'Buenas Tardes- Alaska- Sauces', 'Pasca', 'Fusagasugá', 12500, 2016);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `rol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'ESPECIAL'),
(3, 'USUARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soat`
--

CREATE TABLE `soat` (
  `id` int(11) NOT NULL,
  `poliza` varchar(25) NOT NULL DEFAULT 'NULL',
  `fec_expedicion` date DEFAULT NULL,
  `fec_vencimiento` date DEFAULT NULL,
  `id_automotor` int(11) DEFAULT NULL,
  `id_aseguradoras` int(11) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `soat`
--

INSERT INTO `soat` (`id`, `poliza`, `fec_expedicion`, `fec_vencimiento`, `id_automotor`, `id_aseguradoras`, `estado`) VALUES
(1, '0001', '2016-11-06', '2017-11-05', 1, 1, 1),
(2, '0000', '2015-11-06', '2016-11-05', 1, 1, 0),
(3, '0002', '2016-06-06', '2017-02-08', 2, 1, 1),
(4, '00004', '2016-01-07', '2017-01-07', 5, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta_operacion`
--

CREATE TABLE `tarjeta_operacion` (
  `id` int(11) NOT NULL,
  `tarjeta` varchar(25) DEFAULT NULL,
  `capacidad` int(2) DEFAULT NULL,
  `fec_expedicion` date DEFAULT NULL,
  `fec_vencimiento` date DEFAULT NULL,
  `id_automotor` int(11) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tarjeta_operacion`
--

INSERT INTO `tarjeta_operacion` (`id`, `tarjeta`, `capacidad`, `fec_expedicion`, `fec_vencimiento`, `id_automotor`, `estado`) VALUES
(1, 'TO1234', 5, '2016-06-07', '2017-06-07', 1, 1),
(2, 'TO1235', 4, '2016-06-16', '2017-03-03', 4, 0),
(3, 'TO1236', 7, '2016-11-04', '2017-07-17', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnomecanica`
--

CREATE TABLE `tecnomecanica` (
  `id` int(11) NOT NULL,
  `consecutivo` int(20) NOT NULL,
  `fec_expedicion` date NOT NULL,
  `fec_vencimiento` date NOT NULL,
  `id_automotor` int(11) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tecnomecanica`
--

INSERT INTO `tecnomecanica` (`id`, `consecutivo`, `fec_expedicion`, `fec_vencimiento`, `id_automotor`, `estado`) VALUES
(1, 125362, '2017-02-01', '2018-02-01', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `id_empleados` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `id_rol`, `id_empleados`, `estado`) VALUES
(1, 'super', '4dde59bcddc7c2b009308c30847c8bddd56c37e1', 1, 1, 1),
(2, 'admin', '4dde59bcddc7c2b009308c30847c8bddd56c37e1', 2, 2, 1),
(3, '1069', '4dde59bcddc7c2b009308c30847c8bddd56c37e1', 3, 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aseguradoras`
--
ALTER TABLE `aseguradoras`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_modulos` (`id_modulos`);

--
-- Indices de la tabla `permisos_roles`
--
ALTER TABLE `permisos_roles`
  ADD UNIQUE KEY `id_rol` (`id_rol`,`id_permisos`),
  ADD KEY `id_permisos` (`id_permisos`);

--
-- Indices de la tabla `permisos_usuarios`
--
ALTER TABLE `permisos_usuarios`
  ADD UNIQUE KEY `id_usuarios` (`id_usuarios`,`id_permisos`),
  ADD KEY `id_permisos` (`id_permisos`);

--
-- Indices de la tabla `planillas`
--
ALTER TABLE `planillas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_automotor` (`id_automotor`),
  ADD KEY `id_recorridos` (`id_recorridos`),
  ADD KEY `id_contratante` (`id_contratante`);

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
-- Indices de la tabla `recorridos`
--
ALTER TABLE `recorridos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `soat`
--
ALTER TABLE `soat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_automotor` (`id_automotor`),
  ADD KEY `id_aseguradoras` (`id_aseguradoras`);

--
-- Indices de la tabla `tarjeta_operacion`
--
ALTER TABLE `tarjeta_operacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_automotor` (`id_automotor`);

--
-- Indices de la tabla `tecnomecanica`
--
ALTER TABLE `tecnomecanica`
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
-- AUTO_INCREMENT de la tabla `aseguradoras`
--
ALTER TABLE `aseguradoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `automotor`
--
ALTER TABLE `automotor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pasajeros`
--
ALTER TABLE `pasajeros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `planillas`
--
ALTER TABLE `planillas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `planilla_conductores`
--
ALTER TABLE `planilla_conductores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `planilla_pasajeros`
--
ALTER TABLE `planilla_pasajeros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `recorridos`
--
ALTER TABLE `recorridos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `soat`
--
ALTER TABLE `soat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tarjeta_operacion`
--
ALTER TABLE `tarjeta_operacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tecnomecanica`
--
ALTER TABLE `tecnomecanica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD CONSTRAINT `licencia_ibfk_1` FOREIGN KEY (`id_empleados`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_modulos`) REFERENCES `modulos` (`id`);

--
-- Filtros para la tabla `permisos_roles`
--
ALTER TABLE `permisos_roles`
  ADD CONSTRAINT `permisos_roles_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `permisos_roles_ibfk_2` FOREIGN KEY (`id_permisos`) REFERENCES `permisos` (`id`);

--
-- Filtros para la tabla `permisos_usuarios`
--
ALTER TABLE `permisos_usuarios`
  ADD CONSTRAINT `permisos_usuarios_ibfk_1` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `permisos_usuarios_ibfk_2` FOREIGN KEY (`id_permisos`) REFERENCES `permisos` (`id`);

--
-- Filtros para la tabla `planillas`
--
ALTER TABLE `planillas`
  ADD CONSTRAINT `planillas_ibfk_1` FOREIGN KEY (`id_automotor`) REFERENCES `automotor` (`id`),
  ADD CONSTRAINT `planillas_ibfk_2` FOREIGN KEY (`id_recorridos`) REFERENCES `recorridos` (`id`),
  ADD CONSTRAINT `planillas_ibfk_3` FOREIGN KEY (`id_contratante`) REFERENCES `pasajeros` (`id`);

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
-- Filtros para la tabla `soat`
--
ALTER TABLE `soat`
  ADD CONSTRAINT `soat_ibfk_1` FOREIGN KEY (`id_automotor`) REFERENCES `automotor` (`id`),
  ADD CONSTRAINT `soat_ibfk_2` FOREIGN KEY (`id_aseguradoras`) REFERENCES `aseguradoras` (`id`);

--
-- Filtros para la tabla `tarjeta_operacion`
--
ALTER TABLE `tarjeta_operacion`
  ADD CONSTRAINT `tarjeta_operacion_ibfk_1` FOREIGN KEY (`id_automotor`) REFERENCES `automotor` (`id`);

--
-- Filtros para la tabla `tecnomecanica`
--
ALTER TABLE `tecnomecanica`
  ADD CONSTRAINT `tecnomecanica_ibfk_1` FOREIGN KEY (`id_automotor`) REFERENCES `automotor` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_empleados`) REFERENCES `empleados` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
