# Gunakan image PHP 8.1 dengan Apache
FROM php:8.1-apache

# Install intl extension
RUN apt-get update && apt-get install -y \
    libicu-dev \
    && docker-php-ext-install intl

# Install ekstensi yang dibutuhkan oleh CodeIgniter 4
RUN apt-get update && apt-get install -y \
    libicu-dev libzip-dev unzip git curl \
    && docker-php-ext-install intl pdo pdo_mysql zip

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Atur document root ke folder public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update konfigurasi Apache agar root folder-nya pakai public/
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy semua file project ke dalam container
COPY . /var/www/html

# Set permission supaya bisa diakses Apache
RUN chown -R www-data:www-data /var/www/html

# Pindah ke folder kerja proyek
WORKDIR /var/www/html

# Salin composer dari image resmi composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependency CI4 (optimize autoloader & abaikan ekstensi lokal)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-intl

# Expose port 80 untuk Railway atau hosting lainnya
EXPOSE 80

# Jalankan Apache saat container start
CMD ["apache2-foreground"]
