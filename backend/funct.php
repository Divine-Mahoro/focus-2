<?php
// This file is the place to store all basic functions
function mysql_prep($value){
	$magic_quotes_active = get_magic_quotes_gpc();
	$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP > v4.3.0
	if( $new_enough_php ) { // PHP v4.3.0 or higher
	// undo any magic quote effects so mysql_real_escape_string can do the work
	if( $magic_quotes_active ) { $value = stripslashes( $value ); }
	//$value = mysql_real_escape_string( $value );
	} else { // before PHP v4.3.0
	// if magic quotes aren't already on then add slashes manually
	if( !$magic_quotes_active ) { $value = addslashes( $value ); }
	// if magic quotes are active, then the slashes already exist
	}
	return $value;
}

function prepare_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data, ENT_QUOTES);
  return $data;
}

function redirect_to( $location = NULL ) {
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}

function confirm_query($result_set){
if(!$result_set){
die("Database query failed: ".mysql_error());
    }
}

function tableNumRows($tableName = NULL){
    global $dbh;
    if($tableName != NULL){
        $sql = "SELECT COUNT(*) AS num_rows FROM " . $tableName;
        $stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	
    	if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	    extract($row);
    	    return $num_rows;
    	}
    }
    return NULL;
}

function tableNumRowsFiltered($tableName = NULL, $fieldName = NULL, $fieldValue = NULL){
    global $dbh;
    if($tableName != NULL && $fieldName != NULL && $fieldValue != NULL){
        $sql = "SELECT COUNT(*) AS num_rows FROM " . $tableName . " WHERE " . $fieldName . " = '".$fieldValue."'";
        $stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	
    	if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	    extract($row);
    	    return $num_rows;
    	}
    }
    return NULL;
}

function tableNumRowsFiltered2($tableName = NULL, $fieldsNames, $fieldsValues){
    global $dbh;
    $fieldsNamesLength = count($fieldsNames);
	$fieldsValuesLength = count($fieldsValues);

    if($tableName != NULL && $fieldsNamesLength > 0 && $fieldsNamesLength == $fieldsValuesLength){
        $query = "SELECT COUNT(*) AS num_rows FROM " . $tableName . " WHERE ";
        		for($i=0;$i<$fieldsNamesLength;$i++){
					$query .= $fieldsNames[$i] . " = '" . $fieldsValues[$i] . "' AND ";
				 }
		$query = chop($query," AND ");
        $stmt = $dbh->prepare($query);
    	$stmt->execute();
    	
    	if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	    extract($row);
    	    return $num_rows;
    	}
    }
    return NULL;
}

function get_employee_job_id($employee_id = NULL, $fieldNames, $fieldValues){
	global $dbh;
	$count_fields = count($fieldNames);
	$count_values = count($fieldValues);
	if($employee_id != NULL && $count_fields > 0 && $count_fields == $count_values){
		$query = "SELECT ej.id
				  FROM employees e, employeejob ej, jobtb j 
				  WHERE e.employee_id = ej.employee_id AND ej.job_id = j.job_id AND 
		          ";
		          for($i=0;$i<$count_fields;$i++){
					$query .= "ej." . $fieldNames[$i] . " = '" . $fieldValues[$i] . "' AND ";
				 }
		$query = chop($query," AND ");
        $stmt = $dbh->prepare($query);
    	$stmt->execute();

    	if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    		//return $row['id'];
    		extract($row);
    		return $id;
    	}
	}
}

function getFieldValueById($fieldName = NULL, $tableName = NULL, $id = NULL) { // $id assigned to the primary key field of {$tableName} table
	global $dbh;
	$idName = chop($tableName, "s");
	$idName = $idName . "_id";
	if($tableName == "jobtb"){
		$idName = "job_id";
	}
	$result='';
	if($fieldName != NULL && $tableName != NULL && $id != NULL){
	
		$query = "SELECT " . $fieldName . " AS result_name FROM ". $tableName . " WHERE " . $idName . " = ".$id;
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		if($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($res);
			$result = $result_name;
		}
	}
	return $result;
}

function getFieldValueById2($fieldName = NULL, $tableName = NULL, $idName = NULL, $idVal = NULL) { // $id assigned to the primary key field of {$tableName} table
	global $dbh;

	$result='';
	if($fieldName != NULL && $tableName != NULL && $idName != NULL && $id != NULL){
	
		$query = "SELECT " . $fieldName . " AS result_name FROM ". $tableName . " WHERE " . $idName . " = ".$idVal;
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		if($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($res);
			$result = $result_name;
		}
	}
	return $result;
}

function getFieldValueById3($fieldName = NULL, $tableName = NULL, $keyNames, $keyValues) { // $id assigned to the primary key field of {$tableName} table
	global $dbh;

	$result='';
	$num_keys = count($keyNames);
	if($fieldName != NULL && $tableName != NULL && $num_keys > 0 && $num_keys == count($keyValues)){
	
		$query = "SELECT " . $fieldName . " AS result_name FROM ". $tableName . " WHERE ";

				for($i=0;$i<$num_keys;$i++){
							$query .= $keyNames[$i] . " = ".$keyValues[$i]." AND ";
						 }
				$query = chop($query," AND ");

		$stmt = $dbh->prepare($query);
		$stmt->execute();
		if($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($res);
			$result = $result_name;
		}
	}
	return $result;
}

function getFieldValueByFields($requestedField = NULL,$tableName = NULL,$fieldsNames,$fieldsValues){
	global $dbh;
	$fieldsNamesLength = count($fieldsNames);
	$fieldsValuesLength = count($fieldsValues);

	if($requestedField != NULL && $tableName != NULL && $fieldsNamesLength > 0 && $fieldsNamesLength == $fieldsValuesLength){
		$query = "SELECT * FROM ". $tableName . " WHERE ";
				 for($i=0;$i<$fieldsNamesLength;$i++){
					$query .= $fieldsNames[$i] . " = '" . $fieldsValues[$i] . "' AND ";
				 }
		$query = chop($query," AND ");
		$stmt->execute();
		$affected_rows=$stmt->rowCount();
		if($result = $dbh->fetch(PDO::FETCH_ASSOC)){
			extract($result);
			return $$requestedField;
		}
	}
	return NULL;
}


function showTable($tableName = NULL,$tableFields = NULL) { 
	global $dbh;
	$num_fields = count($tableFields);
	echo '<table border="1"><tr>';
	for($i=0;$i<$num_fields;$i++){
		$title = preg_replace("#[^0-9a-z]#i","",$tableFields[$i]); // to remove underscores in table headers
		echo '<th>' . ucfirst($title) . '</th>';
	}
	echo '</tr>';  
	
	$num_records='';
	if($tableName != NULL && $tableFields != NULL){
		$query = "SELECT * FROM ". $tableName;
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		$num_records=$stmt->rowCount();
		
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
	    	extract($result);
			// display row contents
			echo '<tr>';
			for($i=0;$i<$num_fields;$i++){
				echo '<td>' . $$tableFields[$i] . '</td>';
			}
			echo '</tr>'; 
		}
		echo '</table>'; 
	}
	return $num_records;
}

