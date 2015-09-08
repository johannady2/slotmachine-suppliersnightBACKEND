
var store_time_S;
var store_time_E;

var startdate_original = $('#startdate_original').val();
var enddate_original = $('#enddate_original').val();
var starttime_original = $('#starttime_original').val();
var endtime_original = $('#endtime_original').val();

	
	onPageload();

	
	
	$("#store_date_start , #store_date_end , #store_time_end , #store_time_start").on('input', function(eventrr)
	 {

		storeOpenDurationDisplayUpdater();

	});
	
		
	 $('#preferences_form').on('submit', function(event)
	 {

				
				
		
		$.ajax({
			type: "POST",
			  url: "./process_update_preference_table.php",
			data: $(this).serialize(),
			success: function(data){

			
				if(/^\s*success\s*$/.test(data))
				{
						
					$('#startdate_original').val($('#store_date_start').val());
					$('#enddate_original').val($('#store_date_end').val());
					$('#starttime_original').val($('#store_time_start').val());
					$('#endtime_original').val($('#store_time_end').val());
					
					$('.message_error').hide();
					$('.message_success').empty().show().append('Successfully Updated Preferences.<a href="#" class="close-this-div">x</a>');
					
				}
				else if(/^\s*date error\s*$/.test(data))
				{
					$('.message_success').hide();
					$('.message_error').empty().show();
					$('.message_error').append('Start Date must go before or be the same as End Date.<a href="#" class="close-this-div">x</a>');
				}
				else if(/^\s*time error\s*$/.test(data))
				{
					$('.message_success').hide();
					$('.message_error').empty().show().append('Start Time must go before End Time.<a href="#" class="close-this-div">x</a>');
			
				}

			}
		});
		return false;
	 

	 });
	 
	 $('.message_success , .message_error').on('click','.close-this-div',function()
	 {
		 $(this).parent().hide();
	});
	
	$('#use_current_date_for_startend_date').on('change', function()
	{
			
			alwaysUseCurrentDateCheckedOrNot();
			storeOpenDurationDisplayUpdater();

	});
	
	
	/*-----------------------------------------FUNCTIONS-----------------------------------------------*/
function onPageload()
{
	if($('.loggedin-indcator').length)
	{
		$('.logoutnav > a ,.preferencesnav > a').show();
	}

	var auto_refresh = setInterval(
	function ()
	{
		$('#playableduration-reloadingdiv').load('reload_open_time_duration.php').fadeIn('fast');
	}, 500);
	
	addZeroOnBeginningOfTime();
	alwaysUseCurrentDateCheckedOrNot();
}

