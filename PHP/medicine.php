<?php
//include database connection
require_once 'conn.php'; ?>
<?php session_start(); ?>
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
<?php

$status = "";
//add to cart process
if (isset($_POST['code']) && $_POST['code'] != "") {

    $code = $_POST['code'];
    $result = mysqli_query($conn, "SELECT * FROM `item` WHERE `code`='$code'");
    //loop through the item table and gathering details of the item
    $row = mysqli_fetch_assoc($result);
    $genericName = $row['genericName'];
    $brandName = $row['brandName'];
    $code = $row['code'];
    $itemPrice = $row['itemPrice'];
    $itemImage = $row['itemImage'];
//storing them in an array
    $cartArray = array(
        $code => array(
            'genericName' => $genericName,
            'brandName' => $brandName,
            'code' => $code,
            'itemPrice' => $itemPrice,
            'quantity' => 1,
            'itemImage' => $itemImage,
        ),
    );
    if (empty($_SESSION["shopping_cart"])) {
        $_SESSION["shopping_cart"] = $cartArray;
        $status = "Product is added to your cart!";
    } else {
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if (in_array($code, $array_keys)) {
            $status = "<p class=\"red\">Product is already added to your cart!<p>";
        } else {
            $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
            $status = "Product is added to your cart!";
        }
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
        <link rel="stylesheet" href="/CSS/store.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>
        <!--stylesheet for icons in footer -->
        <script src="/JS/home.js"></script>
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
            <form action="medicine.php" method="GET">
                <input type="text" placeholder="Search.." name="search"/>
                <button type="submit">Submit</button>
            </form>
            <div class="dropdown-content" id="drop">
                <?php
                //display searched items
                if ($items) {
                    echo $itemList;
                }
                ?>
            </div>
        </div>
    </div>
    <br>
    <h2>
        <t>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Medicines
    </h2>
    <!--display messages from the add to cart process-->
    <div class="status" id="status1">
        <?php echo $status; ?>
    </div>
    <section id="product1" class="section-p1">
        <div class="pro-container">

            <?php
            $result = mysqli_query($conn, "SELECT * FROM `item` WHERE `type` = 'medicine'");
            //loop through the item table and gather details of the item and printing them
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='pro'>
                  <form method='post' action=''>
                  <input type='hidden' name='code' value=" . $row['code'] . " />
                  <img src='/Images/itemImg/" . $row['itemImage'] . "' />
                  <div class='des'>
                  <span>" . $row['genericName'] . "</span>
                  <h5>" . $row['brandName'] . "</h5>
                  <h4>Rs. " . $row['itemPrice'] . "</h4>
                  <button type='submit' class='button'>Add to Cart</button>
                  </div>
                  </form>
                     </div>";
            }
            ?>
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