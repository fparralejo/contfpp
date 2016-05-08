-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.0.17-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.5075
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.articulos: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT IGNORE INTO `articulos` (`IdArticulo`, `Referencia`, `Descripcion`, `Precio`, `tipoIVA`, `Borrado`, `fecha`) VALUES
	(1, 'R001', 'Ventana completa', 320, 21, 1, '2016-04-24 08:34:23'),
	(2, 'R002', 'Puerta Completa', 250, 21, 1, '2016-04-24 08:34:41'),
	(3, 'R003', 'Persiana m2', 50, 21, 1, '2016-04-24 08:35:07'),
	(4, 'R004', 'Frente Armario 2 puertas', 315.44, 10, 1, '2016-04-24 08:35:33'),
	(5, 'R005', 'Mampara baño 90x90', 550, 4, 1, '2016-04-24 08:36:12');
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
	(1, 'Juan', 'Morales', '616005522', NULL, NULL, NULL, 'sdf65654', 'asdf asdf', NULL, NULL, NULL, NULL, 1, '2016-03-24 00:00:00', 'C'),
	(2, 'Luisa', 'Lopez Araujo2', '915636547', 'aaaa@eeee.es', 'hola, me llamo lola y me gustan las pastillas juanolas', 'sdfgsdfgsd', '7788536L', 'asdf asdf', '', '', '', '', 1, '2016-03-24 00:00:00', 'P'),
	(3, 'Alfonso', 'Perez', '902525636', 'fparralejo@gmail.com', 'asdf as dfasdf asldfalsdf t y tyu uy k dh', 'Autonomo 2', '5665dfsdf226', 'asdf asdf', '', '', '', '', 1, '2016-03-25 20:56:48', 'C'),
	(4, 'Alejandra', 'Fuertes Robles', '671108309', 'escombro@yahoo.es', ' gsdfg sdfg sdfg sdg sdg ', 'fgsdg', '5632654', 'Calle Badajoz 28 Bajo 1', 'Alcorcón', '28921', 'Madrid', 'transferencia', 1, '2016-03-25 21:13:24', 'C'),
	(5, 'Francisco Parralejo', '', '671108309', 'fparralejo1970@yahoo.es', '', 'parraspider 9', 'sfsd6545', 'Calle Badajoz 28 Bajo 1', 'Alcorcón', '2', 'Madrid', '', 1, '2016-03-25 22:27:34', 'C'),
	(6, 'Douglas', 'Mortimer el malo', 'qq', 'fparralejo1991@gmail.com', 'dfasasf asdf asdf', 'asdf asf', 'asdf asdf', 'asdf asdf', 'asdf asdf', 'sdf a', 'asdf asf', 'recibo', 1, '2016-03-26 11:10:48', 'C'),
	(7, 'Parraspider', 'Fulanez', '671108309', 'escombro@yahoo.es', '', 'ESCOMBRO SL', '08037049K', 'Calle Badajoz 28 Bajo 1', 'asdfasdf', '28921', 'Madrid', 'talon', 1, '2016-03-26 11:46:16', 'P'),
	(8, 'Lucas', 'Alcaraz Lopez', '915663344', 'aaa@wwww.es', 'menudo montón de escombro', 'Panolis SL', 'B12356478', 'Calle del Cerro Porto', 'Getafe', '28454', 'Madrid', 'recibo', 1, '2016-03-27 07:27:07', 'C'),
	(9, 'Sorin', 'Pantoriou', '915652233', 'sorin@help.me', 'rumanoide de los cojones', '', '', 'calle amapola 22', '', '', '', 'recibo', 1, '2016-03-31 16:45:41', 'P'),
	(10, 'Mª Sonia', 'Abajo', '902525666', 's.abajo@typsa.nd', 'fgsdfg sdfg sdgsdg', 'TYPSA', '888888888KKKK', 'calle amapola 22', '', '', '', '', 1, '2016-03-31 16:50:14', 'C'),
	(11, 'irene', 'Fuertes', '671108309', 'eeee@eeee.es', 'asdfasdfasdf', '', 'dfgsdfg', 'calle raimundio lulio 9', '', '', '', '', 1, '2016-03-31 17:34:09', 'C'),
	(12, 'aaa 2', 'aaaaa', 'aaaaa', 'aaaa@aaa.aa', 'aaa a a aa a aaaaaa a aa', 'aaaaa', 'aaaaaa', 'aaaaa', 'aaaa', 'aaa', 'aaaa', 'transferencia', 0, '2016-03-31 17:34:38', 'C'),
	(13, 'gustavo', 'arencibia', '962356988', 'eeell@ffffeee.es', 'Rossi terminó segundo en Termas de Río Hondo tras el fallo garrafal de Iannone, que se llevó por delante a Dovizioso. Pedrosa cerró el podio.', '', '8888888', 'calle amapola 22', '', '', '', '', 1, '2016-04-03 17:49:59', 'P'),
	(14, 'Andrea', 'Nocioni', '963256987', 'fparralejo1970@yahoo.es', '', '', '7777777L', 'Badajoz', 'Alcorcón', '28921', 'Madrid', '', 1, '2016-04-03 20:40:32', 'C'),
	(15, 'Sofia', 'Loren', '965658784L', '', '', '', '22222222N', 'calle raimundio lulio 9', '', '', '', 'talon', 1, '2016-04-03 20:51:47', 'C'),
	(16, 'Gustavo', 'Cifuentes', '99988877', '', 'dsfa fasdf asfasf ', '', '44444444G', 'calle raimundio lulio 9', '', '', '', 'contado', 0, '2016-04-03 20:52:24', 'P'),
	(17, 'Steve', 'Winwood', '95623659', 'winwood@www.ww', 'roll with it', '', '3333333F', 'calle raimundio lulio 9', 'madrid', '28555', 'Madrid', 'transferencia', 1, '2016-04-03 20:54:39', 'P'),
	(18, 'Anacleto', 'Lopecillo', '777888444K', 'eee@eee.es', 'sdf sfasdasdfasfasf ', 'Lucas Alcaraz', 'opoiuytr', 'calle amapola 22', 'Brunete', '28525', 'Madrid', 'recibo', 1, '2016-04-03 21:00:45', 'P');
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

