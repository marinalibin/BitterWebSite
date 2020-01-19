<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
   -PHP.ini initialization
 * -HTTP.conf(apache)
 * -Vulnerabilities
 *  1.Software
 *  2. User Input
 *  3.Unprotected data
 * 
 *  */
//md5 - a weak encryption
$myString = "Hello world";
echo md5($myString) . "<BR>";
//iv mean initialization vector
$iv= openssl_random_pseudo_bytes(16);
$key = "123";
$message = openssl_encrypt($myString, "AES-128-CBC", OPENSSL_RAW_DATA,$key, $iv);
echo $message . "<BR>";

