#!/bin/bash

COMPOSE_PROJECT_NAME=$1 ENVIRONMENT=$1 APP_ROOT="${2:-`pwd www`/www}" docker-compose -f base.yml -f $1.yml up
