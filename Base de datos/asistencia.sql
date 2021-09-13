-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2021 a las 21:39:17
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_administrador` int(11) NOT NULL COMMENT 'Identificador del administrador',
  `documento` varchar(45) NOT NULL COMMENT 'Documento del administrador',
  `nombres` varchar(45) NOT NULL COMMENT 'Nombres del administrador',
  `apellidos` varchar(45) NOT NULL COMMENT 'Apellidos del administrador',
  `clave` varchar(45) NOT NULL COMMENT 'Clave del administrador',
  `correo` varchar(255) NOT NULL COMMENT 'Correo del administrador',
  `estado` int(11) NOT NULL COMMENT 'Activo o inactiva',
  `tipo_usuario_id_tipo_usuario` int(11) NOT NULL COMMENT 'Tipo de usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_administrador`, `documento`, `nombres`, `apellidos`, `clave`, `correo`, `estado`, `tipo_usuario_id_tipo_usuario`) VALUES
(1, '123', 'Juan David', 'Hoyos', '123', 'david@hotmail.com', 1, 3),
(2, '456', 'Flores', 'Vargas', '123', 'flores@hotmail.com', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `id_aula` int(11) NOT NULL COMMENT 'Id del aula',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre del aula',
  `estado` int(11) NOT NULL COMMENT 'Activa o inactiva'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`id_aula`, `nombre`, `estado`) VALUES
