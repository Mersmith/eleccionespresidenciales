# Usar imagen oficial PHP con FPM (puedes cambiar la versión PHP si necesitas)
FROM php:8.2-fpm

# Instalar dependencias del sistema necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    zip \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer (tomado desde la imagen oficial composer)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Definir directorio de trabajo
WORKDIR /var/www/html

# Copiar TODO el proyecto primero (incluye artisan)
COPY . .

# Instalar dependencias PHP con composer sin dev y optimizado
RUN composer install --no-dev --optimize-autoloader

# Dar permisos correctos a storage y cache para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Exponer el puerto que usará Laravel (puede ser 8080)
EXPOSE 8080

# Usar CMD con JSON array para evitar problemas con señales (warning JSONArgsRecommended)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
