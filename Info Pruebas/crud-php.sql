-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2026 a las 14:50:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crud-php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `idmascota` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `especie` varchar(30) NOT NULL,
  `edad` int(11) NOT NULL,
  `fechaIngreso` date NOT NULL,
  `peso` int(11) NOT NULL,
  `vacunado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`idmascota`, `nombre`, `especie`, `edad`, `fechaIngreso`, `peso`, `vacunado`) VALUES
(1, 'Luna', 'Perro', 3, '2023-05-10', 13, 1),
(2, 'Oliver', 'Gato', 2, '2023-08-20', 4, 1),
(3, 'Coco', 'Conejo', 1, '2024-01-15', 2, 0),
(4, 'Bella', 'Perro', 5, '2022-11-30', 22, 1),
(5, 'Simba', 'Gato', 4, '2023-03-12', 5, 1),
(6, 'Max', 'Perro', 7, '2021-06-25', 30, 1),
(7, 'Nala', 'Gato', 1, '2024-02-10', 4, 0),
(8, 'Toby', 'Perro', 2, '2023-11-05', 8, 1),
(9, 'Pipo', 'Hámster', 1, '2024-03-01', 0, 0),
(10, 'Kira', 'Perro', 6, '2022-09-14', 16, 1),
(11, 'Mochi', 'Gato', 3, '2023-07-22', 5, 1),
(12, 'Rex', 'Perro', 8, '2020-12-01', 35, 1),
(13, 'Piolín', 'Pájaro', 2, '2024-01-20', 0, 0),
(14, 'Thor', 'Perro', 4, '2023-04-18', 28, 1),
(15, 'Cleo', 'Gato', 5, '2022-05-30', 4, 1),
(16, 'Rayo', 'Tortuga', 12, '2019-10-10', 3, 0),
(17, 'Lola', 'Perro', 2, '2023-12-15', 11, 1),
(18, 'Garfield', 'Gato', 9, '2021-02-28', 8, 0),
(19, 'Duke', 'Perro', 3, '2023-08-05', 20, 1),
(20, 'Daisy', 'Conejo', 1, '2024-02-20', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'camilo1234', 'Camilo1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`idmascota`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `idmascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
