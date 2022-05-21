<?php session_start(); ?>
<?php
//include database connection
require_once 'conn.php'; ?>
<?php
//checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location: loginForm.php');
}
$viewCartOrders = '';

//getting the list of Cart orders
$query = "SELECT * FROM cart ORDER BY CID DESC";
$CartOrders = mysqli_query($conn, $query);

if ($CartOrders) {
    //loop through the cart table and getting all the details as a table
    while ($CartOrder = mysqli_fetch_assoc($CartOrders)) {
        $viewCartOrders .= "<tr>";
        $viewCartOrders .= "<td>{$CartOrder['CID']}</td>";
        $viewCartOrders .= "<td>{$CartOrder['uname']}</td>";
        $viewCartOrders .= "<td>{$CartOrder['email']}</td>";
        $viewCartOrders .= "<td>{$CartOrder['mobileNo']}</td>";
        $viewCartOrders .= "<td>{$CartOrder['address1']}</td>";
        $viewCartOrders .= "<td>{$CartOrder['payment']}</td>";
        $viewCartOrders .= "<td>{$CartOrder['newAddress']}</td>";
        $viewCartOrders .= "<td>{$CartOrder['itemsAndQuantity']}</td>";
        $viewCartOrders .= "<td>{$CartOrder['Ordered-date-and-Time']}</td>";
        $viewCartOrders .= "</tr>";
    }
} else {
    echo "Database query failed.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>healthmart.com</title>
    <link rel="shortcut icon" href="/Images/logo.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="/CSS/template2.css"/>
    <link rel="stylesheet" href="/CSS/normalize.css"/>
    <link rel="stylesheet" href="/CSS/viewcartorders.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>
    <!--stylesheet for icons in footer -->
    <script src="/JS/admindashboard.js"></script>
</head>

<body>
<div class="header">
    <a href="#default" class="logo"><i class="far fa-eye"></i> HealthMart</a>
    <div class="header-right">
        <a href="#" onclick="adminDashBoard();"><i
                    class="far fa-user-circle"> </i>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['name']; ?></a>
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
<main class="viewCartOrders-main">
    <h2>Cart Order list</h2>
    <br/>
    <table class="viewCartOrders">
        <tr>
            <th>Cart Order ID</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Mobile No</th>
            <th>Address</th>
            <th>Payment</th>
            <th>New Address</th>
            <th>Items and Quantity</th>
            <th>Added date and time</th>

        </tr>
        <!--printing the table-->
        <?php echo $viewCartOrders; ?>
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