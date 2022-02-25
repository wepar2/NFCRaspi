-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 10.2.1.117
-- Tiempo de generación: 20-02-2020 a las 00:51:35
-- Versión del servidor: 10.2.24-MariaDB
-- Versión de PHP: 7.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u974320120_ilock`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaEntrada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`id`, `nombre`, `uid`, `fechaEntrada`) VALUES
(1, 'undefined', '840195812197', '2019-05-13 20:00:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(9) NOT NULL,
  `direccion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(4) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `ip` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `navegador` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `os` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_verificacion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_validado` int(1) NOT NULL,
  `key_verificacion_pass` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre`, `apellido`, `email`, `usuario`, `pass`, `telefono`, `direccion`, `admin`, `fechaRegistro`, `ip`, `navegador`, `os`, `version`, `key_verificacion`, `email_validado`, `key_verificacion_pass`) VALUES
(1, 'Fernando', 'Duran Torres', 'fernando@ilockpanel.tk', 'admin', '7b24afc8bc80e548d66c4e7ff72171c5', 670329692, 'AVD Falsa 123', 1, '2019-05-03 17:10:13', '47.61.73.130', 'Google Chrome', 'Linux', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', 'efea16d6f37c44d0cd38b8136fa28399', 1, 0),
(2, 'Ana Maria', 'Cabello González', 'ana@ilockpanel.tk', 'Ana', '81dc9bdb52d04dc20036dbd8313ed055', 670333333, 'I.E.S Montecillos', 1, '2019-05-15 08:16:46', '212.170.177.164', 'Google Chrome', 'Mac OS Classic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '4c319bfed33283d95b893108a7efac05', 1, 0),
(3, 'Rafael', 'Ruíz Rubio', 'rafael@ilockpanel.tk', 'rafael', '81dc9bdb52d04dc20036dbd8313ed055', 644444444, 'I.E.S Montecillos', 1, '2019-05-15 08:55:20', '212.170.177.164', 'Google Chrome', 'Mac OS Classic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', 'a73e2b8ec084d9ed2bad705a73cd58c7', 0, 0),
(4, 'Silvia', 'Cáceres Caro', 'silvia@ilockpanel.tk', 'Silvia', '81dc9bdb52d04dc20036dbd8313ed055', 666664444, 'I.E.S Montecillos', 1, '2019-05-15 09:38:38', '212.170.177.164', 'Google Chrome', 'Mac OS Classic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '597c566203056b0e2c8f83f361e8db57', 0, 0),
(15, 'sadasdas', 'sadasd', 'info@ilockpanel.tk', 'eqweqw', '7b24afc8bc80e548d66c4e7ff72171c5', 543564353, 'Calle de la amargura, 21', 1, '2019-05-15 10:46:20', '212.170.177.164', 'Google Chrome', 'Mac OS Classic', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '7c4030f68954bf73ecf53e9bfd78c406', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uid` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaRegistro` datetime NOT NULL,
  `foto` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombre`, `uid`, `fechaRegistro`, `foto`, `activo`) VALUES
(6, 'Nando', '840195812197', '2019-05-13 22:05:23', 'upload/17906547505cdbba9d4d0f2.jpg', 1),
(7, 'BusCoin', '79656687590', '2019-05-17 10:07:15', 'upload/19880059635cde7e5c563dd.jpeg', 1),
(9, 'Ana', '710565407360', '2019-05-17 11:21:00', '', 1),
(11, 'kola', '584187271314', '2019-05-30 11:13:16', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UserLoginTable`
--

CREATE TABLE `UserLoginTable` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `UserLoginTable`
--
ALTER TABLE `UserLoginTable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso`
--
ALTER TABLE `acceso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `UserLoginTable`
--
ALTER TABLE `UserLoginTable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
