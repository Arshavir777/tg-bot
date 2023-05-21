FROM php:8.0-fpm

# Install dependencies
RUN apt-get update \
    && apt-get install -y \
        git \
        zip \
        unzip \
        libpq-dev

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /var/www/html
