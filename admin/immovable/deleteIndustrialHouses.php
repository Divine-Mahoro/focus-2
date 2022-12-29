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
    echo "<meta http-equiv='refresh' content='0;url=../../staff.php?dir=immovable&page=industrialHouses&immovable_asset_id=3&error_msg=".$msg."'>";
} else {
    $id=$_GET['delete'];
    $delete_qry = "DELETE FROM immovable_asset_declarations 
                   WHERE immovable_asset_declaration_id='".$id."' LIMIT 1";
    $stmt = $dbh->prepare($delete_qry);
    if($stmt->execute()){
        $msg='Record deleted successfully.';
		echo "<meta http-equiv='refresh' content='0;url=../../staff.php?dir=immovable&page=industrialHouses&immovable_asset_id=3&success_msg=".$msg."'>";
    } else {
        $msg='Deletion failed. Please contact Administrator.';
		echo "<meta http-equiv='refresh' content='0;url=../../staff.php?dir=immovable&page=industrialHouses&immovable_asset_id=3&error_msg=".$msg."'>";
    }
}

?>