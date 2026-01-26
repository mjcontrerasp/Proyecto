# SocialFood - Setup y Configuración

## Descripción
SocialFood es una plataforma web para la donación y distribución de alimentos excedentes entre comercios, voluntarios y ONGs.

## Configuración Inicial

### 1. Instalar dependencias
```bash
composer install
npm install
```

### 2. Configurar .env
```bash
cp .env.example .env
php artisan key:generate
```

Asegúrate de que la base de datos esté correctamente configurada en `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=proyecto
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Crear las tablas
```bash
php artisan migrate
```

Esto creará:
- `usuarios` - Tabla de usuarios (comercios, voluntarios, ONG)
- `comercios` - Datos adicionales de comercios
- `donaciones` - Registro de donaciones
- `password_resets` - Reset de contraseñas
- `personal_access_tokens` - Tokens para API

### 4. Iniciar el servidor
```bash
php artisan serve
```

Accede a: http://localhost:8000

## Estructura de Rutas

### Autenticación (sin login)
- `GET /login` - Formulario de login
- `POST /login` - Procesar login
- `GET /register` - Formulario de registro
- `POST /register` - Procesar registro
- `GET /password/reset` - Formulario de recuperación
- `POST /password/reset` - Enviar email de recuperación

### Rutas Protegidas (requieren login)

#### HOME
- `GET /home` - Dashboard principal

#### PERFIL
- `GET /perfil` - Ver perfil
- `PUT /perfil` - Actualizar perfil

#### DONACIONES (CRUD)
- `GET /donaciones` - Lista de donaciones del usuario
- `GET /donaciones/create` - Formulario crear donación
- `POST /donaciones` - Guardar donación
- `GET /donaciones/{id}` - Ver detalle
- `GET /donaciones/{id}/edit` - Editar donación
- `PUT /donaciones/{id}` - Actualizar donación
- `DELETE /donaciones/{id}` - Eliminar donación

#### VOLUNTARIO
- `GET /donaciones/disponibles` - Ver donaciones disponibles
- `POST /donaciones/{id}/aceptar` - Aceptar donación
- `PUT /donaciones/{id}/recoger` - Marcar como recogida
- `PUT /donaciones/{id}/entregar` - Marcar como entregada
- `GET /historial-voluntario` - Ver historial personal

#### COMERCIO
- `GET /comercio` - Panel del comercio
- `GET /comercio/crear` - Formulario registro comercio
- `POST /comercio` - Registrar comercio

#### ONG
- `GET /donaciones/en-camino` - Ver donaciones en camino
- `PUT /donaciones/{id}/confirmar-recepcion` - Confirmar recepción
- `GET /historial-ong` - Ver historial de entregas

#### AUTH
- `POST /logout` - Cerrar sesión

## Roles de Usuario

1. **Comercio** - Puede publicar donaciones de alimentos excedentes
2. **Voluntario** - Puede aceptar donaciones y transportarlas a ONG
3. **ONG** (Administrador) - Puede ver y confirmar recepciones

## Estados de Donación

- `No asignada` - Publicada, esperando voluntario
- `Asignada` - Un voluntario la ha aceptado
- `En camino` - El voluntario está transportándola
- `Recogida` - Ha sido recogida del comercio
- `Entregada` - Entregada a la ONG
- `Entregada a ONG` - Finalizada
- `Recogida confirmada` - Confirmada por comercio

## Archivos Principales

```
app/
  Http/
    Controllers/
      AuthController.php - Autenticación
      RegistroController.php - Registro usuarios
      ComercioController.php - Gestión comercios
      DonacionController.php - CRUD donaciones
      HomeController.php - Dashboard y perfil
  Models/
    User.php - Modelo Usuario (Authenticatable)
    Comercio.php - Modelo Comercio
    Donacion.php - Modelo Donación

routes/
  web.php - Rutas de la aplicación

resources/views/
  layouts/app.blade.php - Layout base
  index.blade.php - Login
  registrar-usuario.blade.php - Registro
  comercio.blade.php - Panel comercio
  donacion_form.blade.php - Formulario donaciones
  mis_donaciones.blade.php - Listado usuario
  donaciones_disponibles.blade.php - Para voluntarios
  ...
```

## Notas Importantes

- El modelo `User` está configurado para usar la tabla `usuarios` con columna `id_usuario`
- Las contraseñas se guardan en `contrasena_hash` (configurado en `getAuthPassword()`)
- Todos los formularios incluyen `@csrf` por protección
- Se usa Bootstrap 5 para los estilos
- Las vistas están adaptadas a Laravel Blade

## Comandos Útiles

```bash
# Ejecutar migraciones
php artisan migrate

# Revertir migraciones
php artisan migrate:rollback

# Crear usuario de prueba
php artisan tinker
# User::create(['nombre'=>'Test', 'email'=>'test@test.com', 'contrasena_hash'=>Hash::make('123456'), 'rol'=>'comercio'])

# Ver todas las rutas
php artisan route:list

# Limpiar caché
php artisan cache:clear
php artisan config:clear
```

## Posibles Problemas

### Error: "SQLSTATE[42S02]: Table not found"
- Ejecuta: `php artisan migrate`

### Error: "Class User not found in config"
- Verifica que `config/auth.php` tenga: `'model' => App\Models\User::class`

### No puedo logearme
- Verifica que el usuario existe en la BD
- Comprueba que la contraseña está hasheada en `contrasena_hash`
- Revisa que `getAuthPassword()` en User.php devuelve `contrasena_hash`

### CSS no carga
- Verifica que Bootstrap CDN está disponible
- O ejecuta: `npm install && npm run dev`
