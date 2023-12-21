<?php
include("db_connection.php");

if (isset($_POST['submit'])) {
  $full_name = $_POST['fname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $pwd = $_POST['pwd'];
  $conf_pwd = $_POST['cpwd'];
  $hash_pass = sha1($pwd);

  if ($pwd == $conf_pwd) {
    $sql = "INSERT INTO tbl_admins (fullname, email, phone, password) VALUES('$full_name', '$email', '$phone', '$hash_pass')";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
      echo "Data insertion failed.";
    }
  }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup</title>
    <link rel="stylesheet" href="../../assets/signup.css" />
  <link rel="stylesheet" href="../../assets/icons/css/all.css">

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
            <h2 id="signup-text">Signup as Vendor</h2>
          </div>

          <div class="input-grp">
            <i class="fa-solid fa-user"></i>
            <label for="fullname">Full Name</label>
            <input type="text" name="fname" id="fullname" />
          </div>

          <div class="input-grp">
            <i class="fa-solid fa-envelope"></i>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" />
          </div>
          <div class="input-grp">
            <i class="fa-solid fa-square-phone"></i>
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" />
          </div>

          <div class="input-grp">
            <i class="fa-solid fa-unlock"></i>
            <label for="password">Create Password</label>
            <input type="password" name="pwd" id="password" />
          </div>
          <div class="input-grp">
            <i class="fa-solid fa-unlock"></i>
            <label for="password">Confirm Password</label>
            <input type="password" name="cpwd" id="confirmPassword" />
          </div>

          <button type="submit" name="submit" onclick="validateForm()">Signup</button>
          
        </form>
      </div>
    </div>

    <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script>
        function validateForm() {
            var fullName = document.getElementById("fullname").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (fullName.trim() === "" || email.trim() === "" || phone.trim() === "" || password.trim() === "" || confirmPassword.trim() === "") {
                alert("Please fill in all fields");
                return false;
            }
            if (password !== confirmPassword) {
                alert("Password and Confirm Password do not match");
                return false;
            }

            return true; 
        }
    </script>
  </body>
</html>
