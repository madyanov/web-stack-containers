#!/bin/bash

echo "Waiting for services..."
./wait-for-services.php

if [ "$ENVIRONMENT" = "testing" ]; then
    echo "Run tests"
    phpunit --version
else
    exec "$@"
fi
