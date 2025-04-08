FROM alpine:latest

WORKDIR /var/www/html

RUN apk add --no-cache --purge --update \
    php83 \
    php83-common \
    php83-fpm \
    php83-pdo \
    php83-opcache \
    php83-zip \
    php83-phar \
    php83-iconv \
    php83-cli \
    php83-curl \
    php83-openssl \
    php83-mbstring \
    php83-tokenizer \
    php83-fileinfo \
    php83-json \
    php83-xml \
    php83-xmlwriter \
    php83-simplexml \
    php83-dom \
    php83-pdo_pgsql \
    php83-ctype \
    php83-gd \
    php83-xmlreader \
    php83-session \
    php83-sodium \
    php83-bcmath \
    libpq-dev \
    nodejs npm \
    ffmpeg

# Set php.ini
COPY php.ini /usr/local/etc/php/conf.d/php.ini

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Ensure correct authorization to the directory
RUN chmod -R 755 /var/www/html
