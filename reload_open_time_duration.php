<?php include_once'connect.php';?>
<?php
session_start();

$result2 = $pdo->prepare("SELECT * FROM lucky8_admin_preference;");
$result2->execute();
$row2 = $result2->fetch();


if(isset($_SESSION['enteredstartdatetime']) && isset($_SESSION['enteredenddatetime']))
{
	$date_a = new DateTime($_SESSION['enteredstartdatetime']);
	$date_b = new DateTime($_SESSION['enteredenddatetime']);


}
else if(isset($_SESSION['enteredstartdatetime']) && !isset($_SESSION['enteredenddatetime']))
{
	$date_a = new DateTime($_SESSION['enteredstartdatetime']);
	$date_b = new DateTime($row2['enteredenddatetime']);
}
else if(!isset($_SESSION['enteredstartdatetime']) && isset($_SESSION['enteredenddatetime']))
{
	$date_a = new DateTime($_SESSION['enteredstartdatetime']);
	$date_b = new DateTime($row2['enteredenddatetime']);
}
else
{


	$date_a = new DateTime($row2["store_datetime_start"]);
	$date_b = new DateTime($row2["store_datetime_end"]);
}

	$interval = date_diff($date_a,$date_b);

	$time_open_duration =  $interval->format('<b> %a </b> Day(s) <b> %h  </b> hour(s) <b> %i  </b> minute(s) <b> %s </b> second(s)');
	
	

	
	

$time_open_duration_DAYS =  $interval->format('%a');
$time_open_duration_HOURS =  $interval->format('%h');
$time_open_duration_MINUTES =  $interval->format('%i');
$time_open_duration_SECONDS =  $interval->format('%s');

$total_seconds = $time_open_duration_SECONDS + ($time_open_duration_MINUTES * 60) + ($time_open_duration_HOURS * 60 * 60) + ($time_open_duration_DAYS * 24 * 60 * 60);


echo $time_open_duration.'<input type="hidden" value="'.$total_seconds.'" name="playable_duration"/>';

?>