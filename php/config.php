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

$host = "YOUR_MYSQL_HOST";
$user = "YOUR_MYSQL_USER";
$password = "YOUR_MYSQL_PASSWORD";
$database = "YOUR_MYSQL_DATABASE";

$conn = new mysqli($host, $user, $password, $database);

if($conn->connect_error){
    die("Connection failed");
}

?>