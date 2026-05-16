<!-- <?php

require __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client as MongoClient;
use Predis\Client as RedisClient;

/*
|--------------------------------------------------------------------------
| MySQL Connection
|--------------------------------------------------------------------------
*/

$mysql = new mysqli(
    "127.0.0.1",
    "root",
    "",
    "internship_auth",
    3307
);

if ($mysql->connect_error) {

    die(
        "MySQL Connection Failed: "
        . $mysql->connect_error
    );
}

/*
|--------------------------------------------------------------------------
| MongoDB Connection
|--------------------------------------------------------------------------
*/

try {

    $mongoClient = new MongoClient(
        "mongodb://127.0.0.1:27017"
    );

    $mongoDB = $mongoClient->internship_profile;

} catch (Exception $e) {

    die(
        "MongoDB Connection Failed: "
        . $e->getMessage()
    );
}

/*
|--------------------------------------------------------------------------
| Redis Connection
|--------------------------------------------------------------------------
*/

try {

    $redis = new RedisClient([

        "scheme" => "tcp",
        "host"   => "127.0.0.1",
        "port"   => 6379

    ]);

} catch (Exception $e) {

    die(
        "Redis Connection Failed: "
        . $e->getMessage()
    );
}

?> -->







