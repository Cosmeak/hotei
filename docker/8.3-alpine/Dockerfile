# Use PHP 8.3 Alpine as the base image
FROM php:8.3-alpine

ARG WWWGROUP
ARG WWWUSER
ARG NODE_VERSION=20
ARG POSTGRES_VERSION=15

WORKDIR /var/www/html

ENV TZ=UTC
ENV SUPERVISOR_PHP_COMMAND="/usr/bin/php -d variables_order=EGPCS /var/www/html/artisan serve --host=0.0.0.0 --port=80"
ENV SUPERVISOR_PHP_USER="sail"

# Update package repositories and install required dependencies
RUN apk update \
    && apk --no-cache add py3-setuptools supervisor ffmpeg \
    && apk --no-cache add postgresql-dev libpng-dev bash \
    && apk --no-cache add -U shadow \
    && echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories

# Install PHP extensions (pdo, pgsql, gd, etc.)
RUN docker-php-ext-install pdo pdo_pgsql pgsql gd

# Create the correct symbolic link for PHP binary
RUN ln -s /usr/local/bin/php /usr/bin/php

# Change default shell to bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Install Node.js, npm, and dependencies
RUN apk add --no-cache nodejs npm \
    && apk add --no-cache --virtual .build-deps \
        gcc g++ make python3 \
    && apk add --no-cache \
        sqlite-dev \
        libmagic \
        libxslt \
    && apk del .build-deps

# Install ffmpeg
RUN apk add --no-cache ffmpeg

# Add the 'sail' group and user
RUN addgroup -g "$WWWGROUP" sail \
    && adduser -h /var/www/html -u "$WWWUSER" -s /bin/bash -G sail -D sail

# Set permissions for Laravel storage and bootstrap/cache directories
RUN mkdir -p /var/www/html/storage/logs /var/www/html/bootstrap/cache \
    && chown -R sail:sail /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Set correct permissions for node_modules and assets
RUN mkdir -p /var/www/html/node_modules \
    && chown -R sail:sail /var/www/html/node_modules \
    && chmod -R 755 /var/www/html/node_modules

# Create the log directory for Supervisor
RUN mkdir -p /var/log/supervisor \
    && chmod -R 755 /var/log/supervisor

# Copy configuration and scripts
COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php83/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container

EXPOSE 80/tcp

ENTRYPOINT ["start-container"]
