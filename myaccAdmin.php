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
    <link rel="stylesheet" href="/CSS/myaccAdmin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <!--stylesheet for icons in footer -->
    <script src="/JS/home.js"></script>
    <script src="/JS/admindashboard.js"></script>
    <script src="/JS/cancel.js"></script>
</head>

<body>
    <div class="header">
        <a href="#default" class="logo"><i class="far fa-eye"></i> HealthMart</a>
        <div class="header-right">
            <?php
            if (isset($_SESSION['user_id'])) {
                echo "<a onclick=\"myaccAdmin();\"><i class=\"far fa-user-circle\"> </i>&nbsp;&nbsp;&nbsp;";
                echo $_SESSION['name'] . "</a>";
            }
            ?>
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
    <!--Admin Account-->
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
                <button class="myacc-editbtn"><?php echo "<a href=\"editAdminAcc.php?user_ID={$_SESSION['user_id']}\">Edit Account Infomation</a> "; ?></button>
                <button type="submit" name="changepw" class="myacc-changepwbtn"><?php echo "<a href=\"changepwAdmin.php?user_ID={$_SESSION['user_id']}\">Change Password</a> "; ?></button>
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