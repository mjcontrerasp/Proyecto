# Product Backlog - SocialFood

## 1. Registro de usuarios
**ID:** PB001  
**Descripción:** Permitir que los usuarios se registren con nombre, email, teléfono, contraseña y rol (voluntario, comercio u ONG).  
**Prioridad:** Alta  
**Estado:** Implementado  

## 2. Inicio de sesión (Login)
**ID:** PB002  
**Descripción:** Permitir que los usuarios inicien sesión con correo y contraseña. Redirigir según rol.  
**Prioridad:** Alta  
**Estado:** Implementado  

## 3. Registro de comercios
**ID:** PB003  
**Descripción:** Permitir que los usuarios con rol comercio registren los datos del comercio (nombre, dirección, horario).  
**Prioridad:** Alta  
**Estado:** Implementado  

## 4. Validación de formularios
**ID:** PB004  
**Descripción:** Validar campos obligatorios antes de enviar formularios (registro de usuario, comercio y donaciones).  
**Prioridad:** Media  
**Estado:** Implementado  

## 5. Redirección según rol
**ID:** PB005  
**Descripción:** Después del login, el usuario se dirige a la página correspondiente según rol (comercio → donaciones, voluntario → donaciones disponibles, ONG → home).  
**Prioridad:** Alta  
**Estado:** Implementado  

## 6. Guardado de datos en la base de datos
**ID:** PB006  
**Descripción:** Al registrar usuario, comercio u ONG, los datos se guardan correctamente en la base de datos MySQL.  
**Prioridad:** Alta  
**Estado:** Implementado  

## 7. Publicación de donaciones
**ID:** PB007  
**Descripción:** Permitir que comercios publiquen donaciones indicando tipo de comida, cantidad, fecha/hora de recogida, punto de recogida y observaciones.  
**Prioridad:** Alta  
**Estado:** Implementado  

## 8. Modificación y eliminación de donaciones
**ID:** PB008  
**Descripción:** Comercios pueden modificar o eliminar donaciones mientras no hayan sido recogidas.  
**Prioridad:** Media  
**Estado:** Implementado  

## 9. Aceptación de donaciones por voluntarios
**ID:** PB009  
**Descripción:** Permitir que voluntarios acepten donaciones disponibles y se asignen como responsables de recogida.  
**Prioridad:** Alta  
**Estado:** Implementado  

## 10. Flujo de donaciones
**ID:** PB010  
**Descripción:** Gestión de estados de las donaciones: No asignada → Asignada → Recogida → Entregada → Entregada a ONG.  
**Prioridad:** Alta  
**Estado:** Implementado  

## 11. Confirmaciones de entrega y recepción
**ID:** PB011  
**Descripción:** Voluntarios pueden marcar donaciones como recogidas y entregadas. ONG confirma recepción de la donación.  
**Prioridad:** Alta  
**Estado:** Implementado  

## 12. Historial de donaciones
**ID:** PB012  
**Descripción:** Visualizar historial de donaciones entregadas por voluntarios y recibidas por ONG.  
**Prioridad:** Media  
**Estado:** Implementado  

## 13. Validación de correos reales
**ID:** PB013  
**Descripción:** Verificar que el correo electrónico ingresado por el usuario sea válido mediante API externa.  
**Prioridad:** Media  
**Estado:** Pendiente  

## 14. Responsividad
**ID:** PB014  
**Descripción:** Adaptar la interfaz web a móviles y tablets usando CSS y media queries.  
**Prioridad:** Alta  
**Estado:** Pendiente  

## 15. Manuales y documentación
**ID:** PB015  
**Descripción:** Crear manual de usuario, manual del programador (PHPDoc) y manual de instalación.  
**Prioridad:** Media  
**Estado:** Implementado 

## 16. Estilo y diseño
**ID:** PB016  
**Descripción:** Aplicar guía de estilos, colores, tipografía uniforme y consistencia visual en todas las páginas.  
**Prioridad:** Media  
**Estado:** Implementado  

## 17. Documentación técnica
**ID:** PB017  
**Descripción:** Documentar controladores, modelos, scripts JS, base de datos y arquitectura tecnológica.  
**Prioridad:** Media  
**Estado:** Implementado  

## 18. Pruebas funcionales
**ID:** PB018  
**Descripción:** Probar registro, login, redirecciones, flujo de donaciones y validaciones de formularios.  
**Prioridad:** Alta  
**Estado:** Impplementado  

## 19. Seguridad
**ID:** PB019  
**Descripción:** Implementar hash de contraseñas, protección CSRF, validaciones y autorización por rol.  
**Prioridad:** Alta  
**Estado:** Implementado  

## 20. Accesibilidad
**ID:** PB020  
**Descripción:** Cumplir nivel WCAG AA de accesibilidad, etiquetas de formulario, contrastes de color y navegación por teclado.  
**Prioridad:** Media  
**Estado:** Pendiente

