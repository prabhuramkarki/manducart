<?php
include("db_connection.php");


if (isset($_POST['reset'])) {

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $phone = $_POST['phone'];

    $select_user = "SELECT email, phone FROM tbl_admins WHERE email='$email'";
    $select_user_result = mysqli_query($connection, $select_user);

    $dbemail = '';
    $dbphone = '';
    while ($data = mysqli_fetch_assoc($select_user_result)) {
        $dbemail = $data['email'];
        $dbphone = $data['phone'];

        if ($email == $dbemail && $phone == $dbphone) {


            $pwd = $_POST['pwd'];
            $conf_pwd = $_POST['cpwd'];
            $hash_pass = sha1($pwd);

            if ($pwd == $conf_pwd) {
                $sql = "UPDATE tbl_admins SET password = '$hash_pass' WHERE email='$email' ";
                $result = mysqli_query($connection, $sql);
                // if (!$result) {
                //     echo "Data insertion failed.";
                // }
                echo'<script>alert("Password changed")</script>';
            }
        } else {
            echo "data not matched";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
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
                    <h1 id="signup-text">Forgot Password</h1>
                </div>
                <div class="input-grp">
                    <i class="fa-solid fa-envelope"></i>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="" />
                </div>
                <div class="input-grp">
                    <i class="fa-solid fa-square-phone"></i>
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" />
                </div>

                <div class="input-grp">
                    <i class="fa-solid fa-unlock"></i>
                    <label for="password">Create New Password</label>
                    <input type="password" name="pwd" id="" />
                </div>
                <div class="input-grp">
                    <i class="fa-solid fa-unlock"></i>
                    <label for="password">Confirm Password</label>
                    <input type="password" name="cpwd" id="" />
                </div>
                <div class="input-grp">
                    <i class="fa-solid fa-message"></i>
                    <label for="text">Enter OTP</label>
                    <input type="text" name="enter_otp" id="" />
                </div>

                <button type="submit" name="reset">Reset Password</button>
            </form>
        </div>
    </div>
</body>

</html>