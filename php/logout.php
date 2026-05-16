<?php

include 'config.php';

$token = $_GET['token'];

$redis->del([$token]);

echo "Logged Out";

?>