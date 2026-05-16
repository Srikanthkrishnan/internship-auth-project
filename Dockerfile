FROM php:8.2-apache

# Install required packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libssl-dev \
    pkg-config \
    libcurl4-openssl-dev

# Install MongoDB extension
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Install MySQL extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . /var/www/html/

WORKDIR /var/www/html

# Install PHP dependencies
RUN composer install

EXPOSE 80