<?php
session_start();
include_once ('connect.php');
include_once ('User.php');
$username=$_POST["to"];
$toId=User::GetToId($username);
$messagetxt=$_POST["message"];
$sessionId=$_SESSION["SESS_MEMBER_ID"];
if(User::InsertToMessages($sessionId, $toId, $messagetxt)){
header("location:DirectMessaging.php");
    
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

