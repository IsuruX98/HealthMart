<?php session_start(); ?>
<?php
//include database connection
require_once 'conn.php'; ?>
<?php
//checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location: loginForm.php');
}

if (isset($_GET['item_ID'])) {
    //getting the item information
    $item_ID = mysqli_real_escape_string($conn, $_GET['item_ID']);

    //deleting the item
    $query = "DELETE FROM item WHERE itemID = {$item_ID} LIMIT 1";

    $result = mysqli_query($conn, $query);
    if ($result) {
        //item deleted
        header('Location: itemlist.php?msg=item_deleted');
    } else {
        header('Location: itemlist.php?msg=delete_failed');
    }
} else {
    header('Location: itemlist.php');
}
?>