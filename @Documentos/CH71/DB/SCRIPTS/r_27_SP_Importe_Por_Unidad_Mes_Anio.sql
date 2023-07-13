
DROP procedure IF EXISTS `SP_Importe_Por_Unidad_Mes_Anio`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Importe_Por_Unidad_Mes_Anio` (
IN
`id_unidad` INT
,`mes` INT
,`anio` INT
)
BEGIN

SELECT valor FROM unidades AS U
INNER JOIN valores_gastos_comunes AS V ON V.id_tipo_unidad = U.id_tipo_unidad
WHERE U.id_unidad = id_unidad
AND (MONTH(V.fecha_ajuste) >= 11 AND YEAR(V.fecha_ajuste) >= 2021);

END$$
DELIMITER ;

/*
SELECT
 V.valor
,V.fecha_ajuste AS fecha
,MONTH(V.fecha_ajuste)  AS mes
,YEAR(V.fecha_ajuste) AS anio
FROM unidades AS U
INNER JOIN valores_gastos_comunes AS V ON V.id_tipo_unidad = U.id_tipo_unidad
WHERE U.id_unidad = 8
AND V.fecha_ajuste <= '20171101'
*/
