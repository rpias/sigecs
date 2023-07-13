/*----------------------------------------------------------------------------------------*/
/*----------------------------------------------------------------------------------------*/
/*----------------------------------------------------------------------------------------*/

/***************************************************************/
/* TIPOS VEHICULOS                         					   */
/***************************************************************/
DROP TABLE IF EXISTS `unidades_vehiculos`;
DROP TABLE IF EXISTS `vehiculos`;
DROP TABLE IF EXISTS `tipos_vehiculos`;

CREATE TABLE `tipos_vehiculos` (
  `id_tipo_vehiculo` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tipo_vehiculo` varchar(250) NOT NULL,
  `activo` bit NOT NULL DEFAULT 1,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
   KEY `FK_tipo_vehiculos_users` (`id_usuario`),
   CONSTRAINT `FK_tipo_vehiculos_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

ALTER TABLE tipos_vehiculos AUTO_INCREMENT = 1;
INSERT INTO tipos_vehiculos (tipo_vehiculo, activo, id_usuario) VALUES ('Automovil',1,1);
INSERT INTO tipos_vehiculos (tipo_vehiculo, activo, id_usuario) VALUES ('Camioneta',1,1);
INSERT INTO tipos_vehiculos (tipo_vehiculo, activo, id_usuario) VALUES ('Camión',1,1);
INSERT INTO tipos_vehiculos (tipo_vehiculo, activo, id_usuario) VALUES ('Motocicleta',1,1);

/***************************************************************/
/* VEHICULOS                         						   */
/***************************************************************/
CREATE TABLE `vehiculos` (
  `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_tipo_vehiculo` int(11) NOT NULL,
  `matricula`  varchar(250) NOT NULL,
  `marca` varchar(250) NOT NULL,
  `modelo` varchar(250) NOT NULL,
  `anio` int(11) NOT NULL,
  `obs` varchar(250),
  `activo` bit NOT NULL DEFAULT 1,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
   KEY `FK_vehiculos_tipos` (`id_tipo_vehiculo`),
   CONSTRAINT `FK_vehiculos_tipos` FOREIGN KEY (`id_tipo_vehiculo`) REFERENCES `tipos_vehiculos` (`id_tipo_vehiculo`),
   KEY `FK_vehiculos_users` (`id_usuario`),
   CONSTRAINT `FK_vehiculos_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/***************************************************************/
/* UNIDADES - VEHICULOS                         				*/
/***************************************************************/
CREATE TABLE `unidades_vehiculos` (
  `id_unidades_vehiculos` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_unidad` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  `activo` bit NOT NULL DEFAULT 1,
  `obs` varchar(250),
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  KEY `FK_uv_vehiculos` (`id_vehiculo`),
  CONSTRAINT `FK_uv_vehiculos` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id_vehiculo`),
  KEY `FK_uv_unidades` (`id_unidad`),
  CONSTRAINT `FK_uv_unidades` FOREIGN KEY (`id_unidad`) REFERENCES `unidades` (`id_unidad`),
  KEY `FK_uv_users` (`id_usuario`),
  CONSTRAINT `FK_uv_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;


ALTER TABLE vehiculos AUTO_INCREMENT = 1;
ALTER TABLE unidades_vehiculos AUTO_INCREMENT = 1;
INSERT INTO vehiculos (id_tipo_vehiculo, matricula, marca, modelo, anio, obs, id_usuario) VALUES (1,'SBK7271','FIAT', 'WAY', 2018, '',1);
INSERT INTO unidades_vehiculos (id_unidad, id_vehiculo, id_usuario) VALUES (243,1,1);

/*----------------------------------------------------------------------------------------*/
/*----------------------------------------------------------------------------------------*/
/*----------------------------------------------------------------------------------------*/
