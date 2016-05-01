-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.8-MariaDB - mariadb.org binary distribution
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
INSERT INTO `articulos` (`IdArticulo`, `Referencia`, `Descripcion`, `Precio`, `tipoIVA`, `Borrado`, `fecha`) VALUES
	(1, 'R001', 'Ventana completa', 320, 21, 1, '2016-04-24 08:34:23');
INSERT INTO `articulos` (`IdArticulo`, `Referencia`, `Descripcion`, `Precio`, `tipoIVA`, `Borrado`, `fecha`) VALUES
	(2, 'R002', 'Puerta Completa', 250, 21, 1, '2016-04-24 08:34:41');
INSERT INTO `articulos` (`IdArticulo`, `Referencia`, `Descripcion`, `Precio`, `tipoIVA`, `Borrado`, `fecha`) VALUES
	(3, 'R003', 'Persiana m2', 50, 21, 1, '2016-04-24 08:35:07');
INSERT INTO `articulos` (`IdArticulo`, `Referencia`, `Descripcion`, `Precio`, `tipoIVA`, `Borrado`, `fecha`) VALUES
	(4, 'R004', 'Frente Armario 2 puertas', 315.44, 10, 1, '2016-04-24 08:35:33');
INSERT INTO `articulos` (`IdArticulo`, `Referencia`, `Descripcion`, `Precio`, `tipoIVA`, `Borrado`, `fecha`) VALUES
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
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(1, 'Juan', 'Morales', '616005522', NULL, NULL, NULL, 'sdf65654', 'asdf asdf', NULL, NULL, NULL, NULL, 1, '2016-03-24 00:00:00', 'C');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(2, 'Luisa', 'Lopez Araujo2', '915636547', 'aaaa@eeee.es', 'hola, me llamo lola y me gustan las pastillas juanolas', 'sdfgsdfgsd', '7788536L', 'asdf asdf', '', '', '', '', 1, '2016-03-24 00:00:00', 'P');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(3, 'Alfonso', 'Perez', '902525636', 'fparralejo@gmail.com', 'asdf as dfasdf asldfalsdf t y tyu uy k dh', 'Autonomo 2', '5665dfsdf226', 'asdf asdf', '', '', '', '', 1, '2016-03-25 20:56:48', 'C');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(4, 'Alejandra', 'Fuertes Robles', '671108309', 'escombro@yahoo.es', ' gsdfg sdfg sdfg sdg sdg ', 'fgsdg', '5632654', 'Calle Badajoz 28 Bajo 1', 'Alcorcón', '28921', 'Madrid', 'transferencia', 1, '2016-03-25 21:13:24', 'C');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(5, 'Francisco Parralejo', '', '671108309', 'fparralejo1970@yahoo.es', '', 'parraspider 9', 'sfsd6545', 'Calle Badajoz 28 Bajo 1', 'Alcorcón', '2', 'Madrid', '', 1, '2016-03-25 22:27:34', 'C');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(6, 'Douglas', 'Mortimer el malo', 'qq', 'fparralejo1991@gmail.com', 'dfasasf asdf asdf', 'asdf asf', 'asdf asdf', 'asdf asdf', 'asdf asdf', 'sdf a', 'asdf asf', 'recibo', 1, '2016-03-26 11:10:48', 'C');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(7, 'Parraspider', 'Fulanez', '671108309', 'escombro@yahoo.es', '', 'ESCOMBRO SL', '08037049K', 'Calle Badajoz 28 Bajo 1', 'asdfasdf', '28921', 'Madrid', 'talon', 1, '2016-03-26 11:46:16', 'P');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(8, 'Lucas', 'Alcaraz Lopez', '915663344', 'aaa@wwww.es', 'menudo montón de escombro', 'Panolis SL', 'B12356478', 'Calle del Cerro Porto', 'Getafe', '28454', 'Madrid', 'recibo', 1, '2016-03-27 07:27:07', 'C');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(9, 'Sorin', 'Pantoriou', '915652233', 'sorin@help.me', 'rumanoide de los cojones', '', '', 'calle amapola 22', '', '', '', 'recibo', 1, '2016-03-31 16:45:41', 'P');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(10, 'Mª Sonia', 'Abajo', '902525666', 's.abajo@typsa.nd', 'fgsdfg sdfg sdgsdg', 'TYPSA', '888888888KKKK', 'calle amapola 22', '', '', '', '', 1, '2016-03-31 16:50:14', 'C');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(11, 'irene', 'Fuertes', '671108309', 'eeee@eeee.es', 'asdfasdfasdf', '', 'dfgsdfg', 'calle raimundio lulio 9', '', '', '', '', 1, '2016-03-31 17:34:09', 'C');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(12, 'aaa 2', 'aaaaa', 'aaaaa', 'aaaa@aaa.aa', 'aaa a a aa a aaaaaa a aa', 'aaaaa', 'aaaaaa', 'aaaaa', 'aaaa', 'aaa', 'aaaa', 'transferencia', 0, '2016-03-31 17:34:38', 'C');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(13, 'gustavo', 'arencibia', '962356988', 'eeell@ffffeee.es', 'Rossi terminó segundo en Termas de Río Hondo tras el fallo garrafal de Iannone, que se llevó por delante a Dovizioso. Pedrosa cerró el podio.', '', '8888888', 'calle amapola 22', '', '', '', '', 1, '2016-04-03 17:49:59', 'P');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(14, 'Andrea', 'Nocioni', '963256987', 'fparralejo1970@yahoo.es', '', '', '7777777L', 'Badajoz', 'Alcorcón', '28921', 'Madrid', '', 1, '2016-04-03 20:40:32', 'C');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(15, 'Sofia', 'Loren', '965658784L', '', '', '', '22222222N', 'calle raimundio lulio 9', '', '', '', 'talon', 1, '2016-04-03 20:51:47', 'C');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(16, 'Gustavo', 'Cifuentes', '99988877', '', 'dsfa fasdf asfasf ', '', '44444444G', 'calle raimundio lulio 9', '', '', '', 'contado', 0, '2016-04-03 20:52:24', 'P');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
	(17, 'Steve', 'Winwood', '95623659', 'winwood@www.ww', 'roll with it', '', '3333333F', 'calle raimundio lulio 9', 'madrid', '28555', 'Madrid', 'transferencia', 1, '2016-04-03 20:54:39', 'P');
INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
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

-- Volcando datos para la tabla contfpp_empresa1.empleados: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` (`IdEmpleado`, `IdEmpresa`, `nombre`, `apellidos`, `correo`, `telefono`, `movil`, `borrado`, `fechaStatus`, `IdEmpleadoStatus`) VALUES
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.pedidos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`IdPedido`, `NumPedido`, `IdCliente`, `IdPresupuesto`, `FechaPedido`, `FechaVtoPedido`, `FormaPago`, `Estado`, `Retencion`, `Borrado`, `TipoFactura`, `FrecuenciaPeriodica`, `FechaProximaFacturaPeriodica`, `BaseImponible`, `Cuota`, `CuotaRetencion`, `total`, `Facturada`) VALUES
	(1, '20161', '4', '2', '2016-04-22 10:09:42', '2016-06-22 10:09:42', 'Transferencia', 'Aceptado', 15, 1, 'Periodica', 1, '2016-05-01 10:09:42', 2047.81, 430.04, 307.17, 2170.68, 'NF');
INSERT INTO `pedidos` (`IdPedido`, `NumPedido`, `IdCliente`, `IdPresupuesto`, `FechaPedido`, `FechaVtoPedido`, `FormaPago`, `Estado`, `Retencion`, `Borrado`, `TipoFactura`, `FrecuenciaPeriodica`, `FechaProximaFacturaPeriodica`, `BaseImponible`, `Cuota`, `CuotaRetencion`, `total`, `Facturada`) VALUES
	(2, '20162', '3', NULL, '2016-04-24 00:00:00', '2016-06-24 00:00:00', NULL, 'Cancelado', 0, 1, 'Puntual', 1, '0000-00-00 00:00:00', 1000, 100, 0, 1100, 'NF');
INSERT INTO `pedidos` (`IdPedido`, `NumPedido`, `IdCliente`, `IdPresupuesto`, `FechaPedido`, `FechaVtoPedido`, `FormaPago`, `Estado`, `Retencion`, `Borrado`, `TipoFactura`, `FrecuenciaPeriodica`, `FechaProximaFacturaPeriodica`, `BaseImponible`, `Cuota`, `CuotaRetencion`, `total`, `Facturada`) VALUES
	(3, '20163', '5', '', '2016-05-01 11:08:23', '2017-05-01 11:08:23', 'Talon', 'Pendiente', 15, 1, 'Periodica', 1, '2016-05-10 11:08:23', 640, 134.4, 96, 678.4, 'NF');
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.pedidosdetalle: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `pedidosdetalle` DISABLE KEYS */;
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(1, 1, 1, 2, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(2, 1, 2, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(3, 2, 1, 0, 0, 0, 'escombro mix', 10, 10, 100, 1000, 100, 1);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(4, 1, 1, 2, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(5, 1, 2, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(6, 1, 3, 0, 0, 1, 'Ventana completa', 21, 3.11, 320, 995.2, 208.99, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(7, 1, 1, 2, 1, 0, 'asdfsdf df', 21, 4.11, 55.44, 227.86, 47.85, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(8, 1, 2, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 7.44, 96.87, 720.71, 151.35, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(9, 1, 3, 0, 0, 1, 'Ventana completa', 21, 2.55, 320, 816, 171.36, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(10, 1, 1, 2, 1, 0, 'asdfsdf df', 21, 4.11, 55.44, 227.86, 47.85, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(11, 1, 2, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 7.44, 96.87, 720.71, 151.35, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(12, 1, 3, 0, 0, 1, 'Ventana completa', 21, 3.98, 320, 1273.6, 267.46, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(13, 1, 1, 2, 1, 0, 'asdfsdf df', 21, 4.11, 55.44, 227.86, 47.85, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(14, 1, 2, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 5.64, 96.87, 546.35, 114.73, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(15, 1, 3, 0, 0, 1, 'Ventana completa', 21, 3.98, 320, 1273.6, 267.46, 0);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(16, 1, 1, 2, 1, 0, 'asdfsdf df', 21, 4.11, 55.44, 227.86, 47.85, 1);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(17, 1, 2, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 5.64, 96.87, 546.35, 114.73, 1);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(18, 1, 3, 0, 0, 1, 'Ventana completa', 21, 3.98, 320, 1273.6, 267.46, 1);
INSERT INTO `pedidosdetalle` (`IdPedidoDetalle`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(19, 3, 1, 0, 0, 1, 'Ventana completa', 21, 2, 320, 640, 134.4, 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.presupuestos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuestos` DISABLE KEYS */;
INSERT INTO `presupuestos` (`IdPresupuesto`, `NumPresupuesto`, `IdCliente`, `FechaPresupuesto`, `FechaVtoPresupuesto`, `FormaPago`, `FechaFinalizacion`, `Estado`, `Retencion`, `Proforma`, `Borrado`, `BaseImponible`, `Cuota`, `CuotaRetencion`, `total`, `Facturada`, `Pedido`) VALUES
	(1, '20161', '11', '2016-04-20 19:26:57', '2016-04-20 19:26:57', '', NULL, 'Aceptado', 0, 'NO', 1, 12254.02, 2573.35, 0, 14827.37, 'NF', 'NP');
