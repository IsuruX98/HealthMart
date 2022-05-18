<?php session_start(); ?>
<?php
//include database connection
require_once 'conn.php'; ?>
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
    /*----------Slider1 CSS part starts here----------*/

    #slider1 {
      overflow: hidden;
    }

    #slider1 figure {
      position: relative;
      width: 500%;
      margin: 0;
      left: 0;
      animation: 15s slider1 infinite;
    }

    #slider1 figure img {
      width: 20%;
      float: left;
    }

    @keyframes slider1 {
      0% {
        left: 0%;
      }

      16.66% {
        left: 0%;
      }

      33.32% {
        left: -100%;
      }

      49.98% {
        left: -100%;
      }

      66.64% {
        left: -200%;
      }

      83.30% {
        left: -200%;
      }

      100% {
        left: 0%;
      }
    }

    /*----------Slider1 CSS part End here----------*/
    /*----------Icon image CSS part starts here----------*/
    .iconimage img {
      width: 100%;
      height: 100%;
      object-fit: fill;
    }

    /*----------Icon image CSS End ends here----------*/
    /*----------Flexbox is divided into three parts for prescription upload, explore the store, and slider two starting from here.----------*/
    .flex-container {
      display: flex;
      flex-direction: row;
      font-size: 30px;
      text-align: center;
      margin: 30px;
      margin-bottom: 5%;
    }

    .flex-item-left1 {
      padding: 20px;
      flex: 50%;
    }

    .flex-item-middle1 {
      padding: 20px;
      flex: 50%;
    }

    .flex-item-right1 {
      flex: 50%;
      padding: 20px;
    }

    .flex-item-right1-up-down {
      display: flex;
      flex-direction: column;
    }

    .flex-item-right1-up {
      flex: 50%;
      margin-top: -20px;
    }

    .flex-item-right1-down {
      padding: 20px;
      flex: 50%;
      margin-top: -25px;
    }

    .flex-item-left1 .container {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    .flex-item-left1 a {
      text-decoration: none;
    }

    .flex-item-left1 a:visited {
      color: inherit;
    }

    .flex-item-middle1 .container {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    .container {
      position: relative;
      width: 100%;
      max-width: 400px;
    }

    .container img {
      width: 100%;
      height: auto;
    }

    .container .btn {
      position: absolute;
      top: 75%;
      left: 75%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      color: black;
      font-size: 16px;
      padding: 12px 24px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      text-align: center;
      background: #ddd;
      font-size: 17px;
      width: 150px;
    }

    .container .btn:hover {
      background: black;
      color: white;
      transition: 0.3s;
    }

    /*----------Slider2 CSS part Starts here----------*/
    #slider2 {
      overflow: hidden;
      padding: 20px;
      flex: 50%;
    }

    #slider2 figure {
      position: relative;
      width: 500%;
      margin: 0;
      left: 0;
      animation: 35s slider2 infinite;
    }

    #slider2 figure img {
      width: 20%;
      float: left;
    }

    @keyframes slider2 {
      0% {
        left: 0%;
      }

      10% {
        left: 0%;
      }

      20% {
        left: -100%;
      }

      30% {
        left: -200%;
      }

      40% {
        left: -300%;
      }

      50% {
        left: -400%;
      }

      60% {
        left: -400%;
      }

      70% {
        left: -300%;
      }

      80% {
        left: -200%;
      }

      90% {
        left: -100%;
      }

      100% {
        left: 0%;
      }
    }

    /*----------Slider2 CSS part End here----------*/
  </style>
  <script src="home.js"></script>
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
  <div id="slider1">
    <figure>
      <img src="/Images/s2.jpg" alt />
      <img src="/Images/s3.jpg" alt />
      <img src="/Images/s1.jpg" alt />
    </figure>
  </div>
  <!-- <img class="content" src="/Images/main.png" alt="content here" /> -->
  <div class="iconimage">
    <img src="/Images/Iconbar.jpg" alt="unclickable icons" />
  </div>
  <div class="flex-container">
    <div class="flex-item-left1">
      <div class="container">
        <img src="/Images/prescription.jpg" alt="Snow" style="width: 100%" />
        <button class="btn" onclick="preupload();">
          <a href="#">Upload Prescription</a>
        </button>
      </div>
    </div>
    <!--grid 01-->
    <div class="flex-item-middle1">
      <div class="container">
        <img src="/Images/shopnow.jpg" alt="Snow" style="width: 100%" />
        <button class="btn" onclick="medicine();">Shop Now</button>
      </div>
    </div>
    <!--grid 02-->
    <div class="flex-item-right1">
      <div class="flex-item-right1-up-down">
        <div class="flex-item-right1-up">
          <div id="bsi">
            <h3>Best selling items</h3>
          </div>
        </div>
        <div class="flex-item-right1-down">
          <div id="slider2">
            <figure>
              <img src="/Images/medd1.jpg" alt />
              <img src="/Images/medd2.jpg" alt />
              <img src="/Images/medd3.jpg" alt />
              <img src="/Images/medd4.jpg" alt />
              <img src="/Images/medd5.jpg" alt />
            </figure>
          </div>
        </div>
      </div>
    </div>
    <!--grid 03-->
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