
/* PISOS */
USE sigecs;
DROP procedure IF EXISTS `CARGAR_PISOS`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `CARGAR_PISOS` ()
BEGIN
	    
    DECLARE cantidad_edificios INT;
    DECLARE i INT;
    DECLARE x INT;
    DECLARE y INT;
    DECLARE cant_pisos INT;
    DECLARE cantidad_deptos INT;
    DECLARE id_dpto INT;
    DECLARE E26D INT;
    DECLARE E28D INT;
    DECLARE E42D INT;
    DECLARE E43D INT;
    DECLARE PB INT;
    DECLARE DEN_PISO VARCHAR(100);
    DECLARE ULTIMO_ID_INGERSADO INT;
    
    DECLARE APTO1D INT;
    DECLARE APTO2D INT;
    DECLARE APTO2DSA INT;
    DECLARE APTO3D INT;
    DECLARE APTO4D INT;
    
    DECLARE PISOS2D INT;
    DECLARE PISOS3D INT;
	DECLARE PISOS4D INT;
    DECLARE PISOS8D INT;  
      
	SET PISOS2D = 2;
	SET PISOS3D = 3;
    SET PISOS4D = 4;
    SET PISOS8D = 8;
    
    SET APTO1D = 5;
    SET APTO2D = 6;
    SET APTO2DSA = 2;
    SET APTO3D = 7;
    SET APTO4D = 8;
    
    SET E26D = 26;
    SET E28D = 28;
    SET E42D = 42;
    SET E43D = 43;
    SET PB = 1;
    
    
    SET FOREIGN_KEY_CHECKS = 0; 
	TRUNCATE TABLE pisos;
    TRUNCATE TABLE unidades;
	SET FOREIGN_KEY_CHECKS = 1;
        
    SELECT COUNT(*) INTO cantidad_edificios FROM edificios WHERE id_tipo_edificio IN (1,2) ORDER BY id_edificio;
    SET i = 1;
	
    WHILE i <= cantidad_edificios DO
    			                
          SELECT cantidad_unidades, cantidad_pisos-1 INTO cantidad_deptos,  cant_pisos FROM edificios WHERE id_edificio = i;
	                 
			
			IF cantidad_deptos = E26D THEN
            
				SELECT 'TORRE DE 26 DEPARTAMENTOS';
                SET x = 1;
                WHILE x <= cant_pisos + 1 DO
                
					IF x = PB THEN
							
						SELECT 'PLANTA BAJA' INTO DEN_PISO; 
						CALL AgregarPiso(i,DEN_PISO,PISOS2D,'19000101',1, ULTIMO_ID_INGERSADO);
                   
						SET y = 1;
						WHILE y <= PISOS2D DO /* INGRESO LOS DEPARTAMENTOS DE PB */
						
							CALL AgregarUnidad(APTO2DSA,y,i,ULTIMO_ID_INGERSADO);
                        	SET y = y + 1;
							
						END WHILE;
						                   
					ELSE
						
						SELECT CONCAT('PISO ', (x-1)) INTO DEN_PISO; 
						                        
                        CALL AgregarPiso(i,DEN_PISO,PISOS8D,'19000101',1, ULTIMO_ID_INGERSADO);
						 	
						SET y = 1;
						WHILE y <= PISOS8D DO 
							SELECT CONCAT((x-1),'0',y) INTO id_dpto; 
                             
                            IF y = 1 THEN
								CALL AgregarUnidad(APTO2DSA,id_dpto,i,ULTIMO_ID_INGERSADO);
                            ELSEIF y = 2 THEN
								CALL AgregarUnidad(APTO2DSA,id_dpto,i,ULTIMO_ID_INGERSADO);
							ELSEIF y = 3 THEN
								CALL AgregarUnidad(APTO1D,id_dpto,i,ULTIMO_ID_INGERSADO);
                            ELSEIF y = 4 THEN
								CALL AgregarUnidad(APTO1D,id_dpto,i,ULTIMO_ID_INGERSADO);
							ELSEIF y = 5 THEN
								CALL AgregarUnidad(APTO1D,id_dpto,i,ULTIMO_ID_INGERSADO);
							ELSEIF y = 6 THEN
								CALL AgregarUnidad(APTO1D,id_dpto,i,ULTIMO_ID_INGERSADO);
							ELSEIF y = 7 THEN
								CALL AgregarUnidad(APTO2DSA,id_dpto,i,ULTIMO_ID_INGERSADO);
							ELSEIF y = 8 THEN
								CALL AgregarUnidad(APTO2DSA,id_dpto,i,ULTIMO_ID_INGERSADO);
                            END IF;
                             
							SET y = y + 1;
							
						END WHILE;
                        
					END IF;
				
					SET x = x + 1;
                
				END WHILE; /* TERMINO DE RECORRER LOS PISOS */
             
            ELSEIF cantidad_deptos = E28D THEN
            
				SELECT 'TORRE DE 28 DEPARTAMENTOS';
                SET x = 1;
                WHILE x <= cant_pisos + 1 DO
                    
					IF x = PB THEN
							
						SELECT 'PLANTA BAJA' INTO DEN_PISO; 
						CALL AgregarPiso(i,DEN_PISO,PISOS4D,'19000101',1, ULTIMO_ID_INGERSADO);
                   
						SET y = 1;
						WHILE y <= PISOS4D DO /* INGRESO LOS DEPARTAMENTOS DE PB */
								
                            CALL AgregarUnidad(APTO2DSA,y,i,ULTIMO_ID_INGERSADO);
							SET y = y + 1;
							
						END WHILE;
						                   
					ELSE
						
                        SELECT CONCAT('PISO ', (x-1)) INTO DEN_PISO; 
					    CALL AgregarPiso(i,DEN_PISO,PISOS8D,'19000101',1, ULTIMO_ID_INGERSADO);
						 	
						SET y = 1;
						WHILE y <= PISOS8D DO 
							                           
                            SELECT CONCAT((x-1),'0',y) INTO id_dpto; 
							
                            IF y = 1 THEN
								CALL AgregarUnidad(APTO2DSA,id_dpto,i,ULTIMO_ID_INGERSADO);
                            ELSEIF y = 2 THEN
								CALL AgregarUnidad(APTO2DSA,id_dpto,i,ULTIMO_ID_INGERSADO);
							ELSEIF y = 3 THEN
								CALL AgregarUnidad(APTO1D,id_dpto,i,ULTIMO_ID_INGERSADO);
							ELSEIF y = 4 THEN
								CALL AgregarUnidad(APTO1D,id_dpto,i,ULTIMO_ID_INGERSADO);
							ELSEIF y = 5 THEN
								CALL AgregarUnidad(APTO1D,id_dpto,i,ULTIMO_ID_INGERSADO);
							ELSEIF y = 6 THEN
								CALL AgregarUnidad(APTO1D,id_dpto,i,ULTIMO_ID_INGERSADO);
							ELSEIF y = 7 THEN
								CALL AgregarUnidad(APTO2DSA,id_dpto,i,ULTIMO_ID_INGERSADO);
							ELSEIF y = 8 THEN
								CALL AgregarUnidad(APTO2DSA,id_dpto,i,ULTIMO_ID_INGERSADO);
                            END IF;
                                      
							SET y = y + 1;
							
						END WHILE;
                        
					END IF;
				
					SET x = x + 1;
                
				END WHILE; /* TERMINO DE RECORRER LOS PISOS */
            
            ELSEIF cantidad_deptos = E42D THEN
				
                SELECT 'TORRE DE 42 DEPARTAMENTOS';
				SET x = 1;
				WHILE x <= cant_pisos DO
                    
					IF x = PB THEN
				
						SELECT 'PLANTA BAJA' INTO DEN_PISO; 
						CALL AgregarPiso(i,DEN_PISO,PISOS2D,'19000101',1, ULTIMO_ID_INGERSADO);
                   
                        IF i = 8 OR i = 26 OR i = 32 OR i = 36 THEN
							SET y = 1;
							WHILE y <= PISOS2D DO /* INGRESO LOS DEPARTAMENTOS DE PB */
								CALL AgregarUnidad(APTO4D,y,i,ULTIMO_ID_INGERSADO);
								SET y = y + 1;
							END WHILE;
                            
                        ELSE
							SET y = 1;
							WHILE y <= PISOS2D DO /* INGRESO LOS DEPARTAMENTOS DE PB */
							   IF y = 1 THEN
									CALL AgregarUnidad(APTO3D,y,i,ULTIMO_ID_INGERSADO);
							    ELSE
									CALL AgregarUnidad(APTO2D,y,i,ULTIMO_ID_INGERSADO);
                                END IF;
											
								SET y = y + 1;
							END WHILE;
                        
                        END IF;
                      					                   
					ELSE
						
						SELECT CONCAT('PISO ', (x-1)) INTO DEN_PISO; 
						
                        CALL AgregarPiso(i,DEN_PISO,PISOS4D,'19000101',1, ULTIMO_ID_INGERSADO);
						 	
						SET y = 1;
						WHILE y <= PISOS4D DO 
							
                            SELECT CONCAT((x-1),'0',y) INTO id_dpto; 
                            
                            IF i = 8 OR i = 26 OR i = 32 OR i = 36 THEN
								CALL AgregarUnidad(APTO4D,id_dpto,i,ULTIMO_ID_INGERSADO);
                            ELSE
                             	 IF y = 1  THEN
									CALL AgregarUnidad(APTO2D,id_dpto,i,ULTIMO_ID_INGERSADO);
								ELSEIF y = 2 THEN
									CALL AgregarUnidad(APTO3D,id_dpto,i,ULTIMO_ID_INGERSADO);
								ELSEIF y = 3 THEN
									CALL AgregarUnidad(APTO3D,id_dpto,i,ULTIMO_ID_INGERSADO);
								ELSEIF y = 4 THEN
									CALL AgregarUnidad(APTO2D,id_dpto,i,ULTIMO_ID_INGERSADO);
								END IF;
                            
                            END IF;
                                     
							SET y = y + 1;
							
						END WHILE;
                        
					END IF;
				
					SET x = x + 1;
                
				END WHILE; /* TERMINO DE RECORRER LOS PISOS */
            
			ELSEIF cantidad_deptos = E43D THEN
            
				SELECT 'TORRE DE 43 DEPARTAMENTOS';
				SET x = 1;
				WHILE x <= cant_pisos DO
                                          
					IF x = PB THEN
							
						SELECT 'PLANTA BAJA' INTO DEN_PISO; 
						CALL AgregarPiso(i,DEN_PISO, PISOS3D, '19000101',1, ULTIMO_ID_INGERSADO);
                        
                        IF i = 37 THEN
							SET y = 1;
							WHILE y <= PISOS3D DO /* INGRESO LOS DEPARTAMENTOS DE PB */
						
								CALL AgregarUnidad(APTO4D,y,i,ULTIMO_ID_INGERSADO);
																				
								SET y = y + 1;
								
							END WHILE;
                   
                        ELSE
							SET y = 1;
							WHILE y <= PISOS3D DO /* INGRESO LOS DEPARTAMENTOS DE PB */
						
								IF y = 1  THEN
									CALL AgregarUnidad(APTO3D,y,i,ULTIMO_ID_INGERSADO);
								ELSEIF y = 2 THEN
									CALL AgregarUnidad(APTO3D,y,i,ULTIMO_ID_INGERSADO);
								ELSEIF y = 3 THEN
									CALL AgregarUnidad(APTO2D,y,i,ULTIMO_ID_INGERSADO);
						
								END IF;
													
								SET y = y + 1;
								
							END WHILE;
                        END IF;
                       					                   
					ELSE
						
						SELECT CONCAT('PISO ', (x-1)) INTO DEN_PISO; 
						
                        CALL AgregarPiso(i,DEN_PISO,PISOS4D,'19000101',1, ULTIMO_ID_INGERSADO);
                        
                         IF i = 37 THEN
							SET y = 1;
                            WHILE y <= PISOS4D DO 
								
                                SELECT CONCAT((x-1),'0',y) INTO id_dpto; 
								CALL AgregarUnidad(APTO4D,id_dpto,i,ULTIMO_ID_INGERSADO);
                            
								SET y = y + 1;
								
							END WHILE;
                            
                         ELSE 
							SET y = 1;
                         	WHILE y <= PISOS4D DO 
							
								SELECT CONCAT((x-1),'0',y) INTO id_dpto; 
								
								IF y = 1  THEN
									CALL AgregarUnidad(APTO2D,id_dpto,i,ULTIMO_ID_INGERSADO);
								ELSEIF y = 2 THEN
									CALL AgregarUnidad(APTO3D,id_dpto,i,ULTIMO_ID_INGERSADO);
								ELSEIF y = 3 THEN
									CALL AgregarUnidad(APTO3D,id_dpto,i,ULTIMO_ID_INGERSADO);
								ELSE
									CALL AgregarUnidad(APTO2D,id_dpto,i,ULTIMO_ID_INGERSADO);
								END IF;
								
								SET y = y + 1;
								
							END WHILE;
                         
                         END IF;
						 
					END IF;
				
					SET x = x + 1;
                
				END WHILE; /* TERMINO DE RECORRER LOS PISOS */
            	
            END IF; /* TERMINO DE DEFINIR LOS TIPOS DE EDIFICIOS POR CANTIDAD DE DEPARTAMENTOS */
            
		SET i = i + 1;
    
    END WHILE;
    SELECT 'FIN PROCEDIMIENTO';    
