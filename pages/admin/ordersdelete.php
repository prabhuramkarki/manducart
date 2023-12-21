<?php
session_start();
include "db_connection.php";
$order_id = $_GET['order_id'];

$sql_select = "SELECT * FROM tbl_orders WHERE id=$order_id";
$result_select = mysqli_query($connection, $sql_select);
$db_data = mysqli_fetch_assoc($result_select);
$customer_id = $db_data['customer_id'];

$sql_delete_orders = "DELETE FROM tbl_orders WHERE id=$order_id";
$result_orders = mysqli_query($connection, $sql_delete_orders);


$sql_select_customer_name = "SELECT * FROM tbl_customers WHERE customer_id=$customer_id";
$result_name = mysqli_query($connection, $sql_select_customer_name);
$db_data_name = mysqli_fetch_assoc($result_name);
$customer_name = $db_data['$customer_name'];

$sql_delete_order_details = "DELETE FROM tbl_order_details WHERE order_id=$order_id";
$result_order_details = mysqli_query($connection, $sql_delete_order_details);

$sql_delete_category = "DELETE FROM tbl_shippings WHERE order_id=$order_id";
$result_category = mysqli_query($connection, $sql_delete_category);

if($result_orders) {
    $_SESSION['order_delete_message'] = "Order deleted of $customer_name ";
} else {
    $_SESSION['order_delete_message'] = "Order not found.";
}

header("location: manageorders.php");

