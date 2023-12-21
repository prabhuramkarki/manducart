<?php
session_start();
include("db_connection.php");


$password_changed = isset($_SESSION['password_changed']) ? $_SESSION['password_changed'] : false;

if ($password_changed) {
  echo "<script>alert('Password Changed Sucessfully')</script>";
  unset($_SESSION['password_changed']);
}


$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : header("location: login.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Account</title>
    <link rel="stylesheet" href="../../assets/customeracc.css">
    <link rel="stylesheet" href="../../assets/footer.css">
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="profile-wrapper">
        <div class="profile-heading">
            <!-- <h2>Welcome to Customer Profile</h2> -->
        </div>
        <div class="profile-container">
            <div class="profile-card">
                <div id="profile-items">
                    <form action="customeraccountupdate.php" method="post">
                        <button name="update_acc"><i class="fa-solid fa-pen-nib"></i> Update Account</button>
                    </form>
                    <form action="customerchangepassword.php" method="post">
                        <button name="change_pwd"><i class="fa-solid fa-key"></i> Change Password</button>
                    </form>
                    <form action="customeraccountdelete.php" method="post">
                        <button name="delete_acc"><i class="fa-solid fa-delete-left"></i> Delete Account</button>
                    </form>
                    <form action="logout.php" method="post">
                        <button name="logout"><i class="fa-solid fa-right-from-bracket"></i> Log Out</button>

                    </form>





                </div>
            </div>

        </div>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>