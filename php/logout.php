<?php

include 'config.php';

$token = $_POST['token'];

$redis->del([$token]);


echo json_encode([
    "status" => true
]);

?>