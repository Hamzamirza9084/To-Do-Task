FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    zip unzip curl git libxml2-dev libzip-dev libpng-dev libjpeg-dev libonig-dev \
    sqlite3 libsqlite3-dev libpq-dev

# ✅ Add pdo_pgsql for PostgreSQL support
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www
COPY --chown=www-data:www-data . /var/www

RUN chmod -R 755 /var/www

RUN composer install

COPY .env.example .env
RUN php artisan key:generate

EXPOSE 8000

# ✅ Run migrations before serving
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000