function showTableWithOperations($tableName = NULL,$tableFields = NULL) { 
	global $dbh;
	$num_fields = count($tableFields);
	echo '<table border="1"><tr>';
	for($i=0;$i<$num_fields;$i++){
		$title = preg_replace("#[^0-9a-z]#i","",$tableFields[$i]); // to remove underscores in table headers
		echo '<th>' . ucfirst($title) . '</th>';
	}
	echo '<th>Operations</th>';
	echo '</tr>';                                 
	$linkName = chop($tableName,"s");
	$editLink = "edit" . $linkName;
	$deleteLink = "delete" . $linkName;
	$idName = $linkName . "_id";
	$num_records='';
	if($tableName != NULL && $tableFields != NULL){
		$query = "SELECT * FROM ". $tableName;
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		$num_records=$stmt->rowCount();
		
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
	    	extract($result);
			// display row contents
			echo '<tr>';
			for($i=0;$i<$num_fields;$i++){
				echo '<td>' . $$tableFields[$i] . '</td>';
			}  // Since $idName represents the name of id field, $$idName represents its value
			echo '<td><a href="?action='.$editLink.'&edit='.$$idName.'">Edit</a> | ';
			echo '<a href="?action='.$deleteLink.'&delete='.$$idName.'" ';
			echo 'onclick="return confirm(\'Are you sure you want to delete ' . $linkName . '?\');"'; // customize
			echo '>Delete</a></td>';
			echo '</tr>'; 
		}
		echo '</table>'; 
	}
	return $num_records;
}

function insertRecord($tableName = NULL,$fieldsNames,$fieldsValues){
	global $dbh;
	$fieldsNamesLength = count($fieldsNames);
	$fieldsValuesLength = count($fieldsValues);
	$affected_rows=0;
	if($tableName != NULL && $fieldsNamesLength > 0 && $fieldsNamesLength == $fieldsValuesLength){
		$query = "INSERT INTO ". $tableName . "(" ;
				 for($i=0;$i<$fieldsNamesLength;$i++){
					$query .= $fieldsNames[$i] . ", ";
				 }
		$query = chop($query,", ");
		$query .= ") VALUES (" ;
				for($i=0;$i<$fieldsNamesLength;$i++){
					$query .= "'" . $fieldsValues[$i] . "', ";
				 }
		$query = chop($query,", ");
		$query .= ")";
		$stmt = $dbh->prepare($query);
		$stmt->execute();
	                     
		$affected_rows=$stmt->rowCount();
	}
	return $affected_rows;
}

function insertRecordReturnId($tableName = NULL,$fieldsNames,$fieldsValues){
	global $dbh;
	$fieldsNamesLength = count($fieldsNames);
	$fieldsValuesLength = count($fieldsValues);
	$new_id=NULL;
	if($tableName != NULL && $fieldsNamesLength > 0 && $fieldsNamesLength == $fieldsValuesLength){
		$query = "INSERT INTO ". $tableName . "(" ;
				 for($i=0;$i<$fieldsNamesLength;$i++){
					$query .= $fieldsNames[$i] . ", ";
				 }
		$query = chop($query,", ");
		$query .= ") VALUES (" ;
				for($i=0;$i<$fieldsNamesLength;$i++){
					$query .= "'" . $fieldsValues[$i] . "', ";
				 }
		$query = chop($query,", ");
		$query .= ")";
		$stmt = $dbh->prepare($query);
		$stmt->execute();
	    $new_id = $dbh->lastInsertId();
	}
	return $new_id;
}

function updateRecord($id = NULL,$tableName = NULL,$fieldsNames,$fieldsValues){
	global $dbh;
	$idField = chop($tableName,"s");
	$idField = $idField . "_id";
	
	if($tableName == "jobtb"){
		$idField = "job_id";
	}
	if($tableName == "academic_achievements" || $tableName == "pro_achievements" || $tableName == "emptrainings" || $tableName == "affiliations"){
		$idField = "id";
	}
	$fieldsNamesLength = count($fieldsNames);
	$fieldsValuesLength = count($fieldsValues);
	$affected_rows=0;
	if($id != NULL && $tableName != NULL && $fieldsNamesLength > 0 && $fieldsNamesLength == $fieldsValuesLength){
		$query = "UPDATE ". $tableName . " SET " ;
				 for($i=0;$i<$fieldsNamesLength;$i++){
					$query .= $fieldsNames[$i] . " = '" . $fieldsValues[$i] . "', ";
				 }
		$query = chop($query,", ");
		$query .= " WHERE " . $idField . " = ".$id;
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		$affected_rows=$stmt->rowCount();
	}
	return $affected_rows;
}

function updateRecord2($idName = NULL, $idValue = NULL,$tableName = NULL,$fieldsNames,$fieldsValues){
	global $dbh;
	
	$fieldsNamesLength = count($fieldsNames);
	$fieldsValuesLength = count($fieldsValues);
	$affected_rows=0;
	if($idName != NULL && $idValue != NULL && $tableName != NULL && $fieldsNamesLength > 0 && $fieldsNamesLength == $fieldsValuesLength){
		$query = "UPDATE ". $tableName . " SET " ;
				 for($i=0;$i<$fieldsNamesLength;$i++){
					$query .= $fieldsNames[$i] . " = '" . $fieldsValues[$i] . "', ";
				 }
		$query = chop($query,", ");
		$query .= " WHERE " . $idName . " = ".$idValue;
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		$affected_rows=$stmt->rowCount();
	}
	return $affected_rows;
}

function updateRecord3($keyNames, $keyValues, $tableName = NULL, $fieldsNames, $fieldsValues){
	global $dbh;
	
	$fieldsNamesLength = count($fieldsNames);
	$fieldsValuesLength = count($fieldsValues);

	$keysLength = count($keyNames);
	$valuesLength = count($keyValues);

	$affected_rows=0;
	if($keysLength > 0 && $keysLength == $valuesLength && $tableName != NULL && $fieldsNamesLength > 0 && $fieldsNamesLength == $fieldsValuesLength){
		$query = "UPDATE ". $tableName . " SET " ;
				 for($i=0;$i<$fieldsNamesLength;$i++){
					$query .= $fieldsNames[$i] . " = '" . $fieldsValues[$i] . "', ";
				 }
		$query = chop($query,", ");
		$query .= " WHERE " ;

		for($i=0;$i<$keysLength;$i++){
			$query .= $keyNames[$i] . " = '" . $keyValues[$i] . "' AND ";
		}
		$query = chop($query," AND ");

		$stmt = $dbh->prepare($query);
		$stmt->execute();
		$affected_rows=$stmt->rowCount();
	}
	return $affected_rows;
}

function deleteRecord($idName = NULL, $idValue = NULL, $tableName = NULL){
	global $dbh;
	$fieldName = chop($tableName,"s");
	$fieldName = $fieldName . "_id";
	if($tableName == "categories"){
		$fieldName = "category_id";
	}
	$affected_rows = 0;
	if($id != NULL && $tableName != NULL){
		$query = "DELETE FROM ". $tableName . " WHERE " . $fieldName . " = " . $id . " LIMIT 1";
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		$affected_rows = $stmt->rowCount();
	}
	return $affected_rows;
}


function getDateString($date){
	$datestring=getWeekDay($date);
	$weekday = date('D',strtotime($date));
	
	$daynumber = date('j',strtotime($date));
	$datestring .= ", ".$daynumber;
	$month = date('M',strtotime($date));
	
	$datestring .= " ".$month;
	$year = date('Y',strtotime($date));
	$datestring .= " ".$year;
	
	return $datestring;
}

