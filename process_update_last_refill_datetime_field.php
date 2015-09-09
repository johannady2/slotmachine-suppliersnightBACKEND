<?php
header("Access-Control-Allow-Origin: *");
include_once'connect.php';


$last_refill_datetime = $_POST['last_refill_datetime'];
$wins_left = $_POST['wins_left'];
$plays_left = $_POST['plays_left'];
$id_preference = 1;

if(isset($_POST['last_refill_datetime']) && isset($_POST['wins_left']) && $_POST['plays_left'])
{
	$stmt = $pdo->prepare ("UPDATE lucky8_admin_preference SET last_refill_datetime = :last_refill_datetime, plays_left = :plays_left, wins_left= :wins_left WHERE 	id_preference=:id_preference");
		$stmt -> bindParam(':last_refill_datetime', $last_refill_datetime);
		$stmt -> bindParam(':wins_left', $wins_left);
		$stmt -> bindParam(':plays_left', $plays_left);
		$stmt -> bindParam(':id_preference', $id_preference);
		$stmt -> execute();
		
	echo 'success';
}
?>