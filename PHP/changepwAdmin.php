<?php session_start(); ?>
<?php
//checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location: loginForm.php');
}
?>
<?php
//include database connection
require_once 'conn.php';
$errors = array();
$PSW = '';
$CPSW = '';

if (isset($_GET['user_ID'])) {
    //getting the user information
    $user_ID = mysqli_real_escape_string($conn, $_GET['user_ID']);
    $query = "SELECT * FROM hmuser WHERE hmUID = {$user_ID} LIMIT 1";

    $result_set = mysqli_query($conn, $query);
    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            //user found
            $result = mysqli_fetch_assoc($result_set);
            $PSW = $result['UPW'];
        } else {
            //user not found
            header('Location: myaccAdmin.php?err=user_not_found');
        }
    } else {
        //query unsuccessful
        header('Location: myaccAdmin.php?err=query_failed');
    }
}
if (isset($_POST['submit'])) {
    $user_ID = $_POST['user_ID'];
    $PSW = $_POST['psw'];
    $CPSW = $_POST['psw-repeat'];

    if ($PSW != $CPSW) {
        $errors[] = 'password mismatch';
    }

    if (empty($errors)) {
        //no errors found...update new record
        $PSW = mysqli_real_escape_string($conn, $_POST['psw']);
        $hashedPassword = sha1($PSW);

        $query = "UPDATE hmuser SET ";
        $query .= "UPW = '{$hashedPassword}'";
        $query .= "WHERE hmUID = {$user_ID} LIMIT 1";

        $result = mysqli_query($conn, $query);

        if ($result) {
            //query unsuccessful.... redirecting to loginForm
            header('location: loginForm.php?password_updated=true');
        } else {
            $errors[] = 'Failed to update the record';
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
        <link rel="stylesheet" href="/CSS/changepw.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>
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
            //showing admin name
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
    <div class="register-mother-left-right">
        <div class="register-child-left">
            <img src="/Images/register.png">
        </div>
        <div class="register-child-right">
            <div class="Sign-Up">
                <form action="changepwAdmin.php" method="POST" name="RegForm" enctype="multipart/form-data">
                    <div class="signup-container">
                        <h1>Change Password</h1>
                        <p>Please fill this form to update your password.</p>
                        <hr/>
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
                            <input type="hidden" name="user_ID" value="<?php echo $user_ID; ?>"/>
                            <label for="psw"><b>Enter New Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" minlength="8" required/>
                            <label for="psw-repeat"><b>Repeat New Password</b></label>
                            <input type="password" placeholder="Repeat Password" name="psw-repeat" required/>
                        <p>

                        </p>
                        <div class="signupfrom-buttons">
                            <button type="submit" class="signupbtn" name="submit"
                                    onclick="return confirm('Are you sure you want to update your Password?');">Update
                                Password
                            </button>
                            <button type="button" class="cancelbtn" onclick="cancel();">Cancel</button>
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
//close database connection
mysqli_close($conn); ?>