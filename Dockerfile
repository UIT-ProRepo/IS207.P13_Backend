FROM php:8.2

RUN apt-get update -y && apt-get install -y openssl zip unzip git libonig-dev libzip-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql mbstring zip

WORKDIR /app
COPY . /app
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8001
EXPOSE 8001
