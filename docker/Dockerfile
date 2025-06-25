FROM alpine:latest

WORKDIR /var/www/html

RUN apk add --no-cache --purge --update \
    php83 \
    php83-common \
    php83-ffi \
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
    ffmpeg \
    gcc \
    g++ \
    make \
    libc6-compat \
    libstdc++ \
    gcompat \
    nginx\
    libsndfile

# create a symbolic link only if it doesn't exist yet 
RUN [ -e /lib/ld-linux-aarch64.so.1 ] || \
    ln -s /lib/ld-musl-aarch64.so.1 /lib/ld-linux-aarch64.so.1

# build whisper.cpp + tiny model
RUN apk add --no-cache git wget cmake && \
    git clone --depth=1 https://github.com/ggerganov/whisper.cpp.git /tmp/whisper && \
    cd /tmp/whisper && make -j$(nproc) && \
    find build -type f -name 'libwhisper*.so*' -exec cp {} /usr/lib/ \; && \
    find build -type f -name 'libggml*.so*'    -exec cp {} /usr/lib/ \; && \
    cd /usr/lib && \
    ln -sf $(ls libwhisper.so.* | head -n1) libwhisper.so && \
    ln -sf $(ls libwhisper.so.* | head -n1) libwhisper.so.1 && \
    ln -sf /usr/lib/libsndfile.so.1 libsndfile.so && \
    echo '/usr/lib' > /etc/ld-musl-aarch64.path && \
    cd /tmp/whisper && \
    cp build/bin/whisper-cli /usr/local/bin/ && \
    mkdir -p /var/www/html/whisper_models && \
    wget -q -O /var/www/html/whisper_models/ggml-tiny.bin \
        https://huggingface.co/ggerganov/whisper.cpp/resolve/main/ggml-tiny.bin && \
    rm -rf /tmp/whisper

ENV WHISPER_LIB=/usr/lib/libwhisper.so
ENV WHISPER_FFI_LIBRARY=/usr/lib/libwhisper.so
ENV SNDFILE_FFI_LIBRARY=/usr/lib/libsndfile.so

# Set php.ini
COPY php.ini /usr/local/etc/php/conf.d/php.ini

RUN cp /usr/local/etc/php/conf.d/php.ini /etc/php.ini

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Ensure correct authorization to the directory
RUN chmod -R 755 /var/www/html

RUN printf '%s\n' \
'#!/bin/sh' \
'VENDOR=/var/www/html/vendor/codewithkyrian/whisper.php/lib/linux-arm64' \
'mkdir -p "$VENDOR"' \
'ln -sf /usr/lib/libwhisper.so  "$VENDOR/libwhisper.so"' \
'ln -sf /usr/lib/libsndfile.so "$VENDOR/libsndfile.so"' \
'exec "$@"' \
> /usr/local/bin/whisper-init.sh && \
chmod +x /usr/local/bin/whisper-init.sh

COPY laravel-init.sh /usr/local/bin/laravel-init.sh
RUN chmod +x /usr/local/bin/laravel-init.sh

# compiled lib where whisper.php expects it
RUN mkdir -p /var/www/html/vendor/codewithkyrian/whisper.php/lib/linux-arm64 && \
    ln -sf /usr/lib/libwhisper.so \
        /var/www/html/vendor/codewithkyrian/whisper.php/lib/linux-arm64/libwhisper.so && \
    ln -sf /usr/lib/libsndfile.so \
        /var/www/html/vendor/codewithkyrian/whisper.php/lib/linux-arm64/libsndfile.so


RUN printf '%s\n' \
    'events {}' \
    'http {' \
    '    include       /etc/nginx/mime.types;' \
    '    default_type  application/octet-stream;' \
    '' \
    '    server {' \
    '        listen 80;' \
    '        root /var/www/html/public;' \
    '        index index.php index.html;' \
    '' \
    '        location / {' \
    '            try_files $uri $uri/ /index.php?$query_string;' \
    '        }' \
    '' \
    '        location ~ \.php$ {' \
    '            fastcgi_pass 127.0.0.1:9000;' \
    '            fastcgi_index index.php;' \
    '            include fastcgi_params;' \
    '            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' \
    '        }' \
    '    }' \
    '}' \
> /etc/nginx/nginx.conf


# Create a basic PHP-FPM config
RUN echo -e "[global]\nerror_log = /dev/stderr\n\n[www]\nlisten = 0.0.0.0:9000\nuser = nobody\ngroup = nobody\npm = dynamic\npm.max_children = 5\npm.start_servers = 2\npm.min_spare_servers = 1\npm.max_spare_servers = 3" > /etc/php83/php-fpm.conf

# START PHP-FPM and laravel init  script when container starts
CMD ["/usr/local/bin/whisper-init.sh",        \
     "/usr/local/bin/laravel-init.sh",        \
    "sh", "-c",                               \
    "php-fpm83 -D -y /etc/php83/php-fpm.conf && \
    nginx -g 'daemon off;'"]