-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-07-2022 a las 14:54:29
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `products_catalogue`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `creation_date`) VALUES
(1, 'Medicamentos', '2021-01-04 13:46:06'),
(2, 'Comestibles', '2021-01-04 13:46:06'),
(16, 'Hola 3', '2022-07-19 18:46:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `text` text COLLATE utf8_spanish2_ci NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `title`, `text`, `creation_date`, `categorie_id`) VALUES
(1, 'Acetaminofen', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum varius, dolor sed malesuada molestie, risus magna ornare velit, vitae euismod turpis turpis fermentum sem. Donec maximus ligula non elit rutrum luctus. Nam id molestie massa, vitae vehicula ex. Integer ullamcorper justo quis odio porttitor venenatis. Fusce vel vulputate metus. Suspendisse auctor porttitor fermentum. Curabitur congue accumsan enim a faucibus. In purus nulla, blandit ut tristique id, vestibulum sit amet nibh. Suspendisse non mauris et lorem commodo suscipit.', '2021-01-04 13:48:09', 1),
(2, 'Coca cola 2', 'Class 2 aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer vel nisi dolor. Curabitur nec turpis id libero commodo viverra et a lorem. Cras eleifend sem non lorem ullamcorper vestibulum. Cras tempor ac tortor nec rutrum. Suspendisse sollicitudin vel purus ut volutpat.', '2021-01-04 13:48:09', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
