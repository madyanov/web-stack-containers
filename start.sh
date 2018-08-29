#!/bin/bash

# https://stackoverflow.com/a/23002317
function abspath() {
    if [ -d "$1" ]; then
        (cd "$1"; pwd)
    elif [ -f "$1" ]; then
        if [[ $1 = /* ]]; then
            echo "$1"
        elif [[ $1 == */* ]]; then
            echo "$(cd "${1%/*}"; pwd)/${1##*/}"
        else
            echo "$(pwd)/$1"
        fi
    fi
}

export ENVIRONMENT="$1"
export APP_ROOT="$(abspath "${2:-$(pwd ./www)/www}")"
export COMPOSE_PROJECT_NAME="$ENVIRONMENT"

echo "$APP_ROOT" > ".pid-$ENVIRONMENT"

 docker-compose -f base.yml -f "$ENVIRONMENT.yml" up
