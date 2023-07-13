
 /* FACTURACION */
DROP procedure IF EXISTS `SP_Facturar_Unidades`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Facturar_Unidades` (
	fecha_emitido DATE,
    fecha_venc DATE,
    fecha_limite INT,
    mes INT,
	anio INT
)
BEGIN
	DECLARE var_id_tipo_unidad INT;
	DECLARE var_id_unidad INT;
	DECLARE var_identificador_unidad INT;
	DECLARE var_torre_unidad VARCHAR(3);
    DECLARE var_cant_facturas INT;
    DECLARE salida TEXT;
	DECLARE i INT;
	DECLARE dia INT;
	DECLARE cantidad_dptos INT;
    DECLARE importe DECIMAL;
	SET var_cant_facturas = 0;
    SET importe = 0;
	SET dia = 1;
	SELECT COUNT(*) INTO cantidad_dptos FROM unidades ORDER BY id_unidad;
	SET i = 1;
    SET salida = '';
