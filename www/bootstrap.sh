#!/bin/bash

while ! nc -z "$MYSQL_HOST" "$MYSQL_PORT"; do sleep 0.1; done
while ! nc -z "$MEMCACHED_HOST" "$MEMCACHED_PORT"; do sleep 0.1; done
while ! nc -z "$REDIS_HOST" "$REDIS_PORT"; do sleep 0.1; done