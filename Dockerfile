FROM node:12 as assets

WORKDIR /app

COPY package.json .

RUN npm install --quiet --no-cache

COPY Gruntfile.js /app/

COPY web/css/ /app/web/css/
COPY web/fonts/ /app/web/fonts/
COPY web/images_static/ /app/web/images_static/
COPY web/js/ /app/web/js/

RUN npm run install

RUN npm run grunt

FROM alpine:3.10 as compress

RUN apk add --no-cache brotli

COPY --from=assets /app/web /app/web

WORKDIR /app

RUN find web/css/dist -type f -name '*.css' -exec gzip -9 -k -f "{}" \; && \
    find web/css/dist -type f -name '*.css' -exec brotli -q 11 -k -f "{}" \; && \
    find web/js/dist  -type f -name '*.js'  -exec gzip -9 -k -f "{}" \; && \
    find web/js/dist  -type f -name '*.js'  -exec brotli -q 11 -k -f "{}" \;

FROM webvariants/php:7.2-fpm-alpine

COPY composer.json composer.lock /app/

RUN composer.phar install --no-ansi --prefer-dist --optimize-autoloader && rm -rf /root/.composer

COPY ./ /app/
RUN cd api && composer.phar install --no-ansi --prefer-dist --optimize-autoloader && rm -rf /root/.composer

RUN cd config && \
    ln -s ../data/config/app.yml app.yml && \
    ln -s ../data/config/databases.yml databases.yml && \
    ln -s ../data/config/factories.yml factories.yml && \
    ln -s ../data/config/properties.ini properties.ini && \
    ln -s ../data/config/settings.yml settings.yml && \
    ln -s ../data/config/recaptcha_credentials.json recaptcha_credentials.json && \
    cd ../api && \
    ln -s ../data/config/.env.local .env.local && \
    cd ../web && \
    ln -s ../data/images images && \
    cd ../apps/widget && \
    ln -s ../../data/i18n i18n

COPY --from=compress /app/web /app/web

ENV PHP_IMAGE_VERSION=2 \
    WEB_ROOT=/app/web \
    PHP_MEMORY_LIMIT=256M \
    PHPINI_SESSION__GC_MAXLIFETIME=3600 \
    PHPINI_OPCACHE__VALIDATE_TIMESTAMPS=0

USER www-data:www-data

# VOLUME [ "/app/data" ]