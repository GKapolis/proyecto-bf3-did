-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2021 a las 11:37:52
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
-- Estructura de tabla para la tabla `grupo_has_materias`
--

CREATE TABLE `grupo_has_materias` (
  `grupo_nombreGrupo` varchar(8) NOT NULL,
  `Materias_idMaterias` int(11) NOT NULL
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
  `horaHorarios` int(2) DEFAULT NULL,
  `diaHorarios` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idHorarios`, `inicioHorarios`, `terminaHorarios`, `turnoHorarios`, `horaHorarios`, `diaHorarios`) VALUES
(142, '07:30:00', '08:15:00', 1, 1, 1),
(143, '07:30:00', '08:15:00', 1, 1, 2),
(144, '07:30:00', '08:15:00', 1, 1, 3),
(145, '07:30:00', '08:15:00', 1, 1, 4),
(146, '07:30:00', '08:15:00', 1, 1, 5),
(147, '07:30:00', '08:15:00', 1, 1, 6),
(148, '08:15:00', '09:00:00', 1, 2, 1),
(149, '08:15:00', '09:00:00', 1, 2, 2),
(150, '08:15:00', '09:00:00', 1, 2, 3),
(151, '08:15:00', '09:00:00', 1, 2, 4),
(152, '08:15:00', '09:00:00', 1, 2, 5),
(153, '08:15:00', '09:00:00', 1, 2, 6),
(154, '09:05:00', '09:50:00', 1, 3, 1),
(155, '09:05:00', '09:50:00', 1, 3, 2),
(156, '09:05:00', '09:50:00', 1, 3, 3),
(157, '09:05:00', '09:50:00', 1, 3, 4),
(158, '09:05:00', '09:50:00', 1, 3, 5),
(159, '09:05:00', '09:50:00', 1, 3, 6),
(160, '09:50:00', '10:35:00', 1, 4, 1),
(161, '09:50:00', '10:35:00', 1, 4, 2),
(162, '09:50:00', '10:35:00', 1, 4, 3),
(163, '09:50:00', '10:35:00', 1, 4, 4),
(164, '09:50:00', '10:35:00', 1, 4, 5),
(165, '09:50:00', '10:35:00', 1, 4, 6),
(166, '10:40:00', '11:25:00', 1, 5, 1),
(167, '10:40:00', '11:25:00', 1, 5, 2),
(168, '10:40:00', '11:25:00', 1, 5, 3),
(169, '10:40:00', '11:25:00', 1, 5, 4),
(170, '10:40:00', '11:25:00', 1, 5, 5),
(171, '10:40:00', '11:25:00', 1, 5, 6),
(172, '11:25:00', '12:10:00', 1, 6, 1),
(173, '11:25:00', '12:10:00', 1, 6, 2),
(174, '11:25:00', '12:10:00', 1, 6, 3),
(175, '11:25:00', '12:10:00', 1, 6, 4),
(176, '11:25:00', '12:10:00', 1, 6, 5),
(177, '11:25:00', '12:10:00', 1, 6, 6),
(178, '12:15:00', '13:00:00', 1, 7, 1),
(179, '12:15:00', '13:00:00', 1, 7, 2),
(180, '12:15:00', '13:00:00', 1, 7, 3),
(181, '12:15:00', '13:00:00', 1, 7, 4),
(182, '12:15:00', '13:00:00', 1, 7, 5),
(183, '12:15:00', '13:00:00', 1, 7, 6),
(184, '13:00:00', '13:45:00', 1, 8, 1),
(185, '13:00:00', '13:45:00', 1, 8, 2),
(186, '13:00:00', '13:45:00', 1, 8, 3),
(187, '13:00:00', '13:45:00', 1, 8, 4),
(188, '13:00:00', '13:45:00', 1, 8, 5),
(189, '13:00:00', '13:45:00', 1, 8, 6),
(190, '13:45:00', '14:30:00', 1, 9, 1),
(191, '13:45:00', '14:30:00', 1, 9, 2),
(192, '13:45:00', '14:30:00', 1, 9, 3),
(193, '13:45:00', '14:30:00', 1, 9, 4),
(194, '13:45:00', '14:30:00', 1, 9, 5),
(195, '13:45:00', '14:30:00', 1, 9, 6),
(196, '09:05:00', '09:50:00', 2, 1, 1),
(197, '09:05:00', '09:50:00', 2, 1, 2),
(198, '09:05:00', '09:50:00', 2, 1, 3),
(199, '09:05:00', '09:50:00', 2, 1, 4),
(200, '09:05:00', '09:50:00', 2, 1, 5),
(201, '09:05:00', '09:50:00', 2, 1, 6),
(202, '09:50:00', '10:35:00', 2, 2, 1),
(203, '09:50:00', '10:35:00', 2, 2, 2),
(204, '09:50:00', '10:35:00', 2, 2, 3),
(205, '09:50:00', '10:35:00', 2, 2, 4),
(206, '09:50:00', '10:35:00', 2, 2, 5),
(207, '09:50:00', '10:35:00', 2, 2, 6),
(208, '10:40:00', '11:25:00', 2, 3, 1),
(209, '10:40:00', '11:25:00', 2, 3, 2),
(210, '10:40:00', '11:25:00', 2, 3, 3),
(211, '10:40:00', '11:25:00', 2, 3, 4),
(212, '10:40:00', '11:25:00', 2, 3, 5),
(213, '10:40:00', '11:25:00', 2, 3, 6),
(214, '11:25:00', '12:10:00', 2, 4, 1),
(215, '11:25:00', '12:10:00', 2, 4, 2),
(216, '11:25:00', '12:10:00', 2, 4, 3),
(217, '11:25:00', '12:10:00', 2, 4, 4),
(218, '11:25:00', '12:10:00', 2, 4, 5),
(219, '11:25:00', '12:10:00', 2, 4, 6),
(220, '12:15:00', '13:00:00', 2, 5, 1),
(221, '12:15:00', '13:00:00', 2, 5, 2),
(222, '12:15:00', '13:00:00', 2, 5, 3),
(223, '12:15:00', '13:00:00', 2, 5, 4),
(224, '12:15:00', '13:00:00', 2, 5, 5),
(225, '12:15:00', '13:00:00', 2, 5, 6),
(226, '13:00:00', '13:45:00', 2, 6, 1),
(227, '13:00:00', '13:45:00', 2, 6, 2),
(228, '13:00:00', '13:45:00', 2, 6, 3),
(229, '13:00:00', '13:45:00', 2, 6, 4),
(230, '13:00:00', '13:45:00', 2, 6, 5),
(231, '13:00:00', '13:45:00', 2, 6, 6),
(232, '13:45:00', '14:30:00', 2, 7, 1),
(233, '13:45:00', '14:30:00', 2, 7, 2),
(234, '13:45:00', '14:30:00', 2, 7, 3),
(235, '13:45:00', '14:30:00', 2, 7, 4),
(236, '13:45:00', '14:30:00', 2, 7, 5),
(237, '13:45:00', '14:30:00', 2, 7, 6),
(238, '14:35:00', '15:20:00', 2, 8, 1),
(239, '14:35:00', '15:20:00', 2, 8, 2),
(240, '14:35:00', '15:20:00', 2, 8, 3),
(241, '14:35:00', '15:20:00', 2, 8, 4),
(242, '14:35:00', '15:20:00', 2, 8, 5),
(243, '14:35:00', '15:20:00', 2, 8, 6),
(244, '15:20:00', '16:05:00', 2, 9, 1),
(245, '15:20:00', '16:05:00', 2, 9, 2),
(246, '15:20:00', '16:05:00', 2, 9, 3),
(247, '15:20:00', '16:05:00', 2, 9, 4),
(248, '15:20:00', '16:05:00', 2, 9, 5),
(249, '15:20:00', '16:05:00', 2, 9, 6),
(250, '12:15:00', '13:00:00', 3, 1, 1),
(251, '12:15:00', '13:00:00', 3, 1, 2),
(252, '12:15:00', '13:00:00', 3, 1, 3),
(253, '12:15:00', '13:00:00', 3, 1, 4),
(254, '12:15:00', '13:00:00', 3, 1, 5),
(255, '12:15:00', '13:00:00', 3, 1, 6),
(256, '13:00:00', '13:45:00', 3, 2, 1),
(257, '13:00:00', '13:45:00', 3, 2, 2),
(258, '13:00:00', '13:45:00', 3, 2, 3),
(259, '13:00:00', '13:45:00', 3, 2, 4),
(260, '13:00:00', '13:45:00', 3, 2, 5),
(261, '13:00:00', '13:45:00', 3, 2, 6),
(262, '14:35:00', '15:20:00', 3, 4, 1),
(263, '14:35:00', '15:20:00', 3, 4, 2),
(264, '14:35:00', '15:20:00', 3, 4, 3),
(265, '14:35:00', '15:20:00', 3, 4, 4),
(266, '14:35:00', '15:20:00', 3, 4, 5),
(267, '14:35:00', '15:20:00', 3, 4, 6),
(268, '15:20:00', '16:05:00', 3, 5, 1),
(269, '15:20:00', '16:05:00', 3, 5, 2),
(270, '15:20:00', '16:05:00', 3, 5, 3),
(271, '15:20:00', '16:05:00', 3, 5, 4),
(272, '15:20:00', '16:05:00', 3, 5, 5),
(273, '15:20:00', '16:05:00', 3, 5, 6),
(274, '16:10:00', '16:55:00', 3, 6, 1),
(275, '16:10:00', '16:55:00', 3, 6, 2),
(276, '16:10:00', '16:55:00', 3, 6, 3),
(277, '16:10:00', '16:55:00', 3, 6, 4),
(278, '16:10:00', '16:55:00', 3, 6, 5),
(279, '16:10:00', '16:55:00', 3, 6, 6),
(280, '16:55:00', '17:40:00', 3, 7, 1),
(281, '16:55:00', '17:40:00', 3, 7, 2),
(282, '16:55:00', '17:40:00', 3, 7, 3),
(283, '16:55:00', '17:40:00', 3, 7, 4),
(284, '16:55:00', '17:40:00', 3, 7, 5),
(285, '16:55:00', '17:40:00', 3, 7, 6),
(286, '13:45:00', '14:30:00', 3, 3, 1),
(287, '13:45:00', '14:30:00', 3, 3, 2),
(288, '13:45:00', '14:30:00', 3, 3, 3),
(289, '13:45:00', '14:30:00', 3, 3, 4),
(290, '13:45:00', '14:30:00', 3, 3, 5),
(291, '13:45:00', '14:30:00', 3, 3, 6),
(292, '17:45:00', '18:30:00', 3, 8, 1),
(293, '17:45:00', '18:30:00', 3, 8, 2),
(294, '17:45:00', '18:30:00', 3, 8, 3),
(295, '17:45:00', '18:30:00', 3, 8, 4),
(296, '17:45:00', '18:30:00', 3, 8, 5),
(297, '17:45:00', '18:30:00', 3, 8, 6),
(298, '18:30:00', '19:10:00', 3, 9, 1),
(299, '18:30:00', '19:10:00', 3, 9, 2),
(300, '18:30:00', '19:10:00', 3, 9, 3),
(301, '18:30:00', '19:10:00', 3, 9, 4),
(302, '18:30:00', '19:10:00', 3, 9, 5),
(303, '18:30:00', '19:10:00', 3, 9, 6),
(304, '16:10:00', '16:55:00', 4, 1, 1),
(305, '16:10:00', '16:55:00', 4, 1, 2),
(306, '16:10:00', '16:55:00', 4, 1, 3),
(307, '16:10:00', '16:55:00', 4, 1, 4),
(308, '16:10:00', '16:55:00', 4, 1, 5),
(309, '16:10:00', '16:55:00', 4, 1, 6),
(310, '16:55:00', '17:40:00', 4, 2, 1),
(311, '16:55:00', '17:40:00', 4, 2, 2),
(312, '16:55:00', '17:40:00', 4, 2, 3),
(313, '16:55:00', '17:40:00', 4, 2, 4),
(314, '16:55:00', '17:40:00', 4, 2, 5),
(315, '16:55:00', '17:40:00', 4, 2, 6),
(316, '17:45:00', '18:30:00', 4, 3, 1),
(317, '17:45:00', '18:30:00', 4, 3, 2),
(318, '17:45:00', '18:30:00', 4, 3, 3),
(319, '17:45:00', '18:30:00', 4, 3, 4),
(320, '17:45:00', '18:30:00', 4, 3, 5),
(321, '17:45:00', '18:30:00', 4, 3, 6),
(322, '18:30:00', '19:10:00', 4, 4, 1),
(323, '18:30:00', '19:10:00', 4, 4, 2),
(324, '18:30:00', '19:10:00', 4, 4, 3),
(325, '18:30:00', '19:10:00', 4, 4, 4),
(326, '18:30:00', '19:10:00', 4, 4, 5),
(327, '18:30:00', '19:10:00', 4, 4, 6),
(328, '19:10:00', '19:50:00', 4, 5, 1),
(329, '19:10:00', '19:50:00', 4, 5, 2),
(330, '19:10:00', '19:50:00', 4, 5, 3),
(331, '19:10:00', '19:50:00', 4, 5, 4),
(332, '19:10:00', '19:50:00', 4, 5, 5),
(333, '19:10:00', '19:50:00', 4, 5, 6),
(334, '19:50:00', '20:30:00', 4, 6, 1),
(335, '19:50:00', '20:30:00', 4, 6, 2),
(336, '19:50:00', '20:30:00', 4, 6, 3),
(337, '19:50:00', '20:30:00', 4, 6, 4),
(338, '19:50:00', '20:30:00', 4, 6, 5),
(339, '19:50:00', '20:30:00', 4, 6, 6),
(340, '20:35:00', '21:15:00', 4, 7, 1),
(341, '20:35:00', '21:15:00', 4, 7, 2),
(342, '20:35:00', '21:15:00', 4, 7, 3),
(343, '20:35:00', '21:15:00', 4, 7, 4),
(344, '20:35:00', '21:15:00', 4, 7, 5),
(345, '20:35:00', '21:15:00', 4, 7, 6),
(346, '21:15:00', '21:55:00', 4, 8, 1),
(347, '21:15:00', '21:55:00', 4, 8, 2),
(348, '21:15:00', '21:55:00', 4, 8, 3),
(349, '21:15:00', '21:55:00', 4, 8, 4),
(350, '21:15:00', '21:55:00', 4, 8, 5),
(351, '21:15:00', '21:55:00', 4, 8, 6),
(352, '18:30:00', '19:10:00', 5, 1, 1),
(353, '18:30:00', '19:10:00', 5, 1, 2),
(354, '18:30:00', '19:10:00', 5, 1, 3),
(355, '18:30:00', '19:10:00', 5, 1, 4),
(356, '18:30:00', '19:10:00', 5, 1, 5),
(357, '18:30:00', '19:10:00', 5, 1, 6),
(358, '19:10:00', '19:50:00', 5, 2, 1),
(359, '19:10:00', '19:50:00', 5, 2, 2),
(360, '19:10:00', '19:50:00', 5, 2, 3),
(361, '19:10:00', '19:50:00', 5, 2, 4),
(362, '19:10:00', '19:50:00', 5, 2, 5),
(363, '19:10:00', '19:50:00', 5, 2, 6),
(364, '19:50:00', '20:30:00', 5, 3, 1),
(365, '19:50:00', '20:30:00', 5, 3, 2),
(366, '19:50:00', '20:30:00', 5, 3, 3),
(367, '19:50:00', '20:30:00', 5, 3, 4),
(368, '19:50:00', '20:30:00', 5, 3, 5),
(369, '19:50:00', '20:30:00', 5, 3, 6),
(370, '20:30:00', '21:10:00', 5, 4, 1),
(371, '20:30:00', '21:10:00', 5, 4, 2),
(372, '20:30:00', '21:10:00', 5, 4, 3),
(373, '20:30:00', '21:10:00', 5, 4, 4),
(374, '20:30:00', '21:10:00', 5, 4, 5),
(375, '20:30:00', '21:10:00', 5, 4, 6),
(376, '21:15:00', '21:55:00', 5, 5, 1),
(377, '21:15:00', '21:55:00', 5, 5, 2),
(378, '21:15:00', '21:55:00', 5, 5, 3),
(379, '21:15:00', '21:55:00', 5, 5, 4),
(380, '21:15:00', '21:55:00', 5, 5, 5),
(381, '21:15:00', '21:55:00', 5, 5, 6),
(382, '21:55:00', '22:35:00', 5, 6, 1),
(383, '21:55:00', '22:35:00', 5, 6, 2),
(384, '21:55:00', '22:35:00', 5, 6, 3),
(385, '21:55:00', '22:35:00', 5, 6, 4),
(386, '21:55:00', '22:35:00', 5, 6, 5),
(387, '21:55:00', '22:35:00', 5, 6, 6),
(388, '22:40:00', '23:20:00', 5, 7, 1),
(389, '22:40:00', '23:20:00', 5, 7, 2),
(390, '22:40:00', '23:20:00', 5, 7, 3),
(391, '22:40:00', '23:20:00', 5, 7, 4),
(392, '22:40:00', '23:20:00', 5, 7, 5),
(393, '22:40:00', '23:20:00', 5, 7, 6),
(394, '23:20:00', '24:00:00', 5, 8, 1),
(395, '23:20:00', '24:00:00', 5, 8, 2),
(396, '23:20:00', '24:00:00', 5, 8, 3),
(397, '23:20:00', '24:00:00', 5, 8, 4),
(398, '23:20:00', '24:00:00', 5, 8, 5),
(399, '23:20:00', '24:00:00', 5, 8, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `idMaterias` int(11) NOT NULL,
  `NombreMateria` varchar(45) NOT NULL,
  `profesores_idProfesores` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idMaterias`, `NombreMateria`, `profesores_idProfesores`) VALUES
