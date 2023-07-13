DROP procedure IF EXISTS `SP_Numero_Recibo_Por_Serie_Crear_Recibo`;
DELIMITER $$
CREATE PROCEDURE `SP_Numero_Recibo_Por_Serie_Crear_Recibo` (
     `serie` VARCHAR(1)
)

BEGIN
   SELECT (MAX(nro_recibo) + 1) AS numero FROM recibos WHERE serie_recibo = `serie`;
END$$
DELIMITER ; 

