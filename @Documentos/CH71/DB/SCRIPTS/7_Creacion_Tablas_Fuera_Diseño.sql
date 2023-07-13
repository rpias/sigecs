
#DROP TABLE IF EXISTS `expedientes`;
CREATE TABLE `expedientes` (
  `id_expediente` int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY ,
  `id_unidad` int(11) NOT NULL,
  `nro_expediente` varchar(50) NOT NULL,
  `fecha_ingreso_anv` datetime NOT NULL,
  `fecha_expediente` datetime NOT NULL,
  `fecha_deuda` datetime NOT NULL,
  `importe_total_reclamado` decimal(10,2) NOT NULL,
  `fecha_cierre` datetime,
  `resolucion_expediente` varchar(250),
  `nro_convenio_resolucion` varchar(250),
  `habilitado` bit(1) NOT NULL DEFAULT b'1',
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  CONSTRAINT `FK_expedientes_unidades` FOREIGN KEY (`id_unidad`) REFERENCES `unidades`(`id_unidad`),
  CONSTRAINT `FK_expedientes_users` FOREIGN KEY (`id_usuario`) REFERENCES `users`(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

#DROP TABLE IF EXISTS `expedientes_movimientos`;
CREATE TABLE `expedientes_movimientos` (
  `id_expediente_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `id_expediente` int(11) NOT NULL,
  `obs` varchar(250) NOT NULL,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_expediente_movimiento`),
  
  KEY `FK_expedientes_movimientos` (`id_expediente`),
  KEY `FK_expedientes_movimientos_users` (`id_usuario`),
  
  CONSTRAINT `FK_expedientes_movimientos` FOREIGN KEY (`id_expediente`) REFERENCES `expedientes` (`id_expediente`),
  CONSTRAINT `FK_expedientes_movimientos_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;


ALTER TABLE titulares_unidad
ADD COLUMN `escriturado` bit(1) NOT NULL DEFAULT b'0',
ADD COLUMN `habilitado` bit(1) NOT NULL DEFAULT b'1',
ADD COLUMN `creado` datetime DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN `modificado` datetime DEFAULT NULL,
ADD COLUMN `id_usuario` int(11) NOT NULL;

ALTER TABLE expedientes
ADD COLUMN `obs` VARCHAR(250);

