<?php
//include database connection
require_once 'conn.php'; ?>

<?php
$status = "";
//check if form submitted,
if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $query = "SELECT * FROM newsletter WHERE eMail = '{$email}' LIMIT 1";

    $result_set = mysqli_query($conn, $query);

    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            $status = 'your email address is already subscribed to this service';
            header('location: home.php');
        }
    }
    if (empty($status)) {
        //insert data in to the table
        $sql = "INSERT INTO newsletter(email) VALUES('$email')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            //redirect to home page
            header('location: home.php');
        }
    }
}
?>


<?php
//close connection to database
mysqli_close($conn);
?>