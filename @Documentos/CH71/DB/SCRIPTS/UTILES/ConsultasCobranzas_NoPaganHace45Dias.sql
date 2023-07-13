USE sigecs;
SELECT * FROM (
SELECT 
e.identificador AS Torre, 
u.identificador AS Unidad 
FROM unidades AS u 
INNER JOIN edificios AS e ON e.id_edificio = u.id_edificio
WHERE u.identificador NOT IN (
	SELECT apt_nro 
    FROM _cobranza_tmp 
    WHERE torre_nro = e.identificador
	AND fecha > '20190228'
  )
  
) AS Deudores

LEFT JOIN _cobranza_tmp AS ca ON ca.torre_nro = Torre AND ca.apt_nro = Unidad
#WHERE fecha = (SELECT MAX(fecha) WHERE _cobranza_tmp WHERE Deudores.Torre = torre_nro AND Deudores.Unidad = apt_nro )
 



 










