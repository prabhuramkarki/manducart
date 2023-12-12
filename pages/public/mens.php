<?php
session_start();
include("db_connection.php");

$sql = "SELECT * FROM tbl_categories WHERE product_category = 'Mens' ORDER BY RAND()";
$result = mysqli_query($connection, $sql);

$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : '';


if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['logged_in'])) {
        $product_id = $_POST['product_id'];
        $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : '';

        $query = "SELECT * FROM tbl_carts WHERE product_id='$product_id' AND customer_id ='$customer_id'";
        $data = mysqli_query($connection, $query);

        if (mysqli_num_rows($data) >= 1) {
            echo '<script>alert("Product Already Added")</script>';
        } else {
            $product_quantity = 1;
            $sql1 = "INSERT INTO tbl_carts (product_id,customer_id, quantity) VALUES('$product_id','$customer_id','$product_quantity')";
            $result1 = mysqli_query($connection, $sql1);

            if ($result1) {
                // echo '<script>alert("Product Added to Cart")</script>';
                // header("location: alert.php");

            }
        }
    } else {
        $page = "mens.php";
        $_SESSION["product_id"] = $_GET['product_id'];
        header("location: login.php? page = '$page'");
    }
}

if (isset($_POST['buy_now'])) {
    if (isset($_SESSION['logged_in'])) {
        $product_id = $_POST['product_id'];
        $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : '';
        $product_quantity_buy = 1;

        $form_page = "buy";

        header("location:checkout.php?product_id=$product_id&customer_id=$customer_id&quantity=$product_quantity_buy&form_page=$form_page");

    } else {
        $_SESSION["product_id"] = $_POST['product_id'];
        $page = "mens.php";
        header("location:login.php?page =$page");
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mens</title>
    <link rel="stylesheet" href="../../assets/style.css">
    <link rel="stylesheet" href="../../assets/footer.css">
</head>

<body>
    <nav>
        <div class="nav">
            <div class="logo">
                <i class="fa-brands fa-opencart"></i>
                <h1 id="logo-text">Mandu Cart <span id="last-word">.</span> </h1>
            </div>
            <ul class="nav-links">
                <li type="none"><a href="index.php">Home</a></li>
                <li type="none"><a href="mens.php">Men's</a></li>
                <li type="none"><a href="womens.php">Women's</a></li>
                <li type="none"><a href="shop.php">Shop</a></li>
                <li type="none"><a href="contact.php">Contact</a></li>
            </ul>
            <div class="icons">
                <a href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a>
                <i class="fa-solid fa-heart"></i>
                <a href="cart.php"><i class="fa-solid fa-cart-shopping" id="nav-cart-icon"></i></a>
                <a href="customerdashboard.php"> <i class="fa-solid fa-user"></i></a>
            </div>
        </div>
    </nav>

    <div class="main_container">
        <div class="product-container">

            <?php if ($result):
                $counter = 0;
                ?>
                <?php while ($db_data_category = mysqli_fetch_assoc($result)):

                    $category_id = $db_data_category['category_id'];

                    $sql_product = "SELECT * FROM tbl_products WHERE category_id = $category_id ";
                    $result_product = mysqli_query($connection, $sql_product);
                    $db_data_product = mysqli_fetch_assoc($result_product);

                    $product_id = $db_data_product['product_id'];
                    ?>

                    <div class="card-wrapper">
                        <div class="card">
                            <a href="productdetail.php?product_id=<?php echo $product_id; ?>"><img
                                    src="../../images/<?php echo $db_data_product['product_image']; ?>" alt=""></a>
                            <div>
                                <div class="product-image">
                                    <a href="productdetail.php?product_id=<?php echo $product_id; ?>" alt="product-image"></a>
                                </div>
                                <div class="btn">
                                    <form action="#" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                        <button type="submit" name="buy_now"><i class="fa-solid fa-bag-shopping"
                                                id="cart-button"></i></button>
                                    </form>

                                    <div class="modal-button">
                                        <form action="#" method="post">
                                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                            <button type="submit" name="add_to_cart" id="modal-button"><i
                                                    class="fa-solid fa-cart-plus"></i></button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="pro_info">
                            <p>MENS</p>
                            <h2>
                                <?php echo $db_data_product['product_name']; ?>
                            </h2>
                            <h2>
                                <?php echo $db_data_product['product_price']; ?>
                            </h2>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>


        </div>
    </div>
    <div class="pagination">
        <a href="#" class="page-link"><i class="fa-solid fa-angle-left"></i> Prev</a>
        <a href="#" class="page-link active">1</a>
        <a href="#" class="page-link">2</a>
        <a href="#" class="page-link">3</a>
        <a href="#" class="page-link">4</a>
        <a href="#" class="page-link">5</a>
        <a href="#" class="page-link">Next <i class="fa-solid fa-angle-right"></i></a>
    </div>
    <footer>
        <div class="main-div">
            <div class="footer-container">
                <div class="footer-left">
                    <div class="logo">
                        <i class="fa-brands fa-opencart"></i>
                        <h1 id="logo-text">Mandu Cart <span id="last-word">.</span> </h1>
                    </div>
                    <p>Tinkune, Kathmandu</p>
                </div>
                <div class="footer-center">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="mens.php">Men's</a></li>
                        <li><a href="womens.php">Women's</a></li>
                        <li><a href="shop.php">Shop</a></li>
                    </ul>
                </div>
                <div class="footer-center">
                    <ul>
                        <li><a href="aboutus.php" target="">About Us</a></li>
                        <li><a href="#" target="_blank">Terms & Conditions</a></li>
                        <li><a href="#" target="_blank">Customer Service</a></li>
                    </ul>
                </div>
                <div class="footer-right">
                    <ul>
                        <h3>Connect with us</h3>
                        <i class="fa-brands fa-facebook"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-square-x-twitter"></i>
                        <i class="fa-brands fa-youtube"></i>

                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>Copyright &copy; 2023 | Mandu Cart | This is Assignment Work</p>
            </div>
        </div>
    </footer>

    <script src="../../assets/script.js"></script>
    <script src="https://kit.fontawesome.com/acc534193e.js" crossorigin="anonymous"></script>
</body>

</html>