(1, '3bf matematica', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_has_horarios`
--

CREATE TABLE `materias_has_horarios` (
  `Materias_idMaterias` int(11) NOT NULL,
  `Horarios_idHorarios` int(11) NOT NULL
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

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`idProfesores`, `nombreProfesores`, `apellidoProfesores`, `asisteProfesores`) VALUES
(1, 'gonzalo', 'marquez', 1),
(2, 'felipe', 'castro', 1),
(4, 'johnny', 'melavo', 1),
(6, 'felipe', 'newman', 1),
(9, 'Pedro', 'Alvez', 1),
(11, 'sett', 'navar', 1),
(14, 'larry', 'mortadela', 1);

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
-- Indices de la tabla `grupo_has_materias`
--
ALTER TABLE `grupo_has_materias`
  ADD PRIMARY KEY (`grupo_nombreGrupo`,`Materias_idMaterias`),
  ADD KEY `fk_grupo_has_Materias_Materias1_idx` (`Materias_idMaterias`),
  ADD KEY `fk_grupo_has_Materias_grupo1_idx` (`grupo_nombreGrupo`);

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
  ADD KEY `fk_Materias_profesores1_idx` (`profesores_idProfesores`);

--
-- Indices de la tabla `materias_has_horarios`
--
ALTER TABLE `materias_has_horarios`
  ADD PRIMARY KEY (`Materias_idMaterias`,`Horarios_idHorarios`),
  ADD KEY `fk_Materias_has_Horarios_Horarios1_idx` (`Horarios_idHorarios`),
  ADD KEY `fk_Materias_has_Horarios_Materias1_idx` (`Materias_idMaterias`);

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
  MODIFY `idHorarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `idMaterias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `idProfesores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `fk_Materias` FOREIGN KEY (`Materias_idMaterias`) REFERENCES `materias` (`idMaterias`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo_has_materias`
--
ALTER TABLE `grupo_has_materias`
  ADD CONSTRAINT `fk_grupo_has_Materias_Materias1` FOREIGN KEY (`Materias_idMaterias`) REFERENCES `materias` (`idMaterias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grupo_has_Materias_grupo1` FOREIGN KEY (`grupo_nombreGrupo`) REFERENCES `grupo` (`nombreGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `fk_Materias_profesores1` FOREIGN KEY (`profesores_idProfesores`) REFERENCES `profesores` (`idProfesores`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `materias_has_horarios`
--
ALTER TABLE `materias_has_horarios`
  ADD CONSTRAINT `fk_Materias_has_Horarios_Horarios1` FOREIGN KEY (`Horarios_idHorarios`) REFERENCES `horarios` (`idHorarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Materias_has_Horarios_Materias1` FOREIGN KEY (`Materias_idMaterias`) REFERENCES `materias` (`idMaterias`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
