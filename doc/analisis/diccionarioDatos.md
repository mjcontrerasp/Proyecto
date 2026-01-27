# Diccionario de Datos

## Tabla `usuarios`
| Campo           | Tipo        | Nulo | Clave | Descripción                            |
|-----------------|------------|------|-------|----------------------------------------|
| id_usuario      | int(11)    | NO   | PRI   | Identificador único de usuario         |
| nombre          | varchar(100)| NO   |       | Nombre del usuario                      |
| email           | varchar(255)| NO  | UNI   | Correo electrónico del usuario          |
| telefono        | varchar(20)| SÍ   |       | Teléfono del usuario                     |
| contrasena_hash | varchar(255)| SÍ  |       | Contraseña del usuario (texto plano)    |
| rol             | enum       | NO   |       | Rol del usuario: voluntario, comercio, admin |

## Tabla `comercios`
| Campo           | Tipo        | Nulo | Clave | Descripción                                  |
|-----------------|------------|------|-------|----------------------------------------------|
| id_comercio     | int(11)    | NO   | PRI   | Identificador único del comercio             |
| id_usuario      | int(11)    | NO   | FK    | Relación con usuario (dueño del comercio)   |
| nombre_comercial| varchar(255)| NO  |       | Nombre del comercio                           |
| direccion       | varchar(255)| SÍ  |       | Dirección física del comercio                 |
| horario         | varchar(100)| SÍ  |       | Horario de apertura                           |
| activo          | tinyint(1) | NO   |       | Estado activo (1 = activo, 0 = inactivo)    |


## Tabla: `donaciones`

| Campo                  | Tipo           | Nulo | Clave | Descripción |
|------------------------|----------------|------|--------|-------------|
| id                     | INT (AUTO_INCREMENT) | NO   | PK     | Identificador único de la donación |
| id_usuario             | INT            | NO   | FK     | Usuario (comercio) que publica la donación |
| id_voluntario_asignado | INT            | SÍ   | FK     | Usuario voluntario asignado |
| id_ong_destino         | INT            | SÍ   | FK     | Usuario ONG destino |
| tipo_comida            | VARCHAR(255)  | NO   | —      | Tipo de comida donada |
| cantidad               | DECIMAL(8,2)  | NO   | —      | Cantidad de comida |
| fecha_hora             | DATETIME      | NO   | —      | Fecha y hora límite de recogida |
| punto_recogida         | VARCHAR(255)  | NO   | —      | Punto de recogida |
| observaciones          | TEXT          | SÍ   | —      | Observaciones adicionales |
| foto                   | VARCHAR(255)  | SÍ   | —      | Ruta a la imagen |
| estado                 | VARCHAR(50)   | NO   | —      | Estado de la donación |
| created_at             | TIMESTAMP     | SÍ   | —      | Fecha de creación |
| updated_at             | TIMESTAMP     | SÍ   | —      | Fecha de actualización |

---
