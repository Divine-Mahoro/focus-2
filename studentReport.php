<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION[''])){
	
  header("Location: index.php");
}

require_once("connection.php");
require_once("functions.php");

if(isset($_GET['report'])){
	$asset = $_GET['asset'];
	$period = getDeclarationPeriodId();
	
	$qry1 = "SELECT * FROM declaration_submit WHERE employee_id = '".$emp."' AND declaration_period_id='".$period."'";
	$stmt = $dbh->prepare($qry1);
	$stmt->execute();
	if($stmt->rowCount() == 0){
		$qryIns = "INSERT INTO declaration_submit(employee_id,declaration_period_id) VALUES ('".$emp."','".$period."')";
		$stmt = $dbh->prepare($qryIns);
		$stmt->execute();
	}	
	$sql = "UPDATE declaration_submit SET ";
	$sql .= $asset . " = '1'";
	$sql .= " WHERE employee_id = '".$emp."' AND declaration_period_id='".$period."'";
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	
	echo "<meta http-equiv='refresh' content='0;url=staffUser.php?dir=submitted&page=submitDeclaration&c_s=".$asset."'>";
}

?>