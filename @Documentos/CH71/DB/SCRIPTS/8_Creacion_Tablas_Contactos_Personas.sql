
DROP TABLE IF EXISTS `personas_contactos`;
DROP TABLE IF EXISTS `contactos`;
DROP TABLE IF EXISTS `tipos_contactos`;

/***************************************************************/
/* TIPOS DE CONTACTO : Telefono - Correo - etc                 */
/***************************************************************/
CREATE TABLE `tipos_contactos` (
  `id_tipo_contacto` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tipo_contacto` varchar(200) NOT NULL,
  `activo` bit NOT NULL DEFAULT 1,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  KEY `FK_tipo_contacto_users` (`id_usuario`),
  CONSTRAINT `FK_tipo_contacto_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

ALTER TABLE tipos_contactos AUTO_INCREMENT = 1;
INSERT INTO tipos_contactos (tipo_contacto, activo, id_usuario) VALUES ('Teléfono Fijo',1,1);
INSERT INTO tipos_contactos (tipo_contacto, activo, id_usuario) VALUES ('Teléfono Móvil',1,1);
INSERT INTO tipos_contactos (tipo_contacto, activo, id_usuario) VALUES ('Correo Electrónico',1,1);

/***************************************************************/
/* CONTACTO										               */
/***************************************************************/
CREATE TABLE `contactos` (
  `id_contacto` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_tipo_contacto` int(11) NOT NULL,
  `contacto` varchar(200) NOT NULL,
  `obs` varchar(250),
  `activo` bit NOT NULL DEFAULT 1,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  KEY `FK_tipo_contacto` (`id_tipo_contacto`),
    CONSTRAINT `FK_tipo_contacto` FOREIGN KEY (`id_tipo_contacto`) REFERENCES `tipos_contactos` (`id_tipo_contacto`),
  KEY `FK_contactos_users` (`id_usuario`),
    CONSTRAINT `FK_contactos_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/***************************************************************/
/* PERSONAS - CONTACTO										   */
/***************************************************************/
CREATE TABLE `personas_contactos` (
  `id_persona_contacto` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_contacto` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `activo` bit NOT NULL DEFAULT 1,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  KEY `FK_persona_contacto_contacto` (`id_contacto`),
	CONSTRAINT `FK_persona_contacto_contacto` FOREIGN KEY (`id_contacto`) REFERENCES `contactos` (`id_contacto`),
  KEY `FK_persona_contacto_unidades` (`id_persona`),
	CONSTRAINT `FK_unidades_contacto_unidades` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`),
  KEY `FK_persona_contacto_users` (`id_usuario`),
	CONSTRAINT `FK_persona_contacto_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
