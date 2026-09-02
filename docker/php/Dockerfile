FROM php:8.4-apache

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html

WORKDIR /var/www

COPY public/ /var/www/html/
COPY src/ /var/www/src/
COPY utils/ /var/www/utils/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80