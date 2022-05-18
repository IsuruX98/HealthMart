<?php session_start(); ?>
<?php
//include database connection
require_once 'conn.php'; ?>
<?php
//check for form submission
if (isset($_POST['submit'])) {

    $errors = array();
    //check if the username and password has been entered

    if (!isset($_POST['uname']) || strlen(trim($_POST['uname'])) < 1) {
        $errors[] = 'Username is missing / invalid';
    }
    if (!isset($_POST['psw']) || strlen(trim($_POST['psw'])) < 1) {
        $errors[] = 'Password is missing / invalid';
    }
    //check if there are any errors in the form
    if (empty($errors)) {
        //save username and password into variables
        $username = mysqli_real_escape_string($conn, $_POST['uname']);
        $password = mysqli_real_escape_string($conn, $_POST['psw']);
        $hashed_password = sha1($password);

        //prepare database query
        $query = "SELECT * FROM hmuser WHERE eMailAddress = '{$username}'
        AND UPW = '{$hashed_password}'
        LIMIT 1";

        $result_set = mysqli_query($conn, $query);

        if (mysqli_num_rows($result_set) > 0) {
            $row = mysqli_fetch_array($result_set);

            if ($row['hmRole'] == 'User') {

                $_SESSION['user_id'] = $row['hmUID'];
                $_SESSION['name'] = $row['uName'];
                $_SESSION['email'] = $row['eMailAddress'];
                $_SESSION['mobileNo'] = $row['uMobileNo'];
                $_SESSION['address'] = $row['uAddress'];


                header('location: home.php');
            } else if ($row['hmRole'] == 'Admin') {

                $_SESSION['user_id'] = $row['hmUID'];
                $_SESSION['name'] = $row['uName'];
                $_SESSION['email'] = $row['eMailAddress'];
                $_SESSION['mobileNo'] = $row['uMobileNo'];
                $_SESSION['address'] = $row['uAddress'];

                header('location: admindashboard.php');
            }
        } else {
            $errors[] = "Invalid username or password";
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
        .LoginPage {
            padding: 50px;
        }

        .LoginPage hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        .LoginPage form {
            border: 3px solid #f1f1f1;
            padding: 25px;
        }

        .LoginPage input[type="text"],
        .LoginPage input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .login-container button {
            background-color: #25262e;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .login-container button:hover {
            background-color: #2196f3;
            color: black;
            transition: 0.3s;
        }

        .pw-container .cancelbtn {
            width: 100%;
            padding: 10px 18px;
            background-color: #f44336;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            color: white;
        }

        .pw-container button:hover {
            color: black;
            transition: 0.3s;
        }

        .login-container span.psw {
            float: right;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .mother-left-right {
            display: flex;
            flex-direction: row;
        }

        .child-left {
            flex: 80%;
            padding: 20px;
        }

        .child-right {
            flex: 50%;
            padding: 20px;
        }

        .child-right img {
            width: 100%;
            padding: 20px;
            margin-top: 5%;
        }

        .not-member {
            float: right;
            padding: 10px;
            font-weight: bolder;
        }

        .not-member a {
            text-decoration: none;
        }

        @media screen and (max-width: 800px) {
            .mother-left-right {
                flex-direction: column;
            }

            .child-right img {
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

    <div class="mother-left-right">
        <div class="child-left">
            <div class="LoginPage">
                <form action="loginForm.php" method="post">
                    <div class="login-container">
                        <h1>Login</h1>
                        <p>Alredy a member please login</p>
                        <hr />
                        <?php
                        if (isset($errors) && !empty($errors)) {
                            echo '<p class="error">Invalid Username or password</p>';
                        }
                        ?>
                        <label for="uname"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="uname" required />

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required />

                        <div class="not-member"><a href="#">Not a member : register here</a></div>
                        <button type="submit" name="submit">Login</button>
                    </div>

                    <div class="pw-container">
                        <button type="button" class="cancelbtn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="child-right"><img src="/Images/login.jpg"></div>
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
//close connection to database
mysqli_close($conn);
?>