DROP PROCEDURE IF EXISTS `SP_Importe_Por_Unidad_Fecha`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Importe_Por_Unidad_Fecha`(
	id_unidad INT
    ,fecha VARCHAR(10)
)
BEGIN
	SELECT V.valor AS valor
	FROM unidades AS U
	INNER JOIN valores_gastos_comunes AS V ON V.id_tipo_unidad = U.id_tipo_unidad
	WHERE U.id_unidad = id_unidad
	AND V.fecha_ajuste <= fecha 
	ORDER BY V.fecha_ajuste DESC
	LIMIT 1;
END$$
DELIMITER ; 