-- Volcando estructura para tabla contfpp_empresa1.pedidos
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `IdPedido` int(11) NOT NULL AUTO_INCREMENT,
  `NumPedido` varchar(50) NOT NULL,
  `IdCliente` varchar(15) NOT NULL,
  `IdPresupuesto` varchar(11) DEFAULT NULL,
  `FechaPedido` datetime NOT NULL,
  `FechaVtoPedido` datetime NOT NULL,
  `FormaPago` varchar(50) DEFAULT NULL,
  `Estado` varchar(15) DEFAULT NULL COMMENT 'Aceptado, Cancelado',
  `Retencion` double DEFAULT '0',
  `Borrado` int(11) DEFAULT '1' COMMENT '1=Activo, 0=Borrado',
  `TipoFactura` varchar(20) DEFAULT 'Periodica' COMMENT 'Periodica, Puntual',
  `FrecuenciaPeriodica` int(10) DEFAULT '1' COMMENT 'Meses',
  `FechaProximaFacturaPeriodica` datetime DEFAULT NULL COMMENT 'Si esta null o 0000-00... , es que ya esta(n) generada(s) las facturas y terminado este pedido',
  `BaseImponible` double DEFAULT '0',
  `Cuota` double DEFAULT '0',
  `CuotaRetencion` double DEFAULT '0' COMMENT 'Cuota IRPF',
  `total` double DEFAULT '0',
  `Facturada` varchar(10) DEFAULT 'NF' COMMENT 'T=Total, P=Parcial, NF=No Facturada',
  PRIMARY KEY (`IdPedido`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.pedidos: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT IGNORE INTO `pedidos` (`IdPedido`, `NumPedido`, `IdCliente`, `IdPresupuesto`, `FechaPedido`, `FechaVtoPedido`, `FormaPago`, `Estado`, `Retencion`, `Borrado`, `TipoFactura`, `FrecuenciaPeriodica`, `FechaProximaFacturaPeriodica`, `BaseImponible`, `Cuota`, `CuotaRetencion`, `total`, `Facturada`) VALUES
	(1, '20161', '4', '2', '2016-04-22 10:09:42', '2016-06-22 10:09:42', 'Transferencia', 'Aceptado', 15, 1, 'Periodica', 1, '2016-05-01 10:09:42', 2047.81, 430.04, 307.17, 2170.68, 'NF'),
	(2, '20162', '3', NULL, '2016-04-24 00:00:00', '2016-06-24 00:00:00', NULL, 'Cancelado', 0, 1, 'Puntual', 1, '0000-00-00 00:00:00', 1000, 100, 0, 1100, 'NF'),
	(3, '20163', '5', '', '2016-05-01 11:08:23', '2017-05-01 11:08:23', 'Talon', 'Aceptado', 15, 1, 'Periodica', 1, '2016-05-10 11:08:23', 640, 134.4, 96, 678.4, 'NF'),
	(4, '20164', '3', '', '2016-05-01 19:40:52', '2017-05-01 19:40:52', '', 'Cancelado', 15, 1, 'Periodica', 2, '2016-05-07 19:40:52', 1691, 355.11, 253.65, 1792.46, 'NF'),
	(5, '20165', '3', '', '2016-05-02 08:13:27', '2016-05-02 08:13:27', '', 'Aceptado', 15, 0, 'Periodica', 2, '2016-05-07 19:40:52', 1691, 355.11, 253.65, 1792.46, 'NF'),
	(6, '20165', '4', '', '2016-05-02 06:24:49', '2016-05-02 06:24:49', '', 'Aceptado', 15, 1, 'Puntual', 0, '2016-05-02 06:24:49', 4050, 289.5, 607.5, 3732, 'NF'),
	(7, '20166', '11', '1', '2016-04-20 19:17:42', '2016-04-20 19:17:42', 'Talon', 'Aceptado', 15, 1, 'Puntual', 0, '2016-04-20 19:17:42', 12254.02, 2573.35, 1838.1, 12989.27, 'NF'),
	(8, '20167', '5', '3', '2016-04-24 10:04:48', '2016-04-24 10:04:48', 'Talon', 'Aceptado', 15, 1, 'Puntual', 0, '2016-04-24 10:04:48', 1843.07, 387.04, 276.46, 1953.65, 'NF'),
	(9, '20168', '5', '3', '2016-04-24 10:48:54', '2016-04-24 10:48:54', 'Talon', 'Aceptado', 15, 1, 'Puntual', 0, '2016-04-24 10:48:54', 21439.05, 2212.1, 3215.86, 20435.29, 'NF'),
	(10, '20169', '5', '5', '2016-05-08 10:37:51', '2016-05-08 10:37:51', '', 'Aceptado', 15, 1, 'Puntual', 0, '2016-05-08 10:37:51', 4522.28, 397.88, 678.34, 4241.82, 'NF'),
	(11, '201610', '5', '5', '2016-05-08 10:58:35', '2016-05-08 10:58:35', '', 'Aceptado', 15, 1, 'Puntual', 0, '2016-05-08 10:58:35', 642.33, 91.33, 96.35, 637.31, 'NF'),
	(12, '201611', '5', '5', '2016-05-08 11:01:08', '2016-05-08 11:01:08', '', 'Aceptado', 15, 1, 'Puntual', 0, '2016-05-08 11:01:08', 249.6, 52.42, 37.44, 264.58, 'NF'),
	(13, '201612', '1', '7', '2016-05-08 17:49:15', '2016-05-08 17:49:15', 'Contado', 'Aceptado', 15, 1, 'Puntual', 0, '2016-05-08 17:49:15', 12610, 2648.1, 1891.5, 13366.6, 'NF'),
	(14, '201613', '1', '7', '2016-05-08 17:47:43', '2016-05-08 17:47:43', 'Contado', 'Aceptado', 15, 1, 'Puntual', 0, '2016-05-08 17:47:43', 2860, 600.6, 429, 3031.6, 'NF'),
	(15, '201614', '1', '7', '2016-05-08 17:48:15', '2016-05-08 17:48:15', 'Contado', 'Aceptado', 15, 1, 'Puntual', 0, '2016-05-08 17:48:15', 5000, 1050, 750, 5300, 'NF'),
	(16, '201615', '1', '7', '2016-05-08 17:49:28', '2016-05-08 17:49:28', 'Contado', 'Aceptado', 15, 1, 'Puntual', 0, '2016-05-08 17:49:28', 4890, 1026.9, 733.5, 5183.4, 'NF');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla contfpp_empresa1.pedidosdetalle
DROP TABLE IF EXISTS `pedidosdetalle`;
CREATE TABLE IF NOT EXISTS `pedidosdetalle` (
  `IdPedidoDetalle` int(11) NOT NULL AUTO_INCREMENT,
  `IdPedido` int(11) NOT NULL,
  `NumLineaPedido` int(11) NOT NULL,
  `IdPresupuesto` int(11) NOT NULL,
  `NumLineaPresup` int(11) NOT NULL,
  `IdArticulo` int(11) DEFAULT NULL,
  `DescripcionProducto` longtext,
  `TipoIVA` double DEFAULT NULL,
  `Cantidad` double DEFAULT NULL,
  `ImporteUnidad` double DEFAULT NULL COMMENT 'Importe Unidad',
  `Importe` double DEFAULT NULL,
  `CuotaIva` double DEFAULT NULL,
  `Borrado` int(5) NOT NULL DEFAULT '1' COMMENT '1=Valido, 0= Borrado',
  PRIMARY KEY (`IdPedidoDetalle`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.pedidosdetalle: ~50 rows (aproximadamente)
/*!40000 ALTER TABLE `pedidosdetalle` DISABLE KEYS */;
INSERT IGNORE INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(1, 1, 1, 2, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 0),
	(2, 1, 2, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 0),
	(3, 2, 1, 0, 0, 0, 'escombro mix', 10, 10, 100, 1000, 100, 1),
	(4, 1, 1, 2, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 0),
	(5, 1, 2, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 0),
	(6, 1, 3, 0, 0, 1, 'Ventana completa', 21, 3.11, 320, 995.2, 208.99, 0),
	(7, 1, 1, 2, 1, 0, 'asdfsdf df', 21, 4.11, 55.44, 227.86, 47.85, 0),
	(8, 1, 2, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 7.44, 96.87, 720.71, 151.35, 0),
	(9, 1, 3, 0, 0, 1, 'Ventana completa', 21, 2.55, 320, 816, 171.36, 0),
	(10, 1, 1, 2, 1, 0, 'asdfsdf df', 21, 4.11, 55.44, 227.86, 47.85, 0),
	(11, 1, 2, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 7.44, 96.87, 720.71, 151.35, 0),
	(12, 1, 3, 0, 0, 1, 'Ventana completa', 21, 3.98, 320, 1273.6, 267.46, 0),
	(13, 1, 1, 2, 1, 0, 'asdfsdf df', 21, 4.11, 55.44, 227.86, 47.85, 0),
	(14, 1, 2, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 5.64, 96.87, 546.35, 114.73, 0),
	(15, 1, 3, 0, 0, 1, 'Ventana completa', 21, 3.98, 320, 1273.6, 267.46, 0),
	(16, 1, 1, 2, 1, 0, 'asdfsdf df', 21, 4.11, 55.44, 227.86, 47.85, 1),
	(17, 1, 2, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 5.64, 96.87, 546.35, 114.73, 1),
	(18, 1, 3, 0, 0, 1, 'Ventana completa', 21, 3.98, 320, 1273.6, 267.46, 1),
	(19, 3, 1, 0, 0, 1, 'Ventana completa', 21, 2, 320, 640, 134.4, 1),
	(20, 4, 1, 0, 0, 1, 'Ventana completa', 21, 2, 320, 640, 134.4, 0),
	(21, 4, 1, 0, 0, 1, 'Ventana completa', 21, 3.55, 320, 1136, 238.56, 1),
	(22, 4, 2, 0, 0, 2, 'Puerta Completa', 21, 2.22, 250, 555, 116.55, 1),
	(23, 5, 1, 0, 0, 1, 'Ventana completa', 21, 3.55, 320, 1136, 238.56, 0),
	(24, 5, 2, 0, 0, 2, 'Puerta Completa', 21, 2.22, 250, 555, 116.55, 0),
	(25, 6, 1, 0, 0, 2, 'Puerta Completa', 21, 3, 250, 750, 157.5, 1),
	(26, 6, 2, 0, 0, 5, 'Mampara baño 90x90', 4, 6, 550, 3300, 132, 1),
	(27, 7, 1, 1, 1, 0, 'asdasfasdf ', 21, 77.55, 45.88, 3557.99, 747.18, 1),
	(28, 7, 2, 1, 2, 0, 'aaaaaaa aaaaa aaaa', 21, 16.55, 525.44, 8696.03, 1826.17, 1),
	(29, 8, 1, 3, 1, 1, 'Ventana completa', 21, 6.55, 320, 2096, 440.16, 0),
	(30, 8, 2, 3, 2, 0, 'alforjas de escomro', 21, 7, 52.44, 367.08, 77.09, 0),
	(31, 8, 1, 3, 1, 1, 'Ventana completa', 21, 5.05, 320, 1616, 339.36, 1),
	(32, 8, 2, 3, 2, 0, 'alforjas de escomro', 21, 4.33, 52.44, 227.07, 47.68, 1),
	(33, 9, 1, 3, 1, 1, 'Ventana completa', 21, 1.5, 320, 480, 100.8, 1),
	(34, 9, 2, 3, 2, 0, 'alforjas de escomro', 21, 2.67, 52.44, 140.01, 29.4, 1),
	(35, 9, 3, 3, 3, 4, 'Frente Armario 2 puertas', 10, 66, 315.44, 20819.04, 2081.9, 1),
	(36, 10, 1, 5, 1, 1, 'Ventana completa', 21, 3.55, 320, 1136, 238.56, 0),
	(37, 10, 2, 5, 2, 0, 'aluminios', 10, 4.55, 255.44, 1162.25, 116.22, 0),
	(38, 10, 3, 5, 3, 3, 'Persiana m2', 21, 0, 0, 365.96, 76.85, 0),
	(39, 10, 4, 5, 4, 5, 'Mampara baño 90x90', 4, 5, 550, 2750, 110, 0),
	(40, 10, 1, 5, 1, 1, 'Ventana completa', 21, 2, 320, 640, 134.4, 1),
	(41, 10, 2, 5, 2, 0, 'aluminios', 10, 3, 255.44, 766.32, 76.63, 1),
	(42, 10, 3, 5, 3, 3, 'Persiana m2', 21, 0, 0, 365.96, 76.85, 1),
	(43, 10, 4, 5, 4, 5, 'Mampara baño 90x90', 4, 5, 550, 2750, 110, 1),
	(44, 11, 1, 5, 1, 1, 'Ventana completa', 21, 1.55, 320, 496, 104.16, 0),
	(45, 11, 2, 5, 2, 0, 'aluminios', 10, 1.55, 255.44, 395.93, 39.59, 0),
	(46, 11, 1, 5, 1, 1, 'Ventana completa', 21, 0.77, 320, 246.4, 51.74, 1),
	(47, 11, 2, 5, 2, 0, 'aluminios', 10, 1.55, 255.44, 395.93, 39.59, 1),
	(48, 12, 1, 5, 1, 1, 'Ventana completa', 21, 0.78, 320, 249.6, 52.42, 1),
	(49, 13, 1, 7, 1, 2, 'Puerta Completa', 21, 101.44, 250, 25360, 5325.6, 0),
	(50, 13, 1, 7, 1, 2, 'Puerta Completa', 21, 103, 250, 25750, 5407.5, 0),
	(51, 13, 1, 7, 1, 2, 'Puerta Completa', 21, 104, 250, 26000, 5460, 0),
	(52, 13, 1, 7, 1, 2, 'Puerta Completa', 21, 103, 250, 25750, 5407.5, 0),
	(53, 13, 1, 7, 1, 2, 'Puerta Completa', 21, 90, 250, 22500, 4725, 0),
	(54, 14, 1, 7, 1, 2, 'Puerta Completa', 21, 11.44, 250, 2860, 600.6, 1),
	(55, 13, 1, 7, 1, 2, 'Puerta Completa', 21, 70, 250, 17500, 3675, 0),
	(56, 15, 1, 7, 1, 2, 'Puerta Completa', 21, 20, 250, 5000, 1050, 1),
	(57, 13, 1, 7, 1, 2, 'Puerta Completa', 21, 80, 250, 20000, 4200, 0),
	(58, 13, 1, 7, 1, 2, 'Puerta Completa', 21, 50.44, 250, 12610, 2648.1, 1),
	(59, 16, 1, 7, 1, 2, 'Puerta Completa', 21, 19.56, 250, 4890, 1026.9, 1);
/*!40000 ALTER TABLE `pedidosdetalle` ENABLE KEYS */;

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
  `Retencion` double DEFAULT '0' COMMENT '% IRPF',
  `Proforma` varchar(10) DEFAULT 'NO' COMMENT '1=SI, 0=NO',
  `Borrado` int(11) DEFAULT '1' COMMENT '1=Activo, 0=Borrado',
  `BaseImponible` double DEFAULT '0',
  `Cuota` double DEFAULT '0',
  `CuotaRetencion` double DEFAULT '0' COMMENT 'Cuota IRPF',
  `total` double DEFAULT '0',
  `Facturada` varchar(10) DEFAULT 'NF' COMMENT 'T=Total, P=Parcial, NF=No Facturada',
  `Pedido` varchar(10) DEFAULT 'NP' COMMENT 'T=Total, P=Parcial, NP=No Pedida',
  PRIMARY KEY (`IdPresupuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.presupuestos: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuestos` DISABLE KEYS */;
INSERT IGNORE INTO `presupuestos` (`IdPresupuesto`, `NumPresupuesto`, `IdCliente`, `FechaPresupuesto`, `FechaVtoPresupuesto`, `FormaPago`, `FechaFinalizacion`, `Estado`, `Retencion`, `Proforma`, `Borrado`, `BaseImponible`, `Cuota`, `CuotaRetencion`, `total`, `Facturada`, `Pedido`) VALUES
	(1, '20161', '11', '2016-04-20 19:49:57', '2016-04-20 19:49:57', 'Talon', NULL, 'Aceptado', 15, '', 1, 12254.02, 2573.35, 1838.1, 12989.27, 'NF', 'T'),
	(2, '20162', '4', '2016-04-23 08:33:41', '2016-04-23 08:33:41', 'Pagare', NULL, 'Aceptado', 15, 'NO', 1, 419.44, 88.08, 62.92, 444.6, 'NF', 'NP'),
	(3, '20163', '5', '2016-04-24 20:51:04', '2016-04-24 20:51:04', 'Talon', NULL, 'Aceptado', 15, 'NO', 1, 23282.12, 2599.15, 3492.32, 22388.95, 'NF', 'T'),
	(4, '20164', '4', '2016-04-25 20:52:51', '2016-04-25 20:52:51', 'Pagare', NULL, 'Aceptado', 15, 'NO', 1, 1414.64, 297.07, 212.2, 1499.51, 'NF', 'NP'),
	(5, '20165', '5', '2016-05-08 09:21:04', '2016-05-08 09:21:04', '', NULL, 'Aceptado', 15, 'NO', 1, 5414.21, 541.63, 812.13, 5143.71, 'NF', 'T'),
	(6, '20166', '14', '2016-05-08 11:02:37', '2016-05-08 11:02:37', 'Recibo', NULL, 'Pendiente', 15, 'NO', 1, 3083.1, 481.94, 462.46, 3102.58, 'NF', 'NP'),
	(7, '20167', '1', '2016-05-08 11:02:56', '2016-05-08 11:02:56', 'Contado', NULL, 'Aceptado', 15, 'NO', 1, 25360, 5325.6, 3804, 26881.6, 'NF', 'T'),
	(8, '20168', '3', '2016-05-08 11:03:53', '2016-05-08 11:03:53', 'Transferencia', NULL, 'Pendiente', 15, 'NO', 1, 298.77, 29.88, 44.82, 283.83, 'NF', 'NP'),
	(9, '20169', '10', '2016-05-08 11:04:22', '2016-05-08 11:04:22', 'Contado', NULL, 'Pendiente', 15, 'NO', 1, 954.37, 111.94, 143.16, 923.15, 'NF', 'NP'),
	(10, '201610', '8', '2016-05-08 11:05:03', '2016-05-08 11:05:03', 'Recibo', NULL, 'Pendiente', 15, 'NO', 1, 867.5, 182.18, 130.13, 919.55, 'NF', 'NP');
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
  `Borrado` int(5) NOT NULL DEFAULT '1' COMMENT '1=Valido, 0= Borrado',
  PRIMARY KEY (`IdPresupDetalle`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.presupuestosdetalle: ~49 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuestosdetalle` DISABLE KEYS */;
INSERT IGNORE INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(1, 1, 1, 0, 'asdasfasdf ', 21, 77.55, 45.88, 3557.99, 747.18, 0),
	(2, 1, 1, 0, 'asdasfasdf ', 21, 77.55, 45.88, 3557.99, 747.18, 0),
	(3, 1, 1, 0, 'asdasfasdf ', 21, 77.55, 45.88, 3557.99, 747.18, 0),
	(4, 1, 1, 0, 'asdasfasdf ', 21, 77.55, 45.88, 3557.99, 747.18, 0),
	(5, 1, 2, 0, 'aaaaaaa aaaaa aaaa', 21, 16.55, 525.44, 8696.03, 1826.17, 0),
	(6, 2, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 0),
	(7, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 0),
	(8, 3, 1, 1, 'Ventana completa', 21, 6.55, 320, 2096, 440.16, 0),
	(9, 3, 2, 0, 'alforjas de escomro', 21, 7, 52.44, 367.08, 77.09, 0),
	(10, 3, 1, 1, 'Ventana completa', 21, 6.55, 320, 2096, 440.16, 0),
	(11, 3, 2, 0, 'alforjas de escomro', 21, 7, 52.44, 367.08, 77.09, 0),
	(12, 3, 3, 4, 'Frente Armario 2 puertas', 10, 66, 315.44, 20819.04, 2081.9, 0),
	(13, 4, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 0),
	(14, 4, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 0),
	(15, 4, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 0),
	(16, 4, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 0),
	(17, 4, 3, 1, 'Ventana completa', 21, 3.11, 320, 995.2, 208.99, 0),
	(18, 3, 1, 1, 'Ventana completa', 21, 6.55, 320, 2096, 440.16, 0),
	(19, 3, 2, 0, 'alforjas de escomro', 21, 7, 52.44, 367.08, 77.09, 0),
	(20, 3, 3, 4, 'Frente Armario 2 puertas', 10, 66, 315.44, 20819.04, 2081.9, 0),
	(21, 3, 1, 1, 'Ventana completa', 21, 6.55, 320, 2096, 440.16, 0),
	(22, 3, 2, 0, 'alforjas de escomro', 21, 7, 52.44, 367.08, 77.09, 0),
	(23, 3, 3, 4, 'Frente Armario 2 puertas', 10, 66, 315.44, 20819.04, 2081.9, 0),
	(24, 2, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 1),
	(25, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 1),
	(26, 1, 1, 0, 'asdasfasdf ', 21, 77.55, 45.88, 3557.99, 747.18, 0),
	(27, 1, 2, 0, 'aaaaaaa aaaaa aaaa', 21, 16.55, 525.44, 8696.03, 1826.17, 0),
	(28, 1, 1, 0, 'asdasfasdf ', 21, 77.55, 45.88, 3557.99, 747.18, 0),
	(29, 1, 2, 0, 'aaaaaaa aaaaa aaaa', 21, 16.55, 525.44, 8696.03, 1826.17, 0),
	(30, 1, 1, 0, 'asdasfasdf ', 21, 77.55, 45.88, 3557.99, 747.18, 1),
	(31, 1, 2, 0, 'aaaaaaa aaaaa aaaa', 21, 16.55, 525.44, 8696.03, 1826.17, 1),
	(32, 3, 1, 1, 'Ventana completa', 21, 6.55, 320, 2096, 440.16, 1),
	(33, 3, 2, 0, 'alforjas de escomro', 21, 7, 52.44, 367.08, 77.09, 1),
	(34, 3, 3, 4, 'Frente Armario 2 puertas', 10, 66, 315.44, 20819.04, 2081.9, 1),
	(35, 4, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 1),
	(36, 4, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 1),
	(37, 4, 3, 1, 'Ventana completa', 21, 3.11, 320, 995.2, 208.99, 1),
	(38, 5, 1, 1, 'Ventana completa', 21, 3.55, 320, 1136, 238.56, 1),
	(39, 5, 2, 0, 'aluminios', 10, 4.55, 255.44, 1162.25, 116.22, 1),
	(40, 5, 3, 3, 'Persiana m2', 21, 0, 0, 365.96, 76.85, 1),
	(41, 5, 4, 5, 'Mampara baño 90x90', 4, 5, 550, 2750, 110, 1),
	(42, 6, 1, 2, 'Puerta Completa', 21, 6.11, 250, 1527.5, 320.77, 1),
	(43, 6, 2, 4, 'Frente Armario 2 puertas', 10, 4.77, 315.44, 1504.65, 150.47, 1),
	(44, 6, 3, 0, 'alambres', 21, 10.44, 4.88, 50.95, 10.7, 1),
	(45, 7, 1, 2, 'Puerta Completa', 21, 101.44, 250, 25360, 5325.6, 1),
	(46, 8, 1, 0, 'barril de cerveza', 10, 0, 0, 298.77, 29.88, 1),
	(47, 9, 1, 4, 'Frente Armario 2 puertas', 10, 2.55, 315.44, 804.37, 80.44, 1),
	(48, 9, 2, 0, 'Transporte', 21, 0, 0, 150, 31.5, 1),
	(49, 10, 1, 2, 'Puerta Completa', 21, 3.47, 250, 867.5, 182.18, 1);
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
