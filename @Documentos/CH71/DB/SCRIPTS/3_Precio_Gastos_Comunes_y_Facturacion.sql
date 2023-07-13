 USE sigecs;

 /* FACTURAS POR UNIDAD */
TRUNCATE TABLE facturas;

DROP procedure IF EXISTS `AgregarFacturaUnidad`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `AgregarFacturaUnidad` (
	
    f_emitido DATE,
    f_venc DATE,
    f_limite INT,
    id_conc INT,
    imp DECIMAL,
    id_dpto INT,
    atr TINYINT,
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
    pendiente,
    obs,
    id_usuario
    
) VALUES (
	f_emitido,
	f_venc,
	f_limite,
	id_conc,
    imp,
    id_dpto,
    atr,
    ob,
    1
);

END$$
DELIMITER ; 

 /* FACTURACION */
DROP procedure IF EXISTS `FacturarUnidad`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `FacturarUnidad` ()
BEGIN
DECLARE tipo_dpto INT;
DECLARE i INT;
DECLARE dia INT;
DECLARE mes INT;
DECLARE anio INT;
DECLARE cantidad_dptos INT;
DECLARE imp DECIMAL;
DECLARE pendiente BIT;

/* ========================================================================================= */
/* FACTURAS PERIODO 01/01/2014 AL 31/12/2016 */
/* ========================================================================================= */

SET imp = 0;
SET dia = 1;
SELECT COUNT(*) INTO cantidad_dptos FROM unidades ORDER BY id_unidad;
SET i = 1;
SET pendiente = 0;

