-- -----------------------------------------------------
-- PadeGest application database
-- For use by PadeGest
-- Generated on 23 Jan 2020 18:25:12    
-- -----------------------------------------------------
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='';

-- -----------------------------------------------------
-- Schema PADEGEST
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `PADEGEST` ;

-- -----------------------------------------------------
-- Schema PADEGEST
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `PADEGEST` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin ;
USE `PADEGEST` ;

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
  `rol` ENUM('deportista', 'administrador', 'entrenador') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`username` ASC))
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
-- Table `PADEGEST`.`clase`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`clase` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`clase` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `plazasMin` SMALLINT UNSIGNED NOT NULL,
  `plazasMax` SMALLINT UNSIGNED NOT NULL,
  `frecuenciaSemanas` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `fechaInicioInscripcion` DATE NOT NULL,
  `fechaFinInscripcion` DATE NOT NULL,
  `semanasDuracion` TINYINT UNSIGNED NOT NULL,
  `horaInicio` TIME NOT NULL,
  `entrenador_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC),
  INDEX `FK_CLASE_USUARIO_idx` (`entrenador_id` ASC),
  CONSTRAINT `FK_CLASE_USUARIO`
    FOREIGN KEY (`entrenador_id`)
    REFERENCES `PADEGEST`.`usuario` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`reserva`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`reserva` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`reserva` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fechaInicio` DATETIME NOT NULL,
  `fechaFin` DATETIME GENERATED ALWAYS AS (ADDTIME(fechaInicio, '1:30:0')) VIRTUAL,
  `pista_id` INT UNSIGNED NOT NULL,
  `usuario_id` INT UNSIGNED NULL,
  `clase_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UNIQUE` (`fechaInicio` ASC, `pista_id` ASC),
  INDEX `FK_PISTA_idx` (`pista_id` ASC),
  INDEX `FK_RESERVA_USUARIO_idx` (`usuario_id` ASC),
  INDEX `FK_RESERVA_ESCUELA_idx` (`clase_id` ASC),
  CONSTRAINT `FK_RESERVA_PISTA`
    FOREIGN KEY (`pista_id`)
    REFERENCES `PADEGEST`.`pista` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_RESERVA_USUARIO`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `PADEGEST`.`usuario` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `FK_RESERVA_CLASE`
    FOREIGN KEY (`clase_id`)
    REFERENCES `PADEGEST`.`clase` (`id`)
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
  `fecha` DATETIME NULL,
  `fase` ENUM('liga regular', 'playoffs1', 'playoffs2', 'playoffs4') NOT NULL,
  `reserva_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_ENFRENTAMIENTO_RESERVA_idx` (`reserva_id` ASC),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC),
  INDEX `fecha_INDEX` (`fecha` ASC),
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
  INDEX `fecha_INDEX` (`fecha` ASC),
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
  `puntuacion` TINYINT UNSIGNED NOT NULL DEFAULT 0,
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
-- Table `PADEGEST`.`noticia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`noticia` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`noticia` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(128) NOT NULL,
  `cuerpo` TEXT NOT NULL,
  `fecha` DATETIME NOT NULL,
  `usuario_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `titulo_UNIQUE` (`titulo` ASC),
  INDEX `FK_NOTICIA_USUARIO_idx` (`usuario_id` ASC),
  CONSTRAINT `FK_NOTICIA_USUARIO`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `PADEGEST`.`usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`clase_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`clase_usuario` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`clase_usuario` (
  `clase_id` INT UNSIGNED NOT NULL,
  `usuario_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`clase_id`, `usuario_id`),
  INDEX `FK_USUARIO_idx` (`usuario_id` ASC),
  CONSTRAINT `FK_CLASE`
    FOREIGN KEY (`clase_id`)
    REFERENCES `PADEGEST`.`clase` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_USUARIO`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `PADEGEST`.`usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PADEGEST`.`pago`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PADEGEST`.`pago` ;

CREATE TABLE IF NOT EXISTS `PADEGEST`.`pago` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(60) NOT NULL,
  `importe` DECIMAL(5,2) UNSIGNED NOT NULL,
  `fecha` DATETIME NOT NULL,
  `usuario_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_PAGO_USUARIO_idx` (`usuario_id` ASC),
  CONSTRAINT `FK_PAGO_USUARIO`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `PADEGEST`.`usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

USE `PADEGEST` ;

-- -----------------------------------------------------
-- function reservaQueOcupaPista
-- -----------------------------------------------------

USE `PADEGEST`;
DROP function IF EXISTS `PADEGEST`.`reservaQueOcupaPista`;

DELIMITER $$
USE `PADEGEST`$$
CREATE FUNCTION `PADEGEST`.`reservaQueOcupaPista`(idPista INT UNSIGNED, fechaInicioComp DATETIME, idReservaIgnorada INT UNSIGNED)
RETURNS INT UNSIGNED NOT DETERMINISTIC READS SQL DATA
SQL SECURITY INVOKER
BEGIN
	DECLARE fechaFinComp DATETIME DEFAULT ADDTIME(fechaInicioComp, '1:30:0');

	DECLARE EXIT HANDLER FOR NOT FOUND RETURN NULL;

	-- Obtener la primera reserva cuyo id sea diferente del ignorado
    -- (por si se quiere ignorar que una reserva haga conflicto con ella
    -- misma), sobre la pista dada, cuyo intervalo de tiempo se solape
    -- con el que se toma como referencia
	RETURN (
		SELECT `id` FROM `PADEGEST`.`reserva`
		WHERE
			NOT `id` <=> idReservaIgnorada AND
			`pista_id` = idPista AND
			fechaFinComp > `fechaInicio` AND
            fechaInicioComp < `fechaFin`
		LIMIT 1
	);
END$$

DELIMITER ;

-- -----------------------------------------------------
-- function pistaDisponibleEnFecha
-- -----------------------------------------------------

USE `PADEGEST`;
DROP function IF EXISTS `PADEGEST`.`pistaDisponibleEnFecha`;

DELIMITER $$
USE `PADEGEST`$$
CREATE FUNCTION `PADEGEST`.`pistaDisponibleEnFecha`(fechaInicioComp DATETIME)
RETURNS INT UNSIGNED NOT DETERMINISTIC READS SQL DATA
SQL SECURITY INVOKER
BEGIN
	DECLARE fechaFinComp DATETIME DEFAULT ADDTIME(fechaInicioComp, '1:30:0');

	DECLARE EXIT HANDLER FOR NOT FOUND RETURN NULL;

	-- Obtener el identificador de la primera pista que no pertenezca
    -- al conjunto de pistas reservadas en el momento dado
	RETURN (
		SELECT `id` FROM `PADEGEST`.`pista` WHERE `id` NOT IN (
			SELECT `pista_id` FROM `PADEGEST`.`reserva`
			WHERE
				fechaFinComp > `fechaInicio` AND
                fechaInicioComp < `fechaFin`
		)
        LIMIT 1
	);
END$$

DELIMITER ;
USE `PADEGEST`;

DELIMITER $$

USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`usuario_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`usuario_BEFORE_INSERT`
BEFORE INSERT ON `usuario` FOR EACH ROW
BEGIN
	IF NEW.`esSocio` <> 0 AND NEW.`esSocio` <> 1 THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'El valor del atributo esSocio de un usuario debe de ser 0 o 1';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`usuario_BEFORE_UPDATE` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`usuario_BEFORE_UPDATE`
