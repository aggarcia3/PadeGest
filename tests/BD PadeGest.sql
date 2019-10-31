-- MySQL Script generated by MySQL Workbench
-- Wed Oct 30 23:37:06 2019
-- Model: PadeGest    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema PADEGEST
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `PADEGEST` ;

-- -----------------------------------------------------
-- Schema PADEGEST
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `PADEGEST` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `PADEGEST` ;

-- -----------------------------------------------------
-- Table `PADEGEST`.`campeonato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`campeonato` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`campeonato` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `bases` TEXT NOT NULL,
  `fechaInicioInscripciones` DATETIME NOT NULL,
  `fechaFinInscripciones` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`categoria_nivel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`categoria_nivel` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`categoria_nivel` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoria` ENUM('masculina', 'femenina', 'mixta') NOT NULL,
  `nivel` ENUM('1', '2', '3') NOT NULL,
  `idCampeonato` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UNIQUE` (`categoria` ASC, `nivel` ASC, `idCampeonato` ASC),
  INDEX `FK_CATEGORIA_NIVEL_CAMPEONATO_idx` (`idCampeonato` ASC),
  CONSTRAINT `FK_CATEGORIA_NIVEL_CAMPEONATO`
    FOREIGN KEY (`idCampeonato`)
    REFERENCES `PADEGEST`.`campeonato` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`enfrentamiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`enfrentamiento` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`enfrentamiento` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL,
  `idReserva` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_ENFRENTAMIENTO_RESERVA_idx` (`idReserva` ASC),
  CONSTRAINT `FK_ENFRENTAMIENTO_RESERVA`
    FOREIGN KEY (`idReserva`)
    REFERENCES `PADEGEST`.`reserva` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`grupo` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`grupo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idCategoriaNivel` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_GRUPO_CATEGORIA_NIVEL_idx` (`idCategoriaNivel` ASC),
  CONSTRAINT `FK_GRUPO_CATEGORIA_NIVEL`
    FOREIGN KEY (`idCategoriaNivel`)
    REFERENCES `PADEGEST`.`categoria_nivel` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`liga_regular`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`liga_regular` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`liga_regular` (
  `id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_LIGA_REGULAR_CAMPEONATO`
    FOREIGN KEY (`id`)
    REFERENCES `PADEGEST`.`campeonato` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`pareja`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`pareja` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`pareja` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idCapitan` INT UNSIGNED NOT NULL,
  `idCompanero` INT UNSIGNED NOT NULL,
  `idCategoriaNivel` INT UNSIGNED NOT NULL,
  `idGrupo` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_PAREJA_GRUPO_idx` (`idGrupo` ASC),
  INDEX `FK_PAREJA_CATEGORIA_NIVEL_idx` (`idCategoriaNivel` ASC),
  CONSTRAINT `FK_PAREJA_USUARIO1`
    FOREIGN KEY (`idCapitan`)
    REFERENCES `PADEGEST`.`usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PAREJA_USUARIO2`
    FOREIGN KEY (`idCompanero`)
    REFERENCES `PADEGEST`.`usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PAREJA_GRUPO`
    FOREIGN KEY (`idGrupo`)
    REFERENCES `PADEGEST`.`grupo` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PAREJA_CATEGORIA_NIVEL`
    FOREIGN KEY (`idCategoriaNivel`)
    REFERENCES `PADEGEST`.`categoria_nivel` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`pareja_enfrentamiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`pareja_enfrentamiento` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`pareja_enfrentamiento` (
  `idPareja` INT UNSIGNED NOT NULL,
  `idEnfrentamiento` INT UNSIGNED NOT NULL,
  `participacionConfirmada` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`idEnfrentamiento`, `idPareja`),
  INDEX `FK_PAREJA_ENFRENTAMIENTO_PAREJA_idx` (`idPareja` ASC),
  CONSTRAINT `FK_PAREJA_ENFRENTAMIENTO_PAREJA`
    FOREIGN KEY (`idPareja`)
    REFERENCES `PADEGEST`.`pareja` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PAREJA_ENFRENTAMIENTO_ENFRENTAMIENTO`
    FOREIGN KEY (`idEnfrentamiento`)
    REFERENCES `PADEGEST`.`enfrentamiento` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`partido_promocionado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`partido_promocionado` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`partido_promocionado` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL,
  `idReserva` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_PARTIDO_PROMOCIONADO_RESERVA`
    FOREIGN KEY (`idReserva`)
    REFERENCES `PADEGEST`.`reserva` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`pista`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`pista` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`pista` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipoSuelo` ENUM('césped', 'moqueta', 'hormigón', 'cemento') NOT NULL,
  `tipoCerramiento` ENUM('valla', 'pared', 'cristal') NOT NULL,
  `localizacion` ENUM('exterior', 'interior') NOT NULL,
  `focos` TINYINT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`playoffs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`playoffs` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`playoffs` (
  `id` INT UNSIGNED NOT NULL,
  `idLigaRegular` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombreLigaRegular_UNIQUE` (`idLigaRegular` ASC),
  CONSTRAINT `FK_PLAYOFFS_LIGA_REGULAR`
    FOREIGN KEY (`idLigaRegular`)
    REFERENCES `PADEGEST`.`liga_regular` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PLAYOFFS_CAMPEONATO`
    FOREIGN KEY (`id`)
    REFERENCES `PADEGEST`.`campeonato` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`reserva`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`reserva` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`reserva` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL,
  `idPista` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UNIQUE` (`fecha` ASC, `idPista` ASC),
  INDEX `FK_PISTA_idx` (`idPista` ASC),
  CONSTRAINT `FK_RESERVA_PISTA`
    FOREIGN KEY (`idPista`)
    REFERENCES `PADEGEST`.`pista` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`resultado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`resultado` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`resultado` (
  `idEnfrentamiento` INT UNSIGNED NOT NULL,
  `set1pareja1` TINYINT NOT NULL,
  `set1pareja2` TINYINT NOT NULL,
  `set2pareja1` TINYINT NOT NULL,
  `set2pareja2` TINYINT NOT NULL,
  `set3pareja1` TINYINT NULL,
  `set3pareja2` TINYINT NULL,
  PRIMARY KEY (`idEnfrentamiento`),
  CONSTRAINT `FK_RESULTADO_ENFRENTAMIENTO`
    FOREIGN KEY (`idEnfrentamiento`)
    REFERENCES `PADEGEST`.`enfrentamiento` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`usuario` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(32) NOT NULL,
  `password` CHAR(32) NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `apellidos` VARCHAR(50) NOT NULL,
  `genero` ENUM('masculino', 'femenino') NOT NULL,
  `esSocio` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `rol` ENUM('deportista', 'administrador') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`usuario_partido_promocionado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`usuario_partido_promocionado` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`usuario_partido_promocionado` (
  `idUsuario` INT UNSIGNED NOT NULL,
  `idPartidoPromocionado` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idUsuario`, `idPartidoPromocionado`),
  INDEX `FK_USUARIO_PARTIDO_PROMOCIONADO_PARTIDO_PROMOCIONADO_idx` (`idPartidoPromocionado` ASC),
  CONSTRAINT `FK_USUARIO_PARTIDO_PROMOCIONADO_USUARIO`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `PADEGEST`.`usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_USUARIO_PARTIDO_PROMOCIONADO_PARTIDO_PROMOCIONADO`
    FOREIGN KEY (`idPartidoPromocionado`)
    REFERENCES `PADEGEST`.`partido_promocionado` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`usuario_reserva`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`usuario_reserva` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`usuario_reserva` (
  `idUsuario` INT UNSIGNED NOT NULL,
  `idReserva` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idUsuario`, `idReserva`),
  INDEX `FK_USUARIO_RESERVA_RESERVA_idx` (`idReserva` ASC),
  CONSTRAINT `FK_USUARIO_RESERVA_USUARIO`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `PADEGEST`.`usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_USUARIO_RESERVA_RESERVA`
    FOREIGN KEY (`idReserva`)
    REFERENCES `PADEGEST`.`reserva` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

SET SQL_MODE = '';
DROP USER IF EXISTS PadeGestApp;
SET SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
CREATE USER 'PadeGestApp' IDENTIFIED BY 'PadeGestApp';

GRANT TRIGGER, UPDATE, SELECT, INSERT, INDEX, REFERENCES, DELETE, DROP, CREATE, ALTER ON TABLE PADEGEST.* TO 'PadeGestApp';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
