#!/bin/bash

echo "Waiting for services..."
php wait_for_services.php

if [ "$ENVIRONMENT" = "testing" ]; then
    echo "Run tests"
    phpunit --version
else
    exec "$@"
fi