INSERT INTO `presupuestos` (`IdPresupuesto`, `NumPresupuesto`, `IdCliente`, `FechaPresupuesto`, `FechaVtoPresupuesto`, `FormaPago`, `FechaFinalizacion`, `Estado`, `Retencion`, `Proforma`, `Borrado`, `BaseImponible`, `Cuota`, `CuotaRetencion`, `total`, `Facturada`, `Pedido`) VALUES
	(2, '20162', '4', '2016-04-23 08:33:41', '2016-04-23 08:33:41', 'Pagare', NULL, 'Aceptado', 15, 'NO', 1, 419.44, 88.08, 62.92, 444.6, 'NF', 'NP');
INSERT INTO `presupuestos` (`IdPresupuesto`, `NumPresupuesto`, `IdCliente`, `FechaPresupuesto`, `FechaVtoPresupuesto`, `FormaPago`, `FechaFinalizacion`, `Estado`, `Retencion`, `Proforma`, `Borrado`, `BaseImponible`, `Cuota`, `CuotaRetencion`, `total`, `Facturada`, `Pedido`) VALUES
	(3, '20163', '5', '2016-04-24 19:01:01', '2016-04-24 19:01:01', 'Talon', NULL, 'Pendiente', 0, 'NO', 1, 23282.12, 2599.15, 0, 25881.27, 'NF', 'NP');
