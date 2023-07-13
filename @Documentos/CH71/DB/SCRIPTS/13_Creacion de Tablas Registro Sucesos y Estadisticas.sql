
DROP TABLE IF EXISTS `registro_sucesos`;
CREATE TABLE `registro_sucesos` (
  `id_registro_sucesos` BigInt(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_usuario` int(11) NOT NULL,
  `SP` varchar(250) NOT NULL,
  `parametros` TEXT NOT NULL,
  `IP` varchar(50) NOT NULL,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
    KEY `FK_reg_sucesos_users` (`id_usuario`),
   CONSTRAINT `FK_reg_sucesos_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `registro_estadistica`;
CREATE TABLE `registro_estadistica` (
  `id_registro_estadistica` BigInt(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_usuario` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `importe` decimal(11,2) NOT NULL,
  `IP` varchar(50) NOT NULL,
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
    KEY `FK_reg_estadistica_users` (`id_usuario`),
   CONSTRAINT `FK_reg_estadistica_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
