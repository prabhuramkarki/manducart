<?php
session_start();
include "db_connection.php";

$sql_select = "SELECT * FROM tbl_products ORDER BY RAND() LIMIT 0, 4";
$result = mysqli_query($connection, $sql_select);


// to display last added image featured products for mens 
$sql_selc_mens = "SELECT * FROM tbl_categories  WHERE product_category = 'Mens' ORDER BY RAND()";
$result_selc_mens = mysqli_query($connection, $sql_selc_mens);
$db_data_mens = mysqli_fetch_assoc($result_selc_mens);
$category_id_mens = $db_data_mens['category_id'];
$sql_selc_product_mens = "SELECT * FROM tbl_products  WHERE category_id = $category_id_mens";
$result_selc_product_mens = mysqli_query($connection, $sql_selc_product_mens);
$db_data_product_mens = mysqli_fetch_assoc($result_selc_product_mens);
$product_id_mens = $db_data_product_mens['product_id'];


// to display last added image featured products for womens 
$sql_selc_womens = "SELECT * FROM tbl_categories  WHERE product_category = 'Womens' ORDER BY RAND()";
$result_selc_womens = mysqli_query($connection, $sql_selc_womens);
$db_data_womens = mysqli_fetch_assoc($result_selc_womens);
$category_id_womens = $db_data_womens['category_id'];
$sql_selc_product_womens = "SELECT * FROM tbl_products  WHERE category_id = $category_id_womens";
$result_selc_product_womens = mysqli_query($connection, $sql_selc_product_womens);
$db_data_product_womens = mysqli_fetch_assoc($result_selc_product_womens);
$product_id_womens = $db_data_product_womens['product_id'];



// to display last added image featured products for unisex 
$sql_selc_product_shop = "SELECT * FROM tbl_products ORDER BY RAND()";
$result_selc_product_shop = mysqli_query($connection, $sql_selc_product_shop);
$db_data_product_shop = mysqli_fetch_assoc($result_selc_product_shop);
$product_id_shop = $db_data_product_shop['product_id'];

// to display last added image featured products for new arrival
$sql_selc_product_new_arrival = "SELECT * FROM tbl_products ORDER BY  product_id DESC";
$result_selc_product_new_arrival = mysqli_query($connection, $sql_selc_product_new_arrival);
$db_data_product_new_arrival = mysqli_fetch_assoc($result_selc_product_new_arrival);
$product_id_new_arrival = $db_data_product_new_arrival['product_id'];



if (isset($_POST['see_more_mens'])) {
  header("location:mens.php");

}
if (isset($_POST['see_more_womens'])) {
  header("location:womens.php");

}
if (isset($_POST['see_more_unisex'])) {
  header("location:shop.php");

}
if (isset($_POST['see_more_new_arrival'])) {
  header("location:newarrivals.php");

}

//  for view products to add cart
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
    $page = "index.php";
    $_SESSION["product_id"] = $_GET['product_id'];
    header("location: login.php? page = $page");
  }
}

//  for view products to buy now
if (isset($_POST['buy_now'])) {
  if (isset($_SESSION['logged_in'])) {
    $product_id = $_POST['product_id'];
    $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : '';
    $product_quantity_buy = 1;

    $form_page = "buy";

    header("location:checkout.php?product_id=$product_id&customer_id=$customer_id&quantity=$product_quantity_buy&form_page=$form_page");

  } else {
    $_SESSION["product_id"] = $_POST['product_id'];
    $page = "index.php";
    header("location:login.php?page =$page");
  }
}

