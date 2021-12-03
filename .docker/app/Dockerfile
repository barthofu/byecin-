FROM php:7.4-apache

RUN \
    docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd && docker-php-ext-configure mysqli --with-mysqli=mysqlnd && docker-php-ext-install pdo_mysql && \
    a2enmod rewrite && service apache2 restart && \
    apt-get update && apt-get upgrade -y