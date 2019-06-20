FROM composer as vender

COPY ./ /var/www/app
WORKDIR /var/www/app/

RUN composer install \
    --no-scripts \
    --no-progress \
    --no-suggest \
    --ignore-platform-reqs

FROM node:8-alpine as node
RUN apk add --no-cache yarn
COPY --from=vender /var/www/app/ /var/www/app
WORKDIR /var/www/app/
RUN yarn run production
RUN rm -r /var/www/app/node_modules

FROM php:7.1-fpm-alpine3.8 as php

RUN apk add --no-cache shadow
RUN docker-php-ext-install pdo pdo_mysql
RUN usermod -u 1000 www-data

WORKDIR /

COPY --from=node /var/www/app/ /var/www/example

CMD php-fpm
