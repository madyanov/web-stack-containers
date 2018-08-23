<h1>Hello!</h1>
<pre>
<?php var_export($_SERVER); ?>
</pre>

<?php

$mysql = true;
$memcached = true;

try {
    new PDO(
        'mysql:host=' . getenv('MYSQL_HOST') . ';port=' . getenv('MYSQL_PORT') . ';dbname=' . getenv('MYSQL_DATABASE'),
        getenv('MYSQL_USER'),
        getenv('MYSQL_PASSWORD'),
        [ PDO::ATTR_TIMEOUT => 1 ]
    );
} catch (Exception $e) {
    trigger_error($e->getMessage(), E_USER_WARNING);
    $mysql = false;
}

$mc = new Memcached();
$mc->addServer(getenv('MEMCACHED_HOST'), getenv('MEMCACHED_PORT'));
$mc->set('test', 'ok', 10);

if ($mc->get('test') !== 'ok') {
    $memcached = false;
}

$redis = new Redis();
$redis->connect(getenv('REDIS_HOST'), getenv('REDIS_PORT'), 1);
$redis->set('test', 'ok', 10);

if ($redis->get('test') !== 'ok') {
    $redis = false;
}

?>

<table>
    <tr>
        <td>MySQL</td>
        <td><?php echo $mysql ? 'enabled' : 'disabled' ?></td>
    </tr>
    <tr>
        <td>Memcached</td>
        <td><?php echo $memcached ? 'enabled' : 'disabled' ?></td>
    </tr>
    <tr>
        <td>Redis</td>
        <td><?php echo $redis ? 'enabled' : 'disabled' ?></td>
    </tr>
</table>

<?php phpinfo(); ?>
