-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2017 a las 20:00:04
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `inc_id` int(4) NOT NULL,
  `inc_fecha_incidencia` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inc_fecha_solucion` datetime NOT NULL,
  `inc_fin` enum('No','Si') NOT NULL,
  `usu_user` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `rec_id` int(4) NOT NULL,
  `inc_descripcion` varchar(280) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`inc_id`, `inc_fecha_incidencia`, `inc_fecha_solucion`, `inc_fin`, `usu_user`, `rec_id`, `inc_descripcion`) VALUES
(18, '2017-11-17 15:33:48', '2017-11-17 15:37:35', 'Si', 'cfernandez', 1, ''),
(19, '2017-11-17 15:37:57', '2017-11-17 15:38:04', 'Si', 'cfernandez', 1, ''),
(20, '2017-11-17 15:38:00', '2017-11-17 15:38:05', 'Si', 'cfernandez', 2, ''),
(21, '2017-11-17 15:44:02', '2017-11-17 15:44:09', 'Si', 'cfernandez', 15, ''),
(22, '2017-11-17 15:53:07', '2017-11-17 15:53:14', 'Si', 'cfernandez', 1, ''),
(23, '2017-11-17 15:53:09', '2017-11-17 15:53:15', 'Si', 'cfernandez', 2, ''),
(24, '2017-11-17 15:53:12', '2017-11-17 15:53:16', 'Si', 'cfernandez', 3, ''),
(25, '2017-11-17 17:46:51', '0000-00-00 00:00:00', 'No', 'cfernandez', 4, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `rec_id` int(4) NOT NULL,
  `rec_nombre` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rec_estado` enum('Disponible','Reservado','Averiado') COLLATE utf8mb4_spanish_ci NOT NULL,
  `rec_tipo` enum('Aulas','Despachos/Salas','Material de trabajo') COLLATE utf8mb4_spanish_ci NOT NULL,
  `rec_desc` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `resc_foto` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`rec_id`, `rec_nombre`, `rec_estado`, `rec_tipo`, `rec_desc`, `resc_foto`) VALUES
(1, 'Aula 101', 'Reservado', 'Aulas', 'Aula teorica con proyetor', 'aula101.jpg'),
(2, 'Aula 102', 'Reservado', 'Aulas', 'Aula teorica', 'aula102.jpg'),
(3, 'Aula 103', 'Reservado', 'Aulas', 'Aula teorica con proyector', 'aula103.jpg'),
(4, 'Aula 104', 'Averiado', 'Aulas', 'Aula informatica', 'aula104.jpg'),
(5, 'Aula 105', 'Disponible', 'Aulas', 'Aula informatica', 'aula105.jpg'),
(6, 'Despacho 1', 'Disponible', 'Despachos/Salas', 'Despacho situado en el ala izquierda del edificio', 'despacho01.jpg'),
(7, 'Despacho 2', 'Disponible', 'Despachos/Salas', 'Despacho situado en el ala derecha del edificio', 'despacho02.jpg'),
(8, 'Sala de reuniones', 'Disponible', 'Despachos/Salas', 'Sala de reuniones situada al lado del despacho 1', 'saladereuniones.png'),
(9, 'Proyector Portatil', 'Disponible', 'Material de trabajo', 'Proyector portatil HP *Para salas sin proyector', 'proyector_portatil.jpg'),
(10, 'Carro de portatiles', 'Disponible', 'Material de trabajo', 'Carro para guardar los portatiles', 'carrodeportatiles.jpg'),
(11, 'Portatil 1', 'Disponible', 'Material de trabajo', 'Lenovo Thinkpad intel core i5 8gb RAM', 'portatil01.jpg'),
(12, 'Portatil 2', 'Disponible', 'Material de trabajo', 'MSI intel core i7 16gb RAM', 'portatil02.jpg'),
(13, 'Portatil 3', 'Disponible', 'Material de trabajo', 'ASUS ultrabook intel core i5 8gb RAM', 'portatil03.jpg'),
(14, 'Movil 1', 'Disponible', 'Material de trabajo', 'Samsung Galaxy S8', 'SamsungGalaxyS8.png'),
(15, 'Movil 2', 'Disponible', 'Material de trabajo', 'LG G6', 'LGG6.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `res_id` int(4) NOT NULL,
  `res_inicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `res_fin` datetime NOT NULL,
  `res_acabada` enum('No','Si') COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_user` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rec_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`res_id`, `res_inicio`, `res_fin`, `res_acabada`, `usu_user`, `rec_id`) VALUES
(41, '2017-11-17 15:47:56', '2017-11-17 15:48:12', 'Si', 'cfernandez', 1),
(42, '2017-11-17 15:47:59', '2017-11-17 15:48:16', 'Si', 'cfernandez', 2),
(43, '2017-11-17 15:48:02', '2017-11-17 15:48:22', 'Si', 'cfernandez', 3),
(44, '2017-11-17 15:53:23', '2017-11-17 15:56:04', 'Si', 'cfernandez', 1),
(45, '2017-11-17 15:53:26', '2017-11-17 15:56:13', 'Si', 'cfernandez', 2),
(46, '2017-11-17 16:30:10', '0000-00-00 00:00:00', 'No', 'cfernandez', 1),
(47, '2017-11-17 16:30:14', '0000-00-00 00:00:00', 'No', 'cfernandez', 2),
(48, '2017-11-17 16:30:28', '0000-00-00 00:00:00', 'No', 'dmarin', 3),
(49, '2017-11-17 19:48:33', '2017-11-17 19:54:59', 'Si', 'jmonforte', 6),
(50, '2017-11-17 19:55:08', '2017-11-17 19:55:14', 'Si', 'jmonforte', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_user` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_pwd` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_nombre` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_apellido` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_mail` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_telf` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_user`, `usu_pwd`, `usu_nombre`, `usu_apellido`, `usu_mail`, `usu_telf`) VALUES
('aplans', 'qwe123', 'Agnes', 'Plans', 'aplans@gmail.com', 982534865),
('ccardenas', 'qwe123', 'Carlos', 'Cárdenas', 'ccardenas@gmail.com', 937639127),
('cfernandez', 'qwe123', 'Cristian', 'Fernandez', 'cfernandez@gmail.com', 926345287),
('dmarin', 'qwe123', 'David', 'Marin', 'dmarin@gmail.com', 973428645),
('jmonforte', 'qwe123', 'Juanjo', 'Monforte', 'jmonforte@gmail.com', 932456721),
('sjimenez', 'qwe123', 'Sergio', 'Jimenez', 'sjimenez@gmail.com', 936452836),
('stecnico', 'qwe123', 'Servicio', 'Tecnico', 'stecnico@gmail.com', 933456676);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`inc_id`),
  ADD KEY `FK_inc_usuario` (`usu_user`),
  ADD KEY `FK_inc_recurso` (`rec_id`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`rec_id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `FK_usuario` (`usu_user`),
  ADD KEY `FK_recurso` (`rec_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_user`),
  ADD UNIQUE KEY `usu_mail` (`usu_mail`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `inc_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `rec_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `res_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `FK_inc_recurso` FOREIGN KEY (`rec_id`) REFERENCES `recursos` (`rec_id`),
  ADD CONSTRAINT `FK_inc_usuario` FOREIGN KEY (`usu_user`) REFERENCES `usuarios` (`usu_user`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `FK_recurso` FOREIGN KEY (`rec_id`) REFERENCES `recursos` (`rec_id`),
  ADD CONSTRAINT `FK_usuario` FOREIGN KEY (`usu_user`) REFERENCES `usuarios` (`usu_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
