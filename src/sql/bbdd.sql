CREATE DATABASE IF NOT EXISTS proyecto;
USE proyecto;

-- Tabla Usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    contraseña_hash VARCHAR(255) NOT NULL,
    rol ENUM('comercio', 'ong', 'voluntario', 'admin') NOT NULL
);

-- Tabla Comercios
CREATE TABLE comercios (
    id_comercio INT,
    nombre_comercial VARCHAR(150) NOT NULL,
    direccion VARCHAR(255),
    horario VARCHAR(100),
    activo BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (id_comercio),
    CONSTRAINT fk_comercio_usuario 
        FOREIGN KEY (id_comercio) REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);