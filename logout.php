<?php

//starting the session
session_start();

//make the session variable into an empty array
$_SESSION = array();

//cookie removing process
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
}

//destroying the session
session_destroy();

//redirecting to home page
header('location: loginForm.php');
