	CREATE DATABASE smart_locker;
    
    
    
	USE smart_locker;

	-- Crear tabla de residentes
	CREATE TABLE `residentes` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `nombres` VARCHAR(45) NOT NULL,
	  `apellidos` VARCHAR(45) NOT NULL,
	  `telefono` VARCHAR(45) NOT NULL,
	  `cedula` VARCHAR(45) UNIQUE NOT NULL,
	  `contrasena` VARCHAR(60) NOT NULL, -- Asumiendo el uso de hashes de contraseñas
	  PRIMARY KEY (`id`)
	);

	-- Crear tabla de propietarios
	CREATE TABLE `propietarios` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `nombres` VARCHAR(45) NOT NULL,
	  `apellidos` VARCHAR(45) NOT NULL,
	  `telefono` VARCHAR(45) NOT NULL,
	  `cedula` VARCHAR(45) UNIQUE NOT NULL,
	  `contrasena` VARCHAR(60) NOT NULL,
	  PRIMARY KEY (`id`)
	);

	-- Crear tabla de agentes de seguridad
	CREATE TABLE `agente_de_seguridad` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `nombres` VARCHAR(45) NOT NULL,
	  `apellidos` VARCHAR(45) NOT NULL,
	  `cedula` VARCHAR(45) UNIQUE NOT NULL,
	  `contrasena` VARCHAR(60) NOT NULL,
	  PRIMARY KEY (`id`)
	);

	-- Crear tabla de administradores
	CREATE TABLE `administrador` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `nombre` VARCHAR(45) NOT NULL,
	  `apellidos` VARCHAR(45) NOT NULL,
	  `cedula` VARCHAR(45) UNIQUE NOT NULL,
	  `contrasena` VARCHAR(60) NOT NULL,
	  PRIMARY KEY (`id`)
	);

	-- Crear tabla de barrios
	CREATE TABLE `barrio` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `barrio` VARCHAR(45) NOT NULL,
	  PRIMARY KEY (`id`)
	);

	-- Crear tabla de municipios
	CREATE TABLE `municipio` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `municipio` VARCHAR(45) NOT NULL,
	  PRIMARY KEY (`id`)
	);

	-- Crear tabla de departamentos
	CREATE TABLE `departamento` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `departamento` VARCHAR(45) NOT NULL,
	  PRIMARY KEY (`id`)
	);

	-- Crear tabla de códigos postales
	CREATE TABLE `codigo_postal` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `codigo_postal` VARCHAR(45),
	  PRIMARY KEY (`id`)
	);

	-- Crear tabla de apartamentos
	CREATE TABLE `apartamento` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `cedula_propietario` VARCHAR(45),
	  PRIMARY KEY (`id`),
	  FOREIGN KEY (`cedula_propietario`) REFERENCES `propietarios`(`cedula`)
	);

	-- Crear tabla de tipos de paquete
	CREATE TABLE `tipo_paquete` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `tipo` VARCHAR(45),
	  PRIMARY KEY (`id`)
	);

	-- Crear tabla de empresas
	CREATE TABLE `empresa` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `nombre` VARCHAR(45),
	  PRIMARY KEY (`id`)
	);


	INSERT INTO residentes (nombres, apellidos, telefono, cedula, contrasena) VALUES 
	('Andrey Sneider', 'Rodriguez Cantor', '+57 3007508985', '1032484124', '12345'),
	('Haver Alexis', 'Ramirez Botero', '+57 3133901966', '313390555', '1255'),
	('Heiver Alejandro', 'Ruiz Ramirez', '+57 3046076604', '65242', '568'),
	('Wendy Yurani', 'Torres Vergara', '+57 3203395705', '51512161', '3655'),
	('Pepito Jorge', 'Sanchez Belga', '+57 3003014569', '101235423', '54623');

	INSERT INTO propietarios (nombres, apellidos, telefono, cedula, contrasena) VALUES 
	('Andrey Sneider', 'Rodriguez Cantor', '+57 3007508985', '1032484124', '6985'),
	('Haver Alexis', 'Ramirez Botero', '+57 3133901966', '152645', '5463'),
	('Heiver Alejandro', 'Ruiz Ramirez', '+57 3046076604', '15421', '21365'),
	('Wendy Yurani', 'Torres Vergara', '+57 3203395705', '512154', '5462');

	-- Insertar datos en la tabla agente_de_seguridad
	INSERT INTO agente_de_seguridad (nombres, apellidos, cedula, contrasena) VALUES
	('Andrey Sneider', 'Rodriguez Cantor', '1032484124', '123'),
	('Anderson', 'Moral', '1024556312', '2135'),
	('Luisa', 'Fernandez', '12259845', '563'),
	('Alfonsina', 'Rozana', '2156623', '232651'),
	('Andresillo', 'Dieta', '3262642', '5423');

	-- Insertar datos en la tabla administrador
	INSERT INTO administrador (nombre, apellidos, cedula, contrasena) VALUES
	('Jaimito', 'El Cartero', '12345678', '123456');