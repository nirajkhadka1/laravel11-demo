# Use the official PHP 8.1 FPM image as the base image
FROM php:8.2-fpm

# Install required system packages and extensions
RUN apt-get update && apt-get install -y \
    build-essential \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    locales \
    zip \
    unzip \
    vim \
    curl \
    wget \
    nodejs \
    npm -y

# Configure and install GD extension
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Install other required extensions
RUN docker-php-ext-install iconv simplexml zip pdo pdo_mysql mysqli

# Install PostgreSQL extensions
RUN apt-get --allow-releaseinfo-change update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Set working directory
WORKDIR /var/www/html

# Set user and group ownership for Laravel application
RUN groupadd -g 1000 www \
    && useradd -u 1000 -ms /bin/bash -g www www

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/html

# Change directory permissions before running Composer install
RUN chmod -R 775 /var/www/html \
    && chown -R www:www /var/www/html

# Switch to the www user for subsequent commands
USER www


# Install project dependencies using Composer
RUN composer update

ENV TZ Australia/Sydney
# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]