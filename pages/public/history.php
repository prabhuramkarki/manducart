<?php
session_start();
include "db_connection.php";

$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : header("location: login.php");

$select_sql = "SELECT * FROM tbl_history WHERE customer_id=$customer_id ORDER BY id DESC";
$select_res = mysqli_query($connection, $select_sql);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>History</title>
  <link rel="stylesheet" href="../../assets/customerdashboard.css" />

</head>

<body>
  <?php include "nav.php" ?>
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
          <td>Status</td>
        </tr>
      </div>
      <tbody>
        <?php $counter = 0; ?>
        <?php while ($db_data1 = mysqli_fetch_assoc($select_res)):
          $product_id = $db_data1['product_id'];

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
              <?php echo $db_data1['status']; ?>
            </td>


          </tr>


        <?php endwhile; ?>



      </tbody>
    </table>

  </div>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

</html>