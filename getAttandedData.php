<?php
require_once('connection.php');
require_once('functions.php');

if(isset($_POST['c'])){
	$str = $_POST['c'];
	$found = explode('-',$str);
	$user = $found[0];
	$cou = $found[1];
	$register_user_ID = $found[0];
	$course = $_POST['course'];
	$currentDate = date("Y-m-d");
	
	$sqlCourse = "SELECT course_name FROM `register_course` WHERE register_user_ID = '".$register_user_ID."' and course_id = '".$course."'";
	$stmtCourse = $dbh->prepare($sqlCourse);
	$stmtCourse->execute();
	
	$sqlReport = "SELECT * FROM `report_students` WHERE register_user_ID = '".$register_user_ID."' and teacher_courses_id='".$course."' and end_date is null";
	$stmtReport = $dbh->prepare($sqlReport);
	$stmtReport->execute();
	
	$sqlAttend = "select * from teacher_attandance where register_user_ID = '".$register_user_ID."' and teacher_courses_id='".$course."' and date = '".$currentDate."'";
	$stmtAttend = $dbh->prepare($sqlAttend);
	$stmtAttend->execute();
	
	if($row=$stmtAttend->fetch(PDO::FETCH_ASSOC)){
		
		$data = 0;
	}
	else if($rowreport=$stmtReport->fetch(PDO::FETCH_ASSOC)){
		$data = 1;
	}
	
	else if(!$rowCourse=$stmtCourse->fetch(PDO::FETCH_ASSOC)){
		$data = 2;
	}
	else if($cou != $course){
		$data = 3;
	}
	else{
	
		$check = "select * from register_course where register_user_ID = '".$register_user_ID."' and course_id='".$course."'";
		$stmt = $dbh->prepare($check);
		$stmt->execute();
		$msg = "Reaching";
		if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			$currentDate = date("Y-m-d");
			$curr_semester_id = getSemesterId();
			$course_session = getCourseSession($course);
			
			if($course_session)
			$qry = "INSERT INTO teacher_attandance(
				teacher_courses_id,
				semester_id,
				register_user_ID,
				teaching_session_id ,
				date
				)values(
					'".$course."',
					'".$curr_semester_id."',
					'".$register_user_ID."',
					'".$course_session."',
					'".$currentDate."'
				)";
			$stmt = $dbh->prepare($qry);
			if($stmt->execute()){
				$msg='Attandance Registered Successful.';
				$data = $msg;
				
			} else {
				$msg='Fail To register.';
				$data = $msg;
			}
		}else{
			$msg='You are not registered in this course.';
			$data = $msg;
		}
	}
	echo $data;
}
?>