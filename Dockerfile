# Dockerfile
FROM php:8.2-apache

# Installer les extensions PHP nécessaires (pdo_mysql, mbstring, zip, etc.)
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
  && docker-php-ext-install pdo_mysql mysqli mbstring zip \
  && a2enmod rewrite

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copier le code et lancer composer install
COPY . /var/www/html
RUN composer install --no-interaction --optimize-autoloader

# Charger le php.ini personnalisé
COPY php.ini /usr/local/etc/php/php.ini
