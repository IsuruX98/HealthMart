<?php session_start(); ?>
<?php
//include database connection
require_once 'conn.php'; ?>
<?php
//checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
  header('location: loginForm.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>healthmart.com</title>
  <link rel="shortcut icon" href="/Images/logo.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/CSS/template2.css" />
  <link rel="stylesheet" href="/CSS/normalize.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
  <!--stylesheet for icons in footer -->
  <style>
    .admin1 {
      text-align: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: x-large;
    }

    #admin {
      display: flex;
      margin: 20px;
    }

    .section111 {
      padding: 2% 2% 5% 2%;
    }

    .navigate1,
    .navigate2,
    .navigate3,
    .navigate4,
    .navigate5 {
      text-align: center;
      text-decoration: none;
      font-size: 30px;
      cursor: pointer;
      border-radius: 25px;
      padding: 50px 20px 20px 10px;
      transition: all 0.3s ease 0s;
      width: 20%;
      margin-right: 50px;
      height: 10cm;
      margin: 23px;
    }

    .jcbutton {
      background: transparent;
      border: none;
      color: #ffffff;
      font-weight: bold;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navigate1 {
      background-color: #26abff;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.4);
    }

    .navigate1:hover {
      background-color: #000000;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.4);
      color: #f1f1f1;
    }

    .navigate2 {
      background-color: #59bfff;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.4);
    }

    .navigate2:hover {
      background-color: #000000;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.4);
      color: #f1f1f1;
    }

    .navigate3 {
      background-color: #ababab;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.4);
    }

    .navigate3:hover {
      background-color: #000000;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.4);
      color: #f1f1f1;
    }

    .navigate4 {
      background-color: #7e7e7e;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.4);
    }

    .navigate4:hover {
      background-color: #000000;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.4);
      color: #f1f1f1;
    }

    .navigate5 {
      background-color: #4d4d4d;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.4);
    }

    .navigate5:hover {
      background-color: #000000;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.4);
      color: #f1f1f1;
    }
  </style>
  <script src="admindashboard.js"></script>
</head>

<body>
  <div class="header">
    <a href="#default" class="logo"><i class="far fa-eye"></i> HealthMart</a>
    <div class="header-right">
      <a href="#" onclick="adminDashBoard();"><i class="far fa-user-circle"> </i>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['name']; ?></a>
    </div>
  </div>
  <div class="menu">
    <a class="active" onclick="adminDashBoard();"><i class="fa fa-fw fa-home"></i> Home</a>
    <a href="#" onclick="addnewItem();">Add New Items</a>
    <a href="#" onclick="viewItems();">View Items, Update & Delete</a>
    <a href="#" onclick="viewContactUs();">View Contact Us</a>
    <a href="#" onclick="viewPreupOrders();">View Prescription Orders</a>
    <a href="#" onclick="viewCartOrders();">View Cart Orders</a>
    <div class="search-container">

    </div>
  </div>
  <div class="admin1">
    <h1>Welcome Admin</h1>
    <h3><?php echo $_SESSION['name']; ?></h3>
  </div>
  <section id="admin" class="section111">
    <div class="navigate1" onclick="addnewItem();">
      <button class="jcbutton">Add New Items</button>
      <br /><br /><br /><br />
      <i class="fa-solid fa-pills"></i>
    </div>
    <div class="navigate2" onclick="viewItems();">
      <button class="jcbutton">View Items<br><br>Update<br>Delete</button>
      <br /><br />
      <i class="fa-solid fa-eye"></i>
    </div>
    <div class="navigate3" onclick="viewContactUs();">
      <button class="jcbutton">View Contact Us</button>
      <br /><br /><br /><br />
      <i class="fa-solid fa-address-book"></i>
    </div>
    <div class="navigate4" onclick="viewPreupOrders();">
      <button class="jcbutton">View Prescription Orders</button>
      <br /><br /><br />
      <i class="fa-solid fa-file-prescription"></i>
    </div>
    <div class="navigate5" onclick="viewCartOrders();">
      <button class="jcbutton">View Cart Orders</button>
      <br /><br /><br /><br /><br />
      <i class="fa-solid fa-cart-plus"></i>
    </div>
  </section>
  <footer>
    <div class="row primary">
      <div class="column about">
        <h3><i class="far fa-eye"></i> HealthMart</h3>
        <p>
          We are committed to your health at Health Mart. We now offer an
          online shopping and ordering experience to make health and wellness
          products more accessible to you. You may browse thousands of home
          health and over-the-counter goods on our site.
        </p>
        <div class="social">
          <a href="#"><i class="fa-brands fa-facebook-square" id="i1"></i></a>
          <a href="#"><i class="fa-brands fa-instagram-square" id="i2"></i></a>
          <a href="#"><i class="fa-brands fa-twitter-square" id="i3"></i></a>
          <a href="#"><i class="fa-brands fa-youtube-square" id="i4"></i></a>
          <a href="#"><i class="fa-brands fa-whatsapp-square" id="i5"></i></a>
        </div>
      </div>
      <div class="column links">

      </div>
      <div class="column subscribe">
      </div>
    </div>
    <div class="row copyright">
      <p>© 2022 HealthMart,inc. All rights reserved.</p>
    </div>
  </footer>
</body>

</html>
<?php
//close connection to database
mysqli_close($conn);
?>