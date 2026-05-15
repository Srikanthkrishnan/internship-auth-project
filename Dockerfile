FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libssl-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install mysqli

# Enable Apache rewrite
RUN a2enmod rewrite

# Install MongoDB extension
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . /var/www/html/

WORKDIR /var/www/html

# Install composer packages
RUN composer install --ignore-platform-req=ext-mongodb

EXPOSE 80