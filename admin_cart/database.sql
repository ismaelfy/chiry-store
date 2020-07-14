CREATE DATABASE IF NOT EXISTS DB_PUNTO_VENTA;
USE DB_PUNTO_VENTA;

create table sucursal(
id int auto_increment,

)


CREATE TABLE TIPO_USUARIO(
	id INT auto_increment,
	nombre varchar(20),
	primary key (id)
);

create table usuario(
id int auto_increment,
apellido varchar(100),
nombre varchar(100),
user varchar(100),
pwd varchar(100),
tipo int,
primary key(id)
);