(1, 'LAB C', 1),
(2, 'LAB E', 1),
(3, 'LAB D', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `a_docente`
--

CREATE TABLE `a_docente` (
  `ida_docente` int(11) NOT NULL COMMENT 'Id de la asistencia/registro del docente',
  `clase_id_clase` int(11) NOT NULL COMMENT 'Id de la clase registrada',
  `fecha` date NOT NULL COMMENT 'Fecha en la que se registra la clase',
  `estado` varchar(255) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Si la clase esta activa o no',
  `estado2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `a_docente`
--

INSERT INTO `a_docente` (`ida_docente`, `clase_id_clase`, `fecha`, `estado`, `estado2`) VALUES
(1, 6, '2021-07-13', 'Activa', 1),
(2, 6, '2021-09-13', 'Activa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `a_estudiante`
--

CREATE TABLE `a_estudiante` (
  `ida_estudiante` int(11) NOT NULL COMMENT 'Id de la asistencia del estudiante',
  `fecha` date NOT NULL COMMENT 'Fecha de la asistencia a la clase',
  `asistio` varchar(255) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Si/No',
  `estudiante_id_estudiante` int(11) NOT NULL COMMENT 'Id del estudiante',
  `clase_id_clase` int(11) NOT NULL COMMENT 'Id de la clase'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `a_estudiante`
--

INSERT INTO `a_estudiante` (`ida_estudiante`, `fecha`, `asistio`, `estudiante_id_estudiante`, `clase_id_clase`) VALUES
(1, '2021-07-13', 'Si', 1, 6),
(2, '2021-07-13', 'No', 2, 6),
(3, '2021-09-13', 'No', 1, 6),
(4, '2021-09-13', 'No', 2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id_carrera` int(11) NOT NULL COMMENT 'Id de la carrera',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre de la carrera',
  `estado` int(11) NOT NULL COMMENT 'Activa o inactiva'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id_carrera`, `nombre`, `estado`) VALUES
(1, 'Hoteleria y turismo', 1),
(2, 'Administracion Empresas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `id_clase` int(11) NOT NULL COMMENT 'Id de la clase',
  `Dias_id_dia` int(11) NOT NULL COMMENT 'Id del dia',
  `hora` time NOT NULL COMMENT 'Hora de inicio de la clase',
  `horafin` time NOT NULL COMMENT 'Hora fin de la clase',
  `codigo` varchar(45) NOT NULL COMMENT 'Codigo de la clase',
  `Docente_id_docente` int(11) NOT NULL COMMENT 'Id del docente que la dara',
  `Aula_id_aula` int(11) NOT NULL COMMENT 'Id del aula en la que se vera',
  `Materia_id_materia` int(11) NOT NULL COMMENT 'Id de la materia que se vera',
  `Grupo_id_grupo` int(11) NOT NULL COMMENT 'Id del grupo asignado',
  `estado` int(11) NOT NULL COMMENT 'Estado de la clase'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id_clase`, `Dias_id_dia`, `hora`, `horafin`, `codigo`, `Docente_id_docente`, `Aula_id_aula`, `Materia_id_materia`, `Grupo_id_grupo`, `estado`) VALUES
(1, 1, '07:45:00', '10:15:00', 'code_lunes', 1, 1, 1, 2, 1),
(2, 2, '09:30:00', '12:00:00', 'code_martes', 2, 1, 3, 1, 1),
(3, 3, '08:45:00', '09:30:00', 'code_miercoles', 1, 1, 2, 1, 1),
(4, 5, '19:15:00', '21:30:00', 'code_viernes', 2, 1, 3, 1, 1),
(5, 1, '11:45:00', '12:00:00', 'code_lunes2', 1, 1, 3, 1, 1),
(6, 2, '07:45:00', '11:15:00', 'code_martes2', 1, 1, 1, 1, 1),
(7, 1, '07:45:00', '10:15:00', 'code_lunes3', 2, 1, 1, 2, 1),
(8, 4, '08:45:00', '10:15:00', 'code_jueves', 2, 3, 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `id_dia` int(11) NOT NULL COMMENT 'Id el dia',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre del dia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`id_dia`, `nombre`) VALUES
(7, 'Domingo'),
(4, 'Jueves'),
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(6, 'Sabado'),
(5, 'Viernes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL COMMENT 'Identificador del docente',
  `documento` varchar(45) NOT NULL COMMENT 'Documento del docente',
  `nombres` varchar(45) NOT NULL COMMENT 'Nombres del docente\n\n',
  `apellidos` varchar(45) NOT NULL COMMENT 'Apellidos del docente',
  `clave` varchar(45) NOT NULL COMMENT 'Clave del docente',
  `correo` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Correo del docente',
  `tipo_usuario_id_tipo_usuario` int(11) NOT NULL COMMENT 'Tipo de usuario',
  `estado` int(11) NOT NULL COMMENT 'Activo o inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id_docente`, `documento`, `nombres`, `apellidos`, `clave`, `correo`, `tipo_usuario_id_tipo_usuario`, `estado`) VALUES
(1, '111', 'Gabriela', 'Agudelo', '123', 'gabriela@hotmail.com', 2, 1),
(2, '222', 'Camila', 'Moreno', '123', 'camila@hotmail.com', 2, 1),
(3, '333', 'Martha', 'Valdes', '123', 'martha@hotmail.com', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id_estudiante` int(11) NOT NULL COMMENT 'Identificador del estudiante',
  `documento` varchar(45) NOT NULL COMMENT 'Documento del estudiante',
  `nombres` varchar(45) NOT NULL COMMENT 'Nombres del estudiante',
  `apellidos` varchar(45) NOT NULL COMMENT 'Apellidos del estudiante',
  `jornada` varchar(45) NOT NULL COMMENT 'Jornada del estudiante',
  `semestre` varchar(45) NOT NULL COMMENT 'Semestre en el que se encuentra',
  `clave` varchar(45) NOT NULL COMMENT 'Clave del estudiante',
  `correo` varchar(255) NOT NULL COMMENT 'Correo el estudiante',
  `estado` int(11) NOT NULL COMMENT 'Activo o inactivo',
  `Carrera_id_carrera` int(11) NOT NULL COMMENT 'Id de la carrera que cursa',
  `tipo_usuario_id_tipo_usuario` int(11) NOT NULL COMMENT 'Id del tipo de usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id_estudiante`, `documento`, `nombres`, `apellidos`, `jornada`, `semestre`, `clave`, `correo`, `estado`, `Carrera_id_carrera`, `tipo_usuario_id_tipo_usuario`) VALUES
(1, '444', 'Juan Diego', 'Rios', 'Diurna', 'Septimo', '123', 'diego@hotmail.com', 1, 1, 1),
(2, '555', 'Emilio', 'Rivera', 'Diurna', 'Quinto', '123', 'emilio@hotmail.com', 1, 2, 1),
(3, '666', 'Daniel', 'Andres', 'Diurna', 'Quinto', '123', 'daniel@hotmail.com', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL COMMENT 'Id del grupo',
  `nombre` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'Nombre del grupo',
  `Estudiante_id_estudiante` int(11) NOT NULL COMMENT 'Id del estudiante',
  `estado` int(11) NOT NULL COMMENT 'Activo o inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nombre`, `Estudiante_id_estudiante`, `estado`) VALUES
(1, 'grupo 1 dia', 1, 1),
(1, 'grupo 1 dia', 2, 1),
(2, 'grupo 2 noche', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `links`
--

CREATE TABLE `links` (
  `id_links` int(11) NOT NULL COMMENT 'Llave principal',
  `links` varchar(255) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Campo para pegar/adjuntar los links',
  `fecha` date NOT NULL COMMENT 'fecha en la que se registra la clase con los links',
  `clase_id_clase` int(11) NOT NULL COMMENT 'id de la clase a la que se adjuntan los links'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `links`
--

INSERT INTO `links` (`id_links`, `links`, `fecha`, `clase_id_clase`) VALUES
(1, 'Material nuevo de la clase\r\nhttps://drive.google.com/', '2021-07-13', 6),
(2, 'Prueba', '2021-09-13', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL COMMENT 'Id de la materia',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre de la materia',
  `estado` int(11) NOT NULL COMMENT 'Activo o inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `nombre`, `estado`) VALUES
(1, 'Gestion contable', 1),
(2, 'Calculo 2', 1),
(3, 'Ingles A2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL COMMENT 'Id del usuario',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre (Administrador, Estudiante o Docente)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `nombre`) VALUES
(1, 'Estudiante'),
(2, 'Docente'),
(3, 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_administrador`,`tipo_usuario_id_tipo_usuario`),
  ADD UNIQUE KEY `documento_UNIQUE` (`documento`),
  ADD UNIQUE KEY `id_UNIQUE` (`id_administrador`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_administrador_tipo_usuario1_idx` (`tipo_usuario_id_tipo_usuario`);

--
-- Indices de la tabla `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`id_aula`),
  ADD UNIQUE KEY `id_UNIQUE` (`id_aula`);

--
-- Indices de la tabla `a_docente`
--
ALTER TABLE `a_docente`
  ADD PRIMARY KEY (`ida_docente`,`clase_id_clase`),
  ADD UNIQUE KEY `ida_docente_UNIQUE` (`ida_docente`),
  ADD KEY `fk_a_docente_clase1_idx` (`clase_id_clase`);

--
-- Indices de la tabla `a_estudiante`
--
ALTER TABLE `a_estudiante`
  ADD PRIMARY KEY (`ida_estudiante`,`estudiante_id_estudiante`,`clase_id_clase`),
  ADD UNIQUE KEY `ida_estudiante_UNIQUE` (`ida_estudiante`),
  ADD UNIQUE KEY `ida_estudiante` (`ida_estudiante`,`fecha`,`asistio`,`estudiante_id_estudiante`,`clase_id_clase`),
  ADD KEY `fk_a_estudiante_estudiante1_idx` (`estudiante_id_estudiante`),
  ADD KEY `fk_a_estudiante_clase1_idx` (`clase_id_clase`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id_carrera`),
  ADD UNIQUE KEY `id_carrera_UNIQUE` (`id_carrera`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`id_clase`,`Dias_id_dia`,`Docente_id_docente`,`Aula_id_aula`,`Materia_id_materia`,`Grupo_id_grupo`),
  ADD UNIQUE KEY `id_UNIQUE` (`id_clase`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `fk_Clase_Docente1_idx` (`Docente_id_docente`),
  ADD KEY `fk_Clase_Aula1_idx` (`Aula_id_aula`),
  ADD KEY `fk_Clase_Materia1_idx` (`Materia_id_materia`),
  ADD KEY `fk_Clase_Grupo1_idx` (`Grupo_id_grupo`),
  ADD KEY `fk_Clase_Dias1_idx` (`Dias_id_dia`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`id_dia`),
  ADD UNIQUE KEY `id_dia_UNIQUE` (`id_dia`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id_docente`,`tipo_usuario_id_tipo_usuario`),
  ADD UNIQUE KEY `id_docente_UNIQUE` (`id_docente`),
  ADD UNIQUE KEY `documento_UNIQUE` (`documento`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_docente_tipo_usuario1_idx` (`tipo_usuario_id_tipo_usuario`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id_estudiante`,`Carrera_id_carrera`,`tipo_usuario_id_tipo_usuario`),
  ADD UNIQUE KEY `documento_UNIQUE` (`documento`),
  ADD UNIQUE KEY `id_UNIQUE` (`id_estudiante`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_estudiante_Carrera1_idx` (`Carrera_id_carrera`),
  ADD KEY `fk_estudiante_tipo_usuario1_idx` (`tipo_usuario_id_tipo_usuario`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`,`Estudiante_id_estudiante`),
  ADD KEY `fk_Grupo_Estudiante1_idx` (`Estudiante_id_estudiante`);

--
-- Indices de la tabla `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id_links`,`clase_id_clase`),
  ADD UNIQUE KEY `id_links_UNIQUE` (`id_links`),
  ADD KEY `fk_links_clase1_idx` (`clase_id_clase`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`),
  ADD UNIQUE KEY `id_UNIQUE` (`id_materia`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`),
  ADD UNIQUE KEY `id_UNIQUE` (`id_tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del administrador', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `aula`
--
ALTER TABLE `aula`
  MODIFY `id_aula` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del aula', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `a_docente`
--
ALTER TABLE `a_docente`
  MODIFY `ida_docente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la asistencia/registro del docente', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `a_estudiante`
--
ALTER TABLE `a_estudiante`
  MODIFY `ida_estudiante` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la asistencia del estudiante', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la carrera', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `id_clase` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la clase', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `id_dia` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id el dia', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del docente', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del estudiante', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `links`
--
ALTER TABLE `links`
  MODIFY `id_links` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave principal', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la materia', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del usuario', AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `fk_administrador_tipo_usuario1` FOREIGN KEY (`tipo_usuario_id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `a_docente`
--
ALTER TABLE `a_docente`
  ADD CONSTRAINT `fk_a_docente_clase1` FOREIGN KEY (`clase_id_clase`) REFERENCES `clase` (`id_clase`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `a_estudiante`
--
ALTER TABLE `a_estudiante`
  ADD CONSTRAINT `fk_a_estudiante_clase1` FOREIGN KEY (`clase_id_clase`) REFERENCES `clase` (`id_clase`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_a_estudiante_estudiante1` FOREIGN KEY (`estudiante_id_estudiante`) REFERENCES `estudiante` (`id_estudiante`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `fk_Clase_Aula1` FOREIGN KEY (`Aula_id_aula`) REFERENCES `aula` (`id_aula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Clase_Dias1` FOREIGN KEY (`Dias_id_dia`) REFERENCES `dias` (`id_dia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Clase_Docente1` FOREIGN KEY (`Docente_id_docente`) REFERENCES `docente` (`id_docente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Clase_Grupo1` FOREIGN KEY (`Grupo_id_grupo`) REFERENCES `grupo` (`id_grupo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Clase_Materia1` FOREIGN KEY (`Materia_id_materia`) REFERENCES `materia` (`id_materia`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `fk_docente_tipo_usuario1` FOREIGN KEY (`tipo_usuario_id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_estudiante_Carrera1` FOREIGN KEY (`Carrera_id_carrera`) REFERENCES `carrera` (`id_carrera`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_estudiante_tipo_usuario1` FOREIGN KEY (`tipo_usuario_id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `fk_Grupo_Estudiante1` FOREIGN KEY (`Estudiante_id_estudiante`) REFERENCES `estudiante` (`id_estudiante`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `fk_links_clase1` FOREIGN KEY (`clase_id_clase`) REFERENCES `clase` (`id_clase`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
