
DROP PROCEDURE IF EXISTS `SP_Max_Rol_Por_Usuario`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Max_Rol_Por_Usuario`(
	id_usuario INT
)
BEGIN
	SELECT 
	MAX(R.nivel) AS nivel
	,R.id_rol AS id_rol
	FROM usuarios_roles AS UR 
	INNER JOIN roles AS R ON R.id_rol = UR.id_rol
	WHERE UR.id_usuario = id_usuario;
END$$
DELIMITER ; 