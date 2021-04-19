-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 01, 2021 at 11:14 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `certificacion`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deudas`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `id_inventario` int(11) NOT NULL AUTO_INCREMENT,
  `producto` varchar(256) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_inventario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
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
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `usuario_rol` (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_rol` FOREIGN KEY (`rol`) REFERENCES `rol` (`id_rol`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
