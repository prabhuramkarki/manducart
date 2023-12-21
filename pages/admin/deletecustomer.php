<?php
session_start();
include "db_connection.php";

$customer_id = $_GET['customer_id'];

$sql = "DELETE FROM tbl_customers WHERE customer_id=$customer_id";

$result = mysqli_query($connection, $sql);

if($result) {
    $_SESSION['delete_message'] = true;
}
header("location: managecustomers.php");