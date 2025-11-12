# Proyecto
Proyecto de Proyecto V1.0
# Guía de Estilos y Arquitectura

## Objetivo
Diseñar un **login claro, accesible (WCAG 2.1 AA)**, usable en móvil, seguro y con mínima fricción para el usuario.

---

## Principios Visuales y UX

- **Jerarquía clara:** título H1 `Acceder` (xl), subtítulo en tamaño base.  
- **Formularios centrados** en móviles; ancho máximo de **420px** en escritorio.  
- **Etiquetas persistentes** (floating labels) + *placeholders* con `aria-label` y `aria-describedby` cuando corresponda.  
- **Feedback inmediato y específico**: mostrar errores por campo, no solo mensajes globales.  
- **Indicador de estado:** *loading spinner* en el botón de envío; deshabilitarlo al enviar.  
- **Accesibilidad por teclado:** orden lógico de `tabindex`, foco visible (outline ≥ 3 px y contraste mínimo).  
- **Paleta de color:** esquema sobrio, color primario para acciones (`#0d6efd` recomendado), fondo neutro y contraste de texto ≥ 4.5:1.  
- **Tipografía:** fuente del sistema o *Inter* (16 px base, *line-height* 1.4).  
- **Área táctil mínima:** botones de al menos **44×44 px**.  

---

## Componentes del Login

- **Campo email:** tipo `email`, `autocomplete="email"`.  
- **Campo contraseña:** tipo `password`, `autocomplete="current-password"`, botón de *mostrar/ocultar*.  
- **Checkbox “Recordarme”** opcional (indicar duración en un *tooltip*).  
- **Enlace “¿Olvidaste la contraseña?”** que dirija al flujo de recuperación.  
- **Mensajes de error:** sin revelar si el email existe; usar mensajes genéricos ante fallos de autenticación.  
- **2FA (opcional):** flujo adicional con código OTP, accesible por lector de pantalla.  

---

## Requerimientos de Accesibilidad

- **Labels visibles** y correctamente asociados con `for`.  
- **Errores programáticos:** `role="alert"` y `aria-live="assertive"`.  
- **Cumplimiento WCAG AA** de contraste y estructura semántica.  
- **Navegación por teclado completa**, incluido el control de visibilidad de la contraseña.  
- **Internacionalización lista (i18n)** para textos, mensajes y accesibilidad.  

---

## Arquitectura Tecnológica

**Arquitectura general:**  
Cliente SPA (**React/Tailwind**) + **API REST/GraphQL** + base de datos relacional + autenticación basada en tokens.

### Stack sugerido (rápido, mantenible y seguro)

- **Frontend:** React + TypeScript + Tailwind CSS (responsive + accesible).  
- **Backend:** Node.js + TypeScript + Express o Fastify (estructura modular por dominios).  
- **Autenticación:**  
  - **JWT** (token de acceso de corta vida).  
  - **Refresh Token** (rotación segura) almacenado en **cookie HttpOnly Secure SameSite**.  
  - Alternativa: sesiones en **Redis**.  
- **Base de datos:** PostgreSQL (relacional, con transacciones e índices).  
- **Hashing de contraseñas:** `bcrypt` (coste 12–14) o **Argon2id** (recomendado).  
- **Caché / Sesiones:** Redis (para rate-limiting, bloqueo y sesiones).  
- **Almacenamiento:** S3-compatible (para fotos) con URLs firmadas.  
- **Monitorización:** logs estructurados (JSON), auditorías y alertas básicas.  
- **Infraestructura:** contenedores Docker, CI/CD (tests + lint), despliegue con HTTPS (Certbot/ACM).  
- **Backup:** copias diarias cifradas, con retención conforme al RGPD.  

---

## Seguridad Específica del Login

- **TLS obligatorio (HTTPS)** para todas las comunicaciones.  
- **Cookies seguras:** `HttpOnly`, `Secure`, `SameSite=Strict` para refresh tokens.  
- **Protecciones activas:**  
  - Rate limit por IP y usuario.  
  - Bloqueo temporal tras N intentos fallidos.  
  - CAPTCHA opcional tras múltiples errores.  
- **Privacidad:** no revelar si un email existe (mensajes neutrales).  
- **Auditoría:** registro de accesos (timestamp, IP, user-agent, resultado).  
- **Contraseñas seguras:**  
  - Longitud mínima 8–10 caracteres (ideal 12).  
  - Sin reglas complejas que dificulten la usabilidad.  
  - Comprobación opcional con bases de datos de contraseñas filtradas (*pwned passwords*).  
- **Autenticación de dos factores (2FA):** opcional mediante **TOTP** o código temporal.  

---

> **Resumen:**  
> Esta guía define el estándar visual, técnico y de seguridad para implementar el flujo de inicio de sesión de **SocialFood Badajoz**, asegurando **accesibilidad, usabilidad y cumplimiento normativo (WCAG + RGPD)**.
