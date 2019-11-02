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
-- Table `usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuario` ;

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(32) NOT NULL,
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
-- Table `pista`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pista` ;

CREATE TABLE IF NOT EXISTS `pista` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipoSuelo` ENUM('césped', 'moqueta', 'hormigón', 'cemento') NOT NULL,
  `tipoCerramiento` ENUM('valla', 'pared', 'cristal') NOT NULL,
  `localizacion` ENUM('exterior', 'interior') NOT NULL,
  `focos` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reserva`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reserva` ;

CREATE TABLE IF NOT EXISTS `reserva` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL,
  `pista_id` INT UNSIGNED NOT NULL,
  `usuario_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UNIQUE` (`fecha` ASC, `pista_id` ASC),
  INDEX `FK_PISTA_idx` (`pista_id` ASC),
  INDEX `FK_RESERVA_USUARIO_idx` (`usuario_id` ASC),
  CONSTRAINT `FK_RESERVA_PISTA`
    FOREIGN KEY (`pista_id`)
    REFERENCES `pista` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_RESERVA_USUARIO`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuario` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `enfrentamiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `enfrentamiento` ;

CREATE TABLE IF NOT EXISTS `enfrentamiento` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `reserva_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_ENFRENTAMIENTO_RESERVA_idx` (`reserva_id` ASC),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC),
  CONSTRAINT `FK_ENFRENTAMIENTO_RESERVA`
    FOREIGN KEY (`reserva_id`)
    REFERENCES `reserva` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `partido_promocionado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `partido_promocionado` ;

CREATE TABLE IF NOT EXISTS `partido_promocionado` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `reserva_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC),
  CONSTRAINT `FK_PARTIDO_PROMOCIONADO_RESERVA`
    FOREIGN KEY (`reserva_id`)
    REFERENCES `reserva` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `resultado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resultado` ;

CREATE TABLE IF NOT EXISTS `resultado` (
  `enfrentamiento_id` INT UNSIGNED NOT NULL,
  `set1pareja1` TINYINT NOT NULL,
  `set1pareja2` TINYINT NOT NULL,
  `set2pareja1` TINYINT NOT NULL,
  `set2pareja2` TINYINT NOT NULL,
  `set3pareja1` TINYINT NULL,
  `set3pareja2` TINYINT NULL,
  PRIMARY KEY (`enfrentamiento_id`),
  CONSTRAINT `FK_RESULTADO_ENFRENTAMIENTO`
    FOREIGN KEY (`enfrentamiento_id`)
    REFERENCES `enfrentamiento` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario_partido_promocionado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuario_partido_promocionado` ;

