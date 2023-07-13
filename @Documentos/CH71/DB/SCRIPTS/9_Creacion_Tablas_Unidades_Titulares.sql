DROP TABLE IF EXISTS `unidades_titulares`;
DROP TABLE IF EXISTS `titulares`;

/***************************************************************/
/* TITULARES										               */
/***************************************************************/
CREATE TABLE `titulares` (
  `id_titular` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_persona` int(11) NOT NULL,
  `obs` varchar(250),
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  KEY `FK_titulares_personas` (`id_persona`),
    CONSTRAINT `FK_titulares_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`),
 KEY `FK_titulares_users` (`id_usuario`),
    CONSTRAINT `FK_titulares_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/***************************************************************/
/* 	UNIDADES - TITULARES                         			   */
/***************************************************************/
CREATE TABLE `unidades_titulares` (
  `id_unidad_titular` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_titular` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `pertenece_recibo` bit NOT NULL DEFAULT 1,
  `pertenece_padron` bit NOT NULL DEFAULT 1,
  `activo` bit NOT NULL DEFAULT 1,
  `obs` varchar(250),
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  KEY `FK_titulares` (`id_titular`),
   CONSTRAINT `FK_titulares` FOREIGN KEY (`id_titular`) REFERENCES `titulares` (`id_titular`),
  KEY `FK_unidades` (`id_unidad`),
   CONSTRAINT `FK_unidades` FOREIGN KEY (`id_unidad`) REFERENCES `unidades` (`id_unidad`),
  KEY `FK_unidades_titulares_users` (`id_usuario`),
   CONSTRAINT `FK_unidades_titulares_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

