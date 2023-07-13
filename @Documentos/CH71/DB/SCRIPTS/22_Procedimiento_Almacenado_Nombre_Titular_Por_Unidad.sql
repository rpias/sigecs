
################################################################################
# SP_NombreTitular_Por_Unidad
################################################################################

DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_NombreTitular_Por_Unidad`;
CREATE PROCEDURE `SP_NombreTitular_Por_Unidad` (
	id INT
)
BEGIN 
	
	SELECT 
	CONCAT(P.primer_apellido, ' '
    ,P.segundo_apellido, ' '
	,P.primer_nombre, ' '
	,P.segundo_nombre) AS nombre
	FROM unidades AS U
	INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio
	INNER JOIN unidades_titulares AS UT ON UT.id_unidad = U.id_unidad
	INNER JOIN titulares AS T ON T.id_titular = UT.id_titular
	INNER JOIN personas AS P ON P.id_persona = T.id_persona
	WHERE U.id_unidad = id 
    AND pertenece_recibo = 1
	LIMIT 1;
	
    
END$$