BEFORE UPDATE ON `usuario` FOR EACH ROW
BEGIN
	IF NEW.`esSocio` <> 0 AND NEW.`esSocio` <> 1 THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'El valor del atributo esSocio de un usuario debe de ser 0 o 1';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`clase_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`clase_BEFORE_INSERT`
BEFORE INSERT ON `clase` FOR EACH ROW
BEGIN
	IF NEW.`plazasMin` > NEW.`plazasMax` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'El número mínimo de plazas debe de ser menor o igual que el número máximo de plazas';
	END IF;

	IF NEW.`fechaFinInscripcion` < NEW.`fechaInicioInscripcion` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de fin de inscripción debe de ser posterior a la de inicio';
	END IF;

	IF NEW.`frecuenciaSemanas` < 1 THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La frecuencia en semanas debe de ser 1 o mayor';
	END IF;

	IF NEW.`semanasDuracion` < 1 THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'Las clases deben de durar al menos una semana';
	END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`clase_BEFORE_UPDATE` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`clase_BEFORE_UPDATE`
BEFORE UPDATE ON `clase` FOR EACH ROW
BEGIN
	IF NEW.`plazasMin` > NEW.`plazasMax` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'El número mínimo de plazas debe de ser menor o igual que el número máximo de plazas';
	END IF;

	IF NEW.`fechaFinInscripcion` < NEW.`fechaInicioInscripcion` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de fin de inscripción debe de ser posterior a la de inicio';
	END IF;

	IF NEW.`frecuenciaSemanas` < 1 THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La frecuencia en semanas debe de ser 1 o mayor';
	END IF;

	IF NEW.`semanasDuracion` < 1 THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'Las clases deben de durar al menos una semana';
	END IF;
END$$


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
        (NEW.`clase_id` IS NOT NULL OR idPartidoPromocionado IS NOT NULL OR idEnfrentamiento IS NOT NULL)
	THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'Una reserva no puede realizarse por varias entidades a la vez';
    END IF;

	IF NEW.`fechaInicio` > NEW.`fechaFin` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de fin de una reserva debe de ser posterior a la de inicio';
    END IF;

	IF (SELECT `PADEGEST`.`reservaQueOcupaPista`(NEW.`pista_id`, NEW.`fechaInicio`, NEW.`id`) IS NOT NULL) THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La pista asociada a la reserva está ocupada a la hora especificada';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`reserva_AFTER_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`reserva_AFTER_INSERT`
AFTER INSERT ON `reserva` FOR EACH ROW
BEGIN
	DECLARE pistaDisponible INT UNSIGNED DEFAULT NULL;

	DECLARE CONTINUE HANDLER FOR NOT FOUND BEGIN END;

	SELECT `PADEGEST`.`pistaDisponibleEnFecha`(NEW.`fechaInicio`) INTO pistaDisponible;

	-- Si no quedan pistas disponibles, borrar los partidos promocionados
    -- y enfrentamientos que todavía no tengan una reserva de pista para
    -- esa hora
	IF pistaDisponible IS NULL THEN
		DELETE FROM `PADEGEST`.`partido_promocionado`
        WHERE `fecha` = NEW.`fechaInicio` AND `reserva_id` IS NULL;

		DELETE FROM `PADEGEST`.`enfrentamiento`
        WHERE `fecha` <=> NEW.`fechaInicio` AND `reserva_id` IS NULL;
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
        (NEW.`clase_id` IS NOT NULL OR idPartidoPromocionado IS NOT NULL OR idEnfrentamiento IS NOT NULL)
	THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'Una reserva no puede realizarse por un usuario y por un partido promocionado, enfrentamiento o clase a la vez';
    END IF;

	IF NEW.`fechaInicio` > NEW.`fechaFin` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de fin de una reserva debe de ser posterior a la de inicio';
    END IF;

	IF (SELECT `PADEGEST`.`reservaQueOcupaPista`(NEW.`pista_id`, NEW.`fechaInicio`, NEW.`id`) IS NOT NULL) THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La pista asociada a la reserva está ocupada a la hora especificada';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`reserva_AFTER_UPDATE` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`reserva_AFTER_UPDATE`
