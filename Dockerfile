FROM php:8.2-apache

# Enable Apache mod_rewrite for .htaccess support
RUN a2enmod rewrite \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Install MySQLi extension for PHP database connectivity
RUN docker-php-ext-install mysqli

# Configure Apache to listen on Railway's dynamic $PORT environment variable
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Set working directory and copy application files
WORKDIR /var/www/html
COPY . /var/www/html/

# Set proper permissions for Apache user
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