function get_date_string($date){
    $datestring="";
	$weekday = date('D',strtotime($date));
	$day;
	switch($weekday){
		case "Mon" : $day = "Monday"; break;
		case "Tue" : $day = "Tuesday"; break;
		case "Wed" : $day = "Wednesday"; break;
		case "Thu" : $day = "Thursday"; break;
		case "Fri" : $day = "Friday"; break;
		case "Sat" : $day = "Saturday"; break;
		case "Sun" : $day = "Sunday"; break;
	}
	$datestring .= $day;
	$daynumber = date('j',strtotime($date));
	$datestring .= ", ".$daynumber;
	$yearmonth = date('F',strtotime($date));
	
	$datestring .= " ".$yearmonth;
	$year = date('Y',strtotime($date));
	$datestring .= " ".$year;
	
	return $datestring;
	
}

function getWeekDay($date){
    $weekday = date('D',strtotime($date));
	return $weekday;
}

function get_kuwa($date){
    $weekday = date('D',strtotime($date));
	$kuwa;
	switch($weekday){
		case "Mon" : $kuwa = "kuwa mbere"; break;
		case "Tue" : $kuwa = "kuwa kabiri"; break;
		case "Wed" : $kuwa = "kuwa gatatu"; break;
		case "Thu" : $kuwa = "kuwa kane"; break;
		case "Fri" : $kuwa = "kuwa gatanu"; break;
		case "Sat" : $kuwa = "kuwa gatandatu"; break;
		case "Sun" : $kuwa = "ku cyumweru"; break;
	}
	
	return $kuwa;
}

function get_date($date){
    $datestring="";
	$daynumber = date('j',strtotime($date));
	$datestring .= $daynumber;
	$yearmonth = date('M',strtotime($date)); // m (in digits), F (in full)
	$datestring .= " ".$yearmonth;
	$year = date('Y',strtotime($date));
	$datestring .= " ".$year;
	
	return $datestring;
	
}

function get_date_time($date){
    $datestring="";
	$daynumber = date('j',strtotime($date));
	$datestring .= $daynumber;
	$yearmonth = date('M',strtotime($date)); // m (in digits), F (in full)
	$datestring .= " ".$yearmonth;
	$year = date('Y',strtotime($date));
	$datestring .= " ".$year;
	
	return $datestring . date(' H:i:s',strtotime($date));
	
}

function date_show($date){
    $datestring="";
	$daynumber = date('d',strtotime($date));
	$datestring .= $daynumber;
	$yearmonth = date('M',strtotime($date)); // m (in digits), F (in full)
	$datestring .= "-".$yearmonth;
	$year = date('Y',strtotime($date));
	$datestring .= "-".$year;
	
	return $datestring;
	
}

function get_new_date($date,$days){
	return date('Y-m-d',strtotime($date. ' + '.$days.' days' ));
	
}

function get_days_in_dates($date1,$date2){
	$start_date;
	$end_date;
	if($date2 >= $date1){
		$start_date = $date1;
		$end_date = $date2;
	} else {
		$start_date = $date2;
		$end_date = $date1;
	}
	$days = 0;
	while($start_date < $end_date)
	{
		$days++;
		$start_date = date('Y-m-d',strtotime($start_date. ' + 1 days' ));
	}
	return $days;
}

// Checks whwther the given date is in interval of date1 and date2 
function date_in_interval($given_date, $date1, $date2){
	
	$date_from = date('Y-m-d',strtotime($date1));
	$date_to = date('Y-m-d',strtotime($date2));

	$start_date = $date_from;
	$end_date = $date_to;	

	if($date_to < $date_from){
		$start_date = $date_to;
		$end_date = $date_from;
	} 

	$result = false;

	$curr_date = $start_date;

	while($curr_date <= $end_date)
	{
		if($curr_date == $given_date){ $result = true; break; }
		$curr_date = date('Y-m-d',strtotime($curr_date. ' + 1 days' ));
	}
	return $result;
}

// Returns employeejob id of overlaping record or returns -1 if given date does not overlap previous jobs in RRA
function overlaping_previous_job($employee_id = NULL, $given_date = NULL){
	global $dbh;
	$result = -1;
	if($employee_id != NULL && $given_date != NULL){
		$curr_job_id = getEmployeeCurrentJobId($employee_id);
		$sql = "SELECT ej.start_date,ej.end_date,ej.id AS emp_job_id 
				FROM employees e, employeejob ej, jobtb j 
				WHERE e.employee_id = ej.employee_id AND j.job_id = ej.job_id AND j.job_id <> '".$curr_job_id."' AND j.is_rra_job = 'yes' AND e.employee_id = '".$employee_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			if(date_in_interval($given_date, $start_date, $end_date)){
				$result = $emp_job_id;
			}
		}
	}
	return $result;
}

// Returns employeejob id of overlaping record or returns -1 if given date does not overlap jobs etxternal to RRA
function overlaping_external_job($employee_id = NULL, $given_date = NULL){
	global $dbh;
	$result = -1;
	if($employee_id != NULL && $given_date != NULL){
		$sql = "SELECT ej.start_date,ej.end_date,ej.id AS emp_job_id 
				FROM employees e, employeejob ej, jobtb j 
				WHERE e.employee_id = ej.employee_id AND j.job_id = ej.job_id AND j.is_rra_job = 'no' AND e.employee_id = '".$employee_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			if(date_in_interval($given_date, $start_date, $end_date)){
				$result = $emp_job_id;
			}
		}
	}
	return $result;
}

function overlaping_job($employee_id = NULL, $given_date = NULL){
	global $dbh;
	$result = -1;
	if($employee_id != NULL && $given_date != NULL){
		$curr_job_id = getEmployeeCurrentJobId($employee_id);
		$sql = "SELECT ej.start_date,ej.end_date,ej.id AS emp_job_id 
				FROM employees e, employeejob ej, jobtb j 
				WHERE e.employee_id = ej.employee_id AND j.job_id = ej.job_id AND ej.job_id <> '".$curr_job_id."' AND e.employee_id = '".$employee_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			if(date_in_interval($given_date, $start_date, $end_date)){
				$result = $emp_job_id;
				break;
			}
		}
	}
	return $result;
}


function overlaping_start_job_error_msg($check_date = NULL, $emp_job_id = NULL){
	global $dbh;
	$msg = null;
	if($check_date != NULL && $emp_job_id != NULL && $emp_job_id != -1){
		$sql = "SELECT * FROM employeejob WHERE id = '".$emp_job_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$msg = '
			How do you start a job on '.get_date($check_date).', and we see that you have another job from '.get_date($start_date).' to '.get_date($end_date).'?
			';
		}
	}
	return $msg;
}

function overlaping_end_job_error_msg($check_date = NULL, $emp_job_id = NULL){
	global $dbh;
	$msg = null;
	if($check_date != NULL && $emp_job_id != NULL && $emp_job_id != -1){
		$sql = "SELECT * FROM employeejob WHERE id = '".$emp_job_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$msg = '
			How do you work until '.get_date($check_date).', and we see that you have another job from '.get_date($start_date).' to '.get_date($end_date).'?
			';
		}
	}
	return $msg;
}

