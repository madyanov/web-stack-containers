#!/bin/bash

cd /var/www

if [ -f bootstrap.sh ]; then
    chmod +x bootstrap.sh
    . bootstrap.sh
else
    exec "$@"
fi
