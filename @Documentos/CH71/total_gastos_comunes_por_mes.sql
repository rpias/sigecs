USE sigecs;

SELECT SUM(vgc.valor) FROM departamentos AS d
INNER JOIN tipos_departamentos AS td ON td.id_tipos_departamentos = d.id_tipo_departamento
INNER JOIN valores_gastos_comunes AS vgc ON vgc.id_valores_gastos_comunes =  td.id_tipos_departamentos

