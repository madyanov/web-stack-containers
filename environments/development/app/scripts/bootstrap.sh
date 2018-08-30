#!/bin/bash

composer install --no-plugins --no-scripts

echo "Waiting for services..."
/scripts/wait-for-services.php

if [ "$ENVIRONMENT" = "testing" ]; then
    echo "Run tests"
    ./vendor/bin/phpunit
else
    exec "$@"
fi
