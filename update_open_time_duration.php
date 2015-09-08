<?php include_once'connect.php';?>
<?php
session_start();
if(isset($_POST['enteredstartdatetime']) && isset($_POST['enteredenddatetime']))
{
	if($_POST['enteredstartdatetime'] != 'invalid' && $_POST['enteredenddatetime'] != 'invalid')
	{
		$_SESSION['enteredstartdatetime'] =$_POST['enteredstartdatetime'];
		$_SESSION['enteredenddatetime'] =$_POST['enteredenddatetime'];
	}

}

echo $_SESSION['enteredstartdatetime'].' to ';
echo $_SESSION['enteredenddatetime'];


?>