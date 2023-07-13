/*MUESTRA TODOS LAS UNIDADES QUE NO HAN PAGADO EN UNA FECHA DADA*/

DROP PROCEDURE IF EXISTS `SP_Atrasados_Por_Fecha` DELIMITER $$
CREATE PROCEDURE `SP_Atrasados_Por_Fecha` (IN `fecha_limite` DATE)  BEGIN 
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
    ORDER BY RE.fecha ASC; /*Agrupacion por unidades*/
END$$