SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`ciclo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ciclo` (
  `idCiclo` INT NOT NULL AUTO_INCREMENT,
  `ciclo` VARCHAR(6) NULL,
  `inicio` DATE NULL,
  `fin` DATE NULL,
  PRIMARY KEY (`idCiclo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`maestros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`maestros` (
  `idMaestros` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(45) NULL,
  `nombres` VARCHAR(45) NULL,
  `apellidos` VARCHAR(45) NULL,
  PRIMARY KEY (`idMaestros`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`departamento` (
  `idDepartamento` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `clave` VARCHAR(45) NULL,
  `abreviacion` VARCHAR(45) NULL,
  `idMaestros` INT NOT NULL,
  PRIMARY KEY (`idDepartamento`),
  INDEX `fk_departamento_maestros1_idx` (`idMaestros` ASC),
  CONSTRAINT `fk_departamento_maestros1`
    FOREIGN KEY (`idMaestros`)
    REFERENCES `mydb`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`academia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`academia` (
  `idAcademia` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `clave` VARCHAR(45) NULL,
  `idMaestros` INT NOT NULL,
  `departamento_idDepartamento` INT NOT NULL,
  PRIMARY KEY (`idAcademia`, `departamento_idDepartamento`),
  INDEX `fk_academia_maestros1_idx` (`idMaestros` ASC),
  INDEX `fk_academia_departamento1_idx` (`departamento_idDepartamento` ASC),
  CONSTRAINT `fk_academia_maestros1`
    FOREIGN KEY (`idMaestros`)
    REFERENCES `mydb`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_academia_departamento1`
    FOREIGN KEY (`departamento_idDepartamento`)
    REFERENCES `mydb`.`departamento` (`idDepartamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`materia` (
  `idMateria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `clave` VARCHAR(5) NULL,
  PRIMARY KEY (`idMateria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`curso` (
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
    REFERENCES `mydb`.`ciclo` (`idCiclo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Curso_Materia1`
    FOREIGN KEY (`idMateria`)
    REFERENCES `mydb`.`materia` (`idMateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`edificios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`edificios` (
  `idEdificios` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`idEdificios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`aulas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`aulas` (
  `idAulas` INT NOT NULL AUTO_INCREMENT,
  `aula` VARCHAR(45) NULL,
  PRIMARY KEY (`idAulas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`horario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`horario` (
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
    REFERENCES `mydb`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_horario_Edificios1`
    FOREIGN KEY (`idEdificios`)
    REFERENCES `mydb`.`edificios` (`idEdificios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_horario_Aulas1`
    FOREIGN KEY (`idAulas`)
    REFERENCES `mydb`.`aulas` (`idAulas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`nombramiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`nombramiento` (
  `idNombramiento` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(5) NULL,
  `nombre` VARCHAR(45) NULL,
  `horas` INT NULL,
  PRIMARY KEY (`idNombramiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`suplencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`suplencia` (
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
    REFERENCES `mydb`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_suplencia_curso1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `mydb`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`asistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`asistencia` (
  `idAsistencia` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL,
  `dia` VARCHAR(45) NULL,
  `asistencia` SMALLINT NULL,
  `idCurso` INT NOT NULL,
  PRIMARY KEY (`idAsistencia`),
  INDEX `fk_asistencia_curso1_idx` (`idCurso` ASC),
  CONSTRAINT `fk_asistencia_curso1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `mydb`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`evidencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`evidencias` (
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
    REFERENCES `mydb`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`observaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`observaciones` (
  `idObservaciones` INT NOT NULL AUTO_INCREMENT,
  `observacion` VARCHAR(150) NULL,
  `fechaRealizada` DATE NULL,
  `fechaSolucionada` DATE NULL,
  `idEvidencias` INT NOT NULL,
  PRIMARY KEY (`idObservaciones`),
  INDEX `fk_observaciones_evidencias1_idx` (`idEvidencias` ASC),
  CONSTRAINT `fk_observaciones_evidencias1`
    FOREIGN KEY (`idEvidencias`)
    REFERENCES `mydb`.`evidencias` (`idEvidencias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`temporal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`temporal` (
  `idTemporal` INT NOT NULL AUTO_INCREMENT,
  `idNombramiento` INT NOT NULL,
  `idMaestros` INT NOT NULL,
  PRIMARY KEY (`idTemporal`),
  INDEX `fk_asignatura_homologacion1_idx` (`idNombramiento` ASC),
  INDEX `fk_asignatura_maestros1_idx` (`idMaestros` ASC),
  CONSTRAINT `fk_asignatura_homologacion1`
    FOREIGN KEY (`idNombramiento`)
    REFERENCES `mydb`.`nombramiento` (`idNombramiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignatura_maestros1`
    FOREIGN KEY (`idMaestros`)
    REFERENCES `mydb`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`definitivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`definitivo` (
  `idDefinitivo` INT NOT NULL AUTO_INCREMENT,
  `idNombramiento` INT NOT NULL,
  `idMaestros` INT NOT NULL,
  PRIMARY KEY (`idDefinitivo`),
  INDEX `fk_nombramiento_homologacion1_idx` (`idNombramiento` ASC),
  INDEX `fk_nombramiento_maestros1_idx` (`idMaestros` ASC),
  CONSTRAINT `fk_nombramiento_homologacion1`
    FOREIGN KEY (`idNombramiento`)
    REFERENCES `mydb`.`nombramiento` (`idNombramiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_nombramiento_maestros1`
    FOREIGN KEY (`idMaestros`)
    REFERENCES `mydb`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`impartes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`impartes` (
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
    REFERENCES `mydb`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_impartes_curso1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `mydb`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuarios` (
  `idUsuarios` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(64) NOT NULL,
  `contraseña` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`idUsuarios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`privilegios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`privilegios` (
  `idPrivilegios` INT NOT NULL AUTO_INCREMENT,
  `tipo` INT NULL,
  `descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`idPrivilegios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`roles` (
  `idRoles` INT NOT NULL AUTO_INCREMENT,
  `idUsuarios` INT NOT NULL,
  `idPrivilegios` INT NOT NULL,
  PRIMARY KEY (`idRoles`),
  INDEX `fk_roles_usuarios1_idx` (`idUsuarios` ASC),
  INDEX `fk_roles_privilegios1_idx` (`idPrivilegios` ASC),
  CONSTRAINT `fk_roles_usuarios1`
    FOREIGN KEY (`idUsuarios`)
    REFERENCES `mydb`.`usuarios` (`idUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_privilegios1`
    FOREIGN KEY (`idPrivilegios`)
    REFERENCES `mydb`.`privilegios` (`idPrivilegios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`maestrosUsuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`maestrosUsuarios` (
  `idMaestrosUsuarios` INT NOT NULL AUTO_INCREMENT,
  `idMaestros` INT NOT NULL,
  `idUsuarios` INT NOT NULL,
  PRIMARY KEY (`idMaestrosUsuarios`),
  INDEX `fk_maestrosUsuarios_maestros1_idx` (`idMaestros` ASC),
  INDEX `fk_maestrosUsuarios_usuarios1_idx` (`idUsuarios` ASC),
  CONSTRAINT `fk_maestrosUsuarios_maestros1`
    FOREIGN KEY (`idMaestros`)
    REFERENCES `mydb`.`maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_maestrosUsuarios_usuarios1`
    FOREIGN KEY (`idUsuarios`)
    REFERENCES `mydb`.`usuarios` (`idUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tipoPermiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tipoPermiso` (
  `idTipoPermiso` INT NOT NULL AUTO_INCREMENT,
  `tipoPermiso` VARCHAR(45) NULL,
  `cantidadMax` INT NULL,
  PRIMARY KEY (`idTipoPermiso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`permisos` (
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
    REFERENCES `mydb`.`tipoPermiso` (`idTipoPermiso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`cursoPermiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cursoPermiso` (
  `idCursoPermiso` INT NOT NULL,
  `idPermisos` INT NOT NULL,
  `idCurso` INT NOT NULL,
  PRIMARY KEY (`idCursoPermiso`),
  INDEX `fk_cursoPermiso_permisos1_idx` (`idPermisos` ASC),
  INDEX `fk_cursoPermiso_curso1_idx` (`idCurso` ASC),
  CONSTRAINT `fk_cursoPermiso_permisos1`
    FOREIGN KEY (`idPermisos`)
    REFERENCES `mydb`.`permisos` (`idPermisos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cursoPermiso_curso1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `mydb`.`curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`carreras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`carreras` (
  `idCarreras` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `clave` VARCHAR(45) NULL,
  PRIMARY KEY (`idCarreras`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`materiasCarrera`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`materiasCarrera` (
  `idMateriasCarrera` INT NOT NULL AUTO_INCREMENT,
  `idCarreras` INT NOT NULL,
  `idMateria` INT NOT NULL,
  `idAcademia` INT NOT NULL,
  PRIMARY KEY (`idMateriasCarrera`),
  INDEX `fk_MateriasCarrera_carreras1_idx` (`idCarreras` ASC),
  INDEX `fk_MateriasCarrera_materia1_idx` (`idMateria` ASC, `idAcademia` ASC),
  CONSTRAINT `fk_MateriasCarrera_carreras1`
    FOREIGN KEY (`idCarreras`)
    REFERENCES `mydb`.`carreras` (`idCarreras`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MateriasCarrera_materia1`
    FOREIGN KEY (`idMateria`)
    REFERENCES `mydb`.`materia` (`idMateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`edificioAulas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`edificioAulas` (
  `idedificioAulas` INT NOT NULL AUTO_INCREMENT,
  `idEdificios` INT NOT NULL,
  `idAulas` INT NOT NULL,
  PRIMARY KEY (`idedificioAulas`),
  INDEX `fk_edificioAulas_edificios1_idx` (`idEdificios` ASC),
  INDEX `fk_edificioAulas_aulas1_idx` (`idAulas` ASC),
  CONSTRAINT `fk_edificioAulas_edificios1`
    FOREIGN KEY (`idEdificios`)
    REFERENCES `mydb`.`edificios` (`idEdificios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_edificioAulas_aulas1`
    FOREIGN KEY (`idAulas`)
    REFERENCES `mydb`.`aulas` (`idAulas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`mateirasAcademia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`mateirasAcademia` (
  `idMateirasAcademis` INT NOT NULL AUTO_INCREMENT,
  `idMateria` INT NOT NULL,
  `idAcademia` INT NOT NULL,
  PRIMARY KEY (`idMateirasAcademis`),
  INDEX `fk_MateirasAcademis_materia1_idx` (`idMateria` ASC),
  INDEX `fk_MateirasAcademis_academia1_idx` (`idAcademia` ASC),
  CONSTRAINT `fk_MateirasAcademis_materia1`
    FOREIGN KEY (`idMateria`)
    REFERENCES `mydb`.`materia` (`idMateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MateirasAcademis_academia1`
    FOREIGN KEY (`idAcademia`)
    REFERENCES `mydb`.`academia` (`idAcademia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `mydb` ;

-- -----------------------------------------------------
-- Placeholder table for view `mydb`.`incidencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`incidencia` (`fecha` INT, `abreviacion` INT, `nombre` INT, `seccion` INT);

-- -----------------------------------------------------
-- Placeholder table for view `mydb`.`horariosImparte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`horariosImparte` (`codigo` INT, `nombres` INT, `apellidos` INT, `nombre` INT, `nrc` INT, `seccion` INT, `dia` INT, `inicio` INT, `fin` INT, `nomedificio` INT, `aula` INT, `inicioimparte` INT, `finimparte` INT);

-- -----------------------------------------------------
-- Placeholder table for view `mydb`.`jefesDpto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`jefesDpto` (`codigo` INT, `nombres` INT, `apellidos` INT, `nombre` INT, `abreviacion` INT);

-- -----------------------------------------------------
-- Placeholder table for view `mydb`.`jefesAcademia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`jefesAcademia` (`codigo` INT, `nombres` INT, `apellidos` INT, `nombre` INT);

-- -----------------------------------------------------
-- Placeholder table for view `mydb`.`horariosSuplencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`horariosSuplencia` (`codigo` INT, `nombres` INT, `apellidos` INT, `nombre` INT, `nrc` INT, `seccion` INT, `dia` INT, `inicio` INT, `fin` INT, `nomedificio` INT, `aula` INT, `iniciosuplencia` INT, `finsuplencia` INT);

-- -----------------------------------------------------
-- Placeholder table for view `mydb`.`integrantesAcademia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`integrantesAcademia` (`codigo` INT, `nombres` INT, `apellidos` INT, `nommat` INT, `nrc` INT, `seccion` INT, `nomaca` INT);

-- -----------------------------------------------------
-- Placeholder table for view `mydb`.`carrerasDepartamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`carrerasDepartamento` (`nombre` INT, `clave` INT, `nomDep` INT);

-- -----------------------------------------------------
-- View `mydb`.`incidencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`incidencia`;
USE `mydb`;
CREATE  OR REPLACE VIEW `incidencia` AS SELECt asis.fecha, dep.abreviacion,mat.nombre,cur.seccion
FROM asistencia asis 
JOIN curso cur ON asis.idCurso=cur.idCurso AND asis.asistencia = 0
JOIN materia mat ON mat.idMateria=cur.idMateria
JOIN academia aca ON aca.idAcademia=mat.idAcademia
JOIN departamento dep ON dep.idDepartamento=aca.idDepartamento;

-- -----------------------------------------------------
-- View `mydb`.`horariosImparte`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`horariosImparte`;
USE `mydb`;
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
-- View `mydb`.`jefesDpto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`jefesDpto`;
USE `mydb`;
CREATE  OR REPLACE VIEW `jefesDpto` AS
SELECT ma.codigo,ma.nombres,ma.apellidos,d.nombre,d.abreviacion
FROM maestros ma 
JOIN departamento d ON ma.idMaestros =  d.idMaestros
;

-- -----------------------------------------------------
-- View `mydb`.`jefesAcademia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`jefesAcademia`;
USE `mydb`;
CREATE  OR REPLACE VIEW `jefesAcademia` AS
SELECT ma.codigo,ma.nombres,ma.apellidos,aca.nombre
FROM maestros ma 
JOIN academia aca ON ma.idMaestros =  aca.idMaestros;

-- -----------------------------------------------------
-- View `mydb`.`horariosSuplencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`horariosSuplencia`;
USE `mydb`;
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
-- View `mydb`.`integrantesAcademia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`integrantesAcademia`;
USE `mydb`;
CREATE  OR REPLACE VIEW `integrantesAcademia` AS
SELECT ma.codigo,ma.nombres,ma.apellidos,m.nombre as nommat,cu.nrc,cu.seccion,a.nombre as nomaca 
FROM maestros ma
JOIN impartes im ON ma.idMaestros = im.idMaestros
JOIN curso cu ON im.idCurso = cu.idCurso
JOIN materia m ON m.idMateria = cu.idMateria
JOIN academia a ON a.idAcademia = m.idAcademia;

-- -----------------------------------------------------
-- View `mydb`.`carrerasDepartamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`carrerasDepartamento`;
USE `mydb`;
CREATE  OR REPLACE VIEW `carrerasDepartamento` AS
SELECT ca.nombre,ca.clave,d.nombre as nomDep
FROM carreras ca
JOIN materiasCarrera mc ON ca.idCarreras=mc.idCarreras
JOIN materia ma ON ma.idMateria=mc.idMateria
JOIN academia a on a.idAcademia=ma.idAcademia
JOIN departamento d on d.idDepartamento=a.idDepartamento
GROUP BY d.idDepartamento
;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
