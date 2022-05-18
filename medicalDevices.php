<?php
//include database connection
require_once 'conn.php'; ?>
<?php session_start(); ?>
<?php

$status = "";

if (isset($_POST['code']) && $_POST['code'] != "") {
    // echo $_POST['code'];
    $code = $_POST['code'];
    $result = mysqli_query($conn, "SELECT * FROM `item` WHERE `code`='$code'");
    // echo $result;
    $row = mysqli_fetch_assoc($result);
    $genericName = $row['genericName'];
    $brandName = $row['brandName'];
    $code = $row['code'];
    $itemPrice = $row['itemPrice'];
    $itemImage = $row['itemImage'];

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
        $status = "<script>alert('Product is added to your cart!')</script>";
    } else {
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if (in_array($code, $array_keys)) {
            $status = "<div class=\"productAddedAlert\">
                        Product is already added to your cart!
                        </div>";
        } else {
            $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
            $status = "<script>alert('Product is added to your cart!')</script>";
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
        /* store css-Start*/

        .section-p1 {
            padding: 1px 100px 20px 100px;
            text-align: justify;
        }

        .section-p1 .pro-container {
            display: flex;
            justify-content: space-between;
            padding-top: 20px;
            flex-wrap: wrap;
            flex: 50%;
        }

        .section-p1 .pro {
            width: 15%;
            padding: 10px 10px;
            border: 12px solid #ddd;
            border-radius: 25px;
            cursor: pointer;
            box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.2);
            margin: 15px 0;
            transition: 0.2s ease;
        }

        .section-p1 .pro:hover {
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.6);
        }

        .section-p1 .pro .des {
            text-align: start;
            padding: 10px 0;
            line-height: 0.01em;
            text-align: center;
        }

        .section-p1 .pro .des span {
            color: #404040;
            font-size: 15px;
            line-height: 0.01em;
            text-align: center;
        }

        .section-p1 .pro img {
            width: 100%;
            border-radius: 20px;
        }

        .section-p1 .pro .des h5 {
            padding-top: 2px;
            color: #25262e;
            font-size: 14px;
            line-height: 0.1em;
            text-align: center;
        }

        .section-p1 .pro .des h4 {
            padding-top: 2px;
            font-size: 15px;
            font-weight: 700;
            color: darkgreen;
            line-height: 0.01em;
            text-align: center;
        }

        .section-p1 .pro .des p {
            text-align: center;
        }

        .section-p1 .button {
            border: none;
            color: white;
            padding: 12px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            line-height: 0.01em;
            border-radius: 25px;
            background-color: cadetblue;
        }

        .section-p1 .button:hover {
            background-color: black;
            transition: 0.3s;
        }

        .productAddedAlert {
            text-align: center;
            font-weight: bolder;
        }

        /* store css-End*/
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
    <br>
    <h2>
        <t>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Medical Devices
    </h2>
    <div>
        <?php echo $status; ?>
    </div>
    <section id="product1" class="section-p1">
        <div class="pro-container">

            <?php
            $result = mysqli_query($conn, "SELECT * FROM `item` WHERE `type` = 'medical devices'");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='pro'>
                  <form method='post' action=''>
                  <input type='hidden' name='code' value=" . $row['code'] . " />
                  <img src='itemImg/" . $row['itemImage'] . "' />
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