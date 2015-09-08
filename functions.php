<?php

function loginform($pdo)
{

	echo
	'
		<form action="index.php" method="post" id="login-form">
			<h3 class="pagelabel">LOGIN:</h3>
			<input type="text" name="userlogin" size"20" placeholder="username">
			<input type="password" name="password" size"20" placeholder="password">
			<input type="submit" value="LOGIN" name="submit"/>
		</form>
	';	
		
}

function checkpass($pdo)
{
	


	if( isset($_POST["userlogin"])&& isset($_POST["password"]))
	{
		
		//$sql="SELECT * FROM lucky8_admin WHERE username_lucky8_admin='$_POST[userlogin]' and password_lucky8_admin='$_POST[password]'";
		//$result=mysql_query($sql,$conn) or die(mysql_error());
		//return  mysql_num_rows($result);
		
		$stmt =  $pdo->prepare('SELECT * FROM lucky8_admin WHERE username_lucky8_admin="'.$_POST['userlogin'].'" and password_lucky8_admin="'.$_POST['password'].'"');
		$stmt->execute();
		
		return $stmt->rowCount();
	}
}

function print_secure_content($pdo)
{
	if(isset($_SESSION["user"]))
	{	
		include_once 'securecontent.php';
	}
}




?>