-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2022 a las 19:37:49
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `php_evento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mis_eventos`
--

CREATE TABLE `mis_eventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `inicio` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `hora` int(4) NOT NULL,
  `vehiculo` int(4) NOT NULL,
  `reparacion` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mis_eventos`
--

INSERT INTO `mis_eventos` (`id`, `titulo`, `color`, `inicio`, `fin`, `hora`, `vehiculo`, `reparacion`) VALUES
(1, 'Reunion Colegio', '#0071c5', '2018-04-23 09:00:00', '2018-04-23 11:00:00', 0, 0, 0),
(2, 'Gimnasio Gym', '#40e0d0', '2018-04-13 14:00:00', '2018-04-13 17:00:00', 0, 0, 0),
(3, 'Reunion accionistas', '#FFD700', '2018-04-23 08:00:00', '2018-04-23 09:00:00', 0, 0, 0),
(4, 'Reunion acreedores', '#40e0d0', '2018-04-23 10:00:00', '2018-04-23 11:00:00', 0, 0, 0),
(5, 'Reunion con el Banco', '#0071c5', '2018-04-23 11:00:00', '2018-04-13 12:00:00', 0, 0, 0),
(6, 'Reunion con amigos', '#FFD700', '2018-04-23 13:00:00', '2018-04-23 14:00:00', 0, 0, 0),
(7, 'Reunion de trabajo', '#0071c5', '2018-04-23 14:00:00', '2018-04-23 15:00:00', 0, 0, 0),
(8, 'Reunion semanal', '#FFD700', '2018-04-23 16:00:00', '2018-04-23 17:00:00', 0, 0, 0),
(9, 'Pago de telefono', '#228B22', '2018-04-24 18:00:00', '2018-04-24 20:00:00', 0, 0, 0),
(10, 'JUAN CARLOS', '#FF4500', '2022-11-01 00:00:00', '2022-11-02 00:00:00', 0, 0, 0),
(11, '21', '#FFD700', '2022-11-01 00:00:00', '2022-11-02 00:00:00', 0, 0, 0),
(12, 'dfsad', '#FFD700', '2022-11-22 00:00:00', '2022-11-23 00:00:00', 0, 0, 0),
(13, 'A', '#FFD700', '2022-11-24 00:00:00', '2022-11-25 00:00:00', 0, 0, 0),
(14, 'a', '#FFD700', '2022-11-07 00:00:00', '2022-11-08 00:00:00', 0, 0, 0),
(15, 'AJO', '#FF4500', '2022-11-15 00:00:00', '2022-11-16 00:00:00', 0, 0, 0),
(16, 'AJOJOJO', '#436EEE', '2022-11-15 00:00:00', '2022-11-16 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparaciones`
--

CREATE TABLE `reparaciones` (
  `id_reparacion` int(4) NOT NULL,
  `reparacion` varchar(200) NOT NULL,
  `precio` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reparaciones`
--

INSERT INTO `reparaciones` (`id_reparacion`, `reparacion`, `precio`) VALUES
(1, 'CAMBIO PASTILLAS DE FRENO 1', 100),
(2, 'CAMBIO DE ACEITE 2', 200),
(3, 'MONTAJE NEUMATICOS 3', 300),
(4, 'CAMBIO DE BUJIAS 4', 400),
(5, 'REVISION PRE ITV 5', 500),
(6, 'CAMBIO CORREA DISTRIBUCION 6', 600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id_vehiculo` int(4) NOT NULL,
  `matricula` varchar(200) NOT NULL,
  `propietario` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id_vehiculo`, `matricula`, `propietario`) VALUES
(1, 'MATRICULA 1', 1),
(2, 'MATRICULA 2', 2),
(3, 'MATRICULA 3', 3),
(4, 'MATRICULA 4', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mis_eventos`
--
ALTER TABLE `mis_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD PRIMARY KEY (`id_reparacion`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id_vehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mis_eventos`
--
ALTER TABLE `mis_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  MODIFY `id_reparacion` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id_vehiculo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
