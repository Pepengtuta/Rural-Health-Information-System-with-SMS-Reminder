FROM php:8.2-apache

# Enable Apache mod_rewrite for .htaccess support
RUN a2enmod rewrite \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Install common database extensions (MySQLi and PDO MySQL)
RUN docker-php-ext-install mysqli pdo_mysql

# Optional: Uncomment below if your project needs image processing (GD) or zip handling
# RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev zip \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install gd zip

# Set production-friendly PHP limits (uploads, post size, memory)
RUN echo "upload_max_filesize = 64M\npost_max_size = 64M\nmemory_limit = 256M" > /usr/local/etc/php/conf.d/custom-limits.ini

# Bind Apache to Railway's dynamic $PORT environment variable (defaults to 80 if not set)
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Set working directory and copy application source code
WORKDIR /var/www/html
COPY . /var/www/html/

# Set proper ownership and file permissions for the web server user
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

