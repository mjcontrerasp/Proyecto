-- ==========================
-- DATOS DE PRUEBA: USUARIOS
-- ==========================
INSERT INTO usuarios (nombre, email, telefono, contrasena_hash, rol)
VALUES 
('Panadería La Espiga', 'espiga@correo.com', '600123123', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'comercio'),
('Frutería El Manzano', 'manzano@correo.com', '600456456', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'comercio'),
('Supermercado AhorraPlus', 'ahorra@correo.com', '600789789', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'comercio'),
('Laura Pérez', 'laura.vol@correo.com', '611111111', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'voluntario'),
('Carlos Gómez', 'carlos.vol@correo.com', '622222222', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'voluntario'),
('María Ruiz', 'maria.vol@correo.com', '633333333', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'voluntario'),
('ONG AyudaComida', 'ayuda@ong.com', '644444444', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ong'),
('ONG Alimenta', 'alimenta@ong.com', '655555555', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ong');

-- ==========================
-- DATOS DE PRUEBA: COMERCIOS
-- ==========================
INSERT INTO comercios (id_usuario, nombre_comercial, direccion, horario, activo)
VALUES
(1, 'Panadería La Espiga', 'Calle Trigo 12', '08:00 - 14:00', true),
(2, 'Frutería El Manzano', 'Av. Central 45', '09:00 - 21:00', true),
(3, 'Supermercado AhorraPlus', 'Calle Mayor 77', '10:00 - 22:00', true);

-- ==========================
-- DATOS DE PRUEBA: DONACIONES
-- ==========================
INSERT INTO donaciones (id_usuario, id_voluntario_asignado, tipo_comida, cantidad, fecha_hora, punto_recogida, observaciones, estado, id_ong_destino)
VALUES
(1, 4, 'Pan', 10.50, '2026-01-28 10:00:00', 'Calle Trigo 12', 'Pan integral y baguettes', 'No asignada', 7),
(2, 5, 'Frutas', 25.00, '2026-01-28 12:00:00', 'Av. Central 45', 'Manzanas y naranjas', 'No asignada', 7),
(3, NULL, 'Verduras', 50.00, '2026-01-28 15:00:00', 'Calle Mayor 77', 'Tomates y lechugas', 'No asignada', 8);