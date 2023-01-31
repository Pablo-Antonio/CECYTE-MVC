-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-01-2023 a las 02:25:07
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cecyte-mvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `idEquipo` int(11) NOT NULL,
  `folio` varchar(20) NOT NULL,
  `nombreEquipo` varchar(150) NOT NULL,
  `descripcionEquipo` text NOT NULL,
  `fechaIngreso` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`idEquipo`, `folio`, `nombreEquipo`, `descripcionEquipo`, `fechaIngreso`, `status`) VALUES
(1, 'F-0001', 'Proyector Portatil', 'Proyector Epson Color Negro', '2023-01-27', 0),
(2, 'F-0002', 'cable HDMI', 'cable HDMI 1 metro color azul', '2023-01-27', 1),
(3, 'F-0003', 'cable VGA', 'cable VGA 1 metro color azul', '2023-01-27', 0),
(4, 'F-0004', 'Cable HDMI', 'cable HDMI medio metro color rojo', '2023-01-30', 1),
(5, 'F-0005', 'Proyector ', 'Proyector Brother color azul', '2023-01-30', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `idIncidencia` int(11) NOT NULL,
  `idPrestamo` int(11) NOT NULL,
  `folio` varchar(20) NOT NULL,
  `desReporte` text NOT NULL,
  `fechaReporte` datetime NOT NULL,
  `fechaSolucion` datetime NOT NULL,
  `desSolucion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`idIncidencia`, `idPrestamo`, `folio`, `desReporte`, `fechaReporte`, `fechaSolucion`, `desSolucion`, `status`) VALUES
(1, 1, 'F-0001', 'no enciende', '2023-01-30 17:02:53', '0000-00-00 00:00:00', '', 1),
(2, 3, 'F-0003', 'no da señal', '2023-01-30 17:03:55', '0000-00-00 00:00:00', '', 1),
(3, 5, 'F-0005', 'no enciende', '2023-01-30 17:04:12', '0000-00-00 00:00:00', '', 1);

--
-- Disparadores `incidencias`
--
DELIMITER $$
CREATE TRIGGER `actualizarIncidencia` AFTER UPDATE ON `incidencias` FOR EACH ROW BEGIN  

IF NEW.status = 0 THEN
 UPDATE equipos SET status = 1 WHERE folio = NEW.folio;
END IF;

IF NEW.status = 2 THEN
 UPDATE equipos SET status = 0 WHERE folio = NEW.folio;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actualizarReporte` AFTER INSERT ON `incidencias` FOR EACH ROW BEGIN  
 UPDATE prestamos SET status = 0, incidencia = 1, fechaDevolucion = NEW.fechaReporte
 WHERE idPrestamo = NEW.idPrestamo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `idPrestamo` int(11) NOT NULL,
  `folio` varchar(20) NOT NULL,
  `matricula` varchar(20) NOT NULL,
  `alumno` varchar(100) NOT NULL,
  `gradoGrupo` varchar(20) NOT NULL,
  `fechaPrestamo` datetime NOT NULL,
  `fechaDevolucion` datetime NOT NULL,
  `incidencia` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`idPrestamo`, `folio`, `matricula`, `alumno`, `gradoGrupo`, `fechaPrestamo`, `fechaDevolucion`, `incidencia`, `status`) VALUES
(1, 'F-0001', '16680200', 'Rosalba Galicia Ramos', '1 A', '2023-01-30 16:57:38', '2023-01-30 17:02:53', 1, 0),
(2, 'F-0002', '16680201', 'Adriana Galicia Ramos', '1 B', '2023-01-30 16:58:11', '2023-01-30 17:03:33', 0, 0),
(3, 'F-0003', '16680202', 'Angel Galicia Ramos', '1 C', '2023-01-30 16:58:37', '2023-01-30 17:03:55', 1, 0),
(4, 'F-0004', '16680203', 'Jazmin Galicia Ramos', '1 D', '2023-01-30 16:59:01', '2023-01-30 17:03:58', 0, 0),
(5, 'F-0005', '16680204', 'Alexa Guzman Flores', '2 A', '2023-01-30 17:00:47', '2023-01-30 17:04:12', 1, 0);

--
-- Disparadores `prestamos`
--
DELIMITER $$
CREATE TRIGGER `devolucion` AFTER UPDATE ON `prestamos` FOR EACH ROW BEGIN  
 IF NEW.incidencia = 0 THEN
 UPDATE equipos SET status = 1 WHERE folio = NEW.folio;
END IF;

IF NEW.incidencia = 1 THEN
 UPDATE equipos SET status = 0 WHERE folio = NEW.folio;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nuevoPrestamo` AFTER INSERT ON `prestamos` FOR EACH ROW BEGIN  
 UPDATE equipos SET status = 2 WHERE folio = NEW.folio;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usr` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usr`, `password`) VALUES
('administrador', 'admin1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`idEquipo`),
  ADD UNIQUE KEY `folio` (`folio`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`idIncidencia`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`idPrestamo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usr`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `idEquipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `idIncidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `idPrestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
