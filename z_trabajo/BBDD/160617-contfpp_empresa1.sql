-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-06-2016 a las 17:11:37
-- Versión del servidor: 5.5.49-37.9
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `s201859c_facturas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE IF NOT EXISTS `articulos` (
  `IdArticulo` int(11) NOT NULL AUTO_INCREMENT,
  `Referencia` varchar(25) DEFAULT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Precio` double NOT NULL,
  `tipoIVA` int(5) NOT NULL,
  `Borrado` int(11) NOT NULL COMMENT '1=Datos Vale, 0=Esta Borrado',
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`IdArticulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

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

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombre`, `apellidos`, `telefono`, `email`, `notas`, `nombreEmpresa`, `CIF`, `direccion`, `municipio`, `CP`, `provincia`, `forma_pago_habitual`, `borrado`, `fechaAlta`, `tipo`) VALUES
(1, 'laumar cocinas', '', '916107423', 'laumarcocinas@gmail.com', '', 'laumar cocinas', '', 'Plaza del peñon nº5', 'ALCORCON', '28921', 'MADRID', 'contado', 1, '2016-05-06 19:54:23', 'C'),
(2, 'lali', 'zambrano', '626721917', '', '', '', '', '', '', '', '', '', 1, '2016-05-06 19:56:08', 'C'),
(3, 'sergio', 'mostoles', '691998336', 'segichuzo777@gmail.com', '', '', '', '', '', '', '', '', 1, '2016-05-06 19:59:19', 'C'),
(4, 'laumar cocinas', '', '916107423', 'laumarcocinas@gmail.com', '', 'amelia', '', 'c/ praga n8', 'alcorcon', '28921', 'MADRID', 'contado', 1, '2016-05-12 18:33:05', 'C'),
(5, 'laumar cocinas', '', '916107423', 'laumarcocinas@gmail.com', '', 'amelia', '', 'c/ praga n8', 'alcorcon', '28921', 'MADRID', 'contado', 1, '2016-05-12 18:35:57', 'C'),
(6, 'laumar cocinas', '', '916107423', 'laumarcocinas@gmail.com', '', 'Amilia', '', 'c/ praga n8', 'alcorcon', '28921', 'MADRID', '', 1, '2016-05-12 18:45:41', 'C'),
(7, 'vicente ', '', '625579858', '', '', 'vicente ', '', 'c/ islas galapagos n', 'parla', '', '', '', 1, '2016-05-12 18:49:12', 'C'),
(8, 'genoveva', '', '658227615', '', '', 'genoveva', '', '', 'alcorcon', '28921', 'madrid', '', 1, '2016-05-12 19:36:28', 'C'),
(9, 'illesplast, s,l,', '', '925', 'illesplast@illesplast.com', '', 'illesplast.s.l.', 'B45076122', 'nave 20 POL IND. VILLA YUNCOS SECTOR 1', 'yuncos', '43', 'toledo', '', 1, '2016-05-12 19:57:17', 'C'),
(10, 'luis', 'marquez ramos', '647732951', 'luis.m.r.2@hotmail.com', '', '', '50693222-a', 'av/ de fuenlabrada n99A 2a', 'leganes', '48912', 'MADRID', '', 1, '2016-06-13 21:21:39', 'C'),
(11, 'Ismael', '', '', '', '', 'Ismael', '', '', '', '', '', '', 1, '2016-06-14 15:43:35', 'C'),
(12, 'Lourdes ', '', '', 'llerafernandez@hotmail.com', '', '', '', 'el bercial', 'getafe', '', '', '', 1, '2016-06-15 17:00:35', 'C'),
(13, 'laumar cocinas', '', '916107423', 'laumarcocinas@gmail.com', '', 'laumar cocinas', '', 'C/ Polvoranca nº72', 'ALCORCON', '28921', 'MADRID', '', 1, '2016-06-16 09:58:48', 'C'),
(14, 'METAL FOUR RECYCLING', '', '916160122', 'aministracion@metalfour.es', '', 'METAL FOUR RECYCLING ', 'A78279544', 'Puerto de Cotos 1 (P. I. Las Nieves)', 'Móstoles', '', 'Madrid', '', 1, '2016-06-17 14:29:27', 'C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

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

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`IdEmpleado`, `IdEmpresa`, `nombre`, `apellidos`, `correo`, `telefono`, `movil`, `borrado`, `fechaStatus`, `IdEmpleadoStatus`) VALUES
(1, 1, 'Bienvenido', 'Marquez', 'ccristaleria@gmail.com', 0, 608506200, 1, '2016-03-21 21:53:45', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `IdFactura` int(11) NOT NULL AUTO_INCREMENT,
  `NumFactura` varchar(50) NOT NULL,
  `IdCliente` varchar(15) NOT NULL,
  `IdPresupuesto` varchar(11) DEFAULT NULL,
  `IdPedido` varchar(11) DEFAULT NULL,
  `FechaFactura` datetime NOT NULL,
  `FechaVtoFactura` datetime NOT NULL,
  `FormaPago` varchar(50) DEFAULT NULL,
  `Estado` varchar(15) DEFAULT NULL COMMENT 'Emitida,Contabilizada,Anulada',
  `Retencion` double DEFAULT '0',
  `Borrado` int(11) DEFAULT '1' COMMENT '1=Activo, 0=Borrado',
  `BaseImponible` double DEFAULT '0',
  `Cuota` double DEFAULT '0',
  `CuotaRetencion` double DEFAULT '0' COMMENT 'Cuota IRPF',
  `total` double DEFAULT '0',
  `asiento` int(11) DEFAULT '0',
  `Referencia` varchar(70) DEFAULT NULL,
  `CC_Trans` varchar(30) DEFAULT NULL,
  `esAbono` varchar(50) DEFAULT NULL COMMENT 'Se escribe la factura que se anula (NumFactura)',
  PRIMARY KEY (`IdFactura`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`IdFactura`, `NumFactura`, `IdCliente`, `IdPresupuesto`, `IdPedido`, `FechaFactura`, `FechaVtoFactura`, `FormaPago`, `Estado`, `Retencion`, `Borrado`, `BaseImponible`, `Cuota`, `CuotaRetencion`, `total`, `asiento`, `Referencia`, `CC_Trans`, `esAbono`) VALUES
(1, '20161', '9', '8', '', '2016-05-12 12:26:06', '2016-05-12 12:26:06', '', 'Emitida', 0, 1, 1855.5, 263.97, 0, 2119.47, 0, '', '', ''),
(2, '20162', '10', '', '', '2016-06-14 21:24:20', '2016-06-14 21:24:20', '', 'Emitida', 0, 1, 150, 31.5, 0, 181.5, 0, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturasdetalle`
--

CREATE TABLE IF NOT EXISTS `facturasdetalle` (
  `IdFacturaDetalle` int(11) NOT NULL AUTO_INCREMENT,
  `IdFactura` int(11) NOT NULL,
  `NumLineaFactura` int(11) NOT NULL,
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
  PRIMARY KEY (`IdFacturaDetalle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `facturasdetalle`
--

INSERT INTO `facturasdetalle` (`IdFacturaDetalle`, `IdFactura`, `NumLineaFactura`, `IdPedido`, `NumLineaPedido`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
(1, 1, 1, 0, 0, 8, 1, 0, 'estructura de aluminio para separar, maquina de inyecion con puerta corredera. con la parte de abajo en madera plastificada en blanco. esta estructura lleva unos pilares de tubo de 60x60.', 21, 0, 0, 1257, 263.97, 0),
(2, 1, 1, 0, 0, 8, 1, 0, 'estructura de aluminio para separar, maquina de inyecion con puerta corredera. con la parte de abajo en madera plastificada en blanco. esta estructura lleva unos pilares de tubo de 60x60.', 21, 0, 0, 1257, 263.97, 1),
(3, 1, 2, 0, 0, 0, 0, 0, 'POL.CELULAR.IN. 2 UV 6000x2100x10mm', 0, 0, 0, 110.35, 0, 1),
(4, 1, 3, 0, 0, 0, 0, 0, 'POL.CELULAR.IN. 2 UV 6000x2100x16mm', 0, 0, 0, 181.64, 0, 1),
(5, 1, 4, 0, 0, 0, 0, 0, 'POL. CELULAR HIELO 2 UV 6000X21000X10mm', 0, 0, 0, 115.82, 0, 1),
(6, 1, 5, 0, 0, 0, 0, 0, 'POL. CELULAR HIELO 2 UV 6000X21000X16mm', 0, 0, 0, 190.69, 0, 1),
(7, 2, 1, 0, 0, 0, 0, 0, 'reposicion de bonbin de la puerta blindada.', 21, 0, 0, 150, 31.5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosdetalle`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `presupuestos`
--

INSERT INTO `presupuestos` (`IdPresupuesto`, `NumPresupuesto`, `IdCliente`, `FechaPresupuesto`, `FechaVtoPresupuesto`, `FormaPago`, `FechaFinalizacion`, `Estado`, `Retencion`, `Proforma`, `Borrado`, `BaseImponible`, `Cuota`, `CuotaRetencion`, `total`, `Facturada`, `Pedido`) VALUES
(1, '20161', '1', '2016-05-06 13:26:18', '2016-05-06 13:26:18', 'Contado', NULL, 'Aceptado', 0, 'NO', 1, 5120, 1075.2, 0, 6195.2, 'NF', 'NP'),
(2, '20162', '2', '2016-05-06 21:06:48', '2016-05-06 21:06:48', 'Contado', NULL, 'Aceptado', 0, 'NO', 1, 1760, 369.6, 0, 2129.6, 'NF', 'NP'),
(3, '20163', '12', '2016-05-12 14:35:09', '2016-05-12 14:35:09', '', NULL, 'Pendiente', 0, 'NO', 1, 921, 193.41, 0, 1114.41, 'NF', 'NP'),
(4, '20164', '7', '2016-05-12 18:56:47', '2016-05-12 18:56:47', '', NULL, 'Pendiente', 0, 'NO', 1, 1690, 354.9, 0, 2044.9, 'NF', 'NP'),
(5, '20165', '3', '2016-05-12 19:25:18', '2016-05-12 19:25:18', '', NULL, 'Pendiente', 0, 'NO', 1, 3420, 718.2, 0, 4138.2, 'NF', 'NP'),
(6, '20166', '3', '2016-05-12 19:32:45', '2016-05-12 19:32:45', '', NULL, 'Pendiente', 0, 'NO', 1, 3115, 654.15, 0, 3769.15, 'NF', 'NP'),
(7, '20167', '8', '2016-05-12 19:45:29', '2016-05-12 19:45:29', 'Contado', NULL, 'Aceptado', 0, 'NO', 1, 1131, 237.51, 0, 1368.51, 'NF', 'NP'),
(8, '20168', '9', '2016-05-12 13:22:45', '2016-05-12 13:22:45', '', NULL, 'Aceptado', 0, 'NO', 1, 1257, 263.97, 0, 1520.97, 'T', 'NP'),
(9, '20169', '10', '2016-06-13 21:20:31', '2016-06-13 21:20:31', '', NULL, 'Aceptado', 0, 'NO', 1, 150, 31.5, 0, 181.5, 'NF', 'NP'),
(10, '201610', '1', '2016-06-14 15:41:10', '2016-06-14 15:41:10', '', NULL, 'Aceptado', 0, 'NO', 1, 550, 115.5, 0, 665.5, 'NF', 'NP'),
(11, '201611', '11', '2016-06-14 15:45:47', '2016-06-14 15:45:47', '', NULL, 'Aceptado', 0, 'NO', 1, 120, 25.2, 0, 145.2, 'NF', 'NP'),
(12, '201612', '12', '2016-06-15 19:08:16', '2016-06-15 19:08:16', '', NULL, 'Pendiente', 0, 'NO', 1, 190, 39.9, 0, 229.9, 'NF', 'NP'),
(13, '201613', '13', '2016-06-16 10:02:43', '2016-06-16 10:02:43', '', NULL, 'Pendiente', 0, 'NO', 0, 2140, 449.4, 0, 2589.4, 'NF', 'NP'),
(14, '201613', '13', '2016-06-16 17:43:46', '2016-06-16 17:43:46', '', NULL, 'Pendiente', 0, 'NO', 0, 12670, 2660.7, 0, 15330.7, 'NF', 'NP'),
(15, '201613', '13', '2016-06-16 18:03:26', '2016-06-16 18:03:26', '', NULL, 'Pendiente', 0, 'NO', 0, 2140, 449.4, 0, 2589.4, 'NF', 'NP'),
(16, '201613', '14', '2016-06-17 14:32:03', '2016-06-17 14:32:03', '', NULL, 'Pendiente', 0, 'NO', 1, 646.8, 0, 0, 646.8, 'P', 'P'),
(17, '201614', '14', '2016-06-17 14:34:01', '2016-06-17 14:34:01', '', NULL, 'Pendiente', 0, 'NO', 1, 754, 0, 0, 754, 'P', 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestosdetalle`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

--
-- Volcado de datos para la tabla `presupuestosdetalle`
--

INSERT INTO `presupuestosdetalle` (`IdPresupDetalle`, `IdPresupuesto`, `NumLineaPresup`, `IdArticulo`, `DescripcionProducto`, `TipoIVA`, `Cantidad`, `ImporteUnidad`, `Importe`, `CuotaIva`, `Borrado`) VALUES
(1, 1, 1, 0, 'ventana del dormitorio principal en rotura de puente termico en vicilor. oscilo batiente. doble caristalamiento guardian sum.', 21, 0, 0, 680, 142.8, 0),
(2, 1, 2, 0, 'dos ventanas k dan al patio. en lacado blanco en rotura de puente termico. oscilo batientes', 21, 0, 0, 840, 176.4, 0),
(3, 1, 3, 0, 'ventanas de la cocina con el fijo incluido aluminio en lacado blanco rotura de puente termico', 21, 0, 0, 680, 142.8, 0),
(4, 1, 4, 0, 'cerramiento de la terraza en vicilor en rotura de puente termico con cristal climalit guardian sum  con chapa para tabique. sin tabique.', 21, 0, 0, 2900, 609, 0),
(5, 1, 5, 0, 'chapa para dibision de terraza', 21, 0, 0, 140, 29.4, 0),
(6, 1, 1, 0, 'ventana del dormitorio principal en rotura de puente termico en vicilor. oscilo batiente. doble caristalamiento guardian sum.', 21, 0, 0, 680, 142.8, 0),
(7, 1, 2, 0, 'dos ventanas k dan al patio. en lacado blanco en rotura de puente termico. oscilo batientes', 21, 0, 0, 840, 176.4, 0),
(8, 1, 3, 0, 'ventanas de la cocina con el fijo incluido aluminio en lacado blanco rotura de puente termico', 21, 0, 0, 680, 142.8, 0),
(9, 1, 4, 0, 'cerramiento de la terraza en vicilor en rotura de puente termico con cristal climalit guardian sum  con chapa para tabique. sin tabique.', 21, 0, 0, 2900, 609, 0),
(10, 1, 5, 0, 'chapa para dibision de terraza', 21, 0, 0, 140, 29.4, 0),
(11, 2, 1, 0, 'cerramiento de terraza con persiana termica y cristal guardian sum. instalado', 21, 0, 0, 1760, 369.6, 1),
(12, 3, 1, 0, 'mosquitera plisada para el salon ', 21, 0, 0, 424, 89.04, 0),
(13, 3, 2, 0, 'mosquitera plisada para la cocina', 21, 0, 0, 377, 79.17, 0),
(14, 3, 3, 0, 'tres mosquiteras correderas ', 21, 0, 0, 120, 25.2, 0),
(15, 4, 1, 0, 'tres persianas con cajon hermetico de p.v.c. en blanco', 21, 0, 0, 780, 163.8, 1),
(16, 4, 2, 0, 'cajon para la puerta del salon sin persiana', 21, 0, 0, 150, 31.5, 1),
(17, 4, 3, 0, '.cajon con persiana de aluminio termica en blanco y con guias.', 21, 0, 0, 360, 75.6, 1),
(18, 4, 4, 0, 'cosquiteras enrrollables', 21, 0, 0, 270, 56.7, 1),
(19, 4, 5, 0, 'mosquitera fija para la ventana del salon', 21, 0, 0, 130, 27.3, 1),
(20, 5, 1, 0, 'cerramiento de terraza en rotura de puente termico  con persiana de aluminio y tabique en la parte inferior, y abatible y oscilo batiente en la parte superior. aluminio en blanco', 21, 0, 0, 1865, 391.65, 1),
(21, 5, 2, 0, 'tres ventanas abatibles en rotura de puente termico con persiana d aluminio y climalit guardian sun.', 21, 0, 0, 1555, 326.55, 1),
(22, 6, 1, 0, 'cerramiento de terraza en rotura de puente termico  con persiana de aluminio y tabique en la parte inferior, y abatible y oscilo batiente en la parte superior. aluminio en blanco', 21, 0, 0, 1865, 391.65, 0),
(23, 6, 2, 0, 'tres ventanas abatibles en rotura de puente termico con persiana d aluminio y climalit guardian sun.', 21, 0, 0, 1555, 326.55, 0),
(24, 6, 1, 0, 'cerramiento de terraza sin rotura  de puente termico  con persiana de aluminio y tabique en la parte inferior, y abatible y oscilo batiente en la parte superior. aluminio en blanco. con climalit guardian sun.', 21, 0, 0, 1715, 360.15, 1),
(25, 6, 2, 0, 'tres ventanas abatibles sin rotura de puente termico con persiana d aluminio y climalit guardian sun.', 21, 0, 0, 1400, 294, 1),
(26, 7, 1, 0, 'toldo tension en blanco con lona verde plastificada.', 21, 0, 0, 720, 151.2, 0),
(27, 7, 2, 0, 'visera de aluminio en blanco.', 21, 0, 0, 130, 27.3, 0),
(28, 7, 3, 0, 'techo de policarbonato con bastidor de aluminio.', 21, 0, 0, 280, 58.8, 0),
(29, 7, 1, 0, 'toldo tension en blanco con lona verde plastificada.', 21, 0, 0, 720, 151.2, 1),
(30, 7, 2, 0, 'visera de aluminio en blanco.', 21, 0, 0, 130, 27.3, 1),
(31, 7, 3, 0, 'techo de policarbonato con bastidor de aluminio.', 21, 0, 0, 280, 58.8, 1),
(32, 7, 4, 0, 'recibi a cuenta 250', 21, 0, 0, 1, 0.21, 1),
(33, 8, 1, 0, 'estructura de aluminio para separar, maquina de inyecion con puerta corredera. con la parte de abajo en madera plastificada en blanco. esta estructura lleva unos pilares de tubo de 60x60.', 21, 0, 0, 1257, 263.97, 0),
(34, 8, 1, 0, 'estructura de aluminio para separar, maquina de inyecion con puerta corredera. con la parte de abajo en madera plastificada en blanco. esta estructura lleva unos pilares de tubo de 60x60.', 21, 0, 0, 1257, 263.97, 0),
(35, 1, 1, 0, 'ventana del dormitorio principal en rotura de puente termico en vicilor. oscilo batiente. doble caristalamiento guardian sum.', 21, 0, 0, 680, 142.8, 0),
(36, 1, 2, 0, 'dos ventanas k dan al patio. en lacado blanco en rotura de puente termico. oscilo batientes', 21, 0, 0, 840, 176.4, 0),
(37, 1, 3, 0, 'ventanas de la cocina con el fijo incluido aluminio en lacado blanco rotura de puente termico', 21, 0, 0, 680, 142.8, 0),
(38, 1, 4, 0, 'cerramiento de la terraza en vicilor en rotura de puente termico con cristal climalit guardian sum  con chapa para tabique. sin tabique.', 21, 0, 0, 27400, 5754, 0),
(39, 1, 5, 0, 'chapa para dibision de terraza', 21, 0, 0, 140, 29.4, 0),
(40, 1, 6, 0, 'chapa para el lateral derecho. en sustitucion de la ventana del dormitorio.', 21, 0, 0, 40, 8.4, 0),
(41, 9, 1, 0, 'sustitucion de bombin por uno de seguridad. instalado.', 21, 0, 0, 1200, 252, 0),
(42, 9, 2, 0, 'instalacion de cerradura fad. de seguridad- instalado.', 21, 0, 0, 1350, 283.5, 0),
(43, 8, 1, 0, 'estructura de aluminio para separar, maquina de inyecion con puerta corredera. con la parte de abajo en madera plastificada en blanco. esta estructura lleva unos pilares de tubo de 60x60.', 21, 0, 0, 1257, 263.97, 0),
(44, 8, 2, 0, 'POL.CELULAR.IN. 2 UV 6000X2100X10mm', 21, 0, 0, 110.35, 23.17, 0),
(45, 8, 3, 0, 'POL.CELULAR.IN. 2 UV 6000X2100X16mm', 21, 0, 0, 181.64, 38.14, 0),
(46, 8, 4, 0, 'POL.CELULAR HIELO 2 UV 6000X2100X10mm', 21, 0, 0, 115.82, 24.32, 0),
(47, 8, 5, 0, 'POL.CELULAR HIELO 2 UV 6000X2100X16mm', 21, 0, 0, 190.69, 40.04, 0),
(48, 8, 1, 0, 'estructura de aluminio para separar, maquina de inyecion con puerta corredera. con la parte de abajo en madera plastificada en blanco. esta estructura lleva unos pilares de tubo de 60x60.', 21, 0, 0, 1257, 263.97, 0),
(49, 8, 2, 0, 'POL.CELULAR.IN. 2 UV 6000X2100X10mm', 21, 0, 0, 110.35, 23.17, 0),
(50, 8, 3, 0, 'POL.CELULAR.IN. 2 UV 6000X2100X16mm', 21, 0, 0, 181.64, 38.14, 0),
(51, 8, 4, 0, 'POL.CELULAR HIELO 2 UV 6000X2100X10mm', 21, 0, 0, 115.82, 24.32, 0),
(52, 8, 5, 0, 'POL.CELULAR HIELO 2 UV 6000X2100X16mm', 21, 0, 0, 190.69, 40.04, 0),
(53, 8, 1, 0, 'estructura de aluminio para separar, maquina de inyecion con puerta corredera. con la parte de abajo en madera plastificada en blanco. esta estructura lleva unos pilares de tubo de 60x60.', 21, 0, 0, 1257, 263.97, 0),
(54, 8, 2, 0, 'POL.CELULAR.IN. 2 UV 6000X2100X10mm', 21, 0, 0, 110.35, 23.17, 0),
(55, 8, 3, 0, 'POL.CELULAR.IN. 2 UV 6000X2100X16mm', 21, 0, 0, 181.64, 38.14, 0),
(56, 8, 4, 0, 'POL.CELULAR HIELO 2 UV 6000X2100X10mm', 21, 0, 0, 115.82, 24.32, 0),
(57, 8, 5, 0, 'POL.CELULAR HIELO 2 UV 6000X2100X16mm', 21, 0, 0, 190.69, 40.04, 0),
(58, 8, 1, 0, 'estructura de aluminio para separar, maquina de inyecion con puerta corredera. con la parte de abajo en madera plastificada en blanco. esta estructura lleva unos pilares de tubo de 60x60.', 21, 0, 0, 1257, 263.97, 0),
(59, 8, 1, 0, 'estructura de aluminio para separar, maquina de inyecion con puerta corredera. con la parte de abajo en madera plastificada en blanco. esta estructura lleva unos pilares de tubo de 60x60.', 21, 0, 0, 1257, 263.97, 1),
(60, 1, 1, 0, 'ventana del dormitorio principal en rotura de puente termico en vicilor. oscilo batiente. doble caristalamiento guardian sum.', 21, 0, 0, 680, 142.8, 0),
(61, 1, 2, 0, 'dos ventanas k dan al patio. en lacado blanco en rotura de puente termico. oscilo batientes', 21, 0, 0, 840, 176.4, 0),
(62, 1, 3, 0, 'ventanas de la cocina con el fijo incluido aluminio en lacado blanco rotura de puente termico', 21, 0, 0, 680, 142.8, 0),
(63, 1, 4, 0, 'cerramiento de la terraza en vicilor en rotura de puente termico con cristal climalit guardian sum  con chapa para tabique. sin tabique.', 21, 0, 0, 2740, 575.4, 0),
(64, 1, 5, 0, 'chapa para dibision de terraza', 21, 0, 0, 140, 29.4, 0),
(65, 1, 6, 0, 'chapa para el lateral derecho. en sustitucion de la ventana del dormitorio.', 21, 0, 0, 40, 8.4, 0),
(66, 1, 1, 0, 'ventana del dormitorio principal en rotura de puente termico en vicilor. oscilo batiente. doble caristalamiento guardian sum.', 21, 0, 0, 680, 142.8, 1),
(67, 1, 2, 0, 'dos ventanas k dan al patio. en lacado blanco en rotura de puente termico. oscilo batientes', 21, 0, 0, 840, 176.4, 1),
(68, 1, 3, 0, 'ventanas de la cocina con el fijo incluido aluminio en lacado blanco rotura de puente termico', 21, 0, 0, 680, 142.8, 1),
(69, 1, 4, 0, 'cerramiento de la terraza en vicilor en rotura de puente termico con cristal climalit guardian sum  con chapa para tabique. sin tabique.', 21, 0, 0, 2740, 575.4, 1),
(70, 1, 5, 0, 'chapa para dibision de terraza', 21, 0, 0, 140, 29.4, 1),
(71, 1, 6, 0, 'chapa para el lateral derecho. en sustitucion de la ventana del dormitorio.', 21, 0, 0, 40, 8.4, 1),
(72, 10, 1, 0, 'Oscilo batiente en blanco, con persiana de aluminio', 21, 0, 0, 450, 94.5, 1),
(73, 10, 2, 0, 'Ventana corredea ciego con chapa', 21, 0, 0, 100, 21, 1),
(74, 11, 1, 0, 'Ventana en blanco, corredera y fijo', 21, 0, 0, 120, 25.2, 1),
(75, 9, 1, 0, 'sustitucion de bombin por uno de seguridad. instalado.', 21, 0, 0, 150, 31.5, 1),
(76, 12, 1, 0, 'Mosquitera corredera en ral 7011', 21, 0, 0, 10, 2.1, 0),
(77, 12, 1, 0, 'Mosquitera corredera en ral 7011.  cuatro.', 21, 0, 0, 190, 39.9, 1),
(78, 13, 1, 0, 'Cercamiento de terraza de cocina:\r\nVentana abatible oscilo batiente con persiana y climat.\r\nCon dos fijos laterales y chapa en la parte de abajo.\r\nSin rotura de puente térmico.', 21, 0, 0, 970, 203.7, 0),
(79, 13, 2, 0, 'Con rotura', 21, 0, 0, 1170, 245.7, 0),
(80, 3, 1, 0, 'mosquitera plisada para el salon ', 21, 0, 0, 424, 89.04, 0),
(81, 3, 2, 0, 'mosquitera plisada para la cocina', 21, 0, 0, 377, 79.17, 0),
(82, 3, 3, 0, 'tres mosquiteras correderas ', 21, 0, 0, 120, 25.2, 0),
(83, 3, 4, 0, 'Ventana oscilo batiente Ral 7011', 21, 0, 0, 420, 88.2, 0),
(84, 3, 5, 0, 'Dos toldos extensibles', 21, 0, 0, 2359, 495.39, 0),
(85, 14, 1, 0, 'Cercamiento de terraza de cocina:\r\n Ventana abatible oscilo batiente con persiana y climat.\r\nCon dos fijos laterales y chapa en la parte de abajo.\r\nSin rotura de puente térmico', 21, 0, 0, 970, 203.7, 0),
(86, 14, 2, 0, 'Con rotura', 21, 0, 0, 11700, 2457, 0),
(87, 15, 1, 0, 'Cercamiento de terraza de cocina: \r\nVentana abatible oscilo batiente con persiana y climat.\r\nCon dos fijos laterales y chapa en la parte inferior.\r\nSin rotura de puente térmico', 21, 0, 0, 970, 203.7, 1),
(88, 15, 2, 0, 'Con rotura', 21, 0, 0, 1170, 245.7, 1),
(89, 16, 1, 0, 'PERFIL SUCIO', 0, 0, 0, 640, 0, 0),
(90, 16, 2, 0, 'COBRE MELE', 0, 0, 0, 6.8, 0, 0),
(91, 16, 1, 0, 'PERFIL SUCIO', 0, 0, 0, 640, 0, 1),
(92, 16, 2, 0, 'COBRE MELE', 0, 0, 0, 6.8, 0, 1),
(93, 17, 1, 0, 'PERFIL SUCIO', 0, 0, 0, 754, 0, 0),
(94, 17, 1, 0, 'PERFIL SUCIO', 0, 0, 0, 754, 0, 1),
(95, 3, 1, 0, 'mosquitera plisada para el salon ', 21, 0, 0, 424, 89.04, 1),
(96, 3, 2, 0, 'mosquitera plisada para la cocina', 21, 0, 0, 377, 79.17, 1),
(97, 3, 3, 0, 'tres mosquiteras correderas ', 21, 0, 0, 120, 25.2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

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

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `password`, `IdEmpleado`, `borrado`, `fechaStatus`, `IdEmpleadoStatus`) VALUES
('bienve', 'bienve', 1, 1, '2016-03-21 21:56:22', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
