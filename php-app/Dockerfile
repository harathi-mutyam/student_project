FROM php:8.2-apache

# Install MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mysqli
RUN docker-php-ext-enable mysqli

# Enable Apache rewrite (optional)
RUN a2enmod rewrite