//for products to be added in wishlist

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

      if ($result_insert) {
        echo "<script>alert('Product added to Wishlist')</script>";
      }
    }

  } else {
    $page = "index.php";
    $_SESSION["product_id"] = $_POST['product_id'];
    header("location:login.php?page=$page");
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mandu Cart Home Page</title>
  <link rel="stylesheet" href="../../assets/style.css" />
  <link rel="stylesheet" href="../../assets/footer.css" />
  <link rel="stylesheet" href="../../assets/icons/css/all.css">

  <script src="../../assets/script.js"></script>


</head>

<body>
  <?php include("nav.php") ?>
  <?php include("cara.php") ?>
  <div class="feature-text">
    <h1>Featured Products</h1>
  </div>
  <div class="main-container-div">
    <div class="products">
      <div class="items">
        <h5
          style="position: absolute; color: white;  margin: 10px; padding: 10px; border-radius: 2px;
            background: linear-gradient(to right, #2980b9, #2ecc71);
          ">
          Men's</h5>
        <img src="../../images/<?php echo $db_data_product_mens['product_image']; ?>" alt="">
        <div class="layer">
          <form action="#" method="post" id="see-more">
            <button class="see-more-btn" name="see_more_mens"> <i class="fa-solid fa-circle-chevron-down"></i> See
              More</button>
          </form>
        </div>
      </div>
      <div class="items">
        <h5
          style="position: absolute; color: white; background-color: #84a59d; margin: 10px; padding: 10px; border-radius: 2px;
           background: linear-gradient(to right, #2980b9, #2ecc71);">
          Women's</h5>
        <img src="../../images/<?php echo $db_data_product_womens['product_image']; ?>" alt="">
        <div class="layer">
          <form action="#" method="post" id="see-more">
            <button class="see-more-btn" name="see_more_womens"> <i class="fa-solid fa-circle-chevron-down"></i> See
              More</button>
          </form>


        </div>
      </div>
      <div class="items">
        <h5
          style="position: absolute; color: white; background-color: #84a59d; margin: 10px; padding: 10px; border-radius: 2px;  background: linear-gradient(to right, #2980b9, #2ecc71);">
          Unisex</h5>
        <img src="../../images/<?php echo $db_data_product_shop['product_image']; ?>" alt="">
        <div class="layer">
          <form action="#" method="post" id="see-more">
            <button class="see-more-btn" name="see_more_unisex"> <i class="fa-solid fa-circle-chevron-down"></i> See
              More</button>
          </form>


        </div>
      </div>
      <div class="items">
        <h5
          style="position: absolute; color: white; background-color: #84a59d; margin: 10px; padding: 10px; border-radius: 2px;  background: linear-gradient(to right, #2980b9, #2ecc71);">
          New Arrival</h5>
        <img src="../../images/<?php echo $db_data_product_new_arrival['product_image']; ?>" alt="">
        <div class="layer">
          <form action="#" method="post" id="see-more">
            <button class="see-more-btn" name="see_more_new_arrival"> <i class="fa-solid fa-circle-chevron-down"></i>
              See More</button>
          </form>


        </div>
      </div>
    </div>
  </div>
  <div class="feature-text">
    <h1>View More Products</h1>
  </div>

  <div class="main_container">
    <div class="product-container">


      <?php if ($result): ?>
        <?php while ($db_data = mysqli_fetch_assoc($result)):
          $product_id = $db_data['product_id'];
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
                  <a href="#" style="width:100%; height: 100%;" alt="product-image"></a>
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
                    <button type="submit" name="buy_now"><i class="fa-solid fa-bag-shopping" id="cart-button"></i></button>
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
  <div id="more-prod-btn-div">
    <form action="shop.php" method="post">
      <button id="more-prod-btn">
        See More
      </button>
    </form>
  </div>
  <div class="bottom-carasouel">
    <div class="bottom-cara-text">
      <p>New Arrival's <span style="color: red; font: 800;">50% Off</span></p>
      <h2>Men's & Women's <span style="color: rgb(4, 151, 210)">Collection</span></h2>
      <a href="shop.php">
        <p
          style="background-color: red; padding: 10px; width: 108px; color: white; border-radius: 7px; margin-top: 10px; font-size: 15px;">
          Order Now</p>
      </a>
    </div>
  </div>

  <?php include("footer.php") ?>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

</html>