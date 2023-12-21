<?php
$host = 'localhost';
$db_user = 'root';
$db_pwd = '';
$db_name = 'db_manducart';

$connection = new mysqli($host, $db_user, $db_pwd, $db_name); //object
//$conn = mysqli_connect(); //instance

if(!$connection) die("Database connection failed");