WHILE i <= cantidad_dptos DO
	
    SELECT id_tipo_unidad INTO tipo_dpto FROM unidades WHERE id_unidad = i;
    SELECT valor INTO imp FROM valores_gastos_comunes 
    WHERE id_tipo_unidad =  tipo_dpto
    AND fecha_ajuste = '20190501';
    
    SELECT concat('TIPO UNIDAD: ',tipo_dpto,' - IMPORTE: ',imp);
    
    CALL AgregarFacturaUnidad('20140801','20140831', '20141031',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20140901','20140930', '20141130',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20141001','20141031', '20141231',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20141101','20141130', '20150131',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20141201','20141231', '20150228',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
       
    CALL AgregarFacturaUnidad('20150101','20150130', '20150331',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20150201','20150228', '20150430',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20150301','20150331', '20150531',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20150401','20150430', '20150630',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
  	CALL AgregarFacturaUnidad('20150501','20150531', '20150731',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20150601','20150630', '20150831',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20150701','20150731', '20150930',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20150801','20150831', '20151031',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20150901','20150930', '20151130',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20151001','20151031', '20151231',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20151101','20151130', '20160131',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20151201','20151231', '20160229',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    
    SET i = i + 1;
END WHILE;

/* ========================================================================================= */
/* ========================================================================================= */


/* ========================================================================================= */
/* FACTURAS PERIODO 01/01/2016 AL 31/12/2016 */
/* ========================================================================================= */

SET imp = 0;
SET dia = 1;
SELECT COUNT(*) INTO cantidad_dptos FROM unidades ORDER BY id_unidad;
SET i = 1;
SET pendiente = 0;

WHILE i<= cantidad_dptos DO
	
    SELECT id_tipo_unidad INTO tipo_dpto FROM unidades WHERE id_unidad = i;
    SELECT valor INTO imp FROM valores_gastos_comunes 
    WHERE id_tipo_unidad =  tipo_dpto
    AND fecha_ajuste = '20160101';
    
    SELECT concat('TIPO UNIDAD: ',tipo_dpto,' - IMPORTE: ',imp);
    
    /* 2016 */
    CALL AgregarFacturaUnidad('20160101','20160130', '20160331',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20160201','20160229', '20160430',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20160301','20160331', '20160531',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20160401','20160430', '20160630',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
  	CALL AgregarFacturaUnidad('20160501','20160531', '20160731',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20160601','20160630', '20160831',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20160701','20160731', '20160930',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20160801','20160831', '20161031',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20160901','20160930', '20161130',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20161001','20161031', '20161231',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20161101','20161130', '20170131',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20161201','20161231', '20170228',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    
    
    SET i = i + 1;
END WHILE;

/* ========================================================================================= */
/* ========================================================================================= */



/* ========================================================================================= */
/* FACTURAS PERIODO 01/01/2017 AL 31/08/2017 */
/* ========================================================================================= */

SET imp = 0;
SET dia = 1;
SELECT COUNT(*) INTO cantidad_dptos FROM unidades ORDER BY id_unidad;
SET i = 1;
SET pendiente = 0;

WHILE i<= cantidad_dptos DO
	
    SELECT id_tipo_unidad INTO tipo_dpto FROM unidades WHERE id_unidad = i;
    SELECT valor INTO imp FROM valores_gastos_comunes 
    WHERE id_tipo_unidad =  tipo_dpto
    AND fecha_ajuste = '20170101';
    
    SELECT concat('TIPO UNIDAD: ',tipo_dpto,' - IMPORTE: ',imp);
    
    /* 2017 */
    CALL AgregarFacturaUnidad('20170101','20170130', '20170331',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20170201','20170228', '20170531',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20170301','20170331', '20170630',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20170401','20170430', '20170731',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
  	CALL AgregarFacturaUnidad('20170501','20170531', '20170831',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20170601','20170630', '20170930',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20170701','20170731', '20171031',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20170801','20170831', '20171130',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    
    SET i = i + 1;
END WHILE;

/* ========================================================================================= */
/* ========================================================================================= */



/* ========================================================================================= */
/* FACTURAS PERIODO 01/09/2017 AL 31/10/2018 */
/* ========================================================================================= */

SET imp = 0;
SET dia = 1;
SELECT COUNT(*) INTO cantidad_dptos FROM unidades ORDER BY id_unidad;
SET i = 1;
SET pendiente = 1;

WHILE i<= cantidad_dptos DO
	
    SELECT id_tipo_unidad INTO tipo_dpto FROM unidades WHERE id_unidad = i;
    SELECT valor INTO imp FROM valores_gastos_comunes 
    WHERE id_tipo_unidad =  tipo_dpto
    AND fecha_ajuste = '20170901';
    
    SELECT concat('TIPO UNIDAD: ',tipo_dpto,' - IMPORTE: ',imp);
    
    /* 2017 */
    CALL AgregarFacturaUnidad('20170901','20170930', '20171231',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20171001','20171031', '20180131',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20171101','20171130', '20180228',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20171201','20171231', '20180331',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    
    /* 2018 */
	CALL AgregarFacturaUnidad('20180101','20180131', '20180430',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20180201','20180228', '20180531',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20180301','20180331', '20180630',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20180401','20180430', '20180731',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20180501','20180531', '20180831',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20180601','20180630', '20180930',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20180701','20180731', '20181031',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20180801','20180831', '20181130',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20180901','20180930', '20181231',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20181001','20181031', '20190131',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
   
    
    SET i = i + 1;
END WHILE;

/* ========================================================================================= */
/* ========================================================================================= */

/* ========================================================================================= */
/* FACTURAS PERIODO 01/11/2018 EN ADELANTE
/* ========================================================================================= */

SET imp = 0;
SET dia = 1;
SELECT COUNT(*) INTO cantidad_dptos FROM unidades ORDER BY id_unidad;
SET i = 1;

WHILE i<= cantidad_dptos DO
	
    SELECT id_tipo_unidad INTO tipo_dpto FROM unidades WHERE id_unidad = i;
	
    SELECT valor INTO imp FROM valores_gastos_comunes 
    WHERE id_tipo_unidad =  tipo_dpto
    AND fecha_ajuste = '20181101';
    
    SELECT concat('TIPO UNIDAD: ',tipo_dpto,' - IMPORTE: ',imp);
    
    /* 2018 */
	CALL AgregarFacturaUnidad('20181101','20181130', '20190131',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20181201','20181231', '20190228',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
   
    
    SET i = i + 1;
END WHILE;

/* ========================================================================================= */
/* ========================================================================================= */
/* ********** 2021 ************************************************************************* */
/* ========================================================================================= */
/* ========================================================================================= */

/* ========================================================================================= */
/* FACTURAS PERIODO Enero - Abril / 2019
/* ========================================================================================= */

SET imp = 0;
SET dia = 1;
SELECT COUNT(*) INTO cantidad_dptos FROM unidades ORDER BY id_unidad;
SET i = 1;

WHILE i<= cantidad_dptos DO
	
    SELECT id_tipo_unidad INTO tipo_dpto FROM unidades WHERE id_unidad = i;
	
    SELECT valor INTO imp FROM valores_gastos_comunes 
    WHERE id_tipo_unidad =  tipo_dpto
    AND fecha_ajuste = '20181101';
    
    SELECT concat('TIPO UNIDAD: ',tipo_dpto,' - IMPORTE: ',imp);
    
    /* 2019 */
	CALL AgregarFacturaUnidad('20190101','20190131', '20190430',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20190201','20190228', '20190530',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
   	CALL AgregarFacturaUnidad('20190301','20190331', '20190630',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
   	CALL AgregarFacturaUnidad('20190401','20190430', '20190731',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
   
    
    SET i = i + 1;
END WHILE;

/* ========================================================================================= */
/* ========================================================================================= */

/* ========================================================================================= */
/* FACTURAS PERIODO Mayo - Diciembre 2019 - Fecha Incremento : 2019-05-01
/* ========================================================================================= */

SET imp = 0;
SET dia = 1;
SELECT COUNT(*) INTO cantidad_dptos FROM unidades ORDER BY id_unidad;
SET i = 1;

WHILE i<= cantidad_dptos DO
	
    SELECT id_tipo_unidad INTO tipo_dpto FROM unidades WHERE id_unidad = i;
	
    SELECT valor INTO imp FROM valores_gastos_comunes 
    WHERE id_tipo_unidad =  tipo_dpto
    AND fecha_ajuste = '20190501';
    
    SELECT concat('TIPO UNIDAD: ',tipo_dpto,' - IMPORTE: ',imp);
    
    /* 2018 */
	CALL AgregarFacturaUnidad('20190501','20190531', '20190731',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20190601','20190630', '20190831',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20190701','20190731', '20190930',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20190801','20190831', '20191031',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20190901','20190930', '20191130',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20191001','20191031', '20191231',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20191101','20191130', '20200131',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20191201','20191231', '20200228',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    
    SET i = i + 1;
END WHILE;

/* ========================================================================================= */
/* ========================================================================================= */


/* ========================================================================================= */
/* FACTURAS PERIODO Enero - Diciembre 2020 - Fecha Incremento : 2019-05-01
/* ========================================================================================= */

SET imp = 0;
SET dia = 1;
SELECT COUNT(*) INTO cantidad_dptos FROM unidades ORDER BY id_unidad;
SET i = 1;

WHILE i<= cantidad_dptos DO
	
    SELECT id_tipo_unidad INTO tipo_dpto FROM unidades WHERE id_unidad = i;
	
    SELECT valor INTO imp FROM valores_gastos_comunes 
    WHERE id_tipo_unidad =  tipo_dpto
    AND fecha_ajuste = '20190501';
    
    SELECT concat('TIPO UNIDAD: ',tipo_dpto,' - IMPORTE: ',imp);
    
    /* 2020 */
    CALL AgregarFacturaUnidad('20200101','20200131', '20200430',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20200201','20200228', '20200530',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
   	CALL AgregarFacturaUnidad('20200301','20200331', '20200630',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
   	CALL AgregarFacturaUnidad('20200401','20200430', '20200731',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
   	CALL AgregarFacturaUnidad('20200501','20200531', '20200731',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20200601','20200630', '20200831',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20200701','20200731', '20200930',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20200801','20200831', '20201031',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20200901','20200930', '20201130',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
	CALL AgregarFacturaUnidad('20201001','20201031', '20201231',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20201101','20201130', '20210131',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    CALL AgregarFacturaUnidad('20201201','20201231', '20210228',1,imp, i,pendiente,'INGRESADO POR EL SISTEMA');
    
    SET i = i + 1;
END WHILE;

/* ========================================================================================= */
/* ========================================================================================= */


END$$
DELIMITER ; 


/* ROLES */
SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE TABLE facturas;
SET FOREIGN_KEY_CHECKS = 1;

CALL FacturarUnidad();
