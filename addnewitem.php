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
if (isset($_POST['submit'])) {
  $genericname = $_POST['genericname'];
  $brandname = $_POST['brandname'];
  $code = $_POST['code'];
  $itmprice = $_POST['itmprice'];
  $type = $_POST['type'];

  //getting the details of the file that uploaded
  $fileName = $_FILES['itemImgUpload']['name'];
  $fileType = $_FILES['itemImgUpload']['type'];
  $fileSize = $_FILES['itemImgUpload']['size'];
  //temporary file name to store file
  $tempName = $_FILES['itemImgUpload']['tmp_name'];

  //upload directory path
  $uploadTo = 'itemImg/';

  //checking file type
  if ($fileType == 'image/jpeg' || $fileType == 'image/png') {
    //to move the uploaded file to specific location
    $fileUplpaded = move_uploaded_file($tempName, $uploadTo . $fileName);
  } else {
    $errors[] = "file type is invalid";
  }

  //checking item already exists
  $item = mysqli_real_escape_string($conn, $genericname);
  $query = "SELECT * FROM item WHERE genericName = '{$item}'LIMIT 1";

  $result_set = mysqli_query($conn, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set) == 1) {
      $errors[] = 'item address already exists';
    }
  }

  if (empty($errors)) {
    //no errors found...adding new record
    $genericname = mysqli_real_escape_string($conn, $_POST['genericname']);
    $brandname = mysqli_real_escape_string($conn, $_POST['brandname']);
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $itmprice = mysqli_real_escape_string($conn, $_POST['itmprice']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);

    $query = "INSERT INTO item ( ";
    $query .= "genericName,brandName,code,itemPrice,itemImage,type";
    $query .= ") VALUES (";
    $query .= "'{$genericname}','{$brandname}','{$code}','{$itmprice}','{$fileName}','{$type}'";
    $query .= ")";

    $result = mysqli_query($conn, $query);

    if ($result) {
      //query unsuccessful.... redirecting to home
      header('location: admindashboard.php?item_added=true');
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
    .addNewItemPage {
      padding: 50px;
    }

    .addNewItemPage hr {
      border: 1px solid #f1f1f1;
      margin-bottom: 25px;
    }

    .addNewItemPage form {
      border: 3px solid #f1f1f1;
      padding: 25px;
    }

    .addNewItemPage input[type="text"] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .addNewItemPage-container button {
      background-color: #25262e;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    .addNewItemPage-container button:hover {
      background-color: #2196f3;
      color: black;
      transition: 0.3s;
    }

    .cancelbtn-container .cancelbtn {
      width: 100%;
      padding: 10px 18px;
      background-color: #f44336;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      color: white;
    }

    .cancelbtn-container button:hover {
      color: black;
      transition: 0.3s;
    }
  </style>
  <script src="admindashboard.js"></script>
  <script src="addnewitem.js"></script>
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
  <div class="addNewItemPage">
    <form action="addnewitem.php" method="post" enctype="multipart/form-data" onsubmit="additem();">
      <div class="addNewItemPage-container">
        <h1>Add New Item</h1>
        <hr />
        <label for="genericname"><b>Generic Name</b></label>
        <input type="text" placeholder="Enter generic name of the item " name="genericname" required />

        <label for="brandname"><b>Brand Name</b></label>
        <input type="text" placeholder="Enter Brand name of the item" name="brandname" required />

        <label for="code"><b>Code</b></label>
        <input type="text" placeholder="Enter Code of the item" name="code" required />

        <label for="itmprice"><b>Price Rs.</b></label>
        <input type="text" placeholder="Enter Price of the item" name="itmprice" required />

        <h3>Type :</h3>
          <label for="medicine">medicine</label>
        <input type="radio" id="medicine" name="type" value="medicine" />
         <label for="medicine">medical devices</label>
        <input type="radio" id="medical-devices" name="type" value="medical devices" />
          <label for="medicine">traditional remedies</label>
        <input type="radio" id="traditional-remedies" name="type" value="traditional remedies" />
         

        <h3>Upload Image for the Item :</h3>
        <?php
        if (!empty($errors)) {
          echo "<p class=errors>*invalid file type</p>";
        }
        ?>
        <input type="file" class="itemImgUpload" name="itemImgUpload" /><br />
        <p>
          Select a JPG / PNG . Once selected, your image
          file is shown above.
        </p>
        <br />

        <button type="submit" name="submit">Submit</button>
      </div>

      <div class="cancelbtn-container">
        <button type="button" class="cancelbtn">Cancel</button>
      </div>
    </form>
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