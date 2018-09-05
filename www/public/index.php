<h1>Hello!</h1>
<pre>
<?php var_export($_SERVER); ?>
</pre>

<?php

$mysqlReady = true;
$memcachedReady = true;
$redisReady = true;

try {
    new \PDO(
        'mysql:host=' . getenv('MYSQL_HOST') . ';port=' . getenv('MYSQL_PORT') . ';dbname=' . getenv('MYSQL_DATABASE'),
        getenv('MYSQL_USER'),
        getenv('MYSQL_PASSWORD'),
        [ \PDO::ATTR_TIMEOUT => 1 ]
    );
} catch (\Exception $exception) {
    trigger_error($exception->getMessage(), E_USER_WARNING);
    $mysqlReady = false;
}

$memcached = new \Memcached();
$memcached->addServer(getenv('MEMCACHED_HOST'), getenv('MEMCACHED_PORT'));
$memcached->set('test', 'ok', 10);

if ($memcached->get('test') !== 'ok') {
    $memcachedReady = false;
}

$redis = new \Redis();
$redis->connect(getenv('REDIS_HOST'), getenv('REDIS_PORT'), 1);
$redis->set('test', 'ok', 10);

if ($redis->get('test') !== 'ok') {
    $redisReady = false;
}

?>

<table>
    <tr>
        <td>MySQL</td>
        <td><?php echo $mysqlReady ? 'enabled' : 'disabled' ?></td>
    </tr>
    <tr>
        <td>Memcached</td>
        <td><?php echo $memcachedReady ? 'enabled' : 'disabled' ?></td>
    </tr>
    <tr>
        <td>Redis</td>
        <td><?php echo $redisReady ? 'enabled' : 'disabled' ?></td>
    </tr>
</table>

<?php phpinfo(); ?>
