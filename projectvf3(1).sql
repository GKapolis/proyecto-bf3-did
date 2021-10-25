-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2021 a las 08:14:52
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `projectvf3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `nombreGrupo` varchar(8) NOT NULL,
  `nombredescriptivoGrupo` varchar(32) NOT NULL,
  `Materias_idMaterias` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `idHorarios` int(11) NOT NULL,
  `inicioHorarios` time NOT NULL,
  `terminaHorarios` time NOT NULL,
  `turnoHorarios` int(2) DEFAULT NULL,
  `horaHorarios` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idHorarios`, `inicioHorarios`, `terminaHorarios`, `turnoHorarios`, `horaHorarios`) VALUES
(1, '16:40:00', '16:50:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `idMaterias` int(11) NOT NULL,
  `NombreMateria` varchar(45) NOT NULL,
  `profesores_idProfesores` int(11) DEFAULT NULL,
  `Horarios_idHorarios` int(11) DEFAULT NULL,
  `diaMateria` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `idProfesores` int(11) NOT NULL,
  `nombreProfesores` varchar(45) NOT NULL,
  `apellidoProfesores` varchar(45) NOT NULL,
  `asisteProfesores` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `NOMBREusuarios` varchar(16) NOT NULL,
  `NOMBREREALusuarios` varchar(16) NOT NULL,
  `CORREOusuarios` varchar(32) NOT NULL,
  `CLAVEusuarios` varchar(255) NOT NULL,
  `create_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`NOMBREusuarios`, `NOMBREREALusuarios`, `CORREOusuarios`, `CLAVEusuarios`, `create_time`) VALUES
('gka', 'luka', 'asociadogamer@hotmail.com', '$2y$10$dJWUkW1PncgxJWIuHammbO/8x5L.c.j2bpqtgM5ubKQ88YIqRp55a', '2021-10-24 07:50:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`nombreGrupo`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombreGrupo`),
  ADD KEY `fk_grupo_Materias1_idx` (`Materias_idMaterias`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idHorarios`),
  ADD UNIQUE KEY `idHorarios_UNIQUE` (`idHorarios`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`idMaterias`),
  ADD KEY `fk_Materias_profesores1_idx` (`profesores_idProfesores`),
  ADD KEY `fk_Materiales_horarios` (`Horarios_idHorarios`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`idProfesores`),
  ADD UNIQUE KEY `idprofesores_UNIQUE` (`idProfesores`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`NOMBREusuarios`),
  ADD UNIQUE KEY `username_UNIQUE` (`NOMBREusuarios`),
  ADD UNIQUE KEY `email_UNIQUE` (`CORREOusuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idHorarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `idProfesores` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `fk_grupo_Materias1` FOREIGN KEY (`Materias_idMaterias`) REFERENCES `materias` (`idMaterias`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `fk_Materiales_horarios` FOREIGN KEY (`Horarios_idHorarios`) REFERENCES `horarios` (`idHorarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Materias_profesores1` FOREIGN KEY (`profesores_idProfesores`) REFERENCES `profesores` (`idProfesores`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
