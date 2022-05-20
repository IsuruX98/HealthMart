<?php session_start(); ?>
<?php
//include database connection
require_once 'conn.php'; ?>
<?php
//checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
  header('location: loginForm.php');
}
$itemList = '';

//check if there is a search term
if (isset($_GET['search'])) {
  $search = mysqli_real_escape_string($conn, $_GET['search']);
  $query = "SELECT * FROM item WHERE (genericName LIKE '%{$search}%' OR brandName LIKE '%{$search}%' OR itemPrice LIKE '%{$search}%') AND isDeleted = 0 ORDER BY genericName";
} else {
  //getting the list of items
  $query = "SELECT * FROM item WHERE isDeleted = 0 ORDER BY genericName";
}

$items = mysqli_query($conn, $query);

if ($items) {
  while ($item = mysqli_fetch_assoc($items)) {
    $itemList .= "<tr>";
    $itemList .= "<td>{$item['genericName']}</td>";
    $itemList .= "<td>{$item['brandName']}</td>";
    $itemList .= "<td>{$item['itemPrice']}</td>";
    $itemList .= "<td>{$item['type']}</td>";
    $itemList .= "<td><button class=\"itemListEditBtn\"><a href=\"modifyItem.php?item_ID={$item['itemID']}\">Edit</a></button></td>";
    $itemList .= "<td><button class=\"itemListDltBtn\"><a href=\"deleteItem.php?item_ID={$item['itemID']}\" onclick=\"return confirm('Are you sure you want to delete this item ?');\">Delete</a></button></td>";
    $itemList .= "</tr>";
  }
} else {
  echo "Database query failed.";
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
  <link rel="stylesheet" href="/CSS/itemlist.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
  <!--stylesheet for icons in footer -->
  <script src="/JS/admindashboard.js"></script>
</head>

<body>
  <div class="header">
    <a href="#default" class="logo"><i class="far fa-eye"></i> HealthMart</a>
    <div class="header-right">
      <a href="#" onclick="adminDashBoard();"><i class="far fa-user-circle"> </i>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['name']; ?></a>
    </div>
  </div>
  <div class="menu">
    <div class="menu-links">
      <a class="active" onclick="adminDashBoard();"><i class="fa fa-fw fa-home"></i> Home</a>
      <a href="#" onclick="addnewItem();">Add New Items</a>
      <a href="#" onclick="viewItems();">View Items, Update & Delete</a>
      <a href="#" onclick="viewContactUs();">View Contact Us</a>
      <a href="#" onclick="viewPreupOrders();">View Prescription Orders</a>
      <a href="#" onclick="viewCartOrders();">View Cart Orders</a>
    </div>
    <div class="search-container">

    </div>
  </div>
  <main class="itemList-main">
    <h2>Item list</h2>

    <div class="search">
      <form action="itemlist.php" method="GET">
        <p><input type="text" name="search" id="searchbox" placeholder="search here....and press enter" autofocus required></p>
      </form>
    </div>

    <table class="itemList">
      <tr>
        <th>Generic Name</th>
        <th>Brand Name</th>
        <th>Price Rs.</th>
        <th>Type</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      <?php echo $itemList; ?>
    </table>
  </main>
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