END$$
DELIMITER ;
    
    
 /* PISOS */
DROP procedure IF EXISTS `AgregarPiso`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `AgregarPiso` (
	
    id_ed INT,
    den VARCHAR(100),
    cant_dptos INT,
    ultima_revision_ext DATE,
    id_usu INT,
    OUT id_ingresado INT 
)
BEGIN  
INSERT INTO pisos (
	id_edificio,
	denominacion, 
	cantidad_unidades,
	ultima_revision_extintores,
	id_usuario) 
VALUES (
	id_ed,
	den,
	cant_dptos, 
	ultima_revision_ext,
	id_usu
);
  
SET id_ingresado =  last_insert_id();
END$$
DELIMITER ; 
    
    
   
 /* DEPARTAMENTOS */

DROP procedure IF EXISTS `AgregarUnidad`;
DELIMITER $$
USE `sigecs`$$
CREATE PROCEDURE `AgregarUnidad` (
	
    id_tipo_d INT,
    iden INT,
    id_ed INT,
    id_p INT
     
)

BEGIN  
INSERT INTO unidades (
	id_tipo_unidad,
	identificador,
	id_edificio,
	id_piso
) VALUES (
	id_tipo_d,
	iden,
	id_ed,
	id_p
);

END$$
DELIMITER ; 
    
    
    
CALL CARGAR_PISOS();





 
