<?PHP
include("include.php");
printheader ("Beheer Tasks");

$str_submit = isset($_REQUEST['submit']) ? $_REQUEST['submit'] : '';
$int_taskid = isset($_REQUEST['taskid']) ? $_REQUEST['taskid'] : '';
$str_title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
$str_description = isset($_POST['description']) ? $_POST['description'] : '';
$str_function = isset($_POST['functions']) ? $_POST['functions'] : '';
$str_reccurtype = isset($_POST['reccurtype']) ? $_POST['reccurtype'] : '';
$str_reccurtimes = isset($_POST['reccurtimes']) ? $_POST['reccurtimes'] : '';
$str_reccurtimesinterval = isset($_POST['reccurtimesinterval']) ? $_POST['reccurtimesinterval'] : '';
$str_reccurday = isset($_POST['reccurday']) ? $_POST['reccurday'] : '';
$str_reccurweekdays = isset($_POST['reccurweekdays']) ? $_POST['reccurweekdays'] : '';
$str_reccurweeks = isset($_POST['reccurweeks']) ? $_POST['reccurweeks'] : '';

$str_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$str_newquery = isset($_POST['query']) ? $_POST['query'] : '';
$str_delquery = isset($_GET['delquery']) ? $_GET['delquery'] : '';

$int_cronjob_yn = $str_function ? 1 : 0;

// Set array's and date.
$ary_functions = array("SetOverdueTypes");
$ary_time = array("1" =>  "1 min", "5 min", "10 min", "20 min", "30 min", "60 min", "1 uur", "2 uur", "5 uur", "10 uur", "12 uur");
$str_datetime = date(DATEFORMAT_LONG);

echo "<BODY ".get_bgcolor()."><FORM METHOD=\"post\" ACTION=\"".$_SERVER['PHP_SELF']."\" name='userform'>\n"; // start form to remember parameters , they will be submitted with authentication stuff
printIwexNav();

// Set needed query's
$sql_query_event = "SELECT query.ID, query.Name, query.statement FROM event_querys
				    JOIN query ON ID = queryid ";
					
$sql_query = "SELECT ID, Name, statement FROM query";
$sql_tasks = "SELECT id, events.title, description, created, emcreat.FirstName AS CreatBy, modified ,emmodby.FirstName AS ChangedBy, modified_by, reccurtype, reccurtimes, reccurtimesinterval, 
					 reccurday, reccurweekdays, reccurweeks, action_performed_date, emaction.FirstName AS ActionBy, functionname 
			  FROM events
			  LEFT JOIN employees emaction ON emaction.EmployeeID = action_done_by
			  LEFT JOIN employees emcreat ON emcreat.EmployeeID =  created_by
			  LEFT JOIN employees emmodby ON emmodby.EmployeeID =  modified_by";
			  
