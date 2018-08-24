#!/bin/bash

export ENVIRONMENT="$1"
export APP_ROOT="${2:-`pwd www`/www}"
export COMPOSE_PROJECT_NAME="$ENVIRONMENT"

echo "$ENVIRONMENT" > .pid
echo "$APP_ROOT" >> .pid

 docker-compose -f base.yml -f "$ENVIRONMENT.yml" up
