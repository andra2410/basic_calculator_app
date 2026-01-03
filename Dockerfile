#Base PHP image
FROM php:8.4-fpm

#working directory
WORKDIR /var/www/html

#system dependencies 
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

#Composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

#Copy project files
COPY . .

#PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

#Laravel application key
RUN php artisan key:generate

#pt migrations
RUN php artisan migrate --force

# expose port
EXPOSE 8000

# start server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]