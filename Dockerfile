# Imagen base PHP con Apache
FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd \
        pdo \
        pdo_mysql \
        zip \
        mbstring \
        exif \
        pcntl \
        bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Instalar Composer desde la imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar todo el proyecto primero (incluyendo artisan)
COPY . .

# Instalar dependencias de Laravel sin dev y optimizado
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Crear carpeta public/storage dentro del contenedor y asignar permisos
RUN mkdir -p public/storage \
    && chown -R www-data:www-data storage bootstrap/cache public/storage \
    && chmod -R 775 storage bootstrap/cache public/storage

# Copiar configuración de Apache
COPY ./docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./docker/apache/ports.conf /etc/apache2/ports.conf

# Configuración para Cloud Run (puerto)
ENV PORT=8080
EXPOSE 8080

# Comando de inicio
CMD ["apache2-foreground"]
