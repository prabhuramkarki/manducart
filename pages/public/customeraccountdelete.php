<?php
session_start();
include("db_connection.php");



$customer_id = $_SESSION['customer_id'];

$sql = "DELETE FROM tbl_customers WHERE customer_id=$customer_id";
$result = mysqli_query($connection, $sql);
echo '<script>alert("Account deleted successfully")</script>';

session_destroy();
header("location: login.php");