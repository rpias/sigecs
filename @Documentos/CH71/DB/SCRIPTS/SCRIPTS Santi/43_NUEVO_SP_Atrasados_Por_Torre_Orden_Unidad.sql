/*MUESTRA TODOS LAS UNIDADES SEGUN UN EDIFICIO DADO QUE NO HAN PAGADO EN UNA FECHA DADA*/

DROP PROCEDURE IF EXISTS `SP_Atrasados_Por_Torre_Orden_Unidad` DELIMITER $$
CREATE PROCEDURE `SP_Atrasados_Por_Torre_Orden_Unidad`(IN `id_torre` INT, IN `fecha_limite` DATE)  BEGIN 
 SELECT ED.nombre AS torre_nombre,
 RE.id_recibo,
	ED.identificador AS torre_nro,
	UN.identificador AS unidad,
    DATE_FORMAT(RE.fecha,"%d/%m/%Y") AS fecha,
    RE.nro_recibo,
    RE.mes,
    RE.anio,
    RE.obs,
    CONCAT(EX.nro_expediente,  " - ",  
    DATE_FORMAT(EX.fecha_expediente, '%d/%m/%Y'), " - ", 
    FORMAT(EX.importe_total_reclamado,0)) AS ultimo_expediente
	FROM unidades UN
		INNER JOIN edificios ED
			ON ED.id_edificio = UN.id_edificio
            AND ED.identificador = id_torre /*Filtro por torre*/
        LEFT JOIN recibos RE /*Me quedo con los recibos null*/
			ON RE.id_unidad = UN.id_unidad
            AND RE.fecha = (SELECT MAX(fecha) 
							  FROM recibos RE2 
                              WHERE RE2.id_unidad = UN.id_unidad
                              ) /*Trae los últimos recibos de cada unidad*/ 
			AND RE.id_concepto_factura <> 3 /*Omito los recibos anulados*/ 
		LEFT JOIN expedientes EX /*Me quedo con los expedientes null*/
			ON EX.id_unidad = UN.id_unidad 
			AND EX.fecha_expediente = (SELECT MAX(fecha_expediente) 
									   FROM expedientes EX2 
                                       WHERE EX2.id_unidad = UN.id_unidad
                                       AND EX2.habilitado = 1) /*Trae los últimos expedientes que se encuentren activos de cada unidad*/ 
	WHERE RE.fecha < fecha_limite OR RE.fecha IS NULL /*Realizo el filtro por la fecha deseada*/
	GROUP BY UN.id_unidad
    ORDER BY UN.identificador ASC; /*Agrupacion por unidades*/
END$$