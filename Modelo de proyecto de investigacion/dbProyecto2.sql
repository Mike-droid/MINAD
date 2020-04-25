-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ProyectosInvestigacion2
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ProyectosInvestigacion2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ProyectosInvestigacion2` DEFAULT CHARACTER SET utf8 ;
USE `ProyectosInvestigacion2` ;

-- -----------------------------------------------------
-- Table `ProyectosInvestigacion2`.`Docentes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProyectosInvestigacion2`.`Docentes` (
  `NumeroTrabajador` INT NOT NULL AUTO_INCREMENT,
  `CorreoDocente` VARCHAR(45) NOT NULL,
  `Nombres` VARCHAR(45) NOT NULL,
  `Apellidos` VARCHAR(45) NOT NULL,
  `Contrasena` VARCHAR(45) NOT NULL,
  `Telefono` VARCHAR(10) NULL,
  PRIMARY KEY (`NumeroTrabajador`),
  UNIQUE INDEX `idDocentes_UNIQUE` (`NumeroTrabajador` ASC) VISIBLE,
  UNIQUE INDEX `CorreoDocente_UNIQUE` (`CorreoDocente` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosInvestigacion2`.`Institucion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProyectosInvestigacion2`.`Institucion` (
  `idInstitucion` INT NOT NULL AUTO_INCREMENT,
  `NombreInstitucion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idInstitucion`),
  UNIQUE INDEX `idInstitucion_UNIQUE` (`idInstitucion` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosInvestigacion2`.`Convocatorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProyectosInvestigacion2`.`Convocatorias` (
  `idConvocatorias` INT NOT NULL AUTO_INCREMENT,
  `FechaConvocatoria` DATE NOT NULL,
  `Descripcion` VARCHAR(1000) NOT NULL,
  `Institucion_idInstitucion` INT NOT NULL,
  PRIMARY KEY (`idConvocatorias`, `Institucion_idInstitucion`),
  UNIQUE INDEX `idConvocatorias_UNIQUE` (`idConvocatorias` ASC) VISIBLE,
  INDEX `fk_Convocatorias_Institucion1_idx` (`Institucion_idInstitucion` ASC) VISIBLE,
  CONSTRAINT `fk_Convocatorias_Institucion1`
    FOREIGN KEY (`Institucion_idInstitucion`)
    REFERENCES `ProyectosInvestigacion2`.`Institucion` (`idInstitucion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosInvestigacion2`.`Proyectos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProyectosInvestigacion2`.`Proyectos` (
  `idProyectos` INT NOT NULL AUTO_INCREMENT,
  `NombreProyecto` VARCHAR(45) NOT NULL,
  `FechaInicio` DATE NOT NULL,
  `FechaFin` DATE NULL,
  `Docentes_NumeroTrabajador` INT NOT NULL,
  `Convocatorias_idConvocatorias` INT NOT NULL,
  PRIMARY KEY (`idProyectos`, `Docentes_NumeroTrabajador`, `Convocatorias_idConvocatorias`),
  UNIQUE INDEX `idProyectos_UNIQUE` (`idProyectos` ASC) VISIBLE,
  INDEX `fk_Proyectos_Docentes1_idx` (`Docentes_NumeroTrabajador` ASC) VISIBLE,
  INDEX `fk_Proyectos_Convocatorias1_idx` (`Convocatorias_idConvocatorias` ASC) VISIBLE,
  CONSTRAINT `fk_Proyectos_Docentes1`
    FOREIGN KEY (`Docentes_NumeroTrabajador`)
    REFERENCES `ProyectosInvestigacion2`.`Docentes` (`NumeroTrabajador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Proyectos_Convocatorias1`
    FOREIGN KEY (`Convocatorias_idConvocatorias`)
    REFERENCES `ProyectosInvestigacion2`.`Convocatorias` (`idConvocatorias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosInvestigacion2`.`Evidencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProyectosInvestigacion2`.`Evidencias` (
  `idEvidencias` INT NOT NULL,
  `Evidencia` VARCHAR(100) NOT NULL,
  `Proyectos_idProyectos` INT NOT NULL,
  `Proyectos_Docentes_NumeroTrabajador` INT NOT NULL,
  PRIMARY KEY (`idEvidencias`, `Proyectos_idProyectos`, `Proyectos_Docentes_NumeroTrabajador`),
  UNIQUE INDEX `idEvidencias_UNIQUE` (`idEvidencias` ASC) VISIBLE,
  INDEX `fk_Evidencias_Proyectos1_idx` (`Proyectos_idProyectos` ASC, `Proyectos_Docentes_NumeroTrabajador` ASC) VISIBLE,
  CONSTRAINT `fk_Evidencias_Proyectos1`
    FOREIGN KEY (`Proyectos_idProyectos` , `Proyectos_Docentes_NumeroTrabajador`)
    REFERENCES `ProyectosInvestigacion2`.`Proyectos` (`idProyectos` , `Docentes_NumeroTrabajador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosInvestigacion2`.`Carrera`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProyectosInvestigacion2`.`Carrera` (
  `idCarrera` INT NOT NULL AUTO_INCREMENT,
  `NombreCarrera` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCarrera`),
  UNIQUE INDEX `idCarrera_UNIQUE` (`idCarrera` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosInvestigacion2`.`Alumnos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProyectosInvestigacion2`.`Alumnos` (
  `NumeroControl` INT NOT NULL AUTO_INCREMENT,
  `CorreoAlumno` VARCHAR(45) NOT NULL,
  `Nombres` VARCHAR(45) NOT NULL,
  `Apellidos` VARCHAR(45) NOT NULL,
  `Proyectos_idProyectos` INT NOT NULL,
  `Proyectos_Docentes_NumeroTrabajador` INT NOT NULL,
  `Carrera_idCarrera` INT NOT NULL,
  PRIMARY KEY (`NumeroControl`, `Proyectos_idProyectos`, `Proyectos_Docentes_NumeroTrabajador`, `Carrera_idCarrera`),
  UNIQUE INDEX `idAlumnos_UNIQUE` (`NumeroControl` ASC) VISIBLE,
  UNIQUE INDEX `CorreoAlumno_UNIQUE` (`CorreoAlumno` ASC) VISIBLE,
  INDEX `fk_Alumnos_Proyectos1_idx` (`Proyectos_idProyectos` ASC, `Proyectos_Docentes_NumeroTrabajador` ASC) VISIBLE,
  INDEX `fk_Alumnos_Carrera1_idx` (`Carrera_idCarrera` ASC) VISIBLE,
  CONSTRAINT `fk_Alumnos_Proyectos1`
    FOREIGN KEY (`Proyectos_idProyectos` , `Proyectos_Docentes_NumeroTrabajador`)
    REFERENCES `ProyectosInvestigacion2`.`Proyectos` (`idProyectos` , `Docentes_NumeroTrabajador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Alumnos_Carrera1`
    FOREIGN KEY (`Carrera_idCarrera`)
    REFERENCES `ProyectosInvestigacion2`.`Carrera` (`idCarrera`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosInvestigacion2`.`Reporte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProyectosInvestigacion2`.`Reporte` (
  `idReporte` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(1000) NOT NULL,
  `Proyectos_idProyectos` INT NOT NULL,
  `Proyectos_Docentes_NumeroTrabajador` INT NOT NULL,
  PRIMARY KEY (`idReporte`, `Proyectos_idProyectos`, `Proyectos_Docentes_NumeroTrabajador`),
  UNIQUE INDEX `idReporte_UNIQUE` (`idReporte` ASC) VISIBLE,
  INDEX `fk_Reporte_Proyectos1_idx` (`Proyectos_idProyectos` ASC, `Proyectos_Docentes_NumeroTrabajador` ASC) VISIBLE,
  CONSTRAINT `fk_Reporte_Proyectos1`
    FOREIGN KEY (`Proyectos_idProyectos` , `Proyectos_Docentes_NumeroTrabajador`)
    REFERENCES `ProyectosInvestigacion2`.`Proyectos` (`idProyectos` , `Docentes_NumeroTrabajador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosInvestigacion2`.`Institucion_has_Carrera`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ProyectosInvestigacion2`.`Institucion_has_Carrera` (
  `Institucion_idInstitucion` INT NOT NULL,
  `Carrera_idCarrera` INT NOT NULL,
  PRIMARY KEY (`Institucion_idInstitucion`, `Carrera_idCarrera`),
  INDEX `fk_Institucion_has_Carrera_Carrera1_idx` (`Carrera_idCarrera` ASC) VISIBLE,
  INDEX `fk_Institucion_has_Carrera_Institucion1_idx` (`Institucion_idInstitucion` ASC) VISIBLE,
  CONSTRAINT `fk_Institucion_has_Carrera_Institucion1`
    FOREIGN KEY (`Institucion_idInstitucion`)
    REFERENCES `ProyectosInvestigacion2`.`Institucion` (`idInstitucion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Institucion_has_Carrera_Carrera1`
    FOREIGN KEY (`Carrera_idCarrera`)
    REFERENCES `ProyectosInvestigacion2`.`Carrera` (`idCarrera`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
