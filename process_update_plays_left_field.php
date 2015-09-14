<?php
header("Access-Control-Allow-Origin: *");
include_once'connect.php';





$store_date_start = date('Y-m-d', strtotime($row["store_datetime_start"]));

$playsleft = $_POST['playsleft'];
$id_preference = 1;

if(isset($_POST['playsleft']))
{
	$stmt = $pdo->prepare ("UPDATE lucky8_admin_preference SET plays_left = (plays_left - 1)  WHERE 	id_preference=:id_preference");
		//$stmt -> bindParam(':plays_left', $playsleft);
		$stmt -> bindParam(':id_preference', $id_preference);
		$stmt -> execute();
		
	echo 'success';
}
?>