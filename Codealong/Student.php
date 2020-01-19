<?php
 class Student{
    private $name;
    private $studentId;
    protected $address;//accessible in the sub classes
    CONST numCourses=5;//cannot be overridden, no $

    //final methods CANNOT be overriden in subclasses
   final public function __get($property) {
        return $this->$property;
    }
    public function __set($property,$value) {
        $this->$property = $value;
    }
    
    public function __construct($name,$studentId) {
        $this->studentId = $studentId;
        $this->name = $name;
    }
  public function __destruct() {
      echo "OBJECT DESTROYED ";
  }
  
  public static function PrintSchool(){
      echo "NBCC <BR>";
  }
 //  public abstract function SomeMethod();
//    function getName() {
//        return $this->name;
//    }
//
//    function getStudentId() {
//        return $this->studentId;
//    }
//
//    function setName($name) {
//        $this->name = $name;
//    }
//
//    function setStudentId($studentId) {
//        $this->studentId = $studentId;
//    }


    
}

