<?php
session_start();
include("db_connection.php");

$page = 'wishlist.php';
if (!$_SESSION['logged_in']) {
    header("location: login.php?page=$page");
}

$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : '';

$start = 0;
$per_page = 12;

$sql_selec_pagination = "SELECT * FROM tbl_wishlists WHERE customer_id = $customer_id";
$result_selec_pagination = mysqli_query($connection, $sql_selec_pagination);
$nr_of_rows = $result_selec_pagination->num_rows;
$pages = ceil($nr_of_rows / $per_page);

$current_page = isset($_GET['page-nr']) ? $_GET['page-nr'] : 1;

if (isset($_GET['page-nr'])) {   
    $page = $current_page - 1;
    $start = $page * $per_page;
}


$sql = "SELECT * FROM tbl_wishlists WHERE customer_id=$customer_id ORDER BY id DESC LIMIT $start, $per_page";
$result = mysqli_query($connection, $sql);


if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $query = "SELECT * FROM tbl_carts WHERE product_id=$product_id AND customer_id =$customer_id";
    $data = mysqli_query($connection, $query);

    if (mysqli_num_rows($data) >= 1) {
        echo '<script>alert("Product Already Added")</script>';
    } else {
        $product_quantity = 1;
        $sql1 = "INSERT INTO tbl_carts (product_id,customer_id, quantity) VALUES('$product_id','$customer_id','$product_quantity')";
        $result1 = mysqli_query($connection, $sql1);

        if ($result1) {
            echo '<script>alert("Product Added to Cart")</script>';
        }
    }
}

if (isset($_POST['buy_now'])) { 
    $product_id = $_POST['product_id'];
    $product_quantity_buy = 1;

    $form_page = "buy";

    header("location:checkout.php?product_id=$product_id&customer_id=$customer_id&quantity=$product_quantity_buy&form_page=$form_page");
}

if (isset($_POST['wishlist'])) {
    $product_id = $_POST['product_id'];
    $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : '';

    $sql = "DELETE FROM tbl_wishlists WHERE product_id=$product_id AND customer_id=$customer_id";

    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo "<script>alert('Product Removed from Wishlist')</script>";
        header("location: wishlist.php");
    } 

   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="../../assets/style.css">
    <link rel="stylesheet" href="../../assets/footer.css">
</head>

<body>
    <?php include("nav.php")?>

    <div class="main_container">
        <div class="product-container">
            <?php if ($result):
                $counter = 0;
                ?>
                <?php while ($db_data_wishlist = mysqli_fetch_assoc($result)):
                    $product_id = $db_data_wishlist['product_id'];
                    
                    $sql_product = "SELECT * FROM tbl_products WHERE product_id=$product_id";
                    $result_product = mysqli_query($connection, $sql_product);
                    $db_data = mysqli_fetch_assoc($result_product);
                    $category_id = $db_data['category_id'];

                    $sql_category = "SELECT * FROM tbl_categories WHERE category_id = $category_id";
                    $result_category = mysqli_query($connection, $sql_category);
                    $db_data_category = mysqli_fetch_assoc($result_category);
                    ?>

                    <div class="card-wrapper">
                        <div class="card">
                            <a href="productdetail.php?product_id=<?php echo $product_id; ?>"><img
                                    src="../../images/<?php echo $db_data['product_image']; ?>" alt=""></a>
                            <div>
                                <div class="product-image">
                                    <a href="productdetail.php?product_id=<?php echo $product_id; ?>" alt="product-image"></a>
                                </div>
                                <div class="wishlist-btn">
                                    <form action="#" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                        <button type="submit" name="wishlist"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                                <div class="btn">
                                    <form action="#" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                        <button type="submit" name="buy_now"><i class="fa-solid fa-bag-shopping"
                                                id="cart-button"></i></button>
                                    </form>


                                    <form action="#" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                        <button type="submit" name="add_to_cart"><i class="fa-solid fa-cart-plus"></i></button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="pro_info">
              <div class="pro_cata_size">
                <p style="text-transform: uppercase;">

                  CATEGORY:
                  <?php echo $db_data_category['product_category']; ?>
                </p>
                <br>
                <p style="text-transform:uppercase">
                  SIZE:
                  <?php echo $db_data_category['product_size']; ?>
                </p>
              </div>

              <h2>
                <?php echo $db_data['product_name']; ?>
              </h2>
              <h2 style="color: red;">
                Rs.
                <?php echo $db_data['product_price']; ?>
              </h2>
            </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>


        </div>
    </div>

    <!-- for pagination  -->
    <div class="pagination">
        <?php
        if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {

            ?>
            <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>" class="page-link"><i
                    class="fa-solid fa-angles-left"></i></a>
            <?php
        } else {
            ?>
            <a href="" class="page-link"><i class="fa-solid fa-angles-left"></i></a>
            <?php
        }
        ?>

        <?php
        for ($counter = 1; $counter <= $pages; $counter++) {
            $class = '';
            if ($current_page == $counter) {
                $class = 'active';
            }
            ?>
            <a href="?page-nr=<?php echo $counter ?> " class="page-link <?php echo $class ?>">
                <?php echo $counter ?>
            </a>

            <?php
        }

        ?>



        <?php
        if (!isset($_GET['page-nr'])) {
            ?>
            <a href="?page-nr=2" class="page-link"><i class="fa-solid fa-angles-right"></i></a>
            <?php
        } else {
            if ($_GET['page-nr'] >= $pages) {
                ?>
                <a class="page-link"><i class="fa-solid fa-angles-right"></i></a>
                <?php
            } else {
                ?>
                <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>" class="page-link"><i
                        class="fa-solid fa-angles-right"></i></a>
                <?php
            }

        }

        ?>
    </div>
   <?php include("footer.php")?>
</body>

</html>