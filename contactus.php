<?php
//include database connection
require_once 'conn.php'; ?>

<?php
//check if form submitted, insert from form into user table
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobileNo = $_POST['mobileNo'];
  $userIdeas = $_POST['userIdeas'];


  //insert user data in to table
  $sql = "INSERT INTO contactus(uname,email,mobileNo,userIdeas) VALUES('$name','$email','$mobileNo','$userIdeas')";

  $result = mysqli_query($conn, $sql);

  //redirect to home page
  header('location: home.php');
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
    .flex-container-contactus {
      display: flex;
      flex-direction: row;
    }

    .flex-container-contactus-left {
      flex: 50%;
      padding: 20px;
    }

    .flex-container-contactus-right {
      flex: 50%;
      margin: auto;
    }

    .flex-container-contactus-right-up-down {
      display: flex;
      flex-direction: column;
    }

    .flex-container-contactus-right-up {
      flex: 50%;
    }

    .flex-container-contactus-right-down {
      flex: 50%;
    }

    .flex-container-contactus-right-down img {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
      margin-top: -30px;
    }

    .contactus-form input[type="text"] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      display: inline-block;
      border: none;
      background: #f1f1f1;
    }

    .getintouch {
      margin: auto;
      width: 70%;
      margin-right: -50px;
      margin-top: 70px;
    }

    .contactus-form {
      padding: 30px;
    }

    .contactus-form button {
      background-color: #25262e;
      color: white;
      padding: 14px 20px;
      margin: 20px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    .contactus-form button:hover {
      background-color: #2196f3;
      color: black;
      transition: 0.3s;
    }

    .contactus-form textarea {
      width: 100%;
    }

    @media screen and (max-width: 800px) {
      .flex-container-contactus {
        flex-direction: column;
      }

      .getintouch {
        margin: auto;
        text-align: center;
      }
    }
  </style>
  <script src="contactus.js"></script>
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
  <div class="flex-container-contactus">
    <div class="flex-container-contactus-left">


      <div class="contactus-form">
        <h2>Contact Us</h2>
        <form action="contactus.php" method="POST" onsubmit="contactus();">
          <label for="Name"><b>Name</b></label>
          <input type="text" name="name" />
          <label for="Email"><b>Email</b></label>
          <input type="text" name="email" />
          <label for="Mobilenumber"><b>Mobile number</b></label>
          <input type="text" name="mobileNo" />
          <p>
            <label for="Whatisonyourmind">What is on your mind....</label>
          </p>
          <textarea id="userIdeas" name="userIdeas" rows="8" cols="50"></textarea>
          <br />
          <button type="submit" name="submit">Submit</button>
        </form>
      </div>


    </div>
    <div class="flex-container-contactus-right">
      <div class="flex-container-contactus-right-up-down">
        <div class="flex-container-contactus-right-up">
          <div class="getintouch">
            <h2>Get in Touch</h2>
            <h3>HealthMart Pharmacy Limited</h3>
            <h3>Address</h3>
            <p>No 139/A Vihara Mawatha. Malabe, Sri Lanka.</p>
            <h3>Tel:</h3>
            <p>+94 76 447 7777</p>
            <h3>E mail:</h3>
            <p>healthmart.Ik</p>
          </div>
        </div>
        <div class="flex-container-contactus-right-down">
          <img src="/Images/contactus.png" alt="contactuspng" />
        </div>
      </div>
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