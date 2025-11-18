CREATE DATABASE IF NOT EXISTS proyecto;
USE proyecto;

-- Tabla Usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    contrasena_hash VARCHAR(255) NOT NULL,
    rol ENUM('comercio', 'voluntario') NOT NULL
);

CREATE TABLE comercios (
    id_comercio INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    nombre_comercial VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    horario VARCHAR(255),
    activo BOOLEAN NOT NULL DEFAULT true,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);
