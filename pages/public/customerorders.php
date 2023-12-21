<?php
session_start();
include "db_connection.php";


$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : header("location: login.php");
$delete_message = isset($_SESSION['delete_message']) ? $_SESSION['delete_message'] : false;
if ($delete_message) {
  echo "<script>alert('Order deleted Sucessfully')</script>";
  unset($_SESSION['delete_message']);
  header("location:customerorders.php");
}


//getting the order id of orders related to the customer id 
$select_sql = "SELECT * FROM tbl_orders WHERE customer_id=$customer_id";
$select_res = mysqli_query($connection, $select_sql)

  ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customer Orders</title>
  <link rel="stylesheet" href="../../assets/customerdashboard.css" />

</head>

<body>
  <?php include "nav.php"; ?>

  <form action="customerdashboard.php" method="post">
    <button type="submit"> <i class="fa-solid fa-angle-left"></i> Back</button>
  </form>
  <div id="table-wrapper">
    <table id="table">
      <div class="table-head">
        <tr id="table-titles">
          <td>SN</td>
          <td>Image</td>
          <td>Products</td>
          <td>Price</td>
          <td>Quantity</td>
          <td>Total</td>
          <td>Delete order</td>
        </tr>
      </div>
      <tbody>
        <?php $counter = 0; ?>
        <?php while ($db_data = mysqli_fetch_assoc($select_res)):

          $order_id = $db_data['id'];
          //using the order id to get product id 
          $select_sql_order = "SELECT * FROM tbl_order_details WHERE order_id = $order_id";
          $select_res_order = mysqli_query($connection, $select_sql_order);
          $db_data_order = mysqli_fetch_assoc($select_res_order);

          $product_id = $db_data_order['product_id'];

          $select_res_product = "SELECT * FROM tbl_products WHERE product_id = $product_id";
          $select_res_product = mysqli_query($connection, $select_res_product);
          $db_data_product = mysqli_fetch_assoc($select_res_product);
          ?>
          <tr>
            <td>
              <?php echo ++$counter; ?>
            </td>
            <td> <img src="../../images/<?php echo $db_data_product['product_image']; ?>" alt=""
                style="width:50px; height: 100%;">
            </td>
            <td>
              <?php echo $db_data_product['product_name']; ?>
            </td>
            <td>
              <?php echo $db_data_product['product_price']; ?>
            </td>
            <td>

              <?php echo $db_data_order['order_quantity']; ?>
            </td>

            <?php
            $quantity = $db_data_order['order_quantity'];
            $price = $db_data_product['product_price'];
            $total_price = $price * $quantity;

            ?>
            <td>
              <?php echo $total_price ?>
            </td>
            <td> <a href="ordersdelete.php?order_id=<?php echo $order_id; ?>"><i class="fa-solid fa-trash"></i></a></td>


          </tr>


        <?php endwhile; ?>



      </tbody>
  </div>
  </table>

  </div>


  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

</html>