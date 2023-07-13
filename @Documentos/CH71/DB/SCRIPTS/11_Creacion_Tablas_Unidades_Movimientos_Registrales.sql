ALTER TABLE titulares
  DROP COLUMN obs;
  
ALTER TABLE titulares
  ADD activo bool NOT NULL DEFAULT 1;
  

DROP TABLE IF EXISTS `personas_mov_registrales`;
DROP TABLE IF EXISTS `movimientos_registrales`;
DROP TABLE IF EXISTS `tipos_mov_registrales`;

/***************************************************************/
/* TIPOS MOVIMIENTOS REGISTRALES										               */
/***************************************************************/
CREATE TABLE `tipos_mov_registrales` (
  `id_tipo_mov_registral` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tipo_mov_registral` varchar(200) NOT NULL,
  `obs` varchar(250),
  `activo` bit NOT NULL DEFAULT 1,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
   KEY `FK_tipo_mov_reg_users` (`id_usuario`),
    CONSTRAINT `FK_tipo_mov_reg_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

ALTER TABLE tipos_mov_registrales AUTO_INCREMENT = 1;
INSERT INTO tipos_mov_registrales (tipo_mov_registral, id_usuario) VALUES ('ESCRITURA',1);
INSERT INTO tipos_mov_registrales (tipo_mov_registral, id_usuario) VALUES ('COMPRA VENTA',1);

CREATE TABLE `movimientos_registrales` (
  `id_movimiento_registral` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_tipo_mov_registral` int(11) NOT NULL,
  `fecha` DATE NOT NULL,
  `obs` varchar(250),
  `activo` bit NOT NULL DEFAULT 1,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
   KEY `FK_movimientos_tipos` (`id_tipo_mov_registral`),
    CONSTRAINT `FK_movimientos_tipos` FOREIGN KEY (`id_tipo_mov_registral`) REFERENCES `tipos_mov_registrales` (`id_tipo_mov_registral`),
   KEY `FK_movimientos_registrales_users` (`id_usuario`),
    CONSTRAINT `FK_movimientos_registrales_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

CREATE TABLE `personas_mov_registrales` (
  `id_persona_mov_registral` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_movimiento_registral` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `activo` bit NOT NULL DEFAULT 1,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
   KEY `FK_movimiento_persona_mov_reg` (`id_movimiento_registral`),
    CONSTRAINT `FK_movimiento_persona_mov_reg` FOREIGN KEY (`id_movimiento_registral`) REFERENCES `movimientos_registrales` (`id_movimiento_registral`),
    KEY `FK_movimiento_persona` (`id_persona`),
    CONSTRAINT `FK_movimiento_persona` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`),
  KEY `FK_personas_movimientos_registrales_users` (`id_usuario`),
    CONSTRAINT `FK_personas_movimientos_registrales_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

CREATE TABLE `unidades_mov_registrales` (
  `id_unidad_mov_registral` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_movimiento_registral` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `activo` bit NOT NULL DEFAULT 1,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
   KEY `FK_movimiento_unidad_mov_reg` (`id_movimiento_registral`),
    CONSTRAINT `FK_movimiento_unidad_mov_reg` FOREIGN KEY (`id_movimiento_registral`) REFERENCES `movimientos_registrales` (`id_movimiento_registral`),
    KEY `FK_movimiento_unidad` (`id_unidad`),
    CONSTRAINT `FK_movimiento_unidad` FOREIGN KEY (`id_unidad`) REFERENCES `unidades` (`id_unidad`),
  KEY `FK_unidades_movimientos_registrales_users` (`id_usuario`),
    CONSTRAINT `FK_unidades_movimientos_registrales_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;








