<?php
session_start();
include("db_connection.php");

$email = $_SESSION['customer_email'];
$otp = $_SESSION['otp'] ;

if (isset($_POST['reset'])) {

    $form_otp = $_POST['enter_otp'];
    $pwd = $_POST['pwd'];
    $conf_pwd = $_POST['cpwd'];

    if($otp == $form_otp){
        $hash_pass = sha1($pwd);

        if ($pwd == $conf_pwd) {
            $sql = "UPDATE tbl_customers SET password = '$hash_pass' WHERE email='$email' ";
            $result = mysqli_query($connection, $sql);

            unset($_SESSION['customer_email']);

            unset($_SESSION['otp']);
            echo"<script>alert('Password Changed successfully');</script>";
                    
        }else {
            echo"<script>alert('Not Same Password ');</script>";
        }
    }else{
        echo"<script>alert('Otp is wrong');</script>";
    }

    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Send OTP</title>
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
                    <h1 id="signup-text">Forgot Password</h1>
                </div>
            

        <div class="input-grp">
            <i class="fa-solid fa-unlock"></i>
            <label for="password">Enter New Password</label>
            <input type="password" name="pwd" id="" />
        </div>
        <div class="input-grp">
            <i class="fa-solid fa-unlock"></i>
            <label for="password">Confirm New Password</label>
            <input type="password" name="cpwd" id="" />
        </div>
        <div class="input-grp">
            <i class="fa-solid fa-message"></i>
            <label for="text">Enter OTP</label>
            <input type="text" name="enter_otp" id="" />
        </div>

        <button type="submit" name="reset">Reset Password</button>
        </form>
        <a href="login.php" style="text-decoration: none; color: rgb(255, 0, 0);font-weight:500;">Login</a> 
    </div>
    </div>
</body>

</html>