AFTER UPDATE ON `reserva` FOR EACH ROW
BEGIN
	DECLARE pistaDisponible INT UNSIGNED DEFAULT NULL;

	DECLARE CONTINUE HANDLER FOR NOT FOUND BEGIN END;

	SELECT `PADEGEST`.`pistaDisponibleEnFecha`(NEW.`fechaInicio`) INTO pistaDisponible;

	-- Si no quedan pistas disponibles, borrar los partidos promocionados
	-- y enfrentamientos que todavía no tengan una reserva de pista para
	-- esa hora
	IF pistaDisponible IS NULL THEN
		DELETE FROM `PADEGEST`.`partido_promocionado`
		WHERE `fecha` = NEW.`fechaInicio` AND `reserva_id` IS NULL;

		DELETE FROM `PADEGEST`.`enfrentamiento`
		WHERE `fecha` <=> NEW.`fechaInicio` AND `reserva_id` IS NULL;
	END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`enfrentamiento_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`enfrentamiento_BEFORE_INSERT`
BEFORE INSERT ON `enfrentamiento` FOR EACH ROW
BEGIN
	DECLARE fechaReserva DATETIME DEFAULT NULL;
	DECLARE pistaDisponible INT UNSIGNED DEFAULT NULL;

	DECLARE CONTINUE HANDLER FOR NOT FOUND BEGIN END;

	IF NEW.`fecha` IS NOT NULL THEN
		SELECT fechaInicio FROM `PADEGEST`.`reserva` WHERE id = NEW.`reserva_id` INTO fechaReserva;

		IF fechaReserva IS NOT NULL AND fechaReserva <> NEW.`fecha` THEN
			SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de la reserva asociada a un partido debe de coincidir con la del partido';
		END IF;

		SELECT `PADEGEST`.`pistaDisponibleEnFecha`(NEW.`fecha`) INTO pistaDisponible;

		IF pistaDisponible IS NULL THEN
			SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'No tiene sentido que un partido promocionado se celebre en una fecha que ya está ocupada';
		END IF;
	END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`enfrentamiento_BEFORE_UPDATE` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`enfrentamiento_BEFORE_UPDATE`
BEFORE UPDATE ON `enfrentamiento` FOR EACH ROW
BEGIN
	DECLARE fechaReserva DATETIME DEFAULT NULL;
	DECLARE pistaDisponible INT UNSIGNED DEFAULT NULL;

	DECLARE CONTINUE HANDLER FOR NOT FOUND BEGIN END;

	IF NEW.`fecha` IS NOT NULL THEN
		SELECT fechaInicio FROM `PADEGEST`.`reserva` WHERE id = NEW.`reserva_id` INTO fechaReserva;

		IF fechaReserva IS NOT NULL AND fechaReserva <> NEW.`fecha` THEN
			SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de la reserva asociada a un partido debe de coincidir con la del partido';
		END IF;

		SELECT `PADEGEST`.`pistaDisponibleEnFecha`(NEW.`fecha`) INTO pistaDisponible;

		IF pistaDisponible IS NULL THEN
			SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'No tiene sentido que un partido promocionado se celebre en una fecha que ya está ocupada';
		END IF;
	END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`partido_promocionado_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`partido_promocionado_BEFORE_INSERT`
BEFORE INSERT ON `partido_promocionado` FOR EACH ROW
BEGIN
	DECLARE fechaReserva DATETIME DEFAULT NULL;
	DECLARE pistaDisponible INT UNSIGNED DEFAULT NULL;

	DECLARE CONTINUE HANDLER FOR NOT FOUND BEGIN END;

	SELECT fechaInicio FROM `PADEGEST`.`reserva` WHERE id = NEW.`reserva_id` INTO fechaReserva;

	IF fechaReserva IS NOT NULL AND fechaReserva <> NEW.`fecha` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de la reserva asociada a un partido debe de coincidir con la del partido';
	END IF;

	SELECT `PADEGEST`.`pistaDisponibleEnFecha`(NEW.`fecha`) INTO pistaDisponible;

	IF pistaDisponible IS NULL THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'No tiene sentido crear un partido promocionado en una fecha que ya está ocupada';
	END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`partido_promocionado_BEFORE_UPDATE` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`partido_promocionado_BEFORE_UPDATE`
