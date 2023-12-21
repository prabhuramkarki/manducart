<?php
session_start();
include("db_connection.php");

$i = 0;

$result_search_product = false;
$result_search_category = false;

$filter_by_price_min = isset($_POST['filter_by_price_min']) ? $_POST['filter_by_price_min'] : 1;
$filter_by_price_max = isset($_POST['filter_by_price_max']) ? $_POST['filter_by_price_max'] : 9999999999;

// echo "The min value is $filter_by_price_min and The max price is $filter_by_price_max";
if (isset($_GET['search'])) {
    $from_search = $_GET['search'];
    $sql_search_product = "SELECT * FROM tbl_products WHERE CONCAT(product_name, product_details) LIKE '%$from_search%'";
    $result_search_product = mysqli_query($connection, $sql_search_product);
}

if (isset($_POST['price'])) {
    $from_search = $_GET['search'];
    $sql_search_product = "SELECT * FROM tbl_products WHERE CONCAT(product_name, product_details) LIKE '%$from_search%' AND product_price BETWEEN $filter_by_price_min AND $filter_by_price_max";
    $result_search_product = mysqli_query($connection, $sql_search_product);
}



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
                echo '<script>alert("Product Added to Cart")</script>';
            }
        }
    } else {
        $page = "search.php";
        $_SESSION["product_id"] = $_GET['product_id'];
        header("location: login.php?page=$page");
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
        $_SESSION["product_id"] = $_GET['product_id'];
        $page = "search.php";
        header("location:login.php?page=$page");
    }
}

if (isset($_POST['wishlist'])) {
    if (isset($_SESSION['logged_in'])) {
        $product_id = $_POST['product_id'];
        $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : '';

        $query = "SELECT * FROM tbl_wishlists WHERE product_id='$product_id' AND customer_id ='$customer_id'";
        $data = mysqli_query($connection, $query);

        if (mysqli_num_rows($data) >= 1) {
            echo '<script>alert("Product is Already in Wishlist")</script>';
        } else {
            $sql_insert = "INSERT INTO tbl_wishlists (customer_id,product_id) VALUES ('$customer_id','$product_id')";
            $result_insert = mysqli_query($connection, $sql_insert);

            if($result_insert){
                echo "<script>alert('Product added to Wishlist')</script>";
            }
        }

    } else {
        $_SESSION["product_id"] = $_POST['product_id'];
        header("location:login.php?page=$page");
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search</title>
    <link rel="stylesheet" href="../../assets/search.css" />
    <script src="../../assets/jquery-3.7.1.min.js"></script>
</head>

<body>
    <?php
    include("nav.php");
    ?>
    <div class="text">
        <h3>Search Clothes from ManduCart</h3>
    </div>
    <div class="wrapper">

        <form action="" method="get" class="search-bar">
            <div class="input-group">
                <input type="text" name="search" placeholder="Search..." value="<?php if (isset($_GET['search'])) {
                    echo $_GET['search'];
                } ?>" class="form-control" placeholder="Search data">
                <button type="submit" class="fa-solid fa-magnifying-glass"></button>
            </div>

        </form>

    </div>

    <div class="container-search">
        <?php if ($result_search_product): ?>
            <div class="sidebar">
                <div class="sidebar-left">
                    <form action="#" method="post">
                        <div class="filter">
                            <h3>Filter By Price </h3>
                            <label for="">Lowest Price</label>
                            <input type="number" value="1" name="min_value" id="quantity1" min="1">
                            <input type="hidden" name="filter_by_price_min" id="filter_by_price_min" value="1">
                            <label for="">Highest Price</label>
                            <input type="number" value="1" name="max_value" id="quantity2" min="1">
            
                            <input type="hidden" name="filter_by_price_max" id="filter_by_price_max" value="1">
                            <button id="filter-btn" type="submit" method="post" name="price"><i class="fa-solid fa-filter"></i> Filter</button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="body">




                <?php while ($db_data_product = mysqli_fetch_assoc($result_search_product)):
                    $product_id = $db_data_product['product_id'];
                    $category_id = $db_data_product['category_id'];

                    $sql_search_category = "SELECT * FROM tbl_categories WHERE category_id = $category_id ";
                    $result_search_category = mysqli_query($connection, $sql_search_category);
                    $db_data_category = mysqli_fetch_assoc($result_search_category);



                    ?>

                    <div class="card-wrapper">
                        <div class="card">
                            <a href="productdetail.php?product_id=<?php echo $product_id; ?>"><img
                                    src="../../images/<?php echo $db_data_product['product_image']; ?>" alt=""></a>
                            <div>
                                <div class="product-image">
                                    <a href="productdetail.php?product_id=<?php echo $product_id; ?>" alt="product-image"></a>
                                </div>

                                <div class="wishlist-btn">
                                    <form action="#" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                        <button type="submit" name="wishlist"><i class="fa-regular fa-heart"></i></button>
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
                                <p style="text-transform: uppercase;">CATEGORY: MENS</p>
                                <br>
                                <p style="text-transform:uppercase">
                                    SIZE:
                                    <?php echo $db_data_category['product_size']; ?>
                                </p>
                            </div>

                            <h2>
                                <?php echo $db_data_product['product_name']; ?>
                            </h2>
                            <h2 style="color: red;">
                                Rs.
                                <?php echo $db_data_product['product_price']; ?>
                            </h2>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php include("footer.php") ?>
    <script>
        jQuery("#quantity1").on("change", function () {
            $.ajax({
                url: "http://localhost/finalexp/pages/public/quantity.php",
                type: "POST",
                data: {
                    id: quantity1.value
                },
                dataType: "TEXT",
                success: function (resp) {
                    $("#filter_by_price_min").val(resp);

                }
            }).done(function () {
                console.log($("#filter_by_price_min").val());

            });
        })
    </script>
    <script>
        jQuery("#quantity2").on("change", function () {
            $.ajax({
                url: "http://localhost/finalexp/pages/public/quantity.php",
                type: "POST",
                data: {
                    id: quantity2.value
                },
                dataType: "TEXT",
                success: function (resp) {
                    $("#filter_by_price_max").val(resp);
                }
            }).done(function () {
                console.log($("#filter_by_price_max").val());
            });
        })
    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>