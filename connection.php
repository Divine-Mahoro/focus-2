<?php
//session_start();
include("backend/constants.php");

// Handling connection
try{
	$dbh = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASS);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
	echo $e->getMessage();
	die();
}
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set("Africa/Kigali");
// $deadline ="2021-07-31";
// $date = date("Y-m-d"); 
// if($date >= $deadline){
//     header('Location:deadline_message.php');
//     exit;
// }




function fetch_user_last_activity($user_id = NULL, $dbh)
{
    //global $dbh;

    if($user_id != NULL){
        $query = "
                 SELECT * FROM login_details 
                 WHERE employee_id = '$user_id' 
                 ORDER BY last_activity DESC 
                 LIMIT 1
                 ";
        $statement = $dbh->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row)
        {
            return $row['last_activity'];
        }
    }

}
?>