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
<?php
$errors = array();
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobileNo = $_POST['mobileNo'];
  $address1 = $_POST['address1'];
  $frequency = $_POST['frequency'];
  $fullfillment = $_POST['fullfillment'];
  $subsitues = $_POST['subsitues'];
  $days = $_POST['days'];
  $paymentoption = $_POST['paymentoption'];
  $refund = $_POST['refund'];
  $pretxt = $_POST['pretxt'];
  $newaddress = $_POST['newaddress'];

  //getting the details of the file that uploaded
  $fileName = $_FILES['fileupload']['name'];
  $fileType = $_FILES['fileupload']['type'];
  $fileSize = $_FILES['fileupload']['size'];
  //temporary file name to store file
  $tempName = $_FILES['fileupload']['tmp_name'];

  //upload directory path
  $uploadTo = 'upload/';

  //checking file type
  if ($fileType == 'image/jpeg' || $fileType == 'image/png' || $fileType == 'application/pdf') {
    //to move the uploaded file to specific location
    $fileUplpaded = move_uploaded_file($tempName, $uploadTo . $fileName);
  } else {
    $errors[] = "file type is invalid";
  }

  if (empty($errors)) {
    //no errors found...adding new record
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobileNo = mysqli_real_escape_string($conn, $_POST['mobileNo']);
    $address1 = mysqli_real_escape_string($conn, $_POST['address1']);
    $frequency = mysqli_real_escape_string($conn, $_POST['frequency']);
    $fullfillment = mysqli_real_escape_string($conn, $_POST['fullfillment']);
    $subsitues = mysqli_real_escape_string($conn, $_POST['subsitues']);
    $days = mysqli_real_escape_string($conn, $_POST['days']);
    $paymentoption = mysqli_real_escape_string($conn, $_POST['paymentoption']);
    $refund = mysqli_real_escape_string($conn, $_POST['refund']);
    $pretxt = mysqli_real_escape_string($conn, $_POST['pretxt']);
    $newaddress = mysqli_real_escape_string($conn, $_POST['newaddress']);

    $query = "INSERT INTO pupload ( ";
    $query .= "uname,email,mobileNo,address1,frequency,fullfillment,substitutes,days,payment,refund,prescriptionTxt,prescriptionFile,newAddress";
    $query .= ") VALUES (";
    $query .= "'{$name}','{$email}','{$mobileNo}','{$address1}','{$frequency}','{$fullfillment}','{$subsitues}','{$days}','{$paymentoption}','{$refund}','{$pretxt}','{$fileName}','{$newaddress}'";
    $query .= ")";

    $result = mysqli_query($conn, $query);

    if ($result) {
      //query unsuccessful.... redirecting to home
      header('location: home.php?prescription_added=true');
    } else {
      $errors[] = 'Failed to add the record';
    }
  }
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
    .presup-main {
      padding: 5%;
    }

    .presup-submit {
      background-color: black;
      color: white;
      padding: 30px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    .presup-submit:hover {
      background-color: #2196f3;
      color: black;
      transition: 0.3s;
    }

    .presup-ytxtarea {
      width: 100%;
    }

    .presup-main img {
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin-top: 6%;
    }

    .errors {
      color: red;
    }
  </style>
  <script src="preupload.js"></script>
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
  <section class="presup-main">
    <h1 class="yhead1">Prescription Upload</h1>
    <br />
    <h3 class="ynote">Note</h3>
    <p>
      Send a photo of your SLMC-registered doctor's medical prescription. Only
      a legitimate prescription image will be accepted for prescription
      medicines. A link for the card payment will be sent to the email
      affiliated with your account once your order is processed by our
      pharmacist.
    </p>
    <br />
    <form action="preupload.php" method="post" enctype="multipart/form-data" onsubmit="reqSuccessful();">

      <input type="hidden" name="name" <?php echo 'value ="' . $_SESSION['name'] . '"'; ?> />

      <input type="hidden" name="email" <?php echo 'value ="' . $_SESSION['email'] . '"'; ?> />

      <input type="hidden" name="mobileNo" <?php echo 'value = "0' . $_SESSION['mobileNo'] . '"'; ?> />

      <input type="hidden" name="address1" <?php echo 'value ="' . $_SESSION['address'] . '"'; ?> />

      <h3>Frequency:</h3>

      <input type="radio" id="yradio" name="frequency" value="One Time" required />
        <label for="yradio">One Time &nbsp </label>
      <input type="radio" id="yradio" name="frequency" value="On Going" required />
        <label for="yradio">On Going</label><br />

      <h3>Fullfillment:</h3>

      <input type="radio" id="yradio" name="fullfillment" value="Full" required />
      <label for="yradio">Full &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</label>
      <input type="radio" id="yradio" name="fullfillment" value="Partial" required />
      <label for="yradio">Partial</label><br />

      <h3>I'm Ok to receive substitutes:</h3>

      <input type="radio" id="yradio" name="subsitues" value="Yes" required />
      <label for="yradio">Yes &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</label>
      <input type="radio" id="yradio" name="subsitues" value="No" required />
      <label for="yradio">No</label><br />

      <h3>For How Many Days:</h3>
      <input type="text" name="days" size="20" placeholder="Enter Time Period..." required />

      <h3>Payment Option:</h3>

      <input type="radio" id="yradio" name="paymentoption" value="Card Payment" required />
        <label for="yradio">Card Payment &nbsp&nbsp &nbsp&nbsp &nbsp </label>
      <input type="radio" id="yradio" name="paymentoption" value="Cash On Delivery" required />
        <label for="yradio">Cash On Delivery</label><br />

      <h3>I prefer receiving any refund as:</h3>
        <input type="radio" id="yradio" name="refund" value="Cash" required />
      <label for="yradio">Cash &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        &nbsp &nbsp &nbsp &nbsp</label>
      <input type="radio" id="yradio" name="refund" value="Online Banking" required />
        <label for="yradio">Online Banking</label><br />

      <h4>
        Enter the Prescription items and quantity - Ex: Crestor 5mg - 10 Qty /
        Crestor 10mg - 10 Qty:
      </h4>

      <textarea class="presup-ytxtarea" name="pretxt" rows="10" cols="100" placeholder="Enter your prescription here..."></textarea>

      <h3>Upload Prescription File:</h3>
      <?php
      if (!empty($errors)) {
        echo "<p class=errors>*invalid file type</p>";
      }
      ?>
      <input type="file" class="yupload" name="fileupload" /><br />
      <p>
        Select a JPG / PNG / PDF file. Once selected, your prescription image
        file is shown above.
      </p>
      <br />

      <h3>Default Shipping Address:</h3>
      <p>Address:</p>
      <p><?php echo $_SESSION['address']; ?></p>

      <h4>Enter a New Address here:</h4>
      <textarea class="presup-ytxtarea" name="newaddress" rows="5" cols="100" placeholder="Enter your new address here..."></textarea>
      <br /><br />
      <input type="submit" name="submit" value="Proceed to Check out" class="presup-submit" />
      <br />
      <img src="/Images/presupload.png" alt="vectorgraphic" />
      <br />
    </form>
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