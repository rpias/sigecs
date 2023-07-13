USE sigecs;

/* TIPOS EDIFICIOS */
SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE TABLE tipos_edificios;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO tipos_edificios (nombre) VALUES ('TORRE ALTA');
INSERT INTO tipos_edificios (nombre) VALUES ('TORRE BAJA');
INSERT INTO tipos_edificios (nombre) VALUES ('COMISION - LOCALES');
INSERT INTO tipos_edificios (nombre) VALUES ('SALA DE COMBAS');

/* AREAS TRABAJO */
SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE TABLE areas_trabajos;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO areas_trabajos (nombre) VALUES ('GERENCIA');
INSERT INTO areas_trabajos (nombre) VALUES ('PERSONAL ADMINISTRATIVOS');
INSERT INTO areas_trabajos (nombre) VALUES ('PERSONAL DE SERVICIO');
INSERT INTO areas_trabajos (nombre) VALUES ('PERSONAL DE MANTENIMIENTO');


/* CARGOS */
SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE TABLE cargos;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO cargos (nombre) VALUES ('PRESIDENTE/A');
INSERT INTO cargos (nombre) VALUES ('SECRETARIO/A');
INSERT INTO cargos (nombre) VALUES ('TESORERO/A');
INSERT INTO cargos (nombre) VALUES ('ENCARGADO PERSONAL DE ADMINISTRATIVOS');
INSERT INTO cargos (nombre) VALUES ('ENCARGADO PERSONAL DE MANTENIMIENTO');
INSERT INTO cargos (nombre) VALUES ('ENCARGADO PERSONAL DE SERVICIO');
INSERT INTO cargos (nombre) VALUES ('ENCARGADO PERSONAL DE SEGURIDAD');



/* TIPOS DEPARTAMENTOS */

/*
DEPARTAMENTOS DE 1 DORMITORIO CON ASCENSOR
DEPARTAMENTOS DE 2 DORMITORIO CON ASCENSOR
DEPARTAMENTOS DE 3 DORMITORIO CON ASCENSOR
DEPARTAMENTOS DE 4 DORMITORIO CON ASCENSOR

DEPARTAMENTOS DE 1 DORMITORIO SIN ASCENSOR
DEPARTAMENTOS DE 2 DORMITORIO SIN ASCENSOR
DEPARTAMENTOS DE 3 DORMITORIO SIN ASCENSOR
DEPARTAMENTOS DE 4 DORMITORIO SIN ASCENSOR
*/

SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE TABLE tipos_departamentos;
SET FOREIGN_KEY_CHECKS = 1;
INSERT INTO tipos_departamentos (nombre, cantidad_dormitorios, cantidad_baños, habilitado) VALUES ('DEPARTAMENTOS DE 1 DORMITORIO CON ASCENSOR',1,1,1);
INSERT INTO tipos_departamentos (nombre, cantidad_dormitorios, cantidad_baños, habilitado) VALUES ('DEPARTAMENTOS DE 2 DORMITORIO CON ASCENSOR',2,1,1);
INSERT INTO tipos_departamentos (nombre, cantidad_dormitorios, cantidad_baños, habilitado) VALUES ('DEPARTAMENTOS DE 3 DORMITORIO CON ASCENSOR',3,1,1);
INSERT INTO tipos_departamentos (nombre, cantidad_dormitorios, cantidad_baños, habilitado) VALUES ('DEPARTAMENTOS DE 4 DORMITORIO CON ASCENSOR',4,1,1);
INSERT INTO tipos_departamentos (nombre, cantidad_dormitorios, cantidad_baños, habilitado) VALUES ('DEPARTAMENTOS DE 1 DORMITORIO SIN ASCENSOR',1,1,1);
INSERT INTO tipos_departamentos (nombre, cantidad_dormitorios, cantidad_baños, habilitado) VALUES ('DEPARTAMENTOS DE 2 DORMITORIO SIN ASCENSOR',2,1,1);
INSERT INTO tipos_departamentos (nombre, cantidad_dormitorios, cantidad_baños, habilitado) VALUES ('DEPARTAMENTOS DE 3 DORMITORIO SIN ASCENSOR',3,1,1);
INSERT INTO tipos_departamentos (nombre, cantidad_dormitorios, cantidad_baños, habilitado) VALUES ('DEPARTAMENTOS DE 4 DORMITORIO SIN ASCENSOR',4,1,1);

 /* PRECIOS GASTOS COMUNES POR TIPO APTO */
 
 SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE TABLE valores_gastos_comunes;
SET FOREIGN_KEY_CHECKS = 1;
INSERT INTO valores_gastos_comunes (id_tipo_departamento,fecha_ajuste, valor) VALUES (1,'20170901',1265);
INSERT INTO valores_gastos_comunes (id_tipo_departamento,fecha_ajuste, valor) VALUES (2,'20170901',1890);
INSERT INTO valores_gastos_comunes (id_tipo_departamento,fecha_ajuste, valor) VALUES (3,'20170901',1300);
INSERT INTO valores_gastos_comunes (id_tipo_departamento,fecha_ajuste, valor) VALUES (4,'20170901',2860);
INSERT INTO valores_gastos_comunes (id_tipo_departamento,fecha_ajuste, valor) VALUES (5,'20170901',1265);
INSERT INTO valores_gastos_comunes (id_tipo_departamento,fecha_ajuste, valor) VALUES (6,'20170901',1600);
INSERT INTO valores_gastos_comunes (id_tipo_departamento,fecha_ajuste, valor) VALUES (7,'20170901',2300);
INSERT INTO valores_gastos_comunes (id_tipo_departamento,fecha_ajuste, valor) VALUES (8,'20170901',2860);


/* CONCEPTOS FACTURAS */
SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE TABLE conceptos_facturas;
SET FOREIGN_KEY_CHECKS = 1;
INSERT INTO conceptos_facturas (nombre) VALUES ('GASTOS COMUNES');
INSERT INTO conceptos_facturas (nombre) VALUES ('CONVENIOS');


/* CONDOMINIOS */
SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE TABLE condominios;
SET FOREIGN_KEY_CHECKS = 1;
INSERT INTO condominios (nombre) VALUES ('EUSKALERRIA 71');

/* EDIFICIOS */
SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE TABLE edificios;
SET FOREIGN_KEY_CHECKS = 1;
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,1,'A',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,2,'B',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,3,'C',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,4,'CH',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,5,'D',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,6,'E',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,7,'F',4,26,2);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,8,'G',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,9,'H',4,28,2);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,10,'I',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,11,'J',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,12,'K',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,13,'L',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,14,'LL',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,15,'M',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,16,'N',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,17,'Ñ',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,18,'O',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,19,'P',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,20,'Q',4,26,2);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,21,'R',4,26,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,22,'S',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,23,'T',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,24,'U',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,25,'V',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,26,'X',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,27,'Y',4,26,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,28,'Z',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,29,'AA',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,30,'AB',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,31,'AC',4,28,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,32,'AD',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,33,'AE',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,34,'AF',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,35,'AG',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,36,'AH',12,42,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,37,'AI',12,43,1);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,38,'AJ',2,21,3);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,39,'BA',1,1,4);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,40,'BB',1,1,4);
INSERT INTO edificios (id_condominio, identificador, nombre, cantidad_pisos, cantidad_departamentos, id_tipo_edificio) VALUES (1,41,'BC',1,1,4);


