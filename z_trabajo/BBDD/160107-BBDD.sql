-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.0.17-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.5038
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
  `lugar` varchar(50) DEFAULT NULL,
  `provincia` varchar(25) DEFAULT NULL,
  `kilometros` varchar(50) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `precio` double NOT NULL,
  `tipo_cambio` varchar(50) NOT NULL,
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
  `year` varchar(6) NOT NULL,
  `combustible` varchar(15) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `carroceria` varchar(50) NOT NULL,
  `version` varchar(50) NOT NULL,
  `fechaStatus` datetime NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '1=Dato valido, 0= Borrado',
  PRIMARY KEY (`idModelo`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla vidal.modelos: ~87 rows (aproximadamente)
/*!40000 ALTER TABLE `modelos` DISABLE KEYS */;
INSERT IGNORE INTO `modelos` (`idModelo`, `marca`, `year`, `combustible`, `modelo`, `carroceria`, `version`, `fechaStatus`, `status`) VALUES
	(1, 'Audi', '1982', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo', '2016-01-04 18:24:28', 1),
	(2, 'Audi', '1982', 'Gasolina', 'Allroad Quattro', 'Coupé 2p', 'QUATTRO 2.1', '2016-01-04 19:09:20', 1),
	(3, 'Audi', '1983', 'Gasolina', '100', 'Berlina 4p', '100 2.2 CD A.A.', '2016-01-04 18:27:46', 1),
	(4, 'Audi', '1983', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo', '2016-01-04 18:27:17', 1),
	(5, 'Audi', '1983', 'Gasolina', 'Allroad Quattro', 'Coupé 2p', 'QUATTRO 2.1', '2016-01-04 19:09:38', 1),
	(6, 'Audi', '1984', 'Gasolina', '100', 'Berlina 4p', '100 2.2 CD A.A.', '2016-01-04 18:32:12', 1),
	(7, 'Audi', '1984', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo', '2016-01-04 18:33:35', 1),
	(8, 'Audi', '1984', 'Gasolina', 'Allroad Quattro', 'Coupé 2p', 'QUATTRO 2.1', '2016-01-04 19:20:44', 1),
	(9, 'Audi', '1985', 'Gasolina', '100', 'Berlina 4p', '100 2.2 CD A.A.', '2016-01-04 18:51:26', 1),
	(10, 'Audi', '1985', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo', '2016-01-04 18:53:26', 1),
	(11, 'Audi', '1985', 'Gasolina', '200', 'Berlina 4p', '200 2.2 CD', '2016-01-04 18:56:02', 1),
	(12, 'Audi', '1985', 'Gasolina', 'Allroad Quattro', 'Coupé 2p', 'QUATTRO 2.1', '2016-01-04 19:08:54', 1),
	(13, 'Audi', '1985', 'Gasolina', '80', 'Berlina 4p', '80 1.8 GTE', '2016-01-04 19:26:50', 1),
	(14, 'Audi', '1985', 'Gasolina', '90', 'Berlina 4p', '90 2.2 CD', '2016-01-04 19:29:31', 1),
	(15, 'Audi', '1986', 'Gasolina', '100', 'Berlina 4p', '100 2.2 CD A.A.', '2016-01-04 19:37:40', 1),
	(16, 'Audi', '1986', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo', '2016-01-04 19:40:02', 1),
	(17, 'Audi', '1986', 'Gasolina', 'Allroad Quattro', 'Coupé 2p', 'QUATTRO 2.1', '2016-01-04 19:42:31', 1),
	(18, 'Audi', '1986', 'Gasolina', '80', 'Berlina 4p', '80 1.8 GTE', '2016-01-04 19:43:02', 1),
	(19, 'Audi', '1986', 'Gasolina', '90', 'Berlina 4p', '90 2.2 CD', '2016-01-04 19:44:12', 1),
	(20, 'Audi', '1986', 'Gasolina', '90', 'Berlina 4p', '90 2.2 QUATTRO', '2016-01-04 19:49:28', 1),
	(21, 'Audi', '1987', 'Gasolina', '100', 'Berlina 4p', '100 2.2 CD A.A.', '2016-01-04 19:51:35', 1),
	(22, 'Audi', '1987', 'Gasolina', '100', 'Berlina 4p', '100 2.2 CD A.A. AUT.', '2016-01-04 19:52:10', 1),
	(23, 'Audi', '1987', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo', '2016-01-04 19:52:42', 1),
	(24, 'Audi', '1987', 'Gasolina', '200', 'Berlina 4p', '2.2 Quattro Turbo', '2016-01-04 19:53:14', 1),
	(25, 'Audi', '1987', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo Aut.', '2016-01-04 19:53:49', 1),
	(26, 'Audi', '1987', 'Gasolina', '100', 'Familiar 5p', '100 AVANT 2.2 CD A.A.', '2016-01-04 19:54:35', 1),
	(27, 'Audi', '1987', 'Gasolina', '80', 'Berlina 4p', '80 1.8 E', '2016-01-04 19:57:50', 1),
	(28, 'Audi', '1987', 'Gasolina', '90', 'Berlina 4p', '90 2.2 E', '2016-01-04 19:55:53', 1),
	(29, 'Audi', '1987', 'Gasolina', 'Allroad Quattro', 'Coupé 2p', 'QUATTRO 2.1', '2016-01-04 19:56:21', 1),
	(30, 'Audi', '1987', 'Gasolina', 'Coupe', 'Coupé 2p', 'COUPE 2.2 GT QUATTRO A.A.', '2016-01-04 19:59:07', 1),
	(31, 'Audi', '1987', 'Gasolina', 'Coupe', 'Coupé 2p', 'COUPE 2.2E GT A.A.', '2016-01-04 19:59:52', 1),
	(32, 'Audi', '1987', 'Diesel', '100', 'Berlina 4p', '100 2.2 CD TD A.A.', '2016-01-06 10:23:15', 1),
	(33, 'Audi', '1988', 'Gasolina', '100', 'Berlina 4p', '100 2.2 CD A.A.', '2016-01-06 10:25:33', 1),
	(34, 'Audi', '1988', 'Gasolina', '100', 'Berlina 4p', '100 2.2 CD A.A. AUT.', '2016-01-06 10:25:57', 1),
	(35, 'Audi', '1988', 'Gasolina', '100', 'Familiar 5p', '100 AVANT 2.2 CD A.A.', '2016-01-06 10:26:44', 1),
	(36, 'Audi', '1988', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo', '2016-01-06 10:27:31', 1),
	(37, 'Audi', '1988', 'Gasolina', '200', 'Berlina 4p', '2.2 Quattro Turbo', '2016-01-06 10:27:56', 1),
	(38, 'Audi', '1988', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo Aut.', '2016-01-06 10:28:19', 1),
	(39, 'Audi', '1988', 'Gasolina', '80', 'Berlina 4p', '80 1.8 E', '2016-01-06 10:28:55', 1),
	(40, 'Audi', '1988', 'Gasolina', '90', 'Berlina 4p', '90 2.2 E', '2016-01-06 10:29:28', 1),
	(41, 'Audi', '1988', 'Gasolina', 'Allroad Quattro', 'Coupé 2p', 'QUATTRO 2.1', '2016-01-06 10:29:53', 1),
	(42, 'Audi', '1988', 'Gasolina', 'Coupe', 'Coupé 2p', 'COUPE 2.2 GT QUATTRO A.A.', '2016-01-06 10:30:39', 1),
	(43, 'Audi', '1988', 'Gasolina', 'Coupe', 'Coupé 2p', 'COUPE 2.2E GT A.A.', '2016-01-06 10:31:16', 1),
	(44, 'Audi', '1988', 'Diesel', '100', 'Berlina 4p', '100 2.2 CD TD A.A.', '2016-01-06 10:33:01', 1),
	(45, 'Audi', '1989', 'Gasolina', '100', 'Berlina 4p', '100 2.2 E', '2016-01-06 10:34:04', 1),
	(46, 'Audi', '1989', 'Gasolina', '100', 'Berlina 4p', '100 2.2 E AUTOM.', '2016-01-06 10:34:31', 1),
	(47, 'Audi', '1989', 'Gasolina', '100', 'Familiar 5p', '100 AVANT 2.2 E', '2016-01-06 10:35:06', 1),
	(48, 'Audi', '1989', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo', '2016-01-06 10:35:42', 1),
	(49, 'Audi', '1989', 'Gasolina', '200', 'Berlina 4p', '2.2 Quattro Turbo', '2016-01-06 10:36:01', 1),
	(50, 'Audi', '1989', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo Aut.', '2016-01-06 10:36:19', 1),
	(51, 'Audi', '1989', 'Gasolina', '80', 'Berlina 4p', '80 1.8 E', '2016-01-06 10:36:53', 1),
	(52, 'Audi', '1989', 'Gasolina', '80', 'Berlina 4p', '80 1.8 E SPECIAL', '2016-01-06 10:37:19', 1),
	(53, 'Audi', '1989', 'Gasolina', '90', 'Berlina 4p', '90 2.2 E', '2016-01-06 10:37:53', 1),
	(54, 'Audi', '1989', 'Gasolina', '90', 'Berlina 4p', '90 20V', '2016-01-06 10:38:18', 1),
	(55, 'Audi', '1989', 'Gasolina', '90', 'Berlina 4p', '90 20V QUATTRO', '2016-01-06 10:38:42', 1),
	(56, 'Audi', '1989', 'Gasolina', 'Coupe', 'Coupé 2p', 'COUPE 2.0 20V QUATTRO', '2016-01-06 10:39:48', 1),
	(57, 'Audi', '1989', 'Gasolina', 'Coupe', 'Coupé 2p', 'COUPE 2.2E GT A.A.', '2016-01-06 10:40:16', 1),
	(58, 'Audi', '1989', 'Gasolina', 'V8', 'Berlina 4p', 'V8 3.6 AUT.', '2016-01-06 10:41:11', 1),
	(59, 'Audi', '1989', 'Diesel', '100', 'Berlina 4p', '2.0 CD TD', '2016-01-06 10:42:11', 1),
	(60, 'Audi', '1990', 'Gasolina', '100', 'Berlina 4p', '100 2.2 E', '2016-01-06 10:43:39', 1),
	(61, 'Audi', '1990', 'Gasolina', '100', 'Berlina 4p', '100 2.2 CD', '2016-01-06 10:44:06', 1),
	(62, 'Audi', '1990', 'Gasolina', '100', 'Berlina 4p', '100 2.2 CD AUT.', '2016-01-06 10:44:25', 1),
	(63, 'Audi', '1990', 'Gasolina', '100', 'Berlina 4p', '100 2.2 E AUTOM.', '2016-01-06 10:44:55', 1),
	(64, 'Audi', '1990', 'Gasolina', '100', 'Familiar 5p', '100 AVANT 2.2 E', '2016-01-06 10:45:46', 1),
	(65, 'Audi', '1990', 'Gasolina', '100', 'Familiar 5p', '100 AVANT 2.2 CD', '2016-01-06 10:46:10', 1),
	(66, 'Audi', '1990', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo', '2016-01-06 10:48:00', 1),
	(67, 'Audi', '1990', 'Gasolina', '200', 'Berlina 4p', '2.2 Quattro Turbo', '2016-01-06 10:48:24', 1),
	(68, 'Audi', '1990', 'Gasolina', '200', 'Berlina 4p', '2.2 Turbo Aut.', '2016-01-06 10:48:51', 1),
	(69, 'Audi', '1990', 'Gasolina', '80', 'Berlina 4p', '80 1.8 E', '2016-01-06 10:49:26', 1),
	(70, 'Audi', '1990', 'Gasolina', '80', 'Berlina 4p', '80 1.8 E SPECIAL', '2016-01-06 10:49:47', 1),
	(71, 'Audi', '1990', 'Gasolina', '90', 'Berlina 4p', '90 2.2 E', '2016-01-06 10:50:33', 1),
	(72, 'Audi', '1990', 'Gasolina', '90', 'Berlina 4p', '90 2.2 SPORT A.A.', '2016-01-06 10:51:31', 1),
	(73, 'Audi', '1990', 'Gasolina', '90', 'Berlina 4p', '90 2.3 E QUATTRO', '2016-01-06 10:51:59', 1),
	(74, 'Audi', '1990', 'Gasolina', '90', 'Berlina 4p', '90 20V', '2016-01-06 10:52:22', 1),
	(75, 'Audi', '1990', 'Gasolina', '90', 'Berlina 4p', '90 20V QUATTRO', '2016-01-06 10:52:44', 1),
	(76, 'Audi', '1990', 'Gasolina', '90', 'Berlina 4p', '90 20V QUATTRO SPORT', '2016-01-06 10:53:06', 1),
	(77, 'Audi', '1990', 'Gasolina', '90', 'Berlina 4p', '90 20V SPORT', '2016-01-06 10:53:29', 1),
	(78, 'Audi', '1990', 'Gasolina', 'Coupe', 'Coupé 2p', 'COUPE 2.2E A.A.', '2016-01-06 10:54:22', 1),
	(79, 'Audi', '1990', 'Gasolina', 'Coupe', 'Coupé 2p', 'COUPE 2.0 20V', '2016-01-06 10:54:55', 1),
	(80, 'Audi', '1990', 'Gasolina', 'Coupe', 'Coupé 2p', 'COUPE 2.0 20V QUATTRO', '2016-01-06 10:55:32', 1),
	(81, 'Audi', '1990', 'Gasolina', 'Coupe', 'Coupé 2p', 'COUPE 2.2 QUATTRO', '2016-01-06 10:56:00', 1),
	(82, 'Audi', '1989', 'Gasolina', 'V8', 'Berlina 4p', 'V8 3.6 AUT.', '2016-01-06 10:56:29', 1),
	(83, 'Audi', '1990', 'Gasolina', 'V8', 'Berlina 4p', 'V8 3.6 AUT.', '2016-01-06 10:56:59', 1),
	(84, 'Audi', '1990', 'Diesel', '100', 'Berlina 4p', '2.0 CD TD', '2016-01-06 10:57:39', 1),
	(85, 'Audi', '1990', 'Diesel', '100', 'Berlina 4p', '100 2.5 CD TDI', '2016-01-06 10:58:17', 1),
	(86, 'Audi', '1990', 'Diesel', '80', 'Berlina 4p', '1.6 TD', '2016-01-06 10:58:57', 1),
	(87, 'Audi', '1990', 'Diesel', '80', 'Berlina 4p', '1.6 TD SPECIAL', '2016-01-06 10:59:31', 1);
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
