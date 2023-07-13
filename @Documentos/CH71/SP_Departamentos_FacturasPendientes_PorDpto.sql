DROP procedure IF EXISTS `SP_Departamentos_FacturasPendientes_PorDpto`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Departamentos_FacturasPendientes_PorDpto` (
	
      iddpto INT
     
)

BEGIN 
 
SELECT f.id_factura
,e.identificador
,d.identificador
,f.fecha_emitido
,cf.nombre
,f.fecha_vencimiento
,f.fecha_limite
,f.importe
FROM facturas AS f
INNER JOIN conceptos_facturas AS cf ON cf.id_concepto_factura = f.id_concepto
INNER JOIN departamentos AS d ON d.id_piso = f.id_departamento
INNER JOIN edificios AS e ON e.id_edificio = d.id_edificio
INNER JOIN tipos_departamentos AS td ON td.id_tipos_departamentos = d.id_tipo_departamento
WHERE d.iddepartamento = iddpto
AND pendiente = 1;

END$$
DELIMITER ; 