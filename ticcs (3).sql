-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2017 a las 19:12:26
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ticcs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `idCompra` int(10) NOT NULL,
  `fechaCompra` datetime NOT NULL,
  `correoUsuario` varchar(100) NOT NULL,
  `idCurso` varchar(10) NOT NULL,
  `numTrans` varchar(50) NOT NULL,
  `numOrden` varchar(50) NOT NULL,
  `idFactura` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `idCurso` varchar(10) NOT NULL,
  `nombreCurso` varchar(100) NOT NULL,
  `costoCurso` decimal(19,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`idCurso`, `nombreCurso`, `costoCurso`) VALUES
('HC01', 'HTML5 + CSS3', '19.99'),
('JS01', 'Javascript', '19.99'),
('LV01', 'Laravel', '19.99'),
('MS01', 'MySQL', '19.99'),
('PP01', 'PHP POO', '19.99'),
('PY01', 'Python', '19.99');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocio`
--

CREATE TABLE `negocio` (
  `nombreNegocio` varchar(100) NOT NULL,
  `cedulaNegocio` varchar(15) NOT NULL,
  `sucursalNegocio` int(11) NOT NULL,
  `correoNegocio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `correoUsuario` varchar(100) NOT NULL,
  `nombreUsuario` varchar(100) NOT NULL,
  `contraUsuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`correoUsuario`, `nombreUsuario`, `contraUsuario`) VALUES
('jquesada0410@gmail.com', 'Jordan Quesada Cambronero', '$2y$10$hzENYH3FQogOBl1fkUT6veLJ48PXO.nyMCvHMkuVR.jltRcxeEotW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idCompra`),
  ADD UNIQUE KEY `idCompra` (`idCompra`),
  ADD KEY `correoUsuario` (`correoUsuario`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idCurso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`correoUsuario`),
  ADD UNIQUE KEY `correoUsuario` (`correoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `idCompra` int(10) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`correoUsuario`) REFERENCES `usuarios` (`correoUsuario`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
