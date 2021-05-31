<?php

$database = $settings['database'];
$user = $database['user'];
$port = $database['port'];
$dbname = $database['name'];
$password = $database['password'];
$host = $database['host'];

$host_driver = "{$host}:{$port}"; 

$conn = mysqli_connect($host_driver,$user,$password,$dbname) or 
die('Connnect Error');




