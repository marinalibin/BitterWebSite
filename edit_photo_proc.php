<?php

//this file will handle the file uploading and return the user back to the edit_photo page.
include("connect.php");
include ("User.php");
session_start();


if (isset($_POST['submit'])) {
    if (empty($_FILES['pic']['name'])) {
        $check = getimagesize($_FILES["pic"]["name"]);
        
        $msg = "ERROR: You must select a file";
        header("location:edit_photo.php?message=$msg");
    }
    $u = new User();
    $u->userId = $_SESSION["SESS_MEMBER_ID"];
    $u->profImg= $_SESSION["SESS_MEMBER_PIC"];


    if($u->ValidateIMG()){
          $message = "Image uploaded successfully";
          header("location:index.php?message=$message");
    }
    else{
         $message = "Data base error";
         header("location:edit_photo.php?message=$message");
    }
}
?>
