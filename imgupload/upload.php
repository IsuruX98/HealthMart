<?php
$errors = array();
if (isset($_POST['submit'])) {
    //submit button is clicked

    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';

    //file name with a random number so that similar dont get replaced
    $fileName = $_FILES['fileToUpload']['name'];
    $fileType = $_FILES['fileToUpload']['type'];
    $fileSize = $_FILES['fileToUpload']['size'];
    //temporary file name to store file
    $tempName = $_FILES['fileToUpload']['tmp_name'];

    //upload directory path
    $uploadTo = 'images/';

    //checking file type
    if ($fileType == 'image/jpeg' || $fileType == 'image/png' || $fileType == 'application/pdf') {
        //to move the uploaded file to specific location
        $fileUplpaded = move_uploaded_file($tempName, $uploadTo . $fileName);
    } else {
        $errors[] = "file type is invalid";
    }
}
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Image upload</h2>
    Select image to upload:
    <br>
    <?php
    if (!empty($errors)) {
        echo  "<p>invalid file type</p>";
    }
    ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <br>

        <input type="file" name="fileToUpload" id="fileToUpload" />
        <input type="submit" value="Upload Image" name="submit" />
    </form>
</body>

</html>