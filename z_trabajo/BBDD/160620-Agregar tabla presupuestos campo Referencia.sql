-- agregar presupuestos.Referencia
ALTER TABLE `presupuestos`
	ADD COLUMN `Referencia` VARCHAR(70) NULL DEFAULT NULL AFTER `total`;

-- agregar empresas.Cabecera
ALTER TABLE `empresas`
	CHANGE COLUMN `Logo` `Logo` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Nombre Imagen Logo(png)' AFTER `TipoContador`,
	ADD COLUMN `Cabecera` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Imagen Cabecera(png)' AFTER `Logo`;
