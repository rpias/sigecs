
################################################################################
# 				CREACION DE TODOS LOS PROCEDURES NECESARIOS
################################################################################

################################################################################
# SP_Unidades_FacturasPendientes_PorUnidad
################################################################################
DROP procedure IF EXISTS `SP_Unidades_FacturasPendientes_PorUnidad`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Unidades_FacturasPendientes_PorUnidad` (
	
      id_unidad INT
     
)

BEGIN 
 
SELECT f.id_factura
,e.identificador
,u.identificador
,f.fecha_emitido
,cf.nombre
,f.fecha_vencimiento
,f.fecha_limite
,f.importe
FROM facturas AS f
INNER JOIN conceptos_facturas AS cf ON cf.id_concepto_factura = f.id_concepto
INNER JOIN unidades AS u ON u.id_unidad = f.id_unidad
INNER JOIN edificios AS e ON e.id_edificio = u.id_edificio
INNER JOIN tipos_unidades AS td ON td.id_tipo_unidad = u.id_tipo_unidad
WHERE u.id_unidad = id_unidad
AND pendiente = 1;

END$$
DELIMITER ; 

################################################################################
# SP_Unidades_PorTorre
################################################################################
DROP procedure IF EXISTS `SP_Unidades_PorTorre`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Unidades_PorTorre` (
	
      idedificio INT
     
)

BEGIN 
 
SELECT 
u.id_unidad,
u.identificador
FROM edificios AS e
INNER JOIN pisos AS p ON p.id_edificio = e.id_edificio
INNER JOIN unidades AS u ON u.id_piso = p.id_piso
INNER JOIN tipos_unidades AS td ON td.id_tipo_unidad = u.id_tipo_unidad
WHERE e.id_edificio = idedificio;

END$$
DELIMITER ; 

################################################################################
# SP_Facturas_ListarFacturasPendienes_PorIdUnidad
################################################################################
DROP procedure IF EXISTS `SP_Facturas_ListarFacturasPendienes_PorIdUnidad`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Facturas_ListarFacturasPendienes_PorIdUnidad` (
	
      id_unidad INT
     
)

BEGIN 
 
SELECT 
f.id_factura AS idfactura
,f.fecha_emitido AS fechafactura
,e.identificador AS torre
,u.identificador AS unidad
,cf.nombre AS concepto
,f.importe AS monto
,f.fecha_vencimiento AS fechavenc
,f.fecha_limite AS fechalimite
 
FROM facturas AS f
INNER JOIN conceptos_facturas AS cf ON cf.id_concepto_factura = f.id_concepto
INNER JOIN unidades AS u ON u.id_unidad = f.id_unidad
INNER JOIN edificios AS e ON e.id_edificio = u.id_edificio
INNER JOIN tipos_unidades AS td ON td.id_tipo_unidad = u.id_tipo_unidad
WHERE u.id_unidad = id_unidad 
AND f.pendiente = 1
ORDER BY f.fecha_emitido;


END$$
DELIMITER ; 


################################################################################
# SP_Facturas_TotalDeuda_PorIdUnidad
################################################################################
DROP procedure IF EXISTS `SP_Facturas_TotalDeuda_PorIdUnidad`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Facturas_TotalDeuda_PorIdUnidad` (
	
      id INT
     
)

BEGIN 
 
SELECT SUM(importe) as total
FROM facturas
WHERE id_unidad = id
AND pendiente = 1;


END$$
DELIMITER ; 

################################################################################
# SP_Facturas_FormasPagoHabilitadas
################################################################################
DROP procedure IF EXISTS `SP_Facturas_FormasPagoHabilitadas`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Facturas_FormasPagoHabilitadas` ( 
 id INT
)

BEGIN 
 
SELECT id_forma_pago,nombre
FROM formas_pago
WHERE habilitada = 1;


END$$
DELIMITER ; 

################################################################################
# SP_Edificios_Por_Condominio
################################################################################
DROP procedure IF EXISTS `SP_Edificios_Por_Condominio`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Edificios_Por_Condominio` ()

BEGIN 
 
SELECT *
FROM edificios
WHERE id_condominio = id;


END$$
DELIMITER ; 


################################################################################
# SP_Pisos_Por_Edificio
################################################################################
DROP procedure IF EXISTS `SP_Pisos_Por_Edificio`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Pisos_Por_Edificio` ()

BEGIN 
 
SELECT *
FROM pisos
WHERE id_edificio = id;


END$$
DELIMITER ; 



################################################################################
# SP_Convenios_Por_Unidad
################################################################################
DROP procedure IF EXISTS `SP_Convenios_Por_Unidad`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Convenios_Por_Unidad` ()
BEGIN 
SELECT *
FROM pisos
WHERE id_unidad = id;
END$$
DELIMITER ;

