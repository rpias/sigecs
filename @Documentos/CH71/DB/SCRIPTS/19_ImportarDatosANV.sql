#TRUNCATE table unidades_titulares;
#DELETE FROM titulares WHERE id_titular > 3;
#DELETE FROM personas WHERE id_persona > 3;
ALTER TABLE personas AUTO_INCREMENT=4;
INSERT INTO personas (primer_apellido, segundo_apellido,  primer_nombre, segundo_nombre, cedula, obs, id_usuario, sexo )
SELECT
      SUBSTRING_INDEX(SUBSTRING_INDEX(NOMBRES_DE_TITULARES, ' ', 1), ' ', -1) AS  primer_apellido,
      
      If(length(NOMBRES_DE_TITULARES) - length(replace(NOMBRES_DE_TITULARES, ' ', ''))>1,  
          SUBSTRING_INDEX(SUBSTRING_INDEX(NOMBRES_DE_TITULARES, ' ', 2), ' ', -1) , ' ') AS  segundo_apellido,
     
     If(length(NOMBRES_DE_TITULARES) - length(replace(NOMBRES_DE_TITULARES, ' ', ''))>1,  
          SUBSTRING_INDEX(SUBSTRING_INDEX(NOMBRES_DE_TITULARES, ' ', 3), ' ', -1) ,' ') AS primer_nombre,
          
      SUBSTRING_INDEX(SUBSTRING_INDEX(NOMBRES_DE_TITULARES, ' ', 4), ' ', -1) AS segundo_nombre,
      
     CONCAT (DOCUMENTO_IDENTIDAD, `DIG._VERI.`) AS cedula, 
     
     CONCAT('CARGADO AUTOMATICAMENTE DESDE PADRON ANV 02-10-2020 ', ' - ',  ESTADO_CONTABLE,' - ', BLOCK,' - ',UNIDAD,' - ',PADRÓN,' - ',IDENTIFICACIÓN_INMUEBLE ) AS obs,
     1, 'M'
          
FROM _propietarios_avn_2020102_h1
WHERE NOMBRES_DE_TITULARES <> 'ANV' 
GROUP BY cedula;

SELECT * FROM personas;