function addZeroOnBeginningOfTime()
{
	if($('#store_time_start').length > 0 && $('#store_time_end').length > 0)//ADD '0' to example; 3:22:00 to make it 03:22:00 which is what's valid
	{
		 var starttimeSplitArray = $('#store_time_start').val().split(':');
		 var endtimeSplitArray = $('#store_time_end').val().split(':');
		
		
		if(starttimeSplitArray[0].length == 2)
		{
		  store_time_S = $('#store_time_start').val().toString();
		  
		}
		else
		{
			 store_time_S = '0' + $('#store_time_start').val().toString();
			 $('#store_time_start').val(store_time_S);
		}

		
		if(endtimeSplitArray[0].length == 2)
		{
		  store_time_E = $('#store_time_end').val().toString();
		 
		}
		else
		{
			 store_time_E = '0' + $('#store_time_end').val().toString();
			 $('#store_time_end').val(store_time_E);
		}


		
		/*START
		//check if substring is less than 10 OR ((if not float is integer) and (not numeric))
		 if($('#store_time_start').val().substring(0, 2) < 10 || (Math.floor($('#store_time_start').val().substring(0, 2)) != $('#store_time_start').val().substring(0, 2) && $.isNumeric($('#store_time_start').val().substring(0, 2)) == false))
		 {
			 
			 store_time_S = '0' + $('#store_time_start').val().toString();
			 $('#store_time_start').val(store_time_S);
		 }
		 else
		 {
			store_time_S = $('#store_time_start').val().toString();
		 }
		*/
		 
		 /*END
		 if($('#store_time_end').val().substring(0, 2) < 10 || (Math.floor($('#store_time_end').val().substring(0, 2)) != $('#store_time_end').val().substring(0, 2) && $.isNumeric($('#store_time_end').val().substring(0, 2)) == false))
		 {
			  store_time_E = '0' + $('#store_time_end').val().toString();
			  $('#store_time_end').val(store_time_E);
		 }
		 else
		 {
			  store_time_E = $('#store_time_end').val().toString();
		 }*/
	}
}
	function storeOpenDurationDisplayUpdater()
	{
		var start_datetime = $('#store_date_start').val() + ' ' + $('#store_time_start').val();
		var end_datetime = $('#store_date_end').val() + ' ' + $('#store_time_end').val();
					
			

			if(validateDateTime(start_datetime) == true &&   validateDateTime(end_datetime) == true)
			{

				
				$('#invalid_datetime_format_message').hide();
				$('.submit_preferences').show();
				
	
					
						$.ajax({
							type: "POST",
							url: 'update_open_time_duration.php',
							data:{"enteredstartdatetime":start_datetime , "enteredenddatetime":end_datetime},
						});
						return false;
					
			}
			else
			{
		
				$('#invalid_datetime_format_message').show();
					$('.submit_preferences').hide();
				
						$.ajax({
							type: "POST",
							url: 'update_open_time_duration.php',
							data:{"enteredstartdatetime":'invalid' , "enteredenddatetime":'invalid'},
						});
						return false;
			}
		
	}
	
	function validateDateTime(testValue)//yyyy[/.-]mm[/.-]dd hh:mm:ss
	{//SOURCE: https://stackoverflow.com/questions/24375711/mm-dd-yyyy-hhmmss-am-pm-date-validation-regular-expression-in-javascript/24386533#24386533

		 if(/^((((19|[2-9]\d)\d{2})[\/\.-](0[13578]|1[02])[\/\.-](0[1-9]|[12]\d|3[01])\s(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))|(((19|[2-9]\d)\d{2})[\/\.-](0[13456789]|1[012])[\/\.-](0[1-9]|[12]\d|30)\s(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))|(((19|[2-9]\d)\d{2})[\/\.-](02)[\/\.-](0[1-9]|1\d|2[0-8])\s(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))[\/\.-](02)[\/\.-](29)\s(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])))$/g.test(testValue))
		{
		   return true;
		}
		else
		{
			 return false;
		}
	}



	Date.prototype.yyyymmdd = function()
	{
		var yyyy = this.getFullYear().toString();
		var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
		var dd  = this.getDate().toString();
		return yyyy +'-' + (mm[1]?mm:"0"+mm[0]) + '-'+ (dd[1]?dd:"0"+dd[0]); // padding
	};


	function alwaysUseCurrentDateCheckedOrNot()
	{
			/*these have already been initialized but we're calling them again because if the form was submitted with new values, the hidden element is updated however the variables aren't*/
			startdate_original = $('#startdate_original').val();
			enddate_original = $('#enddate_original').val();
			starttime_original = $('#starttime_original').val();
			endtime_original = $('#endtime_original').val();

				
			if ($('#use_current_date_for_startend_date').is(':checked'))
			{	
				Date.prototype.yyyymmdd = function()
				{
					var yyyy = this.getFullYear().toString();
					var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
					var dd  = this.getDate().toString();
					return yyyy +'-' + (mm[1]?mm:"0"+mm[0]) + '-'+ (dd[1]?dd:"0"+dd[0]); // padding
				};
				var d = new Date();

				$('#store_date_start').val(d.yyyymmdd());
				$('#store_date_end').val(d.yyyymmdd());
				$('#store_time_start').val(starttime_original);
				$('#store_time_end').val(endtime_original);
				addZeroOnBeginningOfTime();
				$('.storeendtdate-field-cont , .storestartdate-field-cont').hide();

	
			}
			else
			{

				
				$('#store_date_start').val(startdate_original);
				$('#store_date_end').val(enddate_original);
				$('#store_time_start').val(starttime_original);
				$('#store_time_end').val(endtime_original);
				addZeroOnBeginningOfTime();
				$('.storeendtdate-field-cont , .storestartdate-field-cont').show();
				
			}
	}
	
	
	