################################################################################
# SP_Recibos_Por_Unidad
################################################################################
DROP procedure IF EXISTS `SP_Recibos_Por_Unidad`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Recibos_Por_Unidad` (
	id INT
)

BEGIN 
 
SELECT 
R.id_recibo AS id_recibo
,R.id_unidad AS id_unidad
,R.serie_recibo AS serie_recibo
,R.nro_recibo AS nro_recibo
,R.mes AS mes
,R.anio AS anio
,R.fecha AS fecha
,R.importe AS importe
,U.identificador AS unidad
,E.identificador AS id_edificio
,E.nombre AS edificio
,R.id_concepto_factura AS id_concepto
,CF.nombre AS concepto
,R.id_forma_pago AS id_fpago
,FP.nombre AS fpago
,US.id AS id_usuario
,US.name AS usuario
,R.creado AS creado
,R.titular AS titular
,R.obs AS obs
FROM recibos AS R
INNER JOIN unidades AS U ON U.id_unidad = R.id_unidad
INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio
INNER JOIN conceptos_facturas AS CF ON CF.id_concepto_factura = R.id_concepto_factura
INNER JOIN formas_pago AS FP ON FP.id_forma_pago = R.id_forma_pago
INNER JOIN users AS US ON US.id = R.id_usuario
WHERE R.id_unidad = id
AND R.habilitado = 1
AND R.id_concepto_factura <> 3;
END$$
DELIMITER;

################################################################################
# SP_Expedientes_Por_Unidad
################################################################################
DROP procedure IF EXISTS `SP_Expedientes_Por_Unidad`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Expedientes_Por_Unidad` (
	id INT
)
BEGIN 
SELECT 
EX.id_expediente
,DATE_FORMAT(EX.fecha_expediente, "%Y-%m-%d") AS fecha_expediente
,DATE_FORMAT(EX.fecha_ingreso_anv, "%Y-%m-%d") AS fecha_ingreso_anv
,DATE_FORMAT(EX.fecha_deuda, "%Y-%m-%d") AS fecha_deuda
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
DROP procedure IF EXISTS `SP_Expedientes_Activos`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Expedientes_Activos` (
	
)
BEGIN 
SELECT 
EX.id_expediente
,DATE_FORMAT(EX.fecha_expediente, "%Y-%m-%d") AS fecha_expediente
,DATE_FORMAT(EX.fecha_ingreso_anv, "%Y-%m-%d") AS fecha_ingreso_anv
,DATE_FORMAT(EX.fecha_deuda, "%Y-%m-%d") AS fecha_deuda
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
WHERE EX.habilitado = 1;

END$$
DELIMITER;

################################################################################
# SP_Atrasados_Por_Torre
################################################################################
DROP procedure IF EXISTS `SP_Atrasados_Por_Torre`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Atrasados_Por_Torre` (
	id_torre INT,
    fecha_limite date
)
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
                        AND habilitado = 1 AND id_concepto_factura <> 3 LIMIT 1) LIMIT 1) AS anio

	FROM unidades AS u 
	INNER JOIN edificios AS e ON e.id_edificio = u.id_edificio
	WHERE u.id_unidad NOT IN (
		SELECT id_unidad 
		FROM recibos 
		WHERE fecha > fecha_limite
        AND habilitado = 1 AND id_concepto_factura <> 3
	)
AND e.identificador = id_torre
ORDER BY u.identificador;


END$$
DELIMITER;

################################################################################
# SP_Atrasados_Por_Fecha
################################################################################
DROP procedure IF EXISTS `SP_Atrasados_Por_Fecha`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Atrasados_Por_Fecha` (
	fecha_limite date
)

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
                        AND habilitado = 1 AND id_concepto_factura <> 3 LIMIT 1) LIMIT 1) AS anio

	FROM unidades AS u 
	INNER JOIN edificios AS e ON e.id_edificio = u.id_edificio
	WHERE u.id_unidad NOT IN (
		SELECT id_unidad 
		FROM recibos 
		WHERE fecha > fecha_limite
        AND habilitado = 1 AND id_concepto_factura <> 3
	)

ORDER BY u.identificador;


END$$
DELIMITER;

################################################################################
# SP_Cantidad_Atrasados
################################################################################

DROP procedure IF EXISTS `SP_Cantidad_Atrasados`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Cantidad_Atrasados` (
	fecha_limite date
)
BEGIN 
SELECT COUNT(*) AS cantidad
	FROM unidades AS u 
	INNER JOIN edificios AS e ON e.id_edificio = u.id_edificio
	WHERE u.identificador NOT IN (
		SELECT id_unidad 
		FROM recibos 
		WHERE fecha > fecha_limite
        AND habilitado = 1 AND id_concepto_factura <> 3
	);

