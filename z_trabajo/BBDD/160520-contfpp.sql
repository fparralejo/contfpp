-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.0.17-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.5078
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla contfpp.empresas
DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `IdEmpresa` int(11) NOT NULL DEFAULT '0',
  `Nombre` varchar(10) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `identificacion` varchar(150) NOT NULL,
  `CIF` varchar(50) DEFAULT NULL,
  `fechaAlta` datetime DEFAULT NULL,
  `fechaVencimiento` datetime DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `municipio` varchar(50) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `CP` int(11) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `email1` varchar(100) NOT NULL,
  `email2` varchar(100) DEFAULT NULL,
  `borrado` int(11) DEFAULT '0' COMMENT '0=Valido, 1=Borrado',
  `conexionBBDD` varchar(50) DEFAULT NULL,
  `lngAsesor` int(11) DEFAULT NULL,
  `claseEmpresa` varchar(20) DEFAULT NULL,
  `TipoContador` int(5) DEFAULT NULL,
  `Logo` varchar(50) DEFAULT NULL COMMENT 'Nombre Imagen (jpg)',
  `TextoPie` text COMMENT 'Texto que se escribe en la parte inferior en pequeño de facturas',
  `articulos` varchar(5) DEFAULT NULL COMMENT 'SI= utiliza los articulos, NO= no utiliza los articulos',
  `TipoIRPF` varchar(5) DEFAULT NULL COMMENT 'NO= NO aplica, Numero=IRPF a aplicar a presupuestos, pedidos y facturas',
  `PrefijoFactRectificativas` varchar(5) DEFAULT 'A',
  PRIMARY KEY (`IdEmpresa`),
  KEY `IdEmpresa` (`IdEmpresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp.empresas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT IGNORE INTO `empresas` (`IdEmpresa`, `Nombre`, `Password`, `identificacion`, `CIF`, `fechaAlta`, `fechaVencimiento`, `direccion`, `municipio`, `provincia`, `CP`, `telefono`, `email1`, `email2`, `borrado`, `conexionBBDD`, `lngAsesor`, `claseEmpresa`, `TipoContador`, `Logo`, `TextoPie`, `articulos`, `TipoIRPF`, `PrefijoFactRectificativas`) VALUES
	(1, 'bienve', 'bienve', 'Aluminios Marquez ', '08035614-n', '2016-03-21 21:33:29', '2017-07-21 21:33:31', 'Calle Cid 1', 'Alcorcón', 'Madrid', 28921, 608506200, 'ccristaleria@gmail.com', 'bienvemarquez@gmail.com', 1, 'contfpp_empresa1', NULL, NULL, 2, 'logo-bienve1.png', '', 'SI', 'NO', 'A'),
	(2, 'pruebas', 'pruebas', 'Empresa Pruebas', 'B0000000000', '2016-05-07 00:00:00', '2017-05-07 00:00:00', 'Calle Badajoz 28 Bajo 1', 'Alcorcón', 'Madrid', 28921, 671108309, 'fparralejo1970@gmail.com', 'fparralejo1970@yahoo.es', 1, 'contfpp_empresa2', NULL, NULL, 3, 'logo_empresa.PNG', '', 'SI', '14', 'A');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;

-- Volcando estructura para tabla contfpp.tipo_contador
DROP TABLE IF EXISTS `tipo_contador`;
CREATE TABLE IF NOT EXISTS `tipo_contador` (
  `idContador` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `editar` varchar(5) NOT NULL COMMENT 'SI,NO',
  PRIMARY KEY (`idContador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla contfpp.tipo_contador: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_contador` DISABLE KEYS */;
INSERT IGNORE INTO `tipo_contador` (`idContador`, `tipo`, `editar`) VALUES
	(1, 'Libre', 'SI'),
	(2, 'Simple', 'NO'),
	(3, 'Compuesto Número/Año', 'NO'),
	(4, 'Compuesto Año/Número', 'NO');
/*!40000 ALTER TABLE `tipo_contador` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
