<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try{
    if(!mysqli_connect("localhost","username","password","somedata")){
        throw new Exception("error connecting to database");
    
    }//end if
    else{
        echo "SUCCESSFUL!<BR>";
    }
}//end catch
catch(Excepion $ex){
    error_log("ERROR IN FILE " . $ex->getFile(). " on line# ". $ex->getLine()
            . $ex->getMessage());
    echo "could not connect to database";
    exit;//stops execution of the program
}//end catch
echo "MORE LOGIC HERE <BR>";