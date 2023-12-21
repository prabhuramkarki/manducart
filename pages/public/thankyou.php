<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Thank you Page</title>
  <link rel="stylesheet" href="../../assets/style.css" />
  <link rel="stylesheet" href="../../assets/footer.css" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Montserrat", sans-serif;
    }

    #image {
      margin-top: 40px;
      margin-left: 5%;
      margin-right: 5%;
      background-image: url("../../images/thankyou.jpg");
      opacity: 95%;
      background-position-x: center;
      background-position-y:center;
      background-size: contain;
      background-size: 100%;
      border-radius: 5px;
      width: 90%;
      height: 40vh;
    }

    .wrapper {
      align-items: center;
      text-align: center;
    }

    .cont {
      margin-top: 40px;
      margin-left: 100px;
      justify-content: space-around;
    }

    .return {
      color: #fffbfb;
      padding: 10px;
      text-align: center;
      cursor: pointer;
      background-color: black;
      font-size: 15px;
      transition: all ease 0.2s;
      border-radius: 3px;
      margin-top: 40px;
      margin-left: 100px;
      margin-bottom: 20px;

    }

    .return:hover {
      color: white;
      background-color: rgb(56, 56, 56);
    }
  </style>
</head>

<body>
  <?php
  include("nav.php");
  ?>

  <div id="image">
    <!-- <img src="../../images/thankyou.jpg" alt="thankyou"> -->
  </div>

  <div class="wrapper">
    <div class="cont">
      <h1 class="paragraph" style=" margin-bottom: 10px;">Thank You! </h1>
      <br>
      <p> <br>
        Payment done Successfully</p>
      <br>
      <p class="paragraph1"> Thank you for shopping with Mandu Cart. Your order will be
        delivered to your doorstep.</p>
    </div>

    <div>
      <form action="index.php" method="post">
        <button class="return">Continue to Shopping</button>
      </form>
    </div>

  </div>
  <?php include("footer.php") ?>
</body>

</html>