<?php

// MYSQL DATABASE (Railway)
$host = "mysql.railway.internal";
$user = "root";
$password = "OZRrSkuwUDeYIDgohPfxmiXcSDwKtGuf";
$database = "railway";
$port = 3306;

// MySQL Connection
$conn = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "MySQL Connection Failed: " . $conn->connect_error
    ]));
}

// MongoDB
require '../vendor/autoload.php';

$mongoClient = new MongoDB\Client(
    "mongodb+srv://ks8283311_db_user:Srikanth123@cluster0.5600sbj.mongodb.net/internship_profile?retryWrites=true&w=majority&appName=Cluster0"
);

$mongoDB = $mongoClient->internship_profile;
$profilesCollection = $mongoDB->profiles;

// Redis (Upstash)
$redis = new Predis\Client([
    'scheme' => 'tls',
    'host'   => 'model-satyr-125165.upstash.io',
    'port'   => 6379,
    'password' => 'gQAAAAAAAejtAAIgcDIwMTAzNTU1NjY4ZmQ0ODhhYjJhODg2YWRiOTM1OTAxYQ'
]);

?>