END$$
DELIMITER;

################################################################################
# SP_Recibos_Por_Fecha
################################################################################

DROP procedure IF EXISTS `SP_Recibos_Por_Fecha`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Recibos_Por_Fecha` (
	fecha_ini date,
    fecha_fin date
)
BEGIN 
		SELECT 
		R.fecha AS fecha
		,R.nro_recibo AS numero
		,E.nombre AS edificio
        ,E.identificador AS edificio_id
		,U.identificador AS unidad
        ,R.importe AS importe
        ,C.nombre AS concepto
        ,R.mes AS mes
		,R.anio AS anio
        ,R.titular AS titular
        ,US.name AS usuario
        ,R.obs AS obs
        ,US.id AS id_usuario
		,R.creado AS creado
        ,FP.nombre AS forma_pago
		
	FROM recibos AS R
	INNER JOIN unidades AS U ON U.id_unidad = R.id_unidad
	INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio
	INNER JOIN conceptos_facturas AS C ON C.id_concepto_factura = R.id_concepto_factura
	INNER JOIN formas_pago AS FP ON FP.id_forma_pago = R.id_forma_pago
    INNER JOIN users AS US ON US.id = R.id_usuario
	WHERE (R.fecha between fecha_ini AND fecha_fin) 
    AND R.id_concepto_factura <> 3 
    AND R.habilitado = 1;

END$$
DELIMITER;

################################################################################
# SP_Recibos_Por_Fecha_Con_Anulados
################################################################################

DROP procedure IF EXISTS `SP_Recibos_Por_Fecha_Con_Anulados`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Recibos_Por_Fecha_Con_Anulados` (
	fecha_ini date,
    fecha_fin date
)
BEGIN 
	SELECT 
		R.fecha AS fecha
		,R.nro_recibo AS numero
		,E.nombre AS edificio
        ,E.identificador AS edificio_id
		,U.identificador AS unidad
        ,R.importe AS importe
        ,C.nombre AS concepto
        ,R.mes AS mes
		,R.anio AS anio
        ,R.titular AS titular
        ,US.name AS usuario
        ,R.obs AS obs
        ,US.id AS id_usuario
		,R.creado AS creado
        ,FP.nombre AS forma_pago
		
	FROM recibos AS R
	INNER JOIN unidades AS U ON U.id_unidad = R.id_unidad
	INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio
	INNER JOIN conceptos_facturas AS C ON C.id_concepto_factura = R.id_concepto_factura
	INNER JOIN formas_pago AS FP ON FP.id_forma_pago = R.id_forma_pago
    INNER JOIN users AS US ON US.id = R.id_usuario
	WHERE (R.fecha between fecha_ini AND fecha_fin
          AND habilitado = 1);

END$$
DELIMITER;

################################################################################
# SP_Importe_Por_Unidad
################################################################################
DROP procedure IF EXISTS `SP_Importe_Por_Unidad`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Importe_Por_Unidad` (
	id_unidad INT
)
BEGIN 
 
SELECT valor FROM unidades AS U
INNER JOIN valores_gastos_comunes AS V ON V.id_tipo_unidad = U.id_tipo_unidad
WHERE U.id_unidad = id_unidad
AND fecha_ajuste = (SELECT MAX(fecha_ajuste) 
						FROM valores_gastos_comunes WHERE id_tipo_unidad = U.id_tipo_unidad);


END$$

################################################################################
# SP_Atrasados_Por_Fecha
################################################################################
DROP procedure IF EXISTS `SP_Atrasados_Por_Fecha`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Atrasados_Por_Fecha`(IN `fecha_limite` DATE)
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
                        AND habilitado = 1 AND id_concepto_factura <> 3 LIMIT 1) LIMIT 1) AS anio,
                        
    (SELECT CONCAT(nro_expediente,  " - ", 
    DATE_FORMAT(fecha_expediente, '%d/%m/%Y'), " - ", 
    FORMAT(importe_total_reclamado,0))  FROM expedientes 
			WHERE id_unidad = u.id_unidad
			AND fecha_expediente = (SELECT MAX(fecha_expediente) FROM expedientes 
								WHERE id_unidad = u.id_unidad LIMIT 1) LIMIT 1) AS ultimo_expediente

	FROM unidades AS u 
	INNER JOIN edificios AS e ON e.id_edificio = u.id_edificio
	WHERE u.id_unidad NOT IN (
		SELECT id_unidad 
		FROM recibos 
		WHERE fecha > fecha_limite
        AND habilitado = 1 AND id_concepto_factura <> 3
	)

ORDER BY u.identificador;


END$$








