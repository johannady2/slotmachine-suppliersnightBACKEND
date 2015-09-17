<?php
header("Access-Control-Allow-Origin: *");
include_once'connect.php';


$pdo->beginTransaction();

//select
$sth = $pdo->prepare("SELECT wins_left FROM lucky8_admin_preference  FOR UPDATE;");
$sth->execute();
$row = $sth->fetch();
$winskkk = $row['wins_left'];			
$echothis ='';

if($winskkk > 0)
{
	$id_preference = 1;
	
	$stmt = $pdo->prepare ("UPDATE lucky8_admin_preference SET wins_left=  (wins_left -1) WHERE 	id_preference=:id_preference");

		//$stmt -> bindParam(':wins_left', $wins_left);

		$stmt -> bindParam(':id_preference', $id_preference);
		$stmt -> execute();
		
	$pdo->commit();
	$echothis ='success';
}
else
{
	$echothis ='fail';
	$pdo->rollBack();
}

echo $echothis;
?>