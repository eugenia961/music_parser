FROM php:7.4.5-fpm-alpine3.11

WORKDIR /app

# create user to use unix domain socket with
RUN addgroup -g 3000 -S app
RUN adduser -u 3000 -S -D -G app app

COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/zz-docker.conf

RUN apk add --no-cache --update --virtual buildDeps \
            autoconf=2.69-r2 build-base=0.5-r1 libtool=2.4.6-r7 pcre-dev=8.43-r0 lz4-dev=1.9.2-r0 \
            musl-dev=1.1.24-r2 cyrus-sasl-dev=2.1.27-r5 openssl-dev=1.1.1g-r0 \
            freetype-dev=2.10.1-r0 libpng-dev=1.6.37-r1 libjpeg-turbo-dev=2.0.4-r1 libxml2-dev=2.9.10-r3 \
 && apk add --no-cache --update file=5.37-r1 curl=7.67.0-r0 \
 && export CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" \
 && docker-php-ext-install -j"$(nproc)" mysqli \
 && docker-php-ext-install -j"$(nproc)" pdo \
 && docker-php-ext-install -j"$(nproc)" pdo_mysql \
 && rm -rf /tmp/* /var/cache/apk/*

RUN apk add rsync
RUN apk add cyrus-sasl
RUN apk add libsasl
RUN apk add git

# Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    composer self-update --stable
RUN command -v composer

# Other
RUN mkdir ~/.ssh
RUN touch ~/.ssh_config

# cleanup
RUN apk del buildDeps

RUN mkdir -p /sock /app && chown -R app:app /sock /app
WORKDIR /app

## Add the wait script to the image
ADD https://github.com/ufoscout/docker-compose-wait/releases/download/2.7.3/wait /wait
RUN chmod +x /wait

# Display versions installed
RUN php -v
RUN composer --version
USER app