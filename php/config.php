<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;
use Predis\Client as RedisClient;

/*
|--------------------------------------------------------------------------
| MYSQL CONNECTION (Railway Public Networking)
|--------------------------------------------------------------------------
*/

$mysql_host = getenv('MYSQLHOST') ?: 'yamanote.proxy.rlwy.net';
$mysql_port = getenv('MYSQLPORT') ?: 13373;
$mysql_db   = getenv('MYSQLDATABASE') ?: 'railway';
$mysql_user = getenv('MYSQLUSER') ?: 'root';
$mysql_pass = getenv('MYSQLPASSWORD') ?: 'OZRrSkuwUDeYIDgohPfxmiXcSDwKtGuf';

$conn = new mysqli(
    $mysql_host,
    $mysql_user,
    $mysql_pass,
    $mysql_db,
    (int)$mysql_port
);

if ($conn->connect_error) {

    die("MySQL Connection Failed: " . $conn->connect_error);
}

/*
|--------------------------------------------------------------------------
| MONGODB CONNECTION
|--------------------------------------------------------------------------
*/

$mongo_uri = getenv('MONGODB_URI') ?: 'mongodb+srv://srikanthkrishnan15_db_user:hpT87xGEEzR7zoIe@cluster0.p8n08ma.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';

try {

    $mongoClient = new Client($mongo_uri);

    $mongoDB = $mongoClient->internship_profile;

} catch (Exception $e) {

    die("MongoDB Connection Failed: " . $e->getMessage());
}

/*
|--------------------------------------------------------------------------
| REDIS CONNECTION (Upstash Redis)
|--------------------------------------------------------------------------
*/

try {

    $redis = new RedisClient([

        'scheme'   => 'tcp',
        'host'     => getenv('REDIS_HOST') ?: 'model-satyr-125165.upstash.io',
        'port'     => getenv('REDIS_PORT') ?: 6379,
        'password' => getenv('REDIS_PASSWORD') ?: 'gQAAAAAAAejtAAIgcDIwMTAzNTU1NjY4ZmQ0ODhhYjJhODg2YWRiOTM1OTAxYQ'

    ]);

} catch (Exception $e) {

    die("Redis Connection Failed: " . $e->getMessage());
}

?>