################################################################################
# SP_TiposVehiculosActivos
################################################################################
DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_TiposVehiculosActivos`;
CREATE PROCEDURE `SP_TiposVehiculosActivos` ()
BEGIN 
	SELECT * FROM tipos_vehiculos WHERE activo = 1;
END$$

################################################################################
# SP_Vehiculos_Por_Unidad
################################################################################
DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_Vehiculos_Por_Unidad`;
CREATE PROCEDURE `SP_Vehiculos_Por_Unidad` (
	id_unidad INT
)
BEGIN 
	 SELECT 
	 V.id_vehiculo AS id_vehiculo
	,TV.tipo_vehiculo AS tipo_vehiculo
	,V.matricula AS matricula
	,V.marca AS marca
	,V.modelo AS modelo
	,V.anio AS anio
	,V.obs AS obs
	FROM unidades_vehiculos AS UV
	INNER JOIN vehiculos AS V ON V.id_vehiculo = UV.id_vehiculo
	INNER JOIN unidades AS U ON U.id_unidad = UV.id_unidad
	INNER JOIN tipos_vehiculos AS TV ON TV.id_tipo_vehiculo = V.id_tipo_vehiculo
	WHERE UV.id_unidad = id_unidad
	AND V.activo = 1;
END$$

################################################################################
# SP_TiposMovimientosRegistralesActivos
################################################################################
DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_TiposMovimientosRegistralesActivos`;
CREATE PROCEDURE `SP_TiposMovimientosRegistralesActivos` ()
BEGIN 
 SELECT * FROM tipos_mov_registrales  WHERE activo = 1;
END$$

################################################################################
# SP_Movimientos_Registrales_Por_Unidad
################################################################################

DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_Movimientos_Registrales_Por_Unidad`;
CREATE PROCEDURE `SP_Movimientos_Registrales_Por_Unidad` (
	id_unidad INT
)
BEGIN 
	 SELECT 
	 MR.id_movimiento_registral AS id_mov_registral
	 ,TMR.tipo_mov_registral AS tipo_mov_registral
	 ,MR.fecha AS fecha
	 ,MR.obs AS obs
	 FROM unidades_mov_registrales AS UMR
	 INNER JOIN movimientos_registrales AS MR ON MR.id_movimiento_registral =  UMR.id_movimiento_registral
	 INNER JOIN unidades AS U ON U.id_unidad = UMR.id_unidad
	 INNER JOIN tipos_mov_registrales AS TMR ON TMR.id_tipo_mov_registral = MR.id_tipo_mov_registral
	 WHERE UMR.id_unidad = id_unidad
	 AND UMR.activo = 1 AND MR.activo = 1;
    
END$$

################################################################################
# SP_Titulares_Por_Unidad
################################################################################

DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_Titulares_Por_Unidad`;
CREATE PROCEDURE `SP_Titulares_Por_Unidad` (
	id_unidad INT
)
BEGIN 
	 SELECT 
     UT.id_unidad_titular AS id,
     UT.id_titular AS id_titular,
     U.descripcion AS unidad,
	 P.cedula AS cedula,
     CONCAT(P.primer_nombre,' ',P.segundo_nombre,' ',P.primer_apellido,' ',P.segundo_apellido) AS nombre_completo,
	 P.sexo AS sexo,
     P.fecha_nac AS fecha_nac,
     (CASE WHEN UT.pertenece_recibo = true THEN 'SI' ELSE 'NO' END) AS pertenece_recibo,
     (CASE WHEN UT.pertenece_padron = true THEN 'SI' ELSE 'NO' END) AS pertence_padron
   	 FROM unidades_titulares AS UT
	 INNER JOIN titulares AS T ON T.id_titular = UT.id_titular
     INNER JOIN personas AS P ON P.id_persona = T.id_persona
	 INNER JOIN unidades AS U ON U.id_unidad = UT.id_unidad
	 WHERE UT.id_unidad = id_unidad
	 AND UT.activo = 1;
    END$$


################################################################################
# SP_Personas_Activas
################################################################################

DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_Personas_Activas`;
CREATE PROCEDURE `SP_Personas_Activas` ()
BEGIN 
	 SELECT * FROM personas WHERE activo = 1;
END$$


################################################################################
# SP_Datos_Estadistica_Cobranza
################################################################################

DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_Datos_Estadistica_Cobranza`;
CREATE PROCEDURE `SP_Datos_Estadistica_Cobranza` ()
BEGIN 
	 SET lc_time_names = 'es_UY';
	SELECT  FORMAT(SUM(R.importe),4) AS Total,
	CONCAT(MONTHNAME(R.fecha), " (", YEAR(R.fecha), ")") AS Mes,
	MONTH(R.fecha) AS MesNum,
	YEAR(R.fecha) AS Año
	FROM recibos AS R 
	WHERE R.habilitado = 1
	GROUP BY MONTHNAME(R.fecha), MONTH(R.fecha) , YEAR(R.fecha)
	ORDER BY año DESC, MesNum DESC
	LIMIT 12;
     
END$$




