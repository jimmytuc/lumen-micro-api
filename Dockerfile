FROM composer:2

COPY ./tests ./tests
COPY composer.json composer.lock ./

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM php:7.4-fpm-alpine

WORKDIR /var/www/html

COPY . .
COPY --from=0 /app/vendor ./vendor/
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

RUN apk add --no-cache \
    oniguruma-dev \
    mysql-client \
    libxml2-dev \
    freetype-dev \
    vim \
    zip \
    unzip \
    curl

RUN docker-php-ext-install \
    bcmath \
    mbstring \
    pdo \
    pdo_mysql \
    tokenizer \
    xml

RUN adduser www-data www-data && \
    chown -R www-data:www-data .

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
