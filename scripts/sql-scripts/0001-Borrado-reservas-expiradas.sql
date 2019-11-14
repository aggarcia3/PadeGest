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