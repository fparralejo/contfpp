CREATE TABLE `facturas` (
	`IdFactura` INT(11) NOT NULL AUTO_INCREMENT,
	`NumFactura` VARCHAR(50) NOT NULL,
	`IdCliente` VARCHAR(15) NOT NULL,
	`IdPresupuesto` VARCHAR(11) NULL DEFAULT NULL,
	`IdPedido` VARCHAR(11) NULL DEFAULT NULL,
	`FechaFactura` DATETIME NOT NULL,
	`FechaVtoFactura` DATETIME NOT NULL,
	`FormaPago` VARCHAR(50) NULL DEFAULT NULL,
	`Estado` VARCHAR(15) NULL DEFAULT NULL COMMENT 'Emitida,Contabilizada,Anulada',
	`Retencion` DOUBLE NULL DEFAULT '0',
	`Borrado` INT(11) NULL DEFAULT '1' COMMENT '1=Activo, 0=Borrado',
	`BaseImponible` DOUBLE NULL DEFAULT '0',
	`Cuota` DOUBLE NULL DEFAULT '0',
	`CuotaRetencion` DOUBLE NULL DEFAULT '0' COMMENT 'Cuota IRPF',
	`total` DOUBLE NULL DEFAULT '0',
	`asiento` INT(11) NULL DEFAULT '0',
	`Referencia` VARCHAR(70) NULL DEFAULT NULL,
	`CC_Trans` VARCHAR(30) NULL DEFAULT NULL,
	`esAbono` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Se escribe la factura que se anula (NumFactura)',
	PRIMARY KEY (`IdFactura`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;
