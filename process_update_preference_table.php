<?php
include_once'connect.php';
if(isset($_POST))
{



		

		$store_datetime_start = $_POST['store_date_start'].' '.$_POST['store_time_start'];
		$store_datetime_end = $_POST['store_date_end'].' '.$_POST['store_time_end'];
		$store_date_startend_always_current = $_POST['use_current_date_for_startend_date'];
		$playable_duration  = $_POST['playable_duration'];
		$playable_times = $_POST['playable_times'];
		$id_preference = 1;
		
	if ($store_datetime_start < $store_datetime_end)
	{
		$stmt = $pdo->prepare ("UPDATE lucky8_admin_preference SET store_datetime_start= :store_datetime_start , store_datetime_end= :store_datetime_end, store_date_startend_always_current=:store_date_startend_always_current , playable_duration = :playable_duration , playable_times = :playable_times WHERE 	id_preference=:id_preference");
		$stmt -> bindParam(':store_datetime_start', $store_datetime_start);

		$stmt -> bindParam(':store_datetime_end', $store_datetime_end);
		$stmt -> bindParam(':store_date_startend_always_current', $store_date_startend_always_current);
		$stmt -> bindParam(':playable_duration', $playable_duration);
		$stmt -> bindParam(':playable_times', $playable_times);
		$stmt -> bindParam(':id_preference', $id_preference);
		$stmt -> execute();
		
		echo 'success';
	}
	else if($store_datetime_start >= $store_datetime_end)
	{
		if($_POST['store_date_start'] > $_POST['store_date_end'])
		{
			echo 'date error';
		}
		else if($_POST['store_date_start']== $_POST['store_date_end'])
		{
				if( $_POST['store_time_start'] > $_POST['store_time_end'])
				{
					echo 'time error';
				}
		}
		
	}

}

?>