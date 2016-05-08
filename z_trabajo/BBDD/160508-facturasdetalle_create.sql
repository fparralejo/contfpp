CREATE TABLE `facturasdetalle` (
	`IdFacturaDetalle` INT(11) NOT NULL AUTO_INCREMENT,
	`IdFactura` INT(11) NOT NULL,
	`NumLineaFactura` INT(11) NOT NULL,
	`IdPedido` INT(11) NOT NULL,
	`NumLineaPedido` INT(11) NOT NULL,
	`IdPresupuesto` INT(11) NOT NULL,
	`NumLineaPresup` INT(11) NOT NULL,
	`IdArticulo` INT(11) NULL DEFAULT NULL,
	`DescripcionProducto` LONGTEXT NULL,
	`TipoIVA` DOUBLE NULL DEFAULT NULL,
	`Cantidad` DOUBLE NULL DEFAULT NULL,
	`ImporteUnidad` DOUBLE NULL DEFAULT NULL COMMENT 'Importe Unidad',
	`Importe` DOUBLE NULL DEFAULT NULL,
	`CuotaIva` DOUBLE NULL DEFAULT NULL,
	`Borrado` INT(5) NOT NULL DEFAULT '1' COMMENT '1=Valido, 0= Borrado',
	PRIMARY KEY (`IdFacturaDetalle`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;
