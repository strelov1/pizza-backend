FROM php:7.3-fpm-alpine

# install extensions
RUN apk add --update --no-cache libintl icu icu-dev libxml2-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-install mbstring tokenizer

WORKDIR /srv/app