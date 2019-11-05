-- -----------------------------------------------------
-- PadeGest application database
-- For use by PadeGest
-- Generated on 11 Nov 2019 16:42:20 CET
-- -----------------------------------------------------
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
-- Table `PADEGEST`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`usuario` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(32) NOT NULL,
  `password` CHAR(32) NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `apellidos` VARCHAR(50) NOT NULL,
  `genero` ENUM('masculino', 'femenino') NOT NULL,
  `fechaNacimiento` DATE NOT NULL,
  `esSocio` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `rol` ENUM('deportista', 'administrador') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC))
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
  `focos` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`reserva`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`reserva` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`reserva` (
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
    REFERENCES `PADEGEST`.`pista` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_RESERVA_USUARIO`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `PADEGEST`.`usuario` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`enfrentamiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`enfrentamiento` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`enfrentamiento` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `reserva_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_ENFRENTAMIENTO_RESERVA_idx` (`reserva_id` ASC),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC),
  CONSTRAINT `FK_ENFRENTAMIENTO_RESERVA`
    FOREIGN KEY (`reserva_id`)
    REFERENCES `PADEGEST`.`reserva` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`partido_promocionado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`partido_promocionado` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`partido_promocionado` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `reserva_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC),
  CONSTRAINT `FK_PARTIDO_PROMOCIONADO_RESERVA`
    FOREIGN KEY (`reserva_id`)
    REFERENCES `PADEGEST`.`reserva` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`resultado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`resultado` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`resultado` (
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
    REFERENCES `PADEGEST`.`enfrentamiento` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`usuario_partido_promocionado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`usuario_partido_promocionado` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`usuario_partido_promocionado` (
  `usuario_id` INT UNSIGNED NOT NULL,
  `partido_promocionado_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`usuario_id`, `partido_promocionado_id`),
  INDEX `FK_USUARIO_PARTIDO_PROMOCIONADO_PARTIDO_PROMOCIONADO_idx` (`partido_promocionado_id` ASC),
  CONSTRAINT `FK_USUARIO_PARTIDO_PROMOCIONADO_USUARIO`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `PADEGEST`.`usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_USUARIO_PARTIDO_PROMOCIONADO_PARTIDO_PROMOCIONADO`
    FOREIGN KEY (`partido_promocionado_id`)
    REFERENCES `PADEGEST`.`partido_promocionado` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


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
  `campeonato_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UNIQUE` (`categoria` ASC, `nivel` ASC, `campeonato_id` ASC),
  INDEX `FK_CATEGORIA_NIVEL_CAMPEONATO_idx` (`campeonato_id` ASC),
  CONSTRAINT `FK_CATEGORIA_NIVEL_CAMPEONATO`
    FOREIGN KEY (`campeonato_id`)
    REFERENCES `PADEGEST`.`campeonato` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`grupo` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`grupo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoria_nivel_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_GRUPO_CATEGORIA_NIVEL_idx` (`categoria_nivel_id` ASC),
  CONSTRAINT `FK_GRUPO_CATEGORIA_NIVEL`
    FOREIGN KEY (`categoria_nivel_id`)
    REFERENCES `PADEGEST`.`categoria_nivel` (`id`)
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
  `categoria_nivel_id` INT UNSIGNED NOT NULL,
  `grupo_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_PAREJA_GRUPO_idx` (`grupo_id` ASC),
  INDEX `FK_PAREJA_CATEGORIA_NIVEL_idx` (`categoria_nivel_id` ASC),
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
    FOREIGN KEY (`grupo_id`)
    REFERENCES `PADEGEST`.`grupo` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PAREJA_CATEGORIA_NIVEL`
    FOREIGN KEY (`categoria_nivel_id`)
    REFERENCES `PADEGEST`.`categoria_nivel` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`pareja_enfrentamiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`pareja_enfrentamiento` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`pareja_enfrentamiento` (
  `pareja_id` INT UNSIGNED NOT NULL,
  `enfrentamiento_id` INT UNSIGNED NOT NULL,
  `participacionConfirmada` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`enfrentamiento_id`, `pareja_id`),
  INDEX `FK_PAREJA_ENFRENTAMIENTO_PAREJA_idx` (`pareja_id` ASC),
  CONSTRAINT `FK_PAREJA_ENFRENTAMIENTO_PAREJA`
    FOREIGN KEY (`pareja_id`)
    REFERENCES `PADEGEST`.`pareja` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PAREJA_ENFRENTAMIENTO_ENFRENTAMIENTO`
    FOREIGN KEY (`enfrentamiento_id`)
    REFERENCES `PADEGEST`.`enfrentamiento` (`id`)
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
-- Table `PADEGEST`.`playoffs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`playoffs` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`playoffs` (
  `id` INT UNSIGNED NOT NULL,
  `liga_regular_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombreLigaRegular_UNIQUE` (`liga_regular_id` ASC),
  CONSTRAINT `FK_PLAYOFFS_LIGA_REGULAR`
    FOREIGN KEY (`liga_regular_id`)
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
-- Table `PADEGEST`.`configuracion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`configuracion` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`configuracion` (
  `duracionReservas` TIME NOT NULL DEFAULT '1:0:0')
ENGINE = InnoDB;

USE `PADEGEST`;

DELIMITER $$

USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`reserva_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`reserva_BEFORE_INSERT`
BEFORE INSERT ON `reserva` FOR EACH ROW
BEGIN
	DECLARE idPartidoPromocionado INT UNSIGNED DEFAULT NULL;
    DECLARE idEnfrentamiento INT UNSIGNED DEFAULT NULL;

	DECLARE CONTINUE HANDLER FOR NOT FOUND BEGIN END;

	SELECT id FROM `PADEGEST`.`partido_promocionado` WHERE reserva_id = NEW.`id` INTO idPartidoPromocionado;
    SELECT id FROM `PADEGEST`.`enfrentamiento` WHERE reserva_id = NEW.`id` INTO idEnfrentamiento;

	IF	NEW.`usuario_id` IS NOT NULL AND
        (idPartidoPromocionado IS NOT NULL OR idEnfrentamiento IS NOT NULL)
	THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'Una reserva no puede realizarse por un usuario y por un partido promocionado o enfrentamiento a la vez';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`reserva_BEFORE_UPDATE` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`reserva_BEFORE_UPDATE`
BEFORE UPDATE ON `reserva` FOR EACH ROW
BEGIN
	DECLARE idPartidoPromocionado INT UNSIGNED DEFAULT NULL;
    DECLARE idEnfrentamiento INT UNSIGNED DEFAULT NULL;

	DECLARE CONTINUE HANDLER FOR NOT FOUND BEGIN END;

	SELECT id FROM `PADEGEST`.`partido_promocionado` WHERE reserva_id = NEW.`id` INTO idPartidoPromocionado;
    SELECT id FROM `PADEGEST`.`enfrentamiento` WHERE reserva_id = NEW.`id` INTO idEnfrentamiento;

	IF	NEW.`usuario_id` IS NOT NULL AND
        (idPartidoPromocionado IS NOT NULL OR idEnfrentamiento IS NOT NULL)
	THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'Una reserva no puede realizarse por un usuario y por un partido promocionado o enfrentamiento a la vez';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`enfrentamiento_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`enfrentamiento_BEFORE_INSERT`
BEFORE INSERT ON `enfrentamiento` FOR EACH ROW
BEGIN
	DECLARE fechaReserva DATETIME;

	-- Ignorar reservas inexistentes
	DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;

	SELECT fecha FROM `PADEGEST`.`reserva` WHERE id = NEW.`reserva_id` INTO fechaReserva;

	IF fechaReserva <> NEW.`fecha` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de la reserva asociada a un partido debe de coincidir con la del partido';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`enfrentamiento_BEFORE_UPDATE` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`enfrentamiento_BEFORE_UPDATE`
BEFORE UPDATE ON `enfrentamiento` FOR EACH ROW
BEGIN
	DECLARE fechaReserva DATETIME;

	-- Ignorar reservas inexistentes
	DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;

	SELECT fecha FROM `PADEGEST`.`reserva` WHERE id = NEW.`reserva_id` INTO fechaReserva;

	IF fechaReserva <> NEW.`fecha` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de la reserva asociada a un partido debe de coincidir con la del partido';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`partido_promocionado_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`partido_promocionado_BEFORE_INSERT`
BEFORE INSERT ON `partido_promocionado` FOR EACH ROW
BEGIN
	DECLARE fechaReserva DATETIME;

	-- Ignorar reservas inexistentes
	DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;

	SELECT fecha FROM `PADEGEST`.`reserva` WHERE id = NEW.`reserva_id` INTO fechaReserva;

	IF fechaReserva <> NEW.`fecha` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de la reserva asociada a un partido debe de coincidir con la del partido';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`partido_promocionado_BEFORE_UPDATE` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`partido_promocionado_BEFORE_UPDATE`
BEFORE UPDATE ON `partido_promocionado` FOR EACH ROW
BEGIN
	DECLARE fechaReserva DATETIME;

	-- Ignorar reservas inexistentes
	DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;

	SELECT fecha FROM `PADEGEST`.`reserva` WHERE id = NEW.`reserva_id` INTO fechaReserva;

	IF fechaReserva <> NEW.`fecha` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de la reserva asociada a un partido debe de coincidir con la del partido';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`resultado_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`resultado_BEFORE_INSERT`
BEFORE INSERT ON `resultado` FOR EACH ROW
BEGIN
	-- Si el tercer set está definido para una pareja, también lo debe
    -- de estar para la otra
	IF	(NEW.`set3pareja1` IS NOT NULL AND NEW.`set3pareja2` IS NULL) OR
        (NEW.`set3pareja1` IS NULL AND NEW.`set3pareja2` IS NOT NULL)
	THEN
		SIGNAL SQLSTATE VALUE '23000' SET MESSAGE_TEXT = 'Si el tercer set de un resultado está definido para una pareja, también lo debe de estar para la otra';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`resultado_BEFORE_UPDATE` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`resultado_BEFORE_UPDATE`
BEFORE UPDATE ON `resultado` FOR EACH ROW
BEGIN
	-- Si el tercer set está definido para una pareja, también lo debe
    -- de estar para la otra
	IF	(NEW.`set3pareja1` IS NOT NULL AND NEW.`set3pareja2` IS NULL) OR
        (NEW.`set3pareja1` IS NULL AND NEW.`set3pareja2` IS NOT NULL)
	THEN
		SIGNAL SQLSTATE VALUE '23000' SET MESSAGE_TEXT = 'Si el tercer set de un resultado está definido para una pareja, también lo debe de estar para la otra';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`campeonato_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`campeonato_BEFORE_INSERT`
BEFORE INSERT ON `campeonato` FOR EACH ROW
BEGIN
	IF NEW.`fechaInicioInscripciones` > NEW.`fechaFinInscripciones` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de inicio de inscripciones de un campeonato debe de ser menor que la de fin';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`campeonato_BEFORE_UPDATE` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`campeonato_BEFORE_UPDATE`
BEFORE UPDATE ON `campeonato` FOR EACH ROW
BEGIN
	IF NEW.`fechaInicioInscripciones` > NEW.`fechaFinInscripciones` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de inicio de inscripciones de un campeonato debe de ser menor que la de fin';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`pareja_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`pareja_BEFORE_INSERT`
BEFORE INSERT ON `pareja` FOR EACH ROW
BEGIN
	DECLARE idCategoriaNivelGrupo INT UNSIGNED;

	DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;

	SELECT categoria_nivel_id FROM `PADEGEST`.`grupo` WHERE id = NEW.`grupo_id` INTO idCategoriaNivelGrupo;

	IF idCategoriaNivelGrupo <> NEW.`categoria_nivel_id` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'Una pareja solo puede estar en grupos de su misma categoría y nivel';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`pareja_BEFORE_UPDATE` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`pareja_BEFORE_UPDATE`
BEFORE UPDATE ON `pareja` FOR EACH ROW
BEGIN
	DECLARE idCategoriaNivelGrupo INT UNSIGNED;

	DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;

	SELECT categoria_nivel_id FROM `PADEGEST`.`grupo` WHERE id = NEW.`grupo_id` INTO idCategoriaNivelGrupo;

	IF idCategoriaNivelGrupo <> NEW.`categoria_nivel_id` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'Una pareja solo puede estar en grupos de su misma categoría y nivel';
    END IF;
END$$


DELIMITER ;

-- -----------------------------------------------------
-- User PadeGestApp
-- -----------------------------------------------------
DROP USER IF EXISTS 'PadeGestApp';
CREATE USER 'PadeGestApp' IDENTIFIED WITH mysql_native_password BY 'PadeGestApp';
GRANT TRIGGER, UPDATE, SELECT, INSERT, INDEX, DELETE, ALTER, REFERENCES, DROP, CREATE ON TABLE PADEGEST.* TO 'PadeGestApp';

-- -----------------------------------------------------
-- Data for table `PADEGEST`.`usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (1, 'silvergorilla946', '640692641dc3dbd6362c7a66344de8b9', 'Nuria', 'García', 'femenino', '1972-07-27', 0, 'administrador');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (2, 'greencat609', 'f7802c6426e92dc6703e79b928905504', 'Luisa', 'Vega', 'femenino', '1997-05-01', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (3, 'organicfish174', '7ffaae67fd14ed82799775f8ed0786db', 'Susana', 'Soto', 'femenino', '1975-02-11', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (4, 'beautifultiger401', '40a658eb4a093d38b9b5e4169729a13b', 'Celia', 'Domínguez', 'femenino', '1988-01-12', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (5, 'greenladybug269', 'a06c8412cdbf80beacff001f3276cec0', 'Nicolás', 'Marín', 'masculino', '1982-07-27', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (6, 'organicdog654', '8a76977f63691b218a40f4cbf1987815', 'Daniel', 'Morales', 'masculino', '1989-03-12', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (7, 'bluepeacock966', '4dac8c9b3a3c4fd41d3c5c21c5f0e236', 'María', 'Antonia Iglesias', 'femenino', '1970-05-01', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (8, 'heavybutterfly345', '7f80110eb10e4b1ccc27d9a062a2302c', 'Manuel', 'Giménez', 'masculino', '1998-10-15', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (9, 'heavybutterfly377', '7530dffb2bbba483691329908b94df6c', 'Ignacio', 'Moya', 'masculino', '2000-11-16', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (10, 'happybutterfly909', '426700733faaed4ef78e1f0ea2849d5a', 'Ángeles', 'Núñez', 'femenino', '1970-01-01', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (11, 'yellowzebra924', 'dd410087bfda6e014e0dcf8a92532644', 'Natalia', 'Alonso', 'femenino', '1970-12-17', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (12, 'purplemouse320', '2fdb189f2ddc0870f8922e5e3c78bf28', 'María Teresa', 'Hidalgo', 'femenino', '1979-10-18', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (13, 'orangedog307', 'c48cb78bd24f39c625aa591c14f62eeb', 'Mario', 'Benítez', 'masculino', '1991-11-21', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (14, 'whitefish726', '70642510997ddb8b7aff459812ac9960', 'Rubén', 'Blanco', 'masculino', '1994-10-05', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (15, 'silvercat186', 'a65fbffde76764e3f2207649e03707e9', 'Concepción', 'Mora', 'femenino', '1971-08-09', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (16, 'beautifulgoose185', 'b39f9aedd0d29d535dcfb0c498db6f93', 'Marta', 'Alonso', 'femenino', '1982-02-16', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (17, 'tinygorilla203', 'a72443d8e2e3f6949e699d6dd0a9617d', 'María Angeles', 'Vázquez', 'femenino', '1974-08-11', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (18, 'tinytiger912', '9b12d358a0c3059cf7da15eb2c051655', 'Alicia', 'Peña', 'femenino', '1997-07-09', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (19, 'tinymeercat208', '34b0b61675eeabd40150fad0717cd8c5', 'Carolina', 'Martínez', 'femenino', '1990-10-27', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (20, 'silverbird807', '78bf8da1ff18b22408bb5ac3f70d9c33', 'Celia', 'Lorenzo', 'femenino', '1999-05-19', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (21, 'sadladybug879', '1603272b464d97b6af0c8d717b698211', 'Paula', 'Giménez', 'femenino', '1977-02-21', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (22, 'blueostrich272', 'c46a1f254b6fb6b07e4144e79df7a085', 'Marina', 'Ramírez', 'femenino', '1997-07-31', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (23, 'smallgorilla279', 'a0301897d78518ec185a2dcebeb82c59', 'Tomás', 'Gil', 'masculino', '1998-05-19', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (24, 'blueostrich184', 'd39c45ce3748e1fb0f9569be26d7735d', 'Antonia', 'Castillo', 'femenino', '2001-11-02', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (25, 'heavycat480', 'f7b02a4ae4736a6b2348f8312c5d46ce', 'Rubén', 'Bravo', 'masculino', '1979-09-05', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (26, 'greenfrog567', '49af884e1f5239a735620e611233e0ee', 'Rubén', 'Méndez', 'masculino', '1987-11-21', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (27, 'whitebutterfly953', '3744a0e5839ecc55ea69ffdee3f39fa5', 'Ángela', 'Sáez', 'femenino', '1981-03-07', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (28, 'redcat927', '32fdc39a8da2bdb7a98dadcefc6c1e38', 'Felipe', 'Torres', 'masculino', '1974-06-13', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (29, 'sadgoose648', 'e2c20148ce95dd1163f6f3bd646e4baa', 'María Angeles', 'Giménez', 'femenino', '2001-02-25', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `login`, `password`, `nombre`, `apellidos`, `genero`, `fechaNacimiento`, `esSocio`, `rol`) VALUES (30, 'goldenpanda782', '969512f72ca38494a7d93d4e8a1ba4bb', 'Francisca', 'Carmona', 'femenino', '1994-01-12', 1, 'deportista');

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`pista`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (1, 'moqueta', 'valla', 'interior', 5);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (2, 'césped', 'pared', 'exterior', 6);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (3, 'césped', 'cristal', 'interior', 2);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (4, 'césped', 'cristal', 'exterior', 6);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (5, 'moqueta', 'valla', 'interior', 2);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (6, 'césped', 'cristal', 'exterior', 8);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (7, 'moqueta', 'pared', 'interior', 3);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (8, 'cemento', 'valla', 'interior', 6);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (9, 'moqueta', 'pared', 'exterior', 2);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (10, 'cemento', 'valla', 'interior', 6);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (11, 'cemento', 'pared', 'interior', 7);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (12, 'hormigón', 'pared', 'exterior', 8);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (13, 'césped', 'valla', 'interior', 8);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (14, 'césped', 'cristal', 'exterior', 2);
INSERT INTO `PADEGEST`.`pista` (`id`, `tipoSuelo`, `tipoCerramiento`, `localizacion`, `focos`) VALUES (15, 'hormigón', 'valla', 'interior', 6);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`reserva`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (1, '2019-10-21 22:00:00', 10, 20);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (2, '2019-10-25 20:00:00', 4, 8);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (3, '2019-10-24 08:00:00', 14, 18);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (4, '2019-10-22 11:00:00', 13, 12);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (5, '2019-10-23 21:00:00', 10, 24);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (6, '2019-10-22 16:00:00', 4, 24);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (7, '2019-10-25 10:00:00', 2, 9);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (8, '2019-10-21 15:00:00', 4, 26);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (9, '2019-10-20 16:00:00', 5, 11);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (10, '2019-10-23 22:00:00', 14, 26);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (11, '2019-10-16 22:00:00', 12, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (12, '2019-10-23 14:00:00', 12, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (13, '2019-10-19 17:00:00', 13, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (14, '2019-10-06 10:00:00', 3, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (15, '2019-10-15 18:00:00', 6, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fecha`, `pista_id`, `usuario_id`) VALUES (16, '2019-10-22 10:00:00', 7, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`enfrentamiento`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (1, 'Partido 1 European Veteran Championship', '2019-10-19 17:00:00', 13);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (2, 'Partido 2 European Veteran Championship', '2019-10-06 10:00:00', 14);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (3, 'Partido 1 Máster de Menores 2019', '2019-10-15 18:00:00', 15);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (4, 'Partido 2 Máster de Menores 2019', '2019-10-22 10:00:00', 16);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (5, 'Partido 1 TyC PREMIUM 3', '2019-10-28 12:00:00', NULL);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (6, 'Partido 3 European Veteran Championship', '2019-10-19 11:00:00', NULL);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (7, 'Partido 3 Máster de Menores 2019', '2019-10-05 17:00:00', NULL);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (8, 'Partido 2 TyC PREMIUM 3', '2019-10-28 18:00:00', NULL);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (9, 'Partido 3 TyC PREMIUM 3', '2019-10-05 20:00:00', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`partido_promocionado`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`partido_promocionado` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (1, 'Partido amistoso de PadeClub', '2019-10-16 22:00:00', 11);
INSERT INTO `PADEGEST`.`partido_promocionado` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (2, 'Partido entrenamiento Copa Pádel', '2019-10-26 18:00:00', NULL);
INSERT INTO `PADEGEST`.`partido_promocionado` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (3, 'Primer partido solidario', '2019-10-23 14:00:00', 12);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`resultado`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`resultado` (`enfrentamiento_id`, `set1pareja1`, `set1pareja2`, `set2pareja1`, `set2pareja2`, `set3pareja1`, `set3pareja2`) VALUES (1, 1, 1, 1, 1, 0, 1);
INSERT INTO `PADEGEST`.`resultado` (`enfrentamiento_id`, `set1pareja1`, `set1pareja2`, `set2pareja1`, `set2pareja2`, `set3pareja1`, `set3pareja2`) VALUES (3, 1, 0, 2, 0, NULL, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`usuario_partido_promocionado`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`usuario_partido_promocionado` (`usuario_id`, `partido_promocionado_id`) VALUES (18, 1);
INSERT INTO `PADEGEST`.`usuario_partido_promocionado` (`usuario_id`, `partido_promocionado_id`) VALUES (8, 3);
INSERT INTO `PADEGEST`.`usuario_partido_promocionado` (`usuario_id`, `partido_promocionado_id`) VALUES (14, 1);
INSERT INTO `PADEGEST`.`usuario_partido_promocionado` (`usuario_id`, `partido_promocionado_id`) VALUES (20, 3);
INSERT INTO `PADEGEST`.`usuario_partido_promocionado` (`usuario_id`, `partido_promocionado_id`) VALUES (15, 2);
INSERT INTO `PADEGEST`.`usuario_partido_promocionado` (`usuario_id`, `partido_promocionado_id`) VALUES (14, 2);
INSERT INTO `PADEGEST`.`usuario_partido_promocionado` (`usuario_id`, `partido_promocionado_id`) VALUES (25, 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`campeonato`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`campeonato` (`id`, `nombre`, `bases`, `fechaInicioInscripciones`, `fechaFinInscripciones`) VALUES (1, 'European Veteran Championship', 'Bases de campeonato de ejemplo', '2019-07-31 00:00:00', '2019-08-16 00:00:00');
INSERT INTO `PADEGEST`.`campeonato` (`id`, `nombre`, `bases`, `fechaInicioInscripciones`, `fechaFinInscripciones`) VALUES (2, 'Máster de Menores 2019', 'Bases de campeonato de ejemplo', '2019-06-10 00:00:00', '2019-06-29 00:00:00');
INSERT INTO `PADEGEST`.`campeonato` (`id`, `nombre`, `bases`, `fechaInicioInscripciones`, `fechaFinInscripciones`) VALUES (3, 'TyC PREMIUM 3', 'Bases de campeonato de ejemplo', '2019-09-29 00:00:00', '2019-10-05 00:00:00');
INSERT INTO `PADEGEST`.`campeonato` (`id`, `nombre`, `bases`, `fechaInicioInscripciones`, `fechaFinInscripciones`) VALUES (4, 'Playoffs European Veteran Championship', 'Bases de campeonato de ejemplo', '2019-07-10 00:00:00', '2019-07-20 00:00:00');
INSERT INTO `PADEGEST`.`campeonato` (`id`, `nombre`, `bases`, `fechaInicioInscripciones`, `fechaFinInscripciones`) VALUES (5, 'Playoffs máster de Menores 2019', 'Bases de campeonato de ejemplo', '2019-06-17 00:00:00', '2019-06-30 00:00:00');
INSERT INTO `PADEGEST`.`campeonato` (`id`, `nombre`, `bases`, `fechaInicioInscripciones`, `fechaFinInscripciones`) VALUES (6, 'Playoffs TyC PREMIUM 3', 'Bases de campeonato de ejemplo', '2019-08-28 00:00:00', '2019-09-05 00:00:00');

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`categoria_nivel`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (1, 'masculina', '1', 1);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (2, 'masculina', '2', 1);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (3, 'masculina', '3', 1);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (4, 'femenina', '1', 1);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (5, 'femenina', '2', 1);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (6, 'femenina', '3', 1);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (7, 'mixta', '1', 1);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (8, 'mixta', '2', 1);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (9, 'mixta', '3', 1);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (10, 'masculina', '1', 2);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (11, 'masculina', '2', 2);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (12, 'masculina', '3', 2);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (13, 'femenina', '1', 2);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (14, 'femenina', '2', 2);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (15, 'femenina', '3', 2);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (16, 'mixta', '1', 2);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (17, 'mixta', '2', 2);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (18, 'mixta', '3', 2);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (19, 'masculina', '1', 3);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (20, 'masculina', '2', 3);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (21, 'masculina', '3', 3);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (22, 'femenina', '1', 3);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (23, 'femenina', '2', 3);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (24, 'femenina', '3', 3);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (25, 'mixta', '1', 3);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (26, 'mixta', '2', 3);
INSERT INTO `PADEGEST`.`categoria_nivel` (`id`, `categoria`, `nivel`, `campeonato_id`) VALUES (27, 'mixta', '3', 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`grupo`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`grupo` (`id`, `categoria_nivel_id`) VALUES (3, 9);
INSERT INTO `PADEGEST`.`grupo` (`id`, `categoria_nivel_id`) VALUES (1, 7);
INSERT INTO `PADEGEST`.`grupo` (`id`, `categoria_nivel_id`) VALUES (2, 17);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`pareja`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (1, 27, 11, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (2, 8, 3, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (3, 7, 4, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (4, 14, 28, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (5, 12, 19, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (6, 18, 16, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (7, 13, 21, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (8, 23, 28, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (9, 21, 23, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (10, 27, 18, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (11, 12, 30, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (12, 10, 25, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (13, 7, 28, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (14, 6, 13, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (15, 16, 18, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (16, 5, 15, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (17, 6, 29, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (18, 9, 17, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (19, 28, 12, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (20, 25, 30, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (21, 24, 4, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (22, 19, 14, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (23, 27, 11, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (24, 8, 5, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (25, 21, 10, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (26, 27, 8, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (27, 21, 28, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (28, 12, 21, 23, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (29, 26, 19, 5, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (30, 12, 18, 24, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (31, 28, 22, 12, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `categoria_nivel_id`, `grupo_id`) VALUES (32, 7, 7, 1, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`pareja_enfrentamiento`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (21, 8, 1);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (6, 3, 1);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (8, 4, 1);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (30, 9, 0);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (13, 9, 0);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (23, 8, 0);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (1, 1, 1);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (3, 2, 1);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (5, 3, 1);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (15, 8, 1);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (4, 2, 1);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (7, 4, 1);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (2, 1, 1);
INSERT INTO `PADEGEST`.`pareja_enfrentamiento` (`pareja_id`, `enfrentamiento_id`, `participacionConfirmada`) VALUES (28, 9, 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`liga_regular`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`liga_regular` (`id`) VALUES (1);
INSERT INTO `PADEGEST`.`liga_regular` (`id`) VALUES (2);
INSERT INTO `PADEGEST`.`liga_regular` (`id`) VALUES (3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`playoffs`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`playoffs` (`id`, `liga_regular_id`) VALUES (4, 1);
INSERT INTO `PADEGEST`.`playoffs` (`id`, `liga_regular_id`) VALUES (5, 2);
INSERT INTO `PADEGEST`.`playoffs` (`id`, `liga_regular_id`) VALUES (6, 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`configuracion`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`configuracion` (`duracionReservas`) VALUES ('1:0:0');

COMMIT;

-- -----------------------------------------------------
-- Event `PADEGEST`.`limpieza_reservas_expiradas`
-- -----------------------------------------------------
DROP EVENT IF EXISTS `PADEGEST`.`limpieza_reservas_expiradas`;

DELIMITER $$
CREATE EVENT `PADEGEST`.`limpieza_reservas_expiradas`
    ON SCHEDULE EVERY 1 MINUTE STARTS CURRENT_TIMESTAMP
    ON COMPLETION NOT PRESERVE
    DO BEGIN
        DECLARE duracion TIME;
        SELECT `duracionReservas` FROM `PADEGEST`.`configuracion` LIMIT 1 INTO duracion;
        DELETE LOW_PRIORITY
            FROM `PADEGEST`.`reserva`
            WHERE ADDTIME(`fecha`, duracion) <= NOW();
    END$$
DELIMITER ;