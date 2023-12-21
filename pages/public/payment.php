<?php
session_start();
include("db_connection.php");

$product_id = $_GET['product_id'];
$fullname = $_GET['fullname'];
$form_page = $_GET['form_page'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$address = $_GET['address'];
$customer_id = $_SESSION['customer_id'];


if ($form_page === "cart") {

    $select_sql = "SELECT * FROM tbl_carts WHERE product_id=$product_id AND customer_id=$customer_id";

    $select_res = mysqli_query($connection, $select_sql);

    if (!$select_res) {
        echo "query not send";
    }
    $data = mysqli_fetch_assoc($select_res);
    $product_buy_quantity = isset($data['quantity']) ? $data['quantity'] : 1;
} else {
    $product_buy_quantity = isset($_GET['product_buy_quantity']) ? $_GET['product_buy_quantity'] : 1;
}

$sql_select_product = "SELECT * FROM tbl_products WHERE product_id = $product_id";
$result_selc = mysqli_query($connection, $sql_select_product);
$fetch_data_select = mysqli_fetch_assoc($result_selc);
$in_stock = $fetch_data_select["product_quantity"];
$product_price = $fetch_data_select['product_price'];

$total_amount = $product_buy_quantity * $product_price;



if (isset($_POST['payment'])) {
    $payment_method = $_POST['payment-method'];

    $sql_order = "INSERT INTO tbl_orders(customer_id) VALUES ('$customer_id')";
    if ($connection->query($sql_order) === TRUE) {
        $latest_id = $connection->insert_id;
    } else {
        echo "Error: " . $sql4 . "<br>" . $connection->error;
    }

    $status = 'Processing';

    $sql_order_details = "INSERT INTO tbl_order_details (order_id,status,product_id,order_quantity,payment_method) VALUES ('$latest_id','$status','$product_id','$product_buy_quantity','$payment_method')";
    $result = mysqli_query($connection, $sql_order_details);
    if (!$result) {
        echo "Data not inserted";
    }


    $sql_shippings = "INSERT INTO tbl_shippings (order_id,customer_name, email, phone, address)VALUES($latest_id,'$fullname', '$email', '$phone','$address')";

    $select_res5 = mysqli_query($connection, $sql_shippings);

    if (!$select_res5) {
        echo "Query not sent" . mysqli_error($connection);
    }


    $stock_after_purchase = $in_stock - $product_buy_quantity;

    $update_sql = "UPDATE tbl_products SET product_quantity = $stock_after_purchase WHERE product_id=$product_id";
    $update_result = mysqli_query($connection, $update_sql);


    header("location:thankyou.php");
}


if (isset($_POST['payment_option'])) {
    echo '<script>alert("API Under Development")</script>';
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ecommerce Home Page</title>
    <link rel="stylesheet" href="../../assets/payment.css" />
</head>

<body>

    <?php include("nav.php") ?>
    <!-- for payment page  -->
    <br>
    <br>

    <div class="main">
        <div class="container">
            <div>
                <form action="#" method="post">
                    <div id="total_amt">
                        <h3>Total Amount To Pay</h3>
                        <p>Rs.
                            <?php echo $total_amount; ?>
                        </p>
                    </div>
                    <h3 style="margin-bottom: 10px;">Payment Option</h3>
                    <select name="payment-method" required>
                        <option value="C-O-D">Cash On Delivery</option>
                    </select>
                    <button type="submit" name="payment_option" id="payment_option1"> Esewa</button>
                    <p style="display: inline; font-size:20px">or</p>
                    <button type="submit" name="payment_option" id="payment_option2"> Khalti</button>

                    <button type="submit" name="payment" id="payment"> <i class="fa-solid fa-circle-check"
                            style="margin-right: 1px; padding:3px;"></i> Confirm
                        Payment</button>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>