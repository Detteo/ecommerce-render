FROM php:8.2-apache

COPY . /var/www/html/

RUN docker-php-ext-install mysqli

RUN a2enmod rewrite

RUN echo '<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf