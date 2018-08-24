#!/bin/bash

export ENVIRONMENT=$(tail -n+1 .pid | head -n1)
export APP_ROOT=$(tail -n+2 .pid | head -n1)
export COMPOSE_PROJECT_NAME="$ENVIRONMENT"

docker-compose -f base.yml -f "$ENVIRONMENT.yml" restart
