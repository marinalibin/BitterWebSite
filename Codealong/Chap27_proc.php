
<?php   include("../connect.php");?>
<?php

if (isset($_POST["txtName"])) {
    //won't get here the first time you visit the page
    //will only get if a form has been submitted via post
    $name = $_POST["txtName"];
    $email = $_POST["txtEmail"];
    echo $name . " " . $email . "<BR>";
  
  /*  define("DB_HOST","localhost");
    define("DB_USER","root");
    define("DB_PASS","");
    define("DB_NAME","productdemo");
    
    
    global $con;
    $con= mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    
    if(!$con)
    {
        die('Could not connect: ' . mysql_error());
    }*/
    
    $sql = "select * from products";
    if($result = mysqli_query($con, $sql)){
        //this is useful for getting number of rows
        //echo mysqli_num_rows($result) . "<BR>";
        while($row = mysqli_fetch_array($result)){
            echo $row["ID"] . " " . $row["Category"] . " " . $row["Description"] . "<BR>";
        } 
    }//end if
    
    //insert statement
    $prodId = 10; 
    $category = " Sportswear";
    $description ="Hockey Stick";
    $price = 29.99;
    $sql = "Insert into products (ID,Category,Description,Price,Image)
            values($prodId,'$category','$description',$price,1)";
   //echo $sql; fro debugging purposes
     mysqli_query($con, $sql);
     
     if (mysqli_affected_rows($con)==1){
         $msg = "INSERT SUCCESSFUL<BR>";
     }
     else{
         $msg ="ERROR ON INSERT<BR>";
     }//end if
     //DELETE statement
     $sql = "delete from products where ID = $prodId";
//     mysqli_query($con, $sql);
//     echo (mysqli_affected_rows($con)==1)? " DELETE SUCCESSFUL " :" FAILED ";
     
     //UPDATE statement
     $description = "baseball bat";
     $sql = "update products set description ='$description' where ID = $prodId";
     $msg =$sql; //fro debugging purposes
     mysqli_query($con, $sql);//execute the SQL Statement
    // echo (mysqli_affected_rows($con)==1)? " update SUCCESSFUL " :" FAILED ";
         if (mysqli_affected_rows($con)==1){
         $msg = "updated SUCCESSFUL<BR>";
     }
     elseif(mysqli_affected_rows($con)==0){
        $msg ="no records updated";
     }
     else{
         $msg = "multiple records updated";
     }
}// end BIG if statement
//a header redirct will send the user to another page
//? is the URL querystring
//used for sendign data via a GET
header ("location: Chap27.php?message=$msg");

    ?>

