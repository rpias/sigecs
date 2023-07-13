
################################################################################
# SP_ListarMenuPadresPorRol
################################################################################

DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_ListarMenuPadresPorRol`;
CREATE PROCEDURE `SP_ListarMenuPadresPorRol` (
	id_rol INT
)
BEGIN 
	SELECT 
     M.id_menu 
    ,M.menu
    ,M.encabezado
    ,M.padre
    ,M.hijo_de
    ,M.orden
    ,M.ruta
    ,M.icono
    FROM menu AS M
	INNER JOIN roles_menu AS RM ON RM.id_menu = M.id_menu
	WHERE RM.id_rol = id_rol
    AND M.habilitado = 1
    AND M.padre = 1
    ORDER BY M.orden;
END$$


################################################################################
# SP_ListarMenuHijosPorRol
################################################################################

DELIMITER $$
USE `sigecs`$$
DROP procedure IF EXISTS `SP_ListarMenuHijosPorRol`;
CREATE PROCEDURE `SP_ListarMenuHijosPorRol` (
	id_rol INT,
    id_menu INT
)
BEGIN 
	SELECT 
     M.id_menu 
    ,M.menu
    ,M.encabezado
    ,M.padre
    ,M.hijo_de
    ,M.orden
    ,M.ruta
    ,M.icono
    FROM menu AS M
	INNER JOIN roles_menu AS RM ON RM.id_menu = M.id_menu
	WHERE RM.id_rol = id_rol
	AND M.hijo_de = id_menu
    AND M.habilitado = 1
	AND M.padre = 0
    ORDER BY M.orden;
END$$