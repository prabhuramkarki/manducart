<?php
$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : 0;
if ($customer_id > 0) {
  $sql_select_cart = "SELECT * FROM tbl_carts WHERE customer_id=$customer_id";
  $result_select_cart = mysqli_query($connection, $sql_select_cart);
  $no_of_product_in_cart = mysqli_num_rows($result_select_cart);
} else {
  $no_of_product_in_cart = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nav</title>
  <link rel="stylesheet" href="../../assets/style.css">
  <link rel="stylesheet" href="../../assets/css/all.min.css">
  <link rel="stylesheet" href="../../assets/icons/css/all.css">


</head>

<body>
  <nav>
    <div class="nav">
      <div class="logo">
        <i class="fa-brands fa-opencart"></i>
        <a href="index.php" id="logo-link">
          <h1 id="logo-text">Mandu Cart <span id="last-word">.</span> </h1>
        </a>
      </div>

      <div class="nav-links" id="nav-links">
        <li type="none">
          <a href="index.php" class="link">Home</a>
        </li>
        <li type="none">
          <a href="mens.php" class="link">Men's</a>
        </li>
        <li type="none">
          <a href="womens.php" class="link">Women's</a>
        </li>
        <li type="none">
          <a href="shop.php" class="link">Shop</a>
        </li>
        <li type="none">
          <a href="contact.php" class="link">Contact</a>
        </li>
      </div>

      <div class="icons">
        <a href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a>
        <a href="wishlist.php"> <i class="fa-solid fa-heart"></i></a>
        <a href="cart.php"><i class="fa-solid fa-cart-shopping" id="nav-cart-icon">
            <span id="cart-no">
              <?php echo "$no_of_product_in_cart"; ?>
            </span>
          </i>

        </a>
        <a href="customerdashboard.php"> <i class="fa-solid fa-user"></i></a>
      </div>
    </div>
  </nav>

  <script>
    const currentUrl = window.location.href;
    const links = document.querySelectorAll('.link');

    links.forEach(link => {
      if (link.href === currentUrl) {
        link.classList.add('active-link');
      }
    });
  </script>

</body>

</html>