<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//header() sends a raw HTTP header to the browser
$myPassword = "opensesame";//would normally be passed via post
$myPassword1 = "opensesame";
//add this to signup_proc.php
$myHashedPassword = password_hash($myPassword,PASSWORD_DEFAULT);
$myHashedPassword1 = password_hash($myPassword1,PASSWORD_DEFAULT);
echo $myHashedPassword . "<BR>" . $myHashedPassword1 . "<BR>";
//this will go on the login_proc.php
echo password_verify("opensesame", $myHashedPassword)."<BR>";

