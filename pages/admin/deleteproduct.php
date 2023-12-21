<?php
session_start();
include "db_connection.php";

$product_id = $_GET['product_id'];

$sql_select = "SELECT * FROM tbl_products WHERE product_id=$product_id ";
$result_select = mysqli_query($connection, $sql_select);
$db_data = mysqli_fetch_assoc($result_select);
$category_id = $db_data['category_id'];
$product_image = $db_data['product_image'];
$product_image2 = $db_data['product_image2'];
$product_image3= $db_data['product_image3'];
$product_image4 = $db_data['product_image4'];

unlink("../../images/".$product_image);
unlink("../../images/".$product_image2);
unlink("../../images/".$product_image3);
unlink("../../images/".$product_image4);

$sql = "DELETE FROM tbl_products WHERE product_id=$product_id";

$result = mysqli_query($connection, $sql);



$sql_category = "DELETE FROM tbl_categories WHERE category_id=$category_id";
$result_category = mysqli_query($connection, $sql_category);


if ($result && $result_category) {
    $_SESSION['delete_message'] = true;
} else {
    $_SESSION['delete_message'] = true;
}

header("location: manageproducts.php");