<?php
session_start();
include("db_connection.php");

$admin_id = $_SESSION['admin_id'];

if (isset($_POST['add_product'])) {
  $product_name = $_POST['product_name'];
  // $product_category = $_POST['product_category'];
  $product_details = $_POST['product_details'];
  $product_image1 = $_FILES['product_image1'];
  $product_image2 = $_FILES['product_image2'];
  $product_image3 = $_FILES['product_image3'];
  $product_image4 = $_FILES['product_image4'];

  $product_quantity = $_POST['product_quantity'];
  $product_price = $_POST['product_price'];


  $product_category = $_POST['product_category'];
  $product_color = $_POST['product_color'];
  $product_size = $_POST['product_size'];
  $rating = 0;


  $sql1 = "INSERT INTO tbl_categories (product_category, product_color, product_size,created_by) VALUES ('$product_category','$product_color', '$product_size', '$admin_id')";

  if ($connection->query($sql1) === TRUE) {
    $latest_id = $connection->insert_id;
  } else {
    echo "Error: " . $sql1 . "<br>" . $connection->error;
  }
  $sql_add_product = "INSERT INTO tbl_products (category_id, product_name, product_details,product_quantity,product_price,created_by,rating) VALUES('$latest_id','$product_name', '$product_details','$product_quantity','$product_price','$admin_id',$rating)";


  if ($connection->query($sql_add_product) === true) {
    $product_id = $connection->insert_id;
    echo '<script>alert("Product added Sucessfully")</script>';
  } else {
    // echo "Error: " . $sql1 . "<br>" . $connection->error;
    echo "Error: " . $sql2 . "<br>" . $connection->error;
  }

  if (isset($_FILES['product_image1'])) {
    $file = $_FILES['product_image1'];
    $photo = $file['name'];

    if ($file['error'] == 0) {
      if ($file['size'] < 300000) {
        $file_types = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
        $file_ext = in_array($file['type'], $file_types);
        if ($file_ext) {
          $target_dir = '../../images/';
          $filename = uniqid($file_ext);
          $org_fileext = explode(".", $photo);
          $photo_name1 = $filename . '.' . end($org_fileext); //move_uploaded_file(tem_name, fullpath_image)
          if (move_uploaded_file($file['tmp_name'], $target_dir . $photo_name1)) {
            $confirmation_msg = "File uploaded successfully.";
          } else {
            $confirmation_msg = "File upload failed.";
          }
        } else {
          $confirmation_msg = "This file is not supported.";
        }
      } else {
        $confirmation_msg = "File size must be less than 3MB.";
      }
    } else {
      $confirmation_msg = 'Please choose your file to upload.';
    }
    if (!isset($photo_name1)) {
      $photo_name1 = '';

      $sql_photo = "UPDATE tbl_products SET product_image='$photo_name1' WHERE product_id =$product_id";
      $connection->query($sql_photo);
    } else {
      $sql_photo = "UPDATE tbl_products SET product_image='$photo_name1' WHERE product_id =$product_id";
      $connection->query($sql_photo);
    }
  }

  // for 2nd image 
  if (isset($_FILES['product_image2'])) {
    $file = $_FILES['product_image2'];
    $photo = $file['name'];

    if ($file['error'] == 0) {
      if ($file['size'] < 300000) {
        $file_types = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
        $file_ext = in_array($file['type'], $file_types);
        if ($file_ext) {
          $target_dir = '../../images/';
          $filename = uniqid($file_ext);
          $org_fileext = explode(".", $photo);
          $photo_name2 = $filename . '.' . end($org_fileext); //move_uploaded_file(tem_name, fullpath_image)
          if (move_uploaded_file($file['tmp_name'], $target_dir . $photo_name2)) {
            $confirmation_msg = "File uploaded successfully.";
          } else {
            $confirmation_msg = "File upload failed.";
          }
        } else {
          $confirmation_msg = "This file is not supported.";
        }
      } else {
        $confirmation_msg = "File size must be less than 3MB.";
      }
    } else {
      $confirmation_msg = 'Please choose your file to upload.';
    }
    if (!isset($photo_name2)) {
      $photo_name2 = '';
      $sql_photo2 = "UPDATE tbl_products SET product_image2='$photo_name2' WHERE product_id =$product_id";
      $connection->query($sql_photo2);
    } else {
      $sql_photo2 = "UPDATE tbl_products SET product_image2='$photo_name2' WHERE product_id =$product_id";
      $connection->query($sql_photo2);
    }
  }

  // for 3rd image 
  if (isset($_FILES['product_image3'])) {
    $file = $_FILES['product_image3'];
    $photo = $file['name'];

    if ($file['error'] == 0) {
      if ($file['size'] < 300000) {
        $file_types = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
        $file_ext = in_array($file['type'], $file_types);
        if ($file_ext) {
          $target_dir = '../../images/';
          $filename = uniqid($file_ext);
          $org_fileext = explode(".", $photo);
          $photo_name3 = $filename . '.' . end($org_fileext); //move_uploaded_file(tem_name, fullpath_image)
          if (move_uploaded_file($file['tmp_name'], $target_dir . $photo_name3)) {
            $confirmation_msg = "File uploaded successfully.";
          } else {
            $confirmation_msg = "File upload failed.";
          }
        } else {
          $confirmation_msg = "This file is not supported.";
        }
      } else {
        $confirmation_msg = "File size must be less than 3MB.";
      }
    } else {
      $confirmation_msg = 'Please choose your file to upload.';
    }

    if (!isset($photo_name3)) {
      $photo_name3 = '';
      $sql_photo3 = "UPDATE tbl_products SET product_image3='$photo_name3' WHERE product_id =$product_id";
      $connection->query($sql_photo3);
    } else {
      $sql_photo3 = "UPDATE tbl_products SET product_image3='$photo_name3' WHERE product_id =$product_id";
      $connection->query($sql_photo3);
    }
  }

  // for 4th image 
  if (isset($_FILES['product_image4'])) {
    $file = $_FILES['product_image4'];
    $photo = $file['name'];

    if ($file['error'] == 0) {
      if ($file['size'] < 300000) {
        $file_types = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
        $file_ext = in_array($file['type'], $file_types);
        if ($file_ext) {
          $target_dir = '../../images/';
          $filename = uniqid($file_ext);
          $org_fileext = explode(".", $photo);
          $photo_name4 = $filename . '.' . end($org_fileext); //move_uploaded_file(tem_name, fullpath_image)
          if (move_uploaded_file($file['tmp_name'], $target_dir . $photo_name4)) {
            $confirmation_msg = "File uploaded successfully.";
          } else {
            $confirmation_msg = "File upload failed.";
          }
        } else {
          $confirmation_msg = "This file is not supported.";
        }
      } else {
        $confirmation_msg = "File size must be less than 3MB.";
      }
    } else {
      $confirmation_msg = 'Please choose your file to upload.';
    }
    if (!isset($photo_name4)) {
      $photo_name4 = '';
      $sql_photo4 = "UPDATE tbl_products SET product_image4='$photo_name4' WHERE product_id =$product_id";
      $connection->query($sql_photo4);
    } else {
      $sql_photo4 = "UPDATE tbl_products SET product_image4='$photo_name4' WHERE product_id =$product_id";
      $connection->query($sql_photo4);
    }
  }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Product</title>
  <link rel="stylesheet" href="../../assets/addproduct.css">

</head>

<body>
  <?php
  include("adminnav.php");
  ?>


  <form action="adminpanel.php" method="post">
    <button type="submit" name="back" id="back-btn"> <i class="fa-solid fa-angle-left"></i> Back</button>
  </form>
  
  <form action="#" method="post" enctype="multipart/form-data" validate>

    <div class="addprod-container">


      <div id="inner-container">

        <div class="left">

          <label for="product_name">Product Name</label>
          <input type="text" name="product_name" id="product_name" required>

          <label for="product_category">Product Category</label>
          <select name="product_category" id="product_category">
            <option value="Mens">Mens</option>
            <option value="Womens">Womens</option>
            <option value="Unisex">Unisex</option>
          </select>

          <label for="product_details">Product Details</label>
          <textarea type="text" name="product_details" id="product_details" rows="4" cols="200"></textarea>

          <label for="product_color">Available Colors</label>
          <select name="product_color" id="product_color">
            <option value="Black">Black</option>
            <option value="White">White</option>
            <option value="Blue">Blue</option>
            <option value="Green">Green</option>
            <option value="Blue">Orange</option>
            <option value="Blue">Purple</option>
            <option value="Blue">Brown</option>


          </select>
          <label for="product_size">Select Size</label>
          <select name="product_size" id="product_size">
            <option value="xs">XS</option>
            <option value="s">S</option>
            <option value="m">M</option>
            <option value="l">L</option>
            <option value="x">X</option>
            <option value="xl">XL</option>
            <option value="xxl">XXL</option>
            <option value="xxxl">XXXL</option>

          </select>
        </div>



        <div class="right">
          <label for="product_price">Price</label>
          <input type="number" name="product_price" id="product_price" required>

          <label for="quantity">Quantity</label>
          <input type="number" name="product_quantity" id="product_quantity" value="1" min="1" required>

          <label for="product_image">Choose Product Image</label>
          <input type="file" name="product_image1" id="product_image1" required>

          <label for="product_image">Product Image 2 (Optional) </label>
          <input type="file" name="product_image2">

          <label for="product_image">Product Image 3 (Optional) </label>
          <input type="file" name="product_image3">

          <label for="product_image">Product Image 4 (Optional)</label>
          <input type="file" name="product_image4">

        </div>

      </div>

      <div class="addprod-btn-div">
        <button type="submit" name="add_product" id="addprod-btn" onclick="validateForm()" >Add Product</button>
      </div>
      <br>
      <br>

    </div>


    <br>
    <br>


  </form>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script>
  function validateForm() {
    // Get form elements
    var productName = document.getElementById("product_name").value;
    var productCategory = document.getElementById("product_category").value;
    var productDetails = document.getElementById("product_details").value;
    var productColor = document.getElementById("product_color").value;
    var productSize = document.getElementById("product_size").value;
    var productPrice = document.getElementById("product_price").value;
    var productQuantity = document.getElementById("product_quantity").value;
    var productImage1 = document.getElementById("product_image1").value;


    if (productName === "" || productCategory === "" || productDetails === "" || productColor === "" || productSize === "" || productPrice === "" || productQuantity === "" || productImage1 === "") {
      alert("Please fill in all required fields.");
      return false;
    }
    return true;
  }
</script>  
</body>

</html>