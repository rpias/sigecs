################################################################################
# 				CREACION DE TODOS LOS PROCEDURES NECESARIOS
################################################################################

################################################################################
# SP_Departamentos_PorTorre
################################################################################
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
,f.fecha_emitidoSP_DepartamentosPorTorre
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

################################################################################
# SP_Departamentos_PorTorre
################################################################################
DROP procedure IF EXISTS `SP_Departamentos_PorTorre`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Departamentos_PorTorre` (
	
      idedificio INT
     
)

BEGIN 
 
SELECT 
d.iddepartamento,
d.identificador
FROM edificios AS e
INNER JOIN pisos AS p ON p.id_edificio = e.id_edificio
INNER JOIN departamentos AS d ON d.id_piso = p.id_piso
INNER JOIN tipos_departamentos AS td ON td.id_tipos_departamentos = d.id_tipo_departamento
WHERE e.id_edificio = idedificio;


END$$
DELIMITER ; 

################################################################################
# SP_Facturas_ListarFacturasPendienes_PorIdDepartamento
################################################################################
DROP procedure IF EXISTS `SP_Facturas_ListarFacturasPendienes_PorIdDepartamento`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Facturas_ListarFacturasPendienes_PorIdDepartamento` (
	
      iddpto INT
     
)

BEGIN 
 
SELECT 
f.id_factura AS idfactura
,f.fecha_emitido AS fechafactura
,e.identificador AS torre
,d.identificador AS dpto
,cf.nombre AS concepto
,f.importe AS monto
,f.fecha_vencimiento AS fechavenc
,f.fecha_limite AS fechalimite
 
FROM facturas AS f
INNER JOIN conceptos_facturas AS cf ON cf.id_concepto_factura = f.id_concepto
INNER JOIN departamentos AS d ON d.id_piso = f.id_departamento
INNER JOIN edificios AS e ON e.id_edificio = d.id_edificio
INNER JOIN tipos_departamentos AS td ON td.id_tipos_departamentos = d.id_tipo_departamento
WHERE d.iddepartamento = iddpto 
AND f.pendiente = 1
ORDER BY f.fecha_emitido;


END$$
DELIMITER ; 


################################################################################
# SP_Facturas_TotalDeuda_PorIdDepartamento
################################################################################
DROP procedure IF EXISTS `SP_Facturas_TotalDeuda_PorIdDepartamento`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Facturas_TotalDeuda_PorIdDepartamento` (
	
      iddpto INT
     
)

BEGIN 
 
SELECT SUM(importe) as total
FROM facturas
WHERE id_departamento = iddpto
AND pendiente = 1;


END$$
DELIMITER ;