<?php

include 'php/config.php';

echo "MySQL Connected <br>";

echo "MongoDB Connected <br>";

$redis->set("test", "Redis Working");

echo $redis->get("test");

?>