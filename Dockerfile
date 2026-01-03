FROM php:8.4-fpm //this is the base image for the application

WORKDIR /var/www/html //this is the working directory for the application

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer //this will copy the composer binary from the composer image to the working directory

COPY . . //this will copy the entire project to the working directory

RUN composer install //this will install the dependencies for the application

RUN php artisan key:generate //this will generate a random key for the application

RUN php artisan migrate //this will create the tables in the database

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"] //this will start the application
