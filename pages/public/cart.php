<?php
session_start();
include "db_connection.php";
$page = 'cart.php';


//To display the alert for product deleted in cart page.
$delete_product_from_cart = isset($_SESSION['delete_product_from_cart']) ? $_SESSION['delete_product_from_cart'] : false;

if ($delete_product_from_cart) {
  echo "<script>alert('Product Removed Sucessfully')</script>";
  unset($_SESSION['delete_product_from_cart']);
}



if (!$_SESSION['logged_in']) {

  header("location: login.php?page=$page");

} else {
  $page = 'cart.php';
  $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : header("location: login.php?page=$page");
  $select_sql = "SELECT * FROM tbl_carts WHERE customer_id=$customer_id";
  $select_res = mysqli_query($connection, $select_sql);


  if (!$select_res) {
    echo "query not send";
  }


  if (isset($_POST['checkout'])) {

    if (mysqli_num_rows($select_res) >= 1) {
      $product_ids = isset($_POST['product_ids']) ? $_POST['product_ids'] : false;

      if ($product_ids) {
        $quantity = isset($_POST['updated_cart_qty']) ? $_POST['updated_cart_qty'] : 1;
        $select_sql1 = " UPDATE tbl_carts SET quantity = $quantity WHERE product_id=$product_ids AND customer_id=$customer_id";

        $select_res1 = mysqli_query($connection, $select_sql1);

        if (!$select_res1) {
          echo "query not send";
        }
        $form_page = "cart";
        header("location:checkout.php?product_id=$product_ids&form_page=$form_page");
      } else {
        echo '<script>alert("Select a product to buy")</script>';
      }



    } else {
      echo '<script>alert("No products to buy")</script>';
    }
  }

  if (isset($_POST['cont_shopping'])) {

    header("location: index.php");

  }


}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cart</title>
  <link rel="stylesheet" href="../../assets/cart.css" />
  <script src="../../assets/jquery-3.7.1.min.js"></script>
</head>

<body>
  <?php include "nav.php"; ?>
  <div class="cart-container">
    <div id="cart-items">
      <form action="#" method="post">
        <table>
          <thead>
            <tr>
              <td>Select</td>
              <td>Image</td>
              <td>Products</td>
              <td>Price</td>
              <td>Quantity</td>
              <td>Total</td>
              <td>Remove</td>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0;
            while ($db_data = mysqli_fetch_assoc($select_res)): ?>
              <?php
              $product_id = $db_data['product_id'];
              $select_sql2 = "SELECT * FROM tbl_products WHERE product_id =$product_id";
              $select_res2 = mysqli_query($connection, $select_sql2);
              $db_data_prod = mysqli_fetch_assoc($select_res2) ?>
              <tr>
                <td style="width: 20px;"><input type="checkbox" value="<?php echo $product_id ?>" name="product_ids"></td>
                <td> <img src="../../images/<?php echo $db_data_prod['product_image']; ?>" alt="product image"
                    style="width:50px; height: 100%; border-radius: 3px;"></td>
                <td>
                  <?php echo $db_data_prod['product_name']; ?>
                </td>
                <td>
                  <?php echo $db_data_prod['product_price']; ?>
                </td>
                <td>


                  <input type="number" value="<?php echo $db_data['quantity']; ?>" name="product_quantity"
                    id="quantity<?php echo $i; ?>" min="1">

                </td>

                <?php
                $quantity = $db_data['quantity'];
                $price = $db_data_prod['product_price'];
                $total_price = $price * $quantity;

                ?>
                <td>
                  <?php echo $total_price ?>
                </td>
                <td> <a href="cartdelete.php?product_id=<?php echo $product_id; ?>"><i class="fa-solid fa-trash"></i></a>
                </td>

              </tr>

              <script>
                jQuery("[id*='quantity']").on("change", function () {
                  // console.log(jQuery(this)[0].value)
                  $.ajax({
                    url: "http://localhost/finalexp/pages/public/quantity.php",
                    type: "POST",
                    data: { id: jQuery(this)[<?php echo $i; ?>].value },
                    dataType: "TEXT",
                    success: function (resp) {
                      // console.log(resp)
                      $("#updated_cart_qty").val(resp);
                    }
                  }).done(function () {
                    //console.log($("#updated_cart_qty").val());
                  });
                })
              </script>

              <?php $i++; endwhile; ?>


          </tbody>
    </div>
    </table>


    <div class="btns-2">
      <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
      <input type="hidden" name="updated_cart_qty" id="updated_cart_qty" value="1">
      <button type="submit" class="checkout-btn" name="checkout">Proceed to Checkout</button>

      <button type="submit" class="cont_shopping" name="cont_shopping">Continue Shopping</button>
      </form>
    </div>
  </div>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

</html>