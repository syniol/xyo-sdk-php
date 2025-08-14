FROM php:7.0.33-alpine

RUN apk add --update \
    git \
    unzip \
    libzip-dev \
    libgcc \
    libbz2 \
    bzip2-dev \
    autoconf \
    make \
    zlib \
    zlib-dev \
    g++ \
    && docker-php-ext-install bz2 \
    && docker-php-ext-install zip

# Installing curl (PHP Package Management)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

# PHP 7.x is used compatible xdebug is 2.7.x
# https://xdebug.org/docs/compat
RUN pecl install xdebug-2.7.2 \
    && echo "zend_extension=xdebug.so" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN mkdir -p /usr/local/xyo/sdk

WORKDIR /usr/local/xyo/sdk
