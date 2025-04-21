FROM php:8.1-apache

# Arguments
ARG USER_ID=1000
ARG GROUP_ID=1000

# Maintainer
LABEL maintainer="ManuelD-Aho <manuel.d-aho@example.com>"

# Définir le fuseau horaire
ENV TZ=Europe/Paris
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
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
    && docker-php-source delete

# Installer Xdebug pour le développement
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Configurer Apache
RUN a2enmod rewrite headers

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Créer un utilisateur non-root avec le même ID que l'utilisateur hôte
RUN groupadd -g ${GROUP_ID} appuser \
    && useradd -u ${USER_ID} -g appuser -m appuser

# Définir le document root d'Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Réglage des permissions
RUN chown -R appuser:appuser /var/www/html

# Dossier de travail
WORKDIR /var/www/html

# Exposer le port 80
EXPOSE 80

# Démarrer Apache en premier plan
CMD ["apache2-foreground"]