function overlaping_current_job($employee_id = NULL, $given_date = NULL){
	global $dbh;
	$result = false;
	if($employee_id != NULL && $given_date != NULL){
		$curr_job_id = getEmployeeCurrentJobId($employee_id);
		$sql = "SELECT * FROM employeejob WHERE employee_id = '".$employee_id."' AND job_id = '".$curr_job_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			if($given_date >= $start_date){
				$result = true;
				break;
			}
		}
	}
	return $result;
}

function overlaping_start_current_job_msg($employee_id = NULL, $given_date = NULL){
	global $dbh;
	$msg = null;
	if($employee_id != NULL && $given_date != NULL){
		$curr_job_id = getEmployeeCurrentJobId($employee_id);
		$sql = "SELECT * FROM employeejob WHERE employee_id = '".$employee_id."' AND job_id = '".$curr_job_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		extract($row);

		$msg = 'How do you start a job on ' . get_date($given_date) . ', and we see that your current job started on ' . get_date($start_date). '?';
	}
	return $msg;
}


function overlaping_end_current_job_msg($employee_id = NULL, $given_date = NULL){
	global $dbh;
	$msg = null;
	if($employee_id != NULL && $given_date != NULL){
		$curr_job_id = getEmployeeCurrentJobId($employee_id);
		$sql = "SELECT * FROM employeejob WHERE employee_id = '".$employee_id."' AND job_id = '".$curr_job_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		extract($row);

		$msg = 'How do you work until ' . get_date($given_date) . ', and we see that your current job started on ' . get_date($start_date).'?';
	}
	return $msg;
}

// Counting number of days an event will last based on dates (opening date and closing date)
function get_days_from_to($date1,$date2){
	$start_date = $date1;
	$end_date = $date2;
	$days = 0;
	while($start_date <= $end_date)
	{
		$days++;
		$start_date = date('Y-m-d',strtotime($start_date. ' + 1 days' ));
	}
	return $days;
}

function get_date_period($start_date,$end_date){
    $datestring="";
	$daynumber1 = date('j',strtotime($start_date));
	$daynumber2 = date('j',strtotime($end_date));
	$yearmonth1 = date('F',strtotime($start_date));
	$yearmonth2 = date('F',strtotime($end_date));
	$month1;
	switch($yearmonth1){
		case "January" : $month1 = "Mutarama"; break;
		case "February" : $month1 = "Gashyantare"; break;
		case "March" : $month1 = "Werurwe"; break;
		case "April" : $month1 = "Mata"; break;
		case "May" : $month1 = "Gicurasi"; break;
		case "June" : $month1 = "Kamena"; break;
		case "July" : $month1 = "Nyakanga"; break;
		case "August" : $month1 = "Kanama"; break;
		case "September" : $month1 = "Nzeri"; break;
		case "October" : $month1 = "Ukwakira"; break;
		case "November" : $month1 = "Ugushyingo"; break;
		case "December" : $month1 = "Ukuboza"; break;
	}
	
	$month2;
	switch($yearmonth2){
		case "January" : $month2 = "Mutarama"; break;
		case "February" : $month2 = "Gashyantare"; break;
		case "March" : $month2 = "Werurwe"; break;
		case "April" : $month2 = "Mata"; break;
		case "May" : $month2 = "Gicurasi"; break;
		case "June" : $month2 = "Kamena"; break;
		case "July" : $month2 = "Nyakanga"; break;
		case "August" : $month2 = "Kanama"; break;
		case "September" : $month2 = "Nzeri"; break;
		case "October" : $month2 = "Ukwakira"; break;
		case "November" : $month2 = "Ugushyingo"; break;
		case "December" : $month2 = "Ukuboza"; break;
	}
	
	$year1 = date('Y',strtotime($start_date));
	$year2 = date('Y',strtotime($end_date));
	if($year1 == $year2) {
		if($month1 == $month2){
			$datestring .= $daynumber1 . " - " . $daynumber2 . " " . $month1 . " " . $year1;
		} else {
			$datestring .= $daynumber1 . " " . $month1 . " - " .$daynumber2 . " " .$month2 . " " . $year1;
		}
	
	} else {
		$datestring .= $daynumber1 . " " . $month1 . " ". $year1 . " - " .$daynumber2 . " " .$month2 . " " . $year2;
	}
	return $datestring;
}

function duplicateValuesInArray($passedArray){
	$numberOfDuplicateValues = 0;
	$arrayLength = count($passedArray);
	if($arrayLength > 1){
		for($i = 0; $i < $arrayLength - 1; $i++){
			for($j = $i + 1; $j < $arrayLength; $j++){
				if($passedArray[$i] == $passedArray[$j]){ $numberOfDuplicateValues++; }
			}
		}
	}
	return $numberOfDuplicateValues;
}

function getNewDate($date,$days){
	return date('Y-m-d',strtotime($date. ' + '.$days.' days' ));	
}


function get_timespan_string($older, $newer) {
  $Y1 = $older->format('Y');
  $Y2 = $newer->format('Y');
  $Y = $Y2 - $Y1;

  $m1 = $older->format('m');
  $m2 = $newer->format('m');
  $m = $m2 - $m1;

  $d1 = $older->format('d');
  $d2 = $newer->format('d');
  $d = $d2 - $d1;

  $H1 = $older->format('H');
  $H2 = $newer->format('H');
  $H = $H2 - $H1;

  $i1 = $older->format('i');
  $i2 = $newer->format('i');
  $i = $i2 - $i1;

  $s1 = $older->format('s');
  $s2 = $newer->format('s');
  $s = $s2 - $s1;

  if($s < 0) {
    $i = $i -1;
    $s = $s + 60;
  }
  if($i < 0) {
    $H = $H - 1;
    $i = $i + 60;
  }
  if($H < 0) {
    $d = $d - 1;
    $H = $H + 24;
  }
  if($d < 0) {
    $m = $m - 1;
    $d = $d + get_days_for_previous_month($m2, $Y2);
  }
  if($m < 0) {
    $Y = $Y - 1;
    $m = $m + 12;
  }
  $timespan_string = create_timespan_string($Y, $m, $d, $H, $i, $s);
  return $timespan_string;
}

function get_days_for_previous_month($current_month, $current_year) {
  $previous_month = $current_month - 1;
  if($current_month == 1) {
    $current_year = $current_year - 1; //going from January to previous December
    $previous_month = 12;
  }
  if($previous_month == 11 || $previous_month == 9 || $previous_month == 6 || $previous_month == 4) {
    return 30;
  }
  else if($previous_month == 2) {
    //if(($current_year % 4) == 0) { //remainder 0 for leap years
    if((($current_year % 400) == 0) || (($current_year % 4) == 0 && ($current_year % 100) != 0)) { //remainder 0 for leap years
      return 29;
    }
    else {
      return 28;
    }
  }
  else {
    return 31;
  }
}

