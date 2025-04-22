# Image de base : PHP 8.0 avec Apache pour le développement
FROM php:8.0-apache-buster

LABEL description="App-Soutenance - Environnement de développement"
LABEL version="1.0"

# Variables d'environnement
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV COMPOSER_ALLOW_SUPERUSER=1

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    git \
    curl \
    default-mysql-client \
    nano \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installation des extensions PHP nécessaires pour l'application
RUN docker-php-ext-install \
    pdo_mysql \
    mysqli \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl \
    opcache \
    && docker-php-ext-configure intl

# Installation de Xdebug pour le débogage en développement
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Installation de Composer pour gérer les dépendances PHP
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuration d'Apache pour le répertoire public de l'application
RUN a2enmod rewrite
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Création des répertoires nécessaires pour les logs et uploads
RUN mkdir -p /var/www/html/public/uploads/rapports \
    && mkdir -p /var/log/php \
    && chmod -R 777 /var/log/php

# Ajoutez ces lignes à votre Dockerfile pour créer le répertoire des logs
RUN mkdir -p /var/www/html/logs \
    && chmod 777 /var/www/html/logs

# Configuration du répertoire de travail
WORKDIR /var/www/html

# Exposition du port pour Apache
EXPOSE 80

# Démarrage du serveur Apache
CMD ["apache2-foreground"]