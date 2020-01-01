FROM php:7.4.1-cli-alpine3.11

RUN apk add --no-cache --update --virtual buildDeps alpine-sdk autoconf
RUN docker-php-ext-install pcntl && \
    docker-php-ext-install exif
RUN pecl install xdebug-2.8.1
RUN docker-php-ext-enable xdebug

# Set up the application directory.
VOLUME ["/app"]
WORKDIR /app
COPY . /app

# Entrypoint
ENTRYPOINT /app/vendor/bin/phpunit