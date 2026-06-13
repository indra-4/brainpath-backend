# Gunakan image PHP 8.3 resmi dengan web server Apache
FROM php:8.3-apache

# Install dependensi sistem yang dibutuhkan oleh Laravel (Zip, PDO, dll)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl

# Aktifkan modul Rewrite Apache untuk URL Laravel
RUN a2enmod rewrite

# Install Composer secara global
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Atur working directory di dalam container
WORKDIR /var/www/html

# Copy semua file project Anda ke dalam container
COPY . .

# Install dependensi PHP (vendor) mengabaikan hal yang tidak perlu
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Atur hak akses folder storage dan bootstrap/cache agar bisa ditulisi
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Ubah DocumentRoot Apache ke folder public/ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Beritahu Render bahwa aplikasi berjalan di port 80
EXPOSE 80
