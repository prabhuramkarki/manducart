<?php
session_start();
include "db_connection.php";

$sql_select = "SELECT * FROM tbl_products ORDER BY RAND()";
$result = mysqli_query($connection, $sql_select);


// to display last added image featured products for mens 
$sql_selc_mens = "SELECT * FROM tbl_categories  WHERE product_category = 'Mens' ORDER BY product_category DESC";
$result_selc_mens = mysqli_query($connection, $sql_selc_mens);
$db_data_mens = mysqli_fetch_assoc($result_selc_mens);
$category_id_mens = $db_data_mens['category_id'];
$sql_selc_product_mens = "SELECT * FROM tbl_products  WHERE category_id = $category_id_mens";
$result_selc_product_mens = mysqli_query($connection, $sql_selc_product_mens);
$db_data_product_mens = mysqli_fetch_assoc($result_selc_product_mens);
$product_id_mens = $db_data_product_mens['product_id'];


// to display last added image featured products for womens 
$sql_selc_womens = "SELECT * FROM tbl_categories  WHERE product_category = 'Womens' ORDER BY product_category DESC";
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
    header("location: login.php? page = '$page'");
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

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mandu Cart Home Page</title>
  <link rel="stylesheet" href="../../assets/style.css" />
  <link rel="stylesheet" href="../../assets/footer.css" />

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

  <div class="carasouel">
    <ul class="gallery">
      <li><img src="../../images/image3.jpg" alt=""></li>
      <li><img src="../../images/image4.jpg" alt=""></li>
      <li><img src="../../images/image5.jpg" alt=""></li>
      <li><img src="../../images/image6.jpg" alt=""></li>
      <li><img src="../../images/image7.jpg" alt=""></li>
    </ul>
    <div class="gallrey-text">
      <p>MENS | WOMENS</p>
      <h1>New Arrival</h1>
      <a href="shop.php">
        <p
          style="background-color: red; padding: 10px; width: 108px; color: white; border-radius: 7px; margin: 20px; font-size: 15px;">
          Order Now</p>
      </a>
    </div>
  </div>
  <div class="feature-text">
    <h1>Featured Products</h1>
  </div>
  <div class="main-container-div">
    <div class="products">
      <div class="items">
        <h5
          style="position: absolute; color: white; background-color: #84a59d; margin: 10px; padding: 10px; border-radius: 2px;">
          Men</h5>
        <img src="../../images/<?php echo $db_data_product_mens['product_image']; ?>" alt="">
        <div class="layer">
          <form action="#" method="post" id="see-more">
            <button class="see-more-btn" name="see_more_mens">See More</button>
          </form>
        </div>
      </div>
      <div class="items">
        <h5
          style="position: absolute; color: white; background-color: #84a59d; margin: 10px; padding: 10px; border-radius: 2px;">
          Women</h5>
        <img src="../../images/<?php echo $db_data_product_womens['product_image']; ?>" alt="">
        <div class="layer">
          <form action="#" method="post" id="see-more">
            <button class="see-more-btn" name="see_more_womens">See More</button>
          </form>


        </div>
      </div>
      <div class="items">
        <h5
          style="position: absolute; color: white; background-color: #84a59d; margin: 10px; padding: 10px; border-radius: 2px;">
          Unisex</h5>
        <img src="../../images/<?php echo $db_data_product_shop['product_image']; ?>" alt="">
        <div class="layer">
          <form action="#" method="post" id="see-more">
            <button class="see-more-btn" name="see_more_unisex">See More</button>
          </form>


        </div>
      </div>
      <div class="items">
        <h5
          style="position: absolute; color: white; background-color: #84a59d; margin: 10px; padding: 10px; border-radius: 2px;">
          New Arrival</h5>
        <img src="../../images/<?php echo $db_data_product_new_arrival['product_image']; ?>" alt="">
        <div class="layer">
          <form action="#" method="post" id="see-more">
            <button class="see-more-btn" name="see_more_new_arrival">See More</button>
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
                  <a href="productdetail.html" style="width:100%; height: 100%;" alt="product-image"></a>
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
              <p>
                <?php echo $db_data_category['product_category']; ?>
              </p>
              <h2>
                <?php echo $db_data['product_name']; ?>
              </h2>
              <h2>
                Rs.
                <?php echo $db_data['product_price']; ?>
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
            <li><a href="#">Home</a></li>
            <li><a href="mens.php">Men's</a></li>
            <li><a href="womens.php">Women's</a></li>
            <li><a href="shop.php">Shop</a></li>
          </ul>
        </div>
        <div class="footer-center">
          <ul>
            <li><a href="aboutus.php" target="_blank">About Us</a></li>
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

  <script>
    const slider = document.querySelector('.gallery');
    let isDown = false;
    let startX;
    let scrollLeft;
    let autoScrollInterval;

    slider.addEventListener('mousedown', e => {
      isDown = true;
      slider.classList.add('active');
      startX = e.pageX - slider.offsetLeft;
      scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
      isDown = false;
      slider.classList.remove('active');
    });

    slider.addEventListener('mouseup', () => {
      isDown = false;
      slider.classList.remove('active');
    });

    slider.addEventListener('mousemove', e => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - slider.offsetLeft;
      const SCROLL_SPEED = 3;
      const walk = (x - startX) * SCROLL_SPEED;
      slider.scrollLeft = scrollLeft - walk;
    });

    function startAutoScroll() {
      autoScrollInterval = requestAnimationFrame(scroll);
    }

    function scroll() {
      const SCROLL_AMOUNT = 2;
      slider.scrollLeft += SCROLL_AMOUNT;
      requestAnimationFrame(scroll);
    }

    function stopAutoScroll() {
      cancelAnimationFrame(autoScrollInterval);
    }
    startAutoScroll();

    slider.addEventListener('mouseenter', stopAutoScroll);

    slider.addEventListener('mouseleave', startAutoScroll);
  </script>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script src="../../assets/script.js"></script>
  <script src="https://kit.fontawesome.com/acc534193e.js" crossorigin="anonymous"></script>
</body>

</html>