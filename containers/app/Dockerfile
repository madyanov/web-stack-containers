FROM debian:stretch-slim

ENV DEBIAN_FRONTEND=noninteractive
COPY entrypoint.sh /

RUN apt-get update
RUN apt-get install -y --no-install-recommends \
    ca-certificates \
    git \
    netcat \
    php-fpm \
    php-mbstring \
    php-memcached \
    php-mysql \
    php-phpdbg \
    php-redis \
    php-xml \
    php-zip \
    unzip \
    wget \
    zip

RUN wget -O /tmp/composer-setup.php https://getcomposer.org/installer && \
    wget -O /tmp/composer-setup.sig https://composer.github.io/installer.sig && \
    php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" && \
    php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN mkdir /var/run/php && \
    rm -rf /etc/php/7.0/fpm/pool.d/*

RUN apt-get purge -y --auto-remove wget && \
    apt-get clean && \
    apt-get purge && \
    rm -rf /tmp/* /var/tmp/* && \
    rm -rf /var/lib/apt/lists/*

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm7.0"]
