<?php session_start(); ?>
<?php
//include database connection
require_once 'conn.php'; ?>
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
        while ($item = mysqli_fetch_assoc($items)) {
            $itemList .= "<a href=\"searchedItem.php?item_ID={$item['itemID']}\">{$item['genericName']} / {$item['brandName']}</a>";
        }
    } else {
        $errors[] = 'Database query failed.';
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
    <link rel="stylesheet" href="/CSS/privacyPolicy.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <!--stylesheet for icons in footer -->
    <script src="/JS/home.js"></script>
</head>

<body>
    <div class="header">
        <a href="#" onclick="home();" class="logo"><i class="far fa-eye"></i> HealthMart</a>
        <div class="header-right">
            <?php
            if (isset($_SESSION['user_id'])) {
                echo "<a onclick=\"myacc();\"><i class=\"far fa-user-circle\"> </i>&nbsp;&nbsp;&nbsp;";
                echo $_SESSION['name'] . "</a>";
            } else {
                echo "<a onclick=\"register();\"><i class=\"far fa-user-circle\"></i> Sign in</a>";
            }
            ?>
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
        <div class="menu-links">
            <a class="active" href="#" onclick="home();"><i class="fa fa-fw fa-home"></i> Home</a>
            <a href="#" onclick="medicine();">Medicines</a>
            <a href="#" onclick="medicalDevices();">Medical Devices</a>
            <a href="#" onclick="traditionalRemedies();">Traditional Remedies</a>
            <a href="#" onclick="aboutUs();">About us</a>
        </div>
        <div class="search-container">
            <form action="privacyPolicy.php" method="GET">
                <input type="text" placeholder="Search.." name="search" />
                <button type="submit">Submit</button>
            </form>
            <div class="dropdown-content" id="drop">
                <?php
                if ($items) {
                    echo $itemList;
                }
                ?>
            </div>
        </div>
    </div>
    <div class="privacy">
        <br />
        <br />
        <h1>Privacy Policy</h1>
        <br />
        <h2>Information We Collect</h2>
        <p>
            We collect your personal or contact information solely for the purpose
            of processing your orders and ensuring that you receive them in a timely
            manner. To make our online store more user pleasant and customised for
            our users or customers, we gather or collect information about your
            technical equipment, such as visiting our store or on-site behavior. In
            order to provide you with the best customer service possible, our online
            store collaborates with third-party firms. These third-party firms only
            utilize a small portion of the personal information you provide on our
            site, and they only need it to fulfill their obligations. <br /><br />
            Payment services authenticate and execute your payments for the things
            you buy on our site using your credit card number, name, and surname.<br /><br />
            Our manufacturers and stockkeepers assemble the necessary order for you
            using the data from your order contents. Your first name, surname name,
            and physical address are used by postal services to deliver the product
            to you. <br /><br />If you continue to browse our webstore after reading
            this Privacy Policy, you consent to us using your personal information
            for the purposes described above.<br /><br />
            Please exit the website immediately if you do not agree to these
            terms..!
        </p>
        <br />
        <h2>Use Of Cookies</h2>
        <p>
            We provide high-quality, effective medication right to your door. At our
            pharmacy, there is no place for fraud or unlawful tactics, as we want to
            build and maintain good relationships with our customers.

            <br /><br />
            Our primary goal is to ensure that our clients are satisfied with our
            efficient and proper approach, as well as the confidentiality of their
            personal information. We offer a large choice of FDA-approved generic
            and branded medications at affordable prices and with significant
            discounts. Customers frequently cancel previously placed orders for a
            variety of reasons, and this is authorized only to a certain extent.

            <br /><br />
            Cancelling an order that has already been placed should be done within
            12–24 hours after placing it. <br /><br />
            Your cancellation request should be made to healthmart.com through
            email. <br />
            After 24 hours from the moment you placed your order, no cancellation
            requests will be accepted. <br /><br />Thank you so much for your help!
        </p>
        <br />
        <br />
        <br />
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