<!-- <?php

require '../vendor/autoload.php';

$mysql = new mysqli(
    "127.0.0.1",
    "root",
    "",
    "internship_auth",
    3307
);

if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");

$mongoDB = $mongoClient->internship_profile;

$redis = new Predis\Client();

?> -->



<?php

require '../vendor/autoload.php';

// MYSQL
$mysql = new mysqli(
    getenv('MYSQL_HOST'),
    getenv('MYSQL_USER'),
    getenv('MYSQL_PASSWORD'),
    getenv('MYSQL_DATABASE')
);

// MongoDB
$mongoClient = new MongoDB\Client(
    getenv('MONGO_URI')
);

$mongoDB = $mongoClient->internship_profile;

// Redis
$redis = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => getenv('REDIS_HOST'),
    'port'   => getenv('REDIS_PORT'),
    'password' => getenv('REDIS_PASSWORD')
]);

?>