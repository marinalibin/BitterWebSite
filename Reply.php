<?php
session_start();
include("connect.php");
include("tweet.php");
//PRINT_R($_POST);
if (isset($_POST['myReply'])) {
    $reply = new Tweet();
    $id = $_POST['replyto'];
    $replyto = $_POST['myReply'];

    $reply->userId = $_SESSION['SESS_MEMBER_ID'];
    $reply->replyToTweetId = $id;
    $reply->tweetText = $replyto;
    $reply->originalTweetId = 0;


    if ($reply->insertTweet()) {

        $msg = "Your reply successfully!";
        header("location:index.php?message=$msg");
    } else {

        $msg = "Something went wrong. Please try again!";
        header("location:index.php?message=$msg");
    }
}
