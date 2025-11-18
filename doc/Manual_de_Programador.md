# Manual del Programador

## 1. Introducción
Este manual describe la estructura y funcionamiento del código de la aplicación.  
Incluye controladores PHP, modelos, scripts JS y la interacción entre cliente y servidor.

---

## 2. Estructura de directorios
```text
proyecto:
│   .gitignore
│   README.md
│
├───doc
│   │   Manual_de_Instalacion.md
│   │   Manual_de_Programador.md
│   │   Manual_de_Usuario.md
│   │
│   ├───analisis
│   │       Análisis del Sistema de Información SocialFood.pdf
│   │       Arquitectura_Tecnologica.md
│   │       ER.md
│   │       Product_Backlog.md
│   │
│   ├───diseño
│   │       Bocetos.md
│   │       Guia_Estilos.md
│   │
│   └───sprints
│           sprints1.log
│
└───src
    ├───sql
    │       bbdd.sql
    │       datos.sql
    │       pruebas.sql
    │
    └───www
        │   config.php
        │   index.php
        │
        ├───controlador
        │       comercioControlador.php
        │       loginControlador.php
        │       registroControlador.php
        │
        ├───css
        │       comercio.css
        │       index.css
        │       registrar_usuario.css
        │       voluntario.css
        │
        ├───js
        │       index.js
        │       registrar-comercio.js
        │       registrar-usuario.js
        │
        ├───modelo
        │       comercio.php
        │       usuario.php
        │
        ├───servicios
        │       bd.php
        │
        └───vista
            └───html
                    comercio.html
                    index.html
                    registrar_usuario.html
                    registro-comercio.html
                    voluntario.html


```

------

## 3. Controladores
- **loginControlador.php**  
  Gestiona el login de los usuarios. Recibe correo y contraseña, verifica la base de datos y devuelve el rol.

- **registroControlador.php**  
  Gestiona el registro de usuarios. Valida los datos recibidos y guarda en la base de datos.

- **comercioControlador.php**  
  Gestiona el registro de los comercios. Solo se activa si un usuario tiene rol “comercio”.

---

## 4. Modelos
- **Usuario.php**  
  Contiene métodos para:
    - `registrar(nombre, email, telefono, password, rol)`  
    - `buscarUsuario(email, password)`  
  Gestiona la interacción con la tabla `usuarios`.

- **Comercio.php**  
  Contiene método para:
    - `registrar(id_usuario, nombre_comercial, direccion, horario, activo)`  
  Gestiona la interacción con la tabla `comercios`.

---

## 5. Scripts JavaScript
- **index.js**  
  Maneja el login. Envía los datos del formulario usando `fetch` (AJAX) al controlador de login y redirige según el rol.

- **registrar-usuario.js**  
  Maneja el registro de usuarios. Envía los datos al controlador de registro y redirige según rol.

- **registrar-comercio.js**  
  Maneja el registro de comercios. Envía los datos al controlador de comercio y confirma registro.

> Todos los scripts usan `FormData` para enviar datos sin recargar la página.

---

## 6. Comunicación cliente-servidor
- Los formularios usan `fetch` para enviar datos vía POST al backend.
- El backend responde con texto plano (`OK:rol:id`) o errores (`ERROR:<mensaje>`).
- Dependiendo del rol, el JS redirige al usuario a la sección correspondiente.

---

## 7. Base de datos
- **Tabla `usuarios`**:  
  - Campos: id_usuario, nombre, email, telefono, contrasena_hash, rol
- **Tabla `comercios`**:  
  - Campos: id_comercio, id_usuario, nombre_comercial, direccion, horario, activo

