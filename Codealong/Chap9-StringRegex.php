<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if (isset($_SESSION["name"])){
    echo "You are logged in<BR>";
}
else {
    echo "you are not logged in <BR>";
}
$students = array("Nick", "Jim","John","Jill");
$jStudents = preg_grep("/^J/i", $students);//i-ignore case
print_r($jStudents);
echo"<BR>";

$myString ="The lion, the witch and the wadrobe";
echo preg_match_all(("/the/i"), $myString,$myMatches) . "<BR>";
print_r($myMatches);
echo "<BR>";
$myString = "the price is $19.99";
echo preg_quote($myString). "<BR>";
$myString="PHP is my favourite programming language";
$myString=preg_replace("/PHP/","Java", $myString);
//$myString =preg_filter("/PHP/","JAVA",$myString);
echo $myString . "<BR>";
$myString="this\is\a\sentence";
$myArray=preg_split("/\|/",$myString);
print_r($myArray);
echo "<BR>";
echo strlen($myString). "<BR>";
$string1="HELLO WORLD";
$string2="hello world";
echo strcasecmp($string2,$string1)."<BR>";
echo strtolower($string1)."<br>";
echo ucfirst($string2)."<BR>";
$myString = "Café française + & ^ % ";
echo htmlentities($myString) . "<BR>";
$myString = "Billy O'donnell";
echo addslashes($myString) ."<BR>";
//echo mysqli_real_escape_string($con, $myString);//need to pass connection opject

$myString = "Java <BR> is <BR> awsome <BR>";
echo strip_tags($myString) . "<BR>";
