FROM php:8.2-cli-alpine3.21
MAINTAINER Meritoo <github@meritoo.pl>

ARG TIMEZONE

RUN apk add --update --no-cache \
        vim \
        git \
        zip \
        unzip \
        bash \
        tzdata \
        icu-dev \
        libzip-dev \
        oniguruma-dev \
    && cp /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone

RUN apk add --update --no-cache --virtual .build-deps $PHPIZE_DEPS linux-headers \
    && pecl install xdebug \
    && docker-php-ext-install \
        zip \
        intl \
        mbstring \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps

COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY php.ini /usr/local/etc/php/php.ini
RUN printf '[PHP]\ndate.timezone = "%s"\n' ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

ENV COMPOSER_ALLOW_SUPERUSER 1

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer global require \
        --no-plugins \
        --no-scripts \
        --no-progress \
        --no-interaction \
        --prefer-dist \
        --optimize-autoloader \
        --classmap-authoritative \
        phing/phing:^3.0 \
    && rm -rf ~/.composer/cache/* \
    && composer clear-cache \
    && composer --version

RUN touch ~/.bashrc \
    && sed -i 's/^# export/export/g; \
            s/^# alias/alias/g;' ~/.bashrc \
    && echo 'COLUMNS=200'"\n" >> ~/.bashrc

ENV PATH="/project/vendor/bin:/root/.composer/vendor/bin:${PATH}"

WORKDIR /project
