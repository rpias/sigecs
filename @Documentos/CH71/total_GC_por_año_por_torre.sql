USE sigecs;

SELECT 
e.id_edificio,
e.identificador,
e.nombre,
sum(vgc.valor) as total
FROM departamentos AS d
INNER JOIN facturas AS f ON f.id_departamento = d.iddepartamento
INNER JOIN pisos AS p ON p.id_piso = d.id_piso
INNER JOIN edificios AS e ON e.id_edificio = p.id_edificio
INNER JOIN tipos_departamentos AS td ON td.id_tipos_departamentos = d.id_tipo_departamento
INNER JOIN valores_gastos_comunes AS vgc ON vgc.id_tipo_departamento = d.id_tipo_departamento

WHERE f.fecha_emitido BETWEEN '20180101' AND '20181231'

GROUP BY e.id_edificio, e.identificador, e.nombre

ORDER BY total DESC

##AND d.identificador = 703  WHERE e.identificador = 5