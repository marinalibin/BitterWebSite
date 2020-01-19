<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$colours[0] = "Red";
$colors[1] ="Blue";
$colors[2] ="White";
//easier way
$colors=[5=>"Black","blue","White"];
//associative array
//$grades = ["jimmy"=>98,"johnny" =>66];
$grades = array("jimmy"=>98,"johny"=>66);
//2-dimensional array
$twoDArray = array("jimmy"=>array("math"=>98, "science" =>99, "french"=>91),
    "johny"=>array("math"=>87, "science" =>93, "french"=>100)) ;

foreach ($twoDArray as $student){
    echo $student["math"] . "<BR>";
    
}
$students =file("students.txt") or die("Unable to open file!");//read file as an array
foreach($students as $student){
    list($name,$hometown,$gpa)=explode("|", $student);
    echo $name . " " .  $hometown . " " . $gpa . "<BR>";
 
}
//populate an array with a range
$myNums = range(0,100);//or range("A", "F");
//print_r($myNums);//print out an array, good for debugging purposes
array_unshift($colors, "purple");//add to the beginning of an array
array_push($colors,"yellow");//add to the end of the array
print_r($colors);
array_shift($colors);//removes elemnt from the end of the array
array_pop($colors);//removes elemnt from the beginning of the array
if(in_array("Red",$colors)){
    echo "FOUND <BR>";
}
else{
    echo "NOT FOUND <BR>";
}
//how many elemnts in the arraya
echo count($colors) . " elemnts<BR> ";
echo sizeof($colors) . " alias of count <BR>";
print_r(array_reverse($colors));
echo "<BR>";
print_r(array_flip($colors));
echo "<BR>";
sort($colors, SORT_NATURAL);
natcasesort($colors);
$colors2=array("purple","green","pink");
//merge array
$newArray=array_merge($colors,$colors2);
print_r($newArray);
//echo $colors[7] . "<BR>";


