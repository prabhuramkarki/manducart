<?php
session_start();
include "db_connection.php";

$product_id = $_GET['product_id'];
$customer_id = $_SESSION['customer_id'];

$sql = "DELETE FROM tbl_carts WHERE product_id=$product_id AND customer_id=$customer_id";

$result = mysqli_query($connection, $sql);

if ($result) {
    $_SESSION['delete_product_from_cart'] =true;
} 

header("location: cart.php");