FROM php:8.2-cli
MAINTAINER Meritoo <github@meritoo.pl>

#
# Tools & libraries
#
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        vim \
        git \
        zip \
        unzip \
        zlib1g-dev \
        libicu-dev \
        libzip-dev \
        libonig-dev \
    && apt-get clean \
    && rm -rf \
        /var/lib/apt/lists/* \
        /tmp/* \
        /var/tmp/*

#
# PHP extensions
#
RUN docker-php-ext-install \
    zip \
    intl \
    mbstring

#
# PHP extensions (PECL):
# - Xdebug
#
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

#
# PHP configuration:
# - default configuration
# - timezone
#
COPY php.ini /usr/local/etc/php/php.ini
ARG TIMEZONE
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n' ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

#
# Composer - environment variables:
# - disable warning about running commands as root/super user
# - disable automatic clearing of sudo sessions
#
# More:
# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
#
ENV COMPOSER_ALLOW_SUPERUSER 1

#
# Composer (from official image)
#
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

#
# Phing (via Composer global)
#
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

#
# Bash
#
RUN sed -i 's/^# export/export/g; \
            s/^# alias/alias/g;' ~/.bashrc \
    && echo 'COLUMNS=200'"\n" >> ~/.bashrc

#
# Use project-related binaries globally
#
ENV PATH="/project/vendor/bin:/root/.composer/vendor/bin:${PATH}"

WORKDIR /project
