USE sigecs;

SELECT 
e.identificador AS Torre, 
u.identificador AS Unidad 
FROM unidades AS u 
INNER JOIN edificios AS e ON e.id_edificio = u.id_edificio
WHERE u.identificador NOT IN (SELECT apt_nro FROM _cobranza_tmp WHERE torre_nro = e.identificador)
#AND e.identificador = 6 












