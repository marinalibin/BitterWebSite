<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//type hinting will throw an exception if the type doesn't match
function AddNumbers(int $x,int $y){
    return $x+$y; 
}//end function

function PrintMessage(&$x){//& means by - reference
    $x = "Bonjour Monde";//change to argument inside the function 
    echo $x . "<BR>";
}//end function

function Factorial($num){//recursive function
    //if($num==1) return 1;//base case
   // else return $num*Factorial($num-1);
    $sum=1;
    for($i=2;$i<$num;$i++){
        $sum*=$i;  
    }
    return $sum;
    
}

echo AddNumbers(5,10) . "<BR>";
echo rand(0,10) . "<BR>";
echo getrandmax() . "<BR>";
echo Factorial(100) . "<BR>";
$myMessage="Hello World";
PrintMessage($myMessage);
echo $myMessage;
//REcursive function: Base case
//Worktowards Base Case
//Calls Itself