function create_timespan_string($Y, $m, $d, $H, $i, $s)
{
  $timespan_string = '';
  $found_first_diff = false;
  if($Y >= 1) {
    $found_first_diff = true;
    $timespan_string .= pluralize($Y, 'year').' ';
  }
  if($m >= 1 || $found_first_diff) {
    $found_first_diff = true;
    $timespan_string .= pluralize($m, 'month').' ';
  }
  if($d >= 1 || $found_first_diff) {
    $found_first_diff = true;
    $timespan_string .= pluralize($d, 'day').' ';
  }
  if($H >= 1 || $found_first_diff) {
    $found_first_diff = true;
    $timespan_string .= pluralize($H, 'hour').' ';
  }
  if($i >= 1 || $found_first_diff) {
    $found_first_diff = true;
    $timespan_string .= pluralize($i, 'minute').' ';
  }
  if($found_first_diff) {
    $timespan_string .= 'and ';
  }
  $timespan_string .= pluralize($s, 'second');
  return $timespan_string;
}

function pluralize( $count, $text )
{
  return $count . ( ( $count == 1 ) ? ( " $text" ) : ( " ${text}s" ) );
}



function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getUserId($user_type = NULL,$type_id = NULL){
    global $dbh;
    if($user_type != NULL && $type_id != NULL){
        $query = "SELECT * FROM users WHERE user_type = '".$user_type."' AND type_id = '".$type_id."'";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            return $user_id;
        }
    }
}


function intDay($date){
	$day = date('d',strtotime($date));
	return (int)$day;	
}
function strDay($date){
	$day = date('d',strtotime($date));
	return $day;	
}

function intMonth($date){
	$month = date('m',strtotime($date));
	return (int)$month;	
}
function strMonth($date){
	$month = date('m',strtotime($date));
	return $month;	
}

function intYear($date){
	$year = date('Y',strtotime($date));
	return (int)$year;	
}
function strYear($date){
	$year = date('Y',strtotime($date));
	return $year;	
}

function strFormat($number){
	$result = "";
	return (($number < 10)? $result."0".$number : $result.$number);
}

function monthTxt($m){
    if($m == 1){
        return "January";
    } else if($m == 2){
        return "February";
    } else if($m == 3){
        return "March";
    } else if($m == 4){
        return "April";
    } else if($m == 5){
        return "May";
    } else if($m == 6){
        return "June";
    } else if($m == 7){
        return "July";
    } else if($m == 8){
        return "August";
    } else if($m == 9){
        return "September";
    } else if($m == 10){
        return "October";
    } else if($m == 11){
        return "November";
    } else if($m == 12){
        return "December";
    }
    return NULL;
}

function monthShortTxt($m){
    if($m == 1){
        return "Jan";
    } else if($m == 2){
        return "Feb";
    } else if($m == 3){
        return "Mar";
    } else if($m == 4){
        return "Apr";
    } else if($m == 5){
        return "May";
    } else if($m == 6){
        return "Jun";
    } else if($m == 7){
        return "Jul";
    } else if($m == 8){
        return "Aug";
    } else if($m == 9){
        return "Sep";
    } else if($m == 10){
        return "Oct";
    } else if($m == 11){
        return "Nov";
    } else if($m == 12){
        return "Dec";
    }
    return NULL;
}



function getDepartments(){
	global $dbh;
	$departments = array();
	$sql = "SELECT * FROM departments";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	    extract($row);
	    $departments[] = $department_id;
	}
    return $departments;
}

function getDivisions(){
	global $dbh;
	$divisions = array();
	$sql = "SELECT * FROM divisions";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	    extract($row);
	    $divisions[] = $division_id;
	}
    return $divisions;
}

function getDepartmentDivisions($department_id = NULL){
	global $dbh;
	$divisions = array();
	if($department_id != NULL){
		$sql = "SELECT * FROM divisions WHERE department_id= '".$department_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		    extract($row);
		    $divisions[] = $division_id;
		}
	}	
    return $divisions;
}

function getUnits(){
	global $dbh;
	$units = array();
	$sql = "SELECT * FROM units";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	    extract($row);
	    $units[] = $unit_id;
	}
    return $units;
}

function getDivisionUnits($divion_id = NULL){
	global $dbh;
	$units = array();
	if($divion_id != NULL){
		$sql = "SELECT * FROM units WHERE division_id = '".$divion_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		    extract($row);
		    $units[] = $unit_id;
		}
	}
	
    return $units;
}

function getJobs(){
	global $dbh;
	$jobs = array();
	$sql = "SELECT * FROM jobtb";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	    extract($row);
	    $jobs[] = $job_id;
	}
    return $jobs;
}


function get_age($given_date = NULL){
	if($given_date > date("Y-m-d")){ return Null; }
	else if($given_date != NULL && (!empty(trim($given_date)))){
		return (date("Y") - date("Y",strtotime($given_date)));
	}
	return NULL;
}

function jobCompetencyCount($job_id = NULL, $competency = NULL){
    global $dbh;
    if($job_id != NULL && $competency != NULL){
        $sql = "SELECT COUNT(*) AS num_rows FROM jobcompetencies WHERE job_id = '".$job_id."' AND competency = '".$competency."'";
        $stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	
    	if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	    extract($row);
    	    return $num_rows;
    	}
    }
    return NULL;
}

function jobTrainingCount($job_id = NULL, $training = NULL){
    global $dbh;
    if($job_id != NULL && $training != NULL){
        $sql = "SELECT COUNT(*) AS num_rows FROM  jobtrainings WHERE job_id = '".$job_id."' AND training = '".$training."'";
        $stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	
    	if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	    extract($row);
    	    return $num_rows;
    	}
    }
    return NULL;
}


function jobRespoCount($job_id = NULL, $responsability = NULL){
    global $dbh;
    if($job_id != NULL && $responsability != NULL){
        $sql = "SELECT COUNT(*) AS num_rows FROM jobresponsabilities WHERE job_id = '".$job_id."' AND responsability = '".$responsability."'";
        $stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	
    	if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	    extract($row);
    	    return $num_rows;
    	}
    }
    return NULL;
}

function jobSkillCount($job_id = NULL, $skill = NULL, $skill_type = NULL){
    global $dbh;
    if($job_id != NULL && $skill != NULL && $skill_type != NULL){
        $sql = "SELECT COUNT(*) AS num_rows FROM jobskills WHERE job_id = '".$job_id."' AND skill = '".$skill."' AND skill_type = '".$skill_type."'";
        $stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	
    	if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	    extract($row);
    	    return $num_rows;
    	}
    }
    return NULL;
}

function jobDescCount($job_title = NULL, $grade = NULL, $company_name = NULL){
    global $dbh;
    if($job_title != NULL && $grade != NULL && $company_name != NULL){
        $sql = "SELECT COUNT(*) AS num_rows FROM  jobtb WHERE job_title = '".$job_title."' AND grade = '".$grade."' AND company_name = '".$company_name."'";
        $stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	
    	if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	    extract($row);
    	    return $num_rows;
    	}
    }
    return NULL;
}

function curr_job_status($employee_id = NULL){
	global $dbh;
	if($employee_id != NULL){
		return getFieldValueById("curr_job_flag","employees",$employee_id);
	}
	return NULL;
}

function profile_status($employee_id = NULL){
	global $dbh;
	if($employee_id != NULL){
		return getFieldValueById("profile_flag","employees",$employee_id);
	}
	return NULL;
}

function curr_job_filled($employee_id = NULL){
    global $dbh;
    if($employee_id != NULL){
        $sql = "UPDATE employees SET curr_job_flag = '1' WHERE employee_id = '". $employee_id ."' LIMIT 1 ";
        $stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	if($stmt->rowCount() > 0){
			return $stmt->rowCount();
		}
    }
    // when no action performed
    return null;
}

