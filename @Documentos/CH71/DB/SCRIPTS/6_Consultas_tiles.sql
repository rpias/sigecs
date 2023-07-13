USE sigecs;

# MES DE OCTUBRE POR TORRE
SELECT torre_letra, FORMAT(SUM(monto),0, 'de_DE') AS monto FROM _cobranza_tmp
WHERE fecha between '20181001' AND '20181031'
group by torre_letra
ORDER BY monto;

# MES DE SETIEMBRE POR TORRE
SELECT torre_letra, FORMAT(SUM(monto),0, 'de_DE') AS monto FROM _cobranza_tmp
WHERE fecha between '20180901' AND '20180931'
group by torre_letra
ORDER BY monto;


# MESES DE SETIEMBRE Y OCTUBRE POR APTO
SELECT 
torre_letra,
apt_nro,
FORMAT(SUM(monto),0, 'de_DE') AS monto
FROM sigecs._cobranza_tmp
WHERE fecha between '20180901' AND '20181031'
group by torre_letra, apt_nro
ORDER BY torre_letra, apt_nro;


# FACTURAS
SELECT f.id_factura AS idfactura
,f.fecha_emitido AS fechafactura
,e.identificador AS torre
,e.nombre
,u.identificador AS unidad
,cf.nombre AS concepto
,f.importe AS monto
,f.fecha_vencimiento AS fechavenc
,f.fecha_limite AS fechalimite
 
FROM facturas AS f
INNER JOIN conceptos_facturas AS cf ON cf.id_concepto_factura = f.id_concepto
INNER JOIN unidades AS u ON u.id_unidad = f.id_unidad
INNER JOIN edificios AS e ON e.id_edificio = u.id_edificio
INNER JOIN tipos_unidades AS td ON td.id_tipo_unidad = u.id_tipo_unidad

ORDER BY e.nombre;

#
SELECT 
f.id_factura AS idfactura
,f.fecha_emitido AS fechafactura
,e.identificador AS torre
,u.identificador AS unidad
,cf.nombre AS concepto
,f.importe AS monto
,f.fecha_vencimiento AS fechavenc
,f.fecha_limite AS fechalimite
,td.id_tipo_unidad 
,td.nombre
FROM facturas AS f
INNER JOIN conceptos_facturas AS cf ON cf.id_concepto_factura = f.id_concepto
INNER JOIN unidades AS u ON u.id_unidad = f.id_unidad
INNER JOIN edificios AS e ON e.id_edificio = u.id_edificio
INNER JOIN tipos_unidades AS td ON td.id_tipo_unidad = u.id_tipo_unidad
WHERE u.id_unidad = 1 
AND f.pendiente = 1
ORDER BY monto;


SELECT * FROM unidades WHERE id;


SELECT * FROM edificios WHERE id_tipo_edificio = 4;






#SELECT * FROM _cobranza_tmp;

#SELECT * FROM facturas;