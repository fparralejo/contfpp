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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla vidal.empresas: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT IGNORE INTO `empresas` (`idEmpresa`, `empresa`, `nombre`, `pass`, `direccion`, `localidad`, `provincia`, `pais`, `CP`, `CIFNIF`, `fechaStatus`, `status`) VALUES
	(1, 'vidal', 'Coches Vidal', 'vidal', 'Calle Lope de Vega 33', 'Madrid', 'Madrid', 'España', '28022', NULL, '2015-12-27 00:36:36', 1);
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;


-- Volcando estructura para tabla vidal.opciones_perfiles
DROP TABLE IF EXISTS `opciones_perfiles`;
CREATE TABLE IF NOT EXISTS `opciones_perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcion` varchar(50) NOT NULL,
  `perfiles` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla vidal.opciones_perfiles: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `opciones_perfiles` DISABLE KEYS */;
INSERT IGNORE INTO `opciones_perfiles` (`id`, `opcion`, `perfiles`) VALUES
	(1, 'menuEmpresa', '1,'),
	(2, 'menuUsuario', '1,');
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
  `NIF` varchar(15) NOT NULL,
  `idPerfil` int(10) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fechaStatus` datetime NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '1=Dato valido, 0= Borrado',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla vidal.usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT IGNORE INTO `usuarios` (`idUsuario`, `idEmpresa`, `usuario`, `pass`, `nombre`, `apellidos`, `NIF`, `idPerfil`, `email`, `telefono`, `fechaStatus`, `status`) VALUES
	(1, 1, 'vidal', 'vidal', 'Francisco Jose', 'Vidal', '25365145K', 1, 'fvidal@fonsica.com', '672634559', '2015-12-27 00:38:14', 1),
	(2, 1, 'paco', 'paco', 'Francisco', 'Parralejo', '08365987L', 2, NULL, NULL, '2015-12-27 00:00:00', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
