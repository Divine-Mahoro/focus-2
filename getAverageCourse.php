<?php
require_once('connection.php');
require_once('functions.php');

	if(isset($_POST['course'])){
		$course = $_POST['course'];
		
		$register_user_id = $_POST['user'];
		
		$sqlSession = "select count(*) as session from teaching_session where teacher_courses_id = '".$course."'";
		$stmtSession = $dbh->prepare($sqlSession);
		$stmtSession -> execute();
		if($rowSession = $stmtSession->fetch(PDO::FETCH_ASSOC)){
			$resultSession = $rowSession["session"];
		}
		
		$sqlAttend = "select count(*) as attended from teacher_attandance where register_user_ID = '".$register_user_id."' and teacher_courses_id = '".$course."'";
		$stmtAttend = $dbh->prepare($sqlAttend);
		$stmtAttend -> execute();
		if($rowAttend = $stmtAttend->fetch(PDO::FETCH_ASSOC)){
			$resultAttend = $rowAttend["attended"];
		}
		
		$sqlCourse = "select course_name as coursename from  teacher_courses where teacher_courses_id = '".$course."'";
		$stmtCourse = $dbh->prepare($sqlCourse);
		$stmtCourse -> execute();
		if($rowCourse = $stmtCourse->fetch(PDO::FETCH_ASSOC)){
			$resultCourse = $rowCourse["coursename"];
		}
			
		$data["session"] = $resultSession;
		$data["attended_session"] = $resultAttend;
		$data["course_name"] = $resultCourse;
			
		echo json_encode($data);
	}
	 else {
		 $data["session"] = "22";
		$data["attended_session"] = "6";
		$data["course_name"] = "0";
		echo json_encode($data);
	}


?>