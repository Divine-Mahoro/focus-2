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
	$semester = getSemesterId();
	$currentDate = date("Y-m-d");
	
	$qryIns = "INSERT INTO report_students
		(register_user_ID,semester_id,teacher_courses_id,date) 
		VALUES (
		'".$studentId."',
		'".$semester."',
		'".$course."',
		'".$currentDate."')";
	$stmt = $dbh->prepare($qryIns);
	$stmt->execute();
	$msg = "Reporting student successfull";
	echo "<meta http-equiv='refresh' content='0;url=userHod?&dir=teacher&page=reportStudent&success_msg=".$msg."'>";
}

?>