<?php
session_start();
include("db_connection.php");
$admin_id = $_SESSION['admin_id'];

$product_id = $_GET['product_id'];
$category_id = $_GET['category_id'];
$select_sql = "SELECT * FROM tbl_products WHERE product_id=$product_id";
$select_res = mysqli_query($connection, $select_sql);

if (isset($_POST['update'])) {
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


  $sql_update_category = "UPDATE tbl_categories SET product_color = '$product_color', product_category = '$product_category', product_size = '$product_size', updated_by = '$admin_id' WHERE category_id=$category_id";
  $result_update_category = mysqli_query($connection, $sql_update_category);
  $sql_update_product = "UPDATE tbl_products SET product_name = '$product_name', product_details='$product_details', product_quantity=$product_quantity, product_price=$product_price, updated_by=$admin_id WHERE product_id=$product_id";
  $result_update_product = mysqli_query($connection, $sql_update_product);
  print_r($result_update_product);


  if ($result_update_product) {
    $_SESSION['product_updated'] = true;
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
    if (isset($photo_name1)) {
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
    if (isset($photo_name2)) {
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

    if (isset($photo_name3)) {
      
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
    if (isset($photo_name4)) {
      $sql_photo4 = "UPDATE tbl_products SET product_image4='$photo_name4' WHERE product_id =$product_id";
      $connection->query($sql_photo4);
    }
  }
  header("location:manageproducts.php");
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

  
  <?php if ($select_res) :
    while ($old = mysqli_fetch_assoc($select_res)) :
      $product_id = $old['product_id'];
      $category_id = $old['category_id'];

      $select_sql_cat = "SELECT * FROM tbl_categories WHERE category_id=$category_id";
      $select_res_cat = mysqli_query($connection, $select_sql_cat);
      $old_cat = mysqli_fetch_assoc($select_res_cat);
      $product_name = isset($old['product_name']) ? $old['product_name'] : '';
      $product_details = isset($old['product_details']) ? $old['product_details'] : '';
      $product_image = isset($old['product_image']) ? $old['product_image'] : '';
      $product_quantity = isset($old['product_quantity']) ? $old['product_quantity'] : '';
      $product_price = isset($old['product_price']) ? $old['product_price'] : '';


      $product_category = isset($old_cat['product_category']) ? $old_cat['product_category'] : '';
      $product_color = isset($old_cat['product_color']) ? $old_cat['product_color'] : '';
      $product_size = isset($old_cat['product_size']) ? $old_cat['product_size'] : '';

  ?>

  <form action="#" method="post" enctype="multipart/form-data">

    <div class="addprod-container">
      <div id="inner-container">

        <div class="left">

          <label for="product_name">Product Name</label>
          <input type="text" name="product_name" value="<?php echo $product_name; ?>" required>

          <label for="product_category">Product Category</label>
          <select name="product_category" id="product_category" value="<?php echo $product_category; ?>">
          <option><?php echo $old_cat['product_category']; ?> </option>
            <option value="Mens">Mens</option>
            <option value="Womens">Womens</option>
            <option value="Unisex">Unisex</option>
          </select>

          <label for="product_details">Product Details</label>
          <textarea type="text" name="product_details"rows="4" cols="200"><?php echo $product_details; ?></textarea>

          <label for="product_color">Available Colors</label>
          <select name="product_color" id="product_color">
          <option><?php echo $old_cat['product_color']; ?> </option>
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
          <option><?php echo $old_cat['product_size']; ?> </option>
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
          <input type="text" name="product_price" value="<?php echo $product_price; ?>" required>

          <label for="quantity">Quantity</label>
          <input type="number" name="product_quantity" value="<?php echo $product_quantity; ?>" min="1" required>
          
          <label for="product_image">Choose Product Image(only if you wanna change it)</label>
          <input type="file" name="product_image1" >

          <label for="product_image">Product Image 2 (Optional) </label>
          <input type="file" name="product_image2">

          <label for="product_image">Product Image 3 (Optional) </label>
          <input type="file" name="product_image3">

          <label for="product_image">Product Image 4 (Optional)</label>
          <input type="file" name="product_image4">
          

        </div>

      </div>

      <div class="addprod-btn-div">
        <button type="submit" name="update" id="addprod-btn">Update</button>
      </div>
      <br>
      <br>

    </div>


    <br>
    <br>


  </form>
  <?php endwhile;
  endif; ?>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>

</body>

</html>