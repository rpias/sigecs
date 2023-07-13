/*
ALTER TABLE `roles_menu` DROP FOREIGN KEY `FK_menu_usuarios_roles`;
ALTER TABLE `roles_menu` DROP FOREIGN KEY `FK_menu_usuarios_usuarios`;
ALTER TABLE `roles_menu` DROP FOREIGN KEY `FK_menu_usuarios_menu`;
ALTER TABLE `menu` DROP FOREIGN KEY `FK_menu_users`;
DROP TABLE `menu`;
DROP TABLE `roles_menu`;
*/
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `menu` varchar(250) NOT NULL,
  `encabezado` bit NOT NULL,
  `padre` bit NOT NULL,
  `hijo_de` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `ruta` varchar(250) NOT NULL,
  `icono` varchar(250) NOT NULL,
  `habilitado` bit NOT NULL DEFAULT 1,
  `id_usuario` int(11) NOT NULL DEFAULT 1,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
   KEY `FK_menu_users` (`id_usuario`),
   CONSTRAINT `FK_menu_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

ALTER TABLE menu AUTO_INCREMENT = 1;
INSERT INTO menu (menu, encabezado, padre, hijo_de, orden, ruta, icono) VALUES ('Gestión de Cobranza', 1,1,0,1,'#', 'fa fa-edit');

INSERT INTO menu (menu, encabezado, padre, hijo_de, orden, ruta, icono) VALUES ('Ingreso de Recibos', 0,0,1,1,'ing_recibos', 'fa fa-circle-o nav-icon');
INSERT INTO menu (menu, encabezado, padre, hijo_de, orden, ruta, icono) VALUES ('Ingreso de Expedientes', 0,0,1,10,'ing_expedientes', 'fa fa-circle-o nav-icon');
INSERT INTO menu (menu, encabezado, padre, hijo_de, orden, ruta, icono) VALUES ('Consulta de Recibos', 0,0,1,15,'cons_recibos', 'fa fa-circle-o nav-icon');

INSERT INTO menu (menu, encabezado, padre, hijo_de, orden, ruta, icono) VALUES ('Consultar de morosidad', 0,0,1,16,'index_morosidad', 'fa fa-circle-o nav-icon');

INSERT INTO menu (menu, encabezado, padre, hijo_de, orden, ruta, icono) VALUES ('Estadistica de Cobranza', 0,0,1,20,'index_estadistica', 'fa fa-circle-o nav-icon');
INSERT INTO menu (menu, encabezado, padre, hijo_de, orden, ruta, icono) VALUES ('Convenios', 0,0,1,25,'ing_convenios', 'fa fa-circle-o nav-icon');

INSERT INTO menu (menu, encabezado, padre, hijo_de, orden, ruta, icono) VALUES ('Mantenimiento', 1,1,0,10,'#', 'fa fa-building-o');

INSERT INTO menu (menu, encabezado, padre, hijo_de, orden, ruta, icono) VALUES ('Unidades', 0,0,7,1,'unidades_mant', 'fa fa-circle-o nav-icon');
INSERT INTO menu (menu, encabezado, padre, hijo_de, orden, ruta, icono) VALUES ('Personas', 0,0,7,10,'personas_mant', 'fa fa-circle-o nav-icon');


CREATE TABLE `roles_menu` (
  `id_rol_menu` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_rol` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `habilitado` bit NOT NULL DEFAULT 1,
  `id_usuario` int(11) NOT NULL DEFAULT 1,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
   KEY `FK_menu_usuarios_roles` (`id_rol`),
   CONSTRAINT `FK_menu_usuarios_roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
   KEY `FK_menu_usuarios_usuarios` (`id_usuario`),
   CONSTRAINT `FK_menu_usuarios_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`),
   KEY `FK_menu_usuarios_menu` (`id_menu`),
   CONSTRAINT `FK_menu_usuarios_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

ALTER TABLE roles_menu AUTO_INCREMENT = 1;
INSERT INTO roles_menu (id_rol, id_menu) VALUES (1,1);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (1,2);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (1,3);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (1,4);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (1,5);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (1,6);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (1,7);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (1,8);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (1,9);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (1,10);

INSERT INTO roles_menu (id_rol, id_menu) VALUES (2,1);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (2,2);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (2,3);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (2,4);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (2,5);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (2,6);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (2,7);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (2,8);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (2,9);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (2,10);

INSERT INTO roles_menu (id_rol, id_menu) VALUES (3,1);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (3,2);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (3,3);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (3,4);
#INSERT INTO roles_menu (id_rol, id_menu) VALUES (3,5); Estadisticas de cobranza
INSERT INTO roles_menu (id_rol, id_menu) VALUES (3,6);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (3,7);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (3,8);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (3,9);
INSERT INTO roles_menu (id_rol, id_menu) VALUES (3,10);

# ROLES
# 1 - ADMINISTRADOR
# 2 - TESORERIA
# 3 - OPERADOR  
# USUARIOS
# 1 - Richard
# 3 - Raul Brea
# 4 - Robert
# 6 - Flavia
# 8 - Silvana
# 10 - Maria Pose
# 15 - Flavia

TRUNCATE Table usuarios_roles;
# ADMINISTRADOR
INSERT usuarios_roles (id_usuario, id_rol, habilitado) VALUES (1,1,1);
INSERT usuarios_roles (id_usuario, id_rol, habilitado) VALUES (1,2,1);
INSERT usuarios_roles (id_usuario, id_rol, habilitado) VALUES (1,3,1);

# TESORERIA
INSERT usuarios_roles (id_usuario, id_rol, habilitado) VALUES (3,2,1);
INSERT usuarios_roles (id_usuario, id_rol, habilitado) VALUES (10,2,1);

# OPERADORES
INSERT usuarios_roles (id_usuario, id_rol, habilitado) VALUES (4,3,1);
INSERT usuarios_roles (id_usuario, id_rol, habilitado) VALUES (6,3,1);
INSERT usuarios_roles (id_usuario, id_rol, habilitado) VALUES (15,3,1);
INSERT usuarios_roles (id_usuario, id_rol, habilitado) VALUES (8,3,1);

SELECT * FROM menu;
