<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['employee'])){
  header("Location: <?php echo $main_link; ?>");
}

require_once("../../connection.php");
require_once("../../backend/functions.php"); 
$msg = '';

if (intval($_GET['delete']) == 0) {
    $msg = "Error occurs while processing your request!";
    echo "<meta http-equiv='refresh' content='0;url=../../staff.php?dir=incorporeal&page=deptInInstitution&error_msg=".$msg."'>";
} else {
    $id=$_GET['delete'];
    $delete_qry = "DELETE FROM incorporeal_debt_declarations 
                   WHERE incorporeal_debt_declaration_id ='".$id."' LIMIT 1";
    $stmt = $dbh->prepare($delete_qry);
    if($stmt->execute()){
        $msg='Record deleted successfully.';
		echo "<meta http-equiv='refresh' content='0;url=../../staff.php?dir=incorporeal&page=deptInInstitution&success_msg=".$msg."'>";
    } else {
        $msg='Deletion failed. Please contact Administrator.';
		echo "<meta http-equiv='refresh' content='0;url=../../staff.php?dir=incorporeal&page=deptInInstitution&error_msg=".$msg."'>";
    }
}

?>