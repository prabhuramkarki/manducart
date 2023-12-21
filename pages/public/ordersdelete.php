<?php
session_start();
include "db_connection.php";
$order_id = $_GET['order_id'];

$sql_select ="SELECT * FROM tbl_order_details WHERE order_id=$order_id";
$result_select = mysqli_query($connection, $sql_select);

$db_data = mysqli_fetch_assoc($result_select);
$product_id = $db_data['product_id'];
$ordered_quantity = $db_data['order_quantity'];

$sql_select_product = "SELECT * FROM tbl_products WHERE product_id=$product_id";
$result_select_product = mysqli_query($connection, $sql_select_product);

$db_data_product = mysqli_fetch_assoc($result_select_product);
$quantity_of_product = $db_data_product['product_quantity'];

$final_quantity_of_product = $quantity_of_product + $ordered_quantity;

$sql_update = "UPDATE tbl_products SET product_quantity='$final_quantity_of_product' WHERE product_id=$product_id";
$result_update = mysqli_query($connection, $sql_update);


// Deleting data from orders table
$sql_orders = "DELETE FROM tbl_orders WHERE id=$order_id";
$result_orders = mysqli_query($connection, $sql_orders);

// Deleting data from orders table
$sql_order_details = "DELETE FROM tbl_order_details WHERE order_id=$order_id";
$result_order_details = mysqli_query($connection, $sql_order_details);

// Deleting data from orders table
$sql_shippings = "DELETE FROM tbl_shippings WHERE order_id=$order_id";
$result_shippings = mysqli_query($connection, $sql_shippings);
 


if($result_orders) {
    $_SESSION['delete_message'] = true;
} 

header("location: customerorders.php");

