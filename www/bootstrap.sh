#!/bin/bash

echo "Waiting for services..."
php wait_for_services.php

if [ "$ENVIRONMENT" = "testing" ]; then
    echo "CLEAR DATABASE"
    echo "RUN TESTS"
else
    exec "$@"
fi
