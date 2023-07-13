USE sigecs;
################################################################################
# SP_Expedientes_Por_Unidad
################################################################################
DROP procedure IF EXISTS `SP_Expedientes_Por_Unidad`;
DROP procedure IF EXISTS `SP_Expedientes_Activos`;

DELIMITER $$

CREATE PROCEDURE `SP_Expedientes_Por_Unidad` (
	id INT
)
BEGIN 
SELECT 
EX.id_expediente
,DATE_FORMAT(EX.fecha_expediente, "%Y-%m-%d") AS fecha_expediente
,DATE_FORMAT(EX.fecha_ingreso_anv, "%Y-%m-%d") AS fecha_ingreso_anv
,DATE_FORMAT(EX.fecha_deuda, "%Y-%m-%d") AS fecha_deuda
,DATE_FORMAT(EX.fecha_cierre, "%Y-%m-%d") AS fecha_cierre
,EX.id_estado AS id_estado
,CASE WHEN EX.id_estado = 1 THEN "ACTIVO"  ELSE "CLAUSURADO" END AS estado
,EX.nro_convenio_resolucion AS nro_convenio_resolucion
,EX.importe_total_reclamado
,EX.nro_expediente
,EX.obs
,U.identificador AS unidad
,U.id_unidad AS id_unidad
,E.identificador AS id_edificio
,E.nombre AS edificio
,US.id AS id_usuario
,US.name AS usuario
FROM expedientes AS EX
INNER JOIN unidades AS U ON U.id_unidad = EX.id_unidad
INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio
INNER JOIN users AS US ON US.id = EX.id_usuario
WHERE EX.id_unidad = id
AND EX.habilitado = 1;

END$$
DELIMITER;

################################################################################
# SP_Expedientes_Activos
################################################################################

DELIMITER $$
CREATE PROCEDURE `SP_Expedientes_Activos` (
	
)
BEGIN 
SELECT 
EX.id_expediente
,DATE_FORMAT(EX.fecha_expediente, "%Y-%m-%d") AS fecha_expediente
,DATE_FORMAT(EX.fecha_ingreso_anv, "%Y-%m-%d") AS fecha_ingreso_anv
,DATE_FORMAT(EX.fecha_deuda, "%Y-%m-%d") AS fecha_deuda
,DATE_FORMAT(EX.fecha_cierre, "%Y-%m-%d") AS fecha_cierre
,EX.id_estado AS id_estado
,EX.nro_convenio_resolucion AS nro_convenio_resolucion
,EX.importe_total_reclamado
,EX.nro_expediente
,EX.id_estado
,(CASE
    WHEN EX.id_estado = 1 THEN "ACTIVO"
    ELSE "CLAUSURADO"
END) AS estado
,EX.obs
,U.identificador AS unidad
,U.id_unidad AS id_unidad
,E.identificador AS id_edificio
,E.nombre AS edificio
,US.id AS id_usuario
,US.name AS usuario
FROM expedientes AS EX
INNER JOIN unidades AS U ON U.id_unidad = EX.id_unidad
INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio
INNER JOIN users AS US ON US.id = EX.id_usuario
WHERE EX.habilitado = 1;

END$$

