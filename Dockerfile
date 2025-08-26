# Usa la imagen oficial de PHP 8.3 FPM como base
FROM php:8.3-fpm

# Establece el directorio de trabajo
WORKDIR /var/www

# Instala dependencias del sistema, incluyendo nodejs y npm
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Instala las extensiones de PHP necesarias para Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia los archivos de la aplicación (los que ya tienes en tu PC)
COPY . .

# Da permisos a Laravel para escribir en las carpetas necesarias
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expone el puerto de PHP-FPM
EXPOSE 9000

# Comando para iniciar el servicio
CMD ["php-fpm"]