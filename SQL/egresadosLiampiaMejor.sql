-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2018 a las 03:11:15
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `egresados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `cve_carrera` int(11) NOT NULL,
  `cve_facultad` int(11) NOT NULL,
  `Nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`cve_carrera`, `cve_facultad`, `Nombre`) VALUES
(1, 1, 'Cibernetica y Sistemas Computacionales'),
(2, 1, 'Civil'),
(3, 1, 'Biomedica'),
(4, 1, 'Industrial'),
(5, 1, 'Mecanica'),
(6, 1, 'Mecatronica'),
(7, 1, 'Electronica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `educacion`
--

CREATE TABLE `educacion` (
  `cve_educacion` int(11) NOT NULL,
  `Gen_inicio` varchar(50) NOT NULL,
  `Gen_fin` varchar(50) NOT NULL,
  `cve_egresado` int(11) NOT NULL,
  `cve_carrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `educacion`
--

INSERT INTO `educacion` (`cve_educacion`, `Gen_inicio`, `Gen_fin`, `cve_egresado`, `cve_carrera`) VALUES
(1, '2014-08', '2018-12', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresado`
--

CREATE TABLE `egresado` (
  `Nombre` varchar(250) NOT NULL,
  `Apellidos` varchar(250) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Genero` varchar(50) NOT NULL,
  `Info` varchar(20) DEFAULT NULL,
  `cve_egresado` int(11) NOT NULL,
  `correo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `egresado`
--

INSERT INTO `egresado` (`Nombre`, `Apellidos`, `FechaNacimiento`, `Genero`, `Info`, `cve_egresado`, `correo`) VALUES
('Eduardo', 'Morales Ensastiga', '1996-09-29', 'Hombre', 'Si', 1, 'e.d.moen@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `cve_empresa` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `cve_pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`cve_empresa`, `nombre`, `cve_pais`) VALUES
(1, 'Bancomer proximamente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `cve_facultad` int(11) NOT NULL,
  `Nombre` varchar(250) NOT NULL,
  `cve_institucion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`cve_facultad`, `Nombre`, `cve_institucion`) VALUES
(1, 'Ingeneiria', 1),
(2, 'FAMADyC', 1),
(3, 'Medicina', 1),
(4, 'Negocios', 1),
(5, 'Ciencias Quimicas', 1),
(6, 'Derecho', 1),
(7, 'Humanidades', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `Nombre` varchar(250) NOT NULL,
  `cve_institucion` int(11) NOT NULL,
  `cve_pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`Nombre`, `cve_institucion`, `cve_pais`) VALUES
('Universidad La Salle', 1, 1),
('MIT', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `user` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `cve_pais` int(11) NOT NULL,
  `Nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`cve_pais`, `Nombre`) VALUES
(1, 'Mexico'),
(2, 'Estados Unidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `cve_puesto` int(11) NOT NULL,
  `cve_empresa` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(1024) NOT NULL,
  `cve_egresado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`cve_puesto`, `cve_empresa`, `nombre`, `descripcion`, `cve_egresado`) VALUES
(1, 1, 'Becario', 'salu2', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`cve_carrera`),
  ADD KEY `cve_facultad` (`cve_facultad`);

--
-- Indices de la tabla `educacion`
--
ALTER TABLE `educacion`
  ADD PRIMARY KEY (`cve_educacion`),
  ADD KEY `cve_carrera` (`cve_carrera`),
  ADD KEY `cve_egresado` (`cve_egresado`);

--
-- Indices de la tabla `egresado`
--
ALTER TABLE `egresado`
  ADD PRIMARY KEY (`cve_egresado`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`cve_empresa`),
  ADD KEY `cve_pais` (`cve_pais`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`cve_facultad`),
  ADD KEY `cve_institucion` (`cve_institucion`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`cve_institucion`),
  ADD KEY `cve_pais` (`cve_pais`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`cve_pais`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`cve_puesto`),
  ADD KEY `cve_egresado` (`cve_egresado`),
  ADD KEY `cve_empresa` (`cve_empresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `cve_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `educacion`
--
ALTER TABLE `educacion`
  MODIFY `cve_educacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `egresado`
--
ALTER TABLE `egresado`
  MODIFY `cve_egresado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `cve_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `cve_facultad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `cve_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `cve_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `cve_puesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD CONSTRAINT `carrera_ibfk_1` FOREIGN KEY (`cve_facultad`) REFERENCES `facultad` (`cve_facultad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `educacion`
--
ALTER TABLE `educacion`
  ADD CONSTRAINT `educacion_ibfk_1` FOREIGN KEY (`cve_carrera`) REFERENCES `carrera` (`cve_carrera`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `educacion_ibfk_2` FOREIGN KEY (`cve_egresado`) REFERENCES `egresado` (`cve_egresado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`cve_pais`) REFERENCES `pais` (`cve_pais`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD CONSTRAINT `facultad_ibfk_1` FOREIGN KEY (`cve_institucion`) REFERENCES `institucion` (`cve_institucion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD CONSTRAINT `institucion_ibfk_1` FOREIGN KEY (`cve_pais`) REFERENCES `pais` (`cve_pais`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD CONSTRAINT `puesto_ibfk_1` FOREIGN KEY (`cve_egresado`) REFERENCES `egresado` (`cve_egresado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `puesto_ibfk_2` FOREIGN KEY (`cve_empresa`) REFERENCES `empresa` (`cve_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
