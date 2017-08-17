#!/bin/bash

bootstrap() {
    cd /var/www

    if [ -f bootstrap.sh ]; then
        chmod +x bootstrap.sh
        . bootstrap.sh
    fi
}

bootstrap

exec "$@"