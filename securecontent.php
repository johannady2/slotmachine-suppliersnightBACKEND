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
if($row["store_date_startend_always_current"] == 1)//determine whether checkbox is prechecked or not
{
	$checkedOrNot = 'checked';
}
else
{
	$checkedOrNot = '';
}
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
			<small>Always use current date:</small>
		</td>
		<td>
			<input type="hidden" name="use_current_date_for_startend_date" value="0">
			<input type="checkbox" name="use_current_date_for_startend_date" value="1" id="use_current_date_for_startend_date" <?php echo $checkedOrNot; ?> />
			
		</td>
	</tr>
	<tr class="storestartdate-field-cont">
		<td>
			<label for="store_date_start" class="admin_field_label">Store Date Start:</label><small>(YYYY-MM-DD)</small>
		</td>
		<td>
			<input type="text" id="store_date_start" class="admin_input_text" name="store_date_start" value="<?php echo $store_date_start; ?>"/>				
			<input type="hidden" value="<?php echo $store_date_start; ?>" id="startdate_original" />			
		</td>
	</tr>
		<tr class="storeendtdate-field-cont">
		<td>
			<label for="store_date_end" class="admin_field_label">Store Date End:</label><small>(YYYY-MM-DD)</small>
		</td>
		<td>
			<input type="text" id="store_date_end"  class="admin_input_text" name="store_date_end" value="<?php echo $store_date_end; ?>"/>
			<input type="hidden" value="<?php echo $store_date_end; ?>"  id="enddate_original"/>

		</td>
	</tr>
	<tr>
		<td>
			<label for="store_time_start" class="admin_field_label">Store Time Start:</label><small>(24hour format HH:MM:SS)</small>
		</td>
		<td>
			<input type="text" id="store_time_start" class="admin_input_text" name="store_time_start" value="<?php echo $store_time_start; ?>"/>
			<input type="hidden" value="<?php echo $store_time_start; ?>"  id="starttime_original"/>

		</td>
	</tr>

	<tr>
		<td>
			<label for="store_time_end" class="admin_field_label">Store Time End:</label><small>(24hour format HH:MM:SS)</small>
		</td>
		<td>
			<input type="text" id="store_time_end"  class="admin_input_text" name="store_time_end" value="<?php echo $store_time_end; ?>"/>
			<input type="hidden" value="<?php echo $store_time_end; ?>"  id="endtime_original"/>
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
	<tr class="playableduration-field-container">
		<td>
			<label for="store_time_open_duration" class="admin_field_label">Playable Duration:</label>
		</td>
		<td>
			<div id="playableduration-reloadingdiv">
				<input type="hidden" value="540" name="playable_duration"/>
			</div>
			
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