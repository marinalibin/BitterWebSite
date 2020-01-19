<?php

//Chapter 17 session
//cookie is samll text file stored on your computer-limited size 4KB-secutiry issues
//session replaced cookies
//session variables are stored on the RAM of the server
session_start();//USE THIS EVERYTIME YOU WANT TO USE SESSION VARIABLES
//set the session variable
$_SESSION["name"]= "Nick";//this would be similar to what will be on login_proc
//retrieve the session variable
echo $_SESSION["name"] . "<BR>";

echo session_id(). " my session ID <BR>";
$mySession= session_encode() . " All my session vars <br>";
echo session_decode($mySession). "<br>";
//logout page
session_unset();//removes all variables from session
session_destroy();//kills the session completely
