<?php include_once 'header.php' ?>


<?php 

if( isset($_SESSION["logging"]) && isset($_SESSION["logged"]))
{
	print_secure_content($pdo);
}
else
{
	if(!isset($_SESSION["logging"]))
	{
		$_SESSION["logging"]=true;
		loginform($pdo);
		
	}
	else if(isset($_SESSION["logging"]))
	{
		$number_of_rows=checkpass($pdo);
		
		if($number_of_rows>=1)
		{
		
			@$_SESSION[user]=@$_POST[userlogin];
			@$_SESSION[logged]=true;
			
			
			print_secure_content($pdo);
		}
		else
		{
				
				loginform($pdo);
				if($number_of_rows==0 && isset($_POST["userlogin"]) && isset($_POST["password"])  )
				{
					echo "wrong password or username, please try again<br>";
				}
				
			
		}
     }
}
 
?>


 <?php include_once 'footer.php' ?>