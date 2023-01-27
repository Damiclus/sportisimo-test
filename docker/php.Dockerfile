FROM composer:latest as vendor
WORKDIR /tmp/
ADD ./app /tmp/app
ADD ./composer.json /tmp/
RUN composer install --ignore-platform-reqs

FROM node:14.20-alpine as node_modules
WORKDIR /tmp
ADD ./ /tmp/
RUN npm install; \
    npm run build

FROM php:8.1-fpm-alpine
USER root
RUN apk add icu-dev
RUN apk --no-cache add curl-dev
RUN docker-php-ext-install mysqli pdo pdo_mysql curl intl
WORKDIR /var/www/sportisimo/
COPY --from=vendor /tmp/vendor/ ./vendor
COPY --from=node_modules /tmp/www/ /var/www/sportisimo/www/
RUN chown -R www-data ./
USER www-data
RUN mkdir ./temp
RUN set -eux;

