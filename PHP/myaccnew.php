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
$itemList = '';
$items = '';
$errors = array();
//check if there is a search term
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM item WHERE (genericName LIKE '%{$search}%' OR brandName LIKE '%{$search}%') AND isDeleted = 0 ORDER BY genericName";

    $items = mysqli_query($conn, $query);
    if ($items) {
        //loop through the database and find a match
        while ($item = mysqli_fetch_assoc($items)) {
            $itemList .= "<a href=\"searchedItem.php?item_ID={$item['itemID']}\">{$item['genericName']} / {$item['brandName']}</a>";
        }
    } else {
        //if there is an error
        $errors[] = 'Database query failed.';
    }
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
        <link rel="stylesheet" href="/CSS/myaccnew.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>
        <!--stylesheet for icons in footer -->
        <script src="/JS/home.js"></script>
        <script src="/JS/cancel.js"></script>
    </head>

    <body>
    <div class="header">
        <a href="#" onclick="home();" class="logo"><i class="far fa-eye"></i> HealthMart</a>
        <div class="header-right">
            <?php
            //if there is a user display username
            if (isset($_SESSION['user_id'])) {
                echo "<a onclick=\"myacc();\"><i class=\"far fa-user-circle\"> </i>&nbsp;&nbsp;&nbsp;";
                echo $_SESSION['name'] . "</a>";
            } else {
                //if the user is not a registered user display a register button
                echo "<a onclick=\"register();\"><i class=\"far fa-user-circle\"></i> Sign in</a>";
            }
            ?>
            <?php
            //display the shopping cart button if there is at least one item added to cart
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
        <div class="menu-links">
            <a class="active" href="#" onclick="home();"><i class="fa fa-fw fa-home"></i> Home</a>
            <a href="#" onclick="medicine();">Medicines</a>
            <a href="#" onclick="medicalDevices();">Medical Devices</a>
            <a href="#" onclick="traditionalRemedies();">Traditional Remedies</a>
            <a href="#" onclick="aboutUs();">About us</a>
        </div>
        <div class="search-container">
            <form action="myaccnew.php" method="GET">
                <input type="text" placeholder="Search.." name="search"/>
                <button type="submit">Submit</button>
            </form>
            <div class="dropdown-content" id="drop">
                <!--showing the results of search-->
                <?php
                if ($items) {
                    echo $itemList;
                }
                ?>
            </div>
        </div>
    </div>
    <!--MY Account-->
    <div class="ymyacc">
        <div class="ymyaccleft">
            <h1>My Profile</h1>

            <h4>Account Information</h4>

            <hr/>

            <h4>Contact Information</h4>
            <!--getting user details from session variables that created from the loginForm-->
            <p>Name : <?php echo $_SESSION['name']; ?></p>
            <p>E-mail : <?php echo $_SESSION['email']; ?></p>
            <p>Mobile Number: 0<?php echo $_SESSION['mobileNo']; ?></p>

            <br/>

            <h4>Address Book</h4>

            <hr/>

            <p>Address</p>

            <p>
                <?php echo $_SESSION['address']; ?>
            </p>
            <br/>

            <div class="myacc-btnbox">
                <button class="myacc-editbtn"><?php echo "<a href=\"editacc.php?user_ID={$_SESSION['user_id']}\">Edit Account Infomation</a> "; ?></button>
                <button type="submit" name="changepw"
                        class="myacc-changepwbtn"><?php echo "<a href=\"changepw.php?user_ID={$_SESSION['user_id']}\">Change Password</a> "; ?></button>
                <button class="myacc-logoutbtn" onclick="return confirm('Are you sure you want to Log Out ?');"><a
                            href="logout.php">Log Out</a></button>
            </div>
        </div>
        <div class="ymyaccright">
            <img src="/Images/myacc.jpg" alt=""/>
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
                    <input type="email" placeholder="Your email id here"/>
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