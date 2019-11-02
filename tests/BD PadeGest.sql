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

	SELECT id FROM `PADEGEST`.`partido_promocionado` WHERE reserva_id = NEW.`reserva_id` INTO idPartidoPromocionado;
    SELECT id FROM `PADEGEST`.`enfrentamiento` WHERE reserva_id = NEW.`reserva_id` INTO idEnfrentamiento;

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

	SELECT id FROM `PADEGEST`.`partido_promocionado` WHERE reserva_id = NEW.`reserva_id` INTO idPartidoPromocionado;
    SELECT id FROM `PADEGEST`.`enfrentamiento` WHERE reserva_id = NEW.`reserva_id` INTO idEnfrentamiento;

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
-- Users
-- -----------------------------------------------------
DROP USER IF EXISTS 'PadeGestApp'@'localhost';
CREATE USER IF NOT EXISTS 'PadeGestApp'@'localhost' IDENTIFIED WITH mysql_native_password BY 'PadeGestApp';

GRANT TRIGGER, UPDATE, SELECT, INSERT, INDEX, DELETE, ALTER, REFERENCES, DROP, CREATE ON TABLE PADEGEST.* TO 'PadeGestApp'@'localhost';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `PADEGEST`.`configuracion`
-- -----------------------------------------------------
START TRANSACTION;
USE `PADEGEST`;
INSERT INTO `PADEGEST`.`configuracion` (`duracionReservas`) VALUES ('1:0:0');

COMMIT;

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