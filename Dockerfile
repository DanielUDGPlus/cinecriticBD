# Usa imagen oficial con Apache + PHP 8.1
FROM php:8.1-apache

# Instala dependencias necesarias para PostgreSQL y Composer
RUN apt-get update && apt-get install -y \
    libpq-dev unzip curl git \
    && docker-php-ext-install pdo pdo_pgsql

# Instala Composer manualmente
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia todo tu proyecto al contenedor
COPY . /var/www/html/

# Da permisos (útil si manejas imágenes subidas)
RUN chmod -R 755 /var/www/html/

# Instala las dependencias de PHP con Composer (como Cloudinary)
RUN composer install --no-dev --optimize-autoloader

# Expone el puerto 80 (usado por Apache)
EXPOSE 80
