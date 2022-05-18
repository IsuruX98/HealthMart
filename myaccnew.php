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
    .ymyacc {
      padding: 3%;
      margin-left: 5%;
      margin-right: 5%;
      display: flex;
      flex-direction: row;
    }

    .ymyaccleft {
      padding: 20px;
      flex: 50%;
    }

    .ymyaccright {
      flex: 50%;
      display: flex;
      justify-content: center;
    }

    .ymyaccright img {
      width: 100%;
      margin: auto;
    }

    .y-edit {
      background-color: #25262e;
      color: white;
      padding: 0px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 70px;
      height: 30px;
      font-size: small;
      text-align: center;
    }

    .y-edit:hover {
      background-color: #2196f3;
      color: black;
      transition: 0.3s;
    }

    .y-changepw {
      background-color: #25262e;
      color: white;
      padding: 0px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 140px;
      height: 30px;
      font-size: small;
      text-align: center;
    }

    .y-changepw:hover {
      background-color: #2196f3;
      color: black;
      transition: 0.3s;
    }

    .myacc-logoutbtn {
      background-color: #f44336;
      border: none;
      padding: 0px;
      margin: 8px 0;
      color: white;
      cursor: pointer;
      width: 70px;
      height: 30px;
      font-size: small;
      text-align: center;
    }

    .myacc-logoutbtn:hover {
      background-color: #ce1f13;
      color: white;
      transition: 0.3s;
    }

    .myacc-logoutbtn a {
      text-decoration: none;
      color: white;
    }

    .myacc-logoutbtn a:visited {
      color: white;
    }

    .myacc-editbtn {
      background-color: #f44336;
      border: none;
      padding: 0px;
      margin: 8px 0;
      color: white;
      cursor: pointer;
      width: 150px;
      height: 30px;
      font-size: small;
      text-align: center;
    }

    .myacc-editbtn:hover {
      background-color: #ce1f13;
      color: white;
      transition: 0.3s;
    }

    .myacc-editbtn a {
      text-decoration: none;
      color: white;
    }

    .myacc-editbtn a:visited {
      color: white;
    }

    .myacc-changepwbtn {
      background-color: #f44336;
      border: none;
      padding: 0px;
      margin: 8px 0;
      color: white;
      cursor: pointer;
      width: 120px;
      height: 30px;
      font-size: small;
      text-align: center;
    }

    .myacc-changepwbtn:hover {
      background-color: #ce1f13;
      color: white;
      transition: 0.3s;
    }

    .myacc-changepwbtn a {
      text-decoration: none;
      color: white;
    }

    .myacc-changepwbtn a:visited {
      color: white;
    }

    .myacc-btnbox {
      display: flex;
      flex-direction: column;
    }
  </style>
</head>

<body>
  <div class="header">
    <a href="#" onclick="home();" class="logo"><i class="far fa-eye"></i> HealthMart</a>
    <div class="header-right">
      <div><?php
            if (isset($_SESSION['user_id'])) {
              echo "<a onclick=\"myacc();\"><i class=\"far fa-user-circle\"> </i>&nbsp;&nbsp;&nbsp;";
              echo $_SESSION['name'] . "</a>";
            } else {
              echo "<a onclick=\"register();\"><i class=\"far fa-user-circle\"></i> Sign in</a>";
            }
            ?></div>
      <?php
      if (!empty($_SESSION["shopping_cart"])) {
        $cart_count = count(array_keys($_SESSION["shopping_cart"]));
      ?>
        <a href="cart.php"><i class="fa fa-shopping-cart"></i> : <?php echo $cart_count; ?></a>
      <?php
      }
      ?>

    </div>
  </div>
  <div class="menu">
    <a class="active" href="#" onclick="home();"><i class="fa fa-fw fa-home"></i> Home</a>
    <a href="#" onclick="medicine();">Medicines</a>
    <a href="#" onclick="medicalDevices();">Medical Devices</a>
    <a href="#" onclick="traditionalRemedies();">Traditional Remedies</a>
    <a href="#" onclick="aboutUs();">About us</a>
    <div class="search-container">
      <form action="/action_page.php">
        <input type="text" placeholder="Search.." name="search" />
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>
  <!--MY Account-->
  <div class="ymyacc">
    <div class="ymyaccleft">
      <h1>My Profile</h1>

      <h4>Account Information</h4>

      <hr />

      <h4>Contact Information</h4>

      <p>Name : <?php echo $_SESSION['name']; ?></p>
      <p>E-mail : <?php echo $_SESSION['email']; ?></p>
      <p>Mobile Number: 0<?php echo $_SESSION['mobileNo']; ?></p>

      <br />

      <h4>Address Book</h4>

      <hr />

      <p>Address</p>

      <p>
        <?php echo $_SESSION['address']; ?>
      </p>
      <br />

      <div class="myacc-btnbox">
        <button class="myacc-editbtn"><?php echo "<a href=\"editacc.php?user_ID={$_SESSION['user_id']}\">Edit Account Infomation</a> "; ?></button>
        <button type="submit" name="changepw" class="myacc-changepwbtn"><?php echo "<a href=\"changepw.php?user_ID={$_SESSION['user_id']}\">Change Password</a> "; ?></button>
        <button class="myacc-logoutbtn" onclick="return confirm('Are you sure you want to Log Out ?');"><a href="logout.php">Log Out</a></button>
      </div>
    </div>
    <div class="ymyaccright">
      <img src="/Images/myacc.jpg" alt="" />
    </div>
  </div>
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
          <a href="#"><i class="fa-brands fa-facebook-square" id="i1" onclick="fbLogin();"></i></a>
          <a href="#"><i class="fa-brands fa-instagram-square" id="i2" onclick="instaLogin();"></i></a>
          <a href="#"><i class="fa-brands fa-twitter-square" id="i3" onclick="twitterLogin();"></i></a>
          <a href="#"><i class="fa-brands fa-youtube-square" id="i4" onclick="youtube();"></i></a>
          <a href="#"><i class="fa-brands fa-whatsapp-square" id="i5" onclick="whatsapp();"></i></a>
        </div>
      </div>
      <div class="column links">
        <h3>Customer Service</h3>
        <ul>
          <li>
            <a href="#" onclick="contactUs();">Contact Us</a>
          </li>
          <li>
            <a href="#" onclick="privacyPolicy();">Privacy Policy</a>
          </li>
          <li>
            <a href="#" onclick="aboutUs();">About Us</a>
          </li>
        </ul>
      </div>
      <div class="column subscribe">
        <h3>Newsletter</h3>
        <div class="footersearch">
          <input type="email" placeholder="Your email id here" />
          <button>Subscribe</button>
        </div>
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