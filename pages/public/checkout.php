<?php
session_start();
include "db_connection.php";

$form_page = $_GET['form_page'];

$customer_id = $_SESSION['customer_id'];
$product_id = $_GET['product_id'];
$product_buy_quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;



if (isset($_POST['checkout'])) {
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : $db_data['fullname'];
    $phone = isset($_POST['phone']) ? $_POST['phone'] : $db_data['phone'];
    $email = isset($_POST['email']) ? $_POST['email'] : $db_data['email'];
    $address = $_POST['address'];
    header("location:payment.php?form_page=$form_page&product_id=$product_id&fullname=$fullname&email=$email&phone=$phone&address=$address&product_buy_quantity=$product_buy_quantity");
}

$select_sql1 = "SELECT * FROM tbl_customers WHERE customer_id = $customer_id";
$select_res1 = mysqli_query($connection, $select_sql1);
$db_data = mysqli_fetch_assoc($select_res1);

$fullname = isset($db_data['fullname']) ? $db_data['fullname'] : '';
$email = isset($db_data['email']) ? $db_data['email'] : '';
$phone = isset($db_data['phone']) ? $db_data['phone'] : '';



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/checkout.css">
    <link rel="stylesheet" href="../../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Payment Page</title>

</head>

<body>
    <?php include "nav.php"; ?>
    <div class="main-wrapper">
        <div class="checkout-wrapper">
            <form action="#" method="post">
                <h2 class="title">Checkout Details</h2>
                <div>
                    <i class="fa-solid fa-user"></i>
                    <label for="">Fullname</label>
                </div>
                <div>
                    <input class="input-field" type="text" name="fullname" value="<?php echo $fullname; ?>" required>
                </div>
                <div>
                    <i class="fa-solid fa-envelope"></i>
                    <label for="">Email</label>
                </div>
                <div>
                    <input class="input-field" type="text" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div>
                    <i class="fa-solid fa-phone"></i>
                    <label for="">Phone</label>
                </div>
                <div>
                    <input class="input-field" type="text" name="phone" value="<?php echo $phone; ?>" required>
                </div>
                <div>
                    <i class="fa-solid fa-address-book"></i>
                    <label for="">Address</label>
                </div>
                <div>
                    <input class="input-field" type="text" name="address" required>
                </div>
                <button type="submit" value="submit" class="button" name="checkout"> <i
                        class="fa-solid fa-circle-check"></i> Proceed to Checkout</button>


            </form>
        </div>
    </div>
    <br>
    <br>
</body>

</html>