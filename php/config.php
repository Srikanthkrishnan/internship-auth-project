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

$host = getenv("DB_HOST");
$user = getenv("DB_USER");
$pass = getenv("DB_PASS");
$db   = getenv("DB_NAME");
$port = getenv("DB_PORT");

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>