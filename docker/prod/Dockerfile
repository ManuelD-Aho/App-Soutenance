# Image PHP multi-étages pour production
FROM composer:2 as composer

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

FROM php:8.1-apache as app

# Maintainer
LABEL maintainer="ManuelD-Aho <manuel.d-aho@example.com>"

# Définir le fuseau horaire
ENV TZ=Europe/Paris
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-ext-install exif \
    && docker-php-ext-install intl \
    && docker-php-ext-install opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-source delete

# Configurer Apache
RUN a2enmod rewrite headers

# Définir le document root d'Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Créer les répertoires nécessaires
RUN mkdir -p /var/www/html/public/uploads/rapports \
    && mkdir -p /var/www/html/logs \
    && chown -R www-data:www-data /var/www/html

# Copier les fichiers de l'application
COPY --chown=www-data:www-data . /var/www/html
COPY --chown=www-data:www-data --from=composer /app/vendor /var/www/html/vendor

# Copier la configuration PHP
COPY docker/prod/php.ini /usr/local/etc/php/conf.d/custom.ini

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/public/uploads /var/www/html/logs

# Exposer le port 80
EXPOSE 80

# Démarrer Apache en premier plan
CMD ["apache2-foreground"]