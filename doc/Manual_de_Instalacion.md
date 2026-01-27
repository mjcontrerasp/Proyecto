# Manual de Instalación – SocialFood

## 1. Requisitos previos
Para ejecutar **SocialFood** correctamente, necesitas:
* **Servidor local:** XAMPP (Apache, PHP, MySQL/MariaDB)
* **PHP:** 8.2 compatible con Laravel 9
* **Servidor de producción:** Ubuntu en AWS EC2
* **Dependencias:** Composer para instalar dependencias de Laravel
* **Navegador web:** Chrome, Firefox, Edge actualizado
* **Editor de código:** VSCode (opcional, recomendado)
* **Base de datos:** Archivo SQL `proyecto.sql`

---

## 2. Instalación del proyecto
1.  **Descargar** el proyecto desde el repositorio o archivo `.zip`.
2.  **Colocar la carpeta** en el directorio de XAMPP: `C:\xampp\htdocs\proyecto`.
3.  **Instalar dependencias:** Abrir CMD/Terminal en la carpeta y ejecutar:
    ```bash
    cd C:\xampp\htdocs\proyecto
    composer install
    ```
4.  **Configurar entorno:** Crear el archivo `.env` basado en el ejemplo:
    ```bash
    copy .env.example .env
    ```
5.  **Generar clave de aplicación:**
    ```bash
    php artisan key:generate
    ```
6.  **Configurar base de datos:** Editar el `.env` con estos datos:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=proyecto
    DB_USERNAME=root
    DB_PASSWORD=
    ```
7.  **Importar base de datos:** Crear la BD `proyecto` en phpMyAdmin e importar `proyecto.sql`.

---

## 3. Estructura de carpetas importantes
* `src/www/` → Archivos públicos de la aplicación (vistas, CSS, JS).
* `app/` → Modelos, controladores y lógica de negocio de Laravel.
* `database/` → Migraciones y seeds.
* `doc/manual_de_programador/` → Documentación técnica (PHPDoc).
* `doc/manual_de_usuarios/` → Manuales de usuario.

---

## 4. Ejecutar la aplicación
1. Iniciar **Apache** y **MySQL** en XAMPP.
2. Abrir el navegador en: `http://localhost/proyecto/src/www`

*Alternativamente, usar el servidor interno:*
```bash
php artisan serve

```

## 5. Pruebas básicas después de instalar
-  Comprobar que la pantalla de inicio de sesión se carga correctamente.
-  Registrar nuevos usuarios con roles **comercio**, **voluntario** y **ONG**.
- Iniciar sesión y verificar la redirección según el rol:
    - **Comercio** → Panel de comercio
    - **Voluntario** → Panel de voluntario
    - **ONG** → Panel de ONG
-  Crear, editar y eliminar donaciones para comprobar que la base de datos se actualiza correctamente.
-  Verificar que los usuarios no pueden acceder a funcionalidades de otros roles.

---

## 6. Consideraciones adicionales
### En producción:
* Configurar un dominio apuntando a la carpeta `public/`.
* Permisos de escritura necesarios para: `storage/` y `bootstrap/cache/`.
* Hacer backups periódicos de la base de datos.

> **Nota:** La carpeta `doc/manual_de_programador/` contiene la documentación técnica generada y `doc/manual_de_usuarios/` contiene manuales de usuario.

---

## 7. Problemas comunes y soluciones

| Problema | Solución |
| :--- | :--- |
| **No carga la página** | Revisar que Apache y MySQL estén iniciados en XAMPP |
| **Error de conexión a la BD** | Verificar datos en `.env` y que la base de datos `proyecto` exista |
| **No se guardan donaciones** | Revisar permisos de escritura en `storage/app/public` |
| **Error de rutas** | Ejecutar `php artisan route:clear` y `php artisan config:clear` |

---

## 8. Instalación del proyecto en producción (despliegue)
**Servidor:** Ubuntu en AWS EC2.

1. **Instalar dependencias:**
    ```bash
    sudo apt update
    sudo apt install php php-cli php-mbstring php-xml composer unzip apache2 mysql-client -y
    ```

2. **Subir proyecto al servidor:**
    * Usar `git clone` o SFTP para subir la carpeta del proyecto.
    * Asegurarse de que la carpeta `public/` será la raíz web.

3. **Configurar entorno:**
    * Copiar `.env.example` a `.env` y actualizar con los datos de la base de datos remota.
    * Generar la clave de Laravel:
    ```bash
    php artisan key:generate
    ```

4. **Base de datos remota:**
    * Crear la base de datos en MySQL de AWS o RDS.
    * Importar `proyecto.sql`.

5. **Permisos necesarios:**
    ```bash
    sudo chown -R www-data:www-data /ruta/proyecto
    sudo chmod -R 775 /ruta/proyecto/storage /ruta/proyecto/bootstrap/cache
    ```

6. **Configurar servidor web:**
    * Apache o Nginx apuntando a `proyecto/public/`.
    * Configurar el dominio y SSL si es necesario.
    * Iniciar servidor (si es Apache):
    ```bash
    sudo systemctl restart apache2
    ```

7. **Verificación final:**
    * Abrir dominio en el navegador y comprobar que carga correctamente.
    * Probar registro, login y funcionalidades según rol.

---

## 9. Pruebas básicas
* Registro de usuarios (comercio, voluntario, ONG).
* Inicio de sesión y redirección según rol.
* Crear, editar y eliminar donaciones.
* Verificar permisos por rol (ningún usuario accede a funcionalidades de otros).