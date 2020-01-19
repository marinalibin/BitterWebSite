<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>chapter 3 PHP</title>
    </head>
    <body>
        <?php
        #Title: 
        // put your code here
        $x = 5;
        $myName = "Marina";
        echo $myName . "<BR>";//. is string concatenation
        echo ++$x ."<BR>";
        echo $myName .= " Libin<BR>";
        print "Hello world<BR>";
        printf ("Hello %s<BR>", $myName);
        //scalar variables is used to hold a single value
        //boolean, int, float, string
        $value = (bool) true;
        $value = 'hello world';
        $value = 0755;//octal
        $value = 0xabc;//hex
        echo $value . " value <BR>";
        //arrays will be covered chapter 5 
        $students[0]= "Jimmy";
        $students[1]= "John";
        $students[2]= "Suzie";
        //PHP variables are case-sensitive
        $X = 50;
        $myVar ="5";
        $myVar2="10";
        //type-juggling
        echo $myVar + $myVar2 . "<BR>";
        echo gettype($myVar2) . "<BR>";
        //reference variables pointer to original variable
        $myVar2 =& $myVar;
        $myVar = 5600;
        echo "myVar2"." ".$myVar2 . "<BR>";
        const PI = 3.14159;//NO DOLLAR SIGN ON CONST
        //define("PI",3.14);
        
        echo PI . "<BR>";
        echo "<pre>";
        $count=0;
        $count++;//increment the count variable
        echo $count."<BR>";
        if($count ==0){
            echo "ZERO<BR>";
        }elseif($count >0){
            echo "greater than 0\n";
        }else {
            echo $count. " count<BR>";
        }echo "<pre>";
        $a=5;
        $b="5";
        if($a===$b){
            echo "EQUAL1<BR";
        }else {
            echo "NOT EQUAL<BR>";
        }
        echo ($a<=>$b)."<BR>";//<=> spaceship operator 
        //returns 1,0,-1 is it's greater than, equal, or less than
        $color = "red";
        switch ($color){
            case "red":
                echo "RED<BR>";
                break;
            case "blue":
                echo "BLUE<BR>";
                break;
            default:
                echo "DEFAULT<BR>";
                
        }//end switch
        while(true){
          if($color=="red")  break;
          
        }//end while
        $i=0;
        do{
            echo pow($i,2)."<BR>";
            $i++;//DON'T FORGET TO INCREMENT THE COUNTER
        }while($i<10);
        for($i=0;$i<10;$i++){
            if($i==5) continue;//skip the current iteration
        }
        
        //++$count prefex
        //Question 1
        $var1=10;
        $var2=10;
        echo ($var1==$var2)?  "EQUAL" : "NOT EQUAL<BR>";
//        //Question 2
//        echo "<table border = '1'>"'
//        for($i=1;$i<8;$i++){
//          echo"<tr>";
//          for($j=
//  
//        }

        ?>
        <!--short circuit tag -->
        This is a <?=$myName?> sentence using a short circuit tag.
    </body>
</html>
