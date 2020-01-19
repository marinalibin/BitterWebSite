<?php
include("connect.php");
include("User.php");
//insert the user's data into the users table of the DB
//if everything is successful, redirect them to the login page.
//if there is an error, redirect back to the signup page with a friendly message
if (!empty($_POST["username"])) {
    //won't get here the first time you visit the page
    //will only get if a form has been submitted via post
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["confirm"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $province = $_POST["province"];
    $postalCode = $_POST["postalCode"];
    $url = $_POST["url"];
    $desc = $_POST["desc"];
    $location = $_POST["location"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //instance of the user class
    $u = new User();
    $u->firstName = $fname;
    $u->lastname = $lname;
    $u->email = $email;
    $u->userName = $username;
    $u->password = $hashedPassword;
    $u->contactNo = $phone;
    $u->address = $address;
    $u->province = $province;
    $u->postalCode = $postalCode;
    $u->url = $url;
    $u->description = $desc;
    $u->location = $location;
//echo $u->insert();


    if (!$u->getUserName($username)) {

        if (User::ValidatePostalCode($postalCode)) {
            $u->insert();
            $msg = "Account was created";
            header("location: Login.php?message=$msg");
        } else {
            $msg = "Wrong postal code";
            header("location: Signup.php?message=$msg");
        }
    } else {
        $msg = "Username already exists";
        header("location:Signup.php?message=$msg");
    }
}
?>