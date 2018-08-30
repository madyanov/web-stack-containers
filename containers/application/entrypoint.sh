#!/bin/bash

cd /var/www

if [ -f /scripts/bootstrap.sh ]; then
    chmod +x /scripts/*
    . /scripts/bootstrap.sh
else
    exec "$@"
fi
