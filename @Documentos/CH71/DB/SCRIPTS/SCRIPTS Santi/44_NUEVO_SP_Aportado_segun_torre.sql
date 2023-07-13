/*Consulta total aportado segun torre*/

SELECT ED.nombre AS torre_nombre,
ED.id_edificio,
	   SUM(RE.importe) AS importe_total
       FROM unidades UN
       INNER JOIN edificios ED
			ON ED.id_edificio = UN.id_edificio
		LEFT JOIN recibos RE
			ON RE.id_unidad = UN.id_unidad
            AND RE.id_concepto_factura <> 3
		GROUP BY ED.nombre
        ORDER BY importe_total ASC;
        /*Edificios 39 40 y 41 no aportan nada en la base, puede que no existan?*/