
ALTER TABLE titulares AUTO_INCREMENT=1;
INSERT INTO titulares (id_persona, id_usuario, activo)
SELECT
P.id_persona AS id_persona    
     ,1,1 
FROM (SELECT
        E.nombre AS block
        ,U.identificador AS unidad  
        ,U.id_unidad AS id_unidad
        FROM unidades AS U 
        INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio) AS t1
INNER JOIN  _propietarios_avn_2020102_h1 AS ANV ON ANV.BLOCK = t1.block AND ANV.UNIDAD = t1.unidad
INNER JOIN personas AS P ON P.cedula = CONCAT(ANV.DOCUMENTO_IDENTIDAD, ANV.`DIG._VERI.`)
WHERE ANV.DOCUMENTO_IDENTIDAD <> 0