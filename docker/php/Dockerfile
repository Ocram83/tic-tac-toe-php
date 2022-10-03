FROM php:7.4-fpm-alpine

ARG COMPOSER

RUN apk update

RUN apk add --no-cache \
        bash \
        zlib
COPY php.ini /usr/local/etc/php/php.ini

RUN apk add --no-cache fcgi

# INSTALL COMPOSER
RUN set -xe \
    && apk add --no-cache \
        git \
        curl \
        openssl \
        libressl-dev \
    && docker-php-ext-install \
        phar \
        json \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer \
    && composer --version \
    && echo COMPOSER INSTALLED; 

WORKDIR /src

CMD ["/bin/bash","-c", "php-fpm"]
