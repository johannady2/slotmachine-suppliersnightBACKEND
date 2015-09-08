<div class="loggedin-indcator"></div>
<?php
//makes sure database datetime are displayed by default.
if(isset($_SESSION['enteredstartdatetime']) )
{
	unset($_SESSION['enteredstartdatetime']);
}

if( isset($_SESSION['enteredenddatetime']))
{
		unset($_SESSION['enteredenddatetime']);
}
$result = $pdo->prepare("SELECT * FROM lucky8_admin_preference;");
$result->execute();
$row = $result->fetch();

$store_date_start = date('Y-m-d', strtotime($row["store_datetime_start"]));
$store_time_start =  date('G:i:s', strtotime($row["store_datetime_start"]));
$store_date_end =  date('Y-m-d', strtotime($row["store_datetime_end"]));
$store_time_end =  date('G:i:s', strtotime($row["store_datetime_end"]));
$playable_duration = $row["playable_duration"];
$playable_times =  $row["playable_times"];
/*while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
	echo $row['store_time_start'];
}*/

?>
<h3 class="plagelabel">Preferences:</h3>
<form id="preferences_form">
<table>
	<tr>
		<td>
			<label for="store_date_start" class="admin_field_label">Store Date Start:</label><small>(YYYY-MM-DD)</small>
		</td>
		<td>
			<input type="text" id="store_date_start" class="admin_input_text" name="store_date_start" value="<?php echo $store_date_start; ?>"/>
		
			<small>Always use current date:</small>
																				<input type="hidden" name="use_current_date_for_start_date" value="0">
																				<input type="checkbox" name="use_current_date_for_start_date" value="1" id="use_current_date_for_start_date">
		</td>
	</tr>
	<tr>
		<td>
			<label for="store_time_start" class="admin_field_label">Store Time Start:</label><small>(24hour format HH:MM:SS)</small>
		</td>
		<td>
			<input type="text" id="store_time_start" class="admin_input_text" name="store_time_start" value="<?php echo $store_time_start; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="store_date_end" class="admin_field_label">Store Date End:</label><small>(YYYY-MM-DD)</small>
		</td>
		<td>
			<input type="text" id="store_date_end"  class="admin_input_text" name="store_date_end" value="<?php echo $store_date_end; ?>"/>
		
			<small>Always use current date:</small>
																				<input type="hidden" name="use_current_date_for_end_date" value="0">
																				<input type="checkbox" name="use_current_date_for_end_date" value="1" id="use_current_date_for_end_date">
		</td>
	</tr>
	<tr>
		<td>
			<label for="store_time_end" class="admin_field_label">Store Time End:</label><small>(24hour format HH:MM:SS)</small>
		</td>
		<td>
			<input type="text" id="store_time_end"  class="admin_input_text" name="store_time_end" value="<?php echo $store_time_end; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="playable_duration" class="admin_field_label">Playable Duration:</lable>
		</td>
		<td>
			<input type="text" id="playable_duration" class="admin_input_text" name="playable_duration" value="<?php echo $playable_duration; ?>"/>minutes
		</td>
	</tr>
	<tr>
		<td>
			<label for="playable_times" class="admin_field_label">Playable times:</lable>
		</td>
		<td>
			<input type="text" id="playable_times" class="admin_input_text" name="playable_times" value="<?php echo $playable_times; ?>"/>
		</td>
	</tr>
	<tr class="opentimeduration_TR_container">
		<td>
			<label for="store_time_open_duration" class="admin_field_label">Store Time Open Duration:</label>
		</td>
		<td>
			<div id="open_time_duration-container"></div>
			
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div id="invalid_datetime_format_message"><small>Invalid date or time.</small></div>
			<input type="submit" name="submitted" value="submit" class="submit_preferences"/>
		</td>
	</tr>
</table>
</form>

<div class="message_success"></div>
<div class="message_error"></div>