CREATE DATABASE IF NOT EXISTS meteogalicia;
USE meteogalicia;

/*Crear tabla Usuarios*/
CREATE TABLE `meteogalicia`.`Usuarios` ( `id` INT NOT NULL AUTO_INCREMENT , `nick` VARCHAR(16) NOT NULL , `pass` VARCHAR(256) NOT NULL , `rol` VARCHAR(16) NOT NULL , `idEstacion` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

/*Crear tabla Temperaturas*/
CREATE TABLE `meteogalicia`.`Temperaturas` ( `id` INT NOT NULL AUTO_INCREMENT , `id_usuario` INT NOT NULL , `id_estacion` INT NOT NULL , `valTemperatura` VARCHAR(16) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
