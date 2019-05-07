FROM php:7.1.26-cli

MAINTAINER Rodrigo Coronel  "rodrigotrash6@gmail.com"

RUN apt-get update -y && apt-get install -y openssl zip unzip git libpq-dev libpng-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install gd zip
RUN docker-php-ext-install pdo mbstring pdo_mysql

WORKDIR /var/www/html

COPY . .

RUN composer install

RUN chmod 777 -R storage/

EXPOSE 8081

CMD php artisan serve --host=0.0.0.0 --port=8000

