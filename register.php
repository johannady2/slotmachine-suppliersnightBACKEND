<?php require 'header.php' ?>


<?php

if(isset($_POST["regemail"]) && isset($_POST["regname"]) && isset($_POST["regpass1"]) && isset($_POST["regpass2"])) 
{
	
		if($_POST["regpass1"]==$_POST["regpass2"])
		{
		
			$numberOfRows = checkRegNameAndRegEmail();
			
			if($numberOfRows <= 0)
			{
				require'connect.php';
				$sql="insert into users (email,username,password)values('$_POST[regemail]','$_POST[regname]','$_POST[regpass1]')";
				$result=mysql_query($sql,$conn) or die(mysql_error());
				
				
				echo "<h1>you have registered sucessfully</h1>";

				echo "<a href='index.php'>go to login page</a>";
			}
			else
			{
				echo 'username or email already exists';
			}
		}
		else echo "passwords does not match";
	
	
}
else
{
	echo 'please fill in all fields';
}



function checkRegNameAndRegEmail()
{
	if( isset($_POST["regname"])&& isset($_POST["regemail"]))
	{
		require'connect.php';
		$sql="select * from users where username='$_POST[regname]' and email='$_POST[regemail]'";
		$result=mysql_query($sql,$conn) or die(mysql_error());
		return  mysql_num_rows($result);
	}
}










?>


<FORM ACTION="register.php" METHOD=post>
	
	
	<table border="2">
	<tr><td>Username :</td><td><input name="regname" type="text" size"20" required="required"></input></td></tr>
	
	<tr><td>email :</td><td><input name="regemail" type="text" size"20" required="required"></input></td></tr>
	
	<tr><td>password :</td><td><input name="regpass1" type="password" size"20" required="required"></input></td></tr>
	
	<tr><td>retype password :</td><td><input name="regpass2" type="password" size"20" required="required"></input></td></tr>
	
	</table>
	
	<input type="submit" value="register"></input>
	
</FORM>


 <?php require 'footer.php' ?>