FROM composer:latest as builder

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /app

COPY composer.json composer.json
#COPY composer.lock composer.lock

RUN composer install \
      --ignore-platform-reqs \
      --no-interaction \
      --optimize-autoloader \
      --no-dev \
      --no-scripts \
      --prefer-dist

FROM php:8.4-fpm-alpine

WORKDIR /var/www/html

# Update repository
RUN set -xe \
    && apk update \
    && apk upgrade \
    && apk add --update linux-headers \
    && apk add --no-cache postgresql-dev

# Fixed Intl version
RUN apk add libintl icu icu-dev \
    && docker-php-ext-install intl \
    && apk del icu-dev

# Install GD
RUN apk add libpng-dev jpeg-dev freetype-dev libjpeg-turbo-dev \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Install Bcmath extension
#RUN docker-php-ext-install -j$(nproc) bcmath

# Install zlib
RUN apk add --no-cache zlib-dev

# Install Zip extension
RUN apk add libzip-dev \
    && docker-php-ext-install -j$(nproc) zip

# Install PDO
RUN docker-php-ext-install -j$(nproc) pdo_pgsql

# Install Exif extension
RUN docker-php-ext-install -j$(nproc) exif

# Install Kafka extension
RUN apk add --no-cache librdkafka-dev autoconf g++ make \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka \
    && apk del autoconf g++ make

# Install kcat (Kafka CLI tool)
RUN apk add --no-cache kcat

# Clear
RUN rm -rf /tmp/* /var/cache/apk/*

COPY . /var/www/html

COPY --from=builder /app/vendor /var/www/html/vendor

RUN chown -R www-data:www-data /var/www/html \
  && chmod -R u=rwX,go=rX /var/www/html \
  && chown -R www-data:www-data /var/www/html/storage \
  && chown -R www-data:www-data /var/www/html/public \
  && chown -R www-data:www-data /var/www/html/bootstrap/cache \
  && chmod -R u=rwX,go=rX /var/www/html/storage \
  && chmod -R u=rwX,go=rX /var/www/html/public \
  && cp ${PHP_INI_DIR}/php.ini-production ${PHP_INI_DIR}/php.ini

USER 1005
