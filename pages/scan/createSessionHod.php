<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['hod'])){
  header("Location: index");
}

require_once("../../connection.php");
require_once("../../functions.php"); 
$msg = '';

if ($_GET['course'] == "") {
    $msg = "Error occurs while processing your request!";
    echo "<meta http-equiv='refresh' content='0;url=../../userHod?dir=courses&page=allCoursesTeacher&action=allCourse&error_msg=".$msg."'>";
} else {
    $courseId=$_GET['course'];
	$register_user_ID = $_SESSION['teacher'];
	$currentDate = date("Y-m-d");
	$curr_semester_id = getSemesterId();
	
    $qry = "INSERT INTO teaching_session(
		teacher_courses_id,
		semester_id,
		register_user_ID,
		date
		)values(
			'".$courseId."',
			'".$curr_semester_id."',
			'".$register_user_ID."',
			'".$currentDate."'
		)";
    $stmt = $dbh->prepare($qry);
    if($stmt->execute()){
        $msg='Session created successfully.';
		echo "<meta http-equiv='refresh' content='0;url=../../hodSession?course=".$courseId."&success_msg=".$msg."'>";
    } else {
        $msg='Deletion failed. Please contact Administrator.';
		echo "<meta http-equiv='refresh' content='0;url=../../userHod?dir=courses&page=allCoursesTeacher&action=allCourse&error_msg=".$msg."'>";
    }
}

?>