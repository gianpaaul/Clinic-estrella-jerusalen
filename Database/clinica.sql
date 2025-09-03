-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2025 a las 18:58:17
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
-- Base de datos: `clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` varchar(20) NOT NULL,
  `direccion` text DEFAULT NULL,
  `estado_civil` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `email`, `telefono`, `dni`, `fecha_nacimiento`, `genero`, `direccion`, `estado_civil`, `fecha_registro`) VALUES
(1, 'gianpaul', '2022204024@unam.edu.pe', '123456789', '12345678', '2025-07-26', 'femenino', 'dasds', 'casado', '2025-07-14 16:17:45'),
(2, 'gianpaul', '2022204024@unam.edu.pe', '123456789', '12345678', '2025-07-26', 'femenino', 'dasds', 'casado', '2025-07-14 16:18:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `medico_id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `fecha_consulta` date NOT NULL,
  `motivo_consulta` text NOT NULL,
  `enfermedad_actual` text NOT NULL,
  `antecedentes` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `reposo_medico` tinyint(1) DEFAULT 0,
  `control_medico` tinyint(1) DEFAULT 0,
  `examenes_auxiliares` tinyint(1) DEFAULT 0,
  `interconsulta` tinyint(1) DEFAULT 0,
  `proxima_cita` date DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id`, `medico_id`, `paciente_id`, `fecha_consulta`, `motivo_consulta`, `enfermedad_actual`, `antecedentes`, `observaciones`, `reposo_medico`, `control_medico`, `examenes_auxiliares`, `interconsulta`, `proxima_cita`, `fecha_registro`) VALUES
(1, 1, 1, '2025-07-14', 'das', 'dasd', 'das', 'da', 0, 1, 0, 0, '2025-07-09', '2025-07-14 15:34:27'),
(2, 1, 1, '2025-07-14', 'dsad', 'dasdd', 'dsa', 'dsaas', 0, 1, 0, 0, '2025-07-09', '2025-07-14 16:32:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `asunto` varchar(100) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre_completo`, `correo_electronico`, `telefono`, `asunto`, `mensaje`, `fecha_envio`) VALUES
(1, 'gianpaul', '2022204024@unam.edu.pe', '123456789', 'emergencia', 'as', '2025-07-14 14:42:06'),
(2, 'gianpaul', '20q3ss4024@unam.edu.pe', '123456789', 'consulta', 'dasdas', '2025-07-14 14:45:45'),
(3, 'wawa', '2022204024@unam.edu.pe', '234356784', 'consulta', 'sa', '2025-07-14 14:48:33'),
(4, 'wawa', '2022204024@unam.edu.pe', '123456789', 'consulta', 'sa', '2025-07-14 16:19:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnosticos`
--

CREATE TABLE `diagnosticos` (
  `id` int(11) NOT NULL,
  `consulta_id` int(11) NOT NULL,
  `texto_diagnostico` text NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `diagnosticos`
--

INSERT INTO `diagnosticos` (`id`, `consulta_id`, `texto_diagnostico`, `fecha_registro`) VALUES
(1, 1, 'dasd', '2025-07-14 15:34:27'),
(2, 2, 'das', '2025-07-14 16:32:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `duracion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id`, `slug`, `nombre`, `especialidad`, `precio`, `duracion`) VALUES
(1, 'consulta', 'Consulta General', 'Medicina Interna', 80.00, '30 min'),
(2, 'ecografia', 'Ecografía', 'Radiología', 150.00, '45 min'),
(3, 'pediatria', 'Control Pediátrico', 'Pediatría', 90.00, '40 min'),
(4, 'cardiologia', 'Electrocardiograma', 'Cardiología', 120.00, '35 min'),
(5, 'laboratorio', 'Análisis Clínicos', 'Laboratorio', 60.00, '20 min');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenesfisicos`
--

CREATE TABLE `examenesfisicos` (
  `id` int(11) NOT NULL,
  `consulta_id` int(11) NOT NULL,
  `presion_arterial` varchar(20) DEFAULT NULL,
  `frecuencia_cardiaca` int(11) DEFAULT NULL,
  `temperatura` decimal(4,1) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `descripcion_examen_fisico` text DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `examenesfisicos`
--

INSERT INTO `examenesfisicos` (`id`, `consulta_id`, `presion_arterial`, `frecuencia_cardiaca`, `temperatura`, `peso`, `descripcion_examen_fisico`, `fecha_registro`) VALUES
(1, 1, '12', 4, 21.0, 21.00, 'das', '2025-07-14 15:34:27'),
(2, 2, '12', 4, 21.0, 21.00, 'das', '2025-07-14 16:32:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `cmp` varchar(50) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id`, `nombre`, `especialidad`, `cmp`, `fecha_registro`) VALUES
(1, 'dasd', 'Ginecología', '12345', '2025-07-14 15:34:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `seguro` varchar(50) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `dni`, `edad`, `sexo`, `telefono`, `seguro`, `fecha_registro`) VALUES
(1, 'das', '12345678', 12, 'Femenino', '234356784', 'SIS', '2025-07-14 15:34:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_servicios`
--

CREATE TABLE `solicitudes_servicios` (
  `id` int(10) UNSIGNED NOT NULL,
  `servicios` varchar(255) NOT NULL COMMENT 'lista de slugs separados por comas',
  `horario` varchar(50) NOT NULL,
  `telefono` char(9) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes_servicios`
--

INSERT INTO `solicitudes_servicios` (`id`, `servicios`, `horario`, `telefono`, `created_at`) VALUES
(1, 'consulta', 'tarde', '123456789', '2025-07-14 15:02:37'),
(2, 'ecografia,pediatria,cardiologia', 'mañana', '123456789', '2025-07-14 15:02:51'),
(3, 'pediatria,cardiologia', 'mañana', '123456789', '2025-07-14 16:25:20'),
(4, 'consulta,ecografia,pediatria,cardiologia,laboratorio', 'tarde', '123456789', '2025-07-14 16:26:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

CREATE TABLE `tratamientos` (
  `id` int(11) NOT NULL,
  `consulta_id` int(11) NOT NULL,
  `texto_tratamiento` text NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tratamientos`
--

INSERT INTO `tratamientos` (`id`, `consulta_id`, `texto_tratamiento`, `fecha_registro`) VALUES
(1, 1, 'das', '2025-07-14 15:34:27'),
(2, 2, 'das', '2025-07-14 16:32:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `num_doc` varchar(8) NOT NULL,
  `contrasena` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `num_doc`, `contrasena`) VALUES
(1, 'raul', 'calienes', '72918493', '1'),
(2, 'carlos', 'rodriguez', '19283743', '1'),
(0, 'gabriel', 'huanec', '83948523', '1'),
(4, 'gabriel', 'huanec', '83948523', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medico_id` (`medico_id`),
  ADD KEY `paciente_id` (`paciente_id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `diagnosticos`
--
ALTER TABLE `diagnosticos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consulta_id` (`consulta_id`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indices de la tabla `examenesfisicos`
--
ALTER TABLE `examenesfisicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consulta_id` (`consulta_id`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cmp` (`cmp`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `solicitudes_servicios`
--
ALTER TABLE `solicitudes_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consulta_id` (`consulta_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `diagnosticos`
--
ALTER TABLE `diagnosticos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `examenesfisicos`
--
ALTER TABLE `examenesfisicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `solicitudes_servicios`
--
ALTER TABLE `solicitudes_servicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_2` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `diagnosticos`
--
ALTER TABLE `diagnosticos`
  ADD CONSTRAINT `diagnosticos_ibfk_1` FOREIGN KEY (`consulta_id`) REFERENCES `consultas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `examenesfisicos`
--
ALTER TABLE `examenesfisicos`
  ADD CONSTRAINT `examenesfisicos_ibfk_1` FOREIGN KEY (`consulta_id`) REFERENCES `consultas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD CONSTRAINT `tratamientos_ibfk_1` FOREIGN KEY (`consulta_id`) REFERENCES `consultas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
