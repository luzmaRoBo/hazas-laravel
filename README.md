# 🌾 Hazas de la Suerte — Laravel 11

Aplicación web desarrollada en **Laravel + PHP + MySQL + TailwindCSS** como tarea de 2º DAW.  
Permite gestionar las **Hazas de la Suerte** (parcelas), padrón de habitantes/colonos, junta de hazas y usuarios, con control de acceso por **roles**.

## 🚀 Tecnologías

-   PHP 8.3 · Laravel 11
-   MySQL/MariaDB
-   Blade + TailwindCSS
-   Vite

## 🔐 Roles y permisos

-   **root**: control total (crear/leer/actualizar/eliminar en todas las tablas, gestión de usuarios/roles).
-   **modificacion**: lectura + modificación (crear/editar) pero sin privilegios de administración total.
-   **lectura**: solo lectura.

> Al **registrarse**, el usuario entra con rol **lectura**.  
> Para administrar, asciende un usuario a **root** desde la base de datos (ver abajo).

## 🧩 Módulos actuales

-   **Hazas**
-   **Padrón de habitantes**
-   **Padrón de colonos**
-   **Junta de hazas**
-   **Usuarios**

> El código está preparado para añadir más tablas reutilizando el patrón de **controlador + vistas** ya existente.

---

## ⚙️ Instalación (local)

### 1) Clonar e instalar

```bash
git clone https://github.com/TU_USUARIO/hazas-laravel.git
cd hazas-laravel
composer install
npm install
```

## 🛠️ Construido con

Este proyecto fue desarrollado usando [Laravel](https://laravel.com), un framework de PHP moderno y potente.
