<?php
header("Access-Control-Allow-Origin: *");
include_once'connect.php';



$wins_left = $_POST['wins_left'];
$id_preference = 1;

if(isset($_POST['wins_left']))
{
	$stmt = $pdo->prepare ("UPDATE lucky8_admin_preference SET wins_left= :wins_left WHERE 	id_preference=:id_preference");

		$stmt -> bindParam(':wins_left', $wins_left);

		$stmt -> bindParam(':id_preference', $id_preference);
		$stmt -> execute();
		
	echo 'success';
}
?>