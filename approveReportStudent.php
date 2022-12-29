<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['hod'])){
	
  header("Location: index.php");
}

require_once("connection.php");
require_once("functions.php");

if(isset($_GET['student'])){
	$studentId = $_GET['student'];
	$course = $_GET['course'];
	$comment = $_GET['comment'];
	$semester = getSemesterId();
	$currentDate = date("Y-m-d");
	$approve_by = $_SESSION['hod'];
	
	$qryUpd = "UPDATE report_students 
				   SET end_date='".$currentDate."' 
				   WHERE register_user_ID = '".$studentId."' and teacher_courses_id = '".$course."'";
		$stmtUpd = $dbh->prepare($qryUpd);
		$stmtUpd->execute();
	
	$qryIns = "INSERT INTO approve_student
		(
		register_user_ID,
		semester_id,
		teacher_courses_id,
		approved_by,
		comment,
		date
		) 
		VALUES (
		'".$studentId."',
		'".$semester."',
		'".$course."',
		'".$approve_by."',
		'".$comment."',
		'".$currentDate."')";
	$stmt = $dbh->prepare($qryIns);
	$stmt->execute();
	$msg = "Student approve successfull";
	echo "<meta http-equiv='refresh' content='0;url=userHod?dir=hod&page=approveStudent&success_msg=".$msg."'>";
}

?>