function profile_filled($employee_id = NULL){
    global $dbh;
    if($employee_id != NULL){
        $sql = "UPDATE employees SET profile_flag = '1' WHERE employee_id = '". $employee_id ."' LIMIT 1 ";
        $stmt = $dbh->prepare($sql);
    	$stmt->execute();
    	if($stmt->rowCount() > 0){
			return $stmt->rowCount();
		}
    }
    // when no action performed
    return null;
}

function addQualification(
    $employee_id = NULL, 
    $file_name = NULL, 
    $file_type = NULL, 
    $file_size = NULL, 
    $file_directory = NULL,
    $ref_name = NULL,
    $ref_id = NULL
)
{
    global $dbh;
    if(
        $employee_id != NULL &&
        $file_name != NULL &&
        $file_type != NULL &&
        $file_size != NULL &&
        $file_directory != NULL && 
        $ref_name != NULL && 
        $ref_id != NULL
    )
    {
       $sql = "INSERT INTO q_documents(".
              "q_document_id,employee_id,document_name,document_type,document_size,directory,ref_name,ref_id".
              ") VALUES (".
              "null,'".$employee_id."','".$file_name."','".$file_type."','".$file_size."','".$file_directory."','".$ref_name."','".$ref_id."')";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(); 
           
        return $dbh->lastInsertId();
    }
    return null;
}

function getProofDocumentAddress($tableName = NULL, $ref_name = NULL, $ref_id = NULL){
	global $dbh;
	if($tableName != NULL && $ref_name != NULL && $ref_id != NULL){
		$qry = "SELECT * FROM ".$tableName." WHERE ref_name = '".$ref_name."' AND ref_id = '".$ref_id."'";
		$stmt = $dbh->prepare($qry);
		$stmt->execute();
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			return $row['directory'];
		}
	}
	return NULL;
}

function getProofDocumentName($tableName = NULL, $ref_name = NULL, $ref_id = NULL){
	global $dbh;
	if($tableName != NULL && $ref_name != NULL && $ref_id != NULL){
		$qry = "SELECT * FROM ".$tableName." WHERE ref_name = '".$ref_name."' AND ref_id = '".$ref_id."'";
		$stmt = $dbh->prepare($qry);
		$stmt->execute();
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			return $row['document_name'];
		}
	}
	return NULL;
}

function updateQualification($document_name = NULL, $document_type = NULL, $document_size = NULL,  $directory = NULL, $tableName = NULL, $id = NULL){
	global $dbh;
	if($document_name != NULL && $document_type != NULL && $document_size != NULL && $directory != NULL && $tableName != NULL && $id != NULL){
		$qry = "UPDATE q_documents SET document_size = '".$document_size."', document_type = '".$document_type."', document_name = '".$document_name."', directory = '".$directory."' WHERE ref_name = '".$tableName."' AND ref_id = '".$id."'";
		$stmt = $dbh->prepare($qry);
		$stmt->execute();

		if($stmt->rowCount() == 1){
			return true;
		}
	}
	return false;
}

function updateTraining($document_name = NULL, $document_type = NULL, $document_size = NULL,  $directory = NULL, $tableName = NULL, $id = NULL){
	global $dbh;
	if($document_name != NULL && $document_type != NULL && $document_size != NULL && $directory != NULL && $tableName != NULL && $id != NULL){
		$qry = "UPDATE t_documents SET document_size = '".$document_size."', document_type = '".$document_type."', document_name = '".$document_name."', directory = '".$directory."' WHERE ref_name = '".$tableName."' AND ref_id = '".$id."'";
		$stmt = $dbh->prepare($qry);
		$stmt->execute();

		if($stmt->rowCount() == 1){
			return true;
		}
	}
	return false;
}

function addTraining(
    $employee_id = NULL, 
    $file_name = NULL, 
    $file_type = NULL, 
    $file_size = NULL, 
    $file_directory = NULL,
    $ref_name = NULL,
    $ref_id = NULL
)
{
    global $dbh;
    if(
        $employee_id != NULL &&
        $file_name != NULL &&
        $file_type != NULL &&
        $file_size != NULL &&
        $file_directory != NULL && 
        $ref_name != NULL && 
        $ref_id != NULL
    )
    {
       $sql = "INSERT INTO t_documents(".
              "t_document_id,employee_id,document_name,document_type,document_size,directory,ref_name,ref_id".
              ") VALUES (".
              "null,'".$employee_id."','".$file_name."','".$file_type."','".$file_size."','".$file_directory."','".$ref_name."','".$ref_id."')";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(); 
           
        return $dbh->lastInsertId();
    }
    return null;
}

function getEmployeeName($employee_id = NULL){
	global $dbh;
	$result = '';
	if($employee_id != NULL){
	    $sql = "SELECT * FROM employees WHERE employee_id = '".$employee_id."'";
	    $stmt = $dbh->prepare($sql);
	    $stmt->execute();
	    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	        extract($row);
	        $result = $given_name . " " . $family_name;
	    }
	}
    return $result;
}

function getEmployeeGivenName($employee_id = NULL){
	global $dbh;
	$result = '';
	if($employee_id != NULL){
	    $sql = "SELECT * FROM employees WHERE employee_id = '".$employee_id."'";
	    $stmt = $dbh->prepare($sql);
	    $stmt->execute();
	    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	        extract($row);
	        $result = $given_name;
	    }
	}
    return $result;
}

function getEmployeeFamilyName($employee_id = NULL){
	global $dbh;
	$result = '';
	if($employee_id != NULL){
	    $sql = "SELECT * FROM employees WHERE employee_id = '".$employee_id."'";
	    $stmt = $dbh->prepare($sql);
	    $stmt->execute();
	    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	        extract($row);
	        $result = $family_name;
	    }
	}
    return $result;
}

function getEmployeeJoinDate($employee_id = NULL){
	global $dbh;
	$result = '';
	if($employee_id != NULL){
	    $sql = "SELECT * FROM employees WHERE employee_id = '".$employee_id."'";
	    $stmt = $dbh->prepare($sql);
	    $stmt->execute();
	    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	        extract($row);
	        $result = $join_date;
	    }
	}
    return $result;
}

function getEmployeeJoinYear($employee_id = NULL){
	if($employee_id != NULL){
		return date('Y',strtotime(getEmployeeJoinDate($employee_id)));
	}
}

function getEmployeeGender($employee_id = NULL){
	global $dbh;
	$result = '';
	if($employee_id != NULL){
	    $sql = "SELECT * FROM employees WHERE employee_id = '".$employee_id."'";
	    $stmt = $dbh->prepare($sql);
	    $stmt->execute();
	    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	        extract($row);
	        $result = $gender;
	    }
	}
    return $result;
}

function getEmployeeCurrentJob($employee_id = NULL){
	global $dbh;
	$result = '';
	if($employee_id != NULL){
	    $job_id = getFieldValueById("curr_job_id","employees",$employee_id);
	    if($job_id != 0){
	    	$result = getFieldValueById("job_title","jobtb",$job_id);
	    }
	}
    return $result;
}

function getEmployeeCurrentJobId($employee_id = NULL){
	if($employee_id != NULL){
		return getFieldValueById("curr_job_id","employees",$employee_id);
	}
	return NULL;
}

