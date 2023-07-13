################################################################################
# SP_ListarRegistros
################################################################################
DROP procedure IF EXISTS `SP_ListarRegistros`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_ListarRegistros` (
	
      tipo varchar(200),
      fecha_ini varchar(25),
      fecha_fin varchar(25)
     
)
BEGIN 

 IF tipo = '0' THEN

	SELECT
    id_registro_sucesos
    ,U.name AS usuario
    ,SP
    ,parametros
    ,IP
    ,creado
    FROM registro_sucesos AS RS
    INNER JOIN users AS U ON U.id = RS.id_usuario
    WHERE creado BETWEEN fecha_ini AND fecha_fin;
       
 ELSE
	SELECT
    id_registro_sucesos
    ,U.name AS usuario
    ,SP
    ,parametros
    ,IP
    ,creado
    FROM registro_sucesos AS RS
    INNER JOIN users AS U ON U.id = RS.id_usuario
    WHERE SP = TRIM(tipo)
    AND creado BETWEEN fecha_ini AND fecha_fin;
 END IF;
  
END$$
DELIMITER ; 

################################################################################
# SP_ListarRegistros_HistoriaRecibo
################################################################################
DROP procedure IF EXISTS `SP_ListarRegistros_HistoriaRecibo`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_ListarRegistros_HistoriaRecibo` (
	  nro_recibo int
)
BEGIN 
	SELECT
    id_registro_sucesos
    ,U.name AS usuario
    ,SP
    ,parametros
    ,IP
    ,creado
    FROM registro_sucesos AS RS
    INNER JOIN users AS U ON U.id = RS.id_usuario
    WHERE parametros LIKE CONCAT('%"nro_recibo":"', nro_recibo, '"%');
END$$
DELIMITER ; 
