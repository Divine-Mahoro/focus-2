<?php
require_once('connection.php');
$search_key = $_POST['key_val'];
$query = "SELECT * FROM employees WHERE given_name LIKE '%".$search_key."%' OR family_name LIKE '%".$search_key."%'";
echo '<option value="">Employee...</option>';
foreach($dbh->query($query) as $e){
	$eid = $e["employee_id"];
	$ename = $e["given_name"] . " " . $e["family_name"];
	echo ' <option value="'.$eid.'">'.$ename.'</option>';
}

?>