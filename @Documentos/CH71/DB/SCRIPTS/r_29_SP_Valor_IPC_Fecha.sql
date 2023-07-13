
DROP PROCEDURE IF EXISTS `SP_Valor_IPC_Fecha`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_Valor_IPC_Fecha`(
	mes INT
    ,anio INT
)
BEGIN
	IF mes = 0 AND anio = 0 THEN
		SELECT H.indice AS valor
		FROM historico_ipc AS H
		WHERE id = (SELECT MAX(id) FROM historico_ipc) ;
    ELSE
		SELECT H.indice AS valor
		FROM historico_ipc AS H
		WHERE H.mes = mes
		AND H.anio = anio;
    END IF;

END$$
DELIMITER ; 


