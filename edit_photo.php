<?php
session_start();
if (!isset($_SESSION['SESS_MEMBER_ID'])) {
    header("location:Login.php");
}
if (isset($_GET["message"])) {
    $message = $_GET["message"];
    echo "<script>alert('$message')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="DESC MISSING">
        <meta name="author" content="Nick Taggart, nick.taggart@nbcc.ca">
        <link rel="icon" href="favicon.ico">

        <title>Edit profile's photo</title>

        <!-- Bootstrap core CSS -->
        <link href="includes/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="includes/starter-template.css" rel="stylesheet">
        <!-- Bootstrap core JavaScript-->
    </head>
    <body>
        <?php include("includes/header.php");?>
        <br><br><br>
        <form action="edit_photo_proc.php" method="post" enctype="multipart/form-data">
            Select your image (Must be under 1MB in size): 
            <input type="file" accept="image/*" name="pic" required><br><br>
            <input id="button" type="submit" name="submit" value="Submit">
        </form>
    </body>
</html>

