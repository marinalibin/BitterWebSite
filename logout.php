<?php

//log the user out and redirect them back to the login page.
session_start();
unset($_SESSION['userid']);
session_destroy();
  // echo 'You have cleaned session';
 
?>
<html>
<head>
	<title>Logout Demo</title>
</head>

<body>

	  <h3>You are now logged out.</h3>
	  <a href="login.php">Click Here</a> to return to the login page.

</body>
</html>
