SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `control-profesores` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `control-profesores` ;

-- -----------------------------------------------------
-- Table `control-profesores`.`ciclo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`ciclo` (
  `idCiclo` INT NOT NULL AUTO_INCREMENT,
  `ciclo` VARCHAR(6) NULL,
  `inicio` DATE NULL,
  `fin` DATE NULL,
  PRIMARY KEY (`idCiclo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`estatus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`estatus` (
  `idestatus` INT NOT NULL AUTO_INCREMENT,
  `estatus` VARCHAR(1) NOT NULL,
  `descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`idestatus`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`maestros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`maestros` (
  `idMaestros` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(7) NOT NULL,
  `nombres` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `idestatus` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idMaestros`),
  INDEX `fk_maestros_estatus1_idx` (`idestatus` ASC),
  CONSTRAINT `fk_maestros_estatus1`
    FOREIGN KEY (`idestatus`)
    REFERENCES `control-profesores`.`estatus` (`idestatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`departamento` (
  `idDepartamento` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `clave` VARCHAR(45) NULL,
  `abreviacion` VARCHAR(45) NULL,
  `idMaestros` INT NOT NULL,
  PRIMARY KEY (`idDepartamento`),
  INDEX `fk_departamento_maestros1_idx` (`idMaestros` ASC),
  CONSTRAINT `fk_departamento_maestros1`
    FOREIGN KEY (`idMaestros`)
    REFERENCES `control-profesores`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`academia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`academia` (
  `idAcademia` INT NOT NULL AUTO_INCREMENT,
  `abreviacion` VARCHAR(45) NULL,
  `nombre` VARCHAR(45) NULL,
  `clave` VARCHAR(45) NULL,
  `idMaestros` INT NOT NULL,
  `idDepartamento` INT NOT NULL,
  PRIMARY KEY (`idAcademia`),
  INDEX `fk_academia_maestros1_idx` (`idMaestros` ASC),
  INDEX `fk_academia_departamento1_idx` (`idDepartamento` ASC),
  CONSTRAINT `fk_academia_maestros1`
    FOREIGN KEY (`idMaestros`)
    REFERENCES `control-profesores`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_academia_departamento1`
    FOREIGN KEY (`idDepartamento`)
    REFERENCES `control-profesores`.`departamento` (`idDepartamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`materia` (
  `idMateria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `clave` VARCHAR(5) NULL,
  `idAcademia` INT NOT NULL,
  PRIMARY KEY (`idMateria`),
  INDEX `fk_materia_academia1_idx` (`idAcademia` ASC),
  CONSTRAINT `fk_materia_academia1`
    FOREIGN KEY (`idAcademia`)
    REFERENCES `control-profesores`.`academia` (`idAcademia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`curso` (
  `idCurso` INT NOT NULL AUTO_INCREMENT,
  `idCiclo` INT NOT NULL,
  `idMateria` INT NOT NULL,
  `nrc` VARCHAR(10) NULL,
  `seccion` VARCHAR(3) NULL,
  PRIMARY KEY (`idCurso`),
  INDEX `fk_Curso_Ciclo1_idx` (`idCiclo` ASC),
  INDEX `fk_Curso_Materia1_idx` (`idMateria` ASC),
  CONSTRAINT `fk_Curso_Ciclo1`
    FOREIGN KEY (`idCiclo`)
    REFERENCES `control-profesores`.`ciclo` (`idCiclo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Curso_Materia1`
    FOREIGN KEY (`idMateria`)
    REFERENCES `control-profesores`.`materia` (`idMateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`edificios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`edificios` (
  `idEdificios` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`idEdificios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`aulas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`aulas` (
  `idAulas` INT NOT NULL AUTO_INCREMENT,
  `aula` VARCHAR(45) NULL,
  PRIMARY KEY (`idAulas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`horario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`horario` (
  `idHorario` INT NOT NULL AUTO_INCREMENT,
  `idCurso` INT NOT NULL,
  `dia` VARCHAR(1) NULL,
  `inicio` VARCHAR(4) NULL,
  `fin` VARCHAR(4) NULL,
  `horas` INT NULL,
  `teoria_practica` INT NULL,
  `idEdificios` INT NOT NULL,
  `idAulas` INT NOT NULL,
  PRIMARY KEY (`idHorario`),
  INDEX `fk_horario_Curso1_idx` (`idCurso` ASC),
  INDEX `fk_horario_Edificios1_idx` (`idEdificios` ASC),
  INDEX `fk_horario_Aulas1_idx` (`idAulas` ASC),
  CONSTRAINT `fk_horario_Curso1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `control-profesores`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_horario_Edificios1`
    FOREIGN KEY (`idEdificios`)
    REFERENCES `control-profesores`.`edificios` (`idEdificios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_horario_Aulas1`
    FOREIGN KEY (`idAulas`)
    REFERENCES `control-profesores`.`aulas` (`idAulas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`nombramiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`nombramiento` (
  `idNombramiento` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(5) NULL,
  `nombre` VARCHAR(45) NULL,
  `horas` INT NULL,
  PRIMARY KEY (`idNombramiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`suplencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`suplencia` (
  `idSuplencia` INT NOT NULL AUTO_INCREMENT,
  `inicio` DATE NULL,
  `fin` DATE NULL,
  `idMaestros` INT NOT NULL,
  `idCurso` INT NOT NULL,
  PRIMARY KEY (`idSuplencia`),
  INDEX `fk_suplencia_maestros1_idx` (`idMaestros` ASC),
  INDEX `fk_suplencia_curso1_idx` (`idCurso` ASC),
  CONSTRAINT `fk_suplencia_maestros1`
    FOREIGN KEY (`idMaestros`)
    REFERENCES `control-profesores`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_suplencia_curso1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `control-profesores`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`asistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`asistencia` (
  `idAsistencia` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL,
  `dia` VARCHAR(45) NULL,
  `asistencia` SMALLINT NULL,
  `idCurso` INT NOT NULL,
  PRIMARY KEY (`idAsistencia`),
  INDEX `fk_asistencia_curso1_idx` (`idCurso` ASC),
  CONSTRAINT `fk_asistencia_curso1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `control-profesores`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`evidencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`evidencias` (
  `idEvidencias` INT NOT NULL AUTO_INCREMENT,
  `ruta` VARCHAR(150) NULL,
  `status` SMALLINT NULL,
  `valor` SMALLINT NULL,
  `indicereprobacion` INT NULL,
  `idCurso` INT NOT NULL,
  PRIMARY KEY (`idEvidencias`),
  INDEX `fk_evidencias_curso1_idx` (`idCurso` ASC),
  CONSTRAINT `fk_evidencias_curso1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `control-profesores`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`observaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`observaciones` (
  `idObservaciones` INT NOT NULL AUTO_INCREMENT,
  `observacion` VARCHAR(150) NULL,
  `fechaRealizada` DATE NULL,
  `fechaSolucionada` DATE NULL,
  `idEvidencias` INT NOT NULL,
  `status` INT NULL,
  PRIMARY KEY (`idObservaciones`),
  INDEX `fk_observaciones_evidencias1_idx` (`idEvidencias` ASC),
  CONSTRAINT `fk_observaciones_evidencias1`
    FOREIGN KEY (`idEvidencias`)
    REFERENCES `control-profesores`.`evidencias` (`idEvidencias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`temporal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`temporal` (
  `idTemporal` INT NOT NULL AUTO_INCREMENT,
  `idNombramiento` INT NOT NULL,
  `idMaestros` INT NOT NULL,
  PRIMARY KEY (`idTemporal`),
  INDEX `fk_asignatura_homologacion1_idx` (`idNombramiento` ASC),
  INDEX `fk_asignatura_maestros1_idx` (`idMaestros` ASC),
  CONSTRAINT `fk_asignatura_homologacion1`
    FOREIGN KEY (`idNombramiento`)
    REFERENCES `control-profesores`.`nombramiento` (`idNombramiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignatura_maestros1`
    FOREIGN KEY (`idMaestros`)
    REFERENCES `control-profesores`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`definitivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`definitivo` (
  `idDefinitivo` INT NOT NULL AUTO_INCREMENT,
  `idNombramiento` INT NOT NULL,
  `idMaestros` INT NOT NULL,
  PRIMARY KEY (`idDefinitivo`),
  INDEX `fk_nombramiento_homologacion1_idx` (`idNombramiento` ASC),
  INDEX `fk_nombramiento_maestros1_idx` (`idMaestros` ASC),
  CONSTRAINT `fk_nombramiento_homologacion1`
    FOREIGN KEY (`idNombramiento`)
    REFERENCES `control-profesores`.`nombramiento` (`idNombramiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_nombramiento_maestros1`
    FOREIGN KEY (`idMaestros`)
    REFERENCES `control-profesores`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`impartes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`impartes` (
  `idImpartes` INT NOT NULL AUTO_INCREMENT,
  `inicio` DATE NULL,
  `fin` DATE NULL,
  `idMaestros` INT NOT NULL,
  `idCurso` INT NOT NULL,
  PRIMARY KEY (`idImpartes`),
  INDEX `fk_impartes_maestros1_idx` (`idMaestros` ASC),
  INDEX `fk_impartes_curso1_idx` (`idCurso` ASC),
  CONSTRAINT `fk_impartes_maestros1`
    FOREIGN KEY (`idMaestros`)
    REFERENCES `control-profesores`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_impartes_curso1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `control-profesores`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`usuarios` (
  `idUsuarios` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(7) NOT NULL,
  `contraseña` VARCHAR(32) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  `idestatus` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idUsuarios`),
  INDEX `fk_usuarios_estatus1_idx` (`idestatus` ASC),
  CONSTRAINT `fk_usuarios_estatus1`
    FOREIGN KEY (`idestatus`)
    REFERENCES `control-profesores`.`estatus` (`idestatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`privilegios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`privilegios` (
  `idPrivilegios` INT NOT NULL AUTO_INCREMENT,
  `tipo` INT NULL,
  `descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`idPrivilegios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`roles` (
  `idRoles` INT NOT NULL AUTO_INCREMENT,
  `idUsuarios` INT NOT NULL,
  `idPrivilegios` INT NOT NULL,
  PRIMARY KEY (`idRoles`),
  INDEX `fk_roles_usuarios1_idx` (`idUsuarios` ASC),
  INDEX `fk_roles_privilegios1_idx` (`idPrivilegios` ASC),
  CONSTRAINT `fk_roles_usuarios1`
    FOREIGN KEY (`idUsuarios`)
    REFERENCES `control-profesores`.`usuarios` (`idUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_privilegios1`
    FOREIGN KEY (`idPrivilegios`)
    REFERENCES `control-profesores`.`privilegios` (`idPrivilegios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`tipoPermiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`tipoPermiso` (
  `idTipoPermiso` INT NOT NULL AUTO_INCREMENT,
  `tipoPermiso` VARCHAR(45) NULL,
  `cantidadMax` INT NULL,
  PRIMARY KEY (`idTipoPermiso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`permisos` (
  `idPermisos` INT NOT NULL AUTO_INCREMENT,
  `fechaInicio` DATE NULL,
  `fechaFin` DATE NULL,
  `fechaRecepcion` DATE NULL,
  `causa` VARCHAR(200) NULL,
  `idTipoPermiso` INT NOT NULL,
  PRIMARY KEY (`idPermisos`),
  INDEX `fk_permisos_tipoPermiso1_idx` (`idTipoPermiso` ASC),
  CONSTRAINT `fk_permisos_tipoPermiso1`
    FOREIGN KEY (`idTipoPermiso`)
    REFERENCES `control-profesores`.`tipoPermiso` (`idTipoPermiso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`cursoPermiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`cursoPermiso` (
  `idCursoPermiso` INT NOT NULL,
  `idPermisos` INT NOT NULL,
  `idCurso` INT NOT NULL,
  PRIMARY KEY (`idCursoPermiso`),
  INDEX `fk_cursoPermiso_permisos1_idx` (`idPermisos` ASC),
  INDEX `fk_cursoPermiso_curso1_idx` (`idCurso` ASC),
  CONSTRAINT `fk_cursoPermiso_permisos1`
    FOREIGN KEY (`idPermisos`)
    REFERENCES `control-profesores`.`permisos` (`idPermisos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cursoPermiso_curso1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `control-profesores`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`carreras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`carreras` (
  `idCarreras` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(70) NOT NULL,
  `clave` VARCHAR(4) NOT NULL,
  PRIMARY KEY (`idCarreras`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`materiasCarrera`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`materiasCarrera` (
  `idMateriasCarrera` INT NOT NULL AUTO_INCREMENT,
  `idCarreras` INT NOT NULL,
  `idMateria` INT NOT NULL,
  PRIMARY KEY (`idMateriasCarrera`),
  INDEX `fk_MateriasCarrera_carreras1_idx` (`idCarreras` ASC),
  INDEX `fk_MateriasCarrera_materia1_idx` (`idMateria` ASC),
  CONSTRAINT `fk_MateriasCarrera_carreras1`
    FOREIGN KEY (`idCarreras`)
    REFERENCES `control-profesores`.`carreras` (`idCarreras`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MateriasCarrera_materia1`
    FOREIGN KEY (`idMateria`)
    REFERENCES `control-profesores`.`materia` (`idMateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `control-profesores`.`edificioAulas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`edificioAulas` (
  `idedificioAulas` INT NOT NULL AUTO_INCREMENT,
  `idEdificios` INT NOT NULL,
  `idAulas` INT NOT NULL,
  PRIMARY KEY (`idedificioAulas`),
  INDEX `fk_edificioAulas_edificios1_idx` (`idEdificios` ASC),
  INDEX `fk_edificioAulas_aulas1_idx` (`idAulas` ASC),
  CONSTRAINT `fk_edificioAulas_edificios1`
    FOREIGN KEY (`idEdificios`)
    REFERENCES `control-profesores`.`edificios` (`idEdificios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_edificioAulas_aulas1`
    FOREIGN KEY (`idAulas`)
    REFERENCES `control-profesores`.`aulas` (`idAulas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `control-profesores` ;

-- -----------------------------------------------------
-- Placeholder table for view `control-profesores`.`incidencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`incidencia` (`fecha` INT, `abreviacion` INT, `nombre` INT, `seccion` INT);

-- -----------------------------------------------------
-- Placeholder table for view `control-profesores`.`horariosImparte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`horariosImparte` (`codigo` INT, `nombres` INT, `apellidos` INT, `nombre` INT, `nrc` INT, `seccion` INT, `dia` INT, `inicio` INT, `fin` INT, `nomedificio` INT, `aula` INT, `inicioimparte` INT, `finimparte` INT);

-- -----------------------------------------------------
-- Placeholder table for view `control-profesores`.`jefesDpto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`jefesDpto` (`codigo` INT, `nombres` INT, `apellidos` INT, `nombre` INT, `abreviacion` INT);

-- -----------------------------------------------------
-- Placeholder table for view `control-profesores`.`jefesAcademia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`jefesAcademia` (`codigo` INT, `nombres` INT, `apellidos` INT, `nombre` INT);

-- -----------------------------------------------------
-- Placeholder table for view `control-profesores`.`horariosSuplencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`horariosSuplencia` (`codigo` INT, `nombres` INT, `apellidos` INT, `nombre` INT, `nrc` INT, `seccion` INT, `dia` INT, `inicio` INT, `fin` INT, `nomedificio` INT, `aula` INT, `iniciosuplencia` INT, `finsuplencia` INT);

-- -----------------------------------------------------
-- Placeholder table for view `control-profesores`.`integrantesAcademia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`integrantesAcademia` (`codigo` INT, `nombres` INT, `apellidos` INT, `nommat` INT, `nrc` INT, `seccion` INT, `nomaca` INT);

-- -----------------------------------------------------
-- Placeholder table for view `control-profesores`.`carrerasDepartamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`carrerasDepartamento` (`nombre` INT, `clave` INT, `nomDep` INT);

-- -----------------------------------------------------
-- Placeholder table for view `control-profesores`.`privilegiosUsuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `control-profesores`.`privilegiosUsuarios` (`nombre` INT, `tipo` INT, `descripcion` INT);

-- -----------------------------------------------------
-- View `control-profesores`.`incidencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `control-profesores`.`incidencia`;
USE `control-profesores`;
CREATE  OR REPLACE VIEW `incidencia` AS SELECt asis.fecha, dep.abreviacion,mat.nombre,cur.seccion
FROM asistencia asis 
JOIN curso cur ON asis.idCurso=cur.idCurso AND asis.asistencia = 0
JOIN materia mat ON mat.idMateria=cur.idMateria
JOIN academia aca ON aca.idAcademia=mat.idAcademia
JOIN departamento dep ON dep.idDepartamento=aca.idDepartamento;

-- -----------------------------------------------------
-- View `control-profesores`.`horariosImparte`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `control-profesores`.`horariosImparte`;
USE `control-profesores`;
CREATE  OR REPLACE VIEW `horariosImparte` AS 
SELECT ma.codigo,ma.nombres,ma.apellidos,mat.nombre,cu.nrc,cu.seccion,h.dia,h.inicio,h.fin,e.nombre as nomedificio,a.aula,im.inicio as inicioimparte,im.fin as finimparte
FROM curso cu 
JOIN horario h ON cu.idCurso=h.idCurso
JOIN edificios e ON e.idEdificios = h.idEdificios
JOIN aulas a ON a.idAulas = h.idAulas
JOIN materia mat ON mat.idMateria=cu.idMateria
JOIN impartes im ON cu.idCurso = im.idCurso
JOIN maestros ma ON ma.idMaestros = im.idMaestros;



-- -----------------------------------------------------
-- View `control-profesores`.`jefesDpto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `control-profesores`.`jefesDpto`;
USE `control-profesores`;
CREATE  OR REPLACE VIEW `jefesDpto` AS
SELECT ma.codigo,ma.nombres,ma.apellidos,d.nombre,d.abreviacion
FROM maestros ma 
JOIN departamento d ON ma.idMaestros =  d.idMaestros
;

-- -----------------------------------------------------
-- View `control-profesores`.`jefesAcademia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `control-profesores`.`jefesAcademia`;
USE `control-profesores`;
CREATE  OR REPLACE VIEW `jefesAcademia` AS
SELECT ma.codigo,ma.nombres,ma.apellidos,aca.nombre
FROM maestros ma 
JOIN academia aca ON ma.idMaestros =  aca.idMaestros;

-- -----------------------------------------------------
-- View `control-profesores`.`horariosSuplencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `control-profesores`.`horariosSuplencia`;
USE `control-profesores`;
CREATE  OR REPLACE VIEW `horariosSuplencia` AS 
SELECT ma.codigo,ma.nombres,ma.apellidos,mat.nombre,cu.nrc,cu.seccion,h.dia,h.inicio,h.fin,e.nombre as nomedificio,a.aula,su.inicio as iniciosuplencia,su.fin as finsuplencia
FROM curso cu 
JOIN horario h ON cu.idCurso=h.idCurso
JOIN edificios e ON e.idEdificios = h.idEdificios
JOIN aulas a ON a.idAulas = h.idAulas
JOIN  materia mat ON mat.idMateria=cu.idMateria
JOIN suplencia su ON su.idCurso = cu.idCurso
JOIN maestros ma ON ma.idMaestros = su.idMaestros;


-- -----------------------------------------------------
-- View `control-profesores`.`integrantesAcademia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `control-profesores`.`integrantesAcademia`;
USE `control-profesores`;
CREATE  OR REPLACE VIEW `integrantesAcademia` AS
SELECT ma.codigo,ma.nombres,ma.apellidos,m.nombre as nommat,cu.nrc,cu.seccion,a.nombre as nomaca 
FROM maestros ma
JOIN impartes im ON ma.idMaestros = im.idMaestros
JOIN curso cu ON im.idCurso = cu.idCurso
JOIN materia m ON m.idMateria = cu.idMateria
JOIN academia a ON a.idAcademia = m.idAcademia;

-- -----------------------------------------------------
-- View `control-profesores`.`carrerasDepartamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `control-profesores`.`carrerasDepartamento`;
USE `control-profesores`;
CREATE  OR REPLACE VIEW `carrerasDepartamento` AS
SELECT ca.nombre,ca.clave,d.nombre as nomDep
FROM carreras ca
JOIN materiasCarrera mc ON ca.idCarreras=mc.idCarreras
JOIN materia ma ON ma.idMateria=mc.idMateria
JOIN academia a on a.idAcademia=ma.idAcademia
JOIN departamento d on d.idDepartamento=a.idDepartamento
GROUP BY d.idDepartamento
;

-- -----------------------------------------------------
-- View `control-profesores`.`privilegiosUsuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `control-profesores`.`privilegiosUsuarios`;
USE `control-profesores`;
CREATE  OR REPLACE VIEW `privilegiosUsuarios` AS
SELECT us.nombre,pr.tipo,pr.descripcion FROM usuarios us 
JOIN  roles ro ON ro.idUsuarios=us.idUsuarios
JOIN privilegios pr ON ro.idPrivilegios=pr.idPrivilegios;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
