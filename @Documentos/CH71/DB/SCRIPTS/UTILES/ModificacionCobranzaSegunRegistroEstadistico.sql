USE sigecs;

SELECT 
mes
,anio
,importe
,creado as fecha_registro
FROM registro_estadistica AS RE
GROUP BY
mes
,anio
,importe
ORDER BY
creado DESC
