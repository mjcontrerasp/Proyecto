# Análisis del Sistema - SocialFood Badajoz

## Modelo ER
- Usuarios (id, nombre, email, teléfono, rol, contraseña_hash)
- Comercios (id_comercio, nombre_comercial, dirección, horario, activo)
- Donaciones (id_donacion, id_comercio, tipo_alimento, cantidad, estado, fecha_disponible, observaciones, foto_url)
- Contactos (id_contacto, id_donacion, id_usuario, tipo_contacto, fecha_contacto, nota)
- Recogidas (id_recogida, id_donacion, id_voluntario, fecha_recogida, observaciones, foto_entrega)

## Relaciones
- Un comercio tiene muchas donaciones.
- Una donación puede generar múltiples contactos.
- Una donación puede tener una recogida asociada.
- Un usuario puede ser voluntario, comercio o administrador.
