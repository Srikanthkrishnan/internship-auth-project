
<?php

require '../vendor/autoload.php';

use MongoDB\Client;
use Predis\Client as RedisClient;

// ================= MYSQL =================

$mysql_host = "mysql.railway.internal";
$mysql_port = 13373;
$mysql_db   = "railway";
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
    die("MySQL Connection Failed: " . $conn->connect_error);
}

// ================= MONGODB =================

$mongo_uri = "mongodb+srv://srikanthkrishnan15_db_user:hpT87xGEEzR7zoIe@cluster0.p8n08ma.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0";

try {

    $mongoClient = new Client($mongo_uri);

    $mongoDB = $mongoClient->internship_profile;

} catch (Exception $e) {

    die("MongoDB Connection Failed: " . $e->getMessage());
}

// ================= REDIS =================

$redis = new RedisClient([
    'scheme' => 'tcp',
    'host'   => 'model-satyr-125165.upstash.io',
    'port'   => 6379,
    'password' => 'gQAAAAAAAejtAAIgcDIwMTAzNTU1NjY4ZmQ0ODhhYjJhODg2YWRiOTM1OTAxYQ'
]);

?>


