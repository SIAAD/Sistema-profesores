-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-09-2014 a las 16:47:16
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `control-profesor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academia`
--

CREATE TABLE IF NOT EXISTS `academia` (
  `idAcademia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idMaestros` int(11) NOT NULL,
  PRIMARY KEY (`idAcademia`,`idDepartamento`,`idMaestros`),
  KEY `fk_Academia_Departamento1_idx` (`idDepartamento`),
  KEY `fk_academia_maestros1_idx` (`idMaestros`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `academia`
--

INSERT INTO `academia` (`idAcademia`, `nombre`, `clave`, `idDepartamento`, `idMaestros`) VALUES
(1, 'Software de Sistemas', 'SOFSIS', 1, 6),
(2, 'Electronica Analogica Aplicada', 'ELEAPL', 2, 3),
(3, 'Sistemas de Comunicacion', 'SISCOM', 2, 7),
(4, 'Comunicaciones', 'COM', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE IF NOT EXISTS `asignacion` (
  `idAsignacion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) DEFAULT NULL,
  `idMaestros` int(11) NOT NULL,
  `idHorario` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL,
  PRIMARY KEY (`idAsignacion`),
  KEY `fk_Asignacion_maestros1_idx` (`idMaestros`),
  KEY `fk_Asignacion_horario1_idx` (`idHorario`,`idCurso`)
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
  `idCiclo` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  `idEvidencias` int(11) NOT NULL,
  PRIMARY KEY (`idAsistencia`),
  KEY `fk_asistencia_Curso1_idx` (`idCurso`,`idCiclo`,`idMateria`,`idEvidencias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE IF NOT EXISTS `aulas` (
  `idAulas` int(11) NOT NULL AUTO_INCREMENT,
  `aula` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idAulas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`idAulas`, `aula`) VALUES
(1, 'A001'),
(2, 'A002'),
(3, 'A003'),
(4, 'A004'),
(5, 'A005'),
(6, 'A006'),
(7, 'A007'),
(8, 'A008'),
(9, 'A009'),
(10, 'A010'),
(11, 'LC01'),
(12, 'LC02'),
(13, 'LC03'),
(14, 'LC04'),
(15, 'LC05');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ciclo`
--

INSERT INTO `ciclo` (`idCiclo`, `ciclo`, `inicio`, `fin`) VALUES
(1, '201420', '2014-08-18', '2014-12-15'),
(2, '201410', '2014-02-04', '2014-06-13');

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
  PRIMARY KEY (`idCurso`,`idCiclo`,`idMateria`),
  KEY `fk_Curso_Ciclo1_idx` (`idCiclo`),
  KEY `fk_Curso_Materia1_idx` (`idMateria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idCurso`, `idCiclo`, `idMateria`, `nrc`, `seccion`) VALUES
(1, 1, 1, '02845', 'D01'),
(2, 1, 1, '02846', 'D02'),
(3, 2, 3, '01234', 'D05'),
(4, 2, 4, '01478', 'D12'),
(5, 1, 5, '01598', 'D07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursopermiso`
--

CREATE TABLE IF NOT EXISTS `cursopermiso` (
  `idCursoPermiso` int(11) NOT NULL,
  `permisos_idPermisos` int(11) NOT NULL,
  `curso_idCurso` int(11) NOT NULL,
  `curso_idCiclo` int(11) NOT NULL,
  `curso_idMateria` int(11) NOT NULL,
  PRIMARY KEY (`idCursoPermiso`),
  KEY `fk_cursoPermiso_permisos1_idx` (`permisos_idPermisos`),
  KEY `fk_cursoPermiso_curso1_idx` (`curso_idCurso`,`curso_idCiclo`,`curso_idMateria`)
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
  PRIMARY KEY (`idDepartamento`,`idMaestros`),
  KEY `fk_departamento_maestros1_idx` (`idMaestros`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombre`, `clave`, `abreviacion`, `idMaestros`) VALUES
(1, 'Ciencias Computacionales', '1500', 'DCC', 2),
(2, 'Electronica', '1510', 'DEPEL', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificios`
--

CREATE TABLE IF NOT EXISTS `edificios` (
  `idEdificios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEdificios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `edificios`
--

INSERT INTO `edificios` (`idEdificios`, `nombre`) VALUES
(1, 'DEDX'),
(2, 'DEDT'),
(3, 'DEDU'),
(4, 'DEDP'),
(5, 'DEDR'),
(6, 'DEDQ'),
(7, 'DEDW'),
(8, 'DUCT1'),
(9, 'DUCT2');

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
  `idCiclo` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  PRIMARY KEY (`idEvidencias`),
  KEY `fk_evidencias_curso1_idx` (`idCurso`,`idCiclo`,`idMateria`)
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
  PRIMARY KEY (`idHorario`,`idCurso`,`idEdificios`,`idAulas`),
  KEY `fk_horario_Curso1_idx` (`idCurso`),
  KEY `fk_horario_Edificios1_idx` (`idEdificios`),
  KEY `fk_horario_Aulas1_idx` (`idAulas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idHorario`, `idCurso`, `dia`, `inicio`, `fin`, `horas`, `teoria_practica`, `idEdificios`, `idAulas`) VALUES
(1, 1, 'L', '0700', '0855', 2, 1, 1, 8),
(2, 1, 'I', '0700', '0755', 1, 2, 2, 9);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `horariosimparte`
--
CREATE TABLE IF NOT EXISTS `horariosimparte` (
`codigo` varchar(45)
,`nombres` varchar(45)
,`apellidos` varchar(45)
,`nombre` varchar(45)
,`nrc` varchar(10)
,`seccion` varchar(3)
,`dia` varchar(1)
,`inicio` varchar(4)
,`fin` varchar(4)
,`nomedificio` varchar(45)
,`aula` varchar(45)
,`inicioimparte` date
,`finimparte` date
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `horariossuplencia`
--
CREATE TABLE IF NOT EXISTS `horariossuplencia` (
`codigo` varchar(45)
,`nombres` varchar(45)
,`apellidos` varchar(45)
,`nombre` varchar(45)
,`nrc` varchar(10)
,`seccion` varchar(3)
,`dia` varchar(1)
,`inicio` varchar(4)
,`fin` varchar(4)
,`nomedificio` varchar(45)
,`aula` varchar(45)
,`iniciosuplencia` date
,`finsuplencia` date
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impartes`
--

CREATE TABLE IF NOT EXISTS `impartes` (
  `idImpartes` int(11) NOT NULL AUTO_INCREMENT,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `idCurso` int(11) NOT NULL,
  `idCiclo` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  `idMaestros` int(11) NOT NULL,
  PRIMARY KEY (`idImpartes`),
  KEY `fk_impartes_Curso1_idx` (`idCurso`,`idCiclo`,`idMateria`),
  KEY `fk_impartes_maestros1_idx` (`idMaestros`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `incidencia`
--
CREATE TABLE IF NOT EXISTS `incidencia` (
`fecha` date
,`abreviacion` varchar(45)
,`nombre` varchar(45)
,`seccion` varchar(3)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `integrantesacademia`
--
CREATE TABLE IF NOT EXISTS `integrantesacademia` (
`codigo` varchar(45)
,`nombres` varchar(45)
,`apellidos` varchar(45)
,`nommat` varchar(45)
,`nrc` varchar(10)
,`seccion` varchar(3)
,`nomaca` varchar(45)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `jefesacademia`
--
CREATE TABLE IF NOT EXISTS `jefesacademia` (
`codigo` varchar(45)
,`nombres` varchar(45)
,`apellidos` varchar(45)
,`nombre` varchar(45)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `jefesdpto`
--
CREATE TABLE IF NOT EXISTS `jefesdpto` (
`codigo` varchar(45)
,`nombres` varchar(45)
,`apellidos` varchar(45)
,`nombre` varchar(45)
,`abreviacion` varchar(45)
);
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`idMaestros`, `codigo`, `nombres`, `apellidos`) VALUES
(1, '1111111', 'STAFF', 'STAFF'),
(2, '7910223', 'Patricia', 'Mendoza Sanchez'),
(3, '8818746', 'Martin Javier', 'Martinez Silva'),
(4, '9604596', 'Miguel Angel', 'Guerrero Segura Ramirez'),
(5, '2224275', 'Eduardo', 'Velazquez Mora'),
(6, '9107355', 'Salomon Eduardo', 'Ibarra Chavez'),
(7, '8819238', 'Maria Susana', 'Ruiz Palacios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestrosusuarios`
--

CREATE TABLE IF NOT EXISTS `maestrosusuarios` (
  `idMaestrosUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `idMaestros` int(11) NOT NULL,
  `idUsuarios` int(11) NOT NULL,
  PRIMARY KEY (`idMaestrosUsuarios`),
  KEY `fk_maestrosUsuarios_maestros1_idx` (`idMaestros`),
  KEY `fk_maestrosUsuarios_usuarios1_idx` (`idUsuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE IF NOT EXISTS `materia` (
  `idMateria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `clave` varchar(5) DEFAULT NULL,
  `idAcademia` int(11) NOT NULL,
  PRIMARY KEY (`idMateria`,`idAcademia`),
  KEY `fk_Materia_Academia1_idx` (`idAcademia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`idMateria`, `nombre`, `clave`, `idAcademia`) VALUES
(1, 'Electronica Analogica', 'ET217', 2),
(2, 'Electronica Industrial', 'ET219', 2),
(3, 'Electronica de Alta Frecuencia', 'ET304', 2),
(4, 'Antenas', 'ET300', 3),
(5, 'Señalizacion y Sincronizacion', 'ET317', 3);

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
  PRIMARY KEY (`idPermisos`)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suplencia`
--

CREATE TABLE IF NOT EXISTS `suplencia` (
  `idSuplencia` int(11) NOT NULL AUTO_INCREMENT,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `idCurso` int(11) NOT NULL,
  `idCiclo` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  `idMaestros` int(11) NOT NULL,
  PRIMARY KEY (`idSuplencia`),
  KEY `fk_suplencia_Curso1_idx` (`idCurso`,`idCiclo`,`idMateria`),
  KEY `fk_suplencia_maestros1_idx` (`idMaestros`)
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
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `contraseña` varchar(32) NOT NULL,
  PRIMARY KEY (`idUsuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `horariosimparte`
--
DROP TABLE IF EXISTS `horariosimparte`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `horariosimparte` AS select `ma`.`codigo` AS `codigo`,`ma`.`nombres` AS `nombres`,`ma`.`apellidos` AS `apellidos`,`mat`.`nombre` AS `nombre`,`cu`.`nrc` AS `nrc`,`cu`.`seccion` AS `seccion`,`h`.`dia` AS `dia`,`h`.`inicio` AS `inicio`,`h`.`fin` AS `fin`,`e`.`nombre` AS `nomedificio`,`a`.`aula` AS `aula`,`im`.`inicio` AS `inicioimparte`,`im`.`fin` AS `finimparte` from ((((((`curso` `cu` join `horario` `h` on((`cu`.`idCurso` = `h`.`idCurso`))) join `edificios` `e` on((`e`.`idEdificios` = `h`.`idEdificios`))) join `aulas` `a` on((`a`.`idAulas` = `h`.`idAulas`))) join `materia` `mat` on((`mat`.`idMateria` = `cu`.`idMateria`))) join `impartes` `im` on((`cu`.`idCurso` = `im`.`idCurso`))) join `maestros` `ma` on((`ma`.`idMaestros` = `im`.`idMaestros`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `horariossuplencia`
--
DROP TABLE IF EXISTS `horariossuplencia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `horariossuplencia` AS select `ma`.`codigo` AS `codigo`,`ma`.`nombres` AS `nombres`,`ma`.`apellidos` AS `apellidos`,`mat`.`nombre` AS `nombre`,`cu`.`nrc` AS `nrc`,`cu`.`seccion` AS `seccion`,`h`.`dia` AS `dia`,`h`.`inicio` AS `inicio`,`h`.`fin` AS `fin`,`e`.`nombre` AS `nomedificio`,`a`.`aula` AS `aula`,`su`.`inicio` AS `iniciosuplencia`,`su`.`fin` AS `finsuplencia` from ((((((`curso` `cu` join `horario` `h` on((`cu`.`idCurso` = `h`.`idCurso`))) join `edificios` `e` on((`e`.`idEdificios` = `h`.`idEdificios`))) join `aulas` `a` on((`a`.`idAulas` = `h`.`idAulas`))) join `materia` `mat` on((`mat`.`idMateria` = `cu`.`idMateria`))) join `suplencia` `su` on((`su`.`idCurso` = `cu`.`idCurso`))) join `maestros` `ma` on((`ma`.`idMaestros` = `su`.`idMaestros`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `incidencia`
--
DROP TABLE IF EXISTS `incidencia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `incidencia` AS select `asis`.`fecha` AS `fecha`,`dep`.`abreviacion` AS `abreviacion`,`mat`.`nombre` AS `nombre`,`cur`.`seccion` AS `seccion` from ((((`asistencia` `asis` join `curso` `cur` on(((`asis`.`idCurso` = `cur`.`idCurso`) and (`asis`.`asistencia` = 0)))) join `materia` `mat` on((`mat`.`idMateria` = `cur`.`idMateria`))) join `academia` `aca` on((`aca`.`idAcademia` = `mat`.`idAcademia`))) join `departamento` `dep` on((`dep`.`idDepartamento` = `aca`.`idDepartamento`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `integrantesacademia`
--
DROP TABLE IF EXISTS `integrantesacademia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `integrantesacademia` AS select `ma`.`codigo` AS `codigo`,`ma`.`nombres` AS `nombres`,`ma`.`apellidos` AS `apellidos`,`m`.`nombre` AS `nommat`,`cu`.`nrc` AS `nrc`,`cu`.`seccion` AS `seccion`,`a`.`nombre` AS `nomaca` from ((((`maestros` `ma` join `impartes` `im` on((`ma`.`idMaestros` = `im`.`idMaestros`))) join `curso` `cu` on((`im`.`idCurso` = `cu`.`idCurso`))) join `materia` `m` on((`m`.`idMateria` = `cu`.`idMateria`))) join `academia` `a` on((`a`.`idAcademia` = `m`.`idAcademia`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `jefesacademia`
--
DROP TABLE IF EXISTS `jefesacademia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jefesacademia` AS select `ma`.`codigo` AS `codigo`,`ma`.`nombres` AS `nombres`,`ma`.`apellidos` AS `apellidos`,`aca`.`nombre` AS `nombre` from (`maestros` `ma` join `academia` `aca` on((`ma`.`idMaestros` = `aca`.`idMaestros`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `jefesdpto`
--
DROP TABLE IF EXISTS `jefesdpto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jefesdpto` AS select `ma`.`codigo` AS `codigo`,`ma`.`nombres` AS `nombres`,`ma`.`apellidos` AS `apellidos`,`d`.`nombre` AS `nombre`,`d`.`abreviacion` AS `abreviacion` from (`maestros` `ma` join `departamento` `d` on((`ma`.`idMaestros` = `d`.`idMaestros`)));

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `academia`
--
ALTER TABLE `academia`
  ADD CONSTRAINT `fk_Academia_Departamento1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_academia_maestros1` FOREIGN KEY (`idMaestros`) REFERENCES `maestros` (`idMaestros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `fk_Asignacion_horario1` FOREIGN KEY (`idHorario`, `idCurso`) REFERENCES `horario` (`idHorario`, `idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Asignacion_maestros1` FOREIGN KEY (`idMaestros`) REFERENCES `maestros` (`idMaestros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_asistencia_Curso1` FOREIGN KEY (`idCurso`, `idCiclo`, `idMateria`) REFERENCES `curso` (`idCurso`, `idCiclo`, `idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_cursoPermiso_curso1` FOREIGN KEY (`curso_idCurso`, `curso_idCiclo`, `curso_idMateria`) REFERENCES `curso` (`idCurso`, `idCiclo`, `idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cursoPermiso_permisos1` FOREIGN KEY (`permisos_idPermisos`) REFERENCES `permisos` (`idPermisos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `evidencias`
--
ALTER TABLE `evidencias`
  ADD CONSTRAINT `fk_evidencias_curso1` FOREIGN KEY (`idCurso`, `idCiclo`, `idMateria`) REFERENCES `curso` (`idCurso`, `idCiclo`, `idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_impartes_Curso1` FOREIGN KEY (`idCurso`, `idCiclo`, `idMateria`) REFERENCES `curso` (`idCurso`, `idCiclo`, `idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_impartes_maestros1` FOREIGN KEY (`idMaestros`) REFERENCES `maestros` (`idMaestros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `maestrosusuarios`
--
ALTER TABLE `maestrosusuarios`
  ADD CONSTRAINT `fk_maestrosUsuarios_maestros1` FOREIGN KEY (`idMaestros`) REFERENCES `maestros` (`idMaestros`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_maestrosUsuarios_usuarios1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `fk_Materia_Academia1` FOREIGN KEY (`idAcademia`) REFERENCES `academia` (`idAcademia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `observaciones`
--
ALTER TABLE `observaciones`
  ADD CONSTRAINT `fk_observaciones_evidencias1` FOREIGN KEY (`idEvidencias`) REFERENCES `evidencias` (`idEvidencias`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_suplencia_Curso1` FOREIGN KEY (`idCurso`, `idCiclo`, `idMateria`) REFERENCES `curso` (`idCurso`, `idCiclo`, `idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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



INSERT INTO `ciclo` (`idCiclo`, `ciclo`, `inicio`, `fin`) VALUES
(1, '201420', '2014-08-18', '2014-12-15'),
(2, '201410', '2014-02-04', '2014-06-13');
INSERT INTO `aulas` (`idAulas`, `aula`) VALUES
(1, 'A001'),(2, 'A002'),(3, 'A003'),(4, 'A004'),(5, 'A005'),(6, 'A006'),(7, 'A007'),(8, 'A008'),(9, 'A009'),
(10, 'A010'),(11, 'LC01'),(12, 'LC02'),(13, 'LC03'),(14, 'LC04'),(15, 'LC05');
INSERT INTO `edificios` (`idEdificios`, `nombre`) VALUES
(1, 'DEDX'),(2, 'DEDT'),(3, 'DEDU'),(4, 'DEDP'),(5, 'DEDR'),(6, 'DEDQ'),(7, 'DEDW'),(8, 'DUCT1'),(9, 'DUCT2');

INSERT INTO `maestros` (`idMaestros`, `codigo`, `nombres`, `apellidos`) VALUES
(1, '1111111', 'STAFF', 'STAFF'),
(2, '7910223', 'Patricia', 'Mendoza Sanchez'),
(3, '8818746', 'Martin Javier', 'Martinez Silva'),
(4, '9604596', 'Miguel Angel', 'Guerrero Segura Ramirez'),
(5, '2224275', 'Eduardo', 'Velazquez Mora'),
(6, '9107355', 'Salomon Eduardo', 'Ibarra Chavez'),
(7, '8819238', 'Maria Susana', 'Ruiz Palacios');

INSERT INTO `departamento` (`idDepartamento`, `nombre`, `clave`, `abreviacion`, `idMaestros`) VALUES
(1, 'Ciencias Computacionales', '1500', 'DCC', 2),
(2, 'Electronica', '1510', 'DEPEL', 3);
INSERT INTO `academia` (`idAcademia`, `nombre`, `clave`, `idDepartamento`, `idMaestros`) VALUES
(1, 'Software de Sistemas', 'SOFSIS', 1, 6),
(2, 'Electronica Analogica Aplicada', 'ELEAPL', 2, 3),
(3, 'Sistemas de Comunicacion', 'SISCOM', 2, 7),
(4, 'Comunicaciones', 'COM', 2, 1);

INSERT INTO `materia` (`idMateria`, `nombre`, `clave`, `idAcademia`) VALUES
(1, 'Electronica Analogica', 'ET217', 2),
(2, 'Electronica Industrial', 'ET219', 2),
(3, 'Electronica de Alta Frecuencia', 'ET304', 2),
(4, 'Antenas', 'ET300', 3),
(5, 'Señalizacion y Sincronizacion', 'ET317', 3);

INSERT INTO `curso` (`idCurso`, `idCiclo`, `idMateria`, `nrc`, `seccion`) VALUES
(1, 1, 1, '02845', 'D01'),(2, 1, 1, '02846', 'D02'),(3, 2, 3, '01234', 'D05'),(4, 2, 4, '01478', 'D12'),(5, 1, 5, '01598', 'D07');



INSERT INTO `horario` (`idHorario`, `idCurso`, `dia`, `inicio`, `fin`, `horas`, `teoria_practica`, `idEdificios`, `idAulas`) VALUES
(1, 1, 'L', '0700', '0855', 2, 1, 1, 8),
(2, 1, 'I', '0700', '0755', 1, 2, 2, 9);