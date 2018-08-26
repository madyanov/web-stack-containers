FROM debian:stretch-slim

ENV DEBIAN_FRONTEND=noninteractive
COPY entrypoint.sh /

RUN apt-get update
RUN apt-get install -y --no-install-recommends \
    apt-transport-https \
    ca-certificates \
    dirmngr \
    git \
    gnupg \
    unzip \
    wget \
    zip

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    echo "deb https://packages.sury.org/php/ stretch main" | tee /etc/apt/sources.list.d/php.list && \
    apt-get update

RUN apt-get install -y --no-install-recommends \
    php7.2-fpm \
    php7.2-mbstring \
    php7.2-memcached \
    php7.2-mysql \
    php7.2-phpdbg \
    php7.2-redis \
    php7.2-tokenizer \
    php7.2-xdebug \
    php7.2-xml \
    php7.2-zip

RUN wget -O /tmp/composer-setup.php https://getcomposer.org/installer && \
    wget -O /tmp/composer-setup.sig https://composer.github.io/installer.sig && \
    php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid composer installer' . PHP_EOL; exit(1); }" && \
    php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm /tmp/composer-setup.php /tmp/composer-setup.sig

RUN wget -O /tmp/phpunit.phar https://phar.phpunit.de/phpunit.phar && \
    wget -O /tmp/phpunit.phar.asc https://phar.phpunit.de/phpunit.phar.asc && \
    gpg --keyserver pgp.uni-mainz.de --recv-keys 0x4AA394086372C20A && \
    gpg /tmp/phpunit.phar.asc && \
    chmod +x /tmp/phpunit.phar && \
    mv /tmp/phpunit.phar /usr/local/bin/phpunit && \
    rm /tmp/phpunit.phar.asc

RUN mkdir /var/run/php && \
    rm -rf /etc/php/7.2/fpm/pool.d/*

RUN apt-get purge -y --auto-remove apt-transport-https apt-transport-https ca-certificates dirmngr gnupg wget && \
    apt-get clean && \
    apt-get purge && \
    rm -rf /tmp/* /var/tmp/* && \
    rm -rf /var/lib/apt/lists/*

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm7.2"]