/*****************************************************************************************************
EMPLOYEE EXPERIENCE FUNCTION STUDY
******************************************************************************************************/
// Find start date for any job when employee id and job id are known
function get_job_start_date($employee_id = NULL, $job_id = NULL){
	global $dbh;
	if($employee_id != NULL && $job_id != NULL){
		$sql = "SELECT * FROM employeejob WHERE employee_id = '".$employee_id."' AND job_id = '".$job_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			return $start_date;
		}
	}
	return NULL;
}

function print_pro_achievements($employee_id = NULL){
	global $dbh;
	$out = '<ul>';
	if($employee_id != NULL){
		$sql = "SELECT * FROM pro_achievements WHERE employee_id = '".$employee_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			echo '<li>'.$qualification.' (from '.get_date($start_date).' to '.get_date($end_date).')</li>';
		}
	}
	$out .= '</ul>';
	echo $out;
}

function print_trainings($employee_id = NULL){
	global $dbh;
	$out = '';
	if($employee_id != NULL){
		$sql = "SELECT * FROM emptrainings WHERE employee_id = '".$employee_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$out .= '<table border="1" cellspacing="1">';
			$out .= '<tr>';
			$out .= '<th>Course Name</th>';
			$out .= '<th>Training Provider</th>';
			$out .= '<th>Country</th>';
			$out .= '<th>Start date</th>';
			$out .= '<th>End date</th>';
			$out .= '</tr>';
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$out .= '<tr>';
				$out .= '<td>'.$course_name.'</td>';
				$out .= '<td>'.$training_provider.'</td>';
				$out .= '<td>'.$country.'</td>';
				$out .= '<td>'.get_date($start_date).'</td>';
				$out .= '<td>'.get_date($end_date).'</td>';
				$out .= '</tr>';
			}
			$out .= '</table>';
		} else {
			$out .= 'No trainings entered for this employee.';
		}
		
	}
	
	echo $out;
}

function print_affiliations($employee_id = NULL){
	global $dbh;
	$out = '';
	if($employee_id != NULL){
		$sql = "SELECT * FROM affiliations WHERE employee_id = '".$employee_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$out .= '<table border="1" cellspacing="1">';
			$out .= '<tr>';
			$out .= '<th>Organization</th>';
			$out .= '<th>Affiliation Type</th>';
			$out .= '</tr>';
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$out .= '<tr>';
				$out .= '<td>'.$organization.'</td>';
				$out .= '<td>'.$affiliation_type.'</td>';
				$out .= '</tr>';
			}
			$out .= '</table>';
		} else {
			$out .= 'No affiliations entered for this employee.';
		}
		
	}
	
	echo $out;
}

// Find years of experience for employee current job (should be in RRA)
function current_job_exp($employee_id = NULL){
	global $dbh;
	$years = 0;	
	if($employee_id != NULL){
		$curr_job_id = getEmployeeCurrentJobId($employee_id);
		$date1 = get_job_start_date($employee_id, $curr_job_id);
		$date2 = date("Y-m-d");
		$year1 = intYear($date1);
		$year2 = intYear($date2);
		$years = $year2 - $year1;
	}
	return $years;
}

// Find years of experience for employee's previous jobs in RRA (other than current job) if any
function rra_prev_job_exp($employee_id = NULL){
	global $dbh;
	$count_years = 0;
	if($employee_id != NULL){
		$curr_job_id = getEmployeeCurrentJobId($employee_id);
		$sql = "SELECT ej.start_date, ej.end_date 
				FROM employees e,employeejob ej, jobtb j 
				WHERE e.employee_id = ej.employee_id AND j.job_id = ej.job_id AND is_rra_job = 'yes' AND e.employee_id = '".$employee_id."' AND ej.job_id <> '".$curr_job_id."'
				";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$year1 = intYear($start_date);
			$year2 = intYear($end_date);
			$years = $year2 - $year1;
			$count_years = $count_years + $years;
		}
	}
	return $count_years;
}

// Find number of job records an employees has had in RRA
function rra_prev_job_count($employee_id = NULL){
	global $dbh;
	$record_count = 0;
	if($employee_id != NULL){
		$curr_job_id = getEmployeeCurrentJobId($employee_id);
		$sql = "SELECT ej.start_date, ej.end_date 
				FROM employees e,employeejob ej, jobtb j 
				WHERE e.employee_id = ej.employee_id AND j.job_id = ej.job_id AND is_rra_job = 'yes' AND e.employee_id = '".$employee_id."' AND ej.job_id <> '".$curr_job_id."'
				";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$record_count = $stmt->rowCount();
	}
	return $record_count;
}

function emp_exp_in_rra($employee_id = NULL){
	if($employee_id != NULL){
		return (rra_prev_job_exp($employee_id) + current_job_exp($employee_id));
	}
	return NULL;
}

function emp_exp_outside_rra($employee_id = NULL){
	if($employee_id != NULL){
		return external_job_exp($employee_id);
	}
	return NULL;
}

// Find years of experience for employee's jobs outside RRA
function external_job_exp($employee_id = NULL){
	global $dbh;
	$count_years = 0;
	if($employee_id != NULL){
		$sql = "SELECT ej.start_date, ej.end_date 
				FROM employees e,employeejob ej, jobtb j 
				WHERE e.employee_id = ej.employee_id AND j.job_id = ej.job_id AND is_rra_job = 'no' AND e.employee_id = '".$employee_id."'
				";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$year1 = intYear($start_date);
			$year2 = intYear($end_date);
			$years = $year2 - $year1;
			$count_years = $count_years + $years;
		}
	}
	return $count_years;
}

// Find number of jobs an employee has had outside RRA
function external_job_count($employee_id = NULL){
	global $dbh;
	$record_count = 0;
	if($employee_id != NULL){
		$sql = "SELECT ej.start_date, ej.end_date 
				FROM employees e,employeejob ej, jobtb j 
				WHERE e.employee_id = ej.employee_id AND j.job_id = ej.job_id AND is_rra_job = 'no' AND e.employee_id = '".$employee_id."'
				";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$record_count = $stmt->rowCount();
	}
	return $record_count;
}

/*****************************************************************************************************
END OF EMPLOYEE EXPERIENCE FUNCTION STUDY
******************************************************************************************************/

function getEmployeeGrade($employee_id = NULL){
	if($employee_id != NULL){
		$curr_job_id = getEmployeeCurrentJobId($employee_id);
		return getFieldValueById("grade","jobtb",$curr_job_id);
	}
	return NULL;
}

function getEmployeeLevel($employee_id = NULL){
	global $dbh;
	if($employee_id != NULL){
		$sql = "SELECT * FROM academic_achievements WHERE employee_id = '".$employee_id."'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			return $row['level'];
		}
	}
	return NULL;
}

function printEmployeeResponsabilities($employee_id = NULL, $curr_job = NULL){
	global $dbh;
	if($employee_id != NULL && $curr_job != NULL){
	    $sql = "SELECT * FROM empresponsabilities WHERE employee_id = '".$employee_id."' AND job_id = '".$curr_job."'";
	    echo '<ol type="1">';
	    foreach($dbh->query($sql) as $row){
	    	echo '<li>'.$row["responsability"].'</li>';
	    }
	    echo '</ol>';
	}
}

