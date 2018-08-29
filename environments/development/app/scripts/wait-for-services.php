#!/usr/bin/php
<?php

$mysqlReady = false;
$memcachedReady = false;
$redisReady = false;

$memcached = new \Memcached();
$redis = new \Redis();

$timeout = getenv('APP_SERVICES_TIMEOUT') ?? 60;

for ($i = 0; $i < $timeout; ++$i) {
    if (!$mysqlReady) {
        try {
            new \PDO(
                'mysql:host=' . getenv('MYSQL_HOST') . ';port=' . getenv('MYSQL_PORT') .
                    ';dbname=' . getenv('MYSQL_DATABASE'),
                getenv('MYSQL_USER'),
                getenv('MYSQL_PASSWORD')
            );

            $mysqlReady = true;
        } catch (\Exception $exception) {
            $mysqlReady = false;
        }
    }

    if (!$memcachedReady) {
        try {
            $memcached->addServer(getenv('MEMCACHED_HOST'), getenv('MEMCACHED_PORT'));
            $memcachedReady = $memcached->getStats() !== false;
        } catch (\Exception $exception) {
            $memcachedReady = false;
        }
    }

    if (!$redisReady) {
        try {
            $redis->connect(getenv('REDIS_HOST'), getenv('REDIS_PORT'), 1);
            $redisReady = $redis->ping() === '+PONG';
        } catch (\Exception $exception) {
            $redisReady = false;
        }
    }

    if ($mysqlReady && $memcachedReady && $redisReady) {
        exit(0);
    } else {
        if (!$mysqlReady) {
            echo 'MySQL not ready (' . getenv('MYSQL_HOST') . ':' . getenv('MYSQL_PORT') . ")\n";
        }

        if (!$memcachedReady) {
            echo 'Memcached not ready (' . getenv('MEMCACHED_HOST') . ':' . getenv('MEMCACHED_PORT') . ")\n";
        }

        if (!$redisReady) {
            echo 'Redis not ready (' . getenv('REDIS_HOST') . ':' . getenv('REDIS_PORT') . ")\n";
        }
    }

    sleep(1);
}

exit(1);
