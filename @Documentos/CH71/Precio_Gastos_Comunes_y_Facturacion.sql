
USE sigecs;

 /* FACTURAS POR DEPARTAMENTO */

DROP procedure IF EXISTS `SP_AgregarFacturaDepartamento`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_AgregarFacturaDepartamento` (
	
    f_emitido DATE,
    f_venc DATE,
    f_limite INT,
    id_conc INT,
    imp DECIMAL,
    id_dpto INT,
    atr TINYINT,
    ob LONGTEXT
     
)

BEGIN  
INSERT INTO facturas (
	fecha_emitido,
	fecha_vencimiento,
	fecha_limite,
	id_concepto,
    importe,
    id_unidad,
    atrasada,
    obs
    
) VALUES (
	f_emitido,
	f_venc,
	f_limite,
	id_conc,
    imp,
    id_dpto,
    atr,
    ob
);

END$$
DELIMITER ; 

 /* FACTURACION */
DROP procedure IF EXISTS `SP_Facturar_Departamentos`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Facturar_Departamentos` (
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

DECLARE i INT;
DECLARE dia INT;
DECLARE mes INT;
DECLARE anio INT;
DECLARE cantidad_dptos INT;
DECLARE imp DECIMAL;

SET imp = 0;
SET dia = 1;
SELECT COUNT(*) INTO cantidad_dptos FROM unidades ORDER BY id_unidad;
SET i = 1;
SET anio = 2021;
SET mes = 1;

WHILE i<= cantidad_dptos DO
	
    SELECT id_tipo_unidad INTO var_id_tipo_unidad FROM unidades WHERE id_unidad = i;
    SELECT id_unidad INTO var_id_unidad FROM unidades WHERE id_unidad = i;
    SELECT identificador INTO var_identificador_unidad FROM unidades WHERE id_unidad = i;
    SELECT E.nombre INTO var_torre_unidad 
    FROM unidades AS U 
    INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio 
    WHERE id_unidad = i;
    
    -- Obtengo el valor por el tipo de Unidad
    SELECT valor INTO imp FROM valores_gastos_comunes 
	WHERE id_tipo_unidad =  var_id_tipo_unidad
	AND fecha_ajuste = (SELECT MAX(fecha_ajuste) FROM valores_gastos_comunes 
							WHERE id_tipo_unidad =  var_id_tipo_unidad ); # Fecha del mes del GC a Facturar
       
    
    SELECT concat('UNIDAD: ', var_id_unidad,'TIPO DPTO: ',var_id_tipo_unidad,' - IMPORTE: ',imp);
        
    CALL AgregarFacturaDepartamento('20170901','20170930', '20171231',1,imp, i,1,'INGRESADO POR EL SISTEMA');
	
    SET i = i + 1;
END WHILE;


END$$
DELIMITER ; 