function printEmployeeExperiences($employee_id = NULL){
	global $dbh;
	if($employee_id != NULL){
	    $sql = "SELECT * FROM empexperiences WHERE employee_id = '".$employee_id."'";
	    foreach($dbh->query($sql) as $row){
	    	echo "<p>".$row['experience']."</p>";
	    }
	}
}

function getEmployeeHighestEducation($employee_id = NULL){
	global $dbh;
	$result = '';
	if($employee_id != NULL){
	    $sql = "SELECT * FROM academic_achievements WHERE employee_id = '".$employee_id."' ORDER BY end_date DESC LIMIT 1";
	    $stmt = $dbh->prepare($sql);
	    $stmt->execute();
	    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	        extract($row);
	        $result = $qualification . " " . $specialization . " from " . $institution . " in " . $country;
	    }
	}
	return $result;
}

function getEmployeeQualification($employee_id = NULL){
	global $dbh;
	$result = '';
	if($employee_id != NULL){
	    $sql = "SELECT * FROM academic_achievements WHERE employee_id = '".$employee_id."' ORDER BY end_date DESC LIMIT 1";
	    $stmt = $dbh->prepare($sql);
	    $stmt->execute();
	    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	        extract($row);
	        $result = $qualification . '('.$level.')';
	        if(!empty(trim($specialization))){ $result .= ' specialized in ' . $specialization; }
	    }
	}
	return $result;
}

function getEmployeeInstitution($employee_id = NULL){
	global $dbh;
	$result = '';
	if($employee_id != NULL){
	    $sql = "SELECT * FROM academic_achievements WHERE employee_id = '".$employee_id."' ORDER BY end_date DESC LIMIT 1";
	    $stmt = $dbh->prepare($sql);
	    $stmt->execute();
	    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	        extract($row);
	        $result = $institution . " in " . $country;
	    }
	}
	return $result;
}

function getEmployeeSkills($employee_id = NULL){
	global $dbh;
	$skills = array();
	if($employee_id != NULL){
		$sql = "SELECT * FROM employeeskills WHERE employee_id = '".$employee_id."'";
		foreach($dbh->query($sql) as $row){
			$skill = $row['skill_type'] . ": " . $row['skill'] . " (" . $row['proficiency'] . ")";
			$skills[] = $skill;
		}
	}
	return $skills;
}

function getEmployeeDepartment($employee_id = NULL){
	global $dbh;
	$result = '';
	if($employee_id != NULL){
	    $job_id = getFieldValueById("curr_job_id","employees",$employee_id);
	    if($job_id != 0){
	    	$department_id = getFieldValueById("department_id","jobtb",$job_id);
	    	$result = getFieldValueById("department_name","departments",$department_id);
	    }
	}
    return $result;
}

function getEmployeeSupervisor($employee_id = NULL){
	global $dbh;
	$result = '';
	if($employee_id != NULL){
	    $job_id = getFieldValueById("curr_job_id","employees",$employee_id);
	    if($job_id != 0){
	    	$supervisor_id = getFieldValueById("supervisor","jobtb",$job_id);
	    	$result = getFieldValueById("job_title","jobtb",$supervisor_id);
	    }
	}
    return $result;
}

function setEmployeeCurrentJob($employee_id = NULL, $job_id = NULL){
	global $dbh;
	if($employee_id != NULL && $job_id != NULL){
	    $sql = "UPDATE employees SET curr_job_id = '".$job_id."' WHERE employee_id = '".$employee_id."'";
	    $stmt = $dbh->prepare($sql);
	    $stmt->execute();
	    if($stmt->rowCount() > 0){
	        return true;
	    }
	}
    return false;
}

function validatePassword($my_password){
if((strlen($my_password)<8)||(!preg_match('/[A-Z]/', $my_password))||(!preg_match('/[a-z]/',$my_password))||(!preg_match('/[^a-zA-Z\d]/', $my_password))||(!preg_match('/[0-9]/',$my_password))){
  return false;
}
else{
	return true;
}
}

function countRecords($query = NULL){
	global $dbh;
	$result = 0;
	$stmt = $dbh->prepare($query);
	$stmt->execute();
	if($stmt->rowCount()){
  		$row = $stmt->fetch(PDO::FETCH_ASSOC);
  		$result = $row['all_count'];
	}
	return $result;
}


// Function to return job record id when record exists or null if record does not exist
function get_job_record_id
(
	$dep_id = NULL, 
	$div_id = NULL, 
	$unit_id = NULL, 
	$job_title = NULL, 
	$grade = NULL, 
	$is_rra_job = NULL, 
	$company = NULL, 
	$job_cat = NULL
)
{
	global $dbh;
	if(
		$dep_id != NULL && 
		$div_id != NULL && 
		$unit_id != NULL && 
		$job_title != NULL && 
		$grade != NULL && 
		$is_rra_job != NULL && 
		$company != NULL && 
		$job_cat != NULL
	)
	{
		$sql = "SELECT * FROM jobtb 
				WHERE department_id = '".$dep_id."' AND 
				division_id = '".$dep_id."' AND 
				department_id = '".$div_id."' AND 
				unit_id = '".$unit_id."' AND 
				job_title = '".$job_title."' AND 
				grade = '".$grade."' AND 
				is_rra_job = '".$is_rra_job."' AND 
				company_name = '".$company."' AND 
				job_category = '".$job_cat."'
				";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			return $row['job_id'];
		}
	}
	return NULL;
}

function level_one_display(){
	global $dbh;
	$query = "SELECT * FROM structures WHERE level = 1";
	$stmt = $dbh->prepare($query);
	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		if(has_child($row['structure_id'])){ display_link($row['structure_id']); } else { display_item($row['structure_id']); }
	}
}

function display_link($id = NULL){
	global $dbh;
	$childs = get_childs($id);
	if($id != NULL){
		echo '
			<li class="treeview">
		        <a href="">
		            <i class="fa fa-table"></i> <span id="'.$id.'" ondblclick ="document.getElementById(\'structure_manager\').innerHTML = loadPage(\'structure_form.php\',this.id);">
		            '.getFieldValueById("structure_name","structures",$id).'</span>
		            <span class="pull-right-container">
		              <i class="fa fa-angle-left pull-right"></i>
		            </span>
		        </a>

		        <ul class="treeview-menu">';
		        foreach($childs as $child){
		        	if(has_child($child)){ display_link($child); } else { display_item($child); }
		        }
		    echo '
		        </ul>
		    </li>
		';
	}
}

function has_child($id = NULL){
	global $dbh;
	if($id != NULL){
		$query = "SELECT * FROM structures WHERE reference_id = '".$id."'";
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			return true;
		}
	}
	return false;
}

function get_childs($id = NULL){
	global $dbh;
	$childs = array();
	if($id != NULL){
		$query = "SELECT * FROM structures WHERE reference_id = '".$id."'";
		foreach($dbh->query($query) as $row){
			$childs[] = $row['structure_id'];
		}
	}
	return $childs;
}

function display_item($id = NULL){
	global $dbh;
	if($id != NULL){
		echo '
		<li><a href="">
		            <i class="fa fa-table"></i> <span id="'.$id.'" ondblclick ="document.getElementById(\'structure_manager\').innerHTML = loadPage(\'structure_form.php\',this.id);">
		            '.getFieldValueById("structure_name","structures",$id).'</span>
		        </a>

		</li>';
	}
}


?>