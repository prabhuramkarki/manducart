<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nav</title>
  <link rel="stylesheet" href="../../assets/adminnav.css">
  <link rel="stylesheet" href="../../assets/icons/css/all.css">

</head>

<body>
  <nav>
    <div class="nav">
      <div class="logo">
        <i class="fa-brands fa-opencart"></i>
        <h1 id="logo-text">Mandu Cart <span id="last-word">.</span> </h1>
        <p class="admin_txt" style="color:red; font-size: 10px;">ADMIN</p>
      </div>
      <div class="nav-links" id="nav-links">
        <li type="none">
          <a class="nav-link" href="adminpanel.php">Dashboard</a>
        </li>
        <li type="none">
          <a class="nav-link" href="manageproducts.php">Catalog</a>
        </li>
        <li type="none">
          <a class="nav-link" href="managecustomers.php">Customers</a>
        </li>
        <li type="none">
          <a class="nav-link" href="manageorders.php">Orders</a>
        </li>

      </div>
      <div class="icons">
      <a href="adminpanel.php"><i class="fa-solid fa-house"></i></a>
        
        <a href="viewissues.php"><i class="fa-solid fa-bell"></i></a>
        <a href="adminprofile.php"> <i class="fa-solid fa-user-gear"></i></a>
      </div>
    </div>
  </nav>
  </nav>
  <script>
    const currentUrl = window.location.href;

    const links = document.querySelectorAll('.nav-link');

    links.forEach(link => {
      if (link.href === currentUrl) {
        link.classList.add('active-link');
      }
    });
  </script>
</body>

</html>