<?php
include("connect.php");
session_start();
if (isset($_POST["search"])) {
    $search_value = $_POST["search"];
 

$sql = "select screen_name, last_name, first_name from users where first_name like '%$search_value%' or last_name like '%$search_value%'";

 $result = mysqli_query($con, $sql);
 
while($row = mysqli_fetch_array($result)){
               echo $row["first_name"];
               echo $row["last_name"];



}

}


