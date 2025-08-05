FROM php:8.1-apache

# Install ekstensi yang dibutuhkan
RUN apt-get update && apt-get install -y libicu-dev zip unzip git && \
    docker-php-ext-install intl pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy semua file project ke dalam container
COPY . /var/www/html/

# Atur hak akses
RUN chown -R www-data:www-data /var/www/html

# Atur direktori kerja
WORKDIR /var/www/html

# Jalankan composer install
RUN composer install --optimize-autoloader --no-interaction --no-scripts

# Expose port
EXPOSE 80
