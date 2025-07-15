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

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www

RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

EXPOSE 8080

CMD bash -c "composer install --no-dev --optimize-autoloader && \
    php artisan config:clear && \
    php artisan migrate:fresh  --force && \
    php artisan serve --host=0.0.0.0 --port=8080"
