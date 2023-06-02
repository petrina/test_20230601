FROM php:8.2-fpm

# Установка зависимостей
RUN apt-get update \
    && apt-get install -y --no-install-recommends libpng-dev zlib1g-dev libxml2-dev libzip-dev libonig-dev libjpeg62-turbo-dev zip unzip git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Установка расширений
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000
