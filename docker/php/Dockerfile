FROM php:8.2.11-fpm-alpine3.18

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV COMPOSER_VERSION 2.6.4

RUN mkdir /composer \
 && chmod -R 644 /composer/ \
 &&  cd /composer \
 && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php -r "copy('https://composer.github.io/installer.sig', 'composer.sig');" \
 && php -r "if (hash_file('sha384', 'composer-setup.php') === file_get_contents('composer.sig')) { echo 'Installer \ verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
 && php composer-setup.php --no-ansi --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION} \
 && php -r "unlink('composer-setup.php');" \
 && set -ex \
 && apk --no-cache add git openssh-client postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

EXPOSE 8080
