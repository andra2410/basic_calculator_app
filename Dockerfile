FROM php:8.4-fpm 

WORKDIR /var/www/html 

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer 

COPY . . 

RUN composer install

RUN php artisan key:generate 

RUN php artisan migrate 

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"] 
