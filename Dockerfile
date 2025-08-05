# Gunakan image PHP dan Apache
FROM php:8.1-apache

# Install ekstensi PHP yang dibutuhkan oleh CI4
RUN apt-get update && apt-get install -y libicu-dev zip unzip git && \
    docker-php-ext-install intl pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Atur document root Apache ke folder public/
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Update konfigurasi Apache
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Salin semua file project ke container
COPY . /var/www/html

# Set permission folder
RUN chown -R www-data:www-data /var/www/html

# Pindah ke root project
WORKDIR /var/www/html

# Install dependensi PHP
RUN composer install --no-interaction --no-scripts --optimize-autoloader --ignore-platform-req=ext-intl

# Aktifkan Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Jalankan Apache saat container start
CMD ["apache2-foreground"]
