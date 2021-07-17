FROM php:8.0-fpm-alpine
# Install extensions
RUN docker-php-ext-install pdo pdo_mysql
