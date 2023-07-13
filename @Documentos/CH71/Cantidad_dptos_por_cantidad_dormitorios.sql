USE sigecs;

SELECT COUNT(*) FROM departamentos d 
INNER JOIN tipos_departamentos AS td ON td.id_tipos_departamentos = d.id_tipo_departamento
WHERE d.id_tipo_departamento = 5;
