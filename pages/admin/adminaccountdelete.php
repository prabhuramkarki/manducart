<?php
session_start();
include("db_connection.php");

$admin_id = $_SESSION['admin_id'];

$sql = "DELETE FROM tbl_admins WHERE admin_id=$admin_id";
$result = mysqli_query($connection, $sql);
echo '<script>alert("Account deleted successfully")</script>';

header("location: vendorlogin.php");