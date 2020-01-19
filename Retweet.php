<?php
include("connect.php");
include("tweet.php");
include("User.php");
session_start();
if(isset($_SESSION["SESS_MEMBER_ID"])){          
           
    }
    else{
        
    }
 if(isset($_GET['original_tweet_id'])){
//        $message = $_GET['original_tweet_id'];
//        echo "<script>alert($message)</script>";  
    }
$rt= new Tweet();
$id=$_GET['tweetid'];
$rt->userId = $_SESSION['SESS_MEMBER_ID'];
$rt->replyToTweetId=0;
if($rt->ReTweet($id)){
    if($rt->insertTweet()){
    $msg = "Retweetd Successfully";
    echo header("location:index.php?message=$msg");  
    }
    else{
        $msg = "Try again";
       echo header("location:index.php?message=$msg");
    }
}
else{
    $msg = "something went wrong";
    echo header("location:index.php?message=$msg");
}



