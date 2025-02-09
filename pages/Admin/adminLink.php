<?php 
				if(isset($_GET["action"]) and $_GET["action"]=="unSbmt"){
					include("pages/Admin/reports/unSubmitedReport.php");
				} else if(isset($_GET["action"]) and $_GET["action"]=="sbmt"){
					include("pages/Admin/reports/submitedReport.php");
				}else if(isset($_GET["action"]) and $_GET["action"]=="unRegist"){
					include("pages/Admin/reports/unRegistered.php");
				} else if(isset($_GET["action"]) and $_GET["action"]=="declPro"){
					include("pages/Admin/reports/declareProcessReport.php");
				} else if(isset($_GET["action"]) and $_GET["action"]=="indvd"){
					include("pages/Admin/reports/individualReport.php");
				} else if(isset($_GET["action"]) and $_GET["action"]=="lock"){
					include("pages/Admin/reports/lockUser.php");
				} else {
					$query = "SELECT * FROM immovable_asset_declarations
							  WHERE employee_id = '".$_SESSION['employee']."' AND 
							  immovable_asset_id=8";
					$stmt = $dbh->prepare($query);
					$stmt->execute();
				?>
				
				<?php 
				  $sql = "SELECT COUNT(*) AS EMPLOYEE FROM employees ";
				  $curr_period_id = getDeclarationPeriodId();
				  $stmt = $dbh->prepare($sql);
				  $stmt->execute();
				  $row = $stmt->fetch(PDO::FETCH_ASSOC);
				  $name = $row['EMPLOYEE'];
				  
				  $sql2 = "SELECT COUNT(*) EMPLOYEE_ALL FROM employees WHERE account_status = 'Enabled'";
				  $stmt2 = $dbh->prepare($sql2);
				  $stmt2->execute();
				  $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
				  $name2 = $row2['EMPLOYEE_ALL'];
				  
				  $submitted = "SELECT COUNT(*) AS SUBMIT FROM submitted_declarations WHERE declaration_period_id='".$curr_period_id."'";
				  $stmtSubmitted = $dbh->prepare($submitted);
				  $stmtSubmitted->execute();
				  $rowSubmitted = $stmtSubmitted->fetch(PDO::FETCH_ASSOC);
				  $submittedRes = $rowSubmitted['SUBMIT'];
				  
				  $unSubmitted = "SELECT COUNT(*) AS UNSUBMIT FROM employees WHERE submitted_status = 0";
				  $stmtUnsubmitted = $dbh->prepare($unSubmitted);
				  $stmtUnsubmitted->execute();
				  $rowUnsubmitted = $stmtUnsubmitted->fetch(PDO::FETCH_ASSOC);
				  $resultUnsubmitted = $rowUnsubmitted['UNSUBMIT'];
				  
				  $unregistered = "SELECT COUNT(*) UNREGISTERED FROM employees WHERE account_status = 'Disabled'";
				  $stmtUnregistered = $dbh->prepare($unregistered);
				  $stmtUnregistered->execute();
				  $rowUnregistered = $stmtUnregistered->fetch(PDO::FETCH_ASSOC);
				  $resultUnregistered = $rowUnregistered['UNREGISTERED'];
				?>
				
				<div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
				
							<div class="card-body">
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
								<div class="col-12">
									<div class="card">
									<div class="card-body">
									
										<div class="table-responsive my-3 p-4 align-items-left">
                                    <table width="75%" align="center" border="1" style="padding: 15px;">
								<tr bgcolor="#D3D3D3"></tr>
								<tr>
									<th colspan="2" style="align:center;" bgcolor="#0b6a90" class="Tabl1Hdr1"><center>System Admin</center>
										</th>
								</tr>
								<tr>
									<td style="color:black" align="center">
									<a href="<?php echo $main_link; ?>?dir=Admin&page=adminLink&action=sbmt">
									Submited Employees <span class="badge badge-pill badge-primary"><?php echo $submittedRes . ' OF ' . $name; ?></span></a></td>
									
									<td style="color:black">
									<a href="<?php echo $main_link; ?>?dir=Admin&page=adminLink&action=declPro">
									Declared Process Employees<span class="badge badge-pill badge-primary"> <?php echo $name2 . ' OF ' . $name; ?></span></td>
								</tr>
								<tr>
									<td style="color:black" align="center">
									<a href="<?php echo $main_link; ?>?dir=Admin&page=adminLink&action=unRegist">
									Unregistered employees <span class="badge badge-pill badge-primary"> <?php echo $resultUnregistered . ' OF ' . $name; ?></span></a></td>
									
									<td style="color:black" align="center">
									<a href="<?php echo $main_link; ?>?dir=Admin&page=adminLink&action=unSbmt">
									Unsubmitted Employees<span class="badge badge-pill badge-primary"> <?php echo $resultUnsubmitted . ' OF ' . $name; ?></a></td>
								</tr>
								<tr>
									<td style="color:black" align="center">
									<a href="<?php echo $main_link; ?>?dir=Admin&page=adminLink&action=indvd">
									Individual Report </a></td>
									
									<td style="color:black" align="center">
									<a href="<?php echo $main_link; ?>?dir=Admin&page=adminLink&action=lock">
									Lock User </a></td>
								</tr>
								<tr>
									<td style="color:black" align="center">
									<a href="#">
									Notification deadline </a></td>
									
									<td style="color:black" align="center">
									<a href="#">
									Make Change </a></td>
								</tr>
							</table>
										</div>
									</div>
									</div>
								</div>
								<?php
									} else {
										echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=immovable&page=fishPond&action=add"> Add</a></span></div>';
										echo 'No records found.';
									}
								}
								?>
							
					</div>
				</div>
				
			<style>
			.table-responsive tr td {
				padding: 10px;
			}
			</style>
