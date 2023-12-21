<?php
session_start();
include("db_connection.php");

$account_updated = isset($_SESSION['account_updated']) ? $_SESSION['account_updated'] : false;

if ($account_updated) {
  echo "<script>alert('Account Updated')</script>";
  unset($_SESSION['account_updated']);
}

$page='adminaccounupdate.php';
$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : header("location: vendorlogin.php?page=$page");

$sql_select = "SELECT * FROM tbl_admins WHERE admin_id=$admin_id";
$sql_result = mysqli_query($connection, $sql_select);

$fetch_data = mysqli_fetch_assoc($sql_result);


$full_name = isset($fetch_data['fullname']) ? $fetch_data['fullname'] : '';
$email = isset($fetch_data['email']) ? $fetch_data['email'] : '';
$phone = isset($fetch_data['phone']) ? $fetch_data['phone'] : '';

if (isset($_POST['submit'])) {
$full_name = $_POST['fname'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$sql = "UPDATE tbl_admins SET fullname = '$full_name', email = '$email',phone = '$phone' WHERE admin_id=$admin_id";
$result = mysqli_query($connection, $sql);
        
if ($result) {
  $_SESSION['account_updated'] = true;
}

  header("location: adminaccountupdate.php?");
}

if(isset($_POST['back'])){
  header("location: adminprofile.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Update Account</title>
  <link rel="stylesheet" href="../../assets/signup.css" />
</head>

<body>
  
  <div class="container">
    <div>
      <form action="#" method="post">
        
        <div class="logo">
          <i class="fa-brands fa-opencart"></i>
          <h1>Mandu Cart.</h1>
        </div>
        <div>
          <h2 id="signup-text" >Update Admin Info</h2>
  
        </div>
        
        <div class="input-grp">
          <i class="fa-solid fa-user"></i>
          <label for="fullname">Full Name</label>
          <input type="text" name="fname" value="<?php echo $full_name; ?>" required />
        </div>

        <div class="input-grp">
          <i class="fa-solid fa-envelope"></i>
          <label for="email">Email</label>
          <input type="email" name="email" value="<?php echo $email; ?>" id="" required/>
        </div>
        <div class="input-grp">
          <i class="fa-solid fa-square-phone"></i>
          <label for="phone">Phone</label>
          <input type="text" name="phone" value="<?php echo $phone; ?>" required />
        </div>
        <button type="submit" name="back">Back</button>
        <button type="submit" name="submit">Update</button>
        
    
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
