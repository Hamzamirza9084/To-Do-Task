FROM php:8.2-fpm

WORKDIR /var/www

# Install system dependencies
RUN apt-get update -y && \
    apt-get install -y \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
        libpq-dev \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . /var/www

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Expose Laravel port
EXPOSE 8080

# Install faker & dependencies, run migrations and start Laravel server
CMD bash -c "composer require fakerphp/faker && \
    composer install --optimize-autoloader && \
    php artisan config:clear && \
    php artisan migrate:fresh --force && \
    php artisan serve --host=0.0.0.0 --port=8080"
