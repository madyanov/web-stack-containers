#!/bin/bash

export ENVIRONMENT="$1"
export APP_ROOT="$(tail -n+1 ".pid-$ENVIRONMENT" | head -n1)"
export COMPOSE_PROJECT_NAME="$ENVIRONMENT"

docker-compose -f base.yml -f "$ENVIRONMENT.yml" restart
