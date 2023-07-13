SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE TABLE recibos;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO recibos(
nro_recibo
,id_factura
,id_forma_pago
,serie_recibo
,importe
,obs
,id_usuario
,id_concepto_factura
,id_unidad
,mes
,anio
,fecha
,titular
)
SELECT 
C.nro_recibo AS nro_recibo
,0 AS id_factura
,1 AS id_forma_pago
,'A' AS serie_recibo
,C.monto AS importe
,CONCAT(C.obs, ' - (', C.rubrica, ')') AS obs
,1 AS id_usuario
,(SELECT id_concepto_factura FROM conceptos_facturas WHERE nombre = UPPER(C.concepto)) AS id_concepto_factura
,(SELECT id_unidad FROM unidades WHERE id_edificio = C.torre_nro AND identificador = C.apt_nro LIMIT 1) AS id_unidad
,C.mes_cuota AS mes
,C.anio AS anio
,C.fecha AS fecha
,C.titular AS titular
FROM _cobranza_tmp AS C
;


