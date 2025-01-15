# Use PHP 8.2
FROM php:8.2-alpine

ARG WWWGROUP
ARG WWWUSER
ARG NODE_VERSION=20
ARG MYSQL_CLIENT="mysql-client"
ARG POSTGRES_VERSION=15

WORKDIR /var/www/html

ENV TZ=UTC
ENV SUPERVISOR_PHP_COMMAND="/usr/bin/php -d variables_order=EGPCS /var/www/html/artisan serve --host=0.0.0.0 --port=80"
ENV SUPERVISOR_PHP_USER="sail"

RUN apk update \
    && apk --no-cache add py3-setuptools supervisor ffmpeg

# Install usermod for modifying users and groups
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk --no-cache add -U shadow

RUN apk --no-cache add bash \
    && sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Install PHP 8.2 and necessary extensions
RUN apk --no-cache add \
        php82-common \
        php82-fpm \
        php82-pdo \
        php82-opcache \
        php82-zip \
        php82-phar \
        php82-iconv \
        php82-cli \
        php82-curl \
        php82-openssl \
        php82-mbstring \
        php82-tokenizer \
        php82-fileinfo \
        php82-json \
        php82-xml \
        php82-xmlwriter \
        php82-simplexml \
        php82-dom \
        php82-pdo_pgsql \
        php82-pgsql \
        php82-pecl-redis \
        php82-ctype \
        php82-gd \
        php82-xmlreader \
        libpq-dev \
    && ln -s /usr/bin/php82 /usr/bin/php

# Setup postgres
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
        && docker-php-ext-install pdo pdo_pgsql pgsql

# Install Node.js and npm
RUN apk add --no-cache nodejs npm

RUN apk add --no-cache ffmpeg

# Add the 'sail' group and user
RUN addgroup -g "$WWWGROUP" sail \
    && adduser -h /var/www/html -u "$WWWUSER" -s /bin/bash -G sail -D sail

# Set permissions for Laravel storage and bootstrap/cache directories
RUN mkdir -p /var/www/html/storage/logs /var/www/html/bootstrap/cache \
    && chown -R sail:sail /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create the log directory for Supervisor
RUN mkdir -p /var/log/supervisor \
    && chmod -R 755 /var/log/supervisor

COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php82/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container

EXPOSE 80/tcp

ENTRYPOINT ["start-container"]
