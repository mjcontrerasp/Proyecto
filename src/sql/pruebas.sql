-- ==========================
-- DATOS DE PRUEBA: USUARIOS
-- ==========================

INSERT INTO usuarios (nombre, email, telefono, contrasena_hash, rol)
VALUES 
('Panadería La Espiga', 'espiga@correo.com', '600123123', 'hash123', 'comercio'),
('Frutería El Manzano', 'manzano@correo.com', '600456456', 'hash123', 'comercio'),
('Supermercado AhorraPlus', 'ahorra@correo.com', '600789789', 'hash123', 'comercio'),
('Laura Pérez', 'laura.vol@correo.com', '611111111', 'hash123', 'voluntario'),
('Carlos Gómez', 'carlos.vol@correo.com', '622222222', 'hash123', 'voluntario'),
('María Ruiz', 'maria.vol@correo.com', '633333333', 'hash123', 'voluntario');

-- ======================================
-- DATOS DE PRUEBA: COMERCIOS (ASOCIADOS)
-- ======================================
-- Nota: Los id_usuario 1,2,3 son de rol comercio

INSERT INTO comercios (id_usuario, nombre_comercial, direccion, horario, activo)
VALUES
(1, 'Panadería La Espiga', 'Calle Trigo 12', '08:00 - 14:00', true),
(2, 'Frutería El Manzano', 'Av. Central 45', '09:00 - 21:00', true),
(3, 'Supermercado AhorraPlus', 'Calle Mayor 77', '10:00 - 22:00', true);
