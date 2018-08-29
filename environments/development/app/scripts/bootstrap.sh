#!/bin/bash

composer install --no-plugins --no-scripts

echo "Waiting for services..."
/scripts/wait-for-services.php

if [ "$ENVIRONMENT" = "testing" ]; then
    echo "Run tests"
    phpunit --version
else
    exec "$@"
fi
