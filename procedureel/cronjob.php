<?PHP
include("common.php");
include("includes/cronjob_functions.php");
printheader ("cronjob");

// Set date infomation
$str_datetime = date(DATEFORMAT_LONG);
$int_weeknumber = date("W");
$int_weekday = date("w");
$int_daynumber = date("j");
$int_monthnumber = date("n");

// Set query's
$sql_tasks = "SELECT id, title, description, reccurtype, reccurtimes, 
			  reccurtimesinterval, reccurday, reccurweekdays, reccurweeks, action_performed_date, approved, functionname 
			  FROM events WHERE cronjob_yn = 1";

// Get task information
$result_tasks = $db_iwex->query($sql_tasks);
while ($obj_tasks = mysql_fetch_object($result_tasks)) {

	$str_task_id = isset ($obj_tasks->id) ? $obj_tasks->id : "";
	$str_task_title = isset ($obj_tasks->title) ? $obj_tasks->title : "";
	$str_task_desciption = isset($obj_tasks->description) ? $obj_tasks->description : "";
	$str_task_function = isset($obj_tasks->functionname) ? $obj_tasks->functionname : "";
	$str_task_reccurtype = isset($obj_tasks->reccurtype) ? $obj_tasks->reccurtype : "";
	$str_task_reccurtimes = isset($obj_tasks->reccurtimes) ? $obj_tasks->reccurtimes : "";
	$str_task_reccurtimesinterval = isset($obj_tasks->reccurtimesinterval) ? $obj_tasks->reccurtimesinterval : "";
	$str_task_reccurday = isset($obj_tasks->reccurday) ? $obj_tasks->reccurday : "";
	$str_task_reccurweekdays = isset($obj_tasks->reccurweekdays) ? $obj_tasks->reccurweekdays : "";
	$str_task_reccurweeks = isset($obj_tasks->reccurweeks) ? $obj_tasks->reccurweeks : "";
	$str_task_action_performed_date = isset($obj_tasks->action_performed_date) ? $obj_tasks->action_performed_date : "";
	$str_task_approved = isset($obj_tasks->approved) ? $obj_tasks->approved : "";
	$str_task_function = isset($obj_tasks->functionname) ? $obj_tasks->functionname : "";

	// Split up the date and time information from the database
	list($str_date_old, $str_time_old) = explode(" " ,$str_task_action_performed_date);
	list($old_jaar, $old_maand, $old_dag) = explode("-" ,$str_date_old);
	list($old_hour, $old_min, $old_sec) = explode(":" ,$str_time_old);

	// Split up the date and time information on this moment!
	list($str_date_now, $str_time_now) = explode(" " , $str_datetime);
	list($now_jaar, $now_maand, $now_dag) = explode("-" ,$str_date_now);
	list($now_hour, $now_min, $now_sec) = explode(":" ,$str_time_now);
	
	if ($str_task_function) {
		// Look for the different task options and check if task need to be used.
		// If the task need to be used, the task function will do the rest.
		// after that a new time will be set.
		
		if ($str_task_reccurtype == DB_TASK_OPTION_DAY && $str_time_old <= $str_time_now
			&&
			$str_date_old == $str_date_now
			||
			$str_task_reccurtype == DB_TASK_OPTION_DAY && $str_date_old < $str_date_now) {
			// If there is a interval set.
			if ($str_task_reccurtimesinterval) {
				// Do function
				$str_task_function();
					// Check for the different. And set the interval in Minutes or hours.
					if (ereg("min", $str_task_reccurtimesinterval)) {
						$int_interval_time = str_replace("min", "", $str_task_reccurtimesinterval) . " MINUTE";
					} else {
						$int_interval_time = str_replace("uur", "", $str_task_reccurtimesinterval) . " HOUR";	
					}
					// Update the task date and time
					$db_iwex->query("UPDATE events 
									SET action_performed_date = (DATE_ADD('$str_datetime', INTERVAL $int_interval_time))
									WHERE id = '$str_task_id'");
			// Or do this if there is set a time
			} else {
				$ary_times = explode(",", $str_task_reccurtimes);
				$int_totaltimes = count($ary_times) - 1;
				// Do function
				$str_task_function();
				// Loop trough the time options.
				for ($i_times = 0 ; $i_times <= $int_totaltimes ; $i_times++) {
					// If the time exist into the time options, look for the next time
					if (ereg($str_time_old ,$str_task_reccurtimes)) {
						if ($ary_times[$i_times] == $str_time_old && $i_times != $int_totaltimes) {
							list($now_hour, $now_min, $now_sec) = explode(":" ,$ary_times[$i_times + 1]);
						} else if ($ary_times[$i_times] == $str_time_old && $i_times == $int_totaltimes) {
							list($now_hour, $now_min, $now_sec) = explode(":" ,$ary_times[0]);
							$now_dag = $now_dag + 1;
						}
					// If the time not exist. look for the next time after this time.
					} else {
						if ($ary_times[$i_times] > $str_time_now) {
							list($now_hour, $now_min, $now_sec) = explode(":" ,$ary_times[$i_times]);
							$i_times = $int_totaltimes + 1;	
						} else if ($i_times == $int_totaltimes) {
							list($now_hour, $now_min, $now_sec) = explode(":" ,$ary_times[0]);
							$now_dag = $now_dag + 1;
						}
					}
				}
				// Update the task date and time
				$str_new_time = date("Y-m-d H:i:s", mktime($now_hour, $now_min, $now_sec, $now_maand, $now_dag , $now_jaar));
				$db_iwex->query("UPDATE events SET action_performed_date = '$str_new_time' WHERE id = '$str_task_id'");
			}
		} else if ($str_task_reccurtype == DB_TASK_OPTION_WEEK && $str_date_old <= $str_date_now) {
				// Do function
				$str_task_function();
				$ary_weeks = explode(",", $str_task_reccurweekdays);
				$int_totalweeks = count($ary_weeks) - 1;
				for ($i_days = 0 ; $i_days <= $int_totalweeks ; $i_days++) {
					if(ereg($int_weekday ,$str_task_reccurweekdays)) {
						if ($ary_weeks[$i_days] == $int_weekday && $i_days != $int_totalweeks) {
							$new_weekday = $ary_weeks[$i_days + 1];
						} else if ($ary_weeks[$i_days] == $int_weekday && $i_days == $int_totalweeks) {
							$new_weekday = $ary_weeks[0];
						}
					} else {
						if ($ary_weeks[$i_days] > $int_totalweeks) {
								$new_weekday = $ary_weeks[$i_days];
								$i_days = $int_totalweeks + 1;	
						} else if ($i_days == $int_totaldays) {
							$new_weekday = $ary_weeks[0];
						}
					}
				}
				if ($new_weekday <= $int_weekday) {
					$int_dayinterval = 7 - $int_weekday + $new_weekday;
				} else {
					$int_dayinterval = $new_weekday - $int_weekday; 
				}
				
				
				$db_iwex->query("UPDATE events SET 
								 approved = '$new_weekday',
								 action_performed_date = (DATE_ADD('$str_datetime', INTERVAL $int_dayinterval DAY))
								 WHERE id = '$str_task_id'");		

		} else if ($str_task_reccurtype == DB_TASK_OPTION_MONTH && $str_date_old <= $str_date_now) {
				// Do function
				$str_task_function();
				$ary_days = explode(",", $str_task_reccurday);
				$int_totaldays = count($ary_days) - 1;
					for ($i_days = 0 ; $i_days <= $int_totaldays ; $i_days++) {
						if (ereg($int_daynumber ,$str_task_reccurday)) {	
							if ($ary_days[$i_days] == $int_daynumber && $i_days != $int_totaldays) {
								$new_daynumber = $ary_days[$i_days + 1];
							} else if ($ary_days[$i_days] == $int_daynumber && $i_days == $int_totaldays) {
								$new_daynumber = $ary_days[0];
								$int_monthnumber = $int_monthnumber + 1;
							}
						} else {					
							if ($ary_days[$i_days] > $int_daynumber) {
									$new_daynumber = $ary_days[$i_days];
									$i_days = $int_totaldays + 1;	
							} else if ($i_days == $int_totaldays) {
								$new_daynumber = $ary_days[0];
								$int_monthnumber = $int_monthnumber + 1;
							}
						}
					}
				$str_new_date = date("Y-m-d H:i:s", mktime($now_hour, $now_min, $now_sec, $int_monthnumber, $new_daynumber , $now_jaar));
				$db_iwex->query("UPDATE events SET action_performed_date = '$str_new_date'
								 WHERE id = '$str_task_id'");
		} else if ($str_task_reccurtype == DB_TASK_OPTION_YEAR && $str_date_old <= $str_date_now) {
			// Do function
			$str_task_function();
			$ary_weeks = explode(",", $str_task_reccurweeks);
			$int_totalweeks = count($ary_weeks) - 1;

			for ($i_weeks = 0 ; $i_weeks <= $int_totalweeks ; $i_weeks++) {
				if (ereg($int_weeknumber, $str_task_reccurweeks)) {
					if ($ary_weeks[$i_weeks] == $int_weeknumber && $i_weeks != $int_totalweeks) {
						$new_weeknumber = $ary_weeks[$i_weeks + 1];
					} else if ($ary_weeks[$i_weeks] == $int_weeknumber && $i_weeks == $int_totalweeks) {
						$new_weeknumber = $ary_weeks[0];
						$now_jaar = $now_jaar + 1;
					}
				} else {
					if ($ary_weeks[$i_weeks] > $int_weeknumber) {
						$new_weeknumber = $ary_weeks[$i_weeks];
						$i_weeks = $int_totalweeks + 1;	
					} else if ($i_weeks == $int_totalweeks) {
						$new_weeknumber = $ary_weeks[0];
						$now_jaar = $now_jaar + 1;
					}
				}
			}
			if ($new_weeknumber <= $int_weeknumber) {
				$int_weeksinterval = 52 - $int_weeknumber + $new_weeknumber;
			} else {
				$int_weeksinterval = $new_weeknumber - $int_weeknumber; 
			}
			$int_weeksinterval = $int_weeksinterval * 7;
			$db_iwex->query("UPDATE events SET 
							 approved = '$new_weeknumber',
							 action_performed_date = (DATE_ADD('$str_datetime', INTERVAL $int_weeksinterval DAY))
							 WHERE id = '$str_task_id'");	
		}
	} else {
		echo "Er is geen functie beschikbaar voor de task <B>$str_task_title</B><BR>";
	}
}

?>