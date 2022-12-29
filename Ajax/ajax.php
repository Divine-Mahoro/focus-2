<?php
include('../connection.php');
if($_POST['id']){
$id=$_POST['id'];
if($id==0){
 echo "<option>Select Division</option>";
}else{
 $sql = ("SELECT * FROM divisions WHERE department_id ='$id'");
 if ($result = $dbh->query($sql)) {
 while($row = $result->fetch_array()){
 echo '<option value="'.$row['division_name'].'">'.$row['division_name'].'</option>';
}
}
}
}
 ?>
