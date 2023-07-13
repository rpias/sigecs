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