CREATE TABLE IF NOT EXISTS `usuario_partido_promocionado` (
  `usuario_id` INT UNSIGNED NOT NULL,
  `partido_promocionado_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`usuario_id`, `partido_promocionado_id`),
  INDEX `FK_USUARIO_PARTIDO_PROMOCIONADO_PARTIDO_PROMOCIONADO_idx` (`partido_promocionado_id` ASC),
  CONSTRAINT `FK_USUARIO_PARTIDO_PROMOCIONADO_USUARIO`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_USUARIO_PARTIDO_PROMOCIONADO_PARTIDO_PROMOCIONADO`
    FOREIGN KEY (`partido_promocionado_id`)
    REFERENCES `partido_promocionado` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeonato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeonato` ;

CREATE TABLE IF NOT EXISTS `campeonato` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `bases` TEXT NOT NULL,
  `fechaInicioInscripciones` DATETIME NOT NULL,
  `fechaFinInscripciones` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `categoria_nivel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `categoria_nivel` ;

CREATE TABLE IF NOT EXISTS `categoria_nivel` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoria` ENUM('masculina', 'femenina', 'mixta') NOT NULL,
  `nivel` ENUM('1', '2', '3') NOT NULL,
  `campeonato_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UNIQUE` (`categoria` ASC, `nivel` ASC, `campeonato_id` ASC),
  INDEX `FK_CATEGORIA_NIVEL_CAMPEONATO_idx` (`campeonato_id` ASC),
  CONSTRAINT `FK_CATEGORIA_NIVEL_CAMPEONATO`
    FOREIGN KEY (`campeonato_id`)
    REFERENCES `campeonato` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `grupo` ;

CREATE TABLE IF NOT EXISTS `grupo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoria_nivel_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_GRUPO_CATEGORIA_NIVEL_idx` (`categoria_nivel_id` ASC),
  CONSTRAINT `FK_GRUPO_CATEGORIA_NIVEL`
    FOREIGN KEY (`categoria_nivel_id`)
    REFERENCES `categoria_nivel` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pareja`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pareja` ;

CREATE TABLE IF NOT EXISTS `pareja` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idCapitan` INT UNSIGNED NOT NULL,
  `idCompanero` INT UNSIGNED NOT NULL,
  `categoria_nivel_id` INT UNSIGNED NOT NULL,
  `grupo_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_PAREJA_GRUPO_idx` (`grupo_id` ASC),
  INDEX `FK_PAREJA_CATEGORIA_NIVEL_idx` (`categoria_nivel_id` ASC),
  CONSTRAINT `FK_PAREJA_USUARIO1`
    FOREIGN KEY (`idCapitan`)
    REFERENCES `usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PAREJA_USUARIO2`
    FOREIGN KEY (`idCompanero`)
    REFERENCES `usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PAREJA_GRUPO`
    FOREIGN KEY (`grupo_id`)
    REFERENCES `grupo` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PAREJA_CATEGORIA_NIVEL`
    FOREIGN KEY (`categoria_nivel_id`)
    REFERENCES `categoria_nivel` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pareja_enfrentamiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pareja_enfrentamiento` ;

CREATE TABLE IF NOT EXISTS `pareja_enfrentamiento` (
  `pareja_id` INT UNSIGNED NOT NULL,
  `enfrentamiento_id` INT UNSIGNED NOT NULL,
  `participacionConfirmada` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`enfrentamiento_id`, `pareja_id`),
  INDEX `FK_PAREJA_ENFRENTAMIENTO_PAREJA_idx` (`pareja_id` ASC),
  CONSTRAINT `FK_PAREJA_ENFRENTAMIENTO_PAREJA`
    FOREIGN KEY (`pareja_id`)
    REFERENCES `pareja` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PAREJA_ENFRENTAMIENTO_ENFRENTAMIENTO`
    FOREIGN KEY (`enfrentamiento_id`)
    REFERENCES `enfrentamiento` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `liga_regular`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `liga_regular` ;

CREATE TABLE IF NOT EXISTS `liga_regular` (
  `id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_LIGA_REGULAR_CAMPEONATO`
    FOREIGN KEY (`id`)
    REFERENCES `campeonato` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `playoffs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `playoffs` ;

CREATE TABLE IF NOT EXISTS `playoffs` (
  `id` INT UNSIGNED NOT NULL,
  `liga_regular_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombreLigaRegular_UNIQUE` (`liga_regular_id` ASC),
  CONSTRAINT `FK_PLAYOFFS_LIGA_REGULAR`
    FOREIGN KEY (`liga_regular_id`)
    REFERENCES `liga_regular` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PLAYOFFS_CAMPEONATO`
    FOREIGN KEY (`id`)
    REFERENCES `campeonato` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `configuracion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `configuracion` ;

CREATE TABLE IF NOT EXISTS `configuracion` (
  `duracionReservas` TIME NOT NULL DEFAULT '1:0:0')
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Users
-- -----------------------------------------------------
DROP USER IF EXISTS 'PadeGestApp'@'localhost';
CREATE USER IF NOT EXISTS 'PadeGestApp'@'localhost' IDENTIFIED WITH mysql_native_password BY 'PadeGestApp';

GRANT TRIGGER, UPDATE, SELECT, INSERT, INDEX, DELETE, ALTER, REFERENCES, DROP, CREATE ON TABLE PADEGEST.* TO 'PadeGestApp'@'localhost';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `configuracion`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `configuracion` (`duracionReservas`) VALUES ('1:0:0');

COMMIT;

-- -----------------------------------------------------
-- Event `limpieza_reservas_expiradas`
-- -----------------------------------------------------
DROP EVENT IF EXISTS `PADEGEST`.`limpieza_reservas_expiradas`;

DELIMITER }
CREATE EVENT `PADEGEST`.`limpieza_reservas_expiradas`
	ON SCHEDULE EVERY 1 MINUTE STARTS CURRENT_TIMESTAMP
    ON COMPLETION NOT PRESERVE
    DO BEGIN
		DECLARE duracion TIME;
		SELECT `duracionReservas` FROM `PADEGEST`.`configuracion` LIMIT 1 INTO duracion;
		DELETE LOW_PRIORITY
			FROM `PADEGEST`.`reserva`
			WHERE ADDTIME(`fecha`, duracion) <= NOW();
	END}
DELIMITER ;