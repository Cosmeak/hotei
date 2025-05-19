FROM php:8.3-alpine

WORKDIR /var/www/html

# Install packages
RUN apk add --no-cache --purge --update \
    git make \
    curl openrc \
    nodejs npm \
    ffmpeg

# Install php extensions installer for docker
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install PHP extensions required by Laravel framework
RUN install-php-extensions \
    ctype curl dom fileinfo mbstring openssl pdo pdo_pgsql mysqli session tokenizer simplexml xml xmlwriter phar \
    filter hash pcre @composer zip bcmath pcntl

# Set php.ini
COPY docker/php.ini /etc/php83/php.ini

# Ensure correct authorization to the directory
RUN mkdir -p /var/www/html
RUN chmod -R 755 /var/www/html

#  Copy project
COPY . . 

# Install dependencies
RUN composer install -n
RUN npm ci

# Run server
EXPOSE 8000
CMD composer run dev