INSERT INTO `presupuestos` (`IdPresupuesto`, `NumPresupuesto`, `IdCliente`, `FechaPresupuesto`, `FechaVtoPresupuesto`, `FormaPago`, `FechaFinalizacion`, `Estado`, `Retencion`, `Proforma`, `Borrado`, `BaseImponible`, `Cuota`, `CuotaRetencion`, `total`, `Facturada`, `Pedido`) VALUES
	(4, '20164', '4', '2016-04-25 21:03:11', '2016-04-25 21:03:11', 'Pagare', NULL, 'Pendiente', 0, 'NO', 1, 1414.64, 297.07, 0, 1711.71, 'NF', 'NP');
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp_empresa1.presupuestosdetalle: ~25 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuestosdetalle` DISABLE KEYS */;
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(1, 1, 1, 0, 'asdasfasdf ', 21, 77.55, 45.88, 3557.99, 747.18, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(2, 1, 1, 0, 'asdasfasdf ', 21, 77.55, 45.88, 3557.99, 747.18, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(3, 1, 1, 0, 'asdasfasdf ', 21, 77.55, 45.88, 3557.99, 747.18, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(4, 1, 1, 0, 'asdasfasdf ', 21, 77.55, 45.88, 3557.99, 747.18, 1);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(5, 1, 2, 0, 'aaaaaaa aaaaa aaaa', 21, 16.55, 525.44, 8696.03, 1826.17, 1);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(6, 2, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(7, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(8, 3, 1, 1, 'Ventana completa', 21, 6.55, 320, 2096, 440.16, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(9, 3, 2, 0, 'alforjas de escomro', 21, 7, 52.44, 367.08, 77.09, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(10, 3, 1, 1, 'Ventana completa', 21, 6.55, 320, 2096, 440.16, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(11, 3, 2, 0, 'alforjas de escomro', 21, 7, 52.44, 367.08, 77.09, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(12, 3, 3, 4, 'Frente Armario 2 puertas', 10, 66, 315.44, 20819.04, 2081.9, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(13, 4, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(14, 4, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(15, 4, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 1);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(16, 4, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 1);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(17, 4, 3, 1, 'Ventana completa', 21, 3.11, 320, 995.2, 208.99, 1);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(18, 3, 1, 1, 'Ventana completa', 21, 6.55, 320, 2096, 440.16, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(19, 3, 2, 0, 'alforjas de escomro', 21, 7, 52.44, 367.08, 77.09, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(20, 3, 3, 4, 'Frente Armario 2 puertas', 10, 66, 315.44, 20819.04, 2081.9, 0);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(21, 3, 1, 1, 'Ventana completa', 21, 6.55, 320, 2096, 440.16, 1);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(22, 3, 2, 0, 'alforjas de escomro', 21, 7, 52.44, 367.08, 77.09, 1);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(23, 3, 3, 4, 'Frente Armario 2 puertas', 10, 66, 315.44, 20819.04, 2081.9, 1);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(24, 2, 1, 0, 'asdfsdf df', 21, 3.11, 55.44, 172.42, 36.21, 1);
INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
	(25, 2, 2, 0, 'adssd fgsd fg sd fg', 21, 2.55, 96.87, 247.02, 51.87, 1);
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

-- Volcando datos para la tabla contfpp_empresa1.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`usuario`, `password`, `IdEmpleado`, `borrado`, `fechaStatus`, `IdEmpleadoStatus`) VALUES
	('paco', 'paco', 1, 1, '2016-03-21 21:56:22', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
