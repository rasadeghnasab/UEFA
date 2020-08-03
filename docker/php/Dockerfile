FROM php:7.4-fpm

ADD docker/php/php.ini /usr/local/etc/php

RUN apt-get update && apt-get install -y \
    curl \
    git-all \
    unzip \
    libssl-dev \
    zlib1g-dev \
    libicu-dev \
    libpng-dev \
    libmcrypt-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libzip-dev \
    apt-transport-https \
    libonig-dev

RUN apt-get install -y libmagickwand-dev --no-install-recommends

RUN pecl install imagick-beta && \
    docker-php-ext-enable imagick && \
    docker-php-ext-install pdo_mysql zip intl opcache && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-configure intl && \
    docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install bcmath

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl install mcrypt-1.0.3 \
    && docker-php-ext-enable mcrypt

# Install php soap client
RUN rm /etc/apt/preferences.d/no-debian-php \
  && apt-get update -y \
  && apt-get install -y \
    libxml2-dev \
    php-soap \
  && apt-get clean -y \
  && docker-php-ext-install soap    

ADD . /var/www/html
WORKDIR /var/www/html

RUN apt-get install -y sqlite3

RUN touch /var/www/html/database/database.sqlite

# RUN docker-php-ext-install pdo_sqlite && \
#     docker-php-ext-enable pdo_sqlite

RUN usermod -u 1000 www-data
