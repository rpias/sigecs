
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

	WHILE i<= cantidad_dptos DO
		
		SELECT id_tipo_unidad INTO var_id_tipo_unidad FROM unidades WHERE id_unidad = i;
		SELECT id_unidad INTO var_id_unidad FROM unidades WHERE id_unidad = i;
		SELECT identificador INTO var_identificador_unidad FROM unidades WHERE id_unidad = i;
		SELECT E.nombre INTO var_torre_unidad 
		FROM unidades AS U 
		INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio 
		WHERE id_unidad = i;
		
        IF var_id_tipo_unidad <> 9  THEN
			-- Obtengo el valor por el tipo de Unidad
			SELECT MAX(valor) INTO importe FROM valores_gastos_comunes 
			WHERE id_tipo_unidad = var_id_tipo_unidad
			AND fecha_ajuste <= fecha_emitido;
			
            SELECT COUNT(*) INTO var_cant_facturas FROM facturas 
            WHERE fecha_emitido = fecha_emitido AND id_unidad = var_id_unidad;
            
            IF var_cant_facturas = 0 THEN
			
				SELECT CONCAT('FILA:',i ,' - UNIDAD: ', var_id_unidad, ' - TIPO DPTO: ', var_id_tipo_unidad, ' - IMPORTE: ', importe) INTO salida;
				CALL SP_AgregarFactura_Por_Unidad(fecha_emitido, fecha_venc, fecha_limite, 1, importe, var_id_unidad, 'INGRESADO POR EL SISTEMA');
            
            END IF;
		END IF;
        
        SET i = i + 1;
        
	END WHILE;
    
    SELECT salida AS Salida;
    
END$$
DELIMITER ; 

