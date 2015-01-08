-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-01-2015 a las 17:35:53
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `control-profesores`
--
CREATE DATABASE IF NOT EXISTS `control-profesores` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `control-profesores`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academia`
--

CREATE TABLE IF NOT EXISTS `academia` (
  `idAcademia` int(11) NOT NULL AUTO_INCREMENT,
  `abreviacion` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `idMaestros` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  PRIMARY KEY (`idAcademia`),
  KEY `fk_academia_maestros1_idx` (`idMaestros`),
  KEY `fk_academia_departamento1_idx` (`idDepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE IF NOT EXISTS `asistencia` (
  `idAsistencia` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `dia` varchar(45) DEFAULT NULL,
  `asistencia` smallint(6) DEFAULT NULL,
  `idCurso` int(11) NOT NULL,
  PRIMARY KEY (`idAsistencia`),
  KEY `fk_asistencia_curso1_idx` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE IF NOT EXISTS `aulas` (
  `idAulas` int(11) NOT NULL AUTO_INCREMENT,
  `aula` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idAulas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE IF NOT EXISTS `carreras` (
  `idCarreras` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCarreras`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`idCarreras`, `nombre`, `clave`) VALUES
(15, 'Ingenieria en Informatica', 'INFO'),
(17, 'Ingenieria Biomedica', 'BIM'),
(18, 'Ingenieria en Comunicaciones y Electronica', 'CEL'),
(19, 'Ingenieria en Computacion', 'COM'),
(20, 'Ingenieria en Alimentos', 'ALI'),
(21, 'Licenciatura en Matematicas', 'MAT'),
(22, 'Ingenieria en Robotioca', 'INRI'),
(23, 'Ingenieria en Control', 'INCR'),
(24, 'Licenciatura en Ingenieria en Computacion ', 'INCE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrerasdepartamento`
--

CREATE TABLE IF NOT EXISTS `carrerasdepartamento` (
  `nombre` int(11) DEFAULT NULL,
  `clave` int(11) DEFAULT NULL,
  `nomDep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo`
--

CREATE TABLE IF NOT EXISTS `ciclo` (
  `idCiclo` int(11) NOT NULL AUTO_INCREMENT,
  `ciclo` varchar(6) DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  PRIMARY KEY (`idCiclo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `idCiclo` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  `nrc` varchar(10) DEFAULT NULL,
  `seccion` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`idCurso`),
  KEY `fk_Curso_Ciclo1_idx` (`idCiclo`),
  KEY `fk_Curso_Materia1_idx` (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursopermiso`
--

CREATE TABLE IF NOT EXISTS `cursopermiso` (
  `idCursoPermiso` int(11) NOT NULL,
  `idPermisos` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL,
  PRIMARY KEY (`idCursoPermiso`),
  KEY `fk_cursoPermiso_permisos1_idx` (`idPermisos`),
  KEY `fk_cursoPermiso_curso1_idx` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `definitivo`
--

CREATE TABLE IF NOT EXISTS `definitivo` (
  `idDefinitivo` int(11) NOT NULL AUTO_INCREMENT,
  `idNombramiento` int(11) NOT NULL,
  `idMaestros` int(11) NOT NULL,
  PRIMARY KEY (`idDefinitivo`),
  KEY `fk_nombramiento_homologacion1_idx` (`idNombramiento`),
  KEY `fk_nombramiento_maestros1_idx` (`idMaestros`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `idDepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `abreviacion` varchar(45) DEFAULT NULL,
  `idMaestros` int(11) NOT NULL,
  PRIMARY KEY (`idDepartamento`),
  KEY `fk_departamento_maestros1_idx` (`idMaestros`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificioaulas`
--

CREATE TABLE IF NOT EXISTS `edificioaulas` (
  `idedificioAulas` int(11) NOT NULL AUTO_INCREMENT,
  `idEdificios` int(11) NOT NULL,
  `idAulas` int(11) NOT NULL,
  PRIMARY KEY (`idedificioAulas`),
  KEY `fk_edificioAulas_edificios1_idx` (`idEdificios`),
  KEY `fk_edificioAulas_aulas1_idx` (`idAulas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificios`
--

CREATE TABLE IF NOT EXISTS `edificios` (
  `idEdificios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEdificios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evidencias`
--

CREATE TABLE IF NOT EXISTS `evidencias` (
  `idEvidencias` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(150) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `valor` smallint(6) DEFAULT NULL,
  `indicereprobacion` int(11) DEFAULT NULL,
  `idCurso` int(11) NOT NULL,
  PRIMARY KEY (`idEvidencias`),
  KEY `fk_evidencias_curso1_idx` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `idHorario` int(11) NOT NULL AUTO_INCREMENT,
  `idCurso` int(11) NOT NULL,
  `dia` varchar(1) DEFAULT NULL,
  `inicio` varchar(4) DEFAULT NULL,
  `fin` varchar(4) DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  `teoria_practica` int(11) DEFAULT NULL,
  `idEdificios` int(11) NOT NULL,
  `idAulas` int(11) NOT NULL,
  PRIMARY KEY (`idHorario`),
  KEY `fk_horario_Curso1_idx` (`idCurso`),
  KEY `fk_horario_Edificios1_idx` (`idEdificios`),
  KEY `fk_horario_Aulas1_idx` (`idAulas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariosimparte`
--

CREATE TABLE IF NOT EXISTS `horariosimparte` (
  `codigo` int(11) DEFAULT NULL,
  `nombres` int(11) DEFAULT NULL,
  `apellidos` int(11) DEFAULT NULL,
  `nombre` int(11) DEFAULT NULL,
  `nrc` int(11) DEFAULT NULL,
  `seccion` int(11) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `inicio` int(11) DEFAULT NULL,
  `fin` int(11) DEFAULT NULL,
  `nomedificio` int(11) DEFAULT NULL,
  `aula` int(11) DEFAULT NULL,
  `inicioimparte` int(11) DEFAULT NULL,
  `finimparte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariossuplencia`
--

CREATE TABLE IF NOT EXISTS `horariossuplencia` (
  `codigo` int(11) DEFAULT NULL,
  `nombres` int(11) DEFAULT NULL,
  `apellidos` int(11) DEFAULT NULL,
  `nombre` int(11) DEFAULT NULL,
  `nrc` int(11) DEFAULT NULL,
  `seccion` int(11) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `inicio` int(11) DEFAULT NULL,
  `fin` int(11) DEFAULT NULL,
  `nomedificio` int(11) DEFAULT NULL,
  `aula` int(11) DEFAULT NULL,
  `iniciosuplencia` int(11) DEFAULT NULL,
  `finsuplencia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impartes`
--

CREATE TABLE IF NOT EXISTS `impartes` (
  `idImpartes` int(11) NOT NULL AUTO_INCREMENT,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `idMaestros` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL,
  PRIMARY KEY (`idImpartes`),
  KEY `fk_impartes_maestros1_idx` (`idMaestros`),
  KEY `fk_impartes_curso1_idx` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integrantesacademia`
--

CREATE TABLE IF NOT EXISTS `integrantesacademia` (
  `codigo` int(11) DEFAULT NULL,
  `nombres` int(11) DEFAULT NULL,
  `apellidos` int(11) DEFAULT NULL,
  `nommat` int(11) DEFAULT NULL,
  `nrc` int(11) DEFAULT NULL,
  `seccion` int(11) DEFAULT NULL,
  `nomaca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefesacademia`
--

CREATE TABLE IF NOT EXISTS `jefesacademia` (
  `codigo` int(11) DEFAULT NULL,
  `nombres` int(11) DEFAULT NULL,
  `apellidos` int(11) DEFAULT NULL,
  `nombre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefesdpto`
--

CREATE TABLE IF NOT EXISTS `jefesdpto` (
  `codigo` int(11) DEFAULT NULL,
  `nombres` int(11) DEFAULT NULL,
  `apellidos` int(11) DEFAULT NULL,
  `nombre` int(11) DEFAULT NULL,
  `abreviacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

CREATE TABLE IF NOT EXISTS `maestros` (
  `idMaestros` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMaestros`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mateirasacademia`
--

CREATE TABLE IF NOT EXISTS `mateirasacademia` (
  `idMateirasAcademis` int(11) NOT NULL AUTO_INCREMENT,
  `idMateria` int(11) NOT NULL,
  `idAcademia` int(11) NOT NULL,
  PRIMARY KEY (`idMateirasAcademis`),
  KEY `fk_MateirasAcademis_materia1_idx` (`idMateria`),
  KEY `fk_MateirasAcademis_academia1_idx` (`idAcademia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE IF NOT EXISTS `materia` (
  `idMateria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `clave` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiascarrera`
--

CREATE TABLE IF NOT EXISTS `materiascarrera` (
  `idMateriasCarrera` int(11) NOT NULL AUTO_INCREMENT,
  `idCarreras` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  `idAcademia` int(11) NOT NULL,
  PRIMARY KEY (`idMateriasCarrera`),
  KEY `fk_MateriasCarrera_carreras1_idx` (`idCarreras`),
  KEY `fk_MateriasCarrera_materia1_idx` (`idMateria`,`idAcademia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombramiento`
--

CREATE TABLE IF NOT EXISTS `nombramiento` (
  `idNombramiento` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  PRIMARY KEY (`idNombramiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones`
--

CREATE TABLE IF NOT EXISTS `observaciones` (
  `idObservaciones` int(11) NOT NULL AUTO_INCREMENT,
  `observacion` varchar(150) DEFAULT NULL,
  `fechaRealizada` date DEFAULT NULL,
  `fechaSolucionada` date DEFAULT NULL,
  `idEvidencias` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`idObservaciones`),
  KEY `fk_observaciones_evidencias1_idx` (`idEvidencias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `idPermisos` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `fechaRecepcion` date DEFAULT NULL,
  `causa` varchar(200) DEFAULT NULL,
  `idTipoPermiso` int(11) NOT NULL,
  PRIMARY KEY (`idPermisos`),
  KEY `fk_permisos_tipoPermiso1_idx` (`idTipoPermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE IF NOT EXISTS `privilegios` (
  `idPrivilegios` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPrivilegios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`idPrivilegios`, `tipo`, `descripcion`) VALUES
(1, 0, 'Administrador'),
(2, 1, 'Maestro'),
(3, 2, 'Asistente'),
(4, 3, 'Revisor'),
(5, 4, 'Jefe Departamento');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `privilegiosusuarios`
--
CREATE TABLE IF NOT EXISTS `privilegiosusuarios` (
`nombre` varchar(7)
,`tipo` int(11)
,`descripcion` varchar(45)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `idRoles` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuarios` int(11) NOT NULL,
  `idPrivilegios` int(11) NOT NULL,
  PRIMARY KEY (`idRoles`),
  KEY `fk_roles_usuarios1_idx` (`idUsuarios`),
  KEY `fk_roles_privilegios1_idx` (`idPrivilegios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRoles`, `idUsuarios`, `idPrivilegios`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 2),
(4, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suplencia`
--

CREATE TABLE IF NOT EXISTS `suplencia` (
  `idSuplencia` int(11) NOT NULL AUTO_INCREMENT,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `idMaestros` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL,
  PRIMARY KEY (`idSuplencia`),
  KEY `fk_suplencia_maestros1_idx` (`idMaestros`),
  KEY `fk_suplencia_curso1_idx` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporal`
--

CREATE TABLE IF NOT EXISTS `temporal` (
  `idTemporal` int(11) NOT NULL AUTO_INCREMENT,
  `idNombramiento` int(11) NOT NULL,
  `idMaestros` int(11) NOT NULL,
  PRIMARY KEY (`idTemporal`),
  KEY `fk_asignatura_homologacion1_idx` (`idNombramiento`),
  KEY `fk_asignatura_maestros1_idx` (`idMaestros`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopermiso`
--

CREATE TABLE IF NOT EXISTS `tipopermiso` (
  `idTipoPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `tipoPermiso` varchar(45) DEFAULT NULL,
  `cantidadMax` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTipoPermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(7) NOT NULL,
  `contrasena` varchar(32) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`idUsuarios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `nombre`, `contrasena`, `correo`, `estatus`) VALUES
(1, '2093663', '1234567', '', 1),
(2, '1234567', '1234567', '', 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `privilegiosusuarios`
--
DROP TABLE IF EXISTS `privilegiosusuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `privilegiosusuarios` AS select `us`.`nombre` AS `nombre`,`pr`.`tipo` AS `tipo`,`pr`.`descripcion` AS `descripcion` from ((`usuarios` `us` join `roles` `ro` on((`ro`.`idUsuarios` = `us`.`idUsuarios`))) join `privilegios` `pr` on((`ro`.`idPrivilegios` = `pr`.`idPrivilegios`)));

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `academia`
--
ALTER TABLE `academia`
  ADD CONSTRAINT `fk_academia_departamento1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_academia_maestros1` FOREIGN KEY (`idMaestros`) REFERENCES `maestros` (`idMaestros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_asistencia_curso1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_Curso_Ciclo1` FOREIGN KEY (`idCiclo`) REFERENCES `ciclo` (`idCiclo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Curso_Materia1` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cursopermiso`
--
ALTER TABLE `cursopermiso`
  ADD CONSTRAINT `fk_cursoPermiso_curso1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cursoPermiso_permisos1` FOREIGN KEY (`idPermisos`) REFERENCES `permisos` (`idPermisos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `definitivo`
--
ALTER TABLE `definitivo`
  ADD CONSTRAINT `fk_nombramiento_homologacion1` FOREIGN KEY (`idNombramiento`) REFERENCES `nombramiento` (`idNombramiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nombramiento_maestros1` FOREIGN KEY (`idMaestros`) REFERENCES `maestros` (`idMaestros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `fk_departamento_maestros1` FOREIGN KEY (`idMaestros`) REFERENCES `maestros` (`idMaestros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `edificioaulas`
--
ALTER TABLE `edificioaulas`
  ADD CONSTRAINT `fk_edificioAulas_aulas1` FOREIGN KEY (`idAulas`) REFERENCES `aulas` (`idAulas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_edificioAulas_edificios1` FOREIGN KEY (`idEdificios`) REFERENCES `edificios` (`idEdificios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evidencias`
--
ALTER TABLE `evidencias`
  ADD CONSTRAINT `fk_evidencias_curso1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_horario_Aulas1` FOREIGN KEY (`idAulas`) REFERENCES `aulas` (`idAulas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_horario_Curso1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_horario_Edificios1` FOREIGN KEY (`idEdificios`) REFERENCES `edificios` (`idEdificios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `impartes`
--
ALTER TABLE `impartes`
  ADD CONSTRAINT `fk_impartes_curso1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_impartes_maestros1` FOREIGN KEY (`idMaestros`) REFERENCES `maestros` (`idMaestros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mateirasacademia`
--
ALTER TABLE `mateirasacademia`
  ADD CONSTRAINT `fk_MateirasAcademis_academia1` FOREIGN KEY (`idAcademia`) REFERENCES `academia` (`idAcademia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MateirasAcademis_materia1` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `materiascarrera`
--
ALTER TABLE `materiascarrera`
  ADD CONSTRAINT `fk_MateriasCarrera_carreras1` FOREIGN KEY (`idCarreras`) REFERENCES `carreras` (`idCarreras`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MateriasCarrera_materia1` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `observaciones`
--
ALTER TABLE `observaciones`
  ADD CONSTRAINT `fk_observaciones_evidencias1` FOREIGN KEY (`idEvidencias`) REFERENCES `evidencias` (`idEvidencias`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `fk_permisos_tipoPermiso1` FOREIGN KEY (`idTipoPermiso`) REFERENCES `tipopermiso` (`idTipoPermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `fk_roles_privilegios1` FOREIGN KEY (`idPrivilegios`) REFERENCES `privilegios` (`idPrivilegios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_roles_usuarios1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `suplencia`
--
ALTER TABLE `suplencia`
  ADD CONSTRAINT `fk_suplencia_curso1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_suplencia_maestros1` FOREIGN KEY (`idMaestros`) REFERENCES `maestros` (`idMaestros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `temporal`
--
ALTER TABLE `temporal`
  ADD CONSTRAINT `fk_asignatura_homologacion1` FOREIGN KEY (`idNombramiento`) REFERENCES `nombramiento` (`idNombramiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asignatura_maestros1` FOREIGN KEY (`idMaestros`) REFERENCES `maestros` (`idMaestros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
