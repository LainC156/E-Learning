create database proyecto_e_learning;

use proyecto_e_learning;

create table usuarios(
	id_usuario INT UNSIGNED AUTO_INCREMENT,
	nombre     varchar(40)  NOT NULL,
	p_apellido varchar(40)  NOT NULL,
	s_apellido varchar(40),
	usuario    varchar(16)  NOT NULL,
	clave      varchar(16)  NOT NULL,
	correo     varchar(100) NOT NULL, 
	telefono   varchar(40)  NOT NULL,
	UNIQUE(id_usuario),
	UNIQUE(usuario),
	PRIMARY KEY(id_usuario)
);