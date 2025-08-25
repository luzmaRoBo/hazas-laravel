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

## 2. Instalar dependencias

El proyecto utiliza Composer para las dependencias de PHP y NPM para compilar los estilos de TailwindCSS. (Funciona igual si usas Laragon, XAMPP, WampServer o Docker).

```bash
composer install
npm install
```

## 3. Configurar el archivo de entorno

Laravel necesita un archivo .env con la configuración de la aplicación. Copia el archivo de ejemplo y genera la clave de la app:

```bash
cp .env.example .env
php artisan key:generate
```

## 4. Crear la base de datos

Crea una base de datos vacía en MySQL/MariaDB (puedes llamarla hazasluzma o el nombre que prefieras). Ejemplo:

SQL

```bash
CREATE DATABASE hazasluzma;
```

Ahora edita tu archivo .env para poner las credenciales correctas (recomendado DB_HOST=127.0.0.1):

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hazasluzma
DB_USERNAME=root
DB_PASSWORD=
```

## 5. Ejecutar migraciones

Esto creará todas las tablas necesarias en tu base de datos:

```bash
php artisan migrate
```

## 6. Iniciar el servidor de desarrollo

Levanta el servidor de Laravel:

```bash
php artisan serve
```

La aplicación quedará disponible en:

http://127.0.0.1:8000
Si usas Laragon con Virtual Hosts, accede por la URL que te cree (p. ej. http://hazas.test).

## 7. Compilar los estilos (Tailwind con Vite)

Para que los estilos se apliquen correctamente:

```bash
npm run dev
Para un build de producción:
```

```bash
npm run build
```
