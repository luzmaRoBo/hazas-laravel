# 🌾 Hazas de la Suerte — Laravel 11

Este proyecto es una aplicación web desarrollada en **Laravel + PHP + MySQL + TailwindCSS** como tarea de 2º del ciclo superior de Desarrollo de Aplicaciones Web (DAW).

La aplicación permite gestionar las **Hazas de la Suerte** (parcelas comunales), los habitantes y colonos asociados, la junta de hazas y los usuarios del sistema.  
Incluye un sistema de **roles** para controlar el acceso y las acciones permitidas.

---

## 🚀 Tecnologías utilizadas

-   **Backend:** PHP 8.3 + Laravel 11
-   **Frontend:** Blade + TailwindCSS
-   **Base de datos:** MySQL/MariaDB
-   **Gestión de dependencias:** Composer + NPM
-   **Entorno de desarrollo usado:** Laragon (funciona igual en XAMPP, WampServer o Docker)

---

## 🔐 Roles y permisos

El sistema cuenta con tres roles principales:

-   **root** → control total (crear, leer, actualizar, eliminar en todas las tablas, gestión de usuarios y roles).
-   **modificacion** → lectura + modificación (crear y editar), pero sin privilegios de administración total.
-   **lectura** → solo lectura de los datos.

👉 Al registrarse, el usuario entra con el rol **lectura**.  
Para convertirlo en **root**, hay que modificar el campo `rol` en la base de datos manualmente.

---

## 🧩 Módulos implementados

-   Gestión de **Hazas**
-   **Padrón de habitantes**
-   **Padrón de colonos**
-   **Junta de hazas**
-   **Usuarios**

El proyecto está preparado para añadir fácilmente más tablas siguiendo la misma estructura de **controlador + modelo + vistas**.

---

## ⚙️ Instalación y puesta en marcha

### 1. Clonar el repositorio

Primero descarga el proyecto desde GitHub:

```bash
git clone https://github.com/luzmaRoBo/hazas-laravel.git
cd hazas-laravel
```
