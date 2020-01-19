<?php
session_start();
 include("connect.php");
 include("User.php");
//this page will be used when the user clicks on the "follow" button for a particular user
//process the transaction and insert a record into the database, then redirect the user back
// to index.php

  if(isset($_SESSION['SESS_MEMBER_ID'])){          
            $userid = $_SESSION['SESS_MEMBER_ID'];
    }
     else{
       
           $msg="You must be logged in to be able follow other users ";
           header ("location: login.php?message=$msg");
    }
    
  if(isset($_GET['user_id'])){
        $message = $_GET['user_id'];
     // echo "<script>alert($message)</script>";  
    }
    $u=new User();
    $u->from_id = $_SESSION['SESS_MEMBER_ID'];
    $u->to_id = $_GET["user_id"];
    
 
    
    if ($u->follow()){
        $msg = "Followed Successfully";
        header("location:index.php?message=$msg");
   }
   else{
      $msg ="ERROR ON INSERT<BR>";
   }//end if
    
   
?>