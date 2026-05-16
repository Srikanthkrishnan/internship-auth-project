FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    && docker-php-ext-install mysqli

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install

EXPOSE 80