BEFORE UPDATE ON `partido_promocionado` FOR EACH ROW
BEGIN
	DECLARE fechaReserva DATETIME DEFAULT NULL;
	DECLARE pistaDisponible INT UNSIGNED DEFAULT NULL;

	DECLARE CONTINUE HANDLER FOR NOT FOUND BEGIN END;

	SELECT fechaInicio FROM `PADEGEST`.`reserva` WHERE id = NEW.`reserva_id` INTO fechaReserva;

	IF fechaReserva IS NOT NULL AND fechaReserva <> NEW.`fecha` THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'La fecha de la reserva asociada a un partido debe de coincidir con la del partido';
	END IF;

	SELECT `PADEGEST`.`pistaDisponibleEnFecha`(NEW.`fecha`) INTO pistaDisponible;

	IF pistaDisponible IS NULL THEN
		SIGNAL SQLSTATE VALUE 'HY000' SET MESSAGE_TEXT = 'No tiene sentido que un partido promocionado se celebre en una fecha que ya está ocupada';
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


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`noticia_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`noticia_BEFORE_INSERT`
BEFORE INSERT ON `noticia` FOR EACH ROW
BEGIN
	IF (NEW.`fecha` IS NULL) THEN
		SET NEW.`fecha` = NOW();
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`clase_usuario_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`clase_usuario_BEFORE_INSERT`
BEFORE INSERT ON `clase_usuario` FOR EACH ROW
BEGIN
	DECLARE plazasMax SMALLINT UNSIGNED;
    DECLARE fechaFinInscripciones DATE;

	DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;

	SELECT `plazasMax` FROM `PADEGEST`.`clase` WHERE `id` = NEW.`clase_id` INTO plazasMax;
    SELECT `fechaFinInscripcion` FROM `PADEGEST`.`clase` WHERE `id` = NEW.`clase_id` INTO fechaFinInscripciones;

    IF ((SELECT COUNT(*) FROM `PADEGEST`.`clase_usuario` WHERE `clase_id` = NEW.`clase_id`) > plazasMax) THEN
		SIGNAL SQLSTATE 'HY000' SET MESSAGE_TEXT = 'Se intentan inscribir más deportista en una clase que los permitidos por el número de plazas';
    END IF;

	IF CURDATE() > fechaFinInscripciones THEN
		SIGNAL SQLSTATE 'HY000' SET MESSAGE_TEXT = 'Se ha intentado inscribir un deportista en una clase cuya fecha de fin de inscripciones ha finalizado';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`clase_usuario_BEFORE_UPDATE` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`clase_usuario_BEFORE_UPDATE`
BEFORE UPDATE ON `clase_usuario` FOR EACH ROW
BEGIN
	DECLARE plazasMax SMALLINT UNSIGNED;
    DECLARE fechaFinInscripciones DATE;

	DECLARE EXIT HANDLER FOR NOT FOUND BEGIN END;

	SELECT `plazasMax` FROM `PADEGEST`.`clase` WHERE `id` = NEW.`clase_id` INTO plazasMax;
    SELECT `fechaFinInscripcion` FROM `PADEGEST`.`clase` WHERE `id` = NEW.`clase_id` INTO fechaFinInscripciones;

    IF ((SELECT COUNT(*) FROM `PADEGEST`.`clase_usuario` WHERE `clase_id` = NEW.`clase_id`) > plazasMax) THEN
		SIGNAL SQLSTATE 'HY000' SET MESSAGE_TEXT = 'Se intentan inscribir más deportista en una clase que los permitidos por el número de plazas';
    END IF;

	IF CURDATE() > fechaFinInscripciones THEN
		SIGNAL SQLSTATE 'HY000' SET MESSAGE_TEXT = 'Se ha intentado inscribir un deportista en una clase cuya fecha de fin de inscripciones ha finalizado';
    END IF;
END$$


USE `PADEGEST`$$
DROP TRIGGER IF EXISTS `PADEGEST`.`pago_BEFORE_INSERT` $$
USE `PADEGEST`$$
CREATE TRIGGER `PADEGEST`.`pago_BEFORE_INSERT`
BEFORE INSERT ON `pago` FOR EACH ROW
BEGIN
	IF (NEW.`fecha` IS NULL) THEN
		SET NEW.`fecha` = NOW();
    END IF;
END$$


DELIMITER ;

