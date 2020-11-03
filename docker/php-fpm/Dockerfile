FROM php:7.4-fpm-alpine AS base-builder

RUN apk update && apk add --no-cache \
    $PHPIZE_DEPS \
    postgresql-dev \
    icu-dev

# Define extensions to install via PECL
ENV THIRD_PARTY_EXTS \
	apcu

# Install and enable extensions
RUN pecl install ${THIRD_PARTY_EXTS}
RUN docker-php-ext-enable ${THIRD_PARTY_EXTS}

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-install opcache pdo_pgsql intl bcmath

# ------------ base stage ------------ #
FROM php:7.4-fpm-alpine AS base

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

# Copy system shared objects
COPY --from=base-builder /usr/lib /usr/lib
# Copy php extensions shared objects compiled in build stage
COPY --from=base-builder /usr/local/lib/php/extensions /usr/local/lib/php/extensions
# Copy configs created on build stage
COPY --from=base-builder /usr/local/etc/php /usr/local/etc/php
# Copy custom php.ini overrides
COPY docker/php-fpm/php-ini-overrides.ini /usr/local/etc/php/conf.d/99-overrides.ini
# Override default entrypoint
COPY docker/php-fpm/docker-php-entrypoint /usr/local/bin/docker-php-entrypoint

WORKDIR /var/www/cobiro

# ------------ dev stage ------------ #
FROM base as dev

ENV APP_ENV=dev
ENV APP_DEBUG=1

# ------------ prod-vendors stage ------------ #
FROM base AS prod-vendors

COPY composer.* ./
RUN composer install --prefer-dist --no-scripts --no-progress --no-suggest --no-autoloader --no-interaction --no-dev

# ------------ prod stage ------------ #
FROM base as prod
ENV APP_ENV=prod
ENV APP_DEBUG=0

COPY . .

# Copy vendors from prod-vendors stage
COPY --from=prod-vendors /var/www/cobiro/vendor /var/www/cobiro/vendor

RUN composer dump-autoload --classmap-authoritative
RUN composer run-script post-install-cmd
#RUN php bin/console cache:warmup
