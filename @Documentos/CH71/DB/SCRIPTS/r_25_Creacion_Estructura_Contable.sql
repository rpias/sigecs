--
-- Items menu para CONTABILIDAD`
--



DROP TABLE IF EXISTS `contable_rubros`;
CREATE TABLE IF NOT EXISTS `contable_rubros` (
  `id_rubro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `es_padre` tinyint(1) NOT NULL DEFAULT '0',
  `id_padre` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `es_haber` tinyint(1) NOT NULL DEFAULT '0',
  `es_visible_caja_diaria` tinyint(1) NOT NULL DEFAULT '1',
  `habilitado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_rubro`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

ALTER TABLE `contable_rubros` AUTO_INCREMENT = 1;
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('SUELDOS', 1, 1, 1, 0);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('RETENCIONES JUDICIALES', 1, 1, 2, 0);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('COBRANZA GASTOS COMUNES Y OTROS', 1, 1, 3, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('DEPÓSITOS BANCARIOS', 1, 1, 4, 0);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('MATERIALES Y REPARACIONES', 1, 1, 5, 0);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('GASTOS ADMINISTRATIVOS', 1, 1, 6, 0);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('SERVICES', 1, 1, 7, 0);

-- 1
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`,  `orden`, `es_haber`) VALUES ('ADELANTO SOBRE SUELDOS', 0, 1, 1, 0);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('LIQUIDACIÓN DE SUELDOS', 0, 1, 2, 0);

-- 2
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('PENSIÓN ALIMENTICIA SOBRE SUELDO', 0, 2, 1, 0);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('ACAC', 0, 2, 2, 0);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('COPAC', 0, 2, 3, 0);

-- 3
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('GASTOS COMUNES EFECTIVO', 0, 3, 1, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('GASTOS COMUNES DÉBITO', 0, 3, 2, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('GASTOS COMUNES CRÉDITO', 0, 3, 3, 1);

INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('CONVENIOS EFECTIVO', 0, 3, 4, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('CONVENIOS DÉBITO', 0, 3, 5, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('CONVENIOS CRÉDITO', 0, 3, 6, 1);

INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('OTROS SERVICIOS EFECTIVO', 0, 3, 7, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('OTROS SERVICIOS DÉBITO', 0, 3, 8, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('OTROS SERVICIOS CRÉDITO', 0, 3, 9, 1);

-- 4
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('DEPÓSITOS BANCARIOS EFECTIVO', 0, 4, 1, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('DEPÓSITOS BANCARIOS CHEQUES', 0, 4, 2, 1);

-- 5
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('SANITARIA-REP. GRASERAS', 0, 5, 1, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('CERRAJERÍA ', 0, 5, 2, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('MATERIALES ELÉCTRICOS', 0, 5, 3, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('MATERIALES CONSTRUCCIÓN Y REPARACIÓN', 0, 5, 4, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('ROPA DE TRABAJO', 0, 5, 5, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('COMBUSTIBLE', 0, 5, 6, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('ARTÍCULOS DE LIMPIEZA', 0, 5, 7, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('VIDRIOS', 0, 5, 8, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('JARDINERÍA, FERTILIZANTE Y VARIOS', 0, 5, 9, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('FLETES, VOLQUETAS Y VARIOS', 0, 5, 10, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('HERRAMIENTAS DE TRABAJO', 0, 5, 11, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('REPARACIÓN SALON COMUNAL Y OFICINA', 0, 5, 12, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('REPARACIÓN DE AZOTEAS', 0, 5, 13, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('REPARACIONES MOTO SIERRA', 0, 5, 14, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('REPARACIONES DESCONT. DE GASTOS COMUNES', 0, 5, 15, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('REPARACIONES CARPINTERÍA', 0, 5, 16, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('REPARACIONES MAQ. Y HERRAMIENTAS ', 0, 5, 17, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('AGUA, LECHE, BOTIQUIN-PERSONAL', 0, 5, 18, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('CAÑERIA, BOMBAS Y TANQUES DE AGUA', 0, 5, 19, 1);

-- 6
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('GAST. COB. POR TARJETA DE CREDITO', 0, 6, 1, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('GENERALES', 0, 6, 2, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('PAPELERíA', 0, 6, 3, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('TAXI, CORREO Y LOCOMOCIÓN', 0, 6, 4, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('GASTOS BANCARIOS', 0, 6, 5, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('TIMBRES PROFESIONALES', 0, 6, 6, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('ESTACIONAMIENTO', 0, 6, 7, 1);

-- 7
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('ASCENSORES', 0, 7, 1, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('PORTERO ELÉCTRICO', 0, 7, 2, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('CERRAJERÍA', 0, 7, 3, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('LIGA SANITARIA', 0, 7, 4, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('ARRENDAMIENTO POS', 0, 7, 5, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('BOMBERITOS', 0, 7, 6, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('MANTENIMIENTO INFORMÁTICO', 0, 7, 7, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('FOTOCOPIADORA E IMPRESORA', 0, 7, 8, 1);
INSERT INTO `contable_rubros` (`nombre`, `es_padre`, `id_padre`, `orden`, `es_haber`) VALUES ('CAMARAS DE SEGURIDAD Y ALARMA', 0, 7, 9, 1);

-- ----------------------------------------------------------------------------------------------------------------------
-- Estructura de tabla para la tabla `contable_movimientos`
-- ----------------------------------------------------------------------------------------------------------------------

DROP TABLE IF EXISTS `contable_movimientos`;
CREATE TABLE IF NOT EXISTS `contable_movimientos` (
  `id_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `id_rubro` int(11) NOT NULL,
  `fecha_mov` datetime NOT NULL,
  `fecha_doc` datetime NOT NULL,
  `nro_doc` varchar(30) NOT NULL,
  `detalle` varchar(300) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `obs` varchar(300) NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT '1',
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  `modificado` datetime DEFAULT NULL,
  `id_usuario_mod` INT DEFAULT NULL,
  PRIMARY KEY (`id_movimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

ALTER TABLE `contable_movimientos` AUTO_INCREMENT = 1;



#########################################################################################################################
# PROCEDIMIENTOS ALMACENEADOS
#########################################################################################################################
-- ----------------------------------------------------------------------------------------------------------------------
-- SP_ListarRubrosPadres
-- ----------------------------------------------------------------------------------------------------------------------

