FROM php:latest

RUN apt-get update && apt install git zlib1g-dev libzip-dev -y 

RUN docker-php-ext-install zip

ADD ./ /var/www/html/
