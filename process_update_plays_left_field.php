<?php
header("Access-Control-Allow-Origin: *");
include_once'connect.php';


$playsleft = $_POST['playsleft'];
$id_preference = 1;

if(isset($_POST['playsleft']))
{
	$stmt = $pdo->prepare ("UPDATE lucky8_admin_preference SET plays_left = :plays_left  WHERE 	id_preference=:id_preference");
		$stmt -> bindParam(':plays_left', $playsleft);
		$stmt -> bindParam(':id_preference', $id_preference);
		$stmt -> execute();
		
	echo 'success';
}
?>