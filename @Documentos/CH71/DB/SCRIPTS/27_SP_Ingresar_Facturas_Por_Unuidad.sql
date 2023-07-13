
DROP procedure IF EXISTS `SP_AgregarFactura_Por_Unidad`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `SP_AgregarFactura_Por_Unidad`(
	
    f_emitido DATE,
    f_venc DATE,
    f_limite INT,
    id_conc INT,
    imp DECIMAL,
    id_dpto INT,
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
    obs
    
) VALUES (
	f_emitido,
	f_venc,
	f_limite,
	id_conc,
    imp,
    id_dpto,
    ob
);

END$$
DELIMITER ; 
