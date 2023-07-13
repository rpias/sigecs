
################################################################################
# SP_ListarVehiculosUnidades
################################################################################

DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_ListarVehiculosUnidades`;
CREATE PROCEDURE `SP_ListarVehiculosUnidades` ()
BEGIN 
	SELECT 
	E.nombre AS edificio,
	U.descripcion AS unidad,
    TV.tipo_vehiculo,
	V.matricula,
    V.marca,
    V.modelo,
    V.anio,
    V.obs
	FROM unidades AS U
	INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio
	LEFT JOIN unidades_vehiculos AS UV ON UV.id_unidad = U.id_unidad  AND UV.activo = 1
	LEFT JOIN vehiculos AS V ON V.id_vehiculo = UV.id_vehiculo AND V.activo = 1
    LEFT JOIN tipos_vehiculos AS TV ON TV.id_tipo_vehiculo = V.id_tipo_vehiculo
	ORDER BY U.id_unidad;
END$$


################################################################################
# SP_ListarTitularesUnidades
################################################################################

DELIMITER $$
/*USE `sigecs`$$*/
DROP procedure IF EXISTS `SP_ListarTitularesUnidades`;
CREATE PROCEDURE `SP_ListarTitularesUnidades` ()
BEGIN 
	
	SELECT 
	E.nombre AS edificio,
	U.descripcion AS unidad,
	P.cedula,
	P.primer_nombre,
	P.segundo_nombre,
	P.primer_apellido,
	P.segundo_apellido
	FROM unidades AS U
	INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio
	LEFT JOIN unidades_titulares AS UT ON UT.id_unidad = U.id_unidad AND UT.activo = 1
	LEFT JOIN titulares AS T ON T.id_titular = UT.id_titular AND T.activo = 1
	LEFT JOIN personas AS P ON P.id_persona = T.id_persona
	ORDER BY U.id_unidad;
     
END$$


################################################################################
# SP_ListarUnidadesEscrituradas
################################################################################

DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_ListarUnidadesEscrituradas`;
CREATE PROCEDURE `SP_ListarUnidadesEscrituradas` ()
BEGIN 
	SET lc_time_names = 'es_UY';
	SELECT 
	E.nombre,
	U.descripcion,
    TMR.tipo_mov_registral,
    MR.fecha,
	P.cedula,
	P.primer_nombre,
	P.segundo_nombre,
	P.primer_apellido,
	P.segundo_apellido
	FROM unidades AS U
	INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio
	LEFT JOIN unidades_mov_registrales AS UMR ON UMR.id_unidad = U.id_unidad AND UMR.activo = 1
	LEFT JOIN movimientos_registrales AS MR 
					ON MR.id_movimiento_registral = UMR.id_movimiento_registral 
                    AND MR.id_tipo_mov_registral = 1 # ESCRITURAS
                    AND MR.activo = 1
    LEFT JOIN tipos_mov_registrales AS TMR ON TMR.id_tipo_mov_registral = MR.id_tipo_mov_registral
    LEFT JOIN personas_mov_registrales AS PMR ON PMR.id_movimiento_registral = MR.id_movimiento_registral
    LEFT JOIN personas AS P ON P.id_persona = PMR.id_persona AND P.activo = 1
    ORDER BY U.id_unidad;
     
END$$








