USE sigecs;

	SELECT 
    R.fecha,
	E.identificador AS Torre, 
	U.identificador AS Unidad 
	FROM unidades AS U 
	INNER JOIN recibos AS R ON R.id_unidad = U.id_unidad
	INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio
    WHERE R.fecha < '20190101' 
	










