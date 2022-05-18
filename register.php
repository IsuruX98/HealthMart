<?php
//include database connection
require_once 'conn.php';
$errors = array();
if (isset($_POST['submit'])) {
    $uName = $_POST['Name'];
    $uEmail = $_POST['email'];
    $uMobileNo = $_POST['MoblieNo'];
    $uAddress = $_POST['address'];
    $city = $_POST['city'];
    $PSW = $_POST['psw'];
    $CPSW = $_POST['psw-repeat'];

    //checking email address already exists
    $uEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $query = "SELECT * FROM hmuser WHERE eMailAddress = '{$uEmail}' LIMIT 1";

    $result_set = mysqli_query($conn, $query);

    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            $errors[] = 'email address already exists';
        }
    }
    if ($PSW != $CPSW) {
        $errors[] = 'password mismatch';
    }

    if (empty($errors)) {
        //no errors found...adding new record
        $uName = mysqli_real_escape_string($conn, $_POST['Name']);
        $uEmail = mysqli_real_escape_string($conn, $_POST['email']);
        $uMobileNo = mysqli_real_escape_string($conn, $_POST['MoblieNo']);
        $uAddress = mysqli_real_escape_string($conn, $_POST['address']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $PSW = mysqli_real_escape_string($conn, $_POST['psw']);
        $hashedPassword = sha1($PSW);

        $query = "INSERT INTO hmuser ( ";
        $query .= "uName,eMailAddress,uMobileNo,uAddress,city,UPW";
        $query .= ") VALUES (";
        $query .= "'{$uName}','{$uEmail}','{$uMobileNo}','{$uAddress}','{$city}','{$hashedPassword}'";
        $query .= ")";

        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('registration successful, please login using your credentials')</script>";
            //query unsuccessful.... redirecting to loginForm
            header('location: loginForm.php?item_added=true');
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
        .Sign-Up {
            padding: 50px;
        }

        .signup-container input[type="text"],
        .signup-container input[type="email"],
        .signup-container input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        .signup-container input[type="text"]:focus,
        .signup-container input[type="email"]:focus,
        .signup-container input[type="password"]:focus {
            background-color: #ddd;
            outline: none;
        }

        .signup-container hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        .signup-container button {
            background-color: black;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .signupfrom-buttons .signupbtn:hover {
            background-color: #2196f3;
            color: black;
            transition: 0.3s;
        }

        .signupfrom-buttons .cancelbtn {
            padding: 14px 20px;
            background-color: #f44336;
        }

        .signupfrom-buttons .cancelbtn:hover {
            color: black;
            transition: 0.3s;
        }

        .signup-container {
            padding: 16px;
            margin: 16px;
            margin-bottom: 50px;
        }

        /* Clear floats */
        .Sign-Up .signupfrom-buttons::after {
            content: "";
            clear: both;
            display: table;
        }

        .error {
            color: #f44336;
        }

        .register-mother-left-right {
            display: flex;
            flex-direction: row;
        }

        .register-child-left {
            flex: 50%;
            padding: 20px;
        }

        .register-child-right {
            flex: 60%;
            padding: 20px;
        }

        .register-child-left img {
            width: 100%;
            padding: 20px;
            margin: auto;
            display: block;
            margin-top: 30%;
        }

        @media screen and (max-width: 800px) {
            .register-mother-left-right {
                flex-direction: column-reverse;
            }

            .register-child-right img {
                width: 100%;
                margin: auto;
            }
        }
    </style>
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
    <div class="register-mother-left-right">
        <div class="register-child-left">
            <img src="/Images/register.png">
        </div>
        <div class="register-child-right">
            <div class="Sign-Up">
                <form action="register.php" method="POST" name="RegForm" enctype="multipart/form-data">
                    <div class="signup-container">
                        <h1>Sign Up</h1>
                        <p>Please fill in this form to create an account.</p>
                        <hr />
                        <!-- display error messages from php validation -->
                        <?php
                        if (!empty($errors)) {
                            echo '<div class="error">';
                            echo '<b>There were error(s) on your form.</b><br>';
                            echo "<script>alert('There were error(s) on your form!')</script>";
                            foreach ($errors as $error) {
                                echo $error . '<br>';
                            }
                            echo '</div><br>';
                        }
                        ?>
                        <p>
                            <label for="Name"><b>Full Name</b></label>
                            <input type="text" placeholder="Enter your full name" name="Name" required />
                            <label for="email"><b>Email</b></label>
                            <input type="email" placeholder="Enter Email" name="email" required />
                            <label for="MoblieNo"><b>Mobile Number</b></label>
                            <input type="text" placeholder="Enter your mobile number" name="MoblieNo" required />
                            <label for="address"><b>Address</b></label>
                            <input type="text" placeholder="Enter your address" name="address" required />
                            <label for="city"><b>City</b></label>
                            <input type="text" placeholder="Enter your city" name="city" />
                            <label for="psw"><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" minlength="8" required />
                            <label for="psw-repeat"><b>Repeat Password</b></label>
                            <input type="password" placeholder="Repeat Password" name="psw-repeat" required />
                        <p>
                            By creating an account you agree to our
                            <a href="#">Terms & Privacy</a>.
                        </p>
                        <div class="signupfrom-buttons">
                            <button type="submit" class="signupbtn" name="submit">Sign Up</button>
                            <button type="button" class="cancelbtn">Cancel</button>
                        </div>
                    </div>
                </form>
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
//close database connection
mysqli_close($conn); ?>