
<?php

require __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client as MongoClient;
use Predis\Client as RedisClient;

/*
|--------------------------------------------------------------------------
| MYSQL DATABASE CONNECTION (RAILWAY)
|--------------------------------------------------------------------------
*/

$mysql_host = "mysql.railway.internal";

$mysql_user = "root";

$mysql_password = "OZRrSkuwUDeYIDgohPfxmiXcSDwKtGuf";

$mysql_database = "railway";

$mysql_port = 3306;

$mysql = new mysqli(

    $mysql_host,
    $mysql_user,
    $mysql_password,
    $mysql_database,
    $mysql_port

);

if ($mysql->connect_error) {

    die(

        json_encode([

            "status"  => "error",

            "message" => "MySQL Connection Failed : " . $mysql->connect_error

        ])

    );
}

/*
|--------------------------------------------------------------------------
| MONGODB ATLAS CONNECTION
|--------------------------------------------------------------------------
*/

try {

    $mongoClient = new MongoClient(

        "mongodb+srv://ks8283311_db_user:Srikanth123@cluster0.5600sbj.mongodb.net/internship_profile?retryWrites=true&w=majority&appName=Cluster0"

    );

    $mongoDB = $mongoClient->internship_profile;

} catch (Exception $e) {

    die(

        json_encode([

            "status"  => "error",

            "message" => "MongoDB Connection Failed : " . $e->getMessage()

        ])

    );
}

/*
|--------------------------------------------------------------------------
| REDIS (UPSTASH) CONNECTION
|--------------------------------------------------------------------------
*/

try {

    $redis = new RedisClient([

        'scheme'   => 'tls',

        'host'     => 'model-satyr-125165.upstash.io',

        'port'     => 6379,

        'username' => 'default',

        'password' => 'gQAAAAAAAejtAAIgcDIwMTAzNTU1NjY4ZmQ0ODhhYjJhODg2YWRiOTM1OTAxYQ'

    ]);

    $redis->connect();

} catch (Exception $e) {

    die(

        json_encode([

            "status"  => "error",

            "message" => "Redis Connection Failed : " . $e->getMessage()

        ])

    );
}

?>







