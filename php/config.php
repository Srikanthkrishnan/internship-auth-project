

<?php

require '../vendor/autoload.php';

use MongoDB\Client;
use Predis\Client as RedisClient;

/* ================= MYSQL ================= */

$mysql_host = "yamanote.proxy.rlwy.net";
$mysql_port = 13373;
$mysql_db   = "railway";
$mysql_user = "root";
$mysql_pass = "OZRrSkuwUDeYIDgohPfxmiXcSDwKtGuf";

/*
COPY PASSWORD FROM:

Railway
→ MySQL
→ Connect
→ show

Copy the real password
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    $conn = mysqli_init();

    mysqli_options($conn, MYSQLI_OPT_CONNECT_TIMEOUT, 10);

    mysqli_real_connect(
        $conn,
        $mysql_host,
        $mysql_user,
        $mysql_pass,
        $mysql_db,
        $mysql_port
    );

    $conn->set_charset("utf8mb4");

} catch (Exception $e) {

    die("MySQL Connection Failed: " . $e->getMessage());
}


/* ================= MONGODB ================= */

$mongo_uri = "mongodb+srv://srikanthkrishnan15_db_user:hpT87xGEEzR7zoIe@cluster0.p8n08ma.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0";

try {

    $mongoClient = new Client($mongo_uri);

    $mongoDB = $mongoClient->internship_profile;

} catch (Exception $e) {

    die("MongoDB Connection Failed: " . $e->getMessage());
}


/* ================= REDIS ================= */

try {

    $redis = new RedisClient([
        'scheme' => 'tcp',
        'host'   => 'model-satyr-125165.upstash.io',
        'port'   => 6379,
        'password' => 'gQAAAAAAAejtAAIgcDIwMTAzNTU1NjY4ZmQ0ODhhYjJhODg2YWRiOTM1OTAxYQ'
    ]);

} catch (Exception $e) {

    die("Redis Connection Failed: " . $e->getMessage());
}

?>