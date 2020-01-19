<?php include("connect.php"); ?>
<?php
include("User.php");

//verify the user's login credentials. if they are valid redirect them to index.php/
//if they are invalid send them back to login.php
session_start();
if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $u=new User();
 
           if($u->getUserPassword($username,$password)){
            $_SESSION['SESS_LAST_NAME'] = $u->lastname;
            $_SESSION["SESS_FIRST_NAME"] = $u->firstName;
            $_SESSION["SESS_MEMBER_ID"] = $u->userId;
            $_SESSION["SESS_MEMBER_PIC"] = $u->profImage;
                $msg = "Login successfull ";
               header("location:index.php?message=$msg");

} else{
             $msg = "Incorrect username or password";
            header("location:login.php?message=$msg");}
            

}             
 

?>
