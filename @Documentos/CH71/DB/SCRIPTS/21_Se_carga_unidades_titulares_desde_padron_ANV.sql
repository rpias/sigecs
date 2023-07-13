

INSERT INTO unidades_titulares (id_titular, id_unidad, pertenece_recibo, pertenece_padron, activo, obs, id_usuario)

SELECT 
     T.id_titular     
     ,t1.id_unidad
     ,1 AS pertenece_recibo
     ,1 AS pertenece_padron
     ,1 AS activo
     ,'INGRESADO AUTOMATICAMENTE POR EL SISTEMA DESDE PADRON ANV 02-10-2020' AS obs
     ,1 AS id_usuario
FROM (SELECT
        E.nombre AS block
        ,U.identificador AS unidad  
        ,U.id_unidad AS id_unidad
        FROM unidades AS U 
        INNER JOIN edificios AS E ON E.id_edificio = U.id_edificio) AS t1
INNER JOIN  _propietarios_avn_2020102_h1 AS ANV ON ANV.BLOCK = t1.block AND ANV.UNIDAD = t1.unidad
INNER JOIN personas AS P ON P.cedula = CONCAT(ANV.DOCUMENTO_IDENTIDAD, ANV.`DIG._VERI.`)
INNER JOIN titulares AS T ON T.id_persona = P.id_persona
WHERE ANV.DOCUMENTO_IDENTIDAD <> 0