-- -----------------------------------------------------
-- User PadeGestApp
-- -----------------------------------------------------
DROP USER IF EXISTS 'PadeGestApp';
CREATE USER 'PadeGestApp' IDENTIFIED BY 'PadeGestApp';
GRANT TRIGGER, UPDATE, SELECT, INSERT, INDEX, DELETE, ALTER, REFERENCES, DROP, CREATE ON TABLE PADEGEST.* TO 'PadeGestApp';
GRANT EXECUTE ON FUNCTION PADEGEST.reservaQueOcupaPista TO 'PadeGestApp';
GRANT EXECUTE ON function `PADEGEST`.`pistaDisponibleEnFecha` TO 'PadeGestApp';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `PADEGEST`.`usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Nuria', 'García', 'femenino', 0, 'administrador');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (2, 'greencat609', 'f7802c6426e92dc6703e79b928905504', 'Luisa', 'Vega', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (3, 'organicfish174', '7ffaae67fd14ed82799775f8ed0786db', 'Susana', 'Soto', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (4, 'beautifultiger401', '40a658eb4a093d38b9b5e4169729a13b', 'Celia', 'Domínguez', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (5, 'greenladybug269', 'a06c8412cdbf80beacff001f3276cec0', 'Nicolás', 'Marín', 'masculino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (6, 'organicdog654', '8a76977f63691b218a40f4cbf1987815', 'Daniel', 'Morales', 'masculino', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (7, 'bluepeacock966', '4dac8c9b3a3c4fd41d3c5c21c5f0e236', 'María', 'Antonia Iglesias', 'femenino', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (8, 'heavybutterfly345', '7f80110eb10e4b1ccc27d9a062a2302c', 'Manuel', 'Giménez', 'masculino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (9, 'heavybutterfly377', '7530dffb2bbba483691329908b94df6c', 'Ignacio', 'Moya', 'masculino', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (10, 'happybutterfly909', '426700733faaed4ef78e1f0ea2849d5a', 'Ángeles', 'Núñez', 'femenino', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (11, 'yellowzebra924', 'dd410087bfda6e014e0dcf8a92532644', 'Natalia', 'Alonso', 'femenino', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (12, 'purplemouse320', '2fdb189f2ddc0870f8922e5e3c78bf28', 'María Teresa', 'Hidalgo', 'femenino', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (13, 'orangedog307', 'c48cb78bd24f39c625aa591c14f62eeb', 'Mario', 'Benítez', 'masculino', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (14, 'whitefish726', '70642510997ddb8b7aff459812ac9960', 'Rubén', 'Blanco', 'masculino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (15, 'silvercat186', 'a65fbffde76764e3f2207649e03707e9', 'Concepción', 'Mora', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (16, 'beautifulgoose185', 'b39f9aedd0d29d535dcfb0c498db6f93', 'Marta', 'Alonso', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (17, 'tinygorilla203', 'a72443d8e2e3f6949e699d6dd0a9617d', 'María Angeles', 'Vázquez', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (18, 'tinytiger912', '9b12d358a0c3059cf7da15eb2c051655', 'Alicia', 'Peña', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (19, 'tinymeercat208', '34b0b61675eeabd40150fad0717cd8c5', 'Carolina', 'Martínez', 'femenino', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (20, 'silverbird807', '78bf8da1ff18b22408bb5ac3f70d9c33', 'Celia', 'Lorenzo', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (21, 'sadladybug879', '1603272b464d97b6af0c8d717b698211', 'Paula', 'Giménez', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (22, 'blueostrich272', 'c46a1f254b6fb6b07e4144e79df7a085', 'Marina', 'Ramírez', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (23, 'smallgorilla279', 'a0301897d78518ec185a2dcebeb82c59', 'Tomás', 'Gil', 'masculino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (24, 'blueostrich184', 'd39c45ce3748e1fb0f9569be26d7735d', 'Antonia', 'Castillo', 'femenino', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (25, 'heavycat480', 'f7b02a4ae4736a6b2348f8312c5d46ce', 'Rubén', 'Bravo', 'masculino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (26, 'greenfrog567', '49af884e1f5239a735620e611233e0ee', 'Rubén', 'Méndez', 'masculino', 0, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (27, 'whitebutterfly953', '3744a0e5839ecc55ea69ffdee3f39fa5', 'Ángela', 'Sáez', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (28, 'redcat927', '32fdc39a8da2bdb7a98dadcefc6c1e38', 'Felipe', 'Torres', 'masculino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (29, 'sadgoose648', 'e2c20148ce95dd1163f6f3bd646e4baa', 'María Angeles', 'Giménez', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (30, 'goldenpanda782', '969512f72ca38494a7d93d4e8a1ba4bb', 'Francisca', 'Carmona', 'femenino', 1, 'deportista');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (31, 'paleeffervescent', '140661d8d036bc77c209c655cdca7fbb', 'Luc¡a', 'Soto', 'femenino', 0, 'entrenador');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (32, 'pinkpast', '3e8a45fa1cad22f783cab49ba739f3d4', 'Rosa Mar¡a', 'Rojas', 'femenino', 0, 'entrenador');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (33, 'galaxy_wherewithal', '37aca70f404d1f9c5d81d2b26c007c3f', 'µlvaro', 'Molina', 'masculino', 0, 'entrenador');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (34, 'mellifluous_flower', '4599e5a3adbbf71110bf2e2f79bfad38', 'Yolanda', 'Vidal', 'femenino', 0, 'entrenador');
INSERT INTO `PADEGEST`.`usuario` (`id`, `username`, `password`, `nombre`, `apellidos`, `genero`, `esSocio`, `rol`) VALUES (35, 'tofugaze', 'f923cab4e27af6167241f8902b25c162', 'Juan Carlos', 'Carmona', 'masculino', 0, 'entrenador');

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
-- Data for table `PADEGEST`.`clase`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`clase` (`id`, `nombre`, `plazasMin`, `plazasMax`, `frecuenciaSemanas`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `semanasDuracion`, `horaInicio`, `entrenador_id`) VALUES (1, 'Golpe bajo', 10, 15, DEFAULT, '2019-12-30', '2020-01-31', 3, '13:30', NULL);
INSERT INTO `PADEGEST`.`clase` (`id`, `nombre`, `plazasMin`, `plazasMax`, `frecuenciaSemanas`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `semanasDuracion`, `horaInicio`, `entrenador_id`) VALUES (2, 'Golpe alto', 8, 20, DEFAULT, '2020-01-18', '2020-02-15', 4, '16:30', 31);
INSERT INTO `PADEGEST`.`clase` (`id`, `nombre`, `plazasMin`, `plazasMax`, `frecuenciaSemanas`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `semanasDuracion`, `horaInicio`, `entrenador_id`) VALUES (3, 'Revés', 10, 17, DEFAULT, '2019-11-28', '2020-04-15', 3, '13:30', 32);
INSERT INTO `PADEGEST`.`clase` (`id`, `nombre`, `plazasMin`, `plazasMax`, `frecuenciaSemanas`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `semanasDuracion`, `horaInicio`, `entrenador_id`) VALUES (4, 'Técnica', 7, 17, DEFAULT, '2020-01-31', '2020-03-25', 6, '12:00', 33);
INSERT INTO `PADEGEST`.`clase` (`id`, `nombre`, `plazasMin`, `plazasMax`, `frecuenciaSemanas`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `semanasDuracion`, `horaInicio`, `entrenador_id`) VALUES (5, 'Táctica', 9, 20, DEFAULT, '2019-11-19', '2020-02-17', 6, '09:00', 33);
INSERT INTO `PADEGEST`.`clase` (`id`, `nombre`, `plazasMin`, `plazasMax`, `frecuenciaSemanas`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `semanasDuracion`, `horaInicio`, `entrenador_id`) VALUES (6, 'Saque', 9, 20, DEFAULT, '2020-01-09', '2020-02-29', 6, '09:00', 34);
INSERT INTO `PADEGEST`.`clase` (`id`, `nombre`, `plazasMin`, `plazasMax`, `frecuenciaSemanas`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `semanasDuracion`, `horaInicio`, `entrenador_id`) VALUES (7, 'Resistencia', 7, 18, DEFAULT, '2020-01-28', '2020-03-10', 6, '09:00', 34);
INSERT INTO `PADEGEST`.`clase` (`id`, `nombre`, `plazasMin`, `plazasMax`, `frecuenciaSemanas`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `semanasDuracion`, `horaInicio`, `entrenador_id`) VALUES (8, 'Dejadas', 6, 20, DEFAULT, '2020-01-09', '2020-02-05', 5, '18:00', 35);
INSERT INTO `PADEGEST`.`clase` (`id`, `nombre`, `plazasMin`, `plazasMax`, `frecuenciaSemanas`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `semanasDuracion`, `horaInicio`, `entrenador_id`) VALUES (9, 'Fuerza', 5, 19, DEFAULT, '2019-11-24', '2020-01-05', 3, '13:30', 35);
INSERT INTO `PADEGEST`.`clase` (`id`, `nombre`, `plazasMin`, `plazasMax`, `frecuenciaSemanas`, `fechaInicioInscripcion`, `fechaFinInscripcion`, `semanasDuracion`, `horaInicio`, `entrenador_id`) VALUES (10, 'Psicología', 7, 15, DEFAULT, '2019-11-27', '2020-03-02', 6, '13:30', 35);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`reserva`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (1, '2019-11-21 19:30:00', DEFAULT, 10, 20, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (2, '2019-11-25 19:30:00', DEFAULT, 4, 8, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (3, '2019-11-24 09:00:00', DEFAULT, 14, 18, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (4, '2019-11-22 10:30:00', DEFAULT, 13, 12, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (5, '2019-11-23 19:30:00', DEFAULT, 10, 24, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (6, '2019-11-22 16:30:00', DEFAULT, 4, 24, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (7, '2019-11-25 10:30:00', DEFAULT, 2, 9, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (8, '2019-11-21 15:00:00', DEFAULT, 4, 26, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (9, '2019-11-20 16:30:00', DEFAULT, 5, 11, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (10, '2019-11-23 19:30:00', DEFAULT, 14, 26, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (11, '2019-11-16 19:30:00', DEFAULT, 12, NULL, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (12, '2019-11-23 13:30:00', DEFAULT, 12, NULL, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (13, '2019-11-19 18:00:00', DEFAULT, 13, NULL, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (14, '2019-11-06 10:30:00', DEFAULT, 3, NULL, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (15, '2019-11-15 18:00:00', DEFAULT, 6, NULL, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (16, '2019-11-22 10:30:00', DEFAULT, 7, NULL, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (17, '2019-11-28 12:00:00', DEFAULT, 1, 6, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (18, '2019-11-28 12:00:00', DEFAULT, 2, 14, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (19, '2019-11-28 12:00:00', DEFAULT, 3, 26, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (20, '2019-11-28 12:00:00', DEFAULT, 4, 3, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (21, '2019-11-28 12:00:00', DEFAULT, 5, 19, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (22, '2019-11-28 12:00:00', DEFAULT, 6, 28, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (23, '2019-11-28 12:00:00', DEFAULT, 7, 3, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (24, '2019-11-28 12:00:00', DEFAULT, 8, 9, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (25, '2019-11-28 12:00:00', DEFAULT, 9, 6, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (26, '2019-11-28 12:00:00', DEFAULT, 10, 25, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (27, '2019-11-28 12:00:00', DEFAULT, 11, 20, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (28, '2019-11-28 12:00:00', DEFAULT, 12, 21, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (29, '2019-11-28 12:00:00', DEFAULT, 13, 8, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (30, '2019-11-28 12:00:00', DEFAULT, 14, 23, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (31, '2019-11-28 12:00:00', DEFAULT, 15, 24, NULL);
INSERT INTO `PADEGEST`.`reserva` (`id`, `fechaInicio`, `fechaFin`, `pista_id`, `usuario_id`, `clase_id`) VALUES (32, '2020-4-16 13:30:00', DEFAULT, 3, NULL, 10);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`enfrentamiento`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `fase`, `reserva_id`) VALUES (1, 'Partido 1 European Veteran Championship', '2019-11-19 18:00:00', 'liga regular', 13);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `fase`, `reserva_id`) VALUES (2, 'Partido 2 European Veteran Championship', '2019-11-06 10:30:00', 'liga regular', 14);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `fase`, `reserva_id`) VALUES (3, 'Partido 1 Máster de Menores 2019', '2019-11-15 18:00:00', 'playoffs1', 15);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `fase`, `reserva_id`) VALUES (4, 'Partido 2 Máster de Menores 2019', '2019-11-22 10:30:00', 'liga regular', 16);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `fase`, `reserva_id`) VALUES (5, 'Partido 1 TyC PREMIUM 3', '2019-10-28 12:00:00', 'playoffs1', NULL);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `fase`, `reserva_id`) VALUES (6, 'Partido 3 European Veteran Championship', '2019-10-19 11:00:00', 'liga regular', NULL);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `fase`, `reserva_id`) VALUES (7, 'Partido 3 Máster de Menores 2019', '2019-10-05 17:00:00', 'liga regular', NULL);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `fase`, `reserva_id`) VALUES (8, 'Partido 2 TyC PREMIUM 3', '2019-10-28 18:00:00', 'playoffs1', NULL);
INSERT INTO `PADEGEST`.`enfrentamiento` (`id`, `nombre`, `fecha`, `fase`, `reserva_id`) VALUES (9, 'Partido 3 TyC PREMIUM 3', '2019-10-05 20:00:00', 'liga regular', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`partido_promocionado`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`partido_promocionado` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (1, 'Partido amistoso de PadeClub', '2019-11-16 19:30:00', 11);
INSERT INTO `PADEGEST`.`partido_promocionado` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (2, 'Partido entrenamiento Copa Pádel', '2019-10-26 18:00:00', NULL);
INSERT INTO `PADEGEST`.`partido_promocionado` (`id`, `nombre`, `fecha`, `reserva_id`) VALUES (3, 'Primer partido solidario', '2019-11-23 13:30:00', 12);

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
INSERT INTO `PADEGEST`.`campeonato` (`id`, `nombre`, `bases`, `fechaInicioInscripciones`, `fechaFinInscripciones`) VALUES (1, 'European Veteran Championship', 'Bases de campeonato de ejemplo', '2019-07-31 00:00:00', '2019-11-16 00:00:00');
INSERT INTO `PADEGEST`.`campeonato` (`id`, `nombre`, `bases`, `fechaInicioInscripciones`, `fechaFinInscripciones`) VALUES (2, 'Máster de Menores 2019', 'Bases de campeonato de ejemplo', '2019-06-10 00:00:00', '2019-06-29 00:00:00');
INSERT INTO `PADEGEST`.`campeonato` (`id`, `nombre`, `bases`, `fechaInicioInscripciones`, `fechaFinInscripciones`) VALUES (3, 'TyC PREMIUM 3', 'Bases de campeonato de ejemplo', '2019-09-29 00:00:00', '2019-12-05 00:00:00');

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
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (1, 30, 18, 48, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (2, 27, 2, 33, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (3, 5, 6, 16, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (4, 11, 19, 16, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (5, 3, 20, 4, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (6, 19, 16, 11, 23, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (7, 8, 25, 10, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (8, 26, 8, 38, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (9, 10, 11, 37, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (10, 29, 22, 9, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (11, 19, 20, 42, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (12, 21, 6, 37, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (13, 16, 23, 5, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (14, 11, 4, 23, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (15, 28, 26, 40, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (16, 19, 25, 44, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (17, 24, 5, 45, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (18, 12, 5, 15, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (19, 28, 12, 28, 21, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (20, 13, 3, 8, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (21, 15, 19, 25, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (22, 5, 30, 31, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (23, 17, 6, 10, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (24, 19, 27, 36, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (25, 15, 17, 14, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (26, 9, 29, 26, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (27, 15, 18, 23, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (28, 17, 30, 4, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (29, 20, 18, 22, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (30, 15, 21, 21, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (31, 3, 2, 25, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (32, 15, 24, 35, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (33, 13, 11, 24, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (34, 13, 10, 48, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (35, 16, 7, 15, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (36, 10, 7, 32, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (37, 26, 2, 26, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (38, 16, 18, 42, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (39, 10, 21, 29, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (40, 2, 7, 11, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (41, 25, 17, 13, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (42, 11, 24, 6, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (43, 19, 29, 21, 3, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (44, 23, 8, 0, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (45, 20, 11, 27, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (46, 12, 8, 39, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (47, 30, 30, 19, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (48, 29, 30, 42, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (49, 24, 4, 28, 24, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (50, 8, 11, 8, 11, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (51, 22, 5, 6, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (52, 6, 17, 18, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (53, 19, 25, 10, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (54, 12, 28, 44, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (55, 15, 2, 33, 9, 3);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (56, 22, 16, 13, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (57, 28, 2, 19, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (58, 13, 19, 1, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (59, 22, 28, 39, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (60, 9, 25, 44, 17, 2);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (61, 26, 16, 17, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (62, 4, 26, 18, 10, NULL);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (63, 26, 7, 24, 7, 1);
INSERT INTO `PADEGEST`.`pareja` (`id`, `idCapitan`, `idCompanero`, `puntuacion`, `categoria_nivel_id`, `grupo_id`) VALUES (64, 4, 2, 34, 17, 2);

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
-- Data for table `PADEGEST`.`noticia`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`noticia` (`id`, `titulo`, `cuerpo`, `fecha`, `usuario_id`) VALUES (1, 'Gonzalo Rubio y Ernesto Moreno, adiós a una pareja de enorme calidad y potencia', 'Otra pareja que anuncia su separación, la formada por Ernesto Moreno y Gonzalo Rubio. Los dos andaluces pondrán fin a una etapa en la que han conseguido importantes objetivos pero en la que no han terminado, a pesar de su calidad, de dar ese pasito extra y culminar su buen hacer en pista.', '2019-10-28 15:00:00', 1);
INSERT INTO `PADEGEST`.`noticia` (`id`, `titulo`, `cuerpo`, `fecha`, `usuario_id`) VALUES (2, 'Una excelente y completa formación en todos los ámbitos del pádel', 'Noticia muy importante en cuanto a formación de pádel la que nos llega desde Padel Nuestro, quienes han decidido embarcarse en un proyecto de formación a todos los niveles, lanzando el primer Curso Padel Player, enfocado a todos aquellos que quieran dedicarse al pádel de forma profesional o simplemente para aprender nuevos aspectos tácticos. Avalado por varias de las empresas más destacadas del sector como Padel Nuestro, Bullpadel y Pascal Box, esta primera convocatoria del curso Padel Player 1 estará disponible a la venta desde el lunes 16 de diciembre y las clases comenzarán el próximo 6 de enero de 2020. Jugadores del World Padel Tour de la talla de Maxi Sánchez o Alejandra Salazar ayudarán a Manu Martín, uno de los mejores entrenadores de pádel, a impartir las 30 clases que forman parte del curso, lecciones que cualquiera podrá disfrutar por tan solo 29,00€.', '2019-10-25 07:00:00', 1);
INSERT INTO `PADEGEST`.`noticia` (`id`, `titulo`, `cuerpo`, `fecha`, `usuario_id`) VALUES (3, 'Conoce el recorrido de las chicas en el Master Final ', 'Ya es oficial, ya se conoce cómo será el camino del Master Final en lo que a la categoría masculina se refiere tras el sorteo de emparejamientos. Un sorteo que, teniendo en cuenta el nombre de los participantes, no ha dejado a nadie indiferente y todos serán duelos de altas revoluciones. La pelea arrancará el jueves en el segundo turno (las chicas comienzan a las 12 horas del mediodía) con la pareja de circunstancias formada por Agustín Gómez Silingo y Juani Mieres ante Fernando Belasteguín y Agustín Tapia, para continuar por la tarde con un duelo 100% español entre Uri Botello y Javi Ruiz ante Paquito Navarro y Juan Lebrón, los números 1. Este choque, además, nos presentará a dos parejas que podrían estar en sus últimos compromisos juntos si los rumores de separación son ciertos.', '2019-11-25 08:00:00', 1);
INSERT INTO `PADEGEST`.`noticia` (`id`, `titulo`, `cuerpo`, `fecha`, `usuario_id`) VALUES (4, 'Una Navidad de pádel y solidaria para los pequeños de Málaga', 'Por cuarto año consecutivo, la firma StarVie se pone del lado de los más pequeños, en concreto de los que necesitan una alegría extra en estas fiestas, colaborando con la Fundación Cesare Scariolo en la iniciativa benéfica \'\'Operación juguete\'\'. La campaña solidaria busca obtener el máximo número de juguetes para repartir esta Navidad a los niños ingresados en la planta de oncología del Hospital Materno-Infantil de Málaga. El evento consiste en un clinic impartido por jugadores StarVie con la única condición para participar de entregar un juguete nuevo. Tras el éxito de los años anteriores en el que se recaudaron más de 850 regalos, esta edición el evento se realiza en cinco ciudades españolas: Madrid, Málaga, Sevilla, Valencia y Benidorm. De la misma manera que en ediciones anteriores, las personas que quieran participar deben inscribirse en la recepción del club de cada una de las ciudades. Todos los juguetes recogidos serán donados a la Fundación Cesare Scariolo para después ser entregados a los niños que están recibiendo tratamientos oncológicos en el Hospital de Málaga.', '2019-12-21 09:00:00', 1);
INSERT INTO `PADEGEST`.`noticia` (`id`, `titulo`, `cuerpo`, `fecha`, `usuario_id`) VALUES (5, 'Empieza el baile de parejas para la próxima temporada', 'Aunque queda por disputarse el Estrella Damm Barcelona Master muchos jugadores ya han terminado la temporada y han comenzado a planificar el año próximo. Como todos los años se aproxima una gran cantidad de nuevas parejas, las cuales iremos conociendo poco a poco en las próximas semanas.', '2019-12-29 11:00:00', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`clase_usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (10, 30);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (10, 5);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (2, 12);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (2, 15);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (7, 7);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (5, 29);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (10, 10);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (6, 27);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (2, 30);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (4, 13);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (2, 24);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (2, 2);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (1, 3);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (2, 13);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (4, 7);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (3, 25);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (2, 27);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (2, 17);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (8, 18);
INSERT INTO `PADEGEST`.`clase_usuario` (`clase_id`, `usuario_id`) VALUES (2, 4);

