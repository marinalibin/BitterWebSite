<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include("connect.php");
include("tweet.php");
include("User.php");
if(isset($_SESSION["SESS_MEMBER_ID"])){  
    
}
  
    else{
        
    }
    
    $t=new Tweet();
    $tweetId=$_GET['tweetid'];
    $sessID = $_SESSION["SESS_MEMBER_ID"];
        if($t->likeTweet($sessID,$tweetId)){
            $msg = "Liked Successfully";
           echo header("location:index.php?message=$msg");  
        }   
        else{
            $msg = "something went wrong";
           echo header("location:index.php?message=$msg");
        }
           

//	$con = mysqli_connect('localhost', 'root', '', 'like');
//
//	if (isset($_POST['liked'])) {
//		$postid = $_POST['postid'];
//		$result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
//		$row = mysqli_fetch_array($result);
//		$n = $row['likes'];
//
//		mysqli_query($con, "INSERT INTO likes (userid, postid) VALUES (1, $postid)");
//		mysqli_query($con, "UPDATE posts SET likes=$n+1 WHERE id=$postid");
//
//		echo $n+1;
//		exit();
//	}
//	if (isset($_POST['unliked'])) {
//		$postid = $_POST['postid'];
//		$result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
//		$row = mysqli_fetch_array($result);
//		$n = $row['likes'];
//
//		mysqli_query($con, "DELETE FROM likes WHERE postid=$postid AND userid=1");
//		mysqli_query($con, "UPDATE posts SET likes=$n-1 WHERE id=$postid");
//		
//		echo $n-1;
//		exit();
//	}
//
//	// Retrieve posts from the database
//	$posts = mysqli_query($con, "SELECT * FROM posts");
?>
