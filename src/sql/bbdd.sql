CREATE DATABASE IF NOT EXISTS proyecto;
USE proyecto;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    contrasena_hash VARCHAR(255) NOT NULL,
    rol ENUM('voluntario', 'comercio', 'ong') NOT NULL
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
CREATE TABLE donaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_voluntario_asignado INT NULL,
    tipo_comida VARCHAR(255) NOT NULL,
    cantidad DECIMAL(8,2) NOT NULL,
    fecha_hora DATETIME NOT NULL,
    punto_recogida VARCHAR(255) NOT NULL,
    observaciones TEXT NULL,
    foto VARCHAR(255) NULL,
    estado VARCHAR(50) NOT NULL DEFAULT 'No asignada',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    id_ong_destino INT NULL

    CONSTRAINT fk_donaciones_usuario
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
);
