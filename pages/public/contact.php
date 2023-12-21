<?php 
session_start();
include("db_connection.php");


if(!isset($_SESSION['logged_in'])){
    $page = "contact.php";
    header("location: login.php?page=$page");
}

$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : header("location: login.php");

$sql_select = "SELECT * FROM tbl_customers WHERE customer_id=$customer_id";
$result_select = mysqli_query($connection, $sql_select);
$db_data = mysqli_fetch_assoc($result_select);

if(isset($_POST['send_message'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $issue = $_POST['issue'];
    $message = $_POST['message'];

    $sql_insert_contact = "INSERT INTO tbl_contact (customer_id,fullname,email,issue,message) VALUES ('$customer_id','$fullname','$email', '$issue','$message')";
    $result_insert = mysqli_query($connection, $sql_insert_contact);
    if($result_insert){
        echo '<script>alert("Issue Reported")</script>';
    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <!-- <link rel="stylesheet" href="../../assets/style.css"> -->
    <link rel="stylesheet" href="../../assets/footer.css">
    <link rel="stylesheet" href="../../assets/contact.css">
</head>

<body>
<?php include("nav.php")?>

    <div class="wrapper">
        <div class="container">
            <form action="#" method="post" class="form">

                <div>
                    <h1 id="title">Contact</h1>

                </div>
                <div class="input-grp">
                    <i class="fa-solid fa-user"></i>
                    <label for="fname">Full Name</label>
                    <input type="text" name="fullname" placeholder="Enter Your Name" value="<?php echo $db_data['fullname'] ?>" required/>
                </div>
                <div class="input-grp">
                    <i class="fa-solid fa-envelope"></i>
                    <label for="email">Email</label>
                    <input type="email" placeholder="Enter Your Email" name="email" value="<?php echo $db_data['email'] ?>" required/>

                </div>
                <div class="input-grp">
                    <i class="fa-solid fa-question"></i>
                    <label for="Isuue">Choose Your Issue</label>
                    <select name="issue" id="">
                        <option value="Payment Problems">Payment Problems</option>
                        <option value="Wrong Product and Quality Issue">Wrong Product and Quality Issue</option>
                        <option value="Delayed/Not Delivery">Delayed/Not Delivery</option>
                        <option value="Security Concerns">Security Concerns</option>
                        <option value="Technical Glitches">Technical Glitches</option>
                        <option value="Inappropriate Content or Behavior">Inappropriate Content or Behavior</option>
                        <option value="Security Concerns">Security Concerns</option>
                        <option value="Security Concerns">Others</option>
                    </select>


                </div>
                <div class="input-grp">
                    <i class="fa-solid fa-message"></i>
                    <label for="password">Message</label>
                    <textarea name="message" id="" cols="30" rows="10"
                        placeholder="Let us know what you need help with.." required></textarea>

                </div>


                <button type="submit" name="send_message">Send Message</button>

            </form>
        </div>
    </div>

    <?php include("footer.php")?>


    <script src="../../assets/script.js"></script>
    <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

</html>