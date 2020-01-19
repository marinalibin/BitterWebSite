<?php 
session_start();
include("connect.php");
include("Tweet.php");
if (isset($_POST["myTweet"])){  
    $tweetTxt=$_POST["myTweet"];
    $userid = $_SESSION["SESS_MEMBER_ID"];
    $tweet = new Tweet();
    $tweet->userId = $userid;
    $tweet->tweetText=$tweetTxt;
    $tweet->originalTweetId=0;
    if(isset($_POST["replyToId"])){
    $tweet->replyToTweetId =$_POST['replyToId'];
    }
    else{
        $tweet->replyToTweetId=0;
    }

    if ($tweet->insertTweet()){
       $msg = "Insert comment successfully";
       header("location:index.php?message=$msg");
     
   }
   else{
      $msg ="ERROR ON INSERT";
      header("location:index.php?message=$msg");

   }//end if
	

}
?>