<?php session_start(); ?>
<?php
//include database connection
require_once 'conn.php';
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
    <link rel="stylesheet" href="/CSS/aboutUs.css"/>
    <link rel="stylesheet" href="/CSS/normalize.css"/>
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
        <form action="aboutUs.php" method="GET">
            <input type="text" placeholder="Search.." name="search"/>
            <button type="submit">Submit</button>
        </form>
        <!--showing the results of search-->
        <div class="dropdown-content" id="drop">
            <?php
            if ($items) {
                echo $itemList;
            }
            ?>
        </div>
    </div>
</div>
<!-- aboutus -->
<section id="aboutusi" class="section-1">
    <div class="aboutusimg">
        <img src="/Images/Aboutus.png" alt="">
    </div>
    <div class="details">
        <h1>About HealthMart</h1>
        <p>
            HealthMart is an online publisher of healthcare media. Through its
            powerful, user-friendly, interactive website, we provide consumers
            with easy-to-read, in-depth, authoritative medical information.
            <br/><br/>
            The organization, headed by a team of professionals, has introduced an
            innovative retail concept centered on exceptional shopper experience
            through service, technology, product offering, pricing and a host of
            value additions. Through this innovative concept HealthMart has gained
            market leadership position in Drug Store Retailing with a loyal
            consumer base. <br/><br/>
            We launched our online pharmacy service to accommodate consumers' busy
            schedules and traffic problems. Customers can use our "HealthMart
            pharmacy online" service to upload medical prescriptions or order
            medical equipment and medications from our "Pharmacy Online service."
            Your order will be delivered to your door by HealthMart's experienced
            and licensed dispenser. Our staff has received training in medical
            product or prescription advice, as well as medical equipment
            demonstration and installation.HealthMart’s core tenet has been to be
            the standard in healthcare retailing. Centered on this belief, our
            business model strives to be more just than an ordinary pharmacy in
            our offerings, format and solutions. Our view of Healthcare Retailing
            is not limited to the narrow focus of pharmaceuticals. To us
            Healthcare Retailing is also about Living Better and Looking Better.
        </p>

        <h2>Our Vision</h2>
        <p>To be Sri Lanka's most admired healthcare retailer.</p>

        <h2>Our Mission</h2>
        <p>
            To provide the Customer and the Community with superior Pharma,
            Wellness, and Beauty solutions.
        </p>
        <br/>
        <div>
            <button class="register" onclick="register();">Register to our website</button>
        </div>
        <br/>
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