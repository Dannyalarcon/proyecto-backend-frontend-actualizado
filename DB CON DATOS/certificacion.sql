-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 07-04-2021 a las 02:58:57
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `certificacion1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

DROP TABLE IF EXISTS `agenda`;
CREATE TABLE IF NOT EXISTS `agenda` (
  `id_agenda` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(256) NOT NULL,
  `precio` int(20) NOT NULL,
  `telefono` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `asistencia` varchar(25) NOT NULL DEFAULT 'ausente',
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_agenda`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `nombre`, `descripcion`, `precio`, `telefono`, `fecha`, `hora`, `asistencia`, `estatus`) VALUES
(1, 'maria carmen', 'manos y pies', 100, 78945, '2021-03-01', '12:00:00', 'cancelado', 2),
(2, 'zayra', 'corte de pelo', 45, 30986659, '2021-03-01', '13:00:00', 'finalizado', 0),
(3, 'mariana', 'uñas', 75, 30986659, '2021-03-02', '12:00:00', 'finalizado', 0),
(4, 'andrea', 'uñas', 75, 30986659, '2021-02-12', '12:00:00', 'finalizado', 0),
(5, 'alejandra', 'pedicura', 50, 44300955, '2021-04-01', '04:01:00', 'cancelado', 2),
(6, 'maria fernanda', 'manos y pies', 100, 78945, '2021-03-01', '12:00:00', 'cancelado', 2),
(7, 'sofia alejandra', 'manos y pies', 100, 78945, '2021-03-01', '12:00:00', 'finalizado', 0),
(8, 'maria ', 'unas', 123, 33058545, '2021-02-17', '23:00:00', 'finalizado', 0),
(9, 'mari', 'corte de pelo, uñas', 120, 12345678, '2021-01-10', '12:45:00', 'ausente', 1),
(10, 'maria dolores', 'limpieza de uñas', 100, 78945612, '2021-01-07', '02:02:00', 'ausente', 1),
(11, 'cristina', 'corte de pelo', 100, 30986659, '2021-03-05', '13:00:00', 'ausente', 1),
(12, 'karen ortega sevilla', 'manicura color rosa diseño de flores, limpieza de pedicura, corte de pelo y trenzado', 175, 30986659, '2021-04-03', '15:45:00', 'ausente', 1),
(13, 'doña flori', 'corte de pelo', 123, 123123, '2021-03-12', '17:27:00', 'ausente', 1),
(14, 'maritza gomez', 'manicura color rosa diseño de caballo', 75, 98657458, '2021-10-14', '15:45:00', 'ausente', 1),
(15, 'juana', 'manicura color rosa diseño de caballo, herradura, sombrero', 175, 30986659, '2021-04-03', '15:45:00', 'ausente', 1),
(16, 'marta martinez', 'manicura color rosa diseño de caballo, herradura, sombrero', 175, 30986659, '2021-04-03', '15:45:00', 'ausente', 1),
(17, 'diana arita', 'manicura', 75, 21549865, '2021-10-16', '15:45:00', 'ausente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudas`
--

DROP TABLE IF EXISTS `deudas`;
CREATE TABLE IF NOT EXISTS `deudas` (
  `id_deuda` int(11) NOT NULL AUTO_INCREMENT,
  `dpi` varchar(45) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `direccion` varchar(256) NOT NULL,
  `telefono` int(20) NOT NULL,
  `deuda` varchar(256) NOT NULL,
  `precio` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_deuda`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `deudas`
--

INSERT INTO `deudas` (`id_deuda`, `dpi`, `nombre`, `direccion`, `telefono`, `deuda`, `precio`, `fecha`, `estatus`) VALUES
(1, '654654622222', 'gabriela gabi', 'esquipulas, chiquimula', 33333335, 'corte de pelo y uñas y ropa', 250, '2021-03-12', 0),
(2, '111', 'maria fernanda ', 'santa ana, esquipulas', 44303, 'uñas pintadas, pelo', 120, '2021-02-09', 0),
(3, '12334', 'maria', 'esquipulas', 123456785, 'corte de pelo', 75, '2020-11-17', 0),
(4, '112233445566', 'maria fernanda lopez', 'santa ana', 44303866, 'uñas ', 100, '2021-01-09', 0),
(5, '112233445566', 'maria fernanda lopez', 'santa ana', 44303866, 'uñas ', 100, '2021-01-20', 0),
(6, '12345234', 'armando ', 'residenciales', 3098659, 'ropa', 100, '2021-01-01', 1),
(7, '309866', 'danny alarcon', 'residenciales del valles chiquimula', 2147483647, 'corte de pelo, ropaass', 2250, '2021-03-08', 0),
(8, '8884564564564', 'danny', 'residenciales', 30986659, 'corte de pelo', 75, '2021-03-17', 1),
(9, '111444558', 'maria  lopez', 'residenciales del valle', 44383066, 'uñas, pies, corte de pelo', 450, '2021-01-09', 1),
(10, '111444558', 'maria lopez', 'residenciales', 44383066, 'ropa y uñas', 150, '2021-04-03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `id_empleados` int(11) NOT NULL AUTO_INCREMENT,
  `dpi` varchar(20) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `direccion` varchar(256) NOT NULL,
  `telefono` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `correo` varchar(256) NOT NULL,
  `salario` int(100) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_empleados`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleados`, `dpi`, `nombre`, `direccion`, `telefono`, `fecha`, `correo`, `salario`, `estatus`) VALUES
(1, '0124578', 'maria fernanda erazo', 'residenciales del valle', 44303866, '1999-01-04', 'mariafer@gmail.com', 700, 0),
(2, '65465465244444', 'marifer rodriguez rodriguez4', ',residenciales del valle', 2147483647, '2020-02-28', 'mari@gmail.com', 150, 0),
(3, '123456789', 'santa monica sagastume', 'residenciales del valle, esquipulas, chiquimula', 30986659, '1999-01-04', 'danny@gmail.com', 1000, 0),
(4, '122132', 'maria alejandra, perex', ' valle, esquipulas, chiquimula,guatemala', 2147483647, '2021-03-16', 'da@gmail.com', 3233, 0),
(5, '0124578', 'maria fernanda erazo', 'residenciales del valle', 44303866, '1999-01-04', 'mariafer@gmail.com', 700, 1),
(6, '23542342342', 'alberto del arco', 'esquipulas', 32445584, '1999-07-22', 'alberto@gmail.com', 300, 1),
(7, '2882828', 'javier', 'residenciales', 3938938, '2021-11-30', 'javier@gmail.com', 398, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `id_inventario` int(11) NOT NULL AUTO_INCREMENT,
  `producto` varchar(256) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_inventario`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `producto`, `precio`, `cantidad`, `estatus`) VALUES
(1, 'secadora roja esto es una api', 15000, 0, 0),
(2, 'tinte castaño claro', 45, 9, 1),
(3, 'pinta uñas rojo', 20, 2, 1),
(4, 'tinte decolorante', 40, 5, 1),
(5, 'uñas acrilicas', 95, 5, 1),
(6, 'pinta uñas azul', 20, 5, 1),
(7, 'secadora de pelo', 250, 2, 1),
(8, 'pinta uñas rosa', 20, 2, 1),
(9, 'pinta uñas violeta', 20, 3, 1),
(10, 'pinta uñas celeste', 20, 2, 1),
(11, 'mascarillas', 15, 200, 1),
(12, 'tinte negro', 45, 2, 1),
(13, 'plancha de pelo', 450, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'administrador'),
(2, 'empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `correo` varchar(256) NOT NULL,
  `telefono` int(20) NOT NULL,
  `user` varchar(256) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `rol` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  KEY `usuario_rol` (`rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `correo`, `telefono`, `user`, `pass`, `rol`, `estatus`) VALUES
(1, 'danny alarcon', 'dannyalarcon417@gmail.com', 30986659, 'danny', '202cb962ac59075b964b07152d234b70', 1, 1),
(2, 'mayra', 'admin@gmail.com', 44383066, 'admin', '202cb962ac59075b964b07152d234b70', 1, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_rol` FOREIGN KEY (`rol`) REFERENCES `rol` (`id_rol`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
