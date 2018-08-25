<?php

$mysqlReady = false;
$memcachedReady = false;
$redisReady = false;

$memcached = new Memcached();
$redis = new Redis();

for ($i = 0; $i < 30; ++$i) {
    if (!$mysqlReady) {
        try {
            new PDO(
                'mysql:host=' . getenv('MYSQL_HOST') . ';port=' . getenv('MYSQL_PORT') . ';dbname=' . getenv('MYSQL_DATABASE'),
                getenv('MYSQL_USER'),
                getenv('MYSQL_PASSWORD')
            );

            $mysqlReady = true;
        } catch (Exception $e) {
            $mysqlReady = false;
        }
    }

    if (!$memcachedReady) {
        try {
            $memcached->addServer(getenv('MEMCACHED_HOST'), getenv('MEMCACHED_PORT'));
            $memcachedReady = $memcached->getStats() !== false;
        } catch (Exception $e) {
            $memcachedReady = false;
        }
    }

    if (!$redisReady) {
        try {
            $redis->connect(getenv('REDIS_HOST'), getenv('REDIS_PORT'), 1);
            $redisReady = $redis->ping() === '+PONG';
        } catch (Exception $e) {
            $redisReady = false;
        }
    }

    if ($mysqlReady && $memcachedReady && $redisReady) {
        exit(0);
    }

    sleep(1);
}

exit(1);
