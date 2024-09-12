FROM php:8.0.2-alpine

ARG WWWGROUP
ARG NODE_VERSION=20
ARG MYSQL_CLIENT="mysql-client"
ARG POSTGRES_VERSION=15

WORKDIR /var/www/html

ENV TZ=UTC
ENV SUPERVISOR_PHP_COMMAND="/usr/bin/php -d variables_order=EGPCS /var/www/html/artisan serve --host=0.0.0.0 --port=80"
ENV SUPERVISOR_PHP_USER="sail"

RUN apk update \
    && apk --no-cache add  \
        py3-setuptools \
        supervisor

# Install usermod
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk --no-cache add -U shadow

RUN apk --no-cache add bash \
    && sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

RUN apk --no-cache add \
        php8-common \
        php8-fpm \
        php8-pdo \
        php8-opcache \
        php8-zip \
        php8-phar \
        php8-iconv \
        php8-cli \
        php8-curl \
        php8-openssl \
        php8-mbstring \
        php8-tokenizer \
        php8-fileinfo \
        php8-json \
        php8-xml \
        php8-xmlwriter \
        php8-simplexml \
        php8-dom \
        php8-pdo_pgsql \
        php8-pgsql \
        php8-tokenizer \
        php8-pecl-redis \
        php8-ctype \
        php8-gd \
        php8-xmlreader \
    && ln -s /usr/bin/php8 /usr/bin/php

# RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8

RUN addgroup sail \
    && adduser -h /var/www/html -s /bin/bash -G sail -D sail

COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php8/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container

EXPOSE 80/tcp

ENTRYPOINT ["start-container"]
