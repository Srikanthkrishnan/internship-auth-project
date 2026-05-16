<?php

require __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;
use Predis\Client as PredisClient;

/* =========================
   MYSQL CONNECTION
========================= */

$mysql_host = "yamanote.proxy.rlwy.net";
$mysql_port = 13373;
$mysql_db   = "internship_auth";
$mysql_user = "root";
$mysql_pass = "OZRrSkuwUDeYIDgohPfxmiXcSDwKtGuf";



$conn = new mysqli(
    $mysql_host,
    $mysql_user,
    $mysql_pass,
    $mysql_db,
    $mysql_port
);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "MySQL Connection Failed: " . $conn->connect_error
    ]));
}

/* =========================
   MONGODB CONNECTION
========================= */
try {

    $mongo_uri = "mongodb+srv://srikanthkrishnan15_db_user:hpT87xGEEzR7zoIe@cluster0.p8n08ma.mongodb.net/?appName=Cluster0";

    $mongoClient = new MongoDB\Client($mongo_uri);

    $mongoDB = $mongoClient->internship_profile;

} catch (Exception $e) {

    die("MongoDB Connection Failed: " . $e->getMessage());
}

/* =========================
   REDIS CONNECTION
========================= */

try {

    $redis = new PredisClient([
        'scheme' => 'tls',
        'host'   => 'model-satyr-125165.upstash.io',
        'port'   => 6379,
        'password' => 'gQAAAAAAAejtAAIgcDIwMTAzNTU1NjY4ZmQ0ODhhYjJhODg2YWRiOTM1OTAxYQ'
    ]);

    $redis->ping();

} catch (Exception $e) {

    die(json_encode([
        "status" => "error",
        "message" => "Redis Connection Failed: " . $e->getMessage()
    ]));
}

?>


