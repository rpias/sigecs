
################################################################################
# SP_ListarMenuPadresPorRol
################################################################################

DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_ListarUltimoPagoPorUnidad`;
CREATE PROCEDURE `SP_ListarUltimoPagoPorUnidad` ()
BEGIN 

SELECT 
	e.nombre AS torre_nombre, 
    e.identificador AS torre_nro, 
	u.identificador AS unidad,
    DATE_FORMAT((SELECT MAX(fecha) FROM recibos 
						WHERE id_unidad = u.id_unidad 
						AND habilitado = 1 AND id_concepto_factura <> 3
                        LIMIT 1), "%d/%m/%Y") AS fecha,
	
    (SELECT nro_recibo FROM recibos 
		WHERE id_unidad = u.id_unidad
        AND fecha = (SELECT MAX(fecha) FROM recibos 
							WHERE id_unidad = u.id_unidad
                            AND habilitado = 1 AND id_concepto_factura <> 3 LIMIT 1) LIMIT 1) AS nro_recibo,
                           
	(SELECT mes FROM recibos 
		WHERE id_unidad = u.id_unidad
        AND fecha = (SELECT MAX(fecha) FROM recibos 
							WHERE id_unidad = u.id_unidad
                            AND habilitado = 1 AND id_concepto_factura <> 3 LIMIT 1) LIMIT 1) AS mes,
                         
	(SELECT anio FROM recibos 
		WHERE id_unidad = u.id_unidad
        AND fecha = (SELECT MAX(fecha) FROM recibos 
							WHERE id_unidad = u.id_unidad
                        AND habilitado = 1 AND id_concepto_factura <> 3 LIMIT 1) LIMIT 1)    AS anio,
                  
(SELECT CONCAT(nro_expediente,  " - ", 
    DATE_FORMAT(fecha_expediente, '%d/%m/%Y'), " - ", 
    FORMAT(importe_total_reclamado,0))  FROM expedientes 
			WHERE id_unidad = u.id_unidad AND habilitado = 1
			AND fecha_expediente = (SELECT MAX(fecha_expediente) FROM expedientes 
								WHERE id_unidad = u.id_unidad LIMIT 1) LIMIT 1)
                        AS ultimo_expediente
                        
                        
	FROM unidades AS u 
	INNER JOIN edificios AS e ON e.id_edificio = u.id_edificio;
    
END$$


