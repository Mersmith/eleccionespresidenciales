# Etapa 1: Construir dependencias
FROM composer:2 AS build

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

COPY . ./
RUN cp .env.example .env && php artisan key:generate
RUN php artisan config:clear && php artisan route:clear && php artisan cache:clear

# Etapa 2: Servidor de producción
FROM php:8.2-apache

# Instalar extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Copiar configuración de Apache
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Copiar la aplicación desde la etapa build
COPY --from=build /app /var/www/html

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer puerto
EXPOSE 8080

# Cloud Run necesita escuchar en 0.0.0.0:8080
ENV APACHE_LISTEN_PORT=8080

CMD ["apache2-foreground"]
