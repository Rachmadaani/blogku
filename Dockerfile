# Gunakan image PHP 8.1 dengan Apache
FROM php:8.1-apache

# Install dependencies & ekstensi PHP yang dibutuhkan CodeIgniter 4
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    && docker-php-ext-install intl pdo pdo_mysql zip

# Aktifkan Apache mod_rewrite (dibutuhkan oleh CI4)
RUN a2enmod rewrite

# Atur agar document root Apache ada di folder public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Ubah semua konfigurasi agar Apache root-nya jadi folder public/
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set direktori kerja ke dalam container
WORKDIR /var/www/html

# Salin semua file project ke dalam container
COPY . .

# Salin binary composer dari image resmi composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependency CodeIgniter 4 (dengan optimasi)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set permission supaya bisa dibaca Apache (opsional tapi direkomendasikan)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 untuk Railway
EXPOSE 80

# Jalankan Apache saat container dijalankan
CMD ["apache2-foreground"]
