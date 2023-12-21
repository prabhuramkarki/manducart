<?php
session_start();
include("db_connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../assets/PHPMailer/src/PHPMailer.php';
require '../../assets/PHPMailer/src/Exception.php';
require '../../assets/PHPMailer/src/SMTP.php';




if (isset($_POST['send_otp'])) {

    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $select_user = "SELECT email, phone FROM tbl_customers WHERE email='$email'";
    $select_user_result = mysqli_query($connection, $select_user);

    $dbemail = '';
    $dbphone = '';
    while ($data = mysqli_fetch_assoc($select_user_result)) {
        $dbemail = $data['email'];
        $dbphone = $data['phone'];

        if ($email == $dbemail && $phone == $dbphone) {
            $otp = rand(1000,9999);

            $body = "Verification code is $otp";

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sanjeevprjl52310@gmail.com';
            $mail->Password = 'nvrh gfyf gwrp lltx';
            $mail->SMTPSecure = 'ssl';

            $mail->Port = 465;

            $mail->setFrom('sanjeevprjl52310@gmail.com');

            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->Subject = 'Verfication Code';
            $mail->Body = $body;

            $mail->send();
            $_SESSION['customer_email'] = $email;
            $_SESSION['otp'] = $otp;

            echo"<script>alert('Sent successfully');document.location.href = 'otp.php';</script>";
        }
        else{
            echo"<script>alert('Input Wrong');</script>";
        }
    }


    // header("location: otp.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
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
                    <i class="fa-solid fa-envelope"></i>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="" />
                </div>
                <div class="input-grp">
                    <i class="fa-solid fa-square-phone"></i>
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" />
        </div>


        <button type="submit" name="send_otp">Send OTP</button>
        </form>
        
    </div>
    </div>
</body>

</html>