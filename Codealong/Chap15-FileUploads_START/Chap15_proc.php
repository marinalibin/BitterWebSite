<?php
//chapter 15 processing
if(isset($_POST['submit'])) {
    //Attempt to upload file
    if(empty($_FILES['pic']['name'])){
        echo "ERROR: You must select a file"; 
    }
    //echo $_FILES['pic']['size']."FILESIZE<BR>";
   // echo $_FILES['pic']['tmp_name'] ."TEMPNAME<BR>";
if($_FILES['pic']['size']>(10240*1024)){
        unlink($_FILES['pic']['tmp_name']);//delete the file
        echo "ERROR: image must be under 1MB";
        }
else{
    echo $_FILES['pic']['name'];
    if(move_uploaded_file($_FILES['pic']['tmp_name'], "../../images/profilepics/".
               $_FILES['pic']['name'])){
               echo "successful<BR>";}
    else{
          
            unlink($_FILES['pic']['tmp_name']);
            echo "Error Handling File";  
        }  
  }
     
//update the profilepic fiel in the users table of your db    
}
?>