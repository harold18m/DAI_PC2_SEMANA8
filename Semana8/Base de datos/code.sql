
// creacion de tabla 
CREATE TABLE `lab08`.`producto` ( `IdProducto` INT NOT NULL AUTO_INCREMENT COMMENT 'Id del producto' , `Nombre` VARCHAR(80) NOT NULL COMMENT 'Nombre' , `Descripcion` VARCHAR(250) NULL COMMENT 'Descripción del producto' , `Stock` INT NOT NULL COMMENT 'Stock del producto' , `PrecioVenta` DECIMAL(40,2) NULL COMMENT 'Precio de venta del producto' , PRIMARY KEY (`IdProducto`)) ENGINE = InnoDB;

