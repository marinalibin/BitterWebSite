<?php

//R.A.D
//create an instance of the student class
include ("Student.php");
$s = new Student("Jimmy",123456);//uses the default constructor
$s->studentId = 123456;
echo $s->studentId . " ";

//call the static method
Student::PrintSchool();
DoStuff($s);
function DoStuff(Student $s){
    echo $s-> name. "<BR>";
}

        

?>