<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['employee'])){
  header("Location: index.php");
}

require_once("../../../connection.php");
require_once("../../../backend/functions.php");
$employee_id;
if(isset($_SESSION['employee'])){ 
  $employee_id = $_SESSION['employee'];
  $sql = "SELECT * FROM employees where employee_id='$employee_id'";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $name = $row['family_name'] . ' ' . $row['given_name'];
  
  $sqlBought = "SELECT COUNT(*) AS BOUGHT FROM bought_asset WHERE employee_id='$employee_id'";
  $stmtBought = $dbh->prepare($sqlBought);
  $stmtBought -> execute();
  $rowBought = $stmtBought->fetch(PDO::FETCH_ASSOC);
  $resultBought = $rowBought['BOUGHT'];

  
$main_link="staff.php"; 
}

?>


<?php 
				if(isset($_GET["action"]) and $_GET["action"]="add"){
					include("pages/boughtAsset/forms/boughtForms.php");
				} else if(isset($_GET["action"]) and $_GET["action"]="edit"){
					$id = $_GET["edit"];
					$edit_qry = "SELECT * FROM bought_asset
								 WHERE bought_asset_id='".$id."'";
					$stmt = $dbh->prepare($edit_qry);
					$stmt->execute();
					if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);						
					}
					echo 'ID= '.$id;
					include("forms/businessEditForms.php");
				} else {
					$query = "SELECT emp.employee_id, emp.given_name, emp.family_name, dep.department_name, 
								jb.job_title FROM employees emp, departments dep, jobs jb where emp.submitted_status =0 
								and dep.department_id = emp.department_id 
								and jb.job_id=emp.job_id";
					$stmt = $dbh->prepare($query);
					$stmt->execute();
				?>
				

				<div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
				
								<?php 
									if(isset($_GET['success_msg']) && $_GET['success_msg'] != ''){
										echo '<p class="text-success">'.$_GET['success_msg'].'</p>';
									} else if(isset($_GET['warning_msg']) && $_GET['warning_msg'] != ''){
										echo '<p class="text-warning">'.$_GET['warning_msg'].'</p>';
									} else if(isset($_GET['error_msg']) && $_GET['error_msg'] != ''){
										echo '<p class="text-danger">'.$_GET['error_msg'].'</p>';
									} else if(isset($success_msg) && $success_msg != ''){
										echo '<p class="text-success">'.$success_msg.'</p>';
									} else if(isset($warning_msg) && $warning_msg != ''){
										echo '<p class="text-success">'.$warning_msg.'</p>';
									}  else if(isset($error_msg) && $error_msg != ''){
										echo '<p class="text-success">'.$error_msg.'</p>';
									}
								?>

								<?php if($stmt->rowCount() > 0){ ?>
								<?php echo $upd_qry;?>
								<div class="col-12">
									<div class="card">
									<div class="card-body">
									
										<div class="table-responsive my-3 align-items-center">
										<div><span class="pull-right btn btn-primary"><a href="<?php echo $main_link; ?>?dir=boughtAsset&page=bought&action=add"> Add</a></span></div>
											<table id="example2" class="display" style="min-width: 845px">
												<thead>
													<tr>
														<th><center>Employee ID</center></th>
														<th><center>Names</center></th>
														<th>Department Name</th>
														<th>Job Title</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
															$id = $row["bought_asset_id"];
															echo '<tr>';
															echo '<td style="color:black"><center>'.$row["employee_id"].'</center></td>';
															echo '<td style="color:black">'.$row["given_name"].' '.$row["family_name"].'</td>';
															echo '<td style="color:black">'.$row["department_name"].'</td>';
															echo '<td style="color:black">'.$row["job_title"].'</td>';
															echo '</tr>';
														}
														
													?>
												  
												</tbody>
											 </table>
										</div>
									</div>
									</div>
								</div>
								<?php
									} else {
										echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=businessAsset&page=business&action=add"> Add</a></span></div>';
										echo 'No records found.';
									}
								}
								?>
					</div>
				</div>