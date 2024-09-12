FROM alpine:3.18

LABEL maintainer="Sorën Messelier"

ARG WWWGROUP
ARG NODE_VERSION=20
ARG MYSQL_CLIENT="mariadb-client"
ARG POSTGRES_VERSION=15

WORKDIR /var/www/html

ENV TZ=UTC
ENV SUPERVISOR_PHP_COMMAND="/usr/bin/php -d variables_order=EGPCS /var/www/html/artisan serve --host=0.0.0.0 --port=80"
ENV SUPERVISOR_PHP_USER="sail"

RUN apk update \
    && apk add --no-cache tzdata \
    && cp /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone

RUN apk add --no-cache \
    gnupg gosu curl ca-certificates zip unzip git supervisor sqlite-libs libcap libpng-dev python2 bind-tools librsvg ffmpeg nano \
    && apk add --no-cache php8.3 php8.3-phar php8.3-openssl php8.3-pdo php8.3-pdo_mysql php8.3-pdo_pgsql php8.3-pdo_sqlite php8.3-gd php8.3-curl \
       php8.3-imap php8.3-mbstring php8.3-xml php8.3-zip php8.3-bcmath php8.3-soap php8.3-intl php8.3-readline php8.3-ldap \
       php8.3-pecl-msgpack php8.3-pecl-igbinary php8.3-pecl-redis php8.3-pecl-memcached php8.3-pecl-xdebug php8.3-pecl-imagick \
    && pecl install swoole-5.1.2 \
    && echo "extension=swoole.so" > /etc/php8.3/conf.d/20_swoole.ini \
    && curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer \
    && apk add --no-cache nodejs npm yarn mariadb-client postgresql$POSTGRES_VERSION-client \
    && npm install -g pnpm bun \
    && apk add --no-cache $MYSQL_CLIENT \
    && apk del --purge \
    && rm -rf /var/cache/apk/* /tmp/* /var/tmp/*

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.3

RUN addgroup -g $WWWGROUP sail \
    && adduser -D -G sail -u 1337 sail

COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php8/conf.d/99_sail.ini
RUN chmod +x /usr/local/bin/start-container

EXPOSE 80/tcp

ENTRYPOINT ["start-container"]
