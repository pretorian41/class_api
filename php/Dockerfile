# ./docker/php/Dockerfile
FROM php:7.2-fpm

ARG USER_EMAIL="email@domain.com"
ARG USER_NAME="u.username"

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu

RUN apt-get update && \
apt-get install -y \
zlib1g-dev \
git \
wget

RUN docker-php-ext-install zip
RUN docker-php-ext-enable apcu

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo hash_file('SHA384', 'composer-setup.php')+'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --filename=composer \
    && php -r "unlink('composer-setup.php');" \
    && mv composer /usr/local/bin/composer
RUN wget https://get.symfony.com/cli/installer -O - | bash && \
    mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN git config --global user.email ${USER_EMAIL}
RUN git config --global user.name ${USER_NAME}

WORKDIR /var/www

#COPY project /usr/src/app


RUN PATH=$PATH:/usr/src/apps/vendor/bin:bin