COMMIT;


-- -----------------------------------------------------
-- Data for table `PADEGEST`.`pago`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`pago` (`id`, `concepto`, `importe`, `fecha`, `usuario_id`) VALUES (1, 'Inscripción campeonato', 5, '2019-08-22 03:55:25', 13);
INSERT INTO `PADEGEST`.`pago` (`id`, `concepto`, `importe`, `fecha`, `usuario_id`) VALUES (2, 'Cuota socio', 15, '2019-10-23 11:26:35', 18);
INSERT INTO `PADEGEST`.`pago` (`id`, `concepto`, `importe`, `fecha`, `usuario_id`) VALUES (3, 'Reserva pista', 18, '2019-12-08 04:52:40', 20);
INSERT INTO `PADEGEST`.`pago` (`id`, `concepto`, `importe`, `fecha`, `usuario_id`) VALUES (4, 'Reserva pista', 12, '2019-12-28 11:38:20', 8);
INSERT INTO `PADEGEST`.`pago` (`id`, `concepto`, `importe`, `fecha`, `usuario_id`) VALUES (5, 'Reserva pista', 8, '2019-10-16 19:18:22', 18);
INSERT INTO `PADEGEST`.`pago` (`id`, `concepto`, `importe`, `fecha`, `usuario_id`) VALUES (6, 'Inscripción campeonato', 5, '2019-10-23 12:55:43', 5);
INSERT INTO `PADEGEST`.`pago` (`id`, `concepto`, `importe`, `fecha`, `usuario_id`) VALUES (7, 'Cuota socio', 15, '2019-09-10 15:20:35', 23);
INSERT INTO `PADEGEST`.`pago` (`id`, `concepto`, `importe`, `fecha`, `usuario_id`) VALUES (8, 'Reserva pista', 10, '2019-08-15 10:52:53', 12);
INSERT INTO `PADEGEST`.`pago` (`id`, `concepto`, `importe`, `fecha`, `usuario_id`) VALUES (9, 'Cuota socio', 15, '2019-12-22 15:43:30', 25);
INSERT INTO `PADEGEST`.`pago` (`id`, `concepto`, `importe`, `fecha`, `usuario_id`) VALUES (10, 'Reserva pista', 16, '2019-08-31 18:40:56', 24);

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
        DELETE LOW_PRIORITY
            FROM `PADEGEST`.`reserva`
            WHERE `fechaFin` <= NOW();
    END$$
DELIMITER ;