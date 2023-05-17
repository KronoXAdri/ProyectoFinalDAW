-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2023 a las 20:25:11
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `superspikesman`
--

CREATE DATABASE superspikesman;
USE superspikesman;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `ID_COMPRA` int(11) NOT NULL,
  `FECHA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`ID_COMPRA`, `FECHA`) VALUES
(33, '2023-05-12'),
(34, '2023-05-12'),
(35, '2023-05-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enemigo`
--

CREATE TABLE `enemigo` (
  `ID_ENEMIGO` int(11) NOT NULL,
  `TIPO` varchar(20) NOT NULL,
  `ID_SKIN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `enemigo`
--

INSERT INTO `enemigo` (`ID_ENEMIGO`, `TIPO`, `ID_SKIN`) VALUES
(1, 'Normal', 13),
(2, 'Fuego', 14),
(3, 'Veneno', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `ID_NIVEL` int(11) NOT NULL,
  `MUNDO` int(11) NOT NULL,
  `DIFICULTAD` int(11) NOT NULL,
  `NUMERO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`ID_NIVEL`, `MUNDO`, `DIFICULTAD`, `NUMERO`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 1, 3),
(4, 1, 1, 4),
(5, 1, 1, 5),
(6, 1, 1, 6),
(7, 1, 1, 7),
(8, 1, 1, 8),
(9, 1, 1, 9),
(10, 1, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `skin`
--

CREATE TABLE `skin` (
  `ID_SKIN` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `TIPO` varchar(20) NOT NULL,
  `PRECIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `skin`
--

INSERT INTO `skin` (`ID_SKIN`, `NOMBRE`, `TIPO`, `PRECIO`) VALUES
(1, 'Character1', 'Normal', 500),
(2, 'Character2', 'Normal', 0),
(3, 'Character3', 'Normal', 500),
(4, 'Character4', 'Épica', 1250),
(5, 'Character5', 'Común', 750),
(6, 'Character6', 'Común', 750),
(7, 'Character7', 'Legendaria', 3025),
(8, 'Character8', 'Normal', 500),
(9, 'Character9', 'Poco Común', 1025),
(10, 'Character10', 'Épica', 1250),
(11, 'Character11', 'Legendaria', 3025),
(12, 'Character12', 'Normal', 500),
(13, 'Spike-base', 'Normal', 0),
(14, 'Spike-fire', 'Normal', 500),
(15, 'Spike-venom', 'Normal', 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `skincompra`
--

CREATE TABLE `skincompra` (
  `ID_SKIN` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `ID_COMPRA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `skincompra`
--

INSERT INTO `skincompra` (`ID_SKIN`, `ID_USUARIO`, `ID_COMPRA`) VALUES
(1, 3, 33),
(3, 3, 35),
(5, 3, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_USUARIO` int(11) NOT NULL,
  `PASSWORD` varchar(256) NOT NULL,
  `ALIAS` varchar(50) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDOS` varchar(50) DEFAULT NULL,
  `EDAD` int(11) DEFAULT NULL,
  `PAIS` varchar(50) NOT NULL,
  `CORREO_ELECTRONICO` varchar(50) NOT NULL,
  `PUNTOS_COMPRA` int(11) NOT NULL DEFAULT 0,
  `SKIN_EQUIPADA` int(11) NOT NULL DEFAULT 2,
  `ADMIN` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `PASSWORD`, `ALIAS`, `NOMBRE`, `APELLIDOS`, `EDAD`, `PAIS`, `CORREO_ELECTRONICO`, `PUNTOS_COMPRA`, `SKIN_EQUIPADA`, `ADMIN`) VALUES
(1, '$2y$10$U.XHSs/xEzYtJ9MjTtB8GegCpjp6P80.zRuZq6v3clA82YVATuzaC', 'PruebaUser', 'Prueba', NULL, NULL, 'España', 'correo@correo.com', 500, 2, 0),
(2, '$2y$10$U.XHSs/xEzYtJ9MjTtB8GegCpjp6P80.zRuZq6v3clA82YVATuzaC', 'JaimeXhulo97', 'Jaime', 'Picasso', 12, 'España', 'jaime@correo.com', 250, 4, 0),
(3, '$2y$10$U.XHSs/xEzYtJ9MjTtB8GegCpjp6P80.zRuZq6v3clA82YVATuzaC', 'Algodon', 'Marta', 'Sánchez', NULL, 'España', 'marta@correo.com', 17975, 3, 0),
(4, '$2y$10$U.XHSs/xEzYtJ9MjTtB8GegCpjp6P80.zRuZq6v3clA82YVATuzaC', 'Admin1', 'JorgeSpikes', NULL, 27, 'Camerún', 'jorgeSpikes@correo.com', 100000, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarionivel`
--

CREATE TABLE `usuarionivel` (
  `ID_JUGADA` int(11) NOT NULL,
  `ID_NIVEL` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `PUNTUACION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarionivel`
--

INSERT INTO `usuarionivel` (`ID_JUGADA`, `ID_NIVEL`, `ID_USUARIO`, `PUNTUACION`) VALUES
(1, 1, 1, 1500),
(2, 2, 1, 1000),
(3, 3, 1, 2000),
(4, 1, 3, 2500),
(5, 1, 2, 100),
(6, 7, 2, 2),
(7, 5, 2, 30),
(8, 2, 3, 3020),
(9, 6, 3, 2560),
(10, 9, 1, 100),
(11, 8, 3, 250),
(12, 4, 2, 2420),
(13, 4, 3, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioskin`
--

CREATE TABLE `usuarioskin` (
  `ID_USUARIO` int(11) NOT NULL,
  `ID_SKIN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarioskin`
--

INSERT INTO `usuarioskin` (`ID_USUARIO`, `ID_SKIN`) VALUES
(1, 2),
(2, 2),
(2, 4),
(2, 8),
(3, 1),
(3, 2),
(3, 3),
(3, 5),
(4, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`ID_COMPRA`);

--
-- Indices de la tabla `enemigo`
--
ALTER TABLE `enemigo`
  ADD PRIMARY KEY (`ID_ENEMIGO`,`ID_SKIN`),
  ADD KEY `ID_SKIN` (`ID_SKIN`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`ID_NIVEL`);

--
-- Indices de la tabla `skin`
--
ALTER TABLE `skin`
  ADD PRIMARY KEY (`ID_SKIN`);

--
-- Indices de la tabla `skincompra`
--
ALTER TABLE `skincompra`
  ADD PRIMARY KEY (`ID_SKIN`,`ID_USUARIO`,`ID_COMPRA`),
  ADD KEY `ID_COMPRA` (`ID_COMPRA`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- Indices de la tabla `usuarionivel`
--
ALTER TABLE `usuarionivel`
  ADD PRIMARY KEY (`ID_JUGADA`,`ID_NIVEL`,`ID_USUARIO`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_NIVEL` (`ID_NIVEL`);

--
-- Indices de la tabla `usuarioskin`
--
ALTER TABLE `usuarioskin`
  ADD PRIMARY KEY (`ID_USUARIO`,`ID_SKIN`),
  ADD KEY `ID_SKIN` (`ID_SKIN`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `ID_COMPRA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `enemigo`
--
ALTER TABLE `enemigo`
  MODIFY `ID_ENEMIGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `ID_NIVEL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `skin`
--
ALTER TABLE `skin`
  MODIFY `ID_SKIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarionivel`
--
ALTER TABLE `usuarionivel`
  MODIFY `ID_JUGADA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `enemigo`
--
ALTER TABLE `enemigo`
  ADD CONSTRAINT `enemigo_ibfk_1` FOREIGN KEY (`ID_SKIN`) REFERENCES `skin` (`ID_SKIN`);

--
-- Filtros para la tabla `skincompra`
--
ALTER TABLE `skincompra`
  ADD CONSTRAINT `skincompra_ibfk_1` FOREIGN KEY (`ID_SKIN`) REFERENCES `skin` (`ID_SKIN`),
  ADD CONSTRAINT `skincompra_ibfk_2` FOREIGN KEY (`ID_COMPRA`) REFERENCES `compra` (`ID_COMPRA`),
  ADD CONSTRAINT `skincompra_ibfk_3` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Filtros para la tabla `usuarionivel`
--
ALTER TABLE `usuarionivel`
  ADD CONSTRAINT `usuarionivel_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`),
  ADD CONSTRAINT `usuarionivel_ibfk_2` FOREIGN KEY (`ID_NIVEL`) REFERENCES `nivel` (`ID_NIVEL`);

--
-- Filtros para la tabla `usuarioskin`
--
ALTER TABLE `usuarioskin`
  ADD CONSTRAINT `usuarioskin_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`),
  ADD CONSTRAINT `usuarioskin_ibfk_2` FOREIGN KEY (`ID_SKIN`) REFERENCES `skin` (`ID_SKIN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
