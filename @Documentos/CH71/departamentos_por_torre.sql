USE sigecs;

SELECT 
e.id_edificio,
e.nombre,
e.identificador

FROM edificios AS e
INNER JOIN pisos AS p ON p.id_edificio = e.id_edificio
INNER JOIN departamentos AS d ON d.id_piso = p.id_piso
INNER JOIN tipos_departamentos AS td ON td.id_tipos_departamentos = d.id_tipo_departamento
GROUP BY 
e.id_edificio,
e.nombre,
e.identificador
ORDER BY id_edificio






