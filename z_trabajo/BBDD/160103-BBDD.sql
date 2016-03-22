-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.0.17-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.5036
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla vidal.anuncio
DROP TABLE IF EXISTS `anuncio`;
CREATE TABLE IF NOT EXISTS `anuncio` (
  `idAnuncio` int(11) NOT NULL AUTO_INCREMENT,
  `idContacto` int(11) NOT NULL,
  `idModelo` int(11) NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `provincia` varchar(25) NOT NULL,
  `kilometros` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `precio` double NOT NULL,
  `observaciones` longtext NOT NULL,
  `fechaStatus` datetime NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '1=Dato valido, 0= Borrado, 2=Sin Confirmar',
  PRIMARY KEY (`idAnuncio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla vidal.anuncio: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `anuncio` DISABLE KEYS */;
/*!40000 ALTER TABLE `anuncio` ENABLE KEYS */;


-- Volcando estructura para tabla vidal.anuncios_adjuntos
DROP TABLE IF EXISTS `anuncios_adjuntos`;
CREATE TABLE IF NOT EXISTS `anuncios_adjuntos` (
  `idAdjunto` int(11) NOT NULL AUTO_INCREMENT,
  `idAnuncio` int(11) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `sitio` varchar(200) NOT NULL COMMENT 'carpeta en host o url (youtube p. ej)',
  `fechaStatus` datetime NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '1=Dato valido, 0= Borrado',
  PRIMARY KEY (`idAdjunto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla vidal.anuncios_adjuntos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `anuncios_adjuntos` DISABLE KEYS */;
/*!40000 ALTER TABLE `anuncios_adjuntos` ENABLE KEYS */;


-- Volcando estructura para tabla vidal.contacto
DROP TABLE IF EXISTS `contacto`;
CREATE TABLE IF NOT EXISTS `contacto` (
  `idContacto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fechaStatus` datetime NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '1=Dato valido, 0= Borrado, 2=Sin Confirmar',
  PRIMARY KEY (`idContacto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla vidal.contacto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contacto` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacto` ENABLE KEYS */;


-- Volcando estructura para tabla vidal.empresas
DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `pass` varchar(15) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `CP` varchar(10) DEFAULT NULL,
  `CIFNIF` varchar(20) DEFAULT NULL,
  `fechaStatus` datetime NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '1=Dato valido, 0= Borrado',
  PRIMARY KEY (`idEmpresa`),
  UNIQUE KEY `empresa` (`empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla vidal.empresas: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT IGNORE INTO `empresas` (`idEmpresa`, `empresa`, `nombre`, `pass`, `direccion`, `localidad`, `provincia`, `pais`, `CP`, `CIFNIF`, `fechaStatus`, `status`) VALUES
	(1, 'vidal', 'Coches Vidal total', 'vidal', 'Calle Lope de Vega 33', 'Madrid', 'Madrid', 'España', '28022', '', '2015-12-31 10:53:29', 1),
	(2, 'typsa', 'tecnicas y proyectos sa', 'typsa', 'calle gomera 9', 'San Sebastián de los Reyes', 'Madrid', 'España', '28000', 'B52365987L', '2015-12-31 10:43:47', 1),
	(3, 'tarmada', 'tierra armada', 'tarmada', 'calle los claveles 191', 'Móstoles', 'Madrid', 'España', '', '52363254K', '2015-12-31 10:37:00', 1),
	(4, 'fck', 'fck estructural sl', 'fck', 'calle raimundio lulio 9', 'Algete', 'Madrid', 'España', '28555', '5632654g', '2015-12-31 11:01:18', 1),
	(5, 'qualidad', 'qualidad consulting de sistemas', 'qualidad', 'calle diego de leon 67', 'Madrid', 'Madrid', 'España', '28404', '08037044L', '2015-12-31 11:01:03', 1);
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;


-- Volcando estructura para tabla vidal.modelos
DROP TABLE IF EXISTS `modelos`;
CREATE TABLE IF NOT EXISTS `modelos` (
  `idModelo` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) NOT NULL,
  `year_inicio` varchar(6) NOT NULL,
  `year_fin` varchar(6) NOT NULL,
  `combustible` varchar(15) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `carroceria` varchar(50) NOT NULL,
  `version` varchar(50) NOT NULL,
  `tipo_cambio` varchar(50) NOT NULL,
  `fechaStatus` datetime NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '1=Dato valido, 0= Borrado',
  PRIMARY KEY (`idModelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla vidal.modelos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `modelos` DISABLE KEYS */;
/*!40000 ALTER TABLE `modelos` ENABLE KEYS */;


-- Volcando estructura para tabla vidal.opciones_perfiles
DROP TABLE IF EXISTS `opciones_perfiles`;
CREATE TABLE IF NOT EXISTS `opciones_perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcion` varchar(50) NOT NULL,
  `perfiles` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla vidal.opciones_perfiles: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `opciones_perfiles` DISABLE KEYS */;
INSERT IGNORE INTO `opciones_perfiles` (`id`, `opcion`, `perfiles`) VALUES
	(1, 'menuEmpresa', '1'),
	(2, 'menuUsuario', '1'),
	(3, 'menuPerfil', '1'),
	(4, 'menuAsigPerfil', '1'),
	(5, 'menuModelo', '1,2');
/*!40000 ALTER TABLE `opciones_perfiles` ENABLE KEYS */;


-- Volcando estructura para tabla vidal.perfiles
DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE IF NOT EXISTS `perfiles` (
  `idPerfil` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(50) NOT NULL,
  `fechaStatus` datetime NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '1=Dato valido, 0= Borrado',
  PRIMARY KEY (`idPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla vidal.perfiles: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT IGNORE INTO `perfiles` (`idPerfil`, `perfil`, `fechaStatus`, `status`) VALUES
	(1, 'Administrador', '2015-12-27 00:39:38', 1),
	(2, 'Empleado', '2015-12-27 11:49:33', 1);
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;


-- Volcando estructura para tabla vidal.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(10) NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(10) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `pass` varchar(15) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `NIF` varchar(15) DEFAULT NULL,
  `idPerfil` int(10) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fechaStatus` datetime NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '1=Dato valido, 0= Borrado',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla vidal.usuarios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT IGNORE INTO `usuarios` (`idUsuario`, `idEmpresa`, `usuario`, `pass`, `nombre`, `apellidos`, `NIF`, `idPerfil`, `email`, `telefono`, `fechaStatus`, `status`) VALUES
	(1, 1, 'vidal', 'vidal', 'Francisco Jose', 'Vidal', '25365145K', 1, 'fvidal@fonsica.com', '672634559', '2015-12-27 00:38:14', 1),
	(2, 1, 'paco', 'paco', 'Francisco', 'Parralejo', '08365987L', 2, NULL, NULL, '2015-12-27 00:00:00', 1),
	(4, 2, 'jose', 'jose', 'Jose Luis', 'Villalba Muñoz', '089966335H', 2, 'flanagan2323@gmail.com', '', '2016-01-01 02:44:20', 0),
	(5, 2, 'armando', 'armando', 'Armando', 'Lopez Redondo', '56323145', 2, '', '', '2016-01-01 02:47:50', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
