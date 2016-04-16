-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.0.17-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.5071
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla contfpp_empresa1.articulos
DROP TABLE IF EXISTS `articulos`;
CREATE TABLE IF NOT EXISTS `articulos` (
  `IdArticulo` int(11) NOT NULL AUTO_INCREMENT,
  `Referencia` varchar(25) DEFAULT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Precio` double NOT NULL,
  `tipoIVA` int(5) NOT NULL,
  `Borrado` int(11) NOT NULL COMMENT '1=Datos Vale, 0=Esta Borrado',
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`IdArticulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.articulos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;

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
  `Proforma` varchar(10) DEFAULT 'NO' COMMENT '1=SI, 0=NO',
  `Borrado` int(11) DEFAULT '1' COMMENT '1=Activo, 0=Borrado',
  `BaseImponible` double DEFAULT '0',
  `Cuota` double DEFAULT '0',
  `total` double DEFAULT '0',
  PRIMARY KEY (`IdPresupuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.presupuestos: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuestos` DISABLE KEYS */;
INSERT IGNORE INTO `presupuestos` (`IdPresupuesto`, `NumPresupuesto`, `IdCliente`, `FechaPresupuesto`, `FechaVtoPresupuesto`, `FormaPago`, `FechaFinalizacion`, `Estado`, `Retencion`, `Proforma`, `Borrado`, `BaseImponible`, `Cuota`, `total`) VALUES
	(1, '20161', '11', '2016-04-13 19:42:56', '2016-04-13 19:42:56', 'Recibo', NULL, 'Emitida', 0, 'SI', 1, 1152.85, 242.1, 1394.95),
	(2, '20162', '15', '2016-04-13 19:20:46', '2016-04-13 19:20:46', 'Talon', NULL, 'Emitida', 0, 'SI', 1, 50.82, 10.67, 61.49),
	(3, '20163', '8', '2016-04-13 09:43:03', '2016-04-28 09:43:03', 'Recibo', NULL, 'Emitida', 0, 'NO', 1, 856.34, 158.97, 1015.31),
	(4, '20164', '10', '2016-04-13 09:08:19', '2016-04-13 09:08:19', 'Recibo', NULL, 'Emitida', 0, 'NO', 1, 7140.68, 1499.54, 8640.22),
	(5, '20165', '8', '2016-04-16 09:30:18', '2016-04-16 09:30:18', 'Recibo', NULL, 'Emitida', 0, 'NO', 1, 1969.38, 413.57, 2382.95);
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
  `Borrado` int(5) NOT NULL DEFAULT '1' COMMENT '1=Valido, 0= Borrado',
  PRIMARY KEY (`IdPresupDetalle`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.presupuestosdetalle: ~79 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuestosdetalle` DISABLE KEYS */;
INSERT IGNORE INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `GenFacPed`, `Facturada`, `GenPedPre`, `Pedido`, `Borrado`) VALUES
	(1, 1, 1, 0, 'AAAA', 21, 15.55, 15.44, 240.09, 50.4189, 'NO', 'NF', 'NO', 'NP', 0),
	(2, 1, 2, 0, 'BBBB', 21, 33.06, 20.04, 662.52, 139.1292, 'NO', 'NF', 'NO', 'NP', 0),
	(3, 1, 1, 0, 'AAAA', 21, 15.55, 15.44, 240.09, 50.4189, 'NO', 'NF', 'NO', 'NP', 0),
	(4, 1, 2, 0, 'BBBB', 21, 33.06, 20.04, 662.52, 139.1292, 'NO', 'NF', 'NO', 'NP', 0),
	(5, 1, 3, 0, 'ccccc', 21, 15.66, 10.23, 160.2, 33.64, 'NO', 'NF', 'NO', 'NP', 0),
	(6, 1, 1, 0, 'AAAA', 21, 15.55, 15.44, 240.09, 50.4189, 'NO', 'NF', 'NO', 'NP', 0),
	(7, 1, 2, 0, 'BBBB', 21, 33.06, 20.04, 662.52, 139.1292, 'NO', 'NF', 'NO', 'NP', 0),
	(8, 1, 3, 0, 'ccccc', 21, 15.66, 10.23, 160.2, 33.64, 'NO', 'NF', 'NO', 'NP', 0),
	(9, 1, 1, 0, 'AAAA', 21, 19.99, 15.44, 308.65, 64.82, 'NO', 'NF', 'NO', 'NP', 0),
	(10, 1, 2, 0, 'BBBB', 21, 33.06, 20.04, 662.52, 139.1292, 'NO', 'NF', 'NO', 'NP', 0),
	(11, 1, 3, 0, 'ccccc', 21, 15.66, 10.23, 160.2, 33.64, 'NO', 'NF', 'NO', 'NP', 0),
	(12, 1, 1, 0, 'AAAA', 21, 19.99, 15.44, 308.65, 64.82, 'NO', 'NF', 'NO', 'NP', 0),
	(13, 1, 2, 0, 'BBBB', 21, 33.06, 20.04, 662.52, 139.1292, 'NO', 'NF', 'NO', 'NP', 0),
	(14, 1, 3, 0, 'ccccc', 21, 15.66, 10.23, 160.2, 33.64, 'NO', 'NF', 'NO', 'NP', 0),
	(15, 1, 1, 0, 'AAAA', 21, 19.99, 15.44, 308.65, 64.82, 'NO', 'NF', 'NO', 'NP', 0),
	(16, 1, 2, 0, 'BBBB', 21, 33.06, 20.04, 662.52, 139.1292, 'NO', 'NF', 'NO', 'NP', 0),
	(17, 1, 3, 0, 'ccccc', 21, 30.01, 10.23, 307, 64.47, 'NO', 'NF', 'NO', 'NP', 0),
	(18, 1, 1, 0, 'AAAA', 21, 19.99, 15.44, 308.65, 64.82, 'NO', 'NF', 'NO', 'NP', 0),
	(19, 1, 2, 0, 'BBBB', 21, 33.06, 20.04, 662.52, 139.1292, 'NO', 'NF', 'NO', 'NP', 0),
	(20, 1, 3, 0, 'ccccc', 21, 30.01, 10.23, 307, 64.47, 'NO', 'NF', 'NO', 'NP', 0),
	(21, 1, 1, 0, 'AAAA', 21, 19.99, 15.44, 308.65, 64.82, 'NO', 'NF', 'NO', 'NP', 0),
	(22, 1, 2, 0, 'BBBB', 21, 33.06, 20.04, 662.52, 139.1292, 'NO', 'NF', 'NO', 'NP', 0),
	(23, 1, 3, 0, 'ccccc', 21, 30.01, 10.23, 307, 64.47, 'NO', 'NF', 'NO', 'NP', 0),
	(24, 1, 4, 0, 'ggggg', 21, 5.66, 455.44, 2577.79, 541.3359, 'NO', 'NF', 'NO', 'NP', 0),
	(25, 1, 1, 0, 'AAAA', 21, 19.99, 15.44, 308.65, 64.82, 'NO', 'NF', 'NO', 'NP', 0),
	(26, 1, 2, 0, 'BBBB', 21, 33.06, 20.04, 662.52, 139.1292, 'NO', 'NF', 'NO', 'NP', 0),
	(27, 1, 3, 0, 'ccccc', 21, 30.01, 10.23, 307, 64.47, 'NO', 'NF', 'NO', 'NP', 0),
	(28, 1, 4, 0, 'ggggg', 21, 5.66, 455.44, 2577.79, 541.3359, 'NO', 'NF', 'NO', 'NP', 0),
	(29, 1, 1, 0, 'AAAA', 21, 19.99, 15.44, 308.65, 64.82, 'NO', 'NF', 'NO', 'NP', 0),
	(30, 1, 2, 0, 'BBBB', 21, 33.06, 20.04, 662.52, 139.13, 'NO', 'NF', 'NO', 'NP', 0),
	(31, 1, 3, 0, 'ccccc', 21, 30.01, 10.23, 307, 64.47, 'NO', 'NF', 'NO', 'NP', 0),
	(32, 1, 4, 0, 'ggggg', 21, 5.66, 455.44, 2577.79, 541.34, 'NO', 'NF', 'NO', 'NP', 0),
	(33, 2, 1, 0, 'lechugas', 21, 22, 0.55, 12.1, 2.54, 'NO', 'NF', 'NO', 'NP', 1),
	(34, 2, 2, 0, 'tomates', 21, 44, 0.88, 38.72, 8.13, 'NO', 'NF', 'NO', 'NP', 1),
	(35, 3, 1, 0, 'gghkghk', 21, 10.11, 9.55, 96.55, 20.28, 'NO', 'NF', 'NO', 'NP', 0),
	(36, 3, 2, 0, 'kljkllk lhl lhl', 21, 63.22, 12.44, 786.46, 165.16, 'NO', 'NF', 'NO', 'NP', 0),
	(37, 3, 1, 0, 'gghkghk', 21, 10.11, 9.55, 96.55, 20.28, 'NO', 'NF', 'NO', 'NP', 0),
	(38, 3, 2, 0, 'kljkllk lhl lhl', 21, 23.55, 12.44, 292.96, 61.52, 'NO', 'NF', 'NO', 'NP', 0),
	(39, 1, 1, 0, 'AAAA', 21, 19.99, 15.44, 308.65, 64.82, 'NO', 'NF', 'NO', 'NP', 0),
	(40, 1, 2, 0, 'BBBB', 21, 33.06, 20.04, 662.52, 139.13, 'NO', 'NF', 'NO', 'NP', 0),
	(41, 1, 3, 0, 'ccccc', 21, 30.01, 10.23, 307, 64.47, 'NO', 'NF', 'NO', 'NP', 0),
	(42, 1, 1, 0, 'AAAA', 21, 19.99, 15.44, 308.65, 64.82, 'NO', 'NF', 'NO', 'NP', 1),
	(43, 1, 2, 0, 'BBBB', 21, 33.06, 20.04, 662.52, 139.13, 'NO', 'NF', 'NO', 'NP', 1),
	(44, 1, 3, 0, 'ccccc', 21, 17.76, 10.23, 181.68, 38.15, 'NO', 'NF', 'NO', 'NP', 1),
	(45, 4, 1, 0, 'ljlkj', 21, 100, 5.44, 544, 114.24, 'NO', 'NF', 'NO', 'NP', 0),
	(46, 4, 1, 0, 'ljlkj', 21, 100, 5.44, 544, 114.24, 'NO', 'NF', 'NO', 'NP', 0),
	(47, 4, 2, 3, 'sdfsfsfsdfsf', 21, 16.55, 32.11, 531.42, 111.6, 'NO', 'NF', 'NO', 'NP', 0),
	(48, 4, 1, 0, 'ljlkj', 21, 100, 5.44, 544, 114.24, 'NO', 'NF', 'NO', 'NP', 0),
	(49, 4, 2, 0, 'sdfsfsfsdfsf', 21, 19.11, 32.11, 613.62, 128.86, 'NO', 'NF', 'NO', 'NP', 0),
	(50, 4, 1, 0, 'ljlkj', 21, 100, 5.44, 544, 114.24, 'NO', 'NF', 'NO', 'NP', 0),
	(51, 4, 2, 2, 'sdfsfsfsdfsf', 21, 20.03, 32.11, 643.16, 135.06, 'NO', 'NF', 'NO', 'NP', 0),
	(52, 4, 1, 0, 'ljlkj', 21, 100, 5.44, 544, 114.24, 'NO', 'NF', 'NO', 'NP', 0),
	(53, 4, 2, 2, 'sdfsfsfsdfsf', 21, 18.88, 32.11, 606.24, 127.31, 'NO', 'NF', 'NO', 'NP', 0),
	(54, 3, 1, 0, 'gghkghk', 21, 10.11, 9.55, 96.55, 20.28, 'NO', 'NF', 'NO', 'NP', 0),
	(55, 3, 2, 0, 'kljkllk lhl lhl', 21, 23.55, 12.44, 292.96, 61.52, 'NO', 'NF', 'NO', 'NP', 0),
	(56, 3, 3, 0, '', 21, 0, 0, 0, 0, 'NO', 'NF', 'NO', 'NP', 0),
	(57, 3, 1, 0, 'gghkghk', 21, 10.11, 9.55, 96.55, 20.28, 'NO', 'NF', 'NO', 'NP', 0),
	(58, 3, 2, 0, 'kljkllk lhl lhl', 21, 23.55, 12.44, 292.96, 61.52, 'NO', 'NF', 'NO', 'NP', 0),
	(59, 3, 3, 0, '', 21, 0, 0, 0, 0, 'NO', 'NF', 'NO', 'NP', 0),
	(60, 3, 1, 0, 'gghkghk', 21, 10.11, 9.55, 96.55, 20.28, 'NO', 'NF', 'NO', 'NP', 0),
	(61, 3, 2, 0, 'kljkllk lhl lhl', 21, 23.55, 12.44, 292.96, 61.52, 'NO', 'NF', 'NO', 'NP', 0),
	(62, 3, 3, 0, 'ggggggg', 10, 12.25, 15.48, 189.63, 18.96, 'NO', 'NF', 'NO', 'NP', 0),
	(63, 5, 1, 0, 'afas dfas f asdf ', 21, 45.11, 12.44, 561.17, 117.85, 'NO', 'NF', 'NO', 'NP', 0),
	(64, 4, 1, 0, 'ljlkj', 21, 100, 5.44, 544, 114.24, 'NO', 'NF', 'NO', 'NP', 1),
	(65, 4, 2, 2, 'sdfsfsfsdfsf', 21, 205.44, 32.11, 6596.68, 1385.3, 'NO', 'NF', 'NO', 'NP', 1),
	(66, 5, 1, 0, 'afas dfas f asdf ', 21, 45.11, 12.44, 561.17, 117.85, 'NO', 'NF', 'NO', 'NP', 0),
	(67, 5, 2, 0, '', 21, 0, 0, 153.44, 32.22, 'NO', 'NF', 'NO', 'NP', 0),
	(68, 5, 1, 0, 'afas dfas f asdf ', 21, 45.11, 12.44, 561.17, 117.85, 'NO', 'NF', 'NO', 'NP', 0),
	(69, 5, 2, 0, 'gsdfgsdfgsdg', 21, 0, 0, 153.44, 32.22, 'NO', 'NF', 'NO', 'NP', 0),
	(70, 5, 1, 0, 'afas dfas f asdf ', 21, 45.11, 12.44, 561.17, 117.85, 'NO', 'NF', 'NO', 'NP', 0),
	(71, 5, 2, 0, 'gsdfgsdfgsdg', 21, 0, 0, 153.44, 32.22, 'NO', 'NF', 'NO', 'NP', 0),
	(72, 5, 3, 0, 'rellena esto, cachondo', 21, 0, 0, 909.54, 191, 'NO', 'NF', 'NO', 'NP', 0),
	(73, 5, 1, 0, 'afas dfas f asdf ', 21, 45.11, 12.44, 561.17, 117.85, 'NO', 'NF', 'NO', 'NP', 1),
	(74, 5, 2, 0, 'gsdfgsdfgsdg', 21, 0, 0, 153.44, 32.22, 'NO', 'NF', 'NO', 'NP', 1),
	(75, 5, 3, 0, 'rellena esto, cachondo', 21, 0, 0, 1254.77, 263.5, 'NO', 'NF', 'NO', 'NP', 1),
	(76, 3, 1, 0, 'gghkghk', 21, 10.11, 9.55, 96.55, 20.28, 'NO', 'NF', 'NO', 'NP', 1),
	(77, 3, 2, 0, 'kljkllk lhl lhl', 21, 23.55, 12.44, 292.96, 61.52, 'NO', 'NF', 'NO', 'NP', 1),
	(78, 3, 3, 0, 'ggggggg', 10, 12.25, 15.48, 189.63, 18.96, 'NO', 'NF', 'NO', 'NP', 1),
	(79, 3, 4, 0, 'dafdf', 21, 5, 55.44, 277.2, 58.21, 'NO', 'NF', 'NO', 'NP', 1);
/*!40000 ALTER TABLE `presupuestosdetalle` ENABLE KEYS */;

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
