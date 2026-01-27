#  Arquitectura Tecnológica

## 1. Descripción general

El sistema **SocialFood** es una aplicación web desarrollada para facilitar la gestión de donaciones de alimentos entre comercios, voluntarios y ONG.  
La aplicación implementa un flujo completo de publicación, recogida y entrega de donaciones, con control de acceso basado en roles.

La arquitectura sigue un modelo en tres capas con patrón MVC, garantizando separación de responsabilidades, escalabilidad y mantenibilidad del código.

---

## 2. Tecnologías utilizadas

| Componente        | Tecnología / Herramienta | Función                                                                 |
|------------------|--------------------------|-------------------------------------------------------------------------|
| Frontend         | HTML5, CSS3, JavaScript  | Interfaz de usuario, formularios, vistas y navegación por roles         |
| Backend          | PHP 8.x                  | Lógica de negocio, controladores, validaciones y gestión de sesiones    |
| Framework        | Laravel 9                | Estructura MVC, routing, ORM, seguridad y middleware                    |
| Base de datos    | MySQL / MariaDB          | Almacenamiento de usuarios, comercios y donaciones                      |
| ORM              | Eloquent (Laravel)       | Acceso y manipulación de datos mediante modelos                         |
| Servidor local   | XAMPP                    | Entorno de desarrollo local (Apache, PHP, MySQL)                        |
| Producción       | AWS EC2 (Ubuntu)         | Despliegue en servidor remoto                                           |
| Servidor web     | Apache / Nginx           | Servicio HTTP en entorno productivo                                     |
| Autenticación    | Laravel Auth             | Login, sesiones y control de acceso                                     |
| Seguridad        | CSRF, Hash, Validaciones | Protección de formularios, contraseñas y entradas de usuario            |

---

## 3. Patrón de arquitectura

El sistema implementa el patrón **MVC (Modelo–Vista–Controlador)**:

- **Modelo**  
  Representa las entidades del sistema y la lógica de acceso a datos.  
  Implementado mediante modelos Eloquent como:  
  `Usuario`, `Comercio`, `Donacion`.

- **Vista**  
  Encargada de la presentación de la información al usuario.  
  Implementada mediante vistas Blade con HTML y CSS.  
  Muestra formularios, listados, paneles y mensajes según el rol del usuario.

- **Controlador**  
  Gestiona las solicitudes HTTP, valida datos y coordina la lógica de negocio.  
  Ejemplos:  
  `AuthController`, `DonacionController`, `ComercioController`, `RegistroController`.

---

## 4. Capas del sistema

### Capa de Presentación  
Interfaz web desarrollada con HTML5, CSS3 y Blade.  
Responsable de mostrar datos, recoger entradas de usuario y ofrecer navegación adaptada por rol.

### Capa de Lógica de Negocio  
Implementada en PHP mediante Laravel.  
Incluye controladores, modelos Eloquent y validaciones.  
Gestiona autenticación, autorización, flujo de estados y reglas del sistema.

### Capa de Datos  
Base de datos relacional MySQL/MariaDB.  
Incluye claves foráneas para garantizar la integridad referencial entre usuarios, comercios y donaciones.

---

## 5. Flujo de Estados de Donaciones

El sistema implementa un flujo de estados para las donaciones:

**No asignada → Asignada → Recogida → Entregada a ONG**

Este flujo permite:
- Asignar donaciones a voluntarios.
- Marcar la recogida desde el comercio.
- Confirmar la entrega en la ONG.
- Mantener trazabilidad completa del proceso.

---

## 6. Seguridad

- Hash de contraseñas mediante Laravel.
- Protección CSRF en formularios.
- Validación de entradas de usuario.
- Autorización por rol (comercio, voluntario, ONG).
- Middleware de autenticación.
- Protección contra accesos no autorizados.

---

## 7. Patrones y principios aplicados

- MVC (Modelo–Vista–Controlador).
- Separación de responsabilidades.
- DRY (Don't Repeat Yourself).
- ORM (Eloquent).
- Validación centralizada.
- Control de acceso por roles.
