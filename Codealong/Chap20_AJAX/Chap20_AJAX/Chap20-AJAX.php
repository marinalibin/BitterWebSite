<?php
//ajax allows for more responsive web pages to enhance the user experience
//ajax lets you use a little JS to make round trips to the server without refreshing the webpage
//we don't really need any PHP on this page :) 
?>
<html>
    <head>
        <title>Chap 20-AJAX</title>
        <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
        <script>
            //just a little jquery, nothing to see here
            function frm_submit(){
                $.get(//to get HTTP request
                    "Chap20_proc.php",
                    $("#myForm").serializeArray(),
                    function(data) {//anonymous function-call back function
                        //alert(data); //use this for debugging
                        //write the resulting message back to the mySpan tag
                      $("#mySpan").text(data.msg);  
                    },
                    "json" //change this to HTML for debugging
                );//end of the get function call
                return true;
            }
        </script>        
    </head>
    <body>
        <!-- the world's simplest form -->        
        <form method="get" id="myForm"  action="SomeProcPage.php">
            Username:<input type="text" onblur="frm_submit()"name="txtUsername" >
            <span id="mySpan"></span><BR>
            Password:<input type="password" name="txtPassword"><BR>
            First Name:<input type="text" name="txtFirstName"><BR>
            Last Name:<input type="text" name="txtLastName"><BR>
            Address:<input type="text" name="txtAddress"><BR>
            City:<input type="text" name="txtCity"><BR>
            Postal Code:<input type="text" name="txtPostalCode"><BR>
            <input type="submit" value="Create Account" >
        </form>
        
    </body>
        
</html>