# Arquitectura Tecnológica

## 1. Descripción general
Sistema web SocialFood para gestionar usuarios y comercios, con roles voluntario y comercio.

## 2. Tecnologías utilizadas

| Componente       | Tecnología / Herramienta        | Función                                  |
|-----------------|-------------------------------|----------------------------------------|
| Frontend        | HTML, CSS, JavaScript         | Formularios, interfaz de usuario, redirecciones según rol |
| Backend         | PHP                           | Lógica de negocio, controladores, manejo de sesiones y formularios |
| Base de datos   | phpMyAdmin                    | Almacenamiento de usuarios, comercios y roles |
| Servidor local  | XAMPP                         | Entorno de ejecución local de PHP y MySQL |
| Comunicación    | Fetch / AJAX                  | Envío de datos de formularios sin recargar la página |

## 3. Patrón de arquitectura
- MVC (Modelo-Vista-Controlador)
  - **Modelo:** interacción con la base de datos (`usuario.php`, `comercio.php`)
  - **Vista:** archivos HTML y CSS para la interfaz
  - **Controlador:** PHP que procesa las solicitudes del usuario y devuelve resultados
