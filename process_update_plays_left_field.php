<?php
header("Access-Control-Allow-Origin: *");
include_once'connect.php';


$pdo->beginTransaction();

//select
$sth = $pdo->prepare("SELECT plays_left FROM lucky8_admin_preference  FOR UPDATE;");
$sth->execute();
$row = $sth->fetch();
$playskkk = $row['plays_left'];			
$echothis ='';
		
		if($playskkk > 0)
		{	
	
			//update 
			$id_preference = 1;
			$sth2 = $pdo->prepare("UPDATE lucky8_admin_preference SET plays_left = (plays_left - 1)  WHERE 	id_preference=:id_preference");
			$sth2-> bindParam(':id_preference', $id_preference);
			$sth2-> execute();

			$pdo->commit();
			$echothis ='success';
		}
		else
		{
			 $pdo->rollBack();
			 $echothis ='fail';
		}

echo $echothis;
?>


<?php
/*NO TRANSACTION VERSION.. still works because of "FRO UPDATE" but with transaction is better*/
/* 
header("Access-Control-Allow-Origin: *");
include_once'connect.php';

$id_preference = 1;


$result = $pdo->prepare("SELECT plays_left FROM lucky8_admin_preference  FOR UPDATE;");
$result->execute();
$row = $result->fetch();
$playskkk = $row['plays_left'];

		
$echothis ='';
		
		if($playskkk > 0)
		{
			$stmt = $pdo->prepare ("UPDATE lucky8_admin_preference SET plays_left = (plays_left - 1)  WHERE 	id_preference=:id_preference");
			
				$stmt -> bindParam(':id_preference', $id_preference);
				$stmt -> execute();
			
			$echothis ='success';
		}
		else
		{
			$echothis ='fail';
		}

echo $echothis;
*/
?>