-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.0.17-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.5068
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla contfpp_empresa1.clientes
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `notas` text,
  `nombreEmpresa` varchar(50) DEFAULT NULL,
  `CIF` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `municipio` varchar(50) DEFAULT NULL,
  `CP` varchar(5) DEFAULT NULL,
  `provincia` varchar(30) DEFAULT NULL,
  `forma_pago_habitual` varchar(20) DEFAULT NULL,
  `borrado` int(5) NOT NULL DEFAULT '1' COMMENT '1=Valido, 9=Borrado',
  `fechaAlta` datetime NOT NULL,
  `tipo` varchar(10) NOT NULL COMMENT 'C=Cliente, P=Proveedor',
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.clientes: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT IGNORE INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(1, 'Juan', 'Morales', '616005522', NULL, NULL, NULL, 'sdf65654', NULL, NULL, NULL, NULL, NULL, 1, '2016-03-24 00:00:00', 'C'),
	(2, 'Luisa', 'Lopez Araujo2', '915636547', 'aaaa@eeee.es', 'hola, me llamo lola y me gustan las pastillas juanolas', 'sdfgsdfgsd', '7788536L', '', '', '', '', '', 1, '2016-03-24 00:00:00', 'P'),
	(3, 'Alfonso', 'Perez', '902525636', 'fparralejo@gmail.com', 'asdf as dfasdf asldfalsdf t y tyu uy k dh', 'Autonomo 2', '5665dfsdf226', '', '', '', '', '', 1, '2016-03-25 20:56:48', 'C'),
	(4, 'Alejandra', 'Fuertes Robles', '671108309', 'escombro@yahoo.es', ' gsdfg sdfg sdfg sdg sdg ', 'fgsdg', '5632654', 'Calle Badajoz 28 Bajo 1', 'Alcorcón', '28921', 'Madrid', 'transferencia', 1, '2016-03-25 21:13:24', 'C'),
	(5, 'Francisco Parralejo', '', '671108309', 'fparralejo1970@yahoo.es', '', 'parraspider 9', 'sfsd6545', 'Calle Badajoz 28 Bajo 1', 'Alcorcón', '2', 'Madrid', '', 1, '2016-03-25 22:27:34', 'C'),
	(6, 'Douglas', 'Mortimer el malo', 'qq', 'fparralejo1991@gmail.com', 'dfasasf asdf asdf', 'asdf asf', 'asdf asdf', 'asdf asdf', 'asdf asdf', 'sdf a', 'asdf asf', 'recibo', 1, '2016-03-26 11:10:48', 'C'),
	(7, 'Parraspider', 'Fulanez', '671108309', 'escombro@yahoo.es', '', 'ESCOMBRO SL', '08037049K', 'Calle Badajoz 28 Bajo 1', 'asdfasdf', '28921', 'Madrid', 'talon', 1, '2016-03-26 11:46:16', 'P'),
	(8, 'Lucas', 'Alcaraz Lopez', '915663344', 'aaa@wwww.es', 'menudo montón de escombro', 'Panolis SL', 'B12356478', 'Calle del Cerro Porto', 'Getafe', '28454', 'Madrid', 'recibo', 1, '2016-03-27 07:27:07', 'C'),
	(9, 'Sorin', 'Pantoriou', '915652233', 'sorin@help.me', 'rumanoide de los cojones', '', '', '', '', '', '', 'recibo', 1, '2016-03-31 16:45:41', 'P'),
	(10, 'Mª Sonia', 'Abajo', '902525666', 's.abajo@typsa.nd', 'fgsdfg sdfg sdgsdg', 'TYPSA', '888888888KKKK', '', '', '', '', '', 1, '2016-03-31 16:50:14', 'C'),
	(11, 'irene', 'Fuertes', '671108309', 'eeee@eeee.es', 'asdfasdfasdf', '', 'dfgsdfg', '', '', '', '', '', 1, '2016-03-31 17:34:09', 'C'),
	(12, 'aaa 2', 'aaaaa', 'aaaaa', 'aaaa@aaa.aa', 'aaa a a aa a aaaaaa a aa', 'aaaaa', 'aaaaaa', 'aaaaa', 'aaaa', 'aaa', 'aaaa', 'transferencia', 0, '2016-03-31 17:34:38', 'C'),
	(13, 'gustavo', 'arencibia', '962356988', 'eeell@ffffeee.es', 'Rossi terminó segundo en Termas de Río Hondo tras el fallo garrafal de Iannone, que se llevó por delante a Dovizioso. Pedrosa cerró el podio.', '', '8888888', '', '', '', '', '', 1, '2016-04-03 17:49:59', 'P'),
	(14, 'Andrea', 'Nocioni', '963256987', 'fparralejo1970@yahoo.es', '', '', '7777777L', 'Badajoz', 'Alcorcón', '28921', 'Madrid', '', 1, '2016-04-03 20:40:32', 'C'),
	(15, 'Sofia', 'Loren', '965658784L', '', '', '', '22222222N', '', '', '', '', 'talon', 1, '2016-04-03 20:51:47', 'C'),
	(16, 'Gustavo', 'Cifuentes', '99988877', '', 'dsfa fasdf asfasf ', '', '44444444G', '', '', '', '', 'contado', 0, '2016-04-03 20:52:24', 'P'),
	(17, 'Steve', 'Winwood', '95623659', 'winwood@www.ww', 'roll with it', '', '3333333F', 'calle raimundio lulio 9', 'madrid', '28555', 'Madrid', 'transferencia', 1, '2016-04-03 20:54:39', 'P'),
	(18, 'Anacleto', 'Lopecillo', '777888444K', 'eee@eee.es', 'sdf sfasdasdfasfasf ', 'Lucas Alcaraz', 'opoiuytr', 'Calle Amapola 22', 'Brunete', '28525', 'Madrid', 'recibo', 1, '2016-04-03 21:00:45', 'P');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Volcando estructura para tabla contfpp_empresa1.empleados
DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `IdEmpleado` int(11) NOT NULL,
  `IdEmpresa` int(11) DEFAULT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` int(11) DEFAULT '0',
  `movil` int(11) DEFAULT '0',
  `borrado` int(2) DEFAULT NULL,
  `fechaStatus` datetime DEFAULT NULL,
  `IdEmpleadoStatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdEmpleado`),
  KEY `IdEmpresa` (`IdEmpresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.empleados: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT IGNORE INTO `empleados` (`IdEmpleado`, `IdEmpresa`, `nombre`, `apellidos`, `correo`, `telefono`, `movil`, `borrado`, `fechaStatus`, `IdEmpleadoStatus`) VALUES
	(1, 1, 'paco', 'parralejo', 'fparralejo1970@gmail.com', 0, 671108309, 1, '2016-03-21 21:53:45', 1);
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;

-- Volcando estructura para tabla contfpp_empresa1.presupuestos
DROP TABLE IF EXISTS `presupuestos`;
CREATE TABLE IF NOT EXISTS `presupuestos` (
  `IdPresupuesto` int(11) NOT NULL AUTO_INCREMENT,
  `NumPresupuesto` varchar(50) NOT NULL,
  `IdCliente` varchar(15) NOT NULL,
  `FechaPresupuesto` datetime NOT NULL,
  `FechaVtoPresupuesto` datetime NOT NULL,
  `FormaPago` varchar(50) DEFAULT NULL,
  `FechaFinalizacion` datetime DEFAULT NULL,
  `Estado` varchar(15) DEFAULT NULL COMMENT 'Pendiente, Aceptado, Rechazado, Cancelado',
  `Retencion` double DEFAULT '0',
  `Proforma` int(11) DEFAULT '0' COMMENT '1=SI, 0=NO',
  `Borrado` int(11) DEFAULT '1' COMMENT '1=Activo, 0=Borrado',
  `BaseImponible` double DEFAULT '0',
  `Cuota` double DEFAULT '0',
  `total` double DEFAULT '0',
  PRIMARY KEY (`IdPresupuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.presupuestos: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuestos` DISABLE KEYS */;
INSERT IGNORE INTO `presupuestos` (`IdPresupuesto`, `NumPresupuesto`, `IdCliente`, `FechaPresupuesto`, `FechaVtoPresupuesto`, `FormaPago`, `FechaFinalizacion`, `Estado`, `Retencion`, `Proforma`, `Borrado`, `BaseImponible`, `Cuota`, `total`) VALUES
	(1, '20160001', '4', '2016-04-04 21:16:11', '2016-04-04 21:16:22', NULL, NULL, 'Emitida', 0, 0, 1, 210, 42, 242);
/*!40000 ALTER TABLE `presupuestos` ENABLE KEYS */;

-- Volcando estructura para tabla contfpp_empresa1.presupuestosdetalle
DROP TABLE IF EXISTS `presupuestosdetalle`;
CREATE TABLE IF NOT EXISTS `presupuestosdetalle` (
  `IdPresupDetalle` int(11) NOT NULL AUTO_INCREMENT,
  `IdPresupuesto` int(11) NOT NULL,
  `NumLineaPresup` int(11) NOT NULL,
  `IdArticulo` int(11) DEFAULT NULL,
  `DescripcionProducto` longtext,
  `TipoIVA` double DEFAULT NULL,
  `Cantidad` double DEFAULT NULL,
  `ImporteUnidad` double DEFAULT NULL COMMENT 'Importe Unidad',
  `Importe` double DEFAULT NULL,
  `CuotaIva` double DEFAULT NULL,
  `GenFacPed` varchar(10) DEFAULT 'NO' COMMENT 'SI, NO, Parcial',
  `Facturada` varchar(10) DEFAULT 'NF' COMMENT 'T=Total, M=Modificada, NF=No Facturada',
  `GenPedPre` varchar(10) DEFAULT 'NO' COMMENT 'SI, NO, Parcial',
  `Pedido` varchar(10) DEFAULT 'NP' COMMENT 'T=Total, M=Modificada, NP=No Pedida',
  PRIMARY KEY (`IdPresupDetalle`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.presupuestosdetalle: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuestosdetalle` DISABLE KEYS */;
INSERT IGNORE INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `GenFacPed`, `Facturada`, `GenPedPre`, `Pedido`) VALUES
	(1, 1, 1, 0, 'producto 1', 21, 1, 100, 100, 21, 'NO', 'NF', 'NO', 'NP'),
	(2, 1, 2, 0, 'producto 2', 10, 2, 55, 110, 11, 'NO', 'NF', 'NO', 'NP');
/*!40000 ALTER TABLE `presupuestosdetalle` ENABLE KEYS */;

-- Volcando estructura para tabla contfpp_empresa1.productos
DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `IdProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Referencia` varchar(25) DEFAULT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Precio` double NOT NULL,
  `tipoIVA` int(5) NOT NULL,
  `Borrado` int(11) NOT NULL COMMENT '1=Datos Vale, 0=Esta Borrado',
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`IdProducto`),
  UNIQUE KEY `referencia_borrado` (`Referencia`,`Borrado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.productos: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT IGNORE INTO `productos` (`IdProducto`, `Referencia`, `Descripcion`, `Precio`, `tipoIVA`, `Borrado`, `fecha`) VALUES
	(1, 'R001', 'Ventana aluminio', 250, 21, 1, '2016-01-01 00:00:00'),
	(2, 'R002', 'Puerta de acero', 400, 21, 1, '2016-03-03 00:00:00'),
	(3, 'R003', 'Cristal 2x2', 250, 21, 1, '2016-04-01 00:00:00'),
	(4, 'R004', 'un montón de escombro', 21117.59, 21, 0, '2016-04-04 18:19:36'),
	(5, 'r005', 'escombro', 253.555, 21, 1, '2016-04-08 19:20:06');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla contfpp_empresa1.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `IdEmpleado` int(11) NOT NULL,
  `borrado` int(2) DEFAULT NULL,
  `fechaStatus` datetime DEFAULT NULL,
  `IdEmpleadoStatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdEmpleado`),
  UNIQUE KEY `IdEmpleado` (`IdEmpleado`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.usuarios: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT IGNORE INTO `usuarios` (`usuario`, `password`, `IdEmpleado`, `borrado`, `fechaStatus`, `IdEmpleadoStatus`) VALUES
	('paco', 'paco', 1, 1, '2016-03-21 21:56:22', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