// If the option is update, the task will be updated
if ($str_submit == "Update") {
	// If query must be deleted
	if ($str_delquery) {
		$db_iwex->query("DELETE FROM event_querys 
						 WHERE taskid = '$int_taskid' and queryid = '$str_delquery' ");
	// Else the task need to be updated
	} elseif ($str_submit == "Update") {
		$db_iwex->query("UPDATE events SET
						 title = '$str_title',
						 description = '$str_description',
						 modified = '$str_datetime',
						 modified_by = '" .$GLOBALS["employee_id"] ."',
						 reccurtype = '$str_reccurtype',
						 reccurtimes = '$str_reccurtimes',
						 reccurtimesinterval = '$str_reccurtimesinterval',
						 reccurday = '$str_reccurday',
						 reccurweekdays = '$str_reccurweekdays',
						 reccurweeks = '$str_reccurweeks',
						 functionname = '$str_function',
						 Cronjob_yn = '$int_cronjob_yn'
						 where id = '$int_taskid'");
		// Insert new query
		if ($str_newquery) {
			$db_iwex->query("INSERT INTO event_querys(taskid, queryid)
							 VALUES('$int_taskid', '$str_newquery')");
		}
	}
// If the action is creating new task
} else if ($str_submit == "Creating") {

	$str_alert = new alert();
	$str_alert->check($str_title, "Er is geen <b>task naam</b> ingevoerd.");
	$str_alert->check($str_description, "Er is geen <b>task description</b> ingevoerd.");

	if ($str_alert->Showerror()) {
		echo $str_alert->Showerror();
	} else { 
		$db_iwex->query("INSERT INTO events(title, description, created, created_by, reccurtype ,reccurtimes, 
											reccurtimesinterval, reccurday, reccurweekdays, reccurweeks,
											functionname, Cronjob_yn, action_performed_date)
						VALUES ('$str_title','$str_description', '$str_datetime', '" .$GLOBALS["employee_id"] . "','$str_reccurtype',
								'$str_reccurtimes', '$str_reccurtimesinterval', '$str_reccurday', '$str_reccurweekdays',
								'$str_reccurweeks','$str_function',$int_cronjob_yn ,'$str_datetime')");
	}
	
	$int_taskid = mysql_insert_id();
	// Insert also a query if there is a query selected
	if ($str_newquery) {
		$db_iwex->query("INSERT INTO event_querys(taskid, queryid)
						 VALUES('$int_taskid', '$str_newquery')");
	}
}
// If action is deleting. The task will be deleted.
if ($str_action == "deleting") {
		$db_iwex->query("DELETE FROM event_querys 
						 WHERE taskid = '$int_taskid'");
		$db_iwex->query("DELETE FROM events 
						 WHERE id = '$int_taskid'");
	$int_taskid = "";
}

// Insert a where if there is a task id.
if ($int_taskid || $str_action == "Creating") {
	$sql_tasks .= " WHERE id ='" . $int_taskid . "'";
	$sql_query_event .= " WHERE event_querys.taskid='" . $int_taskid . "'";	
}

// Get results from the query's
$result_tasks_event = $db_iwex->query($sql_query_event); 
$result_tasks = $db_iwex->query($sql_tasks);

// Set table with task options and a form.
echo	"<input type = 'hidden' name='taskid' value='$int_taskid'>
		 <input type = 'hidden' name='action' value='$str_action'>";
echo	"<table border='1' cellspacing='0' cellpadding='2' class=\"blockbody\" width=\"100%\">\n
		<td>";
		
		if ($int_taskid || $str_action == "Creating") {
		echo "<b>$str_datetime</b><br><br><a href='tasks.php'>Task menu</a>";
		
			if ($int_taskid) {
				$obj_tasks = mysql_fetch_object($result_tasks);
				$str_action = "Update";
			}
			
			$str_task_title = isset ($obj_tasks->title) ? $obj_tasks->title : "";
			$str_task_desciption = isset($obj_tasks->description) ? $obj_tasks->description : "";
			$str_task_function = isset($obj_tasks->functionname) ? $obj_tasks->functionname : "";
  			$str_task_reccurtype = isset($obj_tasks->reccurtype) ? $obj_tasks->reccurtype : "";
			$str_task_reccurtimes = isset($obj_tasks->reccurtimes) ? $obj_tasks->reccurtimes : "";
			$str_task_reccurtimesinterval = isset($obj_tasks->reccurtimesinterval) ? $obj_tasks->reccurtimesinterval : "";
			$str_task_reccurday = isset($obj_tasks->reccurday) ? $obj_tasks->reccurday : "";
			$str_task_reccurweekdays = isset($obj_tasks->reccurweekdays) ? $obj_tasks->reccurweekdays : "";
			$str_task_reccurweeks = isset($obj_tasks->reccurweeks) ? $obj_tasks->reccurweeks : "";

			echo "
			<table border='0'>
			<tr>
			<td width=''>Task Options:</td>
			<td>
				<table>
				<tr>
				<td>Every:</td>
				<td>" . makelistbox("SELECT value, text FROM listbox WHERE category = 11 and text != 'kwartaal'" ,"reccurtype", "value", "text", "$str_task_reccurtype", "") . "</td>
				</tr>
				<tr>";
				if ($str_task_reccurtype == DB_TASK_OPTION_DAY) {
					echo "<td>Times:</td><td><input type='text' name='reccurtimes' VALUE = '$str_task_reccurtimes' size='10'> bijv: 10:50:00</td></tr>
					      <tr><tr><td>or every</td><td> " . makelistbox($ary_time ,"reccurtimesinterval", "", "", $str_task_reccurtimesinterval, "", "", "", TRUE) . "</td></tr>";
				} else if ($str_task_reccurtype == DB_TASK_OPTION_WEEK) {
					echo "<td>WeekDays:</td><td><input type='text' name='reccurweekdays' VALUE ='$str_task_reccurweekdays' size='10'>  0 Zondag t/m 6 Zaterdag</td>";
				} else if ($str_task_reccurtype == DB_TASK_OPTION_MONTH) {
					echo "<td>Days:</td><td><input type='text' name='reccurday' VALUE = '$str_task_reccurday' size='20'></td>";
				} else if ($str_task_reccurtype == DB_TASK_OPTION_YEAR) {
					echo "<td>Weeknummers:</td><td><input type='text' name='reccurweeks' VALUE = '$str_task_reccurweeks' size='10'></td>";				
				}
				echo "
				</td>
				</tr>
				</table>
			
			</td>
			</tr>
			<tr>
			<td width=''>Task Name:</td>
			<td><input type='text' NAME='title' VALUE = '" . $str_task_title . "'></td>
			</tr>
			<tr>
			<td width=''>Task Description:</td>
			<td><textarea NAME='description'>$str_task_desciption</textarea></td>
			</tr>
			<tr>
			<td>Functie:</td>
			<td>" . makelistbox($ary_functions ,"functions", "", "", $str_task_function, "", "", "", TRUE) . "</td>
			</tr>
			<tr>
			<tr>
			<td>Query's:</td>
			<td>" . makelistbox($sql_query ,"query", "ID", "Name" ) . "</td>
			</tr>
			<tr>
			<td width=''>&nbsp;</td>
			<td><input type='submit' Name='submit' value='$str_action'></td>
			</tr>
			</table>";
			
			echo "
			<BR>
			<table cellspacing = '0' cellpadding='5' width='100%'>
			<tr>
			<th>Query</th><th>Statement</th><th>Opties</th>
			</tr>";
				if ($result_tasks_event) {
					$bl_noquery = TRUE;
					while ($obj_query = mysql_fetch_object($result_tasks_event)) {
							echo "<tr><td>" . $obj_query->Name . "</td><td>" .  $obj_query->statement . "</td>
								  <td align='center'>
								  <a href= 'tasks.php?submit=Update&delquery=" . $obj_query->ID . "&taskid=" . $obj_tasks->id . 
								 "' onClick=\"return confirm('Weet u zeker dat u $obj_query->Name wilt verwijderen?')\">Verwijder</a>
								  </td>
								  </tr>";
							$bl_noquery = FALSE;
					}				
					if($bl_noquery) {
						echo "<tr><td colspan='3' align='center'> Er zijn geen query's toegevoegd.</td></tr>";
					}
				} else {
					echo "<tr><td colspan='3' align='center'> Er zijn geen query's toegevoegd.</td></tr>";
				}
	
			echo "</table>";

		} else {
			echo "
			<b>$str_datetime</b><br><br><a href='tasks.php?action=Creating'>New Task</a>
			<br><br>
			<table cellspacing = '0' cellpadding='5'>
			<tr>
			<th>Tasks</th><th>Description</th><th>Created</th><th>CreatedBy</th><th>modified</th><th>ModifiedBy</th><th>Next Date</th><th>Function</th><th>Action don by</th><th Colspan='2'>Options</th>
			</tr>";
			while ($obj = mysql_fetch_object($result_tasks)) {
				echo "<tr>
					 <td>" . $obj->title . "</td>
					 <td>" . $obj->description . "</td>
					 <td>" . $obj->created . "</td>
					 <td>" . $obj->CreatBy . "</td>
					 <td>" . $obj->modified . "</td>
					 <td>" . $obj->ChangedBy . "</td>
					 <td>" . $obj->action_performed_date . "</td>
					 <td>" . $obj->functionname . "</td>
					 <td>" . $obj->ActionBy . "</td><td><a href=\"" .$_SERVER['PHP_SELF']."?action=change&taskid=". $obj->id . "\">Wijzig</a></td>
					 <td><a href='".$_SERVER['PHP_SELF']."?action=deleting&taskid=$obj->id' onClick=\"return confirm('Weet u zeker dat u $obj->title wilt verwijderen?')\">Verwijder</td>
					 </tr>\n";
			}
			echo "</table>";
		}
		echo "
		</form>";

?>