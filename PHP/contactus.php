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
//check if form submitted,
if (isset($_POST['csubmit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobileNo = $_POST['mobileNo'];
    $userIdeas = $_POST['userIdeas'];


    //insert data in to the table
    $sql = "INSERT INTO contactus(uname,email,mobileNo,userIdeas) VALUES('$name','$email','$mobileNo','$userIdeas')";

    $result = mysqli_query($conn, $sql);

    //redirect to home page
    header('location: home.php');
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
        <link rel="stylesheet" href="/CSS/contactus.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>
        <!--stylesheet for icons in footer -->
        <script src="/JS/home.js"></script>
        <script src="/JS/contactus.js"></script>
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
            <form action="contactus.php" method="GET">
                <input type="text" placeholder="Search.." name="search"/>
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
    <div class="flex-container-contactus">
        <div class="flex-container-contactus-left">


            <div class="contactus-form">
                <h2>Contact Us</h2>
                <form action="contactus.php" method="POST" onsubmit="contactus();">
                    <label for="Name"><b>Name</b></label>
                    <input type="text" name="name" required/>
                    <label for="Email"><b>Email</b></label>
                    <input type="email" name="email" required/>
                    <label for="Mobilenumber"><b>Mobile number</b></label>
                    <input type="text" name="mobileNo"/>
                    <p>
                        <label for="Whatisonyourmind">What is on your mind....</label>
                    </p>
                    <textarea id="userIdeas" name="userIdeas" rows="8" cols="50" required></textarea>
                    <br/>
                    <button type="submit" name="csubmit">Submit</button>
                </form>
            </div>


        </div>
        <div class="flex-container-contactus-right">
            <div class="flex-container-contactus-right-up-down">
                <div class="flex-container-contactus-right-up">
                    <div class="getintouch">
                        <h2>Get in Touch</h2>
                        <h3>HealthMart Pharmacy Limited</h3>
                        <h3>Address</h3>
                        <p>No 139/A Vihara Mawatha. Malabe, Sri Lanka.</p>
                        <h3>Tel:</h3>
                        <p>+94 76 447 7777</p>
                        <h3>E mail:</h3>
                        <p>healthmart.Ik</p>
                    </div>
                </div>
                <div class="flex-container-contactus-right-down">
                    <img src="/Images/contactus.png" alt="contactuspng"/>
                </div>
            </div>
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