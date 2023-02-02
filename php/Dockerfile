FROM php:8.1-apache

WORKDIR /var/www/html

# 時間指定
RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y tzdata \
    && ln -fs /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
    && dpkg-reconfigure -f noninteractive tzdata

# 正規表現ライブラリとzip アーカイブの読み取り、作成、および変更用のライブラリ
# pdo、pdo_mysql、mysqli、mbstring インストール
RUN apt-get install -y libonig-dev libzip-dev unzip \
    && docker-php-ext-install pdo pdo_mysql mysqli mbstring

# Docker コンテナーに PHP Zip 拡張機能
RUN apt-get update && apt-get install -y libzip-dev \
    && docker-php-ext-install zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# phpoffice/phpspreadsheet を使うためのパッケージ
RUN apt-get update \
    && apt-get -y install libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev\
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip

# PHP 拡張機能のインストールを自動化
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# composer のインストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
# phpspreadsheetインストール
# RUN composer require phpoffice/phpspreadsheet

# ファイルのコピー
# COPY ./src /var/www/html
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY php.ini-development /usr/local/etc/php/php.ini
