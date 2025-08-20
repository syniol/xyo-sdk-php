FROM php:7.1.33-alpine

RUN apk add --update \
    curl \
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

# Installing Composer (PHP Package Management)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

# PHP 7.x is used compatible xdebug is 2.7.x
# https://xdebug.org/docs/compat
RUN pecl install xdebug-2.7.2 \
    && echo "zend_extension=xdebug.so" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN mkdir -p /usr/local/xyo/sdk

WORKDIR /usr/local/xyo/sdk

COPY . /usr/local/xyo/sdk/

RUN composer test

# Testing SDK in example package
WORKDIR /usr/local/xyo/sdk/example
RUN composer start
