 <?php include_once 'header.php' ?>

  
<?php

	if(session_destroy())
	{
		echo 'Successfully Logged Out ';
		echo '<a href="index.php"">Click here</a>  to login';
	}
?>
 <?php include_once